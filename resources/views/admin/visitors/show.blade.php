@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.view') }} {{ 'Staff Visitor' }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.visitors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Date
                        </th>                        
                        <td>
                            {{ $visitor -> date }}
                        </td>                                                
                    </tr>                    
                    <tr>
                        <th>
                            Visitors Name
                        </th>                        
                        <td>
                            {{ $visitor -> visitors_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Address
                        </th>                        
                        <td>
                            {{ $visitor -> address  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Purpose of Visit
                        </th>                        
                        <td>
                            {{ $visitor -> purpose  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Remark
                        </th>                        
                        <td>
                            {{ $visitor -> remark  }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.visitors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection