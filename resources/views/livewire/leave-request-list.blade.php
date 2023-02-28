<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Leave Requests List
        </h2>
        @if(auth('web')->check())
            <h2 class="text-right font-medium">
                <a href="{{ route('leave_request.create') }}">
                    <button type="submit" class="button bg-theme-1 text-white mt-5">Create</button>
                </a>
            </h2>
        @endif
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
                <div class="p-5" id="form-validation">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <div class="flex flex-wrap px-3  mb-3">
                                <div class="w-full md:w-full">
                                    <label>Search:</label>
                                    <input type="text" wire:model="search" name="search" id="search"
                                           class="cols-3 input w-full border mt-2 form-control"
                                           placeholder="Search y Employ Name And Leave Type"
                                           minlength="2">
                                </div>
                            </div>
                            @if(count($leaveRequests) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Employ Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Leave Type</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Start Date</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">End Date</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Days Count</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Status</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Reason</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($leaveRequests as $key => $leaveRequest)
                                        <tr>
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ optional($leaveRequest->user)->name ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ optional($leaveRequest->leaveSetup)->leave_type ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $leaveRequest->start_date }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $leaveRequest->end_date }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $leaveRequest->days_count }}</td>
                                            @if(isCompanyAdmin() || isAdmin())
                                                @if($leaveRequest->status == 'PENDING')
                                                    <td class="border-b whitespace-no-wrap">
                                                        <select data-search="true" class="tail-select w-full
                                                        @error('status') border-red-400 @enderror" id="status"
                                                                onchange="updateStatus({{ $leaveRequest->id }},document.getElementById('status').value)"
                                                                name="status">
                                                            <option value="">Select Leave Type</option>
                                                            <option value="APPROVED">Approved</option>
                                                            <option value="REJECTED">Rejected</option>
                                                        </select>
                                                    </td>
                                                @else
                                                    <td class="border-b whitespace-no-wrap">{{ $leaveRequest->status }}</td>
                                                @endif
                                            @else
                                                <td class="border-b whitespace-no-wrap">{{ $leaveRequest->status }}</td>
                                            @endif
                                            <td class="border-b whitespace-no-wrap">{{ $leaveRequest->reason }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $leaveRequests->links() }}
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
