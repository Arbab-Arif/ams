<x-dashboard-layout>
    <x-slot name="title">
        AMS - Task Edit
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="{{ route('admin.task.index') }}" class="breadcrumb--active">Task</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Edit</a>
        </div>
    </x-slot>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Edit Task
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Task
                        </h2>
                    </div>
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <form method="post" action="{{ route('admin.task.update', $task) }}">
                                @csrf
                                @method('PUT')
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Title
                                        </label>
                                        <input type="text" name="title"
                                               class="cols-3 input w-full border mt-2 @error('title') border-red-400 @enderror"
                                               placeholder="Enter Title" minlength="2" value="{{ $task->title }}">
                                    </div>

                                    @if(isSuperAdmin())
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Departments
                                        </label>
                                        <select data-search="true"
                                                class="tail-select w-full @error('department_id') border-red-400 @enderror"
                                                name="department_id">
                                            <option value="">Select Department</option>
                                            @foreach($departments as $key => $department)
                                                <option
                                                    value="{{ $department->id }}" {{ ($department->id == $task->department_id) ? 'selected' : '' }}>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="w-full md:w-1/2 px-3 mb-6 mt-2 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Employees
                                        </label>
                                        <select data-search="true"
                                                class="tail-select w-full @error('user_id') border-red-400 @enderror"
                                                name="user_id">
                                            <option value="">Select Employee</option>
                                            @foreach($employees as $key => $employee)
                                                <option value="{{ $employee->id }}" {{ ($employee->id == $task->user_id) ? 'selected' : '' }}>
                                                    {{ $employee->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-4
                                            @error('description') border-red-400 @enderror">
                                            Description
                                        </label>
                                        <textarea
                                            class="resize border w-full rounded focus:outline-none focus:shadow-outline"
                                            name="description" rows="5">{{ $task->description }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="button bg-theme-1 text-white mt-5">Submit</button>
                                <a href="{{ route('admin.task.index') }}">
                                    <button class="button bg-red-600 text-white">Cancel</button>
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
