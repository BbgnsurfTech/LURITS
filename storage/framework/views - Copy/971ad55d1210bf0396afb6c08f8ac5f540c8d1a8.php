<?php $__env->startSection('content'); ?>
<!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <ul>
                        <li>
                            <a href="<?php echo e(route("admin.home")); ?>">Home</a>
                        </li>                        
                        <li>Result</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3><?php echo e(trans('global.add')); ?> <?php echo e('New'); ?> <?php echo e('Result'); ?></h3>
            </div>
        </div>

    
        <form class="new-added-form" method="POST" action="<?php echo e(route("admin.result.store")); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>Date</label>
                <input name="date" id="date" value="<?php echo e(old('date', '')); ?>" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="student_id">Student</label>
                <select class="form-control select2 <?php echo e($errors->has('student_id') ? 'is-invalid' : ''); ?>" name="student_id" id="student_id">
                    <option value=""><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $studentAdmission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($child_name->id); ?>" <?php echo e(old('student_id') == $child_name->id ? 'selected' : ''); ?>><?php echo e($child_name->child_name); ?> <?php echo e($child_name->middle_name); ?> <?php echo e($child_name->last_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                
            </div>            
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="class_id">Class</label>
                <select class="form-control select2 <?php echo e($errors->has('class_id') ? 'is-invalid' : ''); ?>" name="class_id" id="class_id">
                    <option value=""><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $classroom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($class_id->id); ?>" <?php echo e(old('class_id') == $class_id->id ? 'selected' : ''); ?>><?php echo e($class_id->class); ?> <?php echo e($class_id->arms); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="subject">Subject</label>
                <select class="form-control select2 <?php echo e($errors->has('subject') ? 'is-invalid' : ''); ?>" name="subject" id="subject">
                    <option value=""><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $subject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($subject_id->id); ?>" <?php echo e(old('subject_id') == $class_id->id ? 'selected' : ''); ?>><?php echo e($subject_id->ds_subject_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                
            </div>            
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="first_ca">First CA</label>
                <input class="form-control <?php echo e($errors->has('first_ca') ? 'is-invalid' : ''); ?>" type="text" name="first_ca" id="first_ca" value="<?php echo e(old('first_ca', '')); ?>">
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="second_ca">Second CA</label>
                <input class="form-control <?php echo e($errors->has('second_ca') ? 'is-invalid' : ''); ?>" type="text" name="second_ca" id="second_ca" value="<?php echo e(old('second_ca', '')); ?>">
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="exam">Exam</label>
                <input class="form-control <?php echo e($errors->has('exam') ? 'is-invalid' : ''); ?>" type="text" name="exam" id="exam" value="<?php echo e(old('exam', '')); ?>">
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                
            </div>                    
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-danger" type="submit">
                    <?php echo e(trans('global.save')); ?>

                </button>
            </div>
        </div>
        </form>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/result/create.blade.php ENDPATH**/ ?>