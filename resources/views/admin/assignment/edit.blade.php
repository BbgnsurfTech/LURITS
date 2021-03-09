@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ 'Staff Leave' }}
    </div>

    <div class="card-body">
        <form class="new-added-form" method="POST" action="{{ route("admin.assignment.update", [$assignment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
        <div class="row">            
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label class="required" for="date">Date</label>
                <input name="date" id="date" value="{{ old('date', $assignment->date) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" required>
                <i class="far fa-calendar-alt"></i>
            </div>         
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="staff_id">Teacher</label>
                <select class="form-control select2 {{ $errors->has('staff_id') ? 'is-invalid' : '' }}" name="staff_id" id="staff_id">
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ old('staff_id', $assignment->staff_id) == $staff->id ? 'selected' : '' }}>{{ $staff->first_name }} {{ $staff->middle_name }} {{ $staff->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="term">{{ 'Term' }}</label>
                <input class="form-control {{ $errors->has('term') ? 'is-invalid' : '' }}" type="text" name="term" id="term" value="{{ old('term', $assignment->term) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="week">{{ 'Week' }}</label>
                <input class="form-control {{ $errors->has('week') ? 'is-invalid' : '' }}" type="text" name="week" id="week" value="{{ old('week', $assignment->week) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="class_id">{{ 'Class' }}</label>
                <select class="form-control select2 {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                    @foreach($classroom as $class_id)
                        <option value="{{ $class_id->id }}" {{ old('class_id', $assignment->class_id) == $class_id->id ? 'selected' : '' }}>{{ $class_id->class }} {{ $class_id->arms }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="subject">{{ 'Subject' }}</label>
                <select class="form-control select2 {{ $errors->has('subject') ? 'is-invalid' : '' }}" name="subject" id="subject">
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->ds_subject_name }}" {{ old('subject', $assignment->subject) == $subject->ds_subject_name ? 'selected' : '' }}>{{ $subject->ds_subject_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="topic">{{ 'Topic' }}</label>
                <input class="form-control {{ $errors->has('topic') ? 'is-invalid' : '' }}" type="text" name="topic" id="topic" value="{{ old('topic', $assignment->topic) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="assignment">{{ 'Assignment' }}</label>
                <input class="form-control {{ $errors->has('assignment') ? 'is-invalid' : '' }}" type="text" name="assignment" id="assignment" value="{{ old('assignment', $assignment->assignment) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="remark">{{ 'Remark' }}</label>
                <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text" name="remark" id="remark" value="{{ old('remark', $assignment->remark) }}">
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
