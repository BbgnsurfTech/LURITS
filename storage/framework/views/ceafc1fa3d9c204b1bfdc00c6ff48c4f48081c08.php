<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.show')); ?> <?php echo e(trans('cruds.expense.title')); ?>

    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.expenses.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
                 <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staff_edit')): ?>
                <a class="btn btn-info" href="<?php echo e(route('admin.expenses.edit', $expense->id)); ?>">
                    <?php echo e(trans('global.edit')); ?>

                </a>
            <?php endif; ?>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.expense.fields.id')); ?>

                        </th>
                        <td>
                            <?php echo e($expense->id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.expense.fields.expense_category')); ?>

                        </th>
                        <td>
                            <?php echo e($expense->expense_category->name ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.expense.fields.entry_date')); ?>

                        </th>
                        <td>
                            <?php echo e($expense->entry_date); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.expense.fields.amount')); ?>

                        </th>
                        <td>
                            <?php echo e($expense->amount); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.expense.fields.description')); ?>

                        </th>
                        <td>
                            <?php echo e($expense->description); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e('Beneficiary'); ?>

                        </th>
                        <td>
                            <?php echo e($expense->beneficiary); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e('Issued Cheque Number'); ?>

                        </th>
                        <td>
                            <?php echo e($expense->issued_cheque_no); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e('Balance as at'); ?>

                        </th>
                        <td>
                            <?php echo e($expense->balance_as_at); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e('Name of Authorizing Individual'); ?>

                        </th>
                        <td>
                            <?php echo e($expense->name_of_authorizing_individual); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e('Funds Out'); ?>

                        </th>
                        <td>
                            <?php echo e($expense->funds_out); ?>

                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.expenses.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/expenses/show.blade.php ENDPATH**/ ?>