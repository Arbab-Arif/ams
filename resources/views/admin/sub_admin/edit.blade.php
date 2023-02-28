<x-dashboard-layout>
    <x-slot name="title">
        AMS - Admin Edit
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="{{ route('admin.sub_admin.index') }}" class="breadcrumb--active">Admin</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Edit</a>
        </div>
    </x-slot>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Edit Admin
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Admin
                        </h2>
                    </div>
                    @if ($errors->any())
                        <div
                            class="bg-red-100 border border-red-400 max-w-xl ml-12 mt-4 px-4 py-3 relative rounded text-red-700">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <form method="post" action="{{ route('admin.sub_admin.update', $sub_admin) }}">
                                @csrf
                                @method('PUT')
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Name
                                        </label>
                                        <input type="text" name="name"
                                               class="cols-3 input w-full border mt-2 @error('name') border-red-400 @enderror"
                                               placeholder="Enter Name" minlength="2" value="{{ $sub_admin->name }}">
                                    </div>
                                    @if(isSuperAdmin())
                                    <div class="w-full md:w-1/2 px-3 mb-6 mt-2 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Company
                                        </label>
                                        <select data-search="true"
                                                class="tail-select w-full @error('company_id') border-red-400 @enderror"
                                                name="company_id">
                                            <option value="">Select Company</option>
                                            @foreach($companies as $key => $company)
                                                <option
                                                    value="{{ $company->id }}" {{ ($company->id == $sub_admin->company_id) ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    @if(isCompanyAdmin())
                                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                            <label
                                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4">
                                                Departments
                                            </label>
                                            <select data-search="true"
                                                    class="tail-select w-full @error('department_id') border-red-400 @enderror"
                                                    name="department_id">
                                                <option value="">Select Department</option>
                                                @foreach($departments as $key => $department)
                                                    <option
                                                        value="{{ $department->id }}" {{ ($department->id == $sub_admin->department_id) ? 'selected' : '' }}>
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="w-full md:w-1/2 px-3 mb-6 mt-4 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Email
                                        </label>
                                        <input type="email" name="email"
                                               class="cols-3 input w-full border mt-2 @error('email') border-red-400 @enderror"
                                               placeholder="Please Enter Your Email" minlength="2"
                                               value="{{ $sub_admin->email }}">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-4">
                                            Contact No.
                                        </label>
                                        <input type="number" name="contact"
                                               class="cols-3 input w-full border mt-2 @error('contact') border-red-400 @enderror"
                                               placeholder="Enter Contact No." minlength="2"
                                               value="{{ $sub_admin->contact }}">
                                    </div>
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-2">

                                    <div class="w-full md:w-1/2 px-3 mb-6 mt-4 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 ">
                                            Password
                                        </label>
                                        <input type="password" name="password" class="cols-3 input w-full border mt-2"
                                               placeholder="Enter Password" minlength="2">
                                    </div>
                                </div>
                                <button type="submit" class="button bg-theme-1 text-white mt-5">Submit</button>
                                <a href="{{ route('admin.sub_admin.index') }}" class="button bg-red-600 text-white">
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
