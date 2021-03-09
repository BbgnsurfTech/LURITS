@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ 'Punishment' }}
    </div>

    <div class="card-body">
        <form class="new-added-form" method="POST" action="{{ route("admin.punishment.update", [$punishment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>Date</label>
                <input name="date" id="date" value="{{ old('date', $punishment->date) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="student_id">{{ 'Student ID' }}</label>
                <select class="form-control select2 {{ $errors->has('student_id') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                    @foreach($studentAdmission as $child)
                        <option value="{{ $child->id }}" {{ old('student_id', $punishment->student_id) == $child->id ? 'selected' : '' }}>{{ $child->child_name }} {{ $child->middle_name }} {{ $child->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="age">{{ 'Age' }}</label>
                <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="text" name="age" id="age" value="{{ old('age', $punishment->age) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="offence">{{ 'Offence' }}</label>
                <input class="form-control {{ $errors->has('offence') ? 'is-invalid' : '' }}" type="text" name="offence" id="offence" value="{{ old('offence', $punishment->offence) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="punishment">{{ 'Punishment' }}</label>
                <input class="form-control {{ $errors->has('punishment') ? 'is-invalid' : '' }}" type="text" name="punishment" id="punishment" value="{{ old('punishment', $punishment->punishment) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>            
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="class_id">{{ 'Class' }}</label>
                <select class="form-control select2 {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                    @foreach($classroom as $id => $class)
                        <option value="{{ $class->id }}" {{ old('class_id', $punishment->class_id) == $class->id ? 'selected' : '' }}>{{ $class->class }} {{ $class->arms }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>            
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="remark">{{ 'Punishment' }}</label>
                <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text" name="remark" id="remark" value="{{ old('remark', $punishment->remark) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>            
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="punished_by">{{ 'Punished By' }}</label>
                <select class="form-control select2 {{ $errors->has('punished_by') ? 'is-invalid' : '' }}" name="punished_by" id="punished_by">
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('punished_by', $punishment->punished_by) == $teacher->id ? 'selected' : '' }}>{{ $teacher->first_name }} {{ $teacher->middle_name }} {{ $teacher->last_name }}</option>
                    @endforeach
                </select>
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
