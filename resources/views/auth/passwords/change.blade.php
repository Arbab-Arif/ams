<x-dashboard-layout>
    <x-slot name="title">
        AMS - Change Password
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('home') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Change Password</a>
        </div>
    </x-slot>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">

            </h2>
        </div>

        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Change Password
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
                    @if (session()->has('success'))
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                            <div class="flex">
                                <div>
                                    <p class="text-sm">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <form method="post" action="{{ route('employee.change.password') }}">
                                @csrf
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="name">
                                            Old Password
                                        </label>
                                        <input type="password" name="current_password" id="current_password"
                                               class="cols-3 input w-full border mt-2 @error('current_password') border-red-400 @enderror"
                                               placeholder="Enter your old password" minlength="2" value="{{ old('current_password') }}">
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 px-3 pl-0 mt-6 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="name">
                                        New Password
                                    </label>
                                    <input type="password" name="new_password" id="new_password"
                                           class="cols-3 input w-full border mt-2 @error('new_password') border-red-400 @enderror"
                                           placeholder="Enter New Password" minlength="2"
                                           value="{{ old('new_password') }}">
                                </div>
                                <div class="w-full md:w-1/2 px-3 pl-0 mt-6 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="name">
                                        Confirm Password
                                    </label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                           class="cols-3 input w-full border mt-2 @error('confirm_password') border-red-400 @enderror"
                                           placeholder="Confirm Password" minlength="2"
                                           value="{{ old('confirm_password') }}">
                                </div>

                                <button type="submit" class="button bg-theme-1 text-white mt-5">Submit</button>
                                <a href="{{ route('admin.dashboard') }}" class="button bg-red-600 text-white">
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
