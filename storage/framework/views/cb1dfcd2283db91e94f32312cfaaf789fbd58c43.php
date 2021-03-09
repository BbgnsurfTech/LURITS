<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.show')); ?> <?php echo e(trans('cruds.auditLog.title')); ?>

    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.audit-logs.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.auditLog.fields.id')); ?>

                        </th>
                        <td>
                            <?php echo e($auditLog->id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.auditLog.fields.description')); ?>

                        </th>
                        <td>
                            <?php echo e($auditLog->description); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.auditLog.fields.subject_id')); ?>

                        </th>
                        <td>
                            <?php echo e($auditLog->subject_id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.auditLog.fields.subject_type')); ?>

                        </th>
                        <td>
                            <?php echo e($auditLog->subject_type); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.auditLog.fields.user_id')); ?>

                        </th>
                        <td>
                            <?php echo e($auditLog->user_id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.auditLog.fields.properties')); ?>

                        </th>
                        <td>
                            <?php echo e($auditLog->properties); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.auditLog.fields.host')); ?>

                        </th>
                        <td>
                            <?php echo e($auditLog->host); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.auditLog.fields.created_at')); ?>

                        </th>
                        <td>
                            <?php echo e($auditLog->created_at); ?>

                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.audit-logs.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/auditLogs/show.blade.php ENDPATH**/ ?>