@extends('layouts.admin')
@section('content')
<section class="content">
    <div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.expenseCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.expense-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.expenseCategory.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has(''))
                    <span class="text-danger">{{ $errors->first('') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.expenseCategory.fields.name_helper') }}</span>
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