<x-dashboard-layout>
    <x-slot name="title">
        AMS - Employee Report
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Employee Report</a>
        </div>
    </x-slot>
    @livewire('employee-report')
    <x-slot name="scripts">
        @livewireScripts
    </x-slot>
</x-dashboard-layout>
