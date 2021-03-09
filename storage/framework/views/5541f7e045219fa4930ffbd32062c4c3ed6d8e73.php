<?php $__env->startSection('content'); ?>
<section class="content">
    <div class="card">
    <div class="card-header">
        <?php echo e(trans('global.create')); ?> <?php echo e(trans('cruds.expense.title_singular')); ?>

    </div>

    <div class="card-body">
        <form method="POST" action="<?php echo e(route("admin.expenses.store")); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="form-group">
                <label for="expense_category_id"><?php echo e(trans('cruds.expense.fields.expense_category')); ?></label>
                <select class="form-control select2 <?php echo e($errors->has('expense_category') ? 'is-invalid' : ''); ?>" name="expense_category_id" id="expense_category_id" required>
                    <?php $__currentLoopData = $expense_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $expense_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('expense_category_id') == $id ? 'selected' : ''); ?>><?php echo e($expense_category); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.expense.fields.expense_category_helper')); ?></span>
            </div>
            <div class="form-group">
                <label class="required" for="entry_date"><?php echo e(trans('cruds.expense.fields.entry_date')); ?></label>
                <input class="form-control date <?php echo e($errors->has('entry_date') ? 'is-invalid' : ''); ?>" type="text" name="entry_date" id="entry_date" value="<?php echo e(old('entry_date')); ?>" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.expense.fields.entry_date_helper')); ?></span>
            </div>
            <div class="form-group">
                <label class="required" for="amount"><?php echo e(trans('cruds.expense.fields.amount')); ?></label>
                <input class="form-control <?php echo e($errors->has('amount') ? 'is-invalid' : ''); ?>" type="number" name="amount" id="amount" value="<?php echo e(old('amount')); ?>" step="0.01" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.expense.fields.amount_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="description"><?php echo e(trans('cruds.expense.fields.description')); ?></label>
                <input class="form-control <?php echo e($errors->has('description') ? 'is-invalid' : ''); ?>" type="text" name="description" id="description" value="<?php echo e(old('description', '')); ?>">
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.expense.fields.description_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="beneficiary"><?php echo e('Beneficiary'); ?></label>
                <input class="form-control <?php echo e($errors->has('beneficiary') ? 'is-invalid' : ''); ?>" type="text" name="beneficiary" id="beneficiary" value="<?php echo e(old('beneficiary', '')); ?>">
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.expense.fields.description_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="issued_cheque_no"><?php echo e('Issued Cheque Number'); ?></label>
                <input class="form-control <?php echo e($errors->has('issued_cheque_no') ? 'is-invalid' : ''); ?>" type="text" name="issued_cheque_no" id="issued_cheque_no" value="<?php echo e(old('issued_cheque_no', '')); ?>">
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.expense.fields.description_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="balance_as_at"><?php echo e('Balance As At'); ?></label>
                <input class="form-control <?php echo e($errors->has('balance_as_at') ? 'is-invalid' : ''); ?>" type="text" name="balance_as_at" id="balance_as_at" value="<?php echo e(old('balance_as_at', '')); ?>">
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.expense.fields.description_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="name_of_authorizing_individual"><?php echo e('Name of Authorizing Individual'); ?></label>
                <input class="form-control <?php echo e($errors->has('name_of_authorizing_individual') ? 'is-invalid' : ''); ?>" type="text" name="name_of_authorizing_individual" id="name_of_authorizing_individual" value="<?php echo e(old('name_of_authorizing_individual', '')); ?>">
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.expense.fields.description_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="funds_out"><?php echo e('Funds Out'); ?></label>
                <input class="form-control <?php echo e($errors->has('funds_out') ? 'is-invalid' : ''); ?>" type="text" name="funds_out" id="funds_out" value="<?php echo e(old('funds_out', '')); ?>">
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.expense.fields.description_helper')); ?></span>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    <?php echo e(trans('global.save')); ?>

                </button>
            </div>
        </form>
    </div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php if(Auth::User()->is_superAdmin || Auth::User()->is_admin || Auth::User()->is_zeqa): ?>
<script src="<?php echo e(asset('js/filter.js')); ?>"></script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/expenses/create.blade.php ENDPATH**/ ?>