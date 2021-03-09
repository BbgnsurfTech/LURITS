<?php $__env->startSection('content'); ?>
<div class="card height-auto">
    <div class="card-header">
        <div class="form-group">
            <a class="btn btn-default" href="<?php echo e(route('admin.staffs.index')); ?>">
                <?php echo e(trans('global.back_to_list')); ?>

            </a>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staff_edit')): ?>
                <a class="btn btn-info" href="<?php echo e(route('admin.staffs.edit', $staff->id)); ?>">
                    <?php echo e(trans('global.edit')); ?>

                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('staff_delete')): ?>
            <form action="<?php echo e(route('admin.staffs.destroy', $staff->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="submit" class="btn btn-danger" value="<?php echo e(trans('global.delete')); ?>">
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="card height-auto">
    <div class="card-header">Staff Bio Details</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="item-img ml-5">
                    <img src="<?php if($staff->staff_picture): ?> <?php echo e($staff->staff_picture->getUrl()); ?> <?php elseif($staff->gender->title == "Male"): ?> /img/userImage.png <?php else: ?> /dist/img/employee.png <?php endif; ?>" width="100px" height="100px" style="border-radius: 50%;" alt="staff image">
                </div>     
            </div>
            <div class="col-md-4">
                <h6>School: <?php echo e($staff->school->name ?? ''); ?></h6>
                <h6>Staff ID: <?php echo e($staff->lga_staff_id ?? ''); ?> </h6>
                <h6>First Name: <?php echo e($staff->first_name ?? ''); ?></h6>
                <h6>Middle Name: <?php echo e($staff->middle_name ?? ''); ?></h6>
                <h6>Last Name: <?php echo e($staff->last_name ?? ''); ?></h6>
                <h6>Gender: <?php echo e($staff->gender->title ?? ''); ?></h6>
            </div>
            <div class="col-md-4">
                <h6>Date of Birth: <?php echo e($staff->date_of_birth ?? ''); ?></h6>
                <h6>State of Origin: <?php echo e($staff->state_origin->name_atlas_entity ?? ''); ?></h6>
                <h6>LGA of Origin: <?php echo e($staff->lga_origin->name_atlas_entity ?? ''); ?></h6>
                <h6>Disability: <?php echo e($staff->disabiliy_text ?? 'None'); ?></h6>
                <h6>Email: <?php echo e($staff->email ?? ''); ?></h6>
                <h6>Phone Number: <?php echo e($staff->phone_number ?? ''); ?></h6>
            </div>
        </div>
    </div>
</div>
<div class="card height-auto">
    <div class="card-header">Staff Profile Details</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6>Type of Staff: <?php echo e($staff->type_staff->title ?? ''); ?></h6>
                <h6>Year of First Appointment: <?php echo e($staff->year_first_appointment ?? ''); ?></h6>
                <h6>Year of Present Appointment: <?php echo e($staff->year_present_appointment ?? ''); ?></h6>
                <h6>Year of Posting to School: <?php echo e($staff->year_posting_to_school ?? ''); ?></h6>
            </div>
            <div class="col-md-6">
                <h6>Grade Level/Step: <?php echo e($staff->grade_level ?? ''); ?>/<?php echo e($staff->grade_step ?? ''); ?></h6>
                <h6>Source of Salary: <?php echo e($staff->salary_source->title ?? ''); ?></h6>
                <h6>Present Status: <?php echo e($staff->present_status->title ?? ''); ?></h6>
                <h6>Academic Qualification: <?php echo e($staff->academic_qualification->title ?? ''); ?></h6>
                <h6>Teaching Type: <?php echo e($staff->teaching_type->title ?? ''); ?></h6>
            </div>
        </div>
    </div>
</div>
<?php if($staff->academic_qualification_id !== 1): ?>
<div class="card height-auto">
    <div class="card-header">Staff Academic Details</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h6>Teaching Qualification: <?php echo e($staff->teaching_qualification->title ?? ''); ?></h6>
                <h6>Area of Specialization: <?php echo e($staff->area_of_specialization->ds_subject_name ?? ''); ?></h6>
                <h6>Subject of Qualification: <?php echo e($staff->subject_of_qualification->ds_subject_name ?? ''); ?></h6>
                <h6>Main Subject Taught: <?php echo e($staff->subject_taught->ds_subject_name ?? ''); ?></h6>
                <h6>Seminar/Workshop: <?php echo e($staff->seminar_workshop->title ?? "No"); ?></h6>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
        <div class="col-4-xxxl col-12">
            <div class="card dashboard-card-six">
                <div class="card-body">
                    <div class="heading-layout1 mg-b-17">
                        <div class="item-title">
                            <h3>Staff Documents</h3>
                        </div>
                    </div>
                    <div class="notice-box-wrap">
                        <div class="notice-list">
                            <?php $__empty_1 = true; $__currentLoopData = $staff->staff_document; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/staffs/show.blade.php ENDPATH**/ ?>