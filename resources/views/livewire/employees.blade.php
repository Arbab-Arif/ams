<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Employee List
        </h2>

        @if(!isSuperAdmin() && !isCompanyAdmin())
            <h2 class="text-right font-medium">
                <button type="submit" wire:click="sampleDownload()" class="button bg-theme-1 text-white mt-5">Sample
                    File
                </button>
                <a href="{{ route('admin.employee.create') }}">
                    <button type="submit" class="button bg-theme-1 text-white mt-5">Create</button>
                </a>
            </h2>
        @endif
    </div>
    @if(!isSuperAdmin() && !isCompanyAdmin())
        <div class="intro-y flex space-x-64 items-center mt-8">
            <h2 class="text-lg font-medium">
                Employee Import
            </h2>
            <h2 class="font-medium text-lg">
                <input type="file" name="excelImportFile" wire:model="excelImportFile">
            </h2>

            <h2 class="text-right font-medium">
                <button type="submit" wire:click="save()" wire:loading.attr="disabled"
                        class="inline-flex items-center justify-center py-3 px-6 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-theme-1 hover:bg-theme-1 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out disabled:opacity-50">
                    <svg wire:loading.class.remove="hidden" wire:target="save"
                         class="animate-spin hidden -ml-1 mr-3 h-5 w-5 text-white"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span>Import</span>
                </button>

            </h2>
        </div>
    @endif
    <div class="intro-y flex space-x-64 items-center mt-8">
        @error('excelImportFile')
        <div role="alert" class="mt-3 w-full">
            <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                <p>{{ $message }}</p>
            </div>
        </div>
        @enderror
        @if (session()->has('message'))
            <div class="w-full bg-red-300 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
                <div class="p-5" id="form-validation">
                    <div class="flex flex-wrap px-3  mb-3">
                        <div class="w-full md:w-full">
                            <label>Search:</label>
                            <input type="text" wire:model="search" name="search" id="search"
                                   class="cols-3 input w-full border mt-2 form-control"
                                   placeholder="Search By Name"
                                   minlength="2">
                        </div>
                    </div>
                    <div class="preview mb-4">
                        <div class="overflow-x-auto">
                            @if(count($employees) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Email</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Department Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Date Of Joining</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Status</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $key => $employee)
                                        <tr>
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $employee->name }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $employee->email }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ optional($employee->department)->name ?? 'N/A' }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $employee->dob }}</td>
                                            <td class="border-b whitespace-no-wrap">
                                                {{ !$employee->status ? 'Active' : 'Resigned' }}
                                            </td>
                                            <td class="border-b whitespace-no-wrap">
                                                @if($employee->status == 0)
                                                    <button type="button" onclick="employeeResign({{ $employee->id }})"
                                                            class="button bg-red-600 text-white">Resign
                                                    </button>
                                                    <a href="{{ route('admin.employee.edit', $employee->id) }}">
                                                        <button type="button" class="button bg-blue-600 text-white">Edit
                                                        </button>
                                                    </a>
                                                    <button type="button" onclick="employeeDelete({{ $employee->id }})"
                                                       class="button bg-red-600 text-white"> Delete
                                                    </button>
                                                    <a wire:click="impersonate({{ $employee->id }})" href="javascript:;">
                                                        <button type="button" class="button bg-blue-600 text-white">
                                                            Impersonate
                                                        </button>
                                                    </a>
                                                @endif

                                                <a href="{{ route('admin.employee.attendance', $employee->id) }}">
                                                    <button type="button" class="button bg-blue-600 text-white">
                                                        View Attendance
                                                    </button>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>


                        </div>
                    </div>
                    {{ $employees->links() }}
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
