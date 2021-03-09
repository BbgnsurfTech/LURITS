@extends('layouts.admin')
@section('content')
<!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <ul>
                        <li>
                            <a href="{{ route("admin.sdb.index") }}">Home</a>
                        </li>                        
                        <li>{{ 'Staff Disciplinary Action' }}</li>
                    </ul>
                </div>
<!-- Breadcubs Area End Here -->
<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <h3>{{ trans('global.add') }} {{ 'Entry' }}</h3>
            </div>
        </div>

    
        <form class="new-added-form" method="POST" action="{{ route("admin.sdb.store") }}" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 form-group">
               <label>Date</label>
                <input name="date" id="date" value="{{ old('date', '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label class="required" for="staff_id">Staff</label>
                <select class="form-control select2 {{ $errors->has('staff_id') ? 'is-invalid' : '' }}" name="staff_id" id="staff_id">
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' : '' }}>{{ $staff->first_name }} {{ $staff->middle_name }} {{ $staff->last_name }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="rank">{{ 'Rank' }}</label>
                <select class="form-control {{ $errors->has('rank') ? 'is-invalid' : '' }}" name="rank" id="rank" required>                    
                    @foreach(App\Sdb::RANK_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('rank', '255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
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
                <label for="response">{{ 'Staff Response' }}</label>
                <input class="form-control {{ $errors->has('response') ? 'is-invalid' : '' }}" type="text" name="response" id="response" value="{{ old('response', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="number_of_offence">{{ 'Number of Offence' }}</label>
                <input class="form-control {{ $errors->has('number_of_offence') ? 'is-invalid' : '' }}" type="text" name="number_of_offence" id="number_of_offence" value="{{ old('number_of_offence', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="disciplinary_action">{{ 'Disciplinary Action' }}</label>
                <input class="form-control {{ $errors->has('disciplinary_action') ? 'is-invalid' : '' }}" type="text" name="disciplinary_action" id="disciplinary_action" value="{{ old('disciplinary_action', '') }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <label for="punished_by">Punished By</label>
                <select class="form-control select2 {{ $errors->has('punished_by') ? 'is-invalid' : '' }}" name="punished_by" id="punished_by">
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ old('punished_by') == $staff->id ? 'selected' : '' }}>{{ $staff->first_name }} {{ $staff->middle_name }} {{ $staff->last_name }}</option>
                    @endforeach
                </select>
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
