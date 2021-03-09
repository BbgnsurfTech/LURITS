@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ isset($parentGuardianregister) ? trans('global.edit') : trans('global.create') }} {{ trans('cruds.parentGuardianregister.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.parents.store") }}" enctype="multipart/form-data">
            @csrf
            @include('partials.filter.school')
            <input type="hidden" name="parent_id" value="{{ $parentGuardianregister->id ?? '' }}">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="photo">Passport</label>
                    <div class="col-sm-12">
                        <input id="photo" type="file" name="photo">
                        <input type="hidden" name="hidden_image" id="hidden_image">
                    </div>
                    @if($errors->has('photo'))
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.parentGuardianregister.fields.first_name_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="first_name">{{ trans('cruds.parentGuardianregister.fields.first_name') }}</label>
                    <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $parentGuardianregister->first_name ?? '') }}" required>
                    @if($errors->has('first_name'))
                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.parentGuardianregister.fields.first_name_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="middle_name">{{ trans('cruds.parentGuardianregister.fields.middle_name') }}</label>
                    <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $parentGuardianregister->middle_name ?? '') }}">
                    @if($errors->has('middle_name'))
                        <span class="text-danger">{{ $errors->first('middle_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.parentGuardianregister.fields.middle_name_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="last_name">{{ trans('cruds.parentGuardianregister.fields.last_name') }}</label>
                    <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $parentGuardianregister->last_name ?? '') }}" required>
                    @if($errors->has('last_name'))
                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.parentGuardianregister.fields.last_name_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender" required>
                        <option value="" disabled selected>Please Select</option>
                        @foreach($gender as $gender)
                            <option value="{{ $gender->id }}" {{ (old('gender', 0) == $gender->id || isset($parentGuardianregister) && $parentGuardianregister->gender_id == $gender->id) ? 'selected' : '' }}>{{ $gender->title }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.parentGuardianregister.fields.last_name_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="income">Annual Income</label>
                    <select class="form-control" name="income" id="income" required>
                        <option value="" disabled selected>Please Select</option>
                        @foreach($status as $status)
                        <option value="{{ $status->id }}" {{ (old('income', 0) == $status->id || isset($parentGuardianregister) && $parentGuardianregister->gender_id == $status->id) ? 'selected' : '' }}>{{ $status->title }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('income'))
                        <span class="text-danger">{{ $errors->first('income') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.parentGuardianregister.fields.last_name_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label for="email">{{ trans('cruds.parentGuardianregister.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $parentGuardianregister->email ?? '') }}">
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.parentGuardianregister.fields.email_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="phone_number">{{ trans('cruds.parentGuardianregister.fields.phone_number') }}</label>
                    <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $parentGuardianregister->phone_number ?? '') }}" required>
                    @if($errors->has('phone_number'))
                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.parentGuardianregister.fields.phone_number_helper') }}</span>
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                   <label class="required">Date of Birth*</label>
                    <input name="dateofbirth" id="dateofbirth" value="{{ old('dateofbirth', $parentGuardianregister->date_of_birth ?? '') }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom right' autocomplete="off" >
                    <i class="far fa-calendar-alt"></i>
                    @if($errors->has(''))
                        <span class="text-danger">{{ $errors->first('') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="address">Address</label>
                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $parentGuardianregister->address ?? '') }}" required>
                    @if($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                </div>
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label class="required" for="profession">Profession</label>
                    <input class="form-control {{ $errors->has('profession') ? 'is-invalid' : '' }}" type="text" name="profession" id="profession" value="{{ old('profession', $parentGuardianregister->profession ?? '') }}" required>
                    @if($errors->has('profession'))
                        <span class="text-danger">{{ $errors->first('profession') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12 form-group">
                <button class="btn btn-lg btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="{{ asset('js/filter.js') }}"></script>
@if(isset($parentGuardianregister))
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="school"]').append(
        '<option value="{{$parentGuardianregister->school_id}}" selected>'+ "{{$parentGuardianregister->school->name}}" +'</option>'
        );
    });
</script>
@endif
@endsection