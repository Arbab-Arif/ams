<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="utf-8">
    <link href="{{ asset('backend/images/logo.svg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Effects Tech">
    <title>{{ $title  }}</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" type="text/css"/>
{{ $styles ?? '' }}
<!-- END: CSS Assets-->
</head>

<body class="app">
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

<!-- BEGIN: Mobile Menu -->
<x-dashboard-mobile-nav></x-dashboard-mobile-nav>
<!-- END: Mobile Menu -->
@if(session()->has('impersonate'))
    <div class="relative bg-theme-1">
        <div class="max-w-screen-xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
            <div class="pr-16 sm:text-center sm:px-16">
                <p class="font-medium text-white">
                    <span class="md:hidden">You are impersonating {{auth()->user()->name}}</span>
                    <span class="hidden md:inline">
                        You are impersonating {{auth()->user()->name}}
                    </span>
                    <span class="block sm:ml-2 sm:inline-block">
                        <a href="{{route('leave-impersonation')}}" class="text-white font-bold underline">
                            Leave Impersonation &rarr;
                        </a>
                    </span>
                </p>
            </div>
        </div>
    </div>
@endif

<div class="flex">

    <!-- BEGIN: Side Menu -->
    <x-dashboard-sidebar></x-dashboard-sidebar>
    <!-- END: Side Menu -->

    <!-- BEGIN: Content -->
    <div class="content">
        <!-- BEGIN: Top Bar -->
        <div class="top-bar">
            {{ $breadcrumb  }}
            <div class="intro-x dropdown w-8 h-8">
                <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                    <img alt="Midone Tailwind HTML Admin Template" src="{{ asset('backend/images/profile-1.jpg') }}">
                </div>
                <div class="dropdown-box w-56">
                    <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
                        <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                            <div class="font-medium">{{ auth()->user()->name }}</div>
                            @if(isSuperAdmin())
                                <div class="text-xs text-theme-41 dark:text-gray-600">Super Admin</div>
                            @elseif(isCompanyAdmin())
                                <div class="text-xs text-theme-41 dark:text-gray-600">Company Admin</div>
                            @elseif(isAdmin())
                                <div class="text-xs text-theme-41 dark:text-gray-600">Department Admin</div>
                            @else
                                <div class="text-xs text-theme-41 dark:text-gray-600">Employee</div>
                            @endif
                        </div>
                        @if(isSuperAdmin() || isCompanyAdmin() || isAdmin())
                        <div class="p-2">
                            <a href="{{ route('admin.change.password') }}" class="flex items-center block p-2 transition duration-300
                                        ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="key" class="w-4 h-4 mr-2"></i> Change Password
                            </a>
                        </div>
                        @else
                            <div class="p-2">
                                <a href="{{ route('employee.change.password') }}" class="flex items-center block p-2 transition duration-300
                                        ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                    <i data-feather="key" class="w-4 h-4 mr-2"></i> Change Password
                                </a>
                            </div>
                        @endif
                        <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                            <a href="javascript:;" onclick="document.getElementById('logout-form').submit()"
                               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ $slot }}

    </div>

</div>
<!-- BEGIN: Dark Mode Switcher-->
{{--<div data-url="side-menu-dark-dashboard.html"
     class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
    <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
    <div class="dark-mode-switcher__toggle border"></div>
</div>--}}
<!-- END: Dark Mode Switcher-->
<!-- BEGIN: JS Assets-->
<script src="{{ asset('backend/js/main.js') }}"></script>
{{ $scripts ?? '' }}
<!-- END: JS Assets-->
</body>
</html>
