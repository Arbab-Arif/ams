<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Attendance extends Component
{

    public $lat = '';
    public $lng = '';
    public $isTimeIn = false;
    public $disabled = false;
    public $report = '';

    protected $listeners = [
        'locationAdded' => 'setLocation'
    ];

    public $rules = [
        'lat' => 'required',
        'lng' => 'required'
    ];

    public function mount()
    {
        $this->checkIsTimeIn();
    }

    public function setLocation($cords)
    {
        $this->lat = $cords['lat'];
        $this->lng = $cords['lng'];
    }

    public function timeIn()
    {
        if ($this->disabled) return;
        $this->validate();
        $this->disabled = true;

        $this->checkIsTimeIn();
        if ($this->isTimeIn) {
            return $this->timeOut();
        }

        $carbon = now();
        DB::beginTransaction();
        auth()->user()
            ->attendance()->create([
                'current_lat' => $this->lat,
                'current_lng' => $this->lng,
                'time'        => $carbon->format('h:i:s a'),
                'date'        => $carbon->format('Y-m-d'),
                'in'          => 0
            ]);
        DB::commit();

        $this->isTimeIn = true;
        $this->disabled = false;
    }

    public function timeOut()
    {
        if ($this->disabled) return;
        $this->validate();
        $this->disabled = true;

        $this->checkIsTimeIn();
        if (!$this->isTimeIn) {
            return $this->timeIn();
        }

        $carbon = now();
        DB::beginTransaction();
        auth()->user()
            ->attendance()->create([
                'current_lat' => $this->lat,
                'current_lng' => $this->lng,
                'time'        => $carbon->format('h:i:s a'),
                'date'        => $carbon->format('Y-m-d'),
                'in'          => 1
            ]);
        DB::commit();

        $this->isTimeIn = false;
        $this->disabled = false;
    }


    public function render()
    {
        $this->isTodayTimeIn();
        return view('livewire.attendance');
    }

    private function checkIsTimeIn(): void
    {
        $attendance = $this->getLastAttendance();
        if (!is_null($attendance)) {
            $this->isTimeIn = intval($attendance->in) === 0;
        }
    }

    protected function isTodayTimeIn()
    {
        $attendance = $this->getLastAttendance();
        if (!is_null($attendance) && intval($attendance->in) !== 0 && today()->ne(new Carbon($attendance->date))) {
            DB::beginTransaction();
            auth()->user()
                ->attendance()->create([
                    'current_lat' => $attendance->lat,
                    'current_lng' => $attendance->lng,
                    'time'        => '11:59:59 PM',
                    'date'        => $attendance->date,
                    'in'          => 1
                ]);
            DB::commit();
        }
    }

    /**
     * @return mixed
     */
    private function getLastAttendance()
    {
        return auth()->user()
            ->attendance()->orderBy('id', 'desc')->first();
    }

}
