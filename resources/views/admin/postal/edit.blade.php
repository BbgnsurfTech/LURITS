@extends('layouts.admin')
@section('content')
    
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ 'Record' }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.postal.update", [$postal->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="col-12 form-group">
               <label for="date" class='required'>Date</label>
                <input name="date" id="date" value="{{ old('date', $postal->date) }}" type="text" placeholder="yyyy/mm/dd" data-date-format="yyyy/mm/dd" class="form-control air-datepicker" data-position='bottom left' autocomplete="off" required>
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="col-12 form-group">
                <label class="required" for="status">{{ 'Status' }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>              
                    <option value="" disabled selected>Please Select</option>      
                    @foreach(App\Postal::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $postal->status ,'255') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif                
            </div>
            <div class="col-12 form-group">
                <label class="required" for="description">{{ 'Description' }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $postal->description) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-12 form-group">
                <label class="required" for="address">{{ 'Address' }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $postal->address) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>    
            <div class="col-12 form-group">
                <label for="notes">{{ 'Notes' }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', $postal->notes) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
            </div>
            <div class="col-12 form-group">
                <label for="remark">{{ 'Remark' }}</label>
                <input class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="text" name="remark" id="remark" value="{{ old('remark', $postal->remark) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
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
