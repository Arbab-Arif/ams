<x-dashboard-layout>
    <x-slot name="title">
        AMS - Employee Listing
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Employees</a>
        </div>
    </x-slot>
    @livewire('employees')
    <x-slot name="scripts">
        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            function employeeResign(id) {
                swal({
                    title: "Are you sure?",
                    text: "You want to resign this employee",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            Livewire.emit('employeeResign', id);
                        }
                    });
            }

            function employeeDelete(id) {
                swal({
                    title: "Are you sure?",
                    text: "You want to Delete this employee",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            Livewire.emit('employeeDelete', id);
                        }
                    });
            }
        </script>
    </x-slot>
</x-dashboard-layout>
