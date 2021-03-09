@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.view') }} {{ 'Record' }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clubs.index') }}">
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
                            {{ $club -> date }}
                        </td>                                                
                    </tr>
                    <tr>
                        <th>
                            Club/Society Name
                        </th>                        
                        <td>
                            {{ $club -> name }}
                        </td>                                                
                    </tr>    
                    <tr>
                        <th>
                            Activity
                        </th>                        
                        <td>
                            {{ $club -> activity  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Venue of Meeting
                        </th>                        
                        <td>
                            {{ $club -> venue  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Duration
                        </th>                        
                        <td>
                            {{ $club -> duration  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Number of Participants
                        </th>                        
                        <td>
                            {{ $club -> participants  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Resolution
                        </th>                        
                        <td>
                            {{ $club -> resolution  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Purpose
                        </th>                        
                        <td>
                            {{ $club -> purpose  }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Remark
                        </th>                        
                        <td>
                            {{ $club -> remark  }}
                        </td>
                    </tr>            
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="{{ route('admin.clubs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection