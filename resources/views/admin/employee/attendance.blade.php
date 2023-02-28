<x-dashboard-layout>
    <x-slot name="title">
        AMS - Employee Attendance
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Employee Attendance</a>
        </div>
    </x-slot>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Employee Attendance
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <div class="overflow-x-auto">
                                @if(count($attendances) > 0)
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Time In</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Time Out</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Date</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Latitude</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Longitude</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($attendances as $key => $attendance)
                                            <tr>
                                                <td class="border-b whitespace-no-wrap">{{ $key +1 }}</td>
                                                @if(!$attendance->in)
                                                    <td class="border-b whitespace-no-wrap">{{ $attendance->time }}</td>
                                                    <td class="border-b whitespace-no-wrap"></td>
                                                @else
                                                    <td class="border-b whitespace-no-wrap"></td>
                                                    <td class="border-b whitespace-no-wrap">{{ $attendance->time }}</td>
                                                @endif
                                                <td class="border-b whitespace-no-wrap">{{ $attendance->date }}</td>
                                                <td class="border-b whitespace-no-wrap">{{ $attendance->current_lat }}</td>
                                                <td class="border-b whitespace-no-wrap">{{ $attendance->current_lng }}</td>
                                                <td class="border-b whitespace-no-wrap">
                                                    <a class="button bg-red-600 text-white" target="_blank"
                                                       href="https://www.google.com/maps/search/?api=1&query={{ $attendance->current_lat }},{{ $attendance->current_lng }}">
                                                        View On Map
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $attendances->links() }}
                                @else
                                    <div
                                        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
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
</x-dashboard-layout>
