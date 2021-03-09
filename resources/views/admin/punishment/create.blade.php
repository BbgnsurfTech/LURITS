@extends('layouts.admin')
@section('content')
<!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <ul>
                        <li>
                            <a href="{{ route("admin.punishment.index") }}">Home</a>
                        </li>                        
                        <li>{{ 'Punishment' }}</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{ trans('global.add') }} {{'New'}} {{ 'Punishment' }}</h3>
            </div>
        </div>

    
        <form class="new-added-form" method="POST" action="{{ route("admin.punishment.store") }}" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>Date</label>
                <input name="date" id="date" value="{{ old('date', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="student_id">{{ 'Student ID' }}</label>
                <select class="form-control select2 {{ $errors->has('student_id') ? 'is-invalid' : '' }}" name="student_id" id="student_id">
                    @foreach($studentAdmission as $child)
                        <option value="{{ $child->id }}" {{ old('student_id') == $child->id ? 'selected' : '' }}>{{ $child->child_name }} {{ $child->middle_name }} {{ $child->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="age">{{ 'Age' }}</label>
                <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="text" name="age" id="age" value="{{ old('age', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="offence">{{ 'Offence' }}</label>
                <input class="form-control {{ $errors->has('offence') ? 'is-invalid' : '' }}" type="text" name="offence" id="offence" value="{{ old('offence', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="punishment">{{ 'Punishment' }}</label>
                <input class="form-control {{ $errors->has('punishment') ? 'is-invalid' : '' }}" type="text" name="punishment" id="punishment" value="{{ old('punishment', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>            
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="class_id">{{ 'Class' }}</label>
                <select class="form-control select2 {{ $errors->has('class_id') ? 'is-invalid' : '' }}" name="class_id" id="class_id">
                    @foreach($classroom as $id => $class)
                        <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->class }} {{ $class->arms }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>            
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="remark">{{ 'Remark' }}</label>
                <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text" name="remark" id="remark" value="{{ old('remark', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>            
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="punished_by">{{ 'Punished By' }}</label>
                <select class="form-control select2 {{ $errors->has('punished_by') ? 'is-invalid' : '' }}" name="punished_by" id="punished_by">
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('punished_by') == $teacher->id ? 'selected' : '' }}>{{ $teacher->first_name }} {{ $teacher->middle_name }} {{ $teacher->last_name }}</option>
                    @endforeach
                </select>
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
