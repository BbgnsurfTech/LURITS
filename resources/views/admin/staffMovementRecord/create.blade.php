@extends('layouts.admin')
@section('content')
<!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <ul>
                        <li>
                            <a href="{{ route("admin.smr.index") }}">Home</a>
                        </li>                        
                        <li>{{ 'Staff Movement Record' }}</li>
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

    
        <form class="new-added-form" method="POST" action="{{ route("admin.smr.store") }}" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="staff_id">Select Staff</label>
                <select class="form-control select2 {{ $errors->has('staff_id') ? 'is-invalid' : '' }}" name="staff_id" id="staff_id">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' : '' }}>{{ $staff->first_name }} {{ $staff->middle_name }} {{ $staff->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ 'Rank' }}</label>
                <select class="form-control {{ $errors->has('rank') ? 'is-invalid' : '' }}" name="rank" id="rank" required>        
                <option value="">{{ trans('global.pleaseSelect') }}</option>            
                    @foreach(App\StaffMovementRecord::RANK_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('rank', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="contact_number">{{ 'Contact Number' }}</label>
                <input class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}" type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="purpose">{{ 'Purpose' }}</label>
                <input class="form-control {{ $errors->has('purpose') ? 'is-invalid' : '' }}" type="text" name="purpose" id="purpose" value="{{ old('purpose', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ 'Reason for Leaving' }}</span>
            </div>                        
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>Date</label>
                <input name="date" id="date" value="{{ old('date', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="md-form mx-5 my-5">
               <label for="time_out">Time Out</label>
                <input name="time_out" id="time_out" value="{{ old('time_out', '') }}" type="time" class="form-control timepicker" data-position='bottom right'>
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="md-form mx-5 my-5">
               <label for="time_back">Time Back</label>
                <input name="time_back" id="time_back" value="{{ old('time_back', '') }}" type="time" class="form-control timepicker" data-position='bottom right'>
                <i class="far fa-calendar-alt"></i>
            </div>                        
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ 'Head Teachers Approval' }}</label>
                <select class="form-control {{ $errors->has('ht_approval') ? 'is-invalid' : '' }}" name="ht_approval" id="ht_approval" required>         
                <option value="">{{ trans('global.pleaseSelect') }}</option>           
                    @foreach(App\StaffMovementRecord::HT_APPROVAL as $key => $label)
                        <option value="{{ $key }}" {{ old('ht_approval', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
