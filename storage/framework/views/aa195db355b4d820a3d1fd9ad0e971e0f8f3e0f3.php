<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(isset($parentGuardianregister) ? trans('global.edit') : trans('global.create')); ?> <?php echo e(trans('cruds.parentGuardianregister.title_singular')); ?>

    </div>

    <div class="card-body">
        <form method="POST" action="<?php echo e(route("admin.parents.store")); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <input type="hidden" name="parent_id" value="<?php echo e($parentGuardianregister->id ?? ''); ?>">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="photo">Passport</label>
                    <div class="col-sm-12">
                        <input id="photo" type="file" name="photo">
                        <input type="hidden" name="hidden_image" id="hidden_image">
                    </div>
                    <?php if($errors->has('photo')): ?>
                        <span class="text-danger"><?php echo e($errors->first('photo')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.parentGuardianregister.fields.first_name_helper')); ?></span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="first_name"><?php echo e(trans('cruds.parentGuardianregister.fields.first_name')); ?></label>
                    <input class="form-control <?php echo e($errors->has('first_name') ? 'is-invalid' : ''); ?>" type="text" name="first_name" id="first_name" value="<?php echo e(old('first_name', $parentGuardianregister->first_name ?? '')); ?>" required>
                    <?php if($errors->has('first_name')): ?>
                        <span class="text-danger"><?php echo e($errors->first('first_name')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.parentGuardianregister.fields.first_name_helper')); ?></span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="middle_name"><?php echo e(trans('cruds.parentGuardianregister.fields.middle_name')); ?></label>
                    <input class="form-control <?php echo e($errors->has('middle_name') ? 'is-invalid' : ''); ?>" type="text" name="middle_name" id="middle_name" value="<?php echo e(old('middle_name', $parentGuardianregister->middle_name ?? '')); ?>">
                    <?php if($errors->has('middle_name')): ?>
                        <span class="text-danger"><?php echo e($errors->first('middle_name')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.parentGuardianregister.fields.middle_name_helper')); ?></span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="last_name"><?php echo e(trans('cruds.parentGuardianregister.fields.last_name')); ?></label>
                    <input class="form-control <?php echo e($errors->has('last_name') ? 'is-invalid' : ''); ?>" type="text" name="last_name" id="last_name" value="<?php echo e(old('last_name', $parentGuardianregister->last_name ?? '')); ?>" required>
                    <?php if($errors->has('last_name')): ?>
                        <span class="text-danger"><?php echo e($errors->first('last_name')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.parentGuardianregister.fields.last_name_helper')); ?></span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender" required>
                        <option value="" disabled selected>Please Select</option>
                        <?php $__currentLoopData = $gender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($gender->id); ?>" <?php echo e((old('gender', 0) == $gender->id || isset($parentGuardianregister) && $parentGuardianregister->gender_id == $gender->id) ? 'selected' : ''); ?>><?php echo e($gender->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('gender')): ?>
                        <span class="text-danger"><?php echo e($errors->first('gender')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.parentGuardianregister.fields.last_name_helper')); ?></span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="income">Annual Income</label>
                    <select class="form-control" name="income" id="income" required>
                        <option value="" disabled selected>Please Select</option>
                        <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($status->id); ?>" <?php echo e((old('income', 0) == $status->id || isset($parentGuardianregister) && $parentGuardianregister->gender_id == $status->id) ? 'selected' : ''); ?>><?php echo e($status->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($errors->has('income')): ?>
                        <span class="text-danger"><?php echo e($errors->first('income')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.parentGuardianregister.fields.last_name_helper')); ?></span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="email"><?php echo e(trans('cruds.parentGuardianregister.fields.email')); ?></label>
                    <input class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>" type="text" name="email" id="email" value="<?php echo e(old('email', $parentGuardianregister->email ?? '')); ?>">
                    <?php if($errors->has('email')): ?>
                        <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.parentGuardianregister.fields.email_helper')); ?></span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="phone_number"><?php echo e(trans('cruds.parentGuardianregister.fields.phone_number')); ?></label>
                    <input class="form-control <?php echo e($errors->has('phone_number') ? 'is-invalid' : ''); ?>" type="text" name="phone_number" id="phone_number" value="<?php echo e(old('phone_number', $parentGuardianregister->phone_number ?? '')); ?>" required>
                    <?php if($errors->has('phone_number')): ?>
                        <span class="text-danger"><?php echo e($errors->first('phone_number')); ?></span>
                    <?php endif; ?>
                    <span class="help-block"><?php echo e(trans('cruds.parentGuardianregister.fields.phone_number_helper')); ?></span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                   <label class="required">Date of Birth*</label>
                    <input name="dateofbirth" id="dateofbirth" value="<?php echo e(old('dateofbirth', $parentGuardianregister->date_of_birth ?? '')); ?>" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" >
                    <i class="far fa-calendar-alt"></i>
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="address">Address</label>
                    <input class="form-control <?php echo e($errors->has('address') ? 'is-invalid' : ''); ?>" type="text" name="address" id="address" value="<?php echo e(old('address', $parentGuardianregister->address ?? '')); ?>" required>
                    <?php if($errors->has('address')): ?>
                        <span class="text-danger"><?php echo e($errors->first('address')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="profession">Profession</label>
                    <input class="form-control <?php echo e($errors->has('profession') ? 'is-invalid' : ''); ?>" type="text" name="profession" id="profession" value="<?php echo e(old('profession', $parentGuardianregister->profession ?? '')); ?>" required>
                    <?php if($errors->has('profession')): ?>
                        <span class="text-danger"><?php echo e($errors->first('profession')); ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-lg btn-success" type="submit">
                    <?php echo e(trans('global.save')); ?>

                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script src="<?php echo e(asset('js/filter.js')); ?>"></script>
<?php if(isset($parentGuardianregister)): ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="school"]').append(
        '<option value="<?php echo e($parentGuardianregister->school_id); ?>" selected>'+ "<?php echo e($parentGuardianregister->school->name); ?>" +'</option>'
        );
    });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/parentGuardianregisters/create.blade.php ENDPATH**/ ?>