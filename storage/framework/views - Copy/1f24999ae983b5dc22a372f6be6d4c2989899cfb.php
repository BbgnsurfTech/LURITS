<?php $__env->startSection('content'); ?>
<section class="content">
<div class="card">
    <div class="card-header">
        Create Staff
    </div>

    <div class="card-body">
    <form method="POST" action="<?php echo e(route("admin.staffs.update", [$staff->id])); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Bio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Details</a>
          </li>
        </ul>

        <div class="tab-content mt-4">
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <?php if(Auth::User()->is_superAdmin || Auth::User()->is_admin): ?>
                <div class="row"><h4>Staff School</h4></div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Country</label>
                        <select name="country" class="form-control input-lg dynamic" id="country" data-dependent="state">
                            <option value="" disabled selected>Select Country</option>
                            <?php $__currentLoopData = $country_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($country->code_atlas_entity); ?>"><?php echo e($country->name_atlas_entity); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label">State</label>
                            <select name="state" class="form-control input-lg dynamic" id="state" data-dependent="lga">
                                <option value="" selected disabled>Select State</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label">LGA</label>
                            <select name="lga" class="form-control input-lg dynamic" id="lga" data-dependent="school">
                                <option disabled selected value="">Select LGA</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label">School Sector</label>
                            <select name="school_sector" class="form-control input-lg dynamic" id="school_sector" data-dependent="school">
                                <option disabled selected value="">Select Sector</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required"><?php echo e('School'); ?>*</label>
                        <select name="school" class="form-control input-lg dynamic" id="school" required>
                            <option value="<?php echo e($staff->school->id); ?>"><?php echo e($staff->school->name); ?></option>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <hr>
                <?php endif; ?>
                <?php if(Auth::User()->is_zeqa): ?>
                <div class="row"><h4>Staff School</h4></div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">LGA</label>
                        <select name="lga" class="form-control input-lg dynamic" id="lga" required>
                            <option value="">Select LGA</option>
                            <?php $__currentLoopData = $lga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lga->code_atlas_entity); ?>"><?php echo e($lga->name_atlas_entity); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required"><?php echo e('School'); ?>*</label>
                        <select name="school" class="form-control input-lg dynamic" id="school" required>
                            <option value="<?php echo e($staff->school->id); ?>"><?php echo e($staff->school->name); ?></option>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <hr>
                <?php endif; ?>
                <?php if(Auth::User()->is_lgea): ?>
                <div class="row"><h4>Staff School</h4></div>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required"><?php echo e('School'); ?>*</label>
                        <select name="school" class="form-control input-lg dynamic" id="school" required>
                            <option value="<?php echo e($staff->school->id); ?>"><?php echo e($staff->school->name); ?></option>
                            <?php $__currentLoopData = $lgea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lga->id); ?>" <?php if($lga->id == $staff->school->id): ?> disabled <?php endif; ?>><?php echo e($lga->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <hr>
                <?php endif; ?>
                <div class="row">
                    <input type="hidden" name="school_id" value="<?php echo e($staff->school_id); ?>">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="staff_id">Staff ID</label>
                        <input class="form-control" type="text" id="staff_id" value="<?php echo e($staff->staff_id ?? ''); ?>" readonly>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                        <span class="help-block"><?php echo e(trans('cruds.teacher.fields.first_name_helper')); ?></span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="first_name"><?php echo e(trans('cruds.teacher.fields.first_name')); ?>*</label>
                        <input class="form-control <?php echo e($errors->has('first_name') ? 'is-invalid' : ''); ?>" type="text" name="first_name" id="first_name" value="<?php echo e(old('first_name', $staff->first_name)); ?>" required>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                        <span class="help-block"><?php echo e(trans('cruds.teacher.fields.first_name_helper')); ?></span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="middle_name"><?php echo e(trans('cruds.teacher.fields.middle_name')); ?></label>
                        <input class="form-control <?php echo e($errors->has('middle_name') ? 'is-invalid' : ''); ?>" type="text" name="middle_name" id="middle_name" value="<?php echo e(old('middle_name', $staff->middle_name)); ?>">
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                        <span class="help-block"><?php echo e(trans('cruds.teacher.fields.middle_name_helper')); ?></span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="last_name"><?php echo e(trans('cruds.teacher.fields.last_name')); ?>*</label>
                        <input class="form-control <?php echo e($errors->has('last_name') ? 'is-invalid' : ''); ?>" type="text" name="last_name" id="last_name" value="<?php echo e(old('last_name', $staff->last_name)); ?>" required>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                        <span class="help-block"><?php echo e(trans('cruds.teacher.fields.last_name_helper')); ?></span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required"><?php echo e('Gender'); ?>*</label>
                        <select class="form-control <?php echo e($errors->has('gender') ? 'is-invalid' : ''); ?>" name="gender" id="gender" required>
                            <option value disabled <?php echo e((old('gender', null) || isset($staff) && $staff->gender_id == null) ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" <?php echo e((old('gender', 0) == $id || isset($staff) && $staff->gender->id == $id) ? 'selected' : ''); ?>><?php echo e($gender); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                       <label class="required">Date of Birth*</label>
                        <input name="date_of_birth" id="date_of_birth" value="<?php echo e(old('date_of_birth', date('Y-m-d', strtotime($staff->date_of_birth)))); ?>" type="text" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                        <i class="far fa-calendar-alt"></i>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required"><?php echo e(trans('cruds.studentAdmission.fields.state_origin')); ?>*</label>
                        <select class="form-control <?php echo e($errors->has('state_origin') ? 'is-invalid' : ''); ?>" name="state_origin" id="state_origin" data-dependent="lga_origin" required>
                            <option value="<?php echo e($staff->state_origin->code_atlas_entity ?? ''); ?>"><?php echo e($staff->state_origin->name_atlas_entity ?? ''); ?></option><hr>
                            <?php $__currentLoopData = $atlas->where('code_ds_atlas_entity', 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($state->code_atlas_entity ?? ''); ?>" <?php echo e(old('state_origin', '255') === (string) $state->code_atlas_entity ?? '' ? 'selected' : ''); ?>><?php echo e($state->name_atlas_entity); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">LGA of Origin*</label>
                        <select name="lga_origin" required="" class="form-control input-lg dynamic" id="lga_origin">
                            <option value="<?php echo e($staff->lga_origin->code_atlas_entity ?? ''); ?>"><?php echo e($staff->lga_origin->name_atlas_entity ?? ''); ?></option>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>    
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required"><?php echo e('Marital Status'); ?>*</label>
                        <select class="form-control <?php echo e($errors->has('marital_status') ? 'is-invalid' : ''); ?>" name="marital_status" id="marital_status" required>
                            <option value disabled <?php echo e((old('marital_status', null) || isset($staff) && $staff->marital_status == null) ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $marital_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" <?php echo e((old('maritalstatus', 0) == $id || isset($staff) && $staff->marital_status_id == $id) ? 'selected' : ''); ?>><?php echo e($categories); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required"><?php echo e('Disability'); ?>*</label>
                        <select class="form-control <?php echo e($errors->has('disability') ? 'is-invalid' : ''); ?>" name="disability" id="disability" required>
                            <option value disabled <?php echo e((old('disability', null) || isset($staff) && $staff->disability_id == null) ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $disabilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $disability): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" <?php echo e((old('disability', 0) == $id || isset($staff) && $staff->disability_id == $id) ? 'selected' : ''); ?>><?php echo e($disability); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="email"><?php echo e(trans('cruds.teacher.fields.email')); ?></label>
                        <input class="form-control <?php echo e($errors->has('email') ? 'is-invalid' : ''); ?>" type="text" name="email" id="email" value="<?php echo e(old('email', $staff->email)); ?>">
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                        <span class="help-block"><?php echo e(trans('cruds.teacher.fields.email_helper')); ?></span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="phone_number"><?php echo e(trans('cruds.teacher.fields.phone_number')); ?>*</label>
                        <input class="form-control <?php echo e($errors->has('phone_number') ? 'is-invalid' : ''); ?>" type="text" name="phone_number" id="phone_number" value="<?php echo e(old('phone_number', $staff->phone_number)); ?>" maxlength="11" required>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                        <span class="help-block"><?php echo e(trans('cruds.teacher.fields.phone_number_helper')); ?></span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="address"><?php echo e(trans('cruds.studentAdmission.fields.address')); ?></label>
                        <input class="form-control <?php echo e($errors->has('address') ? 'is-invalid' : ''); ?>" type="text" name="address" id="address" value="<?php echo e($staff->address); ?>" <?php echo e(old('address', '')); ?> required>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                        <span class="help-block"><?php echo e(trans('cruds.studentAdmission.fields.address_helper')); ?></span>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="first_appointment">Date of First Appointment*</label>
                        <!-- <input class="form-control <?php echo e($errors->has('first_appointment') ? 'is-invalid' : ''); ?>" type="text" name="first_appointment" id="first_appointment" value="<?php echo e(old('first_appointment', $staff->year_first_appointment)); ?>" required> -->
                        <input name="first_appointment" id="first_appointment" value="<?php echo e(old('first_appointment', $staff->year_first_appointment)); ?>" type="text" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="present_appointment">Date of Present Appointment*</label>
                        <!-- <input class="form-control <?php echo e($errors->has('present_appointment') ? 'is-invalid' : ''); ?>" type="text" name="present_appointment" id="present_appointment" value="<?php echo e(old('present_appointment', $staff->year_present_appointment)); ?>" required> -->
                        <input name="present_appointment" id="present_appointment" value="<?php echo e(old('present_appointment', $staff->year_present_appointment)); ?>" type="text" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="posting_to_school">Date of Posting To This School*</label>
                        <!-- <input class="form-control <?php echo e($errors->has('posting_to_school') ? 'is-invalid' : ''); ?>" type="text" name="posting_to_school" id="posting_to_school" value="<?php echo e(old('posting_to_school', $staff->year_posting_to_school)); ?>" required> -->
                        <input name="posting_to_school" id="posting_to_school" value="<?php echo e(old('posting_to_school', $staff->year_posting_to_school)); ?>" type="text" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="grade_level"><?php echo e('Grade Level'); ?></label>
                        <input class="form-control <?php echo e($errors->has('grade_level') ? 'is-invalid' : ''); ?>" type="text" name="grade_level" id="grade_level" value="<?php echo e(old('grade_level', $staff->grade_level)); ?>">
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="step"><?php echo e('Step'); ?></label>
                        <input class="form-control <?php echo e($errors->has('step') ? 'is-invalid' : ''); ?>" type="text" name="step" id="step" value="<?php echo e(old('step', $staff->step)); ?>">
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required"><?php echo e('Type of Staff'); ?>*</label>
                        <select name="type_of_staff" class="form-control input-lg dynamic" id="type_of_staff" required>
                            <option value disabled <?php echo e((old('type_of_staff', null) || isset($staff) && $staff->type_staff_id == null) ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $type_staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" <?php echo e((old('type_of_staff', 0) == $id || isset($staff) && $staff->type_staff_id == $id) ? 'selected' : ''); ?>><?php echo e($type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required"><?php echo e('Source of Salary'); ?>*</label>
                        <select class="form-control <?php echo e($errors->has('source_of_salary') ? 'is-invalid' : ''); ?>" name="source_of_salary" id="source_of_salary" required>
                            <option value disabled <?php echo e((old('salary_source', null) || isset($staff) && $staff->salary_source_id == null) ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $salary_source; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" <?php echo e((old('salary_source', 0) == $id || isset($staff) && $staff->salary_source_id == $id) ? 'selected' : ''); ?>><?php echo e($source); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group" id="other_salary_source" <?php if($staff->salary_source->title !== "Others"): ?> style="display: none;" <?php endif; ?>>
                        <label class="required">Other Salary Source*</label>
                        <input type="text" name="other_salary_source" id="other_salary_source" class="form-control" value="<?php echo e($staff->other_salary_source ?? ''); ?>">
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required"><?php echo e('Present'); ?>*</label>
                        <select class="form-control <?php echo e($errors->has('present') ? 'is-invalid' : ''); ?>" name="present" id="present" required>
                            <option value disabled <?php echo e((old('present_status', null) || isset($staff) && $staff->present_status_id == null) ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $present_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" <?php echo e((old('present_status', 0) == $id || isset($staff) && $staff->present_status_id == $id) ? 'selected' : ''); ?>><?php echo e($status); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required"><?php echo e('Teaching Type'); ?>*</label>
                        <select class="form-control <?php echo e($errors->has('teaching_type') ? 'is-invalid' : ''); ?>" name="teaching_type" id="teaching_type" required>
                            <option value disabled <?php echo e((old('teaching_type', null) || isset($staff) && $staff->teaching_type_id == null) ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $teaching_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" <?php echo e((old('teaching_type', 0) == $id || isset($staff) && $staff->teaching_type_id == $id) ? 'selected' : ''); ?>><?php echo e($type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="col-xl-3 col-lg-6 col-12 form-group" id="teaching_type_part_time" <?php if($staff->teaching_type_id == 2): ?> style="display: inline-flex" <?php else: ?> style="display: none" <?php endif; ?>>
                        <label class="required">Other Teaching Type*</label>
                        <select class="form-control <?php echo e($errors->has('teaching_type_part_time') ? 'is-invalid' : ''); ?>" name="teaching_type_part_time" id="teaching_type_part_time">
                            <option value selected disabled ><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $teaching_type_part_time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" <?php echo e((old('teaching_type_part_time', 0) == $id || isset($staff) && $staff->teaching_type_part_time == $id) ? 'selected' : ''); ?>><?php echo e($type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required"><?php echo e('Academic Qualification'); ?>*</label>
                        <select class="form-control <?php echo e($errors->has('academic_qualification') ? 'is-invalid' : ''); ?>" name="academic_qualification" id="academic_qualification" required>
                            <option value disabled <?php echo e(old('academic_qualification', null)); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $academic_qualification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" <?php echo e((old('academic_qualification', 0) == $id || isset($staff) && $staff->academic_qualification->id == $id) ? 'selected' : ''); ?>><?php echo e($type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group" id="other_qualification" <?php if($staff->other_qualification = null): ?> style="display: none; <?php endif; ?>>
                        <label class="required">Other Qualification*</label>
                        <input type="text" name="other_qualification" id="other_qualification" class="form-control" value="<?php echo e($staff->other_qualification); ?>" >
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label class="required" for="staff_picture">Staff Picture</label>
                        <div class="needsclick dropzone <?php echo e($errors->has('staff_picture') ? 'is-invalid' : ''); ?>" id="staff_picture-dropzone">
                        </div>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                        <span class="help-block"><p class="text-danger">Note: Uploading a new file will replace the old file(s).</p></span>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label for="staff_document">Staff Documents</label>
                        <div class="needsclick dropzone <?php echo e($errors->has('staff_document') ? 'is-invalid' : ''); ?>" id="staff_document-dropzone">
                        </div>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                        <span class="help-block"><p class="text-danger">Note: Uploading a new file will replace the old file(s).</p></span>
                    </div>
                </div>
                <hr>
                <div class="row" id="teacher" <?php if($staff->academic_qualification_id == 1): ?> style="display: none;" <?php endif; ?>>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Rank</label>
                        <select class="form-control <?php echo e($errors->has('rank') ? 'is-invalid' : ''); ?>" name="rank" id="rank">
                            <option value="" selected disabled><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $ranks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id); ?>" 

                            <?php echo e(old('rank', $staff->rank_id ?? '') === (int) $id ? 'selected' : ''); ?>


                            ><?php echo e($label); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required"><?php echo e('Teaching Qualification'); ?></label>
                        <select class="form-control <?php echo e($errors->has('teaching_qualification') ? 'is-invalid' : ''); ?>" name="teaching_qualification" id="teaching_qualification">
                            <option value="" selected disabled><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $teaching_qualification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" 

                                <?php echo e(old('teaching_qualification', $staff->teaching_qualification->id ?? '') === (int) $id ? 'selected' : ''); ?>


                                ><?php echo e($type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="area_of_specialization">Area of Specialization</label>
                        <select class="form-control <?php echo e($errors->has('area_of_specialization') ? 'is-invalid' : ''); ?>" name="area_of_specialization" id="area_of_specialization">
                            <option value="" selected disabled><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" 
                                <?php echo e(old('area_of_specialization', $staff->area_of_specialization->id ?? '') === (int) $id ? 'selected' : ''); ?>

                                ><?php echo e($type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="subject_of_qualification">Subject of Qualification</label>
                        <select class="form-control <?php echo e($errors->has('subject_of_qualification') ? 'is-invalid' : ''); ?>" name="subject_of_qualification" id="subject_of_qualification">
                            <option value="" selected disabled><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" <?php echo e(old('subject_of_qualification', $staff->subject_of_qualification->id ?? '') === (int) $id ? 'selected' : ''); ?>><?php echo e($type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="subject_taught">Main Subject Taught</label>
                        <select class="form-control <?php echo e($errors->has('subject_taught') ? 'is-invalid' : ''); ?>" name="subject_taught" id="subject_taught">
                            <option value="" selected disabled><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" <?php echo e(old('subject_taught', $staff->subject_taught->id ?? '') === (int) $id ? 'selected' : ''); ?>><?php echo e($type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="seminar_workshop"><?php echo e('Has Teacher Attended Training Workshop/Seminar in the last 12 Months?'); ?></label>
                        <select class="form-control <?php echo e($errors->has('seminar_workshop') ? 'is-invalid' : ''); ?>" name="seminar_workshop" id="seminar_workshop" >
                            <option value="" selected disabled><?php echo e(trans('global.pleaseSelect')); ?></option>
                            <?php $__currentLoopData = $seminar_workshop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>" <?php echo e(old('seminar_workshop', $staff->seminar_workshop->id ?? '') === (int) $id ? 'selected' : ''); ?>><?php echo e($type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('')): ?>
                            <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                        <?php endif; ?>
                        <span class="help-block"><?php echo e('For Teaching Staffs'); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary col-lg-12" type="submit">Submit</button>
    </form>
    </div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php if(Auth::User()->is_zeqa): ?>
<script src="<?php echo e(asset('js/zeqa.js')); ?>"></script>
<?php endif; ?>
<script src="<?php echo e(asset('js/filter.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="academic_qualification"]').on('change', function(){
            var acad = $(this).val();
            
            if (acad != 1) {
                document.getElementById("teacher").style.display = "inline-flex";
            }else{
                document.getElementById("teacher").style.display = "none";
            }
        });
    });
    $(document).ready(function() {
        $('select[name="source_of_salary"]').on('change', function(){
            var school = $('#source_of_salary option:selected').text();

            if (school == "Others") {
                $('#other_salary_source').show();
            } else {
                $('#other_salary_source').hide();
            }
        });
    });
    $(document).ready(function() {
        $('select[name="academic_qualification"]').on('change', function(){
            var school = $('#academic_qualification option:selected').text();

            if (school == "Others") {
                $('#other_qualification').show();
                
            } else {
                $('#other_qualification').hide();
            }
        });
    });
    $(document).ready(function() {
        $('select[name="teaching_type"]').on('change', function(){
            var school = $(this).val();
            if (school == 2) {
                $('#teaching_type_part_time').show();
                
            } else {
                $('#teaching_type_part_time').hide();
            }
        });
    });
    $(document).ready(function() {
        $('select[name="state_origin"]').on('change', function(){
            var lga = $(this).val();
            if (lga){
                $.ajax({
                    url: '/admin/lga/fetchLgas/'+lga,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                    $("body").addClass("loading"); 
                    },
                    success: function(data){
                    $("body").removeClass("loading"); 
                         $('select[name="lga_origin"]').empty();
                         $('select[name="lga_origin"]').prepend('<option value="" disabled selected>Please Select</option>');
                         $.each(data, function(key, value){
                            $('select[name="lga_origin"]').append(
                                '<option value="'+key+'">'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="lga_origin"]').empty();
             }
        });
    });
</script>
<script>
    Dropzone.options.staffPictureDropzone = {
    url: '<?php echo e(route('admin.staffs.storeMedia')); ?>',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="staff_picture"]').remove()
      $('form').append('<input type="hidden" name="staff_picture" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="staff_picture"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
<?php if(isset($staffs) && $staffs->staff_picture): ?>
      var file = <?php echo json_encode($staffs->staff_picture); ?>

          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '<?php echo e($staffs->staff_picture->getUrl('thumb')); ?>')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="staff_picture" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
<?php endif; ?>
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
    var uploadedStaffDocumentMap = {}
Dropzone.options.staffDocumentDropzone = {
    url: '<?php echo e(route('admin.staffs.storeMedia')); ?>',
    maxFilesize: 8, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
    },
    params: {
      size: 8
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="staff_document[]" value="' + response.name + '">')
      uploadedStaffDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedStaffDocumentMap[file.name]
      }
      $('form').find('input[name="staff_document[]"][value="' + name + '"]').remove()
    },
    init: function () {
<?php if(isset($staffs) && $staffs->staff_document): ?>
          var files =
            <?php echo json_encode($staffs->staff_document); ?>

              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="staff_document[]" value="' + file.file_name + '">')
            }
<?php endif; ?>
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Project/DataStamp-LURITS_QA/resources/views/admin/staffs/edit.blade.php ENDPATH**/ ?>