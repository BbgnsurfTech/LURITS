<?php $__env->startSection('content'); ?>
<section class="content">
    <div class="card">
        <div class="card-header">
            <?php echo e(trans('global.edit')); ?> <?php echo e(trans('cruds.team.title_singular')); ?>

        </div>

        <div class="card-body">
            <form method="POST" action="<?php echo e(route("admin.schools.update", [$school->id])); ?>" enctype="multipart/form-data">
                <?php echo method_field('PUT'); ?>
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="required" for="name"><?php echo e(trans('cruds.team.fields.name')); ?></label>
                    <input class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" type="text" name="name" id="name" value="<?php echo e(old('name', $school->name)); ?>" required>
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.team.fields.name_helper')); ?></span>
                </div>
                <div class="form-group">
                    <label for="pseudo_code"><?php echo e(trans('cruds.team.fields.pseudo_code')); ?></label>
                    <input class="form-control <?php echo e($errors->has('pseudo_code') ? 'is-invalid' : ''); ?>" type="text" name="pseudo_code" id="pseudo_code" value="<?php echo e(old('pseudo_code', $school->pseudo_code)); ?>">
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.team.fields.pseudo_code_helper')); ?></span>
                </div>
                <div class="form-group">
                    <label for="nemis_code"><?php echo e(trans('cruds.team.fields.nemis_code')); ?></label>
                    <input class="form-control <?php echo e($errors->has('nemis_code') ? 'is-invalid' : ''); ?>" type="text" name="nemis_code" id="nemis_code" value="<?php echo e(old('nemis_code', $school->nemis_code)); ?>">
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.team.fields.nemis_code_helper')); ?></span>
                </div>
                <div class="form-group">
                    <label for="number_and_street"><?php echo e(trans('cruds.team.fields.number_and_street')); ?></label>
                    <input class="form-control <?php echo e($errors->has('number_and_street') ? 'is-invalid' : ''); ?>" type="text" name="number_and_street" id="number_and_street" value="<?php echo e(old('number_and_street', $school->number_and_street)); ?>">
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.team.fields.number_and_street_helper')); ?></span>
                </div>
                <div class="form-group">
                    <label for="school_community"><?php echo e(trans('cruds.team.fields.school_community')); ?></label>
                    <input class="form-control <?php echo e($errors->has('school_community') ? 'is-invalid' : ''); ?>" type="text" name="school_community" id="school_community" value="<?php echo e(old('school_community', $school->school_community)); ?>">
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.team.fields.school_community_helper')); ?></span>
                </div>
                <div class="form-group">
                    <label for="village_town"><?php echo e(trans('cruds.team.fields.village_town')); ?></label>
                    <input class="form-control <?php echo e($errors->has('village_town') ? 'is-invalid' : ''); ?>" type="text" name="village_town" id="village_town" value="<?php echo e(old('village_town', $school->village_town)); ?>">
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.team.fields.village_town_helper')); ?></span>
                </div>
                <div class="form-group">
                    <label for="email_address"><?php echo e(trans('cruds.team.fields.email_address')); ?></label>
                    <input class="form-control <?php echo e($errors->has('email_address') ? 'is-invalid' : ''); ?>" type="text" name="email_address" id="email_address" value="<?php echo e(old('email_address', $school->email_address)); ?>">
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.team.fields.email_address_helper')); ?></span>
                </div>
                <div class="form-group">
                    <label for="school_telephone"><?php echo e(trans('cruds.team.fields.school_telephone')); ?></label>
                    <input class="form-control <?php echo e($errors->has('school_telephone') ? 'is-invalid' : ''); ?>" type="text" name="school_telephone" id="school_telephone" value="<?php echo e(old('school_telephone', $school->school_telephone)); ?>">
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.team.fields.school_telephone_helper')); ?></span>
                </div>
                <div class="form-group">
                    <label class="required"><?php echo e(trans('cruds.team.fields.code_type_sector')); ?></label>
                    <select class="form-control <?php echo e($errors->has('code_type_sector') ? 'is-invalid' : ''); ?>" name="code_type_sector" id="code_type_sector" required>
                        <option value disabled <?php echo e(old('code_type_sector', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                        <?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php echo e(($school->code_type_sector ? $school->sector->id : old('code_type_sector')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.team.fields.code_type_sector_helper')); ?></span>
                </div>
                <div class="form-group">
                    <label for="latitude_north"><?php echo e(trans('cruds.team.fields.latitude_north')); ?></label>
                    <input class="form-control <?php echo e($errors->has('latitude_north') ? 'is-invalid' : ''); ?>" type="number" name="latitude_north" id="latitude_north" value="<?php echo e(old('latitude_north', $school->latitude_north)); ?>" step="0.01">
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.team.fields.latitude_north_helper')); ?></span>
                </div>
                <div class="form-group">
                    <label for="longitude_east"><?php echo e(trans('cruds.team.fields.longitude_east')); ?></label>
                    <input class="form-control <?php echo e($errors->has('longitude_east') ? 'is-invalid' : ''); ?>" type="number" name="longitude_east" id="longitude_east" value="<?php echo e(old('longitude_east', $school->longitude_east)); ?>" step="0.01">
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.team.fields.longitude_east_helper')); ?></span>
                </div>
                <div class="form-group">
                    <label for="ward"><?php echo e(trans('cruds.team.fields.ward')); ?></label>
                    <input class="form-control <?php echo e($errors->has('ward') ? 'is-invalid' : ''); ?>" type="text" name="ward" id="ward" value="<?php echo e(old('ward', $school->ward)); ?>">
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.team.fields.ward_helper')); ?></span>
                </div>
                <div class="form-group">
                    <label for="nearby_name_school"><?php echo e(trans('cruds.team.fields.nearby_name_school')); ?></label>
                    <input class="form-control <?php echo e($errors->has('nearby_name_school') ? 'is-invalid' : ''); ?>" type="text" name="nearby_name_school" id="nearby_name_school" value="<?php echo e(old('nearby_name_school', $school->nearby_name_school)); ?>">
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.team.fields.nearby_name_school_helper')); ?></span>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/schools/edit.blade.php ENDPATH**/ ?>