@extends('layouts.admin')
@section('content')
<!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <ul>
                        <li>
                            <a href="{{ route("admin.leave-certificate-records.index") }}">Home</a>
                        </li>                        
                        <li>{{ 'Leaving Certificate Record' }}</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{ trans('global.add') }} {{ 'New' }} {{ 'Record' }}</h3>
            </div>
        </div>

    
        <form class="new-added-form" method="POST" action="{{ route("admin.leave-certificate-records.store") }}" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="student_id">{{ 'Student' }}</label>
                <select class="form-control select2 {{ $errors->has('student_id') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                    <option value="" disabled selected>Please Select</option>
                    @foreach($studentAdmission as $child)
                        <option value="{{ $child->id }}" {{ old('student_id') == $child->id ? 'selected' : '' }}>{{ $child->child_name }} {{ $child->middle_name }} {{ $child->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ 'Select Student' }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="certificate_number">{{ 'Certificate Number' }}</label>
                <input class="form-control {{ $errors->has('certificate_number') ? 'is-invalid' : '' }}" type="text" name="certificate_number" id="certificate_number" value="{{ old('certificate_number', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>Date of Graduation</label>
                <input name="date_of_graduation" id="date_of_graduation" value="{{ old('date_of_graduation', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="last_class_passed_id">{{ 'Last Class Passed' }}</label>
                <select class="form-control select2 {{ $errors->has('last_class_passed_id') ? 'is-invalid' : '' }}" name="last_class_passed_id" id="last_class_passed_id">
                    <option value="" disabled selected>Please Select</option>
                    @foreach($classroom as $id => $last_class)
                        <option value="{{ $last_class->id }}" {{ old('last_class_passed_id') == $last_class->id ? 'selected' : '' }}>{{ $last_class->class }} {{ $last_class->arms }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="parent_guardian_id">{{ 'Parent/Guardian' }}</label>
                <select class="form-control select2 {{ $errors->has('parent_guardian_id') ? 'is-invalid' : '' }}" name="parent_guardian_id" id="parent_guardian_id">
                    <option value="" disabled selected>Please Select</option>
                    @foreach($parentGuardian as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_guardian_id') == $parent->id ? 'selected' : '' }}>{{ $parent->child_name }} {{ $parent->middle_name }} {{ $parent->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ 'Select Parent/Guardian' }}</span>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="headteacher_name">{{ 'Head Teacher Name' }}</label>
                <input class="form-control {{ $errors->has('headteacher_name') ? 'is-invalid' : '' }}" type="text" name="headteacher_name" id="headteacher_name" value="{{ old('headteacher_name', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="headteacher_phone">{{ 'Head Teacher Phone' }}</label>
                <input class="form-control {{ $errors->has('headteacher_phone') ? 'is-invalid' : '' }}" type="text" name="headteacher_phone" id="headteacher_phone" value="{{ old('headteacher_phone', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </div>
        </form>
    </div>
</div>



@endsection
