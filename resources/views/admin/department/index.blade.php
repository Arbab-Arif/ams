<x-dashboard-layout>
    <x-slot name="title">
        AMS - Department Listing
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Department</a>
        </div>
    </x-slot>
    @livewire('departments')
    <x-slot name="scripts">
        @livewireScripts

        <script>
            function deleteDepartment(id) {
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this Department",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            Livewire.emit('deleteDepartment', id);
                            swal("Poof! Department has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            swal("Department has Been Save");
                        }
                    });
            }
        </script>
    </x-slot>
</x-dashboard-layout>
