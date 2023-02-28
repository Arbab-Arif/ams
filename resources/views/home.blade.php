<x-dashboard-layout>
    <x-slot name="title">
        AMS - Dashboard
    </x-slot>
    <x-slot name="breadcrumb">
        <div class="-intro-x breadcrumb mr-auto flex">
            @livewire('attendance')
        </div>
    </x-slot>
    <div
        class="sm:flex md:grid md:grid-cols-12 md:gap-12 lg:grid lg:grid-cols-12 lg:gap-12 xl:grid xl:grid-cols-12 xl:gap-12 xxl:grid xxl:grid-cols-12 xxl:gap-12">
        <div
            class="md:col-span-12 md:grid md:grid-cols-12 md:gap-12 xxl:col-span-12 xxl:grid xxl:grid-cols-12 xxl:gap-12 lg:col-span-12 lg:grid lg:grid-cols-12 lg:gap-12 xl:col-span-12 xl:grid xl:grid-cols-12 xl:gap-12">
            <div class="col-span-12 mt-8">
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5 h-40">
                                <div class="flex">
                                    <div class="text-base text-black mt-1 ">
                                        Total Tasks
                                    </div>
                                    <div class="ml-auto">
                                    </div>
                                </div>
                                <i data-feather="list"
                                   class="report-box__icon text-theme-10 pd-2 float-right mt-6"></i>
                                <div class="text-3xl font-bold leading-8 mt-6 my-2">{{ $tasksCount }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5 h-40">
                                <div class="flex">
                                    <div class="text-base text-black mt-1">
                                        Pending Tasks
                                    </div>
                                </div>
                                <i data-feather="target"
                                   class="report-box__icon text-theme-11 float-right mt-6"></i>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $pendingTasks }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5 h-40">
                                <div class="flex">
                                    <div class="text-base text-black mt-1">
                                        Completed Tasks
                                    </div>
                                </div>
                                <i data-feather="check-circle" class="report-box__icon text-theme-12 float-right mt-6"></i>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $completedTasks }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        @livewireScripts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(() => {
                if (navigator.geolocation) {
                    try {
                        navigator.geolocation.getCurrentPosition((position) => {
                            let coords = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            Livewire.emit('locationAdded', coords);
                        });
                    } catch (e) {
                        alert("location is required");
                    }
                } else {
                }
            });
        </script>
    </x-slot>
</x-dashboard-layout>
