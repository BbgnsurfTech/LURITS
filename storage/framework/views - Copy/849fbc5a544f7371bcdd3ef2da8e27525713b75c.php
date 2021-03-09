<?php if(Auth::User()->is_superAdmin || Auth::User()->is_admin): ?>
<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">Country</label>
            <select name="country" class="form-control input-lg dynamic" id="country" data-dependent="state">
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
            <select name="state" class="form-control input-lg dynamic" id="state" data-dependent="lga">
                <option value="" selected disabled>Select State</option>
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">LGA</label>
            <select name="lga" class="form-control input-lg dynamic" id="lga" data-dependent="school_sector">
                <option disabled selected value="">Select LGA</option>
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">School Sector</label>
            <select name="school_sector" class="form-control input-lg dynamic" id="school_sector" data-dependent="school">
                <option disabled selected value="">Select Sector</option>
            </select>
        </div>
    </div>
    
    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">School</label>
            <select name="school" class="form-control input-lg dynamic select2" id="school" data-dependent="classs">
                <option disabled selected value="">Select School</option>
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">Class</label>
            <select name="classs" class="form-control input-lg dynamic">
                <option disabled selected value="">Select Class</option>
            </select>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(Auth::User()->is_zeqa): ?>
<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">LGA</label>
            <select name="lga" class="form-control input-lg dynamic" id="lga" data-dependent="school_sector">
                <option value="">Select LGA</option>
                <?php $__currentLoopData = $lga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($lga->code_atlas_entity); ?>"><?php echo e($lga->name_atlas_entity); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">School Sector</label>
            <select name="school_sector" class="form-control input-lg dynamic" id="school_sector" data-dependent="school">
                <option disabled selected value="">Select Sector</option>
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

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">Class</label>
            <select name="classs" class="form-control input-lg dynamic">
                <option disabled selected value="">Select Class</option>
            </select>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(Auth::User()->is_lgea): ?>
<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">School</label>
            <select name="schooll" class="form-control input-lg dynamic" id="schooll">
                <option value="">Select School</option>
                <?php $__currentLoopData = $lgea; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($lga->id); ?>"><?php echo e($lga->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label">Class</label>
            <select name="classs" class="form-control input-lg dynamic">
                <option disabled selected value="">Select Class</option>
            </select>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(Auth::User()->is_headTeacher): ?>
    <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label" for="classs">Class</label>
            <select class="form-control" name="classs" id="classs">
                <option value="">Please Select</option>
                <?php $__currentLoopData = $classroom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($class->id); ?>"><?php echo e($class["classTitle"]->title); ?> - <?php echo e($class["armTitle"]->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /Users/mac/Project/DataStamp-LURITS_QA/resources/views/partials/filter/class.blade.php ENDPATH**/ ?>