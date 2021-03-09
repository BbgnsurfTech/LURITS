@extends('layouts.admin')
@section('content')
<!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <ul>
                        <li>
                            <a href="{{ route("admin.health.index") }}">Home</a>
                        </li>                        
                        <li>{{ 'Students Health Record' }}</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{ trans('global.add') }} {{'New'}} {{ 'Record' }}</h3>
            </div>
        </div>

    
        <form class="new-added-form" method="POST" action="{{ route("admin.health.store") }}" enctype="multipart/form-data">
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
                    <option value="" disabled selected>Please Select</option>
                    @foreach($studentAdmission as $child)
                        <option value="{{ $child->id }}" {{ old('student_id') == $child->id ? 'selected' : '' }}>{{ $child->child_name }} {{ $child->middle_name }} {{ $child->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="type">{{ 'Type of Sickness/Illness' }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="prescription">{{ 'Prescription' }}</label>
                <input class="form-control {{ $errors->has('prescription') ? 'is-invalid' : '' }}" type="text" name="prescription" id="prescription" value="{{ old('prescription', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="cause">{{ 'Cause of Sickness/Illness' }}</label>
                <input class="form-control {{ $errors->has('cause') ? 'is-invalid' : '' }}" type="text" name="cause" id="cause" value="{{ old('cause', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>           
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="followup">{{ 'Follow-up Issues' }}</label>
                <input class="form-control {{ $errors->has('followup') ? 'is-invalid' : '' }}" type="text" name="followup" id="followup" value="{{ old('followup', '') }}" required>
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
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <button class="btn btn-danger" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
        </form>
    </div>
</div>



@endsection
