@extends('layouts.admin')
@section('content')
<div class="content">
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ 'Staff Leave' }}
    </div>

    <div class="card-body">
        <form class="new-added-form" method="POST" action="{{ route("admin.leave.update", [$leave->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
        @include('partials.filter.school')
        <div class="row">
            @can('leave_admin')
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="staff_id">Staff</label>
                <select class="form-control select2 {{ $errors->has('staff_id') ? 'is-invalid' : '' }}" name="staff_id" id="staff_id">
                    @if(Auth::User()->is_headTeacher)
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ ($staff->id ? $leave->staff_id : old('staff_id')) == $staff->id ? 'selected' : '' }}>{{ $staff->first_name }} {{ $staff->middle_name }} {{ $staff->last_name }}</option>
                    @endforeach
                    @else
                        <option value="{{ $leave->staff->id }}" selected>{{ $leave->staff->first_name }} {{ $leave->staff->middle_name }} {{ $leave->staff->last_name }}</option>
                    @endif
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            @endcan     
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="contact_number">Contact Number</label>
                <input class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}" type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $leave->contact_number) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="address">Address</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $leave->address) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="number_of_days">Number of Days</label>
                <input class="form-control {{ $errors->has('number_of_days') ? 'is-invalid' : '' }}" type="text" name="number_of_days" id="number_of_days" value="{{ old('number_of_days', $leave->number_of_days) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>                        
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">Leave Type</label>
                <select class="form-control {{ $errors->has('leave_type') ? 'is-invalid' : '' }}" name="leave_type" id="leave_type" required>                    
                    @foreach(App\Leave::LEAVE_TYPE as $key => $label)
                        <option value="{{ $key }}" {{ old('leave_type', $leave->leave_type, '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>Start Date</label>
                <input name="start_date" id="start_date" value="{{ old('start_date', $leave->start_date) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>End Date</label>
                <input name="end_date" id="end_date" value="{{ old('end_date', $leave->end_date) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            @can('leave_admin')
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">Status</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                <option>Please Select</option>                    
                    @foreach(App\LEAVE::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $leave->status, '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            @endcan
            @can('leave_admin')
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="remark">Remark</label>
                <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text" name="remark" id="remark" value="{{ old('remark', $leave->remark) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            @endcan
        </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
