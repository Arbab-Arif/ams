<x-dashboard-layout>
    <x-slot name="title">
        AMS - Company Create
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="{{ route('admin.company.index') }}" class="breadcrumb--active"> Company</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Create</a>
        </div>
    </x-slot>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Company
            </h2>
        </div>

        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Company
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
                            <form method="post" action="{{ route('admin.company.store') }}">
                                @csrf
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="name">
                                            Name
                                        </label>
                                        <input type="text" name="name" id="name"
                                               class="cols-3 input w-full border mt-2 @error('name') border-red-400 @enderror"
                                               placeholder="Enter Name" minlength="2" value="{{ old('name') }}">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-4"
                                            for="name">
                                            Time Type
                                        </label>
                                        <select data-search="true" class="tail-select w-full
                                                @error('type') border-red-400 @enderror"
                                                name="type" id="type">
                                            <option value="fixed">Fixed</option>
                                            <option value="flexible">Flexible</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 px-3 pl-0 mt-6 mb-6 md:mb-0" id="flexible" style="display: none">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="name">
                                        Hours
                                    </label>
                                    <input type="number" name="hours" id="hours"
                                           class="cols-3 input w-full border mt-2 @error('hours') border-red-400 @enderror"
                                           placeholder="Enter Your Company Time In" minlength="2"
                                           value="{{ old('hours') }}">
                                </div>
                                <div class="flex flex-wrap -mx-3 mb-2" id="fixed">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="name">
                                            Time In
                                        </label>
                                        <input type="time" name="time_in" id="time_in"
                                               class="cols-3 input w-full border mt-2 @error('time_in') border-red-400 @enderror"
                                               placeholder="Enter Your Company Time In" minlength="2"
                                               value="{{ old('time_in') }}">
                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="name">
                                            Time Out
                                        </label>
                                        <input type="time" name="time_out" id="time_out"
                                               class="cols-3 input w-full border mt-2 @error('time_out') border-red-400 @enderror"
                                               placeholder="Enter Your Company Time In" minlength="2"
                                               value="{{ old('time_out') }}">
                                    </div>
                                </div>

                                <button type="submit" class="button bg-theme-1 text-white mt-5">Submit</button>
                                <a href="{{ route('admin.company.index') }}" class="button bg-red-600 text-white">
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
        <script>
            document.getElementById('type').addEventListener('change', function () {
                var x = document.getElementById('type').value;
                if (x == 'flexible') {
                    document.getElementById('time_in').value = '';
                    document.getElementById('time_out').value = '';
                }
                if (x == 'fixed') {
                    document.getElementById('hours').value = '';
                }
                document.getElementById('flexible').style.display = 'none';
                document.getElementById('fixed').style.display = 'none';
                document.getElementById(this.value).removeAttribute('style');
            });
        </script>
    </x-slot>
</x-dashboard-layout>
