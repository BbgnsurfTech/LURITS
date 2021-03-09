@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.view') }} {{ 'Record' }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.log-book.index') }}">
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
                            {{ $logBook->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Event' }}
                        </th>
                        <td>
                            {{ $logBook->event }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ 'Remark' }}
                        </th>
                        <td>
                            {{ $logBook->remark }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.log-book.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection