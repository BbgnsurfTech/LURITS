<?php $__env->startSection('content'); ?>
<div class="content">
<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.edit')); ?> <?php echo e(trans('cruds.classroom.title_singular')); ?>

    </div>

    <div class="card-body">
        <form method="POST" action="<?php echo e(route("admin.classrooms.update", [$classroom->id])); ?>" enctype="multipart/form-data">
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label class="required" for="capacity"><?php echo e(trans('cruds.classroom.fields.capacity')); ?></label>
                <input class="form-control <?php echo e($errors->has('capacity') ? 'is-invalid' : ''); ?>" type="number" name="capacity" id="capacity" value="<?php echo e(old('capacity', $classroom->capacity)); ?>" step="1" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.capacity_helper')); ?></span>
            </div>
            <div class="form-group">
                <label class="required" for="current_capacity">Current Class Capacity</label>
                <input class="form-control <?php echo e($errors->has('current_capacity') ? 'is-invalid' : ''); ?>" type="number" name="current_capacity" id="current_capacity" value="<?php echo e(old('current_capacity', $classroom->current_capacity)); ?>" step="1" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.capacity_helper')); ?></span>
            </div>
            <div class="form-group">
                <label class="required" for="year"><?php echo e(trans('cruds.classroom.fields.year')); ?></label>
                <input class="form-control <?php echo e($errors->has('year') ? 'is-invalid' : ''); ?>" type="number" name="year" id="year" value="<?php echo e(old('year', $classroom->year)); ?>" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.year_helper')); ?></span>
            </div>
            <div class="form-group">
                <label class="required" for="condition"><?php echo e(trans('cruds.classroom.fields.condition')); ?></label>
                <select class="form-control <?php echo e($errors->has('condition') ? 'is-invalid' : ''); ?>" name="condition" id="condition" required>
                    <option value disabled <?php echo e(old('condition', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(($classroom->condition ? $classroom->classCondition->id : old('condition')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="required" for="length"><?php echo e(trans('cruds.classroom.fields.length')); ?></label>
                <input class="form-control <?php echo e($errors->has('length') ? 'is-invalid' : ''); ?>" type="number" name="length" id="length" value="<?php echo e(old('length', $classroom->length)); ?>" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.length_helper')); ?></span>
            </div>
            <div class="form-group">
                <label class="required" for="width"><?php echo e(trans('cruds.classroom.fields.width')); ?></label>
                <input class="form-control <?php echo e($errors->has('width') ? 'is-invalid' : ''); ?>" type="number" name="width" id="width" value="<?php echo e(old('width', $classroom->width)); ?>" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.width_helper')); ?></span>
            </div>
            <div class="form-group">
                <label class="required" for="floor_material"><?php echo e(trans('cruds.classroom.fields.floor_material')); ?></label>
                <select class="form-control <?php echo e($errors->has('floor_material') ? 'is-invalid' : ''); ?>" name="floor_material" id="floor_material" required>
                    <option value disabled <?php echo e(old('floor_material', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $floor_materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(($classroom->floor_material ? $classroom->floorMaterial->id : old('floor_material')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="required" for="wall_material"><?php echo e(trans('cruds.classroom.fields.wall_material')); ?></label>
                <select class="form-control <?php echo e($errors->has('wall_material') ? 'is-invalid' : ''); ?>" name="wall_material" id="wall_material" required>
                    <option value disabled <?php echo e(old('wall_material', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $wall_materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(($classroom->wall_material ? $classroom->wallMaterial->id : old('wall_materials')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="required" for="roof_material"><?php echo e(trans('cruds.classroom.fields.roof_material')); ?></label>
                <select class="form-control <?php echo e($errors->has('roof_material') ? 'is-invalid' : ''); ?>" name="roof_material" id="roof_material" required>
                    <option value disabled <?php echo e(old('roof_material', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $roof_materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(($classroom->roof_material ? $classroom->floorMaterial->id : old('roof_material')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label class="required" for="seating"><?php echo e(trans('cruds.classroom.fields.seating')); ?></label>
                <select class="form-control <?php echo e($errors->has('seating') ? 'is-invalid' : ''); ?>" name="seating" id="seating" required>
                    <option value disabled <?php echo e(old('seating', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $yes_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(($classroom->seating ? $classroom->availableSeating->id : old('seating')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.seating_helper')); ?></span>
            </div>
            <div class="form-group">
                <label class="required" for="writing_board"><?php echo e(trans('cruds.classroom.fields.writing_board')); ?></label>
                <select class="form-control <?php echo e($errors->has('writing_board') ? 'is-invalid' : ''); ?>" name="writing_board" id="writing_board" required>
                    <option value disabled <?php echo e(old('writing_board', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $yes_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(($classroom->writing_board ? $classroom->writingBoard->id : old('writing_board')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.classroom.fields.writing_board_helper')); ?></span>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    <?php echo e(trans('global.save')); ?>

                </button>
            </div>
        </form>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/classroom/edit.blade.php ENDPATH**/ ?>