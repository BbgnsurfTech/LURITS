<?php $__env->startSection('content'); ?>
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3><?php echo e(trans('global.add')); ?> <?php echo e('New'); ?> <?php echo e(trans('cruds.transfers.title_singular')); ?></h3>
            </div>
        </div>

    
        <form class="new-added-form" method="POST" action="<?php echo e(route("admin.transfer.store")); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo $__env->make('partials.filter.class', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
              <div class="col-xl-3 col-lg-6 col-12 form-group">
                <div class="form-group">
                  <label class="control-label">Student</label>
                    <select name="student_id" class="form-control input-lg dynamic" required>
                      <option value="">Select Student</option>
                    </select>
                </div>
              </div>
            </div>
            <hr>
            <?php if(Auth::User()->is_headTeacher): ?>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="child_name">Student</label>
                <select class="form-control select2 <?php echo e($errors->has('child_name') ? 'is-invalid' : ''); ?>" name="child_name" id="child_name">
                    <option disabled selected value=""><?php echo e(trans('global.pleaseSelect')); ?></option>
                    <?php $__currentLoopData = $studentAdmission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($child->id); ?>" <?php echo e(old('child_name') == $child->id ? 'selected' : ''); ?>><?php echo e($child->child_name); ?> <?php echo e($child->middle_name); ?> <?php echo e($child->last_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.transfers.fields.child_name_helper')); ?></span>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="pupils_conduct"><?php echo e(trans('cruds.transfers.fields.pupils_conduct')); ?></label>
                    <input class="form-control <?php echo e($errors->has('pupils_conduct') ? 'is-invalid' : ''); ?>" type="text" name="pupils_conduct" id="pupils_conduct" value="<?php echo e(old('pupils_conduct', '')); ?>">
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>                
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="reason_for_leaving"><?php echo e(trans('cruds.transfers.fields.reason_for_leaving')); ?></label>
                    <input class="form-control <?php echo e($errors->has('reason_for_leaving') ? 'is-invalid' : ''); ?>" type="text" name="reason_for_leaving" id="reason_for_leaving" value="<?php echo e(old('reason_for_leaving', '')); ?>">
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>                
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                   <label>Last Date of Attendance</label>
                    <input name="last_attendance_date" id="last_attendance_date" value="<?php echo e(old('last_attendance_date', '')); ?>" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                    <i class="far fa-calendar-alt"></i>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="last_class_attended"><?php echo e(trans('cruds.transfers.fields.lcp')); ?></label>
                    <select class="form-control <?php echo e($errors->has('last_class_attended') ? 'is-invalid' : ''); ?>" name="last_class_attended" id="last_class_attended" required>
                        <option disabled selected value=""><?php echo e(trans('global.pleaseSelect')); ?></option>
                    </select>
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>             
                </div>            
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="headteacher_name"><?php echo e(trans('cruds.transfers.fields.ht_name')); ?>*</label>
                    <input class="form-control <?php echo e($errors->has('headteacher_name') ? 'is-invalid' : ''); ?>" type="text" name="headteacher_name" id="headteacher_name" value="<?php echo e(old('headteacher_name', '')); ?>" required>
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>                
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="headteacher_phone"><?php echo e(trans('cruds.transfers.fields.ht_phone')); ?>*</label>
                    <input class="form-control <?php echo e($errors->has('headteacher_phone') ? 'is-invalid' : ''); ?>" type="text" name="headteacher_phone" id="headteacher_phone" value="<?php echo e(old('headteacher_phone', '')); ?>" maxlength="11" required>
                    <?php if($errors->has('')): ?>
                        <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                    <?php endif; ?>                
                </div>
            </div>
            <div class="col-12">
                <hr>
                <h4>Select Target School</h4>
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label">Country</label>
                            <select name="destination_country" class="form-control input-lg dynamic" id="destination_country" data-dependent="destination_state">
                                <option value="" selected disabled>Select Country</option>
                                <?php $__currentLoopData = $country_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country->code_atlas_entity); ?>"><?php echo e($country->name_atlas_entity); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label">State</label>
                            <select name="destination_state" class="form-control input-lg dynamic" id="destination_state" data-dependent="destination_lga">
                                <option value="" selected disabled>Select State</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label">LGA</label>
                            <select name="destination_lga" class="form-control input-lg dynamic" id="destination_lga" data-dependent="destination_school_sector">
                                <option disabled selected value="">Select LGA</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label">School Sector</label>
                            <select name="destination_school_sector" class="form-control input-lg dynamic" id="destination_school_sector" data-dependent="destination_school">
                                <option disabled selected value="">Select Sector</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label">School</label>
                            <select name="destination_school" class="form-control input-lg dynamic select2" id="destination_school">
                                <option disabled selected value="">Select School</option>
                            </select>
                        </div>
                    </div>
                </div>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/filter2.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="classs"]').on('change', function(){
            var classs = $(this).val();

             if (classs){
                $.ajax({
                    url: '/admin/lga/fetchStudent/'+classs,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                         $('select[name="student_id"]').empty();
                            $('select[name="student_id"]').prepend(
                            '<option value="">'+ "Please Select" +'</option>'
                            );
                         $.each(data, function(key, value){
                            $('select[name="student_id"]').append(
                                '<option value="'+value.id+'">'+ value.child_name + ' ' + value.middle_name + ' ' + value.last_name +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="student_id"]').empty();
             }
        });
    });
</script>
<script>
    $(document).ready(function(){
    $('select[name="destination_country"]').on('change', function(){
         var destination_country = $(this).val();

         if (destination_country){
            $.ajax({
                url: '/admin/lga/fetchStates/'+destination_country,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="destination_state"]').empty();
                     $('select[name="destination_state"]').prepend(
                            '<option disabled selected value="">'+ "Please Select" +'</option>'
                            );
                     $.each(data, function(key, value){
                        $('select[name="destination_state"]').append(
                            '<option value="'+key+'">'+ value +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="destination_state"]').empty();
         }
    });
});

$(document).ready(function(){
    $('select[name="destination_state"]').on('change', function(){
         var destination_state = $(this).val();
         
         if (destination_state){
            $.ajax({
                url: '/admin/lga/fetchLgas/'+destination_state,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="destination_lga"]').empty();
                     $('select[name="destination_lga"]').prepend(
                            '<option disabled selected value="">'+ "Please Select" +'</option>'
                            );
                     $.each(data, function(key, value){
                        $('select[name="destination_lga"]').append(
                            '<option value="'+key+'">'+key+'-'+ value +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="destination_lga"]').empty();
         }
    });
});

$(document).ready(function(){
    $('select[name="destination_lga"]').on('change', function(){
         var destination_lga = $(this).val();

         if (destination_lga){
            $.ajax({
                url: '/admin/lga/fetchSectors/',
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="destination_school_sector"]').empty();
                     $('select[name="destination_school_sector"]').prepend(
                            '<option disabled selected value="">'+ "Please Select" +'</option>'
                            );
                     $.each(data, function(key, value){
                        $('select[name="destination_school_sector"]').append(
                            '<option value="'+value.id+'">'+ value.title +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="destination_school_sector"]').empty();
         }
    });
});

    $(document).ready(function(){
        $('select[name="destination_school_sector"]').on('change', function(){
             var sector = $(this).val();
             var lga = $('select[name="lga"]').val();
             if (sector){
                $.ajax({
                    url: '/admin/lga/fetchSchools',
                    data: { lga: lga, sector: sector },
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                        $('.spinner').show();
                    },
                    success: function(data){
                        $('.spinner').hide();
                         $('select[name="destination_school"]').empty();
                         $.each(data, function(key, value){
                            $('select[name="destination_school"]').append(
                                '<option value="'+key+'">'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="destination_school"]').empty();
             }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Project/DataStamp-LURITS_QA/resources/views/admin/transfer/create.blade.php ENDPATH**/ ?>