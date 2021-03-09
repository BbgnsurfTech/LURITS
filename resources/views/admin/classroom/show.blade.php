@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.classroom.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-xs btn-primary" href="{{ route('admin.classrooms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
                @can('classroom_edit')
                <a class="btn btn-xs btn-info" href="{{ route('admin.classrooms.edit', $classroom->id) }}">
                    {{ trans('global.edit') }}
                </a>
                @endcan
                @can('classroom_delete')
                    <form action="{{ route('admin.classrooms.destroy', $classroom->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                            {{ trans('cruds.classroom.fields.capacity') }}
                        </th>
                        <td>
                            {{ $classroom->capacity ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Current Class Capacity
                        </th>
                        <td>
                            {{ $classroom->current_capacity ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.school_enrolled') }}
                        </th>
                        <td>
                            {{ $classroom->school->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.year') }}
                        </th>
                        <td>
                            {{ $classroom->year ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.condition') }}
                        </th>
                        <td>
                            {{ $classroom->classCondition->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.length') }}
                        </th>
                        <td>
                            {{ $classroom->length ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.width') }}
                        </th>
                        <td>
                            {{ $classroom->width ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.floor_material') }}
                        </th>
                        <td>
                            {{ $classroom->floorMaterial->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.wall_material') }}
                        </th>
                        <td>
                            {{ $classroom->wallMaterial->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.roof_material') }}
                        </th>
                        <td>
                            {{ $classroom->roofMaterial->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.seating') }}
                        </th>
                        <td>
                            {{ $classroom->availableSeating->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classroom.fields.writing_board') }}
                        </th>
                        <td>
                            {{ $classroom->writingBoard->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.classrooms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection