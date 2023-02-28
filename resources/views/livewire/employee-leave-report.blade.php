<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
                <div class="p-5" id="form-validation">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <div class="flex flex-wrap px-3  mb-3">
                                <div class="flex flex-wrap mb-3">
                                    <div class="w-1/3">
                                        <label for="form_date">From Date:</label>
                                        <input type="date" wire:model="fromDate" id="form_date"
                                               class="cols-3 input w-full border mt-2 form-control">
                                    </div>
                                    <div class="w-1/3 pl-3">
                                        <label for="to_date">To Date:</label>
                                        <input type="date" wire:model="toDate" id="to_date"
                                               class="cols-3 input w-full border mt-2 form-control">
                                    </div>
                                    <div class="w-1/3 pl-3">
                                        <label for="date">Departments:</label>
                                        <select name="employeeId" wire:model="departmentId" id="employee"
                                                class="cols-3 input w-full border mt-2 form-control">
                                            <option value="">Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            @if(count($employees) > 0)
                                <h2 class="text-right font-medium">
                                    <form action="{{ route('admin.report.employee.pdf') }}" method="post">
                                        @csrf
{{--                                        <input type="hidden" name="data" value="{{ $pdfData }}">--}}
{{--                                        <button class="button bg-theme-1 text-white mt-5" type="submit">Pdf</button>--}}
                                    </form>
                                    <button type="button" wire:click="employeeLeaveReportExcel()"
                                            class="button bg-theme-1 text-white mt-5">Excel
                                    </button>
                                </h2>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Employee Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">T.P</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">T.C</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">T.S</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">T.E</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">T.M</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Other Leave</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Total Days</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $key => $employee)
                                        <tr>
                                            <td class="border-b whitespace-no-wrap">{{ $key + 1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $employee->name }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ round($employee->attendance_count / 2) }}</td>
                                            <td class="border-b whitespace-no-wrap">
                                                {{ optional($employee->leaveRequest->get('casual_leave'))->sum('days_count') ?? 0 }}
                                            </td>
                                            <td class="border-b whitespace-no-wrap">
                                                {{ optional($employee->leaveRequest->get('sick_leave'))->sum('days_count') ?? 0 }}
                                            </td>
                                            <td class="border-b whitespace-no-wrap">
                                                {{ optional($employee->leaveRequest->get('earned_leave'))->sum('days_count') ?? 0 }}
                                            </td>
                                            <td class="border-b whitespace-no-wrap">
                                                {{ optional($employee->leaveRequest->get('maternity_leave'))->sum('days_count') ?? 0 }}
                                            </td>
                                            <td class="border-b whitespace-no-wrap">
                                                {{ optional($employee->leaveRequest->get('leave'))->sum('days_count') ?? 0 }}
                                            </td>
                                            <td class="border-b whitespace-no-wrap">
                                                {{ $daysCount }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div
                                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-3"
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
