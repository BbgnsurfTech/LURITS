<?php $__env->startSection('content'); ?>
<section class="content">
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3><?php echo e(trans('global.add')); ?> <?php echo e('New'); ?> <?php echo e(trans('cruds.classroom.title_singular')); ?></h3>
            </div>
        </div>
        <form class="new-added-form" method="POST" action="<?php echo e(route("admin.classrooms.store")); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
        <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="capacity"><?php echo e(trans('cruds.classroom.fields.capacity')); ?></label>
                <input class="form-control <?php echo e($errors->has('capacity') ? 'is-invalid' : ''); ?>" type="number" name="capacity" id="capacity" value="<?php echo e(old('capacity')); ?>" step="1" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.capacity_helper')); ?></span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="current_capacity">Current Class Capacity</label>
                <input class="form-control <?php echo e($errors->has('current_capacity') ? 'is-invalid' : ''); ?>" type="number" name="current_capacity" id="current_capacity" value="<?php echo e(old('current_capacity')); ?>" step="1" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.capacity_helper')); ?></span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="year"><?php echo e(trans('cruds.classroom.fields.year')); ?></label>
                <input class="form-control <?php echo e($errors->has('year') ? 'is-invalid' : ''); ?>" type="number" name="year" id="year" value="<?php echo e(old('year')); ?>" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.year_helper')); ?></span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required"><?php echo e(trans('cruds.classroom.fields.condition')); ?></label>
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
                <label class="required" for="length"><?php echo e(trans('cruds.classroom.fields.length')); ?></label>
                <input class="form-control <?php echo e($errors->has('length') ? 'is-invalid' : ''); ?>" type="number" name="length" id="length" value="<?php echo e(old('length')); ?>" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.length_helper')); ?></span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="width"><?php echo e(trans('cruds.classroom.fields.width')); ?></label>
                <input class="form-control <?php echo e($errors->has('width') ? 'is-invalid' : ''); ?>" type="number" name="width" id="width" value="<?php echo e(old('width')); ?>" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.width_helper')); ?></span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required"><?php echo e(trans('cruds.classroom.fields.floor_material')); ?></label>
                <select class="form-control <?php echo e($errors->has('floor_material') ? 'is-invalid' : ''); ?>" name="floor_material" id="floor_material" required>
                    <option value disabled <?php echo e(old('floor_material', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $floor_materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $floor_material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($floor_material->id); ?>" <?php echo e(old('floor_material', '255') === (string) $floor_material->id ? 'selected' : ''); ?>><?php echo e($floor_material->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required"><?php echo e(trans('cruds.classroom.fields.wall_material')); ?></label>
                <select class="form-control <?php echo e($errors->has('wall_material') ? 'is-invalid' : ''); ?>" name="wall_material" id="wall_material" required>
                    <option value disabled <?php echo e(old('wall_material', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $wall_materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wall_material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($wall_material->id); ?>" <?php echo e(old('wall_material', '255') === (string) $wall_material->id ? 'selected' : ''); ?>><?php echo e($wall_material->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required"><?php echo e(trans('cruds.classroom.fields.roof_material')); ?></label>
                <select class="form-control <?php echo e($errors->has('roof_material') ? 'is-invalid' : ''); ?>" name="roof_material" id="roof_material" required>
                    <option value disabled <?php echo e(old('roof_material', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $roof_materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roof_material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($roof_material->id); ?>" <?php echo e(old('roof_material', '255') === (string) $roof_material->id ? 'selected' : ''); ?>><?php echo e($roof_material->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required"><?php echo e(trans('cruds.classroom.fields.seating')); ?></label>
                <select class="form-control <?php echo e($errors->has('seating') ? 'is-invalid' : ''); ?>" name="seating" id="seating" required>
                    <option value disabled <?php echo e(old('seating', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <option value="1" <?php echo e(old('seating', '255') === (string) 1 ? 'selected' : ''); ?>>Yes</option>
                    <option value="2" <?php echo e(old('seating', '255') === (string) 2 ? 'selected' : ''); ?>>No</option>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.seating_helper')); ?></span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required"><?php echo e(trans('cruds.classroom.fields.writing_board')); ?></label>
                <select class="form-control <?php echo e($errors->has('writing_board') ? 'is-invalid' : ''); ?>" name="writing_board" id="writing_board" required>
                    <option value disabled <?php echo e(old('writing_board', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <option value="1" <?php echo e(old('writing_board', '255') === (string) 1 ? 'selected' : ''); ?>>Yes</option>
                    <option value="2" <?php echo e(old('writing_board', '255') === (string) 2 ? 'selected' : ''); ?>>No</option>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.writing_board_helper')); ?></span>
            </div>



            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-primary" type="submit">
                    <?php echo e(trans('global.save')); ?>

                </button>
            </div>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Project/DataStamp-LURITS_QA/resources/views/admin/classroom/create.blade.php ENDPATH**/ ?>