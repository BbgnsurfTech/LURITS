@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Toilet
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-xs btn-primary" href="{{ route('admin.toilets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
                @can('classroom_edit')
                <a class="btn btn-xs btn-info" href="{{ route('admin.toilets.edit', $toilet->id) }}">
                    {{ trans('global.edit') }}
                </a>
                @endcan
                @can('classroom_delete')
                    <form action="{{ route('admin.toilets.destroy', $toilet->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                    </form>
                @endcan
            </div>
                                
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.school_enrolled') }}
                        </th>
                        <td>
                            {{ $toilet->school->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.year') }}
                        </th>
                        <td>
                            {{ $toilet->year_construction ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Condition
                        </th>
                        <td>
                            {{ $toilet->toiletCondition->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Usability
                        </th>
                        <td>
                            {{ $toilet->toiletUser->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Type
                        </th>
                        <td>
                            {{ $toilet->toiletType->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Toilet Usage
                        </th>
                        <td>
                            {{ $toilet->toiletUsage->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.toilets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection