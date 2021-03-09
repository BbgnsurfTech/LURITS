@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ 'Record' }}
    </div>

    <div class="card-body">
        <form class="new-added-form" method="POST" action="{{ route("admin.leave-certificate-records.update", [$leaveCertificateRecord->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="student_id">{{ 'Student' }}</label>
                <select class="form-control select2 {{ $errors->has('student_id') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                    @foreach($studentAdmission as $child)
                        <option value="{{ $child->id }}" {{ old('student_id', $leaveCertificateRecord->student_id) == $child->id ? 'selected' : '' }}>{{ $child->child_name }} {{ $child->middle_name }} {{ $child->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ 'Select Student' }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="certificate_number">{{ 'Certificate Number' }}</label>
                <input class="form-control {{ $errors->has('certificate_number') ? 'is-invalid' : '' }}" type="text" name="certificate_number" id="certificate_number" value="{{ old('certificate_number', $leaveCertificateRecord->certificate_number) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>Date of Graduation</label>
                <input name="date_of_graduation" id="date_of_graduation" value="{{ old('date_of_graduation', $leaveCertificateRecord->date_of_graduation) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="last_class_passed_id">{{ 'Last Class Passed' }}</label>
                <select class="form-control select2 {{ $errors->has('last_class_passed_id') ? 'is-invalid' : '' }}" name="last_class_passed_id" id="last_class_passed_id">
                    @foreach($classroom as $id => $last_class)
                        <option value="{{ $last_class->id }}" {{ old('last_class_passed_id', $leaveCertificateRecord->last_class_passed_id) == $last_class->id ? 'selected' : '' }}>{{ $last_class->class }} {{ $last_class->arms }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="parent_guardian_id">{{ 'Parent/Guardian' }}</label>
                <select class="form-control select2 {{ $errors->has('parent_guardian_id') ? 'is-invalid' : '' }}" name="parent_guardian_id" id="parent_guardian_id">
                    @foreach($parentGuardian as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_guardian_id', $leaveCertificateRecord->parent_guardian_id) == $parent->id ? 'selected' : '' }}>{{ $parent->child_name }} {{ $parent->middle_name }} {{ $parent->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ 'Select Parent/Guardian' }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="headteacher_name">{{ 'Head Teacher Name' }}</label>
                <input class="form-control {{ $errors->has('headteacher_name') ? 'is-invalid' : '' }}" type="text" name="headteacher_name" id="headteacher_name" value="{{ old('headteacher_name', $leaveCertificateRecord->headteacher_name) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="headteacher_phone">{{ 'Head Teacher Phone' }}</label>
                <input class="form-control {{ $errors->has('headteacher_phone') ? 'is-invalid' : '' }}" type="text" name="headteacher_phone" id="headteacher_phone" value="{{ old('headteacher_phone', $leaveCertificateRecord->headteacher_phone) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
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
