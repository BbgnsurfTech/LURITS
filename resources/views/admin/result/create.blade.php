@extends('layouts.admin')
@section('content')
<!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <ul>
                        <li>
                            <a href="{{ route("admin.home") }}">Home</a>
                        </li>                        
                        <li>Result</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{ trans('global.add') }} {{'New'}} {{'Result'}}</h3>
            </div>
        </div>

    
        <form class="new-added-form" method="POST" action="{{ route("admin.result.store") }}" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>Date</label>
                <input name="date" id="date" value="{{ old('date', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="student_id">Student</label>
                <select class="form-control select2 {{ $errors->has('student_id') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($studentAdmission as $child_name)
                        <option value="{{ $child_name->id }}" {{ old('student_id') == $child_name->id ? 'selected' : '' }}>{{ $child_name->child_name }} {{ $child_name->middle_name }} {{ $child_name->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>            
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="class_id">Class</label>
                <select class="form-control select2 {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($classroom as $class_id)
                        <option value="{{ $class_id->id }}" {{ old('class_id') == $class_id->id ? 'selected' : '' }}>{{ $class_id->class }} {{ $class_id->arms }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="subject">Subject</label>
                <select class="form-control select2 {{ $errors->has('subject') ? 'is-invalid' : '' }}" name="subject" id="subject">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($subject as $subject_id)
                        <option value="{{ $subject_id->id }}" {{ old('subject_id') == $class_id->id ? 'selected' : '' }}>{{ $subject_id->ds_subject_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>            
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="first_ca">First CA</label>
                <input class="form-control {{ $errors->has('first_ca') ? 'is-invalid' : '' }}" type="text" name="first_ca" id="first_ca" value="{{ old('first_ca', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="second_ca">Second CA</label>
                <input class="form-control {{ $errors->has('second_ca') ? 'is-invalid' : '' }}" type="text" name="second_ca" id="second_ca" value="{{ old('second_ca', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="exam">Exam</label>
                <input class="form-control {{ $errors->has('exam') ? 'is-invalid' : '' }}" type="text" name="exam" id="exam" value="{{ old('exam', '') }}">
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