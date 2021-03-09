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
        @include('partials.filter.school')
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="staff_id">Staff</label>
                <select class="form-control select2 {{ $errors->has('staff_id') ? 'is-invalid' : '' }}" name="staff_id" id="staff_id">
                    @if(Auth::User()->is_headTeacher)
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ ($staff->id ? $smr->staff_id : old('staff_id')) == $staff->id ? 'selected' : '' }}>{{ $staff->first_name }} {{ $staff->middle_name }} {{ $staff->last_name }}</option>
                    @endforeach
                    @else
                        <option value="{{ $smr->staff->id }}" selected>{{ $smr->staff->first_name }} {{ $smr->staff->middle_name }} {{ $smr->staff->last_name }}</option>
                    @endif
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
                <input name="date" id="date" value="{{ old('date', date('Y/m/d', strtotime($smr->date))) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="Y/m/d" class="form-control air-datepicker" data-position='bottom right'>
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
                    @foreach(App\StaffMovementRecord::HT_APPROVAL as $key => $label)
                        <option value="{{ $key }}" {{ old('ht_approval', $smr->ht_approval) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
        </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
@if(Auth::User()->is_superAdmin || Auth::User()->is_admin)
<script src="{{ asset('js/filter.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="school"]').on('change', function(){
            var school = $(this).val();

            if (school){
                $.ajax({
                    url: '/admin/staff-transfer/fetchStaffs/'+school,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                    $('.spinner').show();
                    },
                    success: function(data){
                        $('.spinner').hide();
                     $('select[name="staff_id"]').empty();
                            $('select[name="staff_id"]').prepend(
                            '<option value="">'+ "Please Select" +'</option>'
                            );
                         $.each(data, function(key, value){
                            $('select[name="staff_id"]').append(
                                '<option value="'+value.id+'">'+ value.first_name  + " " + value.last_name + "  " + value.staff_id+'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="staff_id"]').empty();
             }
        });
    });
</script>
@endif
@endsection
