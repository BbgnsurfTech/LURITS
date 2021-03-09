@extends('layouts.admin')
@section('content')
<section class="content">
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} Staff
    </div>

    <div class="card-body">
    <form method="POST" id="staff-form" action="{{ route("admin.staffs.store") }}" enctype="multipart/form-data">
    @csrf
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
                <div class="row"><h4>Staff School</h4></div>
                @include('partials.filter.school')
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="first_name">{{ trans('cruds.teacher.fields.first_name') }}*</label>
                        <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.teacher.fields.first_name_helper') }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="middle_name">{{ trans('cruds.teacher.fields.middle_name') }}</label>
                        <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', '') }}">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.teacher.fields.middle_name_helper') }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="last_name">{{ trans('cruds.teacher.fields.last_name') }}*</label>
                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.teacher.fields.last_name_helper') }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Gender*</label>
                        <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                            <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($genders as $gender)
                                <option value="{{ $gender->id }}" {{ old('gender', '255') === (string) $gender->id ? 'selected' : '' }}>{{ $gender->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                       <label class="required">Date of Birth*</label>
                        <input name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', '') }}" type="text" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                        <i class="far fa-calendar-alt"></i>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">{{ trans('cruds.studentAdmission.fields.state_origin') }}*</label>
                        <select class="form-control {{ $errors->has('state_origin') ? 'is-invalid' : '' }}" name="state_origin" id="state_origin" data-dependent="lga_origin" required>
                            <option value disabled {{ old('state_origin', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($atlas->where('code_ds_atlas_entity', 2) as $state)
                                <option value="{{ $state->code_atlas_entity }}" {{ old('state_origin', '255') === (string) $state->code_atlas_entity ? 'selected' : '' }}>{{ $state->name_atlas_entity }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">LGA of Origin*</label>
                        <select name="lga_origin" required="" class="form-control input-lg dynamic" id="lga_origin">
                            <option value="">Select LGA</option>
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif    
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Marital Status*</label>
                        <select class="form-control {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" name="marital_status" id="marital_status" data-dependent="lga_origin" required>
                            <option value disabled {{ old('marital_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($marital_status as $status)
                                <option value="{{ $status->id }}" {{ old('marital_status', '255') === (string) $status->id ? 'selected' : '' }}>{{ $status->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Disability*</label>
                        <select class="form-control {{ $errors->has('disability') ? 'is-invalid' : '' }}" name="disability" id="disability" data-dependent="lga_origin" required>
                            <option value disabled {{ old('disability', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($disabilities as $status)
                                <option value="{{ $status->id }}" {{ old('disability', '255') === (string) $status->id ? 'selected' : '' }}>{{ $status->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="email">{{ trans('cruds.teacher.fields.email') }}*</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email') }}" required>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.teacher.fields.email_helper') }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="phone_number">{{ trans('cruds.teacher.fields.phone_number') }}*</label>
                        <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}" maxlength="11" required>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.teacher.fields.phone_number_helper') }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="address">{{ trans('cruds.studentAdmission.fields.address') }}*</label>
                        <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif 
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="first_appointment">Date of First Appointment*</label>
                        <input name="first_appointment" id="first_appointment" value="{{ old('first_appointment', '') }}" type="text" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                        <i class="far fa-calendar-alt"></i>
                        <!-- <input class="form-control {{ $errors->has('first_appointment') ? 'is-invalid' : '' }}" type="text" name="first_appointment" id="first_appointment" value="{{ old('first_appointment', '') }}" required> -->
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="present_appointment">Date of Present Appointment*</label>
                        <input name="present_appointment" id="present_appointment" value="{{ old('present_appointment', '') }}" type="text" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                        <!-- <input class="form-control {{ $errors->has('present_appointment') ? 'is-invalid' : '' }}" type="text" name="present_appointment" id="present_appointment" value="{{ old('present_appointment', '') }}" required> -->
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="posting_to_school">Date of Posting To This School*</label>
                        <input name="posting_to_school" id="posting_to_school" value="{{ old('posting_to_school', '') }}" type="text" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                        <!-- <input class="form-control {{ $errors->has('posting_to_school') ? 'is-invalid' : '' }}" type="text" name="posting_to_school" id="posting_to_school" value="{{ old('posting_to_school', '') }}" required> -->
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="grade_level">Grade Level</label>
                        <input class="form-control {{ $errors->has('grade_level') ? 'is-invalid' : '' }}" type="text" name="grade_level" id="grade_level" value="{{ old('grade_level', '') }}" maxlength="5">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="step">Step</label>
                        <input class="form-control {{ $errors->has('step') ? 'is-invalid' : '' }}" type="text" name="step" id="step" value="{{ old('step', '') }}" maxlength="5">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    @if(Auth::User()->is_headTeacher)
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Type of Staff*</label>
                        <select name="type_of_staff" class="form-control input-lg dynamic" id="type_of_staff" required>
                            <option value="" selected disabled>Select Staff</option>
                            @foreach($type_staff as $typeStaff)
                            <option value="{{ $typeStaff->id }}" {{ old('source_of_salary', '255') === (string) $typeStaff->id ? 'selected' : '' }}>{{ $typeStaff->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    @else
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Type of Staff*</label>
                        <select name="type_of_staff" class="form-control input-lg dynamic" id="type_of_staff" required>
                            <option value="">Select Staff</option>
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    @endif
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Source of Salary*</label>
                        <select class="form-control {{ $errors->has('source_of_salary') ? 'is-invalid' : '' }}" name="source_of_salary" id="source_of_salary" required>
                            <option value disabled {{ old('source_of_salary', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($salary_source as $key)
                                <option value="{{ $key->id }}" {{ old('source_of_salary', '255') === (string) $key->id ? 'selected' : '' }}>{{ $key->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group" id="other_salary_source" style="display: none;">
                        <label class="required">Other Salary Source*</label>
                        <input type="text" name="other_salary_source" id="other_salary_source" class="form-control">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Present Status*</label>
                        <select class="form-control {{ $errors->has('present') ? 'is-invalid' : '' }}" name="present" id="present" required>
                            <option value disabled {{ old('present', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($present_status as $key)
                                <option value="{{ $key->id }}" {{ old('present', '255') === (string) $key->id ? 'selected' : '' }}>{{ $key->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Teaching Type*</label>
                        <select class="form-control {{ $errors->has('teaching_type') ? 'is-invalid' : '' }}" name="teaching_type" id="teaching_type" required>
                            <option value disabled {{ old('teaching_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($teaching_type as $key)
                                <option value="{{ $key->id }}" {{ old('teaching_type', '255') === (string) $key->id ? 'selected' : '' }}>{{ $key->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group" id="teaching_type_part_time" style="display: none;">
                        <label class="required">Other Teaching Type*</label>
                        <select class="form-control {{ $errors->has('teaching_type_part_time') ? 'is-invalid' : '' }}" name="teaching_type_part_time" id="teaching_type_part_time">
                            <option value selected disabled {{ old('teaching_type_part_time', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($teaching_type_part_time as $key)
                                <option value="{{ $key->id }}" {{ old('teaching_type_part_time', '255') === (string) $key->id ? 'selected' : '' }}>{{ $key->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Academic Qualification*</label>
                        <select class="form-control {{ $errors->has('academic_qualification') ? 'is-invalid' : '' }}" name="academic_qualification" id="academic_qualification" required>
                            <option value="" disabled selected>Please Select</option>
                            @foreach($academic_qualification as $key)
                                <option value="{{ $key->id }}" >{{ $key->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group" id="other_qualification" style="display: none;">
                        <label class="required">Other Qualification*</label>
                        <input type="text" name="other_qualification" id="other_qualification" class="form-control">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label class="required" for="staff_picture">Staff Picture</label>
                        <div class="needsclick dropzone {{ $errors->has('staff_picture') ? 'is-invalid' : '' }}" id="staff_picture-dropzone">
                        </div>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label for="staff_document">Staff Documents</label>
                        <div class="needsclick dropzone {{ $errors->has('staff_document') ? 'is-invalid' : '' }}" id="staff_document-dropzone">
                        </div>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row" id="teacher" style="display: none;">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Rank</label>
                        <select class="form-control {{ $errors->has('rank') ? 'is-invalid' : '' }}" name="rank" id="rank">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($ranks as $key)
                                <option value="{{ $key->id }}" {{ old('rank', '255') === (string) $key->id ? 'selected' : '' }}>{{ $key->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required">Teaching Qualification*</label>
                        <select class="form-control {{ $errors->has('teaching_qualification') ? 'is-invalid' : '' }}" name="teaching_qualification" id="teaching_qualification">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($teaching_qualification as $key)
                                <option value="{{ $key->id }}" {{ old('teaching_qualification', '255') === (string) $key->id ? 'selected' : '' }}>{{ $key->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="area_of_specialization">Area of Specialization*</label>
                        <select class="form-control {{ $errors->has('area_of_specialization') ? 'is-invalid' : '' }}" name="area_of_specialization" id="area_of_specialization">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('area_of_specialization') == $subject->id ? 'selected' : '' }}>{{ $subject->ds_subject_title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group" id="other_area_of_specialization" style="display: none;">
                        <label class="required">Other Area of Specialization*</label>
                        <input type="text" name="other_area_of_specialization" id="other_area_of_specialization" class="form-control">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="subject_of_qualification">Subject of Qualification*</label>
                        <select class="form-control {{ $errors->has('subject_of_qualification') ? 'is-invalid' : '' }}" name="subject_of_qualification" id="subject_of_qualification">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_of_qualification') == $subject->id ? 'selected' : '' }}>{{ $subject->ds_subject_title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group" id="other_subject_of_qualification" style="display: none;">
                        <label class="required">Other Subject of Qualification*</label>
                        <input type="text" name="other_subject_of_qualification" id="other_subject_of_qualification" class="form-control">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label class="required" for="subject_taught">Main Subject Taught*</label>
                        <select class="form-control {{ $errors->has('subject_taught') ? 'is-invalid' : '' }}" name="subject_taught" id="subject_taught">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_taught') == $subject->id ? 'selected' : '' }}>{{ $subject->ds_subject_title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif                
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group" id="other_main_subject_taught" style="display: none;">
                        <label class="required">Other Main Subject Taught*</label>
                        <input type="text" name="other_main_subject_taught" id="other_main_subject_taught" class="form-control">
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label for="seminar_workshop">Has Teacher Attended Training Workshop/Seminar in the last 12 Months?*</label>
                        <select class="form-control {{ $errors->has('seminar_workshop') ? 'is-invalid' : '' }}" name="seminar_workshop" id="seminar_workshop" >
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($seminar_workshop as $key)
                                <option value="{{ $key->id }}" {{ old('seminar_workshop', '255') === (string) $key->id ? 'selected' : '' }}>{{ $key->title }}</option>
                            @endforeach
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">For Teaching Staffs</span>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary col-lg-12" type="submit">Submit</button>
    </form>
    </div>
</div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('js/filter.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="school"]').on('change', function(){
             var school = $(this).val();
             
             if (school){
                $.ajax({
                    url: '/admin/staffs/fetchSector/'+school,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                    },
                    success: function(data){ 
                        $('select[name="type_of_staff"]').empty();
                        $('select[name="type_of_staff"]').prepend('<option disabled selected value="">Please Select</option>');
                        $.each(data, function(key, value){
                            $('select[name="type_of_staff"]').append(
                                '<option value="'+value.id+'">'+ value.title +'</option>'
                            );
                        });
                    }
                });
             } else {
                $('select[name="type_of_staff"]').empty();
             }
        });
    });
    $(document).ready(function() {
        $('select[name="teaching_type"]').on('change', function(){
            var teaching_type = $(this).val();
            if (teaching_type == 2) {
                $('#teaching_type_part_time').show();
                
            } else {
                $('#teaching_type_part_time').hide();
            }
        });
    });
    $(document).ready(function() {
        $('select[name="academic_qualification"]').on('change', function(){
            var academic_qualification = $('#academic_qualification option:selected').text();

            if (academic_qualification == "Others") {
                $('#other_qualification').show();
                
            } else {
                $('#other_qualification').hide();
            }
        });
    });
    $(document).ready(function() {
        $('select[name="source_of_salary"]').on('change', function(){
            var source_of_salary = $('#source_of_salary option:selected').text();

            if (source_of_salary == "Others") {
                $('#other_salary_source').show();
            } else {
                $('#other_salary_source').hide();
            }
        });
    });
    $(document).ready(function() {
        $('select[name="area_of_specialization"]').on('change', function(){
            var source_of_salary = $('#area_of_specialization option:selected').text();

            if (source_of_salary == "Others") {
                $('#other_area_of_specialization').show();
            } else {
                $('#other_area_of_specialization').hide();
            }
        });
    });
    $(document).ready(function() {
        $('select[name="subject_of_qualification"]').on('change', function(){
            var source_of_salary = $('#subject_of_qualification option:selected').text();

            if (source_of_salary == "Others") {
                $('#other_subject_of_qualification').show();
            } else {
                $('#other_subject_of_qualification').hide();
            }
        });
    });
    $(document).ready(function() {
        $('select[name="subject_taught"]').on('change', function(){
            var source_of_salary = $('#subject_taught option:selected').text();

            if (source_of_salary == "Others") {
                $('#other_main_subject_taught').show();
            } else {
                $('#other_main_subject_taught').hide();
            }
        });
    });

    $(document).ready(function() {
        $('select[name="academic_qualification"]').on('change', function(){
            var academic_qualification = $(this).val();
            if (academic_qualification != 1) {
                document.getElementById("teacher").style.display = "inline-flex";
            }else{
                document.getElementById("teacher").style.display = "none";
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
                     $('.spinner').show();
                    },
                    success: function(data){
                     $('.spinner').hide();
                         $('select[name="lga_origin"]').empty();
                         $('select[name="lga_origin"]').prepend('<option disabled selected value="">Please Select</option>');
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
    url: '{{ route('admin.staffs.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
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
@if(isset($staffs) && $staffs->staff_picture)
      var file = {!! json_encode($staffs->staff_picture) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $staffs->staff_picture->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="staff_picture" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
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
    url: '{{ route('admin.staffs.storeMedia') }}',
    maxFilesize: 8, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
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
@if(isset($staffs) && $staffs->staff_document)
          var files =
            {!! json_encode($staffs->staff_document) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="staff_document[]" value="' + file.file_name + '">')
            }
@endif
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
@endsection