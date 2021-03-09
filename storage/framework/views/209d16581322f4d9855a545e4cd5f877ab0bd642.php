<?php echo e(csrf_field()); ?>

<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">Country</label>
            <select name="country" class="form-control input-lg dynamic" id="country" data-dependent="state">
                <option value="">Select Country</option>
                <?php $__currentLoopData = $country_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($country->code_atlas_entity); ?>"><?php echo e($country->name_atlas_entity); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">State</label>
            <select name="state" class="form-control input-lg dynamic" id="state" data-dependent="lga">
                <option value="">Select State</option>
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">LGA</label>
            <select name="lga" class="form-control input-lg dynamic" id="lga" data-dependent="school">
                <option value="">Select LGA</option>
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">School</label>
            <select name="school" class="form-control input-lg dynamic" id="school">
                <option value="">Select School</option>
            </select>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/partials/filter.blade.php ENDPATH**/ ?>