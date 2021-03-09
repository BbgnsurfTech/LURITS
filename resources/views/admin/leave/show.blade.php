@extends('layouts.admin')
@section('content')
<div class="content">
<div class="card">
    <div class="card-header">
        {{ trans('global.view') }} {{ 'Staff Leave' }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.leave.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            @if($leave->status != 1)
            <div class="form-group">
                <a class="btn btn-success" href="{{ route('admin.leave.approve', $leave->id) }}">
                    Approve Leave
                </a>
            </div>
            @endif
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Staff
                        </th>                        
                        <td>
                            {{ $leave->staff->first_name }} {{ $leave->staff->middle_name }} {{ $leave->staff->last_name }} - {{ $leave->staff->staff_id ?? '' }}
                        </td>                                                
                    </tr>
                    <tr>
                        <th>
                            Contact Number
                        </th>                        
                        <td>
                            {{ $leave -> contact_number  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Address
                        </th>                        
                        <td>
                            {{ $leave -> address  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Start Date
                        </th>                        
                        <td>
                            {{ $leave -> start_date  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            End Date
                        </th>                        
                        <td>
                            {{ $leave -> end_date  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Leave Type
                        </th>                        
                        <td>
                            {{ App\Leave::LEAVE_TYPE [$leave -> leave_type]  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Number of Days
                        </th>                        
                        <td>
                            {{ $leave -> number_of_days  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Status
                        </th>                        
                        <td>
                            @if(isset($leave->status)) {{ App\Leave::STATUS_SELECT [$leave->status] }} @else Not Approved @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Remark
                        </th>                        
                        <td>
                            {{ $leave -> remark }}
                        </td>
                    </tr>            
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.leave.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>
</div>
@endsection