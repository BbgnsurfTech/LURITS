@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.view') }} {{ 'Complaint' }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.complaint.index') }}">
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
                            {{ $complaint -> date }}
                        </td>                                                
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>                        
                        <td>
                            {{ $complaint -> name }}
                        </td>                                                
                    </tr>    
                    <tr>
                        <th>
                            Phone
                        </th>                        
                        <td>
                            {{ $complaint -> phone  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Complaint
                        </th>                        
                        <td>
                            {{ $complaint -> complaint  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Action Taken
                        </th>                        
                        <td>
                            {{ $complaint -> action  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Remark
                        </th>                        
                        <td>
                            {{ $complaint -> remark  }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.complaint.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection