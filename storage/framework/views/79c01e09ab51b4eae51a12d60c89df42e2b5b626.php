<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="card">
        <div class="card-header">School Details</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>ID: <?php echo e($school->id); ?></h6>
                    <h6>Name: <?php echo e($school->name ?? ''); ?> </h6>
                    <h6><?php echo e(trans('cruds.team.fields.pseudo_code')); ?>: <?php echo e($school->pseudo_code ?? ''); ?></h6>
                    <h6><?php echo e(trans('cruds.team.fields.nemis_code')); ?>: <?php echo e($school->nemis_code ?? ''); ?></h6>
                    <h6><?php echo e(trans('cruds.team.fields.number_and_street')); ?>: <?php echo e($school->number_and_street ?? ''); ?></h6>
                    <h6><?php echo e(trans('cruds.team.fields.school_community')); ?>: <?php echo e($school->school_community ?? ''); ?></h6>
                    <h6><?php echo e(trans('cruds.team.fields.village_town')); ?>: <?php echo e($school->village_town ?? ''); ?></h6>
                    <h6><?php echo e(trans('cruds.team.fields.email_address')); ?>: <?php echo e($school->email_address ?? ''); ?></h6>
                </div>
                <div class="col-md-6">
                    <h6><?php echo e(trans('cruds.team.fields.school_telephone')); ?>: <?php echo e($school->school_telephone ?? ''); ?></h6>
                    <h6><?php echo e(trans('cruds.team.fields.code_type_sector')); ?>: <?php echo e($school->sector->title ?? ''); ?></h6>
                    <h6><?php echo e(trans('cruds.team.fields.latitude_north')); ?>: <?php echo e($school->latitude_north ?? ''); ?></h6>
                    <h6><?php echo e(trans('cruds.team.fields.longitude_east')); ?>: <?php echo e($school->longitude_east ?? ''); ?></h6>
                    <h6>LGA: <?php echo e($school->lga->atlas->name_atlas_entity ?? ''); ?></h6>
                    <h6><?php echo e(trans('cruds.team.fields.nearby_name_school')); ?>: <?php echo e($school->nearby_name_school ?? ''); ?></h6>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">School Background</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Year of Establishment: <?php echo e($school->background->year_establishment ?? ''); ?></h6>
                    <h6>Location: <?php echo e($school->background->schoolLocation->title ?? ''); ?></h6>
                    <h6>Type of School: <?php echo e($school->background->schoolType->title ?? ''); ?></h6>
                    <h6>Shifts: <?php echo e($school->background->shiftSystem->title ?? ''); ?></h6>
                    <h6>Shared facilties: <?php echo e($school->background->shareFacilities->title ?? ''); ?></h6>
                    <?php if($school->shared_facility == 1): ?>
                    <h6>Number of Shared Facilities: <?php echo e($school->no_shared_facilities ?? ''); ?></h6>
                    <h6>Facilties: <?php echo e($school->shared_facilities ?? ''); ?></h6>
                    <?php endif; ?>
                    <h6>Multi-grade Teaching: <?php echo e($school->background->multigradeTeaching->title ?? ''); ?></h6>
                    <h6>Average distance from Catchment Communities(KM): <?php echo e($school->background->distance_from_community ?? ''); ?></h6>
                    <h6>Distance from LGA (KM): <?php echo e($school->background->distance_from_lga ?? ''); ?></h6>
                    <h6>Distance from School: <?php echo e($school->background->no_students_distance_to_school ?? ''); ?></h6>
                    <h6>Students Boarding Male: <?php echo e($school->background->no_students_boarding_male ?? ''); ?></h6>
                    <h6>Students Boarding Female: <?php echo e($school->background->no_students_boarding_female ?? ''); ?></h6>
                    <h6>School Development Plan(SDP): <?php echo e($school->background->sdpYesNo->title ?? ''); ?></h6>
                    <h6>School Based Management Committee(SBMC): <?php echo e($school->background->sbmcYesNo->title ?? ''); ?></h6>
                </div>
                <div class="col-md-6">
                    <h6>Parent-Teacher Association (PTA): <?php echo e($school->background->ptaYesNo->title ?? ''); ?></h6>
                    <h6>Date of Last Inspection Visit: <?php echo e($school->background->date_last_inspection ?? ''); ?></h6>
                    <h6>Number of inspection Visit in last academic year: <?php echo e($school->background->no_inspection ?? ''); ?></h6>
                    <h6>Authority of Last Inspection: <?php echo e($school->background->schoolAuthority->title ?? ''); ?></h6>
                    <h6>Conditional Cash Transfer: <?php echo e($school->background->conditional_cash_transfer ?? ''); ?></h6>
                    <h6>School Grants: <?php echo e($school->background->schoolGrants->title ?? ''); ?></h6>
                    <h6>Security Guard: <?php echo e($school->background->securityGuard->title ?? ''); ?></h6>
                    <h6>Ownership: <?php echo e($school->background->schoolOwnership->title ?? ''); ?></h6>
                    <h6>Source of safe drinking water: <?php echo e($school->background->waterSource->title ?? ''); ?></h6>
                    <h6>Source of Electricity: <?php echo e($school->background->shiftSystem->title ?? ''); ?></h6>
                    <h6>Health Facility: <?php echo e($school->background->shiftSystem->title ?? ''); ?></h6>
                    <h6>Fence/Wall: <?php echo e($school->background->shiftSystem->title ?? ''); ?></h6>
                    <h6>Is there security situation that prevent school learners from learning in the last two months?: <?php echo e($school->background->securityChallange->title ?? ''); ?></h6>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">School Facilities</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h6>Toilets: </h6>
                    <h6>Computers: </h6>
                    <h6>Water Source(s): </h6>
                    <h6>Laboratories: </h6>
                    <h6>Classrooms: </h6>
                    <h6>Library: </h6>
                    <h6>Play Ground(s): </h6>
                    <h6>Wash Hand Facility: </h6>
                </div>
                <div class="col-md-4">
                   <h6><?php echo e($school->background->no_usable_toilets ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_usable_computers ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_usable_water_sources ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_usable_laboratories ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_usable_classrooms ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_usable_libraries ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_usable_play_grounds ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_usable_hand_wash_facilities ?? ''); ?></h6>
                </div>
                <div class="col-md-4">
                   <h6><?php echo e($school->background->no_unusable_toilets ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_unusable_computers ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_unusable_water_sources ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_unusable_laboratories ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_unusable_classrooms ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_unusable_libraries ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_unusable_play_grounds ?? ''); ?></h6>
                   <h6><?php echo e($school->background->no_unusable_hand_wash_facilities ?? ''); ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/schools/show.blade.php ENDPATH**/ ?>