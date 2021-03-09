@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.teacher.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.teachers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="staff_file_number">{{ 'Staff File Number' }}</label>
                <input class="form-control {{ $errors->has('staff_file_number') ? 'is-invalid' : '' }}" type="text" name="staff_file_number" id="staff_file_number" value="{{ old('staff_file_number', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="first_name">{{ trans('cruds.teacher.fields.first_name') }}</label>
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
                <label class="required" for="last_name">{{ trans('cruds.teacher.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.teacher.fields.last_name_helper') }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label class="required">Date of Birth</label>
                <input name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="first_appointment">{{ 'Year of First Appointment' }}</label>
                <input class="form-control {{ $errors->has('first_appointment') ? 'is-invalid' : '' }}" type="text" name="first_appointment" id="first_appointment" value="{{ old('first_appointment', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="present_appointment">{{ 'Year of Present Appointment' }}</label>
                <input class="form-control {{ $errors->has('present_appointment') ? 'is-invalid' : '' }}" type="text" name="present_appointment" id="present_appointment" value="{{ old('present_appointment', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="posting_to_school">{{ 'Year of Posting To This School' }}</label>
                <input class="form-control {{ $errors->has('posting_to_school') ? 'is-invalid' : '' }}" type="text" name="posting_to_school" id="posting_to_school" value="{{ old('posting_to_school', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="grade_step">{{ 'Grade Level/Step' }}</label>
                <input class="form-control {{ $errors->has('grade_step') ? 'is-invalid' : '' }}" type="text" name="grade_step" id="grade_step" value="{{ old('grade_step', '') }}" placeholder="e.g 7/2" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ 'Gender' }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Teacher::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ 'Type of Staff' }}</label>
                <select class="form-control {{ $errors->has('type_of_staff') ? 'is-invalid' : '' }}" name="type_of_staff" id="type_of_staff" required>
                    <option value disabled {{ old('type_of_staff', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Teacher::TYPE_OF_STAFF as $key => $label)
                        <option value="{{ $key }}" {{ old('type_of_staff', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ 'Source of Salary' }}</label>
                <select class="form-control {{ $errors->has('source_of_salary') ? 'is-invalid' : '' }}" name="source_of_salary" id="source_of_salary" required>
                    <option value disabled {{ old('source_of_salary', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Teacher::SOURCE_OF_SALARY as $key => $label)
                        <option value="{{ $key }}" {{ old('source_of_salary', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ 'Present' }}</label>
                <select class="form-control {{ $errors->has('present') ? 'is-invalid' : '' }}" name="present" id="present" required>
                    <option value disabled {{ old('present', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Teacher::PRESENT as $key => $label)
                        <option value="{{ $key }}" {{ old('present', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ 'Academic Qualification' }}</label>
                <select class="form-control {{ $errors->has('academic_qualification') ? 'is-invalid' : '' }}" name="academic_qualification" id="academic_qualification" required>
                    <option value disabled {{ old('academic_qualification', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Teacher::ACADEMIC_QUALIFICATION as $key => $label)
                        <option value="{{ $key }}" {{ old('academic_qualification', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ 'Teaching Qualification' }}</label>
                <select class="form-control {{ $errors->has('teaching_qualification') ? 'is-invalid' : '' }}" name="teaching_qualification" id="teaching_qualification" required>
                    <option value disabled {{ old('teaching_qualification', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Teacher::TEACHING_QUALIFICATION as $key => $label)
                        <option value="{{ $key }}" {{ old('teaching_qualification', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="area_of_specialization">Area of Specialization</label>
                <select class="form-control select2 {{ $errors->has('area_of_specialization') ? 'is-invalid' : '' }}" name="area_of_specialization" id="area_of_specialization">
                    <option id="none" name="none" value="0" {{ old('none') }}>None</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ old('area_of_specialization') == $subject->id ? 'selected' : '' }}>{{ $subject->ds_subject_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ 'Teaching Type' }}</label>
                <select class="form-control {{ $errors->has('teaching_type') ? 'is-invalid' : '' }}" name="teaching_type" id="teaching_type" required>
                    <option value disabled {{ old('teaching_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Teacher::TEACHING_TYPE as $key => $label)
                        <option value="{{ $key }}" {{ old('teaching_type', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="subject_of_qualification">Subject of Qualification</label>
                <select class="form-control select2 {{ $errors->has('subject_of_qualification') ? 'is-invalid' : '' }}" name="subject_of_qualification" id="subject_of_qualification">
                    <option id="none" name="none" value="0" {{ old('none') }}>None</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ old('subject_of_qualification') == $subject->id ? 'selected' : '' }}>{{ $subject->ds_subject_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="subject_taught">Main Subject Taught</label>
                <select class="form-control select2 {{ $errors->has('subject_taught') ? 'is-invalid' : '' }}" name="subject_taught" id="subject_taught">
                    <option id="none" name="none" value="0" {{ old('none') }}>None</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ old('subject_taught') == $subject->id ? 'selected' : '' }}>{{ $subject->ds_subject_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="email">{{ trans('cruds.teacher.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.teacher.fields.email_helper') }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="phone_number">{{ trans('cruds.teacher.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.teacher.fields.phone_number_helper') }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="seminar_workshop">{{ 'Has Teacher Attended Training Workshop/Seminar in the last 12 Months?' }}</label>
                <select class="form-control {{ $errors->has('seminar_workshop') ? 'is-invalid' : '' }}" name="seminar_workshop" id="seminar_workshop" required>
                    <option value disabled {{ old('seminar_workshop', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Teacher::SEMINAR_WORKSHOP as $key => $label)
                        <option value="{{ $key }}" {{ old('seminar_workshop', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ 'For Teaching Staffs' }}</span>
            </div>
        </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection