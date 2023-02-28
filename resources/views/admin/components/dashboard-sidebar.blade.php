<nav class="side-nav">
    <a href="{{ route('admin.dashboard') }}" class="intro-x flex items-center pl-5 pt-4">
        {{--        <img class="w-6" src="{{ asset('backend/images/logo.svg') }}">--}}
        <span class="hidden xl:block text-white text-lg ml-3">
           <x-logo width="120" height="54"></x-logo>
        </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{route('admin.dashboard')}}"
               class="side-menu {{ request()->routeIs('admin.dashboard') ? 'side-menu--active' : null }}">
                <div class="side-menu__icon"><i data-feather="home"></i></div>
                <div class="side-menu__title"> Dashboard</div>
            </a>
        </li>

        @if(isSuperAdmin())
            <li>
                <a href="{{ route('admin.company.index') }}"
                   class="side-menu {{ request()->routeIs('admin.company.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Company</div>
                </a>
            </li>
        @endif

        @if(isAdmin())
            <li>
                <a href="{{ route('admin.employee.index') }}"
                   class="side-menu {{ request()->routeIs('admin.employee.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Employee</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.task.index') }}"
                   class="side-menu {{ request()->routeIs('admin.task.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Task</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.leave_request.index') }}"
                   class="side-menu {{ request()->routeIs('admin.leave_request.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Leave Requests</div>
                </a>
            </li>

            @if(!isDepartmentAdmin())

                <li>
                    <a href="{{ route('admin.leave.index') }}"
                       class="side-menu {{ request()->routeIs('admin.leave.*') ? 'side-menu--active' : null }}">
                        <div class="side-menu__icon"><i data-feather="user"></i></div>
                        <div class="side-menu__title">Leave</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.sub_admin.index') }}"
                       class="side-menu {{ request()->routeIs('admin.sub_admin.*') ? 'side-menu--active' : null }}">
                        <div class="side-menu__icon"><i data-feather="user"></i></div>
                        <div class="side-menu__title"> Admin</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.department.index') }}"
                       class="side-menu {{ request()->routeIs('admin.department.*') ? 'side-menu--active' : null }}">
                        <div class="side-menu__icon"><i data-feather="user"></i></div>
                        <div class="side-menu__title">Department</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.report.department')}}"
                       class="side-menu {{ request()->routeIs('admin.report.department') ? 'side-menu--active' : null }}">
                        <div class="side-menu__icon"><i data-feather="user"></i></div>
                        <div class="side-menu__title">Department Report</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.report.employee')}}"
                       class="side-menu {{ request()->routeIs('admin.report.employee') ? 'side-menu--active' : null }}">
                        <div class="side-menu__icon"><i data-feather="user"></i></div>
                        <div class="side-menu__title">Employee Report</div>
                    </a>
                </li>
            @endif

            <li>
                <a href="{{ route('admin.report.employee.leave') }}"
                   class="side-menu {{ request()->routeIs('admin.report.employee.leave') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title">Employee Leave Report</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.report.daily') }}"
                   class="side-menu {{ request()->routeIs('admin.report.daily') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Daily Attendance Report</div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.report.monthly') }}"
                   class="side-menu {{ request()->routeIs('admin.report.monthly') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Monthly Attendance Report</div>
                </a>
            </li>
        @else
            <li>
                <a href="{{ route('employee.task.index') }}"
                   class="side-menu {{ request()->routeIs('employee.task.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Task</div>
                </a>
            </li>
            <li>
                <a href="{{ route('leave_request.index') }}"
                   class="side-menu {{ request()->routeIs('leave_request.*') ? 'side-menu--active' : null }}">
                    <div class="side-menu__icon"><i data-feather="user"></i></div>
                    <div class="side-menu__title"> Leave Requests</div>
                </a>
            </li>
        @endif


    </ul>
</nav>
