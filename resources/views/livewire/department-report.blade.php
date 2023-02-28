<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
                <div class="p-5" id="form-validation">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <div class="flex flex-wrap px-3  mb-3">
                                <h2 class="text-right font-medium">
                                    <button type="submit" wire:click="departmentReportExcel()"
                                            class="button bg-theme-1 text-white mt-5">Excel</button>
                                    <a href="{{ route('admin.report.department.pdf') }}">
                                        <button class="button bg-theme-1 text-white mt-5" type="button">Pdf</button>
                                    </a>
                                </h2>
                            </div>
                            @if(count($reports) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Date</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Department</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">No Of Employees
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reports as $key => $report)
                                        <tr>
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->created_at }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->name }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $report->users->count() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $reports->links() }}
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
