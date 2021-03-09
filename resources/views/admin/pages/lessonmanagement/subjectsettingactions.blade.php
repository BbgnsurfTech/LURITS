{{-- @can('edit-classes') --}}
    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$id}}" data-original-title="Edit"
       class="edit btn btn-primary btn-sm editSubjectSetting"><i class="fa fa-pencil-alt"></i>&nbsp;Edit</a>
{{-- @endcan --}}

{{-- @can('delete-classes') --}}
    <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$id}}" data-original-title="Delete"
       class="btn btn-danger btn-sm deleteSubjectSetting"><i class="fa fa-trash-alt"></i>&nbsp;Delete</a>
{{-- @endcan --}}
