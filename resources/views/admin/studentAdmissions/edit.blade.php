@extends('layouts.admin')
@section('content')
<section class="content">
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.studentAdmission.title_singular') }}
    </div>

    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{ trans('global.edit') }} {{ trans('cruds.studentAdmission.title_singular') }}</h3>
            </div>
        </div>

    <form method="POST" id="staff-form" action="{{ route("admin.student-admissions.update", [$studentAdmission->id]) }}" enctype="multipart/form-data">
         @csrf
         @method('PUT')

        <div class="tab-content mt-4">
            @if(Auth::User()->is_superAdmin || Auth::User()->is_admin)
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">Country</label>
                    <select name="country" class="form-control input-lg dynamic" id="country" data-dependent="state">
                        <option value="" selected disabled>Select Country</option>
                        @foreach($country_list as $country)
                        <option value="{{ $country->code_atlas_entity }}">{{ $country->name_atlas_entity }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="control-label">State</label>
                    <select name="state" class="form-control input-lg dynamic" id="state" data-dependent="lga">
                        <option value="" selected disabled>Select State</option>
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="control-label">LGA</label>
                    <select name="lga" class="form-control input-lg dynamic" id="lga" data-dependent="school_sector">
                        <option disabled selected value="">Select LGA</option>
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="control-label">School Sector</label>
                    <select name="school_sector" class="form-control input-lg dynamic" id="school_sector" data-dependent="school">
                        <option disabled selected value="">Select Sector</option>
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">School*</label>
                    <select name="school" class="form-control input-lg dynamic" id="school" data-dependent="parent_guardian_id" required>
                        <option value="{{ $studentAdmission->school_enrolled->id }}">{{ $studentAdmission->school_enrolled->name }}</option>
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">{{ trans('cruds.studentAdmission.fields.parent_guardian') }}*</label>
                    <select name="parent_guardian_id" class="form-control select2 input-lg dynamic" id="parent_guardian_id" required>
                        <option value="{{ $studentAdmission->parent_guardian->id }}">{{ $studentAdmission->parent_guardian->first_name }} {{ $studentAdmission->parent_guardian->middle_name }} {{ $studentAdmission->parent_guardian->last_name }}</option>
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentAdmission.fields.parent_guardian_helper') }}</span>
                </div>
            </div>
            @endif
            @if(Auth::User()->is_zeqa)
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label">LGA</label>
                        <select name="lga" class="form-control input-lg dynamic" id="lga" data-dependent="school">
                            <option value="">Select LGA</option>
                            @foreach($lga as $lga)
                            <option value="{{ $lga->code_atlas_entity }}">{{ $lga->name_atlas_entity }}</option>
                            @endforeach
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
                        <select name="school" class="form-control input-lg dynamic" id="school" data-dependent="classs">
                            <option value="">Select School</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="required">{{ trans('cruds.studentAdmission.fields.parent_guardian') }}*</label>
                        <select name="parent_guardian_id" class="form-control select2 input-lg dynamic" id="parent_guardian_id" required>
                            <option value="{{ $studentAdmission->parent_guardian->id }}">{{ $studentAdmission->parent_guardian->first_name }} {{ $studentAdmission->parent_guardian->middle_name }} {{ $studentAdmission->parent_guardian->last_name }}</option>
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.studentAdmission.fields.parent_guardian_helper') }}</span>
                    </div>
                </div>
            </div>
            @endif
            @if(Auth::User()->is_lgea)
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label">School</label>
                        <select name="school" class="form-control input-lg dynamic" id="school" data-dependent="classs">
                            <option value="">Select School</option>
                            @foreach($lgea as $lga)
                            <option value="{{ $lga->id }}">{{ $lga->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="required">{{ trans('cruds.studentAdmission.fields.parent_guardian') }}*</label>
                        <select name="parent_guardian_id" class="form-control select2 input-lg dynamic" id="parent_guardian_id" required>
                            <option value="{{ $studentAdmission->parent_guardian->id }}">{{ $studentAdmission->parent_guardian->first_name }} {{ $studentAdmission->parent_guardian->middle_name }} {{ $studentAdmission->parent_guardian->last_name }}</option>
                        </select>
                        @if($errors->has(''))
                            <span class="text-danger">{{ $errors->first('') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.studentAdmission.fields.parent_guardian_helper') }}</span>
                    </div>
                </div>
            </div>
            @endif
            @if(Auth::User()->is_headTeacher)
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="parent_guardian_id">{{ trans('cruds.studentAdmission.fields.parent_guardian') }}</label>
                    <select class="form-control select2 {{ $errors->has('parent_guardian') ? 'is-invalid' : '' }}" name="parent_guardian_id" id="parent_guardian_id">
                        @foreach($parent_guardians as $parent_guardian)
                            <option value="{{ $parent_guardian->id }}" {{ ($studentAdmission->parent_guardian ? $studentAdmission->parent_guardian->id : old('parent_guardian_id')) == $parent_guardian->id ? 'selected' : '' }}>{{ $parent_guardian->first_name }} {{ $parent_guardian->middle_name }} {{ $parent_guardian->last_name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentAdmission.fields.parent_guardian_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">Parental Status*</label>
                    <select class="form-control {{ $errors->has('parental_status') ? 'is-invalid' : '' }}" name="parental_status" id="parental_status" data-dependent="lga_origin" required>
                        <option value disabled>{{ trans('global.pleaseSelect') }}</option>
                        @foreach($parental_statuses as $id => $parental_status)
                            <option value="{{ $id }}" {{ (old('parental_status', 0) == $id || isset($studentAdmission) && $studentAdmission->parental_status_id == $id) ? 'selected' : '' }}>{{ $parental_status }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
            @endif
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="admission_number">Admission Number</label>
                    <input class="form-control" type="text" name="admission_number" id="admission_number" value="{{ old('admission_number', $studentAdmission ->admission_number) }}" required disabled>
                </div>

                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="child_name">{{ trans('cruds.studentAdmission.fields.child_name') }}</label>
                    <input class="form-control {{ $errors->has('child_name') ? 'is-invalid' : '' }}" type="text" name="child_name" id="child_name" value="{{ old('child_name', $studentAdmission ->child_name) }}" required>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentAdmission.fields.child_name_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="middle_name">{{ trans('cruds.studentAdmission.fields.middle_name') }}</label>
                    <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $studentAdmission ->middle_name) }}">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentAdmission.fields.middle_name_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="last_name">{{ trans('cruds.studentAdmission.fields.last_name') }}</label>
                    <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $studentAdmission ->last_name) }}" required>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentAdmission.fields.last_name_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">{{ trans('cruds.studentAdmission.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                        <option value disabled >{{ trans('global.pleaseSelect') }}</option>
                        @foreach($genders as $id => $gender)
                            <option value="{{ $id }}" {{ (old('gender', 0) == $id || isset($studentAdmission) && $studentAdmission->gender->id == $id) ? 'selected' : '' }}>{{ $gender }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentAdmission.fields.gender_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                   <label class="required">Date of Birth*</label>
                    <input name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', date('Y/m/d', strtotime($studentAdmission->date_of_birth)) ) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                    <i class="far fa-calendar-alt"></i>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                   <label class="required">Date of Admission*</label>
                    <input name="date_of_admission" id="date_of_admission" value="{{ old('date_of_admission', date('Y/m/d', strtotime($studentAdmission->date_of_admission)) ) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                    <i class="far fa-calendar-alt"></i>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">Blood Group</label>
                    <select class="form-control {{ $errors->has('blood_group') ? 'is-invalid' : '' }}" name="blood_group" id="blood_group">
                        <option value disabled >{{ trans('global.pleaseSelect') }}</option>
                        @foreach($blood_groups as $id => $categories)
                            <option value="{{ $id }}" {{ (old('blood_group', 0) == $id || isset($studentAdmission) && $studentAdmission->bloodgroup->id == $id) ? 'selected' : '' }}>{{ $categories }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif    
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">Marital Status*</label>
                    <select class="form-control {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" name="marital_status" id="marital_status" required>
                        <option value disabled>{{ trans('global.pleaseSelect') }}</option>
                        @foreach($marital_status as $id => $categories)
                            <option value="{{ $id }}" {{ (old('marital_status', 0) == $id || isset($studentAdmission) && $studentAdmission->maritalstatus->id == $id) ? 'selected' : '' }}>{{ $categories }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">Special Needs*</label>
                    <select class="form-control {{ $errors->has('disability') ? 'is-invalid' : '' }}" name="disability" id="disability" data-dependent="lga_origin" required>
                        <option value disabled>{{ trans('global.pleaseSelect') }}</option>
                        @foreach($disabilities as $id => $status)
                            <option value="{{ $id }}" {{ (old('disability', 0) == $id || isset($studentAdmission) && $studentAdmission->disability == $id) ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="hobby">{{ trans('cruds.studentAdmission.fields.hubby') }}</label>
                    <input class="form-control {{ $errors->has('hobby') ? 'is-invalid' : '' }}" type="text" name="hobby" id="hobby" value="{{ old('hobby', $studentAdmission->hobby) }}">
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">State of Origin*</label>
                    <select class="form-control {{ $errors->has('state_origin') ? 'is-invalid' : '' }}" name="state_origin" id="state_origin" data-dependent="lga_origin" required>
                        <option value="{{ $studentAdmission->state_origin->code_atlas_entity }}">{{ $studentAdmission->state_origin->name_atlas_entity }}</option><hr>
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
                    <select name="lga_origin" class="form-control input-lg dynamic" id="lga_origin" required>
                        <option value="{{ $studentAdmission->lga_origin->code_atlas_entity }}">{{ $studentAdmission->lga_origin->name_atlas_entity }}</option>
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif    
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">{{ trans('cruds.studentAdmission.fields.religion') }}</label>
                    <select class="form-control {{ $errors->has('religion') ? 'is-invalid' : '' }}" name="religion" id="religion" required>
                        <option  >{{ trans('global.pleaseSelect') }}</option>
                        @foreach($religions as $id => $categories)
                            <option value="{{ $id }}" {{ (old('religion', 0) == $id || isset($studentAdmission) && $studentAdmission->religion->id == $id) ? 'selected' : '' }}>{{ $categories }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                @if(Auth::User()->is_headTeacher)
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="class_id">{{ trans('cruds.studentAdmission.fields.class') }}</label>
                    <select class="form-control select2 {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                        @foreach($classroom as $class_id)
                            <option value="{{ $class_id->id }}" {{ ($studentAdmission->class_id ? $studentAdmission->class_id : old('class_id')) == $class_id->id ? 'selected' : '' }}>{{ $class_id["classTitle"]->title }} - {{ $class_id["armTitle"]->title }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                @else
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="class_id">{{ trans('cruds.studentAdmission.fields.class') }}*</label>
                    <select class="form-control {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                        <option selected value="{{ $studentAdmission->classs->id }}">{{ $studentAdmission->classs->classTitle->title }} {{ $studentAdmission->classs->armTitle->title }}</option>
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentAdmission.fields.class_helper') }}</span>
                </div>
                @endif
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="address">{{ trans('cruds.studentAdmission.fields.address') }}</label>
                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $studentAdmission ->address) }}" required>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentAdmission.fields.address_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">Did Student Attended ECCD?*</label>
                    <select class="form-control {{ $errors->has('eccd') ? 'is-invalid' : '' }}" name="eccd" id="eccd" required>
                        <option value disabled {{ old('eccd', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach($ds_yes_no as $id => $yes_no)
                            <option value="{{ $id }}" {{ (old('eccd', 0) == $id || isset($studentAdmission) && $studentAdmission->eccd == $id) ? 'selected' : '' }}>{{ $yes_no }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required">Did Student Completed Primary 6?*</label>
                    <select class="form-control {{ $errors->has('comp_p6_yes_no') ? 'is-invalid' : '' }}" name="comp_p6_yes_no" id="comp_p6_yes_no" required>
                        <option value disabled {{ old('comp_p6_yes_no', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach($ds_yes_no as $id => $yes_no)
                            <option value="{{ $id }}" {{ (old('comp_p6_yes_no', 0) == $id || isset($studentAdmission) && $studentAdmission->comp_p6_yes_no == $id) ? 'selected' : '' }}>{{ $yes_no }}</option>
                        @endforeach
                    </select>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="student_picture">{{ trans('cruds.studentAdmission.fields.student_picture') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('student_picture') ? 'is-invalid' : '' }}" id="student_picture-dropzone">
                    </div>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentAdmission.fields.student_picture_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="student_document">{{ trans('cruds.studentAdmission.fields.student_document') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('student_document') ? 'is-invalid' : '' }}" id="student_document-dropzone">
                    </div>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.studentAdmission.fields.student_document_helper') }}</span>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
    </div>
</div>
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
    $('select[name="country"]').on('change', function(){
         var country = $(this).val();

         if (country){
            $.ajax({
                url: '/admin/lga/fetchStates/'+country,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="state"]').empty();
                     $('select[name="state"]').prepend(
                            '<option disabled selected value="">'+ "Please Select" +'</option>'
                            );
                     $.each(data, function(key, value){
                        $('select[name="state"]').append(
                            '<option value="'+key+'">'+ value +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="state"]').empty();
         }
    });
});

$(document).ready(function(){
    $('select[name="state"]').on('change', function(){
         var state = $(this).val();
         
         if (state){
            $.ajax({
                url: '/admin/lga/fetchLgas/'+state,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="lga"]').empty();
                     $('select[name="lga"]').prepend(
                            '<option disabled selected value="">'+ "Please Select" +'</option>'
                            );
                     $.each(data, function(key, value){
                        $('select[name="lga"]').append(
                            '<option value="'+key+'">'+key+'-'+ value +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="lga"]').empty();
         }
    });
});

$(document).ready(function(){
    $('select[name="lga"]').on('change', function(){
         var lga = $(this).val();

         if (lga){
            $.ajax({
                url: '/admin/lga/fetchSectors/',
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="school_sector"]').empty();
                     $('select[name="school_sector"]').prepend(
                            '<option disabled selected value="">'+ "Please Select" +'</option>'
                            );
                     $.each(data, function(key, value){
                        $('select[name="school_sector"]').append(
                            '<option value="'+value.id+'">'+ value.title +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="school_sector"]').empty();
         }
    });
});

    $(document).ready(function(){
        $('select[name="school_sector"]').on('change', function(){
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
                         $('select[name="school"]').empty();
                         $.each(data, function(key, value){
                            $('select[name="school"]').append(
                                '<option value="'+key+'">'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="school"]').empty();
             }
        });
    });

    $(document).ready(function(){
        $('select[name="school"]').on('change', function(){
             var school = $(this).val();

             if (school){
                $.ajax({
                    url: '/admin/student-admissions/fetchParents/'+school,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){ 
                        $('select[name="parent_guardian_id"]').empty();
                        $('select[name="parent_guardian_id"]').append(
                                '<option value="">'+ "Please Select" +'</option>'
                            );
                        $.each(data, function(key, value){
                            $('select[name="parent_guardian_id"]').append(
                                '<option value="'+value.id+'">'+ value.first_name + ' ' + value.middle_name + ' ' + value.last_name +'</option>'
                            );
                        });
                    }
                });
             } else {
                $('select[name="parent_guardian_id"]').empty();
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
                    $("body").addClass("loading"); 
                    },
                    success: function(data){
                    $("body").removeClass("loading"); 
                         $('select[name="lga_origin"]').empty();
                         $('select[name="lga_origin"]').append(
                                '<option value="">'+ "Please Select" +'</option>'
                                );
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
    Dropzone.options.studentPictureDropzone = {
    url: '{{ route('admin.student-admissions.storeMedia') }}',
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
      $('form').find('input[name="student_picture"]').remove()
      $('form').append('<input type="hidden" name="student_picture" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="student_picture"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($studentAdmission) && $studentAdmission->student_picture)
      var file = {!! json_encode($studentAdmission->student_picture) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $studentAdmission->student_picture->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="student_picture" value="' + file.file_name + '">')
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
    var uploadedStudentDocumentMap = {}
    Dropzone.options.studentDocumentDropzone = {
    url: '{{ route('admin.student-admissions.storeMedia') }}',
    maxFilesize: 8, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 8
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="student_document[]" value="' + response.name + '">')
      uploadedStudentDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedStudentDocumentMap[file.name]
      }
      $('form').find('input[name="student_document[]"][value="' + name + '"]').remove()
    },
    init: function () {
    @if(isset($studentAdmission) && $studentAdmission->student_document)
              var files =
                {!! json_encode($studentAdmission->student_document) !!}
                  for (var i in files) {
                  var file = files[i]
                  this.options.addedfile.call(this, file)
                  file.previewElement.classList.add('dz-complete')
                  $('form').append('<input type="hidden" name="student_document[]" value="' + file.file_name + '">')
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