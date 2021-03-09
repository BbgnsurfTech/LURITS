<?php $__env->startSection('content'); ?>
<section class="content">
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3><?php echo e(trans('global.add')); ?> New Toilet</h3>
            </div>
        </div>
        <form class="new-added-form" method="POST" action="<?php echo e(route("admin.toilets.store")); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
        <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="year">Year of construction</label>
                <input class="form-control <?php echo e($errors->has('year') ? 'is-invalid' : ''); ?>" type="number" name="year" id="year" value="<?php echo e(old('year')); ?>" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.year_helper')); ?></span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">Condition</label>
                <select class="form-control <?php echo e($errors->has('condition') ? 'is-invalid' : ''); ?>" name="condition" id="condition" required>
                    <option value disabled <?php echo e(old('condition', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($condition->id); ?>" <?php echo e(old('condition', '255') === (string) $condition->id ? 'selected' : ''); ?>><?php echo e($condition->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">Usablity</label>
                <select class="form-control <?php echo e($errors->has('user_toilet') ? 'is-invalid' : ''); ?>" name="user_toilet" id="user_toilet" required>
                    <option value disabled <?php echo e(old('user_toilet', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $ds_user_toilet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_toilet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user_toilet->id); ?>" <?php echo e(old('user_toilet', '255') === (string) $user_toilet->id ? 'selected' : ''); ?>><?php echo e($user_toilet->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">Type</label>
                <select class="form-control <?php echo e($errors->has('toilet_type') ? 'is-invalid' : ''); ?>" name="toilet_type" id="toilet_type" required>
                    <option value disabled <?php echo e(old('toilet_type', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $ds_toilet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toilet_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($toilet_type->id); ?>" <?php echo e(old('toilet_type', '255') === (string) $toilet_type->id ? 'selected' : ''); ?>><?php echo e($toilet_type->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">Toilet Usage</label>
                <select class="form-control <?php echo e($errors->has('toilet_usage') ? 'is-invalid' : ''); ?>" name="toilet_usage" id="toilet_usage" required>
                    <option value disabled <?php echo e(old('toilet_usage', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $ds_toilet_usage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toilet_usage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($toilet_usage->id); ?>" <?php echo e(old('toilet_usage', '255') === (string) $toilet_usage->id ? 'selected' : ''); ?>><?php echo e($toilet_usage->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-12 form-group">
            <button class="btn btn-primary btn-lg" type="submit">
                <?php echo e(trans('global.save')); ?>

            </button>
        </div>
        </form>
    </div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script src="<?php echo e(asset('js/filter.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/toilet/create.blade.php ENDPATH**/ ?>