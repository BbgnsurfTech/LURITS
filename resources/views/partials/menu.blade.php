<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.home") }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-tachometer-alt">

                            </i>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>
                @can('records_management_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.records-managements.index") }}" class="nav-link {{ request()->is('admin/records-managements') || request()->is('admin/records-managements/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-book">

                            </i>
                            <p>
                                <span>{{ trans('cruds.recordsManagement.title') }}</span>
                            </p>
                        </a>
                    </li>
                @endcan
                @can('school_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/teams*') ? 'menu-open' : '' }} {{ request()->is('admin/student-admissions*') ? 'menu-open' : '' }} {{ request()->is('admin/attendances*') ? 'menu-open' : '' }} {{ request()->is('admin/teachers*') ? 'menu-open' : '' }} {{ request()->is('admin/teacher-attendances*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-school">

                            </i>
                            <p>
                                <span>{{ trans('cruds.schoolManagement.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('team_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.teams.index") }}" class="nav-link {{ request()->is('admin/teams') || request()->is('admin/teams/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-school">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.team.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('student_admission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.student-admissions.index") }}" class="nav-link {{ request()->is('admin/student-admissions') || request()->is('admin/student-admissions/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-file-alt">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.studentAdmission.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('attendance_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.attendances.index") }}" class="nav-link {{ request()->is('admin/attendances') || request()->is('admin/attendances/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-clipboard-list">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.attendance.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('teacher_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.teachers.index") }}" class="nav-link {{ request()->is('admin/teachers') || request()->is('admin/teachers/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-chalkboard-teacher">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.teacher.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('teacher_attendance_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.teacher-attendances.index") }}" class="nav-link {{ request()->is('admin/teacher-attendances') || request()->is('admin/teacher-attendances/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-clipboard-list">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.teacherAttendance.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-users">

                            </i>
                            <p>
                                <span>{{ trans('cruds.userManagement.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.permission.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.role.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-user">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.user.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('class_time_table_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.class-time-tables.index") }}" class="nav-link {{ request()->is('admin/class-time-tables') || request()->is('admin/class-time-tables/*') ? 'active' : '' }}">
                            <i class="fa-fw far fa-calendar-alt">

                            </i>
                            <p>
                                <span>{{ trans('cruds.classTimeTable.title') }}</span>
                            </p>
                        </a>
                    </li>
                @endcan
                @can('parent_guardian_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/parent-guardianregisters*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-user-alt">

                            </i>
                            <p>
                                <span>{{ trans('cruds.parentGuardian.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('parent_guardianregister_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.parent-guardianregisters.index") }}" class="nav-link {{ request()->is('admin/parent-guardianregisters') || request()->is('admin/parent-guardianregisters/*') ? 'active' : '' }}">
                                        <i class="fa-fw far fa-user">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.parentGuardianregister.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt">

                            </i>
                            <span>{{ trans('global.logout') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>