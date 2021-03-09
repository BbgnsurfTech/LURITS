<div class="dashboard-page-one">
    <!-- Sidebar Area Start Here -->
    <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
       <div class="mobile-sidebar-header d-md-none">
            <div class="header-logo">
                <a href="{{ route("admin.home") }}"><img src="{{ asset('img/logo1.png') }}" alt="logo"></a>
            </div>
        </div>
        <div class="sidebar-menu-content">
            <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                <li class="nav-item sidebar-nav">
                    <a href="{{ route("admin.home") }}" class="nav-link"><i class="flaticon-dashboard"></i><span>{{ trans('global.dashboard') }}</span></a>
                </li>
                @can('records_management_access')
                <li class="nav-item sidebar-nav">
                    <a href="{{ route("admin.records-managements.index") }}" class="nav-link {{ request()->is('admin/records-managements') || request()->is('admin/records-managements/*') ? 'active' : '' }}">
                        <i class="flaticon-books"></i>
                        <span>{{ trans('cruds.recordsManagement.title') }}</span>
                    </a>
                </li>
                @endcan
                @can('school_management_access')
                <li class="nav-item sidebar-nav-item {{ request()->is('admin/staffs*') ? 'menu-open' : '' }} {{ request()->is('admin/attendances*') ? 'menu-open' : '' }} {{ request()->is('admin/smr*') ? 'menu-open' : '' }} {{ request()->is('admin/staff-transfer*') ? 'menu-open' : '' }} {{ request()->is('admin/leave*') ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class=" fas fa-school"></i>
                        <span>Staff Management</span>
                    </a>
                    <ul class="nav sub-group-menu">
                        @can('staff_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.staffs.index") }}" class="nav-link {{ request()->is('admin/staffs') || request()->is('admin/staffs/*') ? 'active' : '' }}">
                                    <i class=" fas fa-user-circle"></i>
                                        <span>Records</span>
                                    </a>
                            </li>
                        @endcan
                        @can('staff_attendance_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.staff-attendances.index") }}" class="nav-link {{ request()->is('admin/attendances') || request()->is('admin/attendances/*') ? 'active' : '' }}">
                                    <i class=" fas fa-id-card"></i>
                                        <span>Attendance</span>
                                    </a>
                            </li>
                        @endcan
                        @can('smr_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.smr.index') }}" class="nav-link {{ request()->is('admin/smr') || request()->is('admin/smr/*') ? 'active' : '' }}">
                                    <i class=" fas fa-clipboard-list"></i>
                                    <span>Movement Tracking</span>
                                </a>
                            </li>
                        @endcan
                        @can('staff_transfer_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.staff-transfer.index') }}" class="nav-link {{ request()->is('admin/staff-transfer') || request()->is('admin/staff-transfer/*') ? 'active' : '' }}">
                                    <i class=" fas fa-chalkboard-teacher"></i>
                                    <span>Transfer</span>
                                </a>
                            </li>
                        @endcan
                        @can('leave_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.leave.index') }}" class="nav-link {{ request()->is('admin/leave') || request()->is('admin/leave/*') ? 'active' : '' }}">
                                    <i class=" fas fa-walking">
                                    </i>
                                    <span>Leave</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <li class="nav-item sidebar-nav-item ">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class=" fas fa-user"></i>
                        <span>Students Management</span>
                    </a>
                    <ul class="nav sub-group-menu">
                        @can('staff_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.student-admissions.index') }}" class="nav-link {{ request()->is('admin/student-admissions') || request()->is('admin/student-admissions/*') ? 'active' : '' }}">
                                    <i class=" fas fa-user-circle"></i>
                                        <span>Students Admission</span>
                                    </a>
                            </li>
                        @endcan
                        @can('staff_attendance_access')
                            <li class="nav-item">
                                <a href="{{route('admin.attendances.index')}}" class="nav-link {{ request()->is('admin/staff-attendances') || request()->is('admin/staff-attendances/*') ? 'active' : '' }}">
                                    <i class=" fas fa-id-card"></i>
                                        <span>Attendance</span>
                                    </a>
                            </li>
                        @endcan
                        @can('student_transfer_access')
                            <li class="nav-item">
                                <a href="{{route('admin.transfer.index')}}" class="nav-link {{ request()->is('admin/transfer') || request()->is('admin/transfer/*') ? 'active' : '' }}">
                                    <i class=" fas fa-chalkboard-teacher"></i>
                                    <span>Transfer</span>
                                </a>
                            </li>
                        @endcan
                        @can('promotion_access')
                            <li class="nav-item">
                                <a href="{{route('admin.promotion.index')}}" class="nav-link {{ request()->is('admin/promotion') || request()->is('admin/promotion/*') ? 'active' : '' }}">
                                    <i class=" fas fa-walking">
                                    </i>
                                    <span>Promotion</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('asset_management_access')
                    <li class="nav-item sidebar-nav-item {{ request()->is('admin/asset-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/asset-locations*') ? 'menu-open' : '' }} {{ request()->is('admin/asset-statuses*') ? 'menu-open' : '' }} {{ request()->is('admin/assets*') ? 'menu-open' : '' }} {{ request()->is('admin/assets-histories*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="flaticon-list">

                            </i>
                           
                                <span>{{ trans('cruds.assetManagement.title') }}</span>
                                
                            
                        </a>
                        <ul class="nav sub-group-menu">
                            @can('asset_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-categories.index") }}" class="nav-link {{ request()->is('admin/asset-categories') || request()->is('admin/asset-categories/*') ? 'active' : '' }}">
                                        <i class=" fas fa-tags">

                                        </i>
                                       
                                            <span>{{ trans('cruds.assetCategory.title') }}</span>
                                        
                                    </a>
                                </li>
                            @endcan
                            @can('asset_location_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-locations.index") }}" class="nav-link {{ request()->is('admin/asset-locations') || request()->is('admin/asset-locations/*') ? 'active' : '' }}">
                                        <i class=" fas fa-map-marker">

                                        </i>
                                       
                                            <span>{{ trans('cruds.assetLocation.title') }}</span>
                                        
                                    </a>
                                </li>
                            @endcan
                            @can('asset_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.asset-statuses.index") }}" class="nav-link {{ request()->is('admin/asset-statuses') || request()->is('admin/asset-statuses/*') ? 'active' : '' }}">
                                        <i class=" fas fa-server">

                                        </i>
                                        
                                            <span>{{ trans('cruds.assetStatus.title') }}</span>
                                     
                                    </a>
                                </li>
                            @endcan
                            @can('asset_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.assets.index") }}" class="nav-link {{ request()->is('admin/assets') || request()->is('admin/assets/*') ? 'active' : '' }}">
                                        <i class=" fas fa-book">

                                        </i>
                                        
                                            <span>{{ trans('cruds.asset.title') }}</span>
                                        
                                    </a>
                                </li>
                            @endcan
                            @can('assets_history_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.assets-histories.index") }}" class="nav-link {{ request()->is('admin/assets-histories') || request()->is('admin/assets-histories/*') ? 'active' : '' }}">
                                        <i class=" fas fa-th-list">

                                        </i>
                                       
                                            <span>{{ trans('cruds.assetsHistory.title') }}</span>
                                       
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('expense_management_access')
                    <li class="nav-item sidebar-nav-item {{ request()->is('admin/expense-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/income-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/expenses*') ? 'menu-open' : '' }} {{ request()->is('admin/incomes*') ? 'menu-open' : '' }} {{ request()->is('admin/expense-reports*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class=" fas fa-money-bill"></i>
                             <span>{{ trans('cruds.expenseManagement.title') }}</span>
                        </a>
                        <ul class="nav sub-group-menu">
                            @can('expense_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expense-categories.index") }}" class="nav-link {{ request()->is('admin/expense-categories') || request()->is('admin/expense-categories/*') ? 'active' : '' }}">
                                        <i class=" fas fa-list"></i>
                                        <span>{{ trans('cruds.expenseCategory.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('income_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.income-categories.index") }}" class="nav-link {{ request()->is('admin/income-categories') || request()->is('admin/income-categories/*') ? 'active' : '' }}">
                                        <i class=" fas fa-list"></i>
                                        <span>{{ trans('cruds.incomeCategory.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('expense_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expenses.index") }}" class="nav-link {{ request()->is('admin/expenses') || request()->is('admin/expenses/*') ? 'active' : '' }}">
                                        <i class=" fas fa-arrow-circle-right"></i>
                                        <span>{{ trans('cruds.expense.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('income_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.incomes.index") }}" class="nav-link {{ request()->is('admin/incomes') || request()->is('admin/incomes/*') ? 'active' : '' }}">
                                        <i class=" fas fa-arrow-circle-right"></i>
                                        <span>{{ trans('cruds.income.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('expense_report_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.expense-reports.index") }}" class="nav-link {{ request()->is('admin/expense-reports') || request()->is('admin/expense-reports/*') ? 'active' : '' }}">
                                        <i class=" fas fa-chart-line"></i>
                                        <span>{{ trans('cruds.expenseReport.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('school_management_access')
                    <li class="nav-item sidebar-nav-item ">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class=" fas fa-money-bill"></i>
                             <span>School Management</span>
                        </a>
                        <ul class="nav sub-group-menu">
                            @can('school_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.schools.index") }}" class="nav-link {{ request()->is('admin/schools') || request()->is('admin/schools/*') ? 'active' : '' }}">
                                        <i class=" fas fa-list"></i>
                                        <span>Schools</span>
                                    </a>
                                </li>
                            @endcan
                            @if(Auth::User()->is_headTeacher)
                                <li class="nav-item">
                                    <a href="{{ route("admin.schools.background") }}" class="nav-link {{ request()->is('admin/schools/background') || request()->is('admin/schools/background/*') ? 'active' : '' }}">
                                        <i class=" fas fa-list"></i>
                                        <span>School Background</span>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route("admin.textbooks.index") }}" class="nav-link {{ request()->is('admin/textbooks') || request()->is('admin/textbooks/*') ? 'active' : '' }}">
                                    <i class=" fas fa-list"></i>
                                    <span>Textbooks</span>
                                </a>
                            </li>
                            @can('classroom_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.classrooms.index") }}" class="nav-link {{ request()->is('admin/classrooms') || request()->is('admin/classrooms/*') ? 'active' : '' }}">
                                        <i class=" fas fa-list"></i>
                                        <span>Classrooms</span>
                                    </a>
                                </li>
                            @endcan
                            @can('classroom_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.seatings.index") }}" class="nav-link {{ request()->is('admin/seatings') || request()->is('admin/seatings/*') ? 'active' : '' }}">
                                        <i class=" fas fa-list"></i>
                                        <span>Class Seating</span>
                                    </a>
                                </li>
                            @endcan
                            @can('toilet_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.toilets.index") }}" class="nav-link ">
                                        <i class=" fas fa-list"></i>
                                        <span>Toilets</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('lesson_management_access')
                    <li class="nav-item sidebar-nav-item ">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class=" fas fa-money-bill"></i>
                             <span>Lesson Management</span>
                        </a>
                        <ul class="nav sub-group-menu">
                            @can('manage_classes_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.classes.index") }}" class="nav-link {{ request()->is('admin/classes') || request()->is('admin/classes/*') ? 'active' : '' }}">
                                        <i class=" fas fa-list"></i>
                                        <span>Manage Classes</span>
                                    </a>
                                </li>
                            @endcan
                            @can('manage_subjects_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.subjects.index") }}" class="nav-link {{ request()->is('admin/subjects') || request()->is('admin/subjects/*') ? 'active' : '' }}">
                                        <i class=" fas fa-list"></i>
                                        <span>Manage Subjects</span>
                                    </a>
                                </li>
                            @endcan
                            @can('schedule_classes_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.classschedules.index") }}" class="nav-link {{ request()->is('admin/classschedules') || request()->is('admin/classschedules/*') ? 'active' : '' }}">
                                        <i class=" fas fa-list"></i>
                                        <span>Schedule Classes</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route("admin.lesson.attendance") }}" class="nav-link ">
                                        <i class=" fas fa-list"></i>
                                        <span>Take Attendance</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('incidence_reporting_access')
                <li class="nav-item sidebar-nav">
                    <a href="{{ route("admin.incidences.index") }}" class="nav-link ">
                        <i class="flaticon-books"></i>
                        <span>Incidence Reporting</span>
                    </a>
                </li>
                @endcan
                @can('parent_guardianregister_access')
                <li class="nav-item sidebar-nav">
                    <a href="{{ route("admin.parents.index") }}" class="nav-link ">
                        <i class="fas fa-user-alt"></i>
                        <span>{{ trans('cruds.parentGuardian.title') }}</span>
                    </a>
                </li>
                @endcan
                @can('contact_management_access')
                    <li class="nav-item sidebar-nav-item ">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class=" fas fa-money-bill"></i>
                             <span>Contact Management</span>
                        </a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="{{ route("admin.calls.index") }}" class="nav-link ">
                                    <i class=" fas fa-list"></i>
                                    <span>Call</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route("admin.voicecalls.index") }}" class="nav-link ">
                                    <i class=" fas fa-list"></i>
                                    <span>Voice Call</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('admin/messenger')}}" class="nav-link ">
                                    <i class=" fas fa-list"></i>
                                    <span>Send Internal Mail</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('admin/mailsms')}}" class="nav-link ">
                                    <i class=" fas fa-list"></i>
                                    <span>Send Email/SMS</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('admin/calltemplates')}}" class="nav-link ">
                                    <i class=" fas fa-list"></i>
                                    <span>Voice Call Templates</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('admin/mailsmstemplates')}}" class="nav-link ">
                                    <i class=" fas fa-list"></i>
                                    <span>Email/SMS Templates</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('reports_access')
                <li class="nav-item sidebar-nav">
                    <a href="{{ route("admin.reports.index") }}" class="nav-link {{ request()->is('admin/parents') || request()->is('admin/parents/*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard"></i>
                        <span>Reports</span>
                    </a>
                </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item sidebar-nav-item {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }} {{ request()->is('admin/audit-logs*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link"><i class="flaticon-user"></i>
                            <span>{{ trans('cruds.userManagement.title') }}</span>
                        </a>
                        <ul class="nav sub-group-menu {{ request()->is('admin/permissions*') ? 'sub-group-active' : '' }} {{ request()->is('admin/roles*') ? 'sub-group-active' : '' }} {{ request()->is('admin/users*') ? 'sub-group-active' : '' }} {{ request()->is('admin/audit-logs*') ? 'sub-group-active' : '' }}">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'menu-active' : '' }}">
                                        <i class=" fas fa-unlock-alt"></i>
                                        <span>{{ trans('cruds.permission.title') }}</span>
                                       
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'menu-active' : '' }}">
                                        <i class=" fas fa-briefcase">

                                        </i>
                                       
                                            <span>{{ trans('cruds.role.title') }}</span>
                                      
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'menu-active' : '' }}">
                                        <i class=" fas fa-user">

                                        </i>
                                       
                                            <span>{{ trans('cruds.user.title') }}</span>
                                      
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'menu-active' : '' }}">
                                        <i class=" fas fa-file-alt">

                                        </i>
                                        
                                            <span>{{ trans('cruds.auditLog.title') }}</span>
                                        
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('task_management_access')
                    <li class="nav-item sidebar-nav-item {{ request()->is('admin/task-statuses*') ? 'menu-open' : '' }} {{ request()->is('admin/task-tags*') ? 'menu-open' : '' }} {{ request()->is('admin/tasks*') ? 'menu-open' : '' }} {{ request()->is('admin/tasks-calendars*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class=" fas fa-list">

                            </i>
                            
                                <span>{{ trans('cruds.taskManagement.title') }}</span>
                                
                            
                        </a>
                        <ul class="nav sub-group-menu">
                            @can('task_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-statuses.index") }}" class="nav-link {{ request()->is('admin/task-statuses') || request()->is('admin/task-statuses/*') ? 'active' : '' }}">
                                        <i class=" fas fa-server">

                                        </i>
                                       
                                            <span>{{ trans('cruds.taskStatus.title') }}</span>
                                        
                                    </a>
                                </li>
                            @endcan
                            @can('task_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-tags.index") }}" class="nav-link {{ request()->is('admin/task-tags') || request()->is('admin/task-tags/*') ? 'active' : '' }}">
                                        <i class=" fas fa-server">

                                        </i>
                                        
                                            <span>{{ trans('cruds.taskTag.title') }}</span>
                                        
                                    </a>
                                </li>
                            @endcan
                            @can('task_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks.index") }}" class="nav-link {{ request()->is('admin/tasks') || request()->is('admin/tasks/*') ? 'active' : '' }}">
                                        <i class=" fas fa-briefcase">

                                        </i>
                                       
                                            <span>{{ trans('cruds.task.title') }}</span>
                                        
                                    </a>
                                </li>
                            @endcan
                            @can('tasks_calendar_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks-calendars.index") }}" class="nav-link {{ request()->is('admin/tasks-calendars') || request()->is('admin/tasks-calendars/*') ? 'active' : '' }}">
                                        <i class=" fas fa-calendar">

                                        </i>
                                        
                                            <span>{{ trans('cruds.tasksCalendar.title') }}</span>
                                       
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('nomenclature_management_access')
                    <li class="nav-item sidebar-nav-item {{ request()->is('admin/tables*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="{{ route("admin.nomenclatures.index") }}">
                            <i class=" fas fa-edit"></i>
                            <span>{{ trans('cruds.nomenclatureManagement.title') }}</span>
                        </a>
                    </li>
                @endcan
                <!-- @can('contact_management_access')
                    <li class="nav-item sidebar-nav-item {{ request()->is('admin/contact-companies*') ? 'menu-open' : '' }} {{ request()->is('admin/contact-contacts*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class=" fas fa-phone-square"></i>
                            <span>{{ trans('cruds.contactManagement.title') }}</span>
                        </a>
                        <ul class="nav sub-group-menu">
                            @can('contact_company_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.contact-companies.index") }}" class="nav-link {{ request()->is('admin/contact-companies') || request()->is('admin/contact-companies/*') ? 'active' : '' }}">
                                        <i class=" fas fa-building"></i>
                                        <span>{{ trans('cruds.contactCompany.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('contact_contact_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.contact-contacts.index") }}" class="nav-link {{ request()->is('admin/contact-contacts') || request()->is('admin/contact-contacts/*') ? 'active' : '' }}">
                                        <i class=" fas fa-user-plus"></i>
                                        <span>{{ trans('cruds.contactContact.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('content_management_access')
                    <li class="nav-item sidebar-nav-item {{ request()->is('admin/content-categories*') ? 'menu-open' : '' }} {{ request()->is('admin/content-tags*') ? 'menu-open' : '' }} {{ request()->is('admin/content-pages*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class=" fas fa-book"></i>
                            <span>{{ trans('cruds.contentManagement.title') }}</span>
                        </a>
                        <ul class="nav sub-group-menu">
                            @can('content_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-categories.index") }}" class="nav-link {{ request()->is('admin/content-categories') || request()->is('admin/content-categories/*') ? 'active' : '' }}">
                                        <i class=" fas fa-folder"></i>
                                       <span>{{ trans('cruds.contentCategory.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('content_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-tags.index") }}" class="nav-link {{ request()->is('admin/content-tags') || request()->is('admin/content-tags/*') ? 'active' : '' }}">
                                        <i class=" fas fa-tags"></i>
                                        <span>{{ trans('cruds.contentTag.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @can('content_page_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-pages.index") }}" class="nav-link {{ request()->is('admin/content-pages') || request()->is('admin/content-pages/*') ? 'active' : '' }}">
                                        <i class=" fas fa-file"></i>
                                        <span>{{ trans('cruds.contentPage.title') }}</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan -->
            </ul>
    </div>
</div>