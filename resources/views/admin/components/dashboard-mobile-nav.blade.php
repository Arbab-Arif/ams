<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <x-logo width="80" height="34"></x-logo>
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2"
                                                            class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <li>
            <a href="{{route('admin.dashboard')}}"
               class="menu {{ request()->routeIs('admin.dashboard') ? 'menu--active' : null }}">
                <div class="side-menu__icon"><i data-feather="home"></i></div>
                <div class="side-menu__title"> Dashboard</div>
            </a>
        </li>

        @if(isSuperAdmin())
            <li>
                <a href="{{ route('admin.company.index') }}"
                   class="menu {{ request()->routeIs('admin.company.*') ? 'menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Department</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.sub_admin.index') }}"
                   class="menu {{ request()->routeIs('admin.sub_admin.*') ? 'menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Admin</div>
                </a>
            </li>
        @endif

        @if(isAdmin())
            <li>
                <a href="{{ route('admin.employee.index') }}"
                   class="menu {{ request()->routeIs('admin.employee.*') ? 'menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Employee</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.task.index') }}"
                   class="menu {{ request()->routeIs('admin.task.*') ? 'menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Task</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.report.daily') }}"
                   class="menu {{ request()->routeIs('admin.report.daily') ? 'menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Daily Attendance Report</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.report.monthly') }}"
                   class="menu {{ request()->routeIs('admin.report.monthly') ? 'menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Monthly Attendance Report</div>
                </a>
            </li>
        @else
            <li>
                <a href="{{ route('employee.task.index') }}"
                   class="menu {{ request()->routeIs('employee.task.*') ? 'menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Task</div>
                </a>
            </li>
        @endif
    </ul>
</div>
