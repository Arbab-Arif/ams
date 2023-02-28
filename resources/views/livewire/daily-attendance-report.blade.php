<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
                <div class="p-5" id="form-validation">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <div class="flex flex-wrap px-3  mb-3">
                                <div class="w-1/2 md:w-full">
                                    <label for="date">Date:</label>
                                    <input type="date" wire:model="date" id="date"
                                           class="cols-3 input w-full border mt-2 form-control">
                                </div>
                            </div>
                            @if(count($employees) > 0)
                                <h2 class="text-right font-medium">
                                    <button type="submit" wire:click="attendanceReportExcel()"
                                            class="button bg-theme-1 text-white mt-5">Excel
                                    </button>
                                    {{--                                        <form action="{{ route('admin.') }}">--}}

                                    {{--                                        </form>--}}
                                    {{--                                        <button type="submit" wire:click="attendanceReportPdf()"--}}
                                    {{--                                                class="button bg-theme-1 text-white mt-5">Pdf</button>--}}
                                </h2>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Company</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Department</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Employee Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Time In</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Time Out</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Overtime</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Attendance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $key => $employee)
                                        <tr>
                                            <td class="border-b whitespace-no-wrap">{{ $key + 1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $employee->company->name }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $employee->department->name }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $employee->name }}</td>
                                            <td class="border-b whitespace-no-wrap">
                                                {{ $employee->attendance->count() ? $employee->attendance->first()->time : 'N/A' }}
                                            </td>
                                            <td class="border-b whitespace-no-wrap">
                                                {{ $employee->attendance->count() ? $employee->attendance->last()->time : 'N/A' }}
                                            </td>
                                            <td class="border-b whitespace-no-wrap">
{{--                                                @if($employee->attendance->count() >= 2)--}}
{{--                                                    {{--}}
{{--                                                        calculateFlexibleTime(--}}
{{--                                                            $employee->attendance->first()->date,--}}
{{--                                                            $employee->attendance->first()->time,--}}
{{--                                                            $employee->attendance->last()->time,--}}
{{--                                                            $timeLimit--}}
{{--                                                        )--}}
{{--                                                    }}--}}
{{--                                                @endif--}}
                                            </td>
                                            <td class="border-b whitespace-no-wrap">{{ $employee->attendance->count() ? 'P' : 'A' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $employees->links() }}
                            @else
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                     role="alert"><span class="block sm:inline">There Is No Record Found.</span>
                                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
