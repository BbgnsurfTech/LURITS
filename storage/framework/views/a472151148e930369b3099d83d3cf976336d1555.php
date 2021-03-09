
<?php $__env->startSection('content'); ?>
<section class="content">
	<div class="card">
		<div class="card-header">Add Transfer</div>
		<div class="card-body">
			<form action="<?php echo e(route('admin.staff-transfer.store')); ?>" method="POST">
				<?php echo csrf_field(); ?>
				<?php echo method_field('POST'); ?>
                <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<div class="row">
					<div class="col-xl-3 col-lg-6 col-12 form-group">
						<label for="staff">Select Staff*</label>
						<select class="form-control" name="staff" id="staff" required>
							<option value="" disabled selected>Please Select</option>
						</select>
					</div>
				</div>
					<hr>
					<h5>Destination School</h5>
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
				<button type="submit" class="btn btn-primary">Save</button>
			</form>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
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
                     $('select[name="staff"]').empty();
                            $('select[name="staff"]').prepend(
                            '<option value="">'+ "Please Select" +'</option>'
                            );
                         $.each(data, function(key, value){
                            $('select[name="staff"]').append(
                                '<option value="'+value.id+'">'+ value.first_name  + " " + value.last_name + "  " + value.staff_id+'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="staff"]').empty();
             }
        });
    });

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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/staff-transfer/index.blade.php ENDPATH**/ ?>