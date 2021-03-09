@extends('layouts.admin')
@section('content')
<div class="content">
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{ trans('global.add') }} {{ 'Leave' }}</h3>
            </div>
        </div>
        <form class="new-added-form" method="POST" action="{{ route("admin.leave.store") }}" enctype="multipart/form-data">
            @csrf
        @include('partials.filter.school')
        <div class="row">
            @can('leave_admin')          
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="staff_id">Staff</label>
                <select class="form-control select2 {{ $errors->has('staff_id') ? 'is-invalid' : '' }}" name="staff_id" id="staff_id">
                    <option selected disabled value="">Please Select</option>
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' : '' }}>{{ $staff->first_name }} {{ $staff->middle_name }} {{ $staff->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            @endcan
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="contact_number">Contact Number</label>
                <input class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}" type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="address">{{ 'Address' }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="number_of_days">Number of Days</label>
                <input class="form-control {{ $errors->has('number_of_days') ? 'is-invalid' : '' }}" max="11" type="text" name="number_of_days" id="number_of_days" value="{{ old('number_of_days', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>                        
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">Leave Type</label>
                <select class="form-control {{ $errors->has('leave_type') ? 'is-invalid' : '' }}" name="leave_type" id="leave_type" required>
                    <option disabled selected value="">Please Select</option>
                    @foreach(App\Leave::LEAVE_TYPE as $key => $label)
                        <option value="{{ $key }}" {{ old('leave_type', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>Start Date</label>
                <input name="start_date" id="start_date" value="{{ old('start_date', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>End Date</label>
                <input name="end_date" id="end_date" value="{{ old('end_date', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            @can('leave_admin')
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required">Status</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>      
                <option disabled selected value="">Please Select</option>
                    @foreach(App\LEAVE::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text" name="remark" id="remark" value="{{ old('remark', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            @endcan
        </div>
        <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
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
                                '<option value="'+value.id+'">'+ value.first_name  + " " + value.last_name + "  " + value.lga_staff_id+'</option>'
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