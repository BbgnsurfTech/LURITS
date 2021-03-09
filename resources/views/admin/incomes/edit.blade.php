@extends('layouts.admin')
@section('content')
<section class="content">
<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.income.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.incomes.update", [$income->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @if(Auth::User()->is_superAdmin || Auth::User()->is_admin)
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label">Zone</label>
                        <select name="zone" class="form-control input-lg dynamic" id="zone" data-dependent="lga">
                            <option value="">Select Zone</option>
                            @foreach($zones as $zone)
                            <option value="{{ $zone->code_atlas_entity }}">{{ $zone->name_atlas_entity }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label">LGA</label>
                        <select name="lga" class="form-control input-lg dynamic" id="lga" data-dependent="school">
                            <option value="">Select LGA</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label">School</label>
                        <select name="school" class="form-control input-lg dynamic" id="school">
                            <option value="{{ $income->school->id }}">{{ $income->school->name }}</option>
                        </select>
                    </div>
                </div>
            </div>
            @endif
            @if(Auth::User()->is_zeqa)
            @include('partials.zeqa')
            @endif
            @if(Auth::User()->is_lgea)
            <div class="form-group">
                <label class="control-label">School*</label>
                <select name="school" class="form-control input-lg dynamic" id="school" required>
                    <option value="{{ $income->school->id }}">{{ $income->school->name }}</option>
                    @foreach($lgea as $lga)
                    <option value="{{ $lga->id }}" @if($lga->id == $income->school->id) disabled @endif>{{ $lga->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="form-group">
                <label for="income_category_id">{{ trans('cruds.income.fields.income_category') }}</label>
                <select class="form-control select2 {{ $errors->has('income_category') ? 'is-invalid' : '' }}" name="income_category_id" id="income_category_id">
                    @foreach($income_categories as $id => $income_category)
                        <option value="{{ $id }}" {{ ($income->income_category ? $income->income_category->id : old('income_category_id')) == $id ? 'selected' : '' }}>{{ $income_category }}</option>
                    @endforeach
                </select>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.income_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="entry_date">{{ trans('cruds.income.fields.entry_date') }}</label>
                <input class="form-control date {{ $errors->has('entry_date') ? 'is-invalid' : '' }}" type="text" name="entry_date" id="entry_date" value="{{ old('entry_date', $income->entry_date) }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.entry_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.income.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $income->amount) }}" step="0.01" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.income.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $income->description) }}">
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.income.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</section>
@endsection
@section('scripts')
@if(Auth::User()->is_superAdmin || Auth::User()->is_admin)
<script src="{{ asset('js/filter.js') }}"></script>
@endif
@endsection