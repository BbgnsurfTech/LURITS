@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{'Result'}}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.result.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                    @can('result_edit')
                        <a class="btn btn-xs btn-info" href="{{ route('admin.result.edit', $result->id) }}">
                            {{ trans('global.edit') }}
                        </a>
                    @endcan

                    @can('result_delete')
                        <form action="{{ route('admin.result.destroy', $result->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                            Student ID
                        </th>
                        <td>
                            {{ $result->student_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Subject ID
                        </th>
                        <td>
                            {{ $result->subject }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Class
                        </th>
                        <td>
                            {{ App\Result::CLASS_SELECT [$result->class_id] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            First CA
                        </th>
                        <td>
                            {{ $result->first_ca }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Second CA
                        </th>
                        <td>
                            {{ $result->second_ca }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Exam
                        </th>
                        <td>
                            {{ $result->exam }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Total
                        </th>
                        <td>
                            
                        </td>
                    </tr>                                        
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.result.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>


@endsection