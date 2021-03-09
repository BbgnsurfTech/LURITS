<?php $__env->startSection('content'); ?>
<section class="content">
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3><?php echo e(trans('global.add')); ?> <?php echo e('New'); ?> <?php echo e('Record'); ?></h3>
            </div>
        </div>

    
        <form class="new-added-form" method="POST" action="<?php echo e(route("admin.smr.store")); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
        <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="staff_id">Select Staff</label>
                <select class="form-control <?php echo e($errors->has('staff_id') ? 'is-invalid' : ''); ?>" name="staff_id" id="staff_id" required>
                    <option value=""><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($staff->id); ?>" <?php echo e(old('staff_id') == $staff->id ? 'selected' : ''); ?>><?php echo e($staff->first_name); ?> <?php echo e($staff->middle_name); ?> <?php echo e($staff->last_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="contact_number"><?php echo e('Contact Number'); ?></label>
                <input class="form-control <?php echo e($errors->has('contact_number') ? 'is-invalid' : ''); ?>" type="text" name="contact_number" id="contact_number" value="<?php echo e(old('contact_number', '')); ?>" maxlength="11">
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="purpose"><?php echo e('Purpose'); ?></label>
                <input class="form-control <?php echo e($errors->has('purpose') ? 'is-invalid' : ''); ?>" type="text" name="purpose" id="purpose" value="<?php echo e(old('purpose', '')); ?>">
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e('Reason for Leaving'); ?></span>
            </div>                        
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>Date</label>
                <input name="date" id="date" value="<?php echo e(old('date', '')); ?>" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="md-form mx-5 my-5">
               <label for="time_out">Time Out</label>
                <input name="time_out" id="time_out" value="<?php echo e(old('time_out', '')); ?>" type="time" class="form-control timepicker" data-position='bottom right' required>
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="md-form mx-5 my-5">
               <label for="time_back">Time Back</label>
                <input name="time_back" id="time_back" value="<?php echo e(old('time_back', '')); ?>" type="time" class="form-control timepicker" data-position='bottom right' required>
                <i class="far fa-calendar-alt"></i>
            </div>                        
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required"><?php echo e('Head Teachers Approval'); ?></label>
                <select class="form-control <?php echo e($errors->has('ht_approval') ? 'is-invalid' : ''); ?>" name="ht_approval" id="ht_approval" required>         
                <option value=""><?php echo e(trans('global.pleaseSelect')); ?></option>           
                    <?php $__currentLoopData = App\StaffMovementRecord::HT_APPROVAL; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(old('ht_approval', '255') === (string) $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>                
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
                                '<option value="'+value.id+'">'+ value.first_name  + " " + value.last_name + "  " + value.staff_id+'</option>'
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/smr/create.blade.php ENDPATH**/ ?>