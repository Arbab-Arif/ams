<x-dashboard-layout>
    <x-slot name="title">
        AMS - Leave Opening
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb--active">Dashboard</a>
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="javascript:void(0)">Leave Request</a>
        </div>
    </x-slot>
    @livewire('leave-request-list')
    <x-slot name="scripts">
        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            function updateStatus(id, status) {
                if(status === ''){
                    return false;
                }

                if(status === 'REJECTED'){
                    swal("Write Some Reason For Rejection:", {
                        content: "input",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((value) => {
                            if(value){
                                Livewire.emit('rejectionSubmit', id, status, value);
                                swal("Reason Submitted", {
                                    icon: "success",
                                });
                            }
                        });
                }

                if(status === 'APPROVED'){
                    swal({
                        title: "Are you sure?",
                        text: "You want to " + status + " this Leave Request",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                Livewire.emit('statusUpdate', id, status);
                                swal("Poof! Employee Leave Request has been"+ status +"!", {
                                    icon: "success",
                                });
                            } else {
                                swal("Employee Leave Request Nothing Action");
                            }
                        });

                }
            }
        </script>
    </x-slot>
</x-dashboard-layout>
