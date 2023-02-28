<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Company List
        </h2>
        <h2 class="text-right font-medium">
            <a href="{{ route('admin.company.create') }}">
                <button type="submit" class="button bg-theme-1 text-white mt-5">Create</button>
            </a>
        </h2>
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
                                           placeholder="Search By Name"
                                           minlength="2">
                                </div>
                            </div>
                            @if(count($companies) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Name</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Type</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Time In</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Time Out</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Flexible Hours</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($companies as $key => $company)
                                        <tr>
                                            <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $company->name }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $company->type }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $company->time_in }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $company->time_out }}</td>
                                            <td class="border-b whitespace-no-wrap">{{ $company->hours }}</td>
                                            <td class="border-b whitespace-no-wrap">
                                                <a href="{{ route('admin.company.edit', $company->id) }}" class="button bg-blue-600 text-white mr-2">
                                                    Edit
                                                </a>
                                                <a onclick="deleteCompany({{ $company->id }})"
                                                        class="button bg-red-600 text-white"> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $companies->links() }}
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
