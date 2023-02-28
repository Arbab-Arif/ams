<x-dashboard-layout>
    <x-slot name="title">
        AMS - Admin Listing
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Admin</a>
        </div>
    </x-slot>
    @livewire('admins')
    <x-slot name="scripts">
        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            function deleteAdmin(id) {
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this Admin",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            Livewire.emit('adminDeleted', id);
                            swal("Poof! Admin has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            swal("Admin has Been Save");
                        }
                    });
            }
        </script>
    </x-slot>
</x-dashboard-layout>
