<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.show')); ?> <?php echo e('Staff Movement Record'); ?>

    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.smr.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Staff
                        </th>                        
                        <td>
                            <?php echo e($smr->staff->first_name); ?>

                            <?php echo e($smr->staff->middle_name); ?>

                            <?php echo e($smr->staff->last_name); ?>

                        </td>                                                
                    </tr>    
                    <tr>
                        <th>
                            Date
                        </th>                        
                        <td>
                            <?php echo e($smr -> date); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Contact Number
                        </th>                        
                        <td>
                            <?php echo e($smr -> contact_number); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Purpose
                        </th>                        
                        <td>
                            <?php echo e($smr -> purpose); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Time Out
                        </th>                        
                        <td>
                            <?php echo e($smr -> time_out); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Time Back
                        </th>                        
                        <td>
                            <?php echo e($smr -> time_back); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Head Teacher's Approval
                        </th>                        
                        <td>
                            <?php echo e(App\StaffMovementRecord::HT_APPROVAL [$smr -> ht_approval]); ?>

                        </td>
                    </tr>            
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="<?php echo e(route('admin.smr.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
                </button>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/smr/show.blade.php ENDPATH**/ ?>