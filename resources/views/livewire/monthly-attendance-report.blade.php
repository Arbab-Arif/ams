<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
                <div class="p-5" id="form-validation">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <div class="flex flex-wrap px-3  mb-3">
                                <div class="w-1/4">
                                    <label for="form_date">From Date:</label>
                                    <input type="date" wire:model.defer="fromDate" id="form_date"
                                           class="cols-3 input w-full border mt-2 form-control">
                                </div>
                                <div class="w-1/4 pl-3">
                                    <label for="to_date">To Date:</label>
                                    <input type="date" wire:model.defer="toDate" id="to_date"
                                           class="cols-3 input w-full border mt-2 form-control">
                                </div>
                                @if(isSuperAdmin())
                                    <div class="w-1/4 pl-3">
                                        <label for="employee">Company:</label>
                                        <select name="employee" wire:model.defer="companyId" id="employee"
                                                class="cols-3 input w-full border mt-2 form-control">
                                            <option value="">Select Company</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="w-1/4 text-center">
                                    <label>Search:</label>
                                    <br>
                                    <button
                                        class="bg-theme-1 font-medium px-6 py-3 rounded-md text-base text-white"
                                        wire:click="search"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </div>
                            @if(count($users) > 0)
                                <table class="table" id="exportTable">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Employee Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Timing</th>
                                        @foreach($period as $date)
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">{{ $date->format('d-m-y') }}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        @foreach($timings as $key => $timing)
                                            <tr>
                                                @if($key === 'time_in')
                                                    <td class="border-b whitespace-no-wrap">{{ $user['name'] }}</td>
                                                @else
                                                    <td class="border-b whitespace-no-wrap"></td>
                                                @endif
                                                <td class="border-b whitespace-no-wrap">{{ $timing }}</td>
                                                @foreach($period as $date)
                                                    @if(isset($user['attendance'][$date->format('Y-m-d')]))
                                                        @if($key === 'overtime')
{{--                                                                {{ $key }}--}}
                                                                <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">
{{--                                                                @if(isset($user['attendance'][$date->format('Y-m-d')][$key]))--}}
                                                                    {{ calculateFlexibleTime(
                                                                            $date->format('Y-m-d'),
                                                                            $user['attendance'][$date->format('Y-m-d')]['time_in'][0]['time'],
                                                                            end($user['attendance'][$date->format('Y-m-d')]['time_out'])['time'],
                                                                            $overTimeLimit) }}
{{--                                                                @else--}}
{{--                                                                    N/A--}}
{{--                                                                @endif--}}
                                                            </th>
                                                        @else
                                                            @if(isset($user['attendance'][$date->format('Y-m-d')][$key]))
                                                                @if ($key === 'time_in')
                                                                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">
                                                                        {{ $user['attendance'][$date->format('Y-m-d')][$key][0]['time'] }}
                                                                    </th>
                                                                @else
                                                                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">
                                                                        {{ end($user['attendance'][$date->format('Y-m-d')][$key])['time'] }}
                                                                    </th>
                                                                @endif
                                                            @else
                                                                <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">
                                                                    N/A
                                                                </th>
                                                            @endif
                                                        @endif
                                                    @else
                                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">
                                                            A
                                                        </th>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
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
