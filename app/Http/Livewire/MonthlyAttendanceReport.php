<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class MonthlyAttendanceReport extends Component
{

    use WithPagination;

    public string $fromDate = '';
    public string $toDate = '';
    public int $companyId = 0;
    public string $overTimeType = '';
    public int $overTimeLimit = 0;
    protected CarbonPeriod $period;

    public function mount()
    {
        $this->companyId = auth()->user()->company_id ?? 0;
    }

    public function search(): Collection
    {
        if (
            $this->toDate === '' ||
            $this->fromDate === '' ||
            $this->companyId === 0
        ) {
            return collect([]);
        }

        $data = User::query()
            ->with(['attendance' => function (HasMany $query) {
                $query->whereBetween('date', [
                    $this->fromDate, $this->toDate
                ]);
            }])
            ->whereHas('attendance', function (Builder $query) {
                $query->whereBetween('date', [
                    $this->fromDate, $this->toDate
                ]);
            })
            ->get()
            ->map(function ($user) {
                $attendances = $user->attendance->groupBy('date')
                    ->map
                    ->groupBy(function ($attendance) {
                        if ($attendance->in === '0') return 'time_in';
                        return 'time_out';
                    });
                $user = $user->toArray();
                $user['attendance'] = $attendances->toArray();
                return $user;
            });

        $company = Company::findOrFail($this->companyId);
        $this->overTimeType = $company->type;
        $this->overTimeLimit = ($company->type === 'flexible') ? $company->hours : (new Carbon($company->time_in))->diffInHours($company->time_out);
        $this->period = CarbonPeriod::create($this->fromDate, $this->toDate);
        return collect($data);
    }

    public function render()
    {
        if (isSuperAdmin()) {
            $company = Company::all();
        }
        return view('livewire.monthly-attendance-report')
            ->with([
                'companies'     => $company ?? [],
                'users'         => $this->search(),
                'timings'       => ['time_in' => 'Time-in', 'time_out' => 'Time-out', 'overtime' => 'Overtime'],
                'period'        => $this->period ?? [],
                'overTimeType'  => $this->overTimeType,
                'emptyArray'    => ['time' => 'N/A'],
                'overTimeLimit' => $this->overTimeLimit
            ]);
    }

}
