<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.show')); ?> <?php echo e(trans('cruds.parentGuardianregister.title')); ?>

    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.parents.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.parentGuardianregister.fields.id')); ?>

                        </th>
                        <td>
                            <?php echo e($parentGuardianregister->id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.parentGuardianregister.fields.first_name')); ?>

                        </th>
                        <td>
                            <?php echo e($parentGuardianregister->first_name); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.parentGuardianregister.fields.middle_name')); ?>

                        </th>
                        <td>
                            <?php echo e($parentGuardianregister->middle_name); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.parentGuardianregister.fields.last_name')); ?>

                        </th>
                        <td>
                            <?php echo e($parentGuardianregister->last_name); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.parentGuardianregister.fields.email')); ?>

                        </th>
                        <td>
                            <?php echo e($parentGuardianregister->email); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.parentGuardianregister.fields.phone_number')); ?>

                        </th>
                        <td>
                            <?php echo e($parentGuardianregister->phone_number); ?>

                        </td>
                    </tr>
                
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.parents.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
        </div>
    </div>
</div>

<!--  -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/parentGuardianregisters/show.blade.php ENDPATH**/ ?>