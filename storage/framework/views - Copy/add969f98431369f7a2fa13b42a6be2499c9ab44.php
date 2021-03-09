<div class="dashboard-page-one">
    <!-- Sidebar Area Start Here -->
    <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
       <div class="mobile-sidebar-header d-md-none">
            <div class="header-logo">
                <a href="<?php echo e(route("admin.home")); ?>"><img src="<?php echo e(asset('img/logo1.png')); ?>" alt="logo"></a>
            </div>
        </div>
        <div class="sidebar-menu-content">
            <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                <li class="nav-item sidebar-nav">
                    <a href="<?php echo e(route("admin.home")); ?>" class="nav-link"><i class="flaticon-dashboard"></i><span><?php echo e(trans('global.dashboard')); ?></span></a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('records_management_access')): ?>
                <li class="nav-item sidebar-nav">
                    <a href="<?php echo e(route("admin.records-managements.index")); ?>" class="nav-link <?php echo e(request()->is('admin/records-managements') || request()->is('admin/records-managements/*') ? 'active' : ''); ?>">
                        <i class="flaticon-books"></i>
                        <span><?php echo e(trans('cruds.recordsManagement.title')); ?></span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('school_management_access')): ?>
                <li class="nav-item sidebar-nav-item <?php echo e(request()->is('admin/staffs*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/attendances*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/smr*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/staff-transfer*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/leave*') ? 'menu-open' : ''); ?>">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class=" fas fa-school"></i>
                        <span>Staff Management</span>
                    </a>
                    <ul class="nav sub-group-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staff_access')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route("admin.staffs.index")); ?>" class="nav-link <?php echo e(request()->is('admin/staffs') || request()->is('admin/staffs/*') ? 'active' : ''); ?>">
                                    <i class=" fas fa-user-circle"></i>
                                        <span>Records</span>
                                    </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staff_attendance_access')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route("admin.staff-attendances.index")); ?>" class="nav-link <?php echo e(request()->is('admin/attendances') || request()->is('admin/attendances/*') ? 'active' : ''); ?>">
                                    <i class=" fas fa-id-card"></i>
                                        <span>Attendance</span>
                                    </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('smr_access')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.smr.index')); ?>" class="nav-link <?php echo e(request()->is('admin/smr') || request()->is('admin/smr/*') ? 'active' : ''); ?>">
                                    <i class=" fas fa-clipboard-list"></i>
                                    <span>Movement Tracking</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staff_transfer_access')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.staff-transfer.index')); ?>" class="nav-link <?php echo e(request()->is('admin/staff-transfer') || request()->is('admin/staff-transfer/*') ? 'active' : ''); ?>">
                                    <i class=" fas fa-chalkboard-teacher"></i>
                                    <span>Transfer</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leave_access')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.leave.index')); ?>" class="nav-link <?php echo e(request()->is('admin/leave') || request()->is('admin/leave/*') ? 'active' : ''); ?>">
                                    <i class=" fas fa-walking">
                                    </i>
                                    <span>Leave</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item sidebar-nav-item ">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class=" fas fa-user"></i>
                        <span>Students Management</span>
                    </a>
                    <ul class="nav sub-group-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staff_access')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.student-admissions.index')); ?>" class="nav-link <?php echo e(request()->is('admin/student-admissions') || request()->is('admin/student-admissions/*') ? 'active' : ''); ?>">
                                    <i class=" fas fa-user-circle"></i>
                                        <span>Students Admission</span>
                                    </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staff_attendance_access')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.attendances.index')); ?>" class="nav-link <?php echo e(request()->is('admin/staff-attendances') || request()->is('admin/staff-attendances/*') ? 'active' : ''); ?>">
                                    <i class=" fas fa-id-card"></i>
                                        <span>Attendance</span>
                                    </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('student_transfer_access')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.transfer.index')); ?>" class="nav-link <?php echo e(request()->is('admin/transfer') || request()->is('admin/transfer/*') ? 'active' : ''); ?>">
                                    <i class=" fas fa-chalkboard-teacher"></i>
                                    <span>Transfer</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('promotion_access')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.promotion.index')); ?>" class="nav-link <?php echo e(request()->is('admin/promotion') || request()->is('admin/promotion/*') ? 'active' : ''); ?>">
                                    <i class=" fas fa-walking">
                                    </i>
                                    <span>Promotion</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('asset_management_access')): ?>
                    <li class="nav-item sidebar-nav-item <?php echo e(request()->is('admin/asset-categories*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/asset-locations*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/asset-statuses*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/assets*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/assets-histories*') ? 'menu-open' : ''); ?>">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="flaticon-list">

                            </i>
                           
                                <span><?php echo e(trans('cruds.assetManagement.title')); ?></span>
                                
                            
                        </a>
                        <ul class="nav sub-group-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('asset_category_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.asset-categories.index")); ?>" class="nav-link <?php echo e(request()->is('admin/asset-categories') || request()->is('admin/asset-categories/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-tags">

                                        </i>
                                       
                                            <span><?php echo e(trans('cruds.assetCategory.title')); ?></span>
                                        
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('asset_location_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.asset-locations.index")); ?>" class="nav-link <?php echo e(request()->is('admin/asset-locations') || request()->is('admin/asset-locations/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-map-marker">

                                        </i>
                                       
                                            <span><?php echo e(trans('cruds.assetLocation.title')); ?></span>
                                        
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('asset_status_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.asset-statuses.index")); ?>" class="nav-link <?php echo e(request()->is('admin/asset-statuses') || request()->is('admin/asset-statuses/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-server">

                                        </i>
                                        
                                            <span><?php echo e(trans('cruds.assetStatus.title')); ?></span>
                                     
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('asset_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.assets.index")); ?>" class="nav-link <?php echo e(request()->is('admin/assets') || request()->is('admin/assets/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-book">

                                        </i>
                                        
                                            <span><?php echo e(trans('cruds.asset.title')); ?></span>
                                        
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('assets_history_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.assets-histories.index")); ?>" class="nav-link <?php echo e(request()->is('admin/assets-histories') || request()->is('admin/assets-histories/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-th-list">

                                        </i>
                                       
                                            <span><?php echo e(trans('cruds.assetsHistory.title')); ?></span>
                                       
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_management_access')): ?>
                    <li class="nav-item sidebar-nav-item <?php echo e(request()->is('admin/expense-categories*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/income-categories*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/expenses*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/incomes*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/expense-reports*') ? 'menu-open' : ''); ?>">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class=" fas fa-money-bill"></i>
                             <span><?php echo e(trans('cruds.expenseManagement.title')); ?></span>
                        </a>
                        <ul class="nav sub-group-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_category_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.expense-categories.index")); ?>" class="nav-link <?php echo e(request()->is('admin/expense-categories') || request()->is('admin/expense-categories/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-list"></i>
                                        <span><?php echo e(trans('cruds.expenseCategory.title')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('income_category_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.income-categories.index")); ?>" class="nav-link <?php echo e(request()->is('admin/income-categories') || request()->is('admin/income-categories/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-list"></i>
                                        <span><?php echo e(trans('cruds.incomeCategory.title')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.expenses.index")); ?>" class="nav-link <?php echo e(request()->is('admin/expenses') || request()->is('admin/expenses/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-arrow-circle-right"></i>
                                        <span><?php echo e(trans('cruds.expense.title')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('income_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.incomes.index")); ?>" class="nav-link <?php echo e(request()->is('admin/incomes') || request()->is('admin/incomes/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-arrow-circle-right"></i>
                                        <span><?php echo e(trans('cruds.income.title')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_report_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.expense-reports.index")); ?>" class="nav-link <?php echo e(request()->is('admin/expense-reports') || request()->is('admin/expense-reports/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-chart-line"></i>
                                        <span><?php echo e(trans('cruds.expenseReport.title')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('school_management_access')): ?>
                    <li class="nav-item sidebar-nav-item ">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class=" fas fa-money-bill"></i>
                             <span>School Management</span>
                        </a>
                        <ul class="nav sub-group-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('school_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.schools.index")); ?>" class="nav-link <?php echo e(request()->is('admin/schools') || request()->is('admin/schools/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-list"></i>
                                        <span>Schools</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(Auth::User()->is_headTeacher): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.schools.background")); ?>" class="nav-link <?php echo e(request()->is('admin/schools/background') || request()->is('admin/schools/background/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-list"></i>
                                        <span>School Background</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('classroom_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.classrooms.index")); ?>" class="nav-link <?php echo e(request()->is('admin/classrooms') || request()->is('admin/classrooms/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-list"></i>
                                        <span>Classrooms</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lesson_management_access')): ?>
                    <li class="nav-item sidebar-nav-item ">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class=" fas fa-money-bill"></i>
                             <span>Lesson Management</span>
                        </a>
                        <ul class="nav sub-group-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_classes_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.classes.index")); ?>" class="nav-link <?php echo e(request()->is('admin/classes') || request()->is('admin/classes/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-list"></i>
                                        <span>Manage Classes</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage_subjects_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.classrooms.index")); ?>" class="nav-link <?php echo e(request()->is('admin/classrooms') || request()->is('admin/classrooms/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-list"></i>
                                        <span>Manage Subjects</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('schedule_classes_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.classrooms.index")); ?>" class="nav-link <?php echo e(request()->is('admin/classrooms') || request()->is('admin/classrooms/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-list"></i>
                                        <span>Schedule Classes</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.classrooms.index")); ?>" class="nav-link <?php echo e(request()->is('admin/classrooms') || request()->is('admin/classrooms/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-list"></i>
                                        <span>Take Attendance</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_management_access')): ?>
                    <li class="nav-item sidebar-nav-item <?php echo e(request()->is('admin/permissions*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/roles*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/users*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/audit-logs*') ? 'menu-open' : ''); ?>">
                        <a href="#" class="nav-link"><i class="flaticon-user"></i>
                            <span><?php echo e(trans('cruds.userManagement.title')); ?></span>
                        </a>
                        <ul class="nav sub-group-menu <?php echo e(request()->is('admin/permissions*') ? 'sub-group-active' : ''); ?> <?php echo e(request()->is('admin/roles*') ? 'sub-group-active' : ''); ?> <?php echo e(request()->is('admin/users*') ? 'sub-group-active' : ''); ?> <?php echo e(request()->is('admin/audit-logs*') ? 'sub-group-active' : ''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.permissions.index")); ?>" class="nav-link <?php echo e(request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'menu-active' : ''); ?>">
                                        <i class=" fas fa-unlock-alt"></i>
                                        <span><?php echo e(trans('cruds.permission.title')); ?></span>
                                       
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.roles.index")); ?>" class="nav-link <?php echo e(request()->is('admin/roles') || request()->is('admin/roles/*') ? 'menu-active' : ''); ?>">
                                        <i class=" fas fa-briefcase">

                                        </i>
                                       
                                            <span><?php echo e(trans('cruds.role.title')); ?></span>
                                      
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.users.index")); ?>" class="nav-link <?php echo e(request()->is('admin/users') || request()->is('admin/users/*') ? 'menu-active' : ''); ?>">
                                        <i class=" fas fa-user">

                                        </i>
                                       
                                            <span><?php echo e(trans('cruds.user.title')); ?></span>
                                      
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('audit_log_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.audit-logs.index")); ?>" class="nav-link <?php echo e(request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'menu-active' : ''); ?>">
                                        <i class=" fas fa-file-alt">

                                        </i>
                                        
                                            <span><?php echo e(trans('cruds.auditLog.title')); ?></span>
                                        
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('records_management_access')): ?>
                <li class="nav-item sidebar-nav">
                    <a href="<?php echo e(route("admin.parents.index")); ?>" class="nav-link <?php echo e(request()->is('admin/parents') || request()->is('admin/parents/*') ? 'active' : ''); ?>">
                        <i class="fas fa-user-alt"></i>
                        <span><?php echo e(trans('cruds.parentGuardian.title')); ?></span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reports_access')): ?>
                <li class="nav-item sidebar-nav">
                    <a href="<?php echo e(route("admin.reports.index")); ?>" class="nav-link <?php echo e(request()->is('admin/parents') || request()->is('admin/parents/*') ? 'active' : ''); ?>">
                        <i class="fas fa-clipboard"></i>
                        <span>Reports</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task_management_access')): ?>
                    <li class="nav-item sidebar-nav-item <?php echo e(request()->is('admin/task-statuses*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/task-tags*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/tasks*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/tasks-calendars*') ? 'menu-open' : ''); ?>">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class=" fas fa-list">

                            </i>
                            
                                <span><?php echo e(trans('cruds.taskManagement.title')); ?></span>
                                
                            
                        </a>
                        <ul class="nav sub-group-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task_status_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.task-statuses.index")); ?>" class="nav-link <?php echo e(request()->is('admin/task-statuses') || request()->is('admin/task-statuses/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-server">

                                        </i>
                                       
                                            <span><?php echo e(trans('cruds.taskStatus.title')); ?></span>
                                        
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task_tag_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.task-tags.index")); ?>" class="nav-link <?php echo e(request()->is('admin/task-tags') || request()->is('admin/task-tags/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-server">

                                        </i>
                                        
                                            <span><?php echo e(trans('cruds.taskTag.title')); ?></span>
                                        
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('task_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.tasks.index")); ?>" class="nav-link <?php echo e(request()->is('admin/tasks') || request()->is('admin/tasks/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-briefcase">

                                        </i>
                                       
                                            <span><?php echo e(trans('cruds.task.title')); ?></span>
                                        
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tasks_calendar_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.tasks-calendars.index")); ?>" class="nav-link <?php echo e(request()->is('admin/tasks-calendars') || request()->is('admin/tasks-calendars/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-calendar">

                                        </i>
                                        
                                            <span><?php echo e(trans('cruds.tasksCalendar.title')); ?></span>
                                       
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('nomenclature_management_access')): ?>
                    <li class="nav-item sidebar-nav-item <?php echo e(request()->is('admin/tables*') ? 'menu-open' : ''); ?>">
                        <a class="nav-link nav-dropdown-toggle" href="<?php echo e(route("admin.nomenclatures.index")); ?>">
                            <i class=" fas fa-edit"></i>
                            <span><?php echo e(trans('cruds.nomenclatureManagement.title')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact_management_access')): ?>
                    <li class="nav-item sidebar-nav-item <?php echo e(request()->is('admin/contact-companies*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/contact-contacts*') ? 'menu-open' : ''); ?>">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class=" fas fa-phone-square"></i>
                            <span><?php echo e(trans('cruds.contactManagement.title')); ?></span>
                        </a>
                        <ul class="nav sub-group-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact_company_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.contact-companies.index")); ?>" class="nav-link <?php echo e(request()->is('admin/contact-companies') || request()->is('admin/contact-companies/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-building"></i>
                                        <span><?php echo e(trans('cruds.contactCompany.title')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contact_contact_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.contact-contacts.index")); ?>" class="nav-link <?php echo e(request()->is('admin/contact-contacts') || request()->is('admin/contact-contacts/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-user-plus"></i>
                                        <span><?php echo e(trans('cruds.contactContact.title')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('content_management_access')): ?>
                    <li class="nav-item sidebar-nav-item <?php echo e(request()->is('admin/content-categories*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/content-tags*') ? 'menu-open' : ''); ?> <?php echo e(request()->is('admin/content-pages*') ? 'menu-open' : ''); ?>">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class=" fas fa-book"></i>
                            <span><?php echo e(trans('cruds.contentManagement.title')); ?></span>
                        </a>
                        <ul class="nav sub-group-menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('content_category_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.content-categories.index")); ?>" class="nav-link <?php echo e(request()->is('admin/content-categories') || request()->is('admin/content-categories/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-folder"></i>
                                       <span><?php echo e(trans('cruds.contentCategory.title')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('content_tag_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.content-tags.index")); ?>" class="nav-link <?php echo e(request()->is('admin/content-tags') || request()->is('admin/content-tags/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-tags"></i>
                                        <span><?php echo e(trans('cruds.contentTag.title')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('content_page_access')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route("admin.content-pages.index")); ?>" class="nav-link <?php echo e(request()->is('admin/content-pages') || request()->is('admin/content-pages/*') ? 'active' : ''); ?>">
                                        <i class=" fas fa-file"></i>
                                        <span><?php echo e(trans('cruds.contentPage.title')); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
    </div>
</div><?php /**PATH /Users/mac/Project/DataStamp-LURITS_QA/resources/views/partials/menu.blade.php ENDPATH**/ ?>