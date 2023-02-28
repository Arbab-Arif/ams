<x-dashboard-layout>
    <x-slot name="title">
        AMS -   Department Create
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="{{ route('admin.department.index') }}" class="breadcrumb--active">  Department</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Create</a>
        </div>
    </x-slot>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Department
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                           Department
                        </h2>
                    </div>
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <form method="post" action="{{ route('admin.department.store') }}">
                                @csrf
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                            Name
                                        </label>
                                        <input type="text" name="name" id="name"
                                               class="cols-3 input w-full border mt-2 @error('name') border-red-400 @enderror"
                                               placeholder="Enter Name" minlength="2" value="{{ old('name') }}">
                                    </div>
                                </div>

                                <button type="submit" class="button bg-theme-1 text-white mt-5">Submit</button>
                                <a href="{{ route('admin.department.index') }}" class="button bg-red-600 text-white">
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
