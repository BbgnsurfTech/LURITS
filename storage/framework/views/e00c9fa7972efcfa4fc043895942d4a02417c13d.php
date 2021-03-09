<?php $__env->startSection('content'); ?>
<div class="content">
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3><?php echo e(trans('global.add')); ?> <?php echo e('Leave'); ?></h3>
            </div>
        </div>
        <form class="new-added-form" method="POST" action="<?php echo e(route("admin.leave.store")); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
        <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leave_admin')): ?>          
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="staff_id">Staff</label>
                <select class="form-control select2 <?php echo e($errors->has('staff_id') ? 'is-invalid' : ''); ?>" name="staff_id" id="staff_id">
                    <option selected disabled value="">Please Select</option>
                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($staff->id); ?>" <?php echo e(old('staff_id') == $staff->id ? 'selected' : ''); ?>><?php echo e($staff->first_name); ?> <?php echo e($staff->middle_name); ?> <?php echo e($staff->last_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="contact_number">Contact Number</label>
                <input class="form-control <?php echo e($errors->has('contact_number') ? 'is-invalid' : ''); ?>" type="text" name="contact_number" id="contact_number" value="<?php echo e(old('contact_number', '')); ?>" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="address"><?php echo e('Address'); ?></label>
                <input class="form-control <?php echo e($errors->has('address') ? 'is-invalid' : ''); ?>" type="text" name="address" id="address" value="<?php echo e(old('address', '')); ?>" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="number_of_days">Number of Days</label>
                <input class="form-control <?php echo e($errors->has('number_of_days') ? 'is-invalid' : ''); ?>" max="11" type="text" name="number_of_days" id="number_of_days" value="<?php echo e(old('number_of_days', '')); ?>" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>                
            </div>                        
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">Leave Type</label>
                <select class="form-control <?php echo e($errors->has('leave_type') ? 'is-invalid' : ''); ?>" name="leave_type" id="leave_type" required>
                    <option disabled selected value="">Please Select</option>
                    <?php $__currentLoopData = App\Leave::LEAVE_TYPE; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(old('leave_type', '255') === (string) $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>Start Date</label>
                <input name="start_date" id="start_date" value="<?php echo e(old('start_date', '')); ?>" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>End Date</label>
                <input name="end_date" id="end_date" value="<?php echo e(old('end_date', '')); ?>" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leave_admin')): ?>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">Status</label>
                <select class="form-control <?php echo e($errors->has('status') ? 'is-invalid' : ''); ?>" name="status" id="status" required>      
                <option disabled selected value="">Please Select</option>
                    <?php $__currentLoopData = App\LEAVE::STATUS_SELECT; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(old('status', '255') === (string) $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>                
            </div>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leave_admin')): ?>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="remark">Remark</label>
                <input class="form-control <?php echo e($errors->has('remark') ? 'is-invalid' : ''); ?>" type="text" name="remark" id="remark" value="<?php echo e(old('remark', '')); ?>">
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>                
            </div>
            <?php endif; ?>
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-primary" type="submit">
                    <?php echo e(trans('global.save')); ?>

                </button>
            </div>
        </form>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php if(Auth::User()->is_superAdmin || Auth::User()->is_admin): ?>
<script src="<?php echo e(asset('js/filter.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="school"]').on('change', function(){
            var school = $(this).val();

            if (school){
                $.ajax({
                    url: '/admin/staff-transfer/fetchStaffs/'+school,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                    $('.spinner').show();
                    },
                    success: function(data){
                        $('.spinner').hide();
                     $('select[name="staff_id"]').empty();
                            $('select[name="staff_id"]').prepend(
                            '<option value="">'+ "Please Select" +'</option>'
                            );
                         $.each(data, function(key, value){
                            $('select[name="staff_id"]').append(
                                '<option value="'+value.id+'">'+ value.first_name  + " " + value.last_name + "  " + value.lga_staff_id+'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="staff_id"]').empty();
             }
        });
    });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/leave/create.blade.php ENDPATH**/ ?>