@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ 'Staff Movement Record' }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.smr.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Staff
                        </th>                        
                        <td>
                            {{ $smr->staff->first_name }}
                            {{ $smr->staff->middle_name }}
                            {{ $smr->staff->last_name }}
                        </td>                                                
                    </tr>    
                    <tr>
                        <th>
                            Date
                        </th>                        
                        <td>
                            {{ $smr -> date  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Contact Number
                        </th>                        
                        <td>
                            {{ $smr -> contact_number  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Purpose
                        </th>                        
                        <td>
                            {{ $smr -> purpose  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Time Out
                        </th>                        
                        <td>
                            {{ $smr -> time_out  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Time Back
                        </th>                        
                        <td>
                            {{ $smr -> time_back  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Head Teacher's Approval
                        </th>                        
                        <td>
                            {{ App\StaffMovementRecord::HT_APPROVAL [$smr -> ht_approval]  }}
                        </td>
                    </tr>            
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.smr.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection