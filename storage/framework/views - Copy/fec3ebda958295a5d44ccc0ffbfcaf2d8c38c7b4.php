<?php $__env->startSection('content'); ?>
<section class="content">
<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.create')); ?> <?php echo e(trans('cruds.asset.title_singular')); ?>

    </div>

    <div class="card-body">
        <form method="POST" action="<?php echo e(route("admin.assets.store")); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="form-group">
                <label class="required" for="category_id"><?php echo e(trans('cruds.asset.fields.category')); ?>*</label>
                <select class="form-control select2 <?php echo e($errors->has('category') ? 'is-invalid' : ''); ?>" name="category_id" id="category_id" required>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('category_id') == $id ? 'selected' : ''); ?>><?php echo e($category); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.asset.fields.category_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="serial_number"><?php echo e(trans('cruds.asset.fields.serial_number')); ?></label>
                <input class="form-control <?php echo e($errors->has('serial_number') ? 'is-invalid' : ''); ?>" type="text" name="serial_number" id="serial_number" value="<?php echo e(old('serial_number', '')); ?>">
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.asset.fields.serial_number_helper')); ?></span>
            </div>
            <div class="form-group">
                <label class="required" for="name"><?php echo e(trans('cruds.asset.fields.name')); ?></label>
                <input class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>" type="text" name="name" id="name" value="<?php echo e(old('name', '')); ?>" required>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.asset.fields.name_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="photos"><?php echo e(trans('cruds.asset.fields.photos')); ?></label>
                <div class="needsclick dropzone <?php echo e($errors->has('photos') ? 'is-invalid' : ''); ?>" id="photos-dropzone">
                </div>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.asset.fields.photos_helper')); ?></span>
            </div>
            <div class="form-group">
                <label class="required" for="status_id"><?php echo e(trans('cruds.asset.fields.status')); ?>*</label>
                <select class="form-control select2 <?php echo e($errors->has('status') ? 'is-invalid' : ''); ?>" name="status_id" id="status_id" required>
                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>" <?php echo e(old('status_id') == $id ? 'selected' : ''); ?>><?php echo e($status); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.asset.fields.status_helper')); ?></span>
            </div>
            <div class="form-group">
                <label for="notes"><?php echo e(trans('cruds.asset.fields.notes')); ?></label>
                <textarea class="form-control <?php echo e($errors->has('notes') ? 'is-invalid' : ''); ?>" name="notes" id="notes"><?php echo e(old('notes')); ?></textarea>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.asset.fields.notes_helper')); ?></span>
            </div>
            <?php if(Auth::User()->is_superAdmin || Auth::User()->is_admin): ?>
            <div class="form-group">
              <label for="assigned_to_id"><?php echo e(trans('cruds.asset.fields.assigned_to')); ?></label>
                <select class="form-control select2 <?php echo e($errors->has('assigned_to') ? 'is-invalid' : ''); ?>" name="assigned_to_id" id="assigned_to_id">
                  <option value="">Please Select</option>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.asset.fields.assigned_to_helper')); ?></span>
            </div>
            <?php endif; ?>
            <?php if(Auth::User()->is_headTeacher): ?>
            <div class="form-group">
                <label for="assigned_to_id"><?php echo e(trans('cruds.asset.fields.assigned_to')); ?></label>
                <select class="form-control select2 <?php echo e($errors->has('assigned_to') ? 'is-invalid' : ''); ?>" name="assigned_to_id" id="assigned_to_id">
                  <option value="">Please Select</option>
                    <?php $__currentLoopData = $assigned_tos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assigned_to): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($assigned_to->id); ?>" <?php echo e(old('assigned_to_id') == $assigned_to->id ? 'selected' : ''); ?>><?php echo e($assigned_to->first_name); ?> <?php echo e($assigned_to->middle_name); ?> <?php echo e($assigned_to->last_name); ?> - <?php echo e($assigned_to->staff_id); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('')): ?>
                    <span class="text-danger"><?php echo e($errors->first('')); ?></span>
                <?php endif; ?>
                <span class="help-block"><?php echo e(trans('cruds.asset.fields.assigned_to_helper')); ?></span>
            </div>
            <?php endif; ?>
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
<?php $__env->startSection('scripts'); ?>
<script>
    var uploadedPhotosMap = {}
Dropzone.options.photosDropzone = {
    url: '<?php echo e(route('admin.assets.storeMedia')); ?>',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
      uploadedPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotosMap[file.name]
      }
      $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
<?php if(isset($asset) && $asset->photos): ?>
          var files =
            <?php echo json_encode($asset->photos); ?>

              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
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
<?php if(Auth::User()->is_superAdmin || Auth::User()->is_admin || Auth::User()->is_zeqa): ?>
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
                    success: function(data){
                     $('select[name="assigned_to_id"]').empty();
                            $('select[name="assigned_to_id"]').prepend(
                            '<option value="">'+ "Please Select" +'</option>'
                            );
                         $.each(data, function(key, value){
                            $('select[name="assigned_to_id"]').append(
                                '<option value="'+value.id+'">'+ value.first_name + " " + value.middle_name +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="assigned_to_id"]').empty();
             }
        });
    });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Project/DataStamp-LURITS_QA/resources/views/admin/assets/create.blade.php ENDPATH**/ ?>