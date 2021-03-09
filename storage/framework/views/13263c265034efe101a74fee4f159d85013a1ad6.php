<?php $__env->startSection('content'); ?>
<div class="content">
<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.view')); ?> <?php echo e('Staff Leave'); ?>

    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.leave.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
            <?php if($leave->status != 1): ?>
            <div class="form-group">
                <a class="btn btn-success" href="<?php echo e(route('admin.leave.approve', $leave->id)); ?>">
                    Approve Leave
                </a>
            </div>
            <?php endif; ?>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Staff
                        </th>                        
                        <td>
                            <?php echo e($leave->staff->first_name); ?> <?php echo e($leave->staff->middle_name); ?> <?php echo e($leave->staff->last_name); ?> - <?php echo e($leave->staff->staff_id ?? ''); ?>

                        </td>                                                
                    </tr>
                    <tr>
                        <th>
                            Contact Number
                        </th>                        
                        <td>
                            <?php echo e($leave -> contact_number); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Address
                        </th>                        
                        <td>
                            <?php echo e($leave -> address); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Start Date
                        </th>                        
                        <td>
                            <?php echo e($leave -> start_date); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            End Date
                        </th>                        
                        <td>
                            <?php echo e($leave -> end_date); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Leave Type
                        </th>                        
                        <td>
                            <?php echo e(App\Leave::LEAVE_TYPE [$leave -> leave_type]); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Number of Days
                        </th>                        
                        <td>
                            <?php echo e($leave -> number_of_days); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Status
                        </th>                        
                        <td>
                            <?php if(isset($leave->status)): ?> <?php echo e(App\Leave::STATUS_SELECT [$leave->status]); ?> <?php else: ?> Not Approved <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Remark
                        </th>                        
                        <td>
                            <?php echo e($leave -> remark); ?>

                        </td>
                    </tr>            
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="<?php echo e(route('admin.leave.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
                </button>
            </div>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/leave/show.blade.php ENDPATH**/ ?>