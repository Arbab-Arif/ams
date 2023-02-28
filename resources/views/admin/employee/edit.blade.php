<x-dashboard-layout>
    <x-slot name="title">
        AMS - Employee Edit
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="{{ route('admin.employee.index') }}" class="breadcrumb--active"> Employee</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Edit</a>
        </div>
    </x-slot>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Edit Employee
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <form action="{{ route('admin.employee.update', $employee) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Employee
                            </h2>
                        </div>
                        <div class="p-5" id="form-validation">
                            <div class="preview">
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                        <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Name
                                        </label>
                                        <input type="text" name="name" id="name" class="cols-3 input w-full border mt-2" value="{{ $employee->name }}">
                                    </div>
                                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                        <label for="email" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Email
                                        </label>
                                        <input type="text" name="email" id="email" class="cols-3 input w-full border mt-2" value="{{ $employee->email }}">
                                    </div>
                                    @if(isSuperAdmin())
                                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                            <label for="department_name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                                Department
                                            </label>
                                            <select data-search="true"
                                                    class="tail-select w-full @error('department_id') border-red-400 @enderror"
                                                    name="department_id">
                                                <option value="">Select Department</option>
                                                @foreach($departments as $key => $department)
                                                    <option
                                                        value="{{ $department->id }}" {{ ($department->id == $employee->department_id) ? 'selected' : '' }}>
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                        <label for="employee_code" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Employee Code
                                        </label>
                                        <input type="text" name="employee_code" id="employee_code" class="cols-3 input w-full border mt-2"
                                               value="{{ $employee->employee_code }}">
                                    </div>
                                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                        <label for="employer_name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Employer Name
                                        </label>
                                        <input type="text" name="employer_name" id="employer_name" class="cols-3 input w-full border mt-2"
                                               value="{{ $employee->employer_name }}">
                                    </div>
                                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                        <label for="company_code" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Company Code
                                        </label>
                                        <input type="text" name="company_code" id="company_code" class="cols-3 input w-full border mt-2"
                                               value="{{ $employee->company_code }}">
                                    </div>
                                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                        <label for="cnic" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            CNIC
                                        </label>
                                        <input type="text" name="cnic" id="cnic" class="cols-3 input w-full border mt-2" value="{{ $employee->cnic }}">
                                    </div>
                                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                        <label for="dob" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                            Date of Joining
                                        </label>
                                        <input type="text" name="dob" id="dob" class="cols-3 input w-full border mt-2" value="{{ $employee->dob }}">
                                    </div>
                                </div>

                                <button type="submit" class="button bg-theme-1 text-white mt-5">Update</button>
                                <a href="{{ route('admin.employee.index') }}">
                                    <button type="button" class="button bg-red-600 text-white">Cancel</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
