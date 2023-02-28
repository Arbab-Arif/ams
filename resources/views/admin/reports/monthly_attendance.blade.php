<x-dashboard-layout>
    <x-slot name="title">
        AMS - Monthly Attendance Report
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Monthly Attendance Report</a>
        </div>
    </x-slot>
    @livewire('monthly-attendance-report')
    <div id="editor"></div>
    <x-slot name="scripts">
        @livewireScripts
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('message.sent', (message, component) => {
                    if (component.lastFreshHtml.includes('table')) {
                        $('#exportTable').dataTable().fnDestroy();
                    }
                });
                Livewire.hook('message.processed', (message, component) => {
                    if (component.lastFreshHtml.includes('table')) {
                        $('#exportTable').DataTable({
                            ordering: false,
                            searching: false,
                            paging: false,
                            dom: 'Bfrtip',
                            buttons: {
                                buttons: [
                                    { extend: 'excel', className: 'bg-theme-1 font-medium px-6 py-3 rounded-md text-base text-white float-right' }
                                ]
                            },
                        });
                    }
                });
            });
        </script>
    </x-slot>
</x-dashboard-layout>
