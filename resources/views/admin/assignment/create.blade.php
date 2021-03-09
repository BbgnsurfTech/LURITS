@extends('layouts.admin')
@section('content')
<!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <ul>
                        <li>
                            <a href="{{ route("admin.assignment.index") }}">Home</a>
                        </li>                        
                        <li>{{ 'Assignment' }}</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{ trans('global.add') }} {{ 'Assignment' }}</h3>
            </div>
        </div>

    
        <form class="new-added-form" method="POST" action="{{ route("admin.assignment.store") }}" enctype="multipart/form-data">
            @csrf
        <div class="row">   
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label class="required" for="date">Date</label>
                <input name="date" id="date" value="{{ old('date', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                <i class="far fa-calendar-alt"></i>
            </div>         
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="staff_id">Teacher</label>
                <select class="form-control select2 {{ $errors->has('staff_id') ? 'is-invalid' : '' }}" name="staff_id" id="staff_id">
                    <option value="" disabled selected>Please Select</option>
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' : '' }}>{{ $staff->first_name }} {{ $staff->middle_name }} {{ $staff->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="term">{{ 'Term' }}</label>
                <input class="form-control {{ $errors->has('term') ? 'is-invalid' : '' }}" type="text" name="term" id="term" value="{{ old('term', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="week">{{ 'Week' }}</label>
                <input class="form-control {{ $errors->has('week') ? 'is-invalid' : '' }}" type="text" name="week" id="week" value="{{ old('week', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="class_id">{{ 'Class' }}</label>
                <select class="form-control select2 {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                    <option value="" disabled selected>Please Select</option>
                    @foreach($classroom as $class_id)
                        <option value="{{ $class_id->id }}" {{ old('class_id') == $class_id->id ? 'selected' : '' }}>{{ $class_id->class }} {{ $class_id->arms }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="subject">{{ 'Subject' }}</label>
                <select class="form-control select2 {{ $errors->has('subject') ? 'is-invalid' : '' }}" name="subject" id="subject">
                    <option value="" disabled selected>Please Select</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->ds_subject_name }}" {{ old('subject') == $subject->ds_subject_name ? 'selected' : '' }}>{{ $subject->ds_subject_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="topic">{{ 'Topic' }}</label>
                <input class="form-control {{ $errors->has('topic') ? 'is-invalid' : '' }}" type="text" name="topic" id="topic" value="{{ old('topic', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="assignment">{{ 'Assignment' }}</label>
                <input class="form-control {{ $errors->has('assignment') ? 'is-invalid' : '' }}" type="text" name="assignment" id="assignment" value="{{ old('assignment', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="remark">{{ 'Remark' }}</label>
                <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text" name="remark" id="remark" value="{{ old('remark', '') }}">
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
