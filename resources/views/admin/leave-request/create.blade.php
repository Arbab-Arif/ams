<x-dashboard-layout>
    <x-slot name="title">
        AMS - Leave  Request Create
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="{{ route('admin.leave.index') }}" class="breadcrumb--active">Leave  Request</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Create</a>
        </div>
    </x-slot>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Leave Request
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Leave Request
                        </h2>
                    </div>
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 max-w-xl ml-12 mt-4 px-4 py-3 relative rounded text-red-700">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <form method="post" action="{{ route('leave_request.store') }}">
                                @csrf
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">
                                           Start Date
                                        </label>
                                        <input type="date" name="start_date" id="start_date"
                                               class="cols-3 input w-full border mt-2 @error('start_date') border-red-400 @enderror"
                                               placeholder="Enter Date" value="{{ old('start_date') }}">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Leave Type
                                        </label>
                                        <select data-search="true" class="tail-select w-full
                                                @error('leave_setup_id') border-red-400 @enderror"
                                                name="leave_setup_id">
                                            <option value="">Select Leave Type</option>
                                            @foreach($leaveSetups as $leaveSetup)
                                                <option value="{{ $leaveSetup->id }}">{{ $leaveSetup->leave_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 mt-4">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold">
                                            Days Count
                                        </label>
                                        <input type="number" name="days_count" class="cols-3 input w-full border mt-2
                                                @error('days_count') border-red-400 @enderror"
                                               placeholder="Number Of Allowed Leave" value="{{ old('days_count') }}">
                                    </div>

                                </div>

                                <button type="submit" class="button bg-theme-1 text-white mt-5">Submit</button>
                                <a href="{{ route('admin.leave.index') }}" class="button bg-red-600 text-white">
                                    Cancel
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
    </x-slot>
</x-dashboard-layout>
