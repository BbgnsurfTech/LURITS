{{-- @can('edit-classes') --}}
<a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$id}}" data-original-title="View"
   class="view btn btn-info btn-sm viewIncidence"><i class="fa fa-eye"></i>&nbspView Incidence</a>
{{-- @endcan --}}

@can('incidence_create')
    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$id}}" data-original-title="Edit"
       class="edit btn btn-primary btn-sm editIncidence"><i class="fa fa-pencil-alt"></i>&nbsp;Edit</a>
@endcan