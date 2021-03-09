@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ 'Staff Movement Record' }}
    </div>

    <div class="card-body">
        <form class="new-added-form" method="POST" action="{{ route("admin.smr.update", [$smr->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="staff_id">{{ 'Staff Name' }}</label>
                <select class="form-control select2 {{ $errors->has('staff_id') ? 'is-invalid' : '' }}" name="staff_id" id="staff_id">
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ ($staff->staff_id ? $staff->staff_id->id : old('staff_id')) == $staff->id ? 'selected' : '' }}>{{ $staff->first_name }} {{ $staff->middle_name }} {{ $staff->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ 'Rank' }}</label>
                <select class="form-control {{ $errors->has('rank') ? 'is-invalid' : '' }}" name="rank" id="rank" required>                    
                    @foreach(App\Smr::RANK_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('rank', $smr->rank) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="contact_number">{{ 'Contact Number' }}</label>
                <input class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}" type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $smr->contact_number) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="purpose">{{ 'Purpose' }}</label>
                <input class="form-control {{ $errors->has('purpose') ? 'is-invalid' : '' }}" type="text" name="purpose" id="purpose" value="{{ old('purpose', $smr->purpose) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ 'Reason for Leaving' }}</span>
            </div>                        
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>Date</label>
                <input name="date" id="date" value="{{ old('date', $smr->date) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right'>
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="md-form mx-5 my-5">
               <label for="time_out">Time Out</label>
                <input name="time_out" id="time_out" value="{{ old('time_out', $smr->time_out) }}" type="time" class="form-control timepicker" data-position='bottom right'>
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="md-form mx-5 my-5">
               <label for="time_back">Time Back</label>
                <input name="time_back" id="time_back" value="{{ old('time_back', $smr->time_back) }}" type="time" class="form-control timepicker" data-position='bottom right'>
                <i class="far fa-calendar-alt"></i>
            </div>                        
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">{{ 'Head Teachers Approval' }}</label>
                <select class="form-control {{ $errors->has('ht_approval') ? 'is-invalid' : '' }}" name="ht_approval" id="ht_approval" required>                    
                    @foreach(App\Smr::HT_APPROVAL as $key => $label)
                        <option value="{{ $key }}" {{ old('ht_approval', $smr->ht_approval) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
