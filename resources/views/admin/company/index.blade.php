<x-dashboard-layout>
    <x-slot name="title">
        AMS - Company Listing
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Companies</a>
        </div>
    </x-slot>
    @livewire('companies')
    <x-slot name="scripts">
        @livewireScripts
        <script>
            function deleteCompany(id) {
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this Company",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            Livewire.emit('deleteCompany', id);
                            swal("Poof! Company has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            swal("Company has Been Save");
                        }
                    });
            }
        </script>
    </x-slot>
</x-dashboard-layout>
