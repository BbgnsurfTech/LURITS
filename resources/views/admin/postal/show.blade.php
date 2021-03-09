@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ 'Record' }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.postal.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ 'Date' }}
                        </th>
                        <td>
                            {{ $postal->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Status' }}
                        </th>
                        <td>
                            {{ App\Postal::STATUS_SELECT [$postal->status] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Description' }}
                        </th>
                        <td>
                            {{ $postal->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Address' }}
                        </th>
                        <td>
                            {{ $postal->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Notes' }}
                        </th>
                        <td>
                            {{ $postal->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Remark' }}
                        </th>
                        <td>
                            {{ $postal->remark }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.postal.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection