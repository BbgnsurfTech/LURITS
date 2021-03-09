@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.view') }} {{ 'Entry' }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sdb.index') }}">
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
                            {{ $sdb -> date }}
                        </td>                                                
                    </tr>
                    <tr>
                        <th>
                            Staff ID
                        </th>                        
                        <td>
                            {{ $sdb -> staff_id }}
                        </td>                                                
                    </tr>                    
                    <tr>
                        <th>
                            Rank
                        </th>                        
                        <td>
                            {{ App\Sdb::RANK_SELECT [$sdb -> rank]  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Offence
                        </th>                        
                        <td>
                            {{ $sdb -> offence  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Staff Response
                        </th>                        
                        <td>
                            {{ $sdb -> response  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Number of Offence
                        </th>                        
                        <td>
                            {{ $sdb -> number_of_offence  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Disciplinary Action
                        </th>                        
                        <td>
                            {{ $sdb -> disciplinary_action  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Punished By
                        </th>                        
                        <td>
                            {{ $sdb -> punished_by  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Remark
                        </th>                        
                        <td>
                            {{ $sdb -> remark  }}
                        </td>
                    </tr>            
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.sdb.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection