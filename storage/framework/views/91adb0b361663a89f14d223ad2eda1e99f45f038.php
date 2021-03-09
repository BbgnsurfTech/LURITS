<?php $__env->startSection('content'); ?>
<section class="content">
	<div class="card">
		<div class="card-header">School Background Information</div>
		<div class="card-body">
			<form method="POST" action="<?php echo e(route("admin.schools.store-background")); ?>">
				<?php echo csrf_field(); ?>
				<div class="row">
					<table class="table">
						<thead>
							<th width="50px"></th>
							<th width="300px"></th>
						</thead>
						<tbody>
							<tr>
								<td>
									<label class="control-label">Year of Establishment</label>
								</td>
								<td>
									<input type="text" name="year_establishment" id="year_establishment" class="form-control" value="<?php echo e(old('date_last_inspection', $data->year_establishment)); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Location</label>
								</td>
								<td>
									<select class="form-control <?php echo e($errors->has('location') ? 'is-invalid' : ''); ?>" name="location" id="location" required>
				                        <option value disabled <?php echo e(old('location', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
				                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->location ? $data->location : old('location')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				                    </select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Type of School</label>
								</td>
								<td>
									<select class="form-control <?php echo e($errors->has('code_type_school') ? 'is-invalid' : ''); ?>" name="code_type_school" id="code_type_school" required>
				                        <option value disabled <?php echo e(old('code_type_school', null) === null ? 'selected' : ''); ?>><?php echo e(trans('global.pleaseSelect')); ?></option>
				                        <?php $__currentLoopData = $school_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->code_type_school ? $data->code_type_school : old('code_type_school')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				                    </select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Shifts</label>
									<p>Does School operate Shift System?</p>
								</td>
								<td>
									<select class="form-control" name="shift_system" id="shift_system">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $yes_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->shift_system ? $data->shift_system : old('shift_system')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Shared facilties</label>
									<p>Does the school share facilities/Teachers/Premises with any other school?</p>
									<p><b>If Yes. </b>List facilities</p>
								</td>
								<td>
									<select class="form-control" name="shared_facility" id="shared_facility">
										<option value="" disabled selected>Please Select</option>
										<option <?php if($data->shared_facility == 1): ?> selected <?php endif; ?> value="1">Yes</option>
										<option <?php if($data->shared_facility == 2): ?> selected <?php endif; ?> value="2">No</option>
									</select>
									<input type="text" name="shared_facilities" id="shared_facilities" class="form-control mt-4" value="<?php echo e(old('shared_facilities', $data->shared_facilities)); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Number of shared facilties</label>
								</td>
								<td>
									<input type="number" name="no_shared_facilities" id="no_shared_facilities" class="form-control" value="<?php echo e(old('no_shared_facilities', $data->no_shared_facilities)); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Multi-grade Teaching</label>
									<p>Does any teacher teach more than one class at the same time?</p>
								</td>
								<td>
									<select class="form-control" name="multigrade_teaching" id="multigrade_teaching">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $yes_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->multigrade_teaching ? $data->multigrade_teaching : old('multigrade_teaching')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">School: Average distance from Catchment Communities(KM)</label>
									<p>What is average distance of school from its catchment areas.</p>
								</td>
								<td>
									<input type="number" name="distance_from_community" id="distance_from_community" class="form-control" value="<?php echo e(old('distance_from_community', $data->distance_from_community)); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">School: Distance from LGA (KM)</label>
									<p>How many kilometers is the school away from LGA HQ?</p>
								</td>
								<td>
									<input type="number" name="distance_from_lga" id="distance_from_lga" class="form-control" value="<?php echo e(old('distance_from_lga', $data->distance_from_lga)); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Students: Distance from School</label>
									<p>How many students live further than 3(KM) from the school?</p>
								</td>
								<td>
									<input type="number" name="no_students_distance_to_school" id="no_students_distance_to_school" class="form-control" value="<?php echo e(old('no_students_distance_to_school', $data->no_students_distance_to_school)); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Students Boarding</label>
									<p>How many students board at school premises?</p>
									<p>Male</p>
									<p>Female</p>
								</td>
								<td>
									<input type="number" name="no_students_boarding_male" id="no_students_boarding_male" class="form-control mt-4" value="<?php echo e(old('no_students_boarding_male', $data->no_students_boarding_male)); ?>">
									<input type="number" name="no_students_boarding_female" id="no_students_boarding_female" class="form-control mt-4" value="<?php echo e(old('no_students_boarding_female', $data->no_students_boarding_female)); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">School Development Plan(SDP)</label>
									<p>Did school prepare (SDP) in the last school year?</p>
								</td>
								<td>
									<select class="form-control" name="sdp" id="sdp">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $yes_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->sdp ? $data->sdp : old('sdp')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">School Based Management Committee(SBMC)</label>
									<p>Does this school have SBMC, which met at least once last year?</p>
								</td>
								<td>
									<select class="form-control" name="sbmc" id="sbmc">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $yes_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->sbmc ? $data->sbmc : old('sbmc')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Parent-Teacher Association (PTA)</label>
									<p>Does this school have PTA, which met at least once last year?</p>
								</td>
								<td>
									<select class="form-control" name="pta" id="pta">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $yes_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->pta ? $data->pta : old('pta')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Date of Last Inspection Visit</label>
									<p>When was the school last inspected?</p>
									<label class="control-label">Number of inspection Visit in last academic year?</label>
								</td>
								<td>
									<input name="date_last_inspection" id="date_last_inspection" value="<?php echo e(old('date_last_inspection', $data->date_last_inspection)); ?>" type="text" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                        			<i class="far fa-calendar-alt"></i>
                        			<input type="number" name="no_inspection" id="no_inspection" class="form-control mt-4" value="<?php echo e(old('no_inspection', $data->no_inspection)); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Authority of Last Inspection</label>
									<p>Which authority conducted the last inspection visit?</p>
								</td>
								<td>
									<select class="form-control" name="authority_last_inspection" id="authority_last_inspection">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $authority; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->authority_last_inspection ? $data->authority_last_inspection : old('authority_last_inspection')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Conditional Cash Transfer</label>
									<p>How many pupils benefited from Conditional Cash Transfer?</p>
								</td>
								<td>
									<input type="number" name="conditional_cash_transfer" id="conditional_cash_transfer" class="form-control" value="<?php echo e(old('conditional_cash_transfer', $data->conditional_cash_transfer)); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">School Grants</label>
									<p>Has your school ever received grants in the last academic year?</p>
								</td>
								<td>
									<select class="form-control" name="school_grants" id="school_grants">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $yes_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->school_grants ? $data->school_grants : old('school_grants')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Security Guard</label>
									<p>Does this school have a security guard?</p>
								</td>
								<td>
									<select class="form-control" name="security_guard" id="security_guard">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $yes_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->security_guard ? $data->security_guard : old('security_guard')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Ownership</label>
									<p>Which of the following owns the school?</p>
								</td>
								<td>
									<select class="form-control" name="ownership" id="ownership">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $ownership; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->ownership ? $data->ownership : old('ownership')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Source of safe drinking water</label>
									<p>Is there a source of water in the school that is <b>safe</b> to drink and in <b>sufficient</b> quantity to provide water every day for students? If there is more than one source, <b>select only the main primary source.</b></p>
								</td>
								<td>
									<select class="form-control" name="source_of_water" id="source_of_water">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $water_source; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->source_of_water ? $data->source_of_water : old('source_of_water')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Source of Electricity</label>
									<p>If there is more than one source, <b>select only the main primary source.</b></p>
								</td>
								<td>
									<select class="form-control" name="source_of_electricity" id="source_of_electricity">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $electricity_source; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->source_of_electricity ? $data->source_of_electricity : old('source_of_electricity')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Health Facility</label>
									<p>Does the school have a health facility?</p>
								</td>
								<td>
									<select class="form-control" name="health_facility" id="health_facility">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $health_facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->health_facility ? $data->health_facility : old('health_facility')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Fence/Wall</label>
									<p>Does the school have a fence or wall around it?</p>
								</td>
								<td>
									<select class="form-control" name="fence_wall" id="fence_wall">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $yes_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->fence_wall ? $data->fence_wall : old('fence_wall')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Security Challange</label>
									<p>Is there security situation that prevent school learners from learning in the last two months?</p>
								</td>
								<td>
									<select class="form-control" name="security" id="security">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $yes_no; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->security ? $data->security : old('security')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Shared Facilities</label>
									<p>If your school share facilities, specify the facilities shared by ticking the appropriate box</p>
								</td>
								<td>
									<div class="form-group">
						                <label class="required" for="shared_facilities">Shared Facilities</label>
						                <div style="padding-bottom: 4px">
						                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0"><?php echo e(trans('global.select_all')); ?></span>
						                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0"><?php echo e(trans('global.deselect_all')); ?></span>
						                </div>
						                <select class="form-control select2 <?php echo e($errors->has('shared_facilities') ? 'is-invalid' : ''); ?>" name="shared_facilities[]" id="shared_facilities" multiple required>
						                    <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                        <option value="<?php echo e($key); ?>" ><?php echo e($facility); ?></option>
						                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						                </select>
						                <?php if($errors->has('shared_facilities')): ?>
						                    <span class="text-danger"><?php echo e($errors->first('shared_facilities')); ?></span>
						                <?php endif; ?>
						            </div>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Play Room</label>
									<p>Does the school have a playroom for ECCD? </p>
								</td>
								<td>
									<select class="form-control" name="eccd_playroom" id="eccd_playroom">
										<option value="" disabled selected>Please Select</option>
										<?php $__currentLoopData = $play_rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                            <option value="<?php echo e($key); ?>" <?php echo e(($data->eccd_playroom ? $data->eccd_playroom : old('eccd_playroom')) == $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
				                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Play Facilities</label>
									<p>Does the school have play facilities for ECCD? Tick all that apply</p>
								</td>
								<td>
									<div class="form-group">
						                <label class="required" for="eccd_play_facilities">Play Facilities</label>
						                <div style="padding-bottom: 4px">
						                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0"><?php echo e(trans('global.select_all')); ?></span>
						                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0"><?php echo e(trans('global.deselect_all')); ?></span>
						                </div>
						                <select class="form-control select2 <?php echo e($errors->has('eccd_play_facilities') ? 'is-invalid' : ''); ?>" name="eccd_play_facilities[]" id="eccd_play_facilities" multiple required>
						                    <?php $__currentLoopData = $play_facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                        <option value="<?php echo e($key); ?>" <?php echo e((in_array($key, old('eccd_play_facilities', [])) || ($data->eccd_play_facilities ? $data->eccd_play_facilities->contains($key) : '')) ? 'selected' : ''); ?>><?php echo e($facility); ?></option>
						                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						                </select>
						                <?php if($errors->has('eccd_play_facilities')): ?>
						                    <span class="text-danger"><?php echo e($errors->first('eccd_play_facilities')); ?></span>
						                <?php endif; ?>
						            </div>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Learning Materials</label>
									<p>Does the school have learning materials ECCD? Tick all that apply</p>
								</td>
								<td>
									<div class="form-group">
						                <label class="required" for="eccd_learning_materials">Learning Materials</label>
						                <div style="padding-bottom: 4px">
						                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0"><?php echo e(trans('global.select_all')); ?></span>
						                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0"><?php echo e(trans('global.deselect_all')); ?></span>
						                </div>
						                <select class="form-control select2 <?php echo e($errors->has('eccd_learning_materials') ? 'is-invalid' : ''); ?>" name="eccd_learning_materials[]" id="eccd_learning_materials" multiple required>
						                    <?php $__currentLoopData = $learning_materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                        <option value="<?php echo e($key); ?>" <?php echo e((in_array($key, old('eccd_learning_materials', [])) || ($data->eccd_learning_materials ? $data->eccd_learning_materials->contains($key) : '')) ? 'selected' : ''); ?>><?php echo e($facility); ?></option>
						                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						                </select>
						                <?php if($errors->has('eccd_learning_materials')): ?>
						                    <span class="text-danger"><?php echo e($errors->first('eccd_learning_materials')); ?></span>
						                <?php endif; ?>
						            </div>
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">School Number and Street</label>
								</td>
								<td>
									<input type="text" name="number_and_street" placeholder="Number and Street" value="<?php echo e($schoolData->number_and_street ?? ''); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">School Community</label>
								</td>
								<td>
									<input type="text" name="school_community" placeholder="School Community" value="<?php echo e($schoolData->school_community ?? ''); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">School Village/Town</label>
								</td>
								<td>
									<input type="text" name="village_town" placeholder="School Village/Town" value="<?php echo e($schoolData->village_town ?? ''); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">School Email</label>
								</td>
								<td>
									<input type="text" name="email_address" placeholder="School Email" value="<?php echo e($schoolData->email_address ?? ''); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">School Telephone</label>
								</td>
								<td>
									<input type="text" name="school_telephone" placeholder="School Telephone" value="<?php echo e($schoolData->school_telephone ?? ''); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Lattitude/Longitude</label>
								</td>
								<td>
									<input type="text" name="latitude_north" placeholder="Lattitude" value="<?php echo e($schoolData->latitude_north ?? ''); ?>">
									<input type="text" name="longitude_east" placeholder="Longitude" value="<?php echo e($schoolData->longitude_east ?? ''); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">School Ward</label>
								</td>
								<td>
									<input type="text" name="ward" placeholder="Ward" value="<?php echo e($schoolData->ward ?? ''); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">Number of rooms other than classrooms that are in the school by type of room</label>
								</td>
								<td>
									<label for="no_staff_rooms">Staff Rooms</label>
									<input type="text" name="no_staff_rooms" id="no_staff_rooms" placeholder="Staff Rooms" value="<?php echo e($schoolData->no_staff_rooms ?? ''); ?>">
									<br>
									<label for="no_office">Office</label>
									<input type="text" name="no_office" id="no_office" placeholder="Office" value="<?php echo e($schoolData->no_office ?? ''); ?>">
									<br>
									<label for="no_library">Library</label>
									<input type="text" name="no_library" id="no_library" placeholder="Library" value="<?php echo e($schoolData->no_library ?? ''); ?>">
									<br>
									<label for="no_laboratories">Laboratories</label>
									<input type="text" name="no_laboratories" id="no_laboratories" placeholder="Laboratories" value="<?php echo e($schoolData->no_laboratories ?? ''); ?>">
									<br>
									<label for="no_store_room">Store Room</label>
									<input type="text" name="no_store_room" id="no_store_room" placeholder="Store room" value="<?php echo e($schoolData->no_store_room ?? ''); ?>">
									<br>
									<label for="no_other_rooms">Others</label>
									<input type="text" name="no_other_rooms" id="no_other_rooms" placeholder="Others" value="<?php echo e($schoolData->no_other_rooms ?? ''); ?>">
								</td>
							</tr>
							<tr>
								<td>
									<label class="control-label">SBMC Chairperson Details</label>
								</td>
								<td>
									<label for="sbmc_chair_name">Name</label>
									<input type="text" name="sbmc_chair_name" id="sbmc_chair_name" placeholder="Name" value="<?php echo e($schoolData->sbmc_chair_name ?? ''); ?>">
									<br>
									<label for="sbmc_chair_phone_number">Phone Number</label>
									<input type="text" name="sbmc_chair_phone_number" id="sbmc_chair_phone_number" placeholder="Phone Number" value="<?php echo e($schoolData->sbmc_chair_phone_number ?? ''); ?>">
									<br>
									<label for="sbmc_chair_position">Position</label>
									<input type="text" name="sbmc_chair_position" id="sbmc_chair_position" placeholder="Position" value="<?php echo e($schoolData->sbmc_chair_position ?? ''); ?>">
									<br>
									<br>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="table">
						<thead>
							<th>School Facilities</th>
							<th>Usable</th>
							<th>Not Usable</th>
						</thead>
						<tbody>
							<tr>
								<td>Toilets</td>
								<td><input type="number" name="no_usable_toilets" id="no_usable_toilets" class="form-control" value="<?php echo e(old('no_usable_toilets', $data->no_usable_toilets)); ?>"></td>
								<td><input type="number" name="no_unusable_toilets" id="no_unusable_toilets" class="form-control" value="<?php echo e(old('no_unusable_toilets', $data->no_unusable_toilets)); ?>"></td>
							</tr>
							<tr>
								<td>Computers</td>
								<td><input type="number" name="no_usable_computers" id="no_usable_computers" class="form-control" value="<?php echo e(old('no_usable_computers', $data->no_usable_computers)); ?>"></td>
								<td><input type="number" name="no_unusable_computers" id="no_unusable_computers" class="form-control" value="<?php echo e(old('no_unusable_computers', $data->no_unusable_computers)); ?>"></td>
							</tr>
							<tr>
								<td>Water Source(s)</td>
								<td><input type="number" name="no_usable_water_sources" id="no_usable_water_sources" class="form-control" value="<?php echo e(old('no_usable_water_sources', $data->no_usable_water_sources)); ?>"></td>
								<td><input type="number" name="no_unusable_water_sources" id="no_unusable_water_sources" class="form-control" value="<?php echo e(old('no_unusable_water_sources', $data->no_unusable_water_sources)); ?>"></td>
							</tr>
							<tr>
								<td>Laboratories</td>
								<td><input type="number" name="no_usable_laboratories" id="no_usable_laboratories" class="form-control" value="<?php echo e(old('no_usable_laboratories', $data->no_usable_laboratories)); ?>"></td>
								<td><input type="number" name="no_unusable_laboratories" id="no_unusable_laboratories" class="form-control" value="<?php echo e(old('no_unusable_laboratories', $data->no_unusable_laboratories)); ?>"></td>
							</tr>
							<tr>
								<td>Classrooms</td>
								<td><input type="number" name="no_usable_classrooms" id="no_usable_classrooms" class="form-control" value="<?php echo e(old('no_usable_classrooms', $data->no_usable_classrooms)); ?>"></td>
								<td><input type="number" name="no_unusable_classrooms" id="no_unusable_classrooms" class="form-control" value="<?php echo e(old('no_unusable_classrooms', $data->no_unusable_classrooms)); ?>"></td>
							</tr>
							<tr>
								<td>Library</td>
								<td><input type="number" name="no_usable_libraries" id="no_usable_libraries" class="form-control" value="<?php echo e(old('no_usable_libraries', $data->no_usable_libraries)); ?>"></td>
								<td><input type="number" name="no_unusable_libraries" id="no_unusable_libraries" class="form-control" value="<?php echo e(old('no_unusable_libraries', $data->no_unusable_libraries)); ?>"></td>
							</tr>
							<tr>
								<td>Play Ground(s)</td>
								<td><input type="number" name="no_usable_play_grounds" id="no_usable_play_grounds" class="form-control" value="<?php echo e(old('no_usable_play_grounds', $data->no_usable_play_grounds)); ?>"></td>
								<td><input type="number" name="no_unusable_play_grounds" id="no_unusable_play_grounds" class="form-control" value="<?php echo e(old('no_unusable_play_grounds', $data->no_unusable_play_grounds)); ?>"></td>
							</tr>
							<tr>
								<td>Wash Hand Facility</td>
								<td><input type="number" name="no_usable_hand_wash_facilities" id="no_usable_hand_wash_facilities" class="form-control" value="<?php echo e(old('no_usable_hand_wash_facilities', $data->no_usable_hand_wash_facilities)); ?>"></td>
								<td><input type="number" name="no_unusable_hand_wash_facilities" id="no_unusable_hand_wash_facilities" class="form-control" value="<?php echo e(old('no_unusable_hand_wash_facilities', $data->no_unusable_hand_wash_facilities)); ?>"></td>
							</tr>
						</tbody>
					</table>
				</div>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/schools/background.blade.php ENDPATH**/ ?>