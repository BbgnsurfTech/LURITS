<?php $__env->startSection('content'); ?>
<div class="card height-auto">
    <div class="card-header">
        <div class="form-group">
            <a class="btn btn-default" href="<?php echo e(route('admin.student-admissions.index')); ?>">
                <?php echo e(trans('global.back_to_list')); ?>

            </a>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staff_edit')): ?>
                <a class="btn btn-info" href="<?php echo e(route('admin.student-admissions.edit', $studentAdmission->id)); ?>">
                    <?php echo e(trans('global.edit')); ?>

                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staff_delete')): ?>
            <form action="<?php echo e(route('admin.student-admissions.destroy', $studentAdmission->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="submit" class="btn btn-danger" value="<?php echo e(trans('global.delete')); ?>">
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="card height-auto">
    <div class="card-header">Student Bio Details</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="item-img ml-5">
                    <img src="<?php if($studentAdmission->student_picture): ?> <?php echo e($studentAdmission->student_picture->getUrl()); ?> <?php else: ?> /dist/img/boxed-bg.jpg <?php endif; ?>" width="100px" height="100px" style="border-radius: 50%;" alt="Student image">
                </div>     
            </div>
            <div class="col-md-4">
                <h6>School: <?php echo e($studentAdmission->school_enrolled->name ?? ''); ?></h6>
                <h6>Admission Number: <?php echo e($studentAdmission->admission_number ?? ''); ?> </h6>
                <h6>First Name: <?php echo e($studentAdmission->child_name ?? ''); ?></h6>
                <h6>Middle Name: <?php echo e($studentAdmission->middle_name ?? ''); ?></h6>
                <h6>Last Name: <?php echo e($studentAdmission->last_name ?? ''); ?></h6>
                <h6>Gender: <?php echo e($studentAdmission->gender->title ?? ''); ?></h6>
            </div>
            <div class="col-md-4">
                <h6>Date of Birth: <?php echo e($studentAdmission->date_of_birth ?? ''); ?></h6>
                <h6>Blood Group: <?php echo e($studentAdmission->bloodgroup->title ?? ''); ?></h6>
                <h6>Marital Status: <?php echo e($studentAdmission->maritalstatus->title ?? ''); ?></h6>
                <h6>Disability: <?php echo e($studentAdmission->disabiliy_text ?? 'None'); ?></h6>
                <h6>Hobby: <?php echo e($studentAdmission->hobby ?? 'None'); ?></h6>
            </div>
        </div>
    </div>
</div>
<div class="card height-auto">
    <div class="card-header">Parent/Guardian Details</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="item-img ml-5">
                    <img src="<?php if($studentAdmission->parent_guardian->photo): ?> <?php echo e(config('app.url')); ?>/storage/images/parents/<?php echo e($studentAdmission->parent_guardian->photo); ?> <?php else: ?> /dist/img/boxed-bg.jpg <?php endif; ?>" width="100px" height="100px" style="border-radius: 50%;" alt="Parent image">
                </div>     
            </div>
            <div class="col-md-8">
                <h6>Parent/Guardian Name: 
                    <?php echo e($studentAdmission->parent_guardian->first_name ?? ''); ?> <?php echo e($studentAdmission->parent_guardian->middle_name ?? ''); ?> <?php echo e($studentAdmission->parent_guardian->last_name ?? ''); ?>

                </h6>
                <h6>Phone Number: <?php echo e($studentAdmission->parent_guardian->phone_number); ?></h6>
                <h6>Address: <?php echo e($studentAdmission->parent_guardian->address); ?></h6>
                <h6>Profession: <?php echo e($studentAdmission->parent_guardian->profession); ?></h6>
                <h6>Income Status: N<?php echo e($studentAdmission->parent_guardian->incomeStatus->title); ?></h6>
            </div>
        </div>
    </div>
</div>
<div class="card height-auto">
    <div class="card-header">Student Profile Details</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h6>State of Origin: <?php echo e($studentAdmission->state_origin->name_atlas_entity ?? ''); ?></h6>
                <h6>LGA of Origin: <?php echo e($studentAdmission->lga_origin->name_atlas_entity ?? ''); ?></h6>
                <h6>Religion: <?php echo e($studentAdmission->religion->title ?? ''); ?> </h6>
                <h6>Class: <?php echo e($studentAdmission->classs->classTitle->title ?? ''); ?> <?php echo e($studentAdmission->classs->armTitle->title ?? ''); ?></h6>
                <h6>Address: <?php echo e($studentAdmission->address ?? ''); ?></h6>
            </div>
        </div>
    </div>
</div>
    
<div class="row">
    <div class="col-4-xxxl col-12">
        <div class="card dashboard-card-six">
            <div class="card-body">
                <div class="heading-layout1 mg-b-17">
                    <div class="item-title">
                        <h3><?php echo e(trans('cruds.studentAdmission.fields.student_document')); ?></h3>
                    </div>
                </div>
                <div class="notice-box-wrap">
                    <div class="notice-list">
                        <?php $__empty_1 = true; $__currentLoopData = $studentAdmission->student_document; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <ul>
                            <a href="<?php echo e($media->getUrl()); ?>" target="_blank">
                                <?php echo e(trans('global.view_file')); ?>

                            </a>
                            </ul>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <strong>Not Available</strong>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/studentAdmissions/show.blade.php ENDPATH**/ ?>