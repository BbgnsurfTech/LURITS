@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">Teachers List By School</div>
    <div class="card-body">
        <select name="country" class="form-control input-lg dynamic" id="country" data-dependent="state">
    <option value="">Select Country</option>
    @foreach($country_list as $country)
    <option value="{{ $country->code_atlas_entity }}">{{ $country->name_atlas_entity }}</option>
    @endforeach
</select>
<br>
<select name="state" class="form-control input-lg dynamic" id="state" data-dependent="city">
    <option value="">Select State</option>
</select>
<br>
<select name="lga" class="form-control input-lg dynamic" id="lga">
    <option value="">Select City</option>
</select>
<br>
<select name="school" class="form-control input-lg dynamic" id="school" data-dependent="lga">
    <option value="">Select School</option>
</select>
        {{ csrf_field() }}
        <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-Teacher" id="datatable">
            <thead>
                <tr>
                    <th>Register No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Attendance</th>
                    <th>DOB</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="country"]').on('change', function(){
             var country = $(this).val();

             if (country){
                $.ajax({
                    url: '/admin/lga/fetchStates/'+country,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                         console.log(data);

                         $('select[name="state"]').empty();
                         $.each(data, function(key, value){
                            $('select[name="state"]').append(
                                '<option value="'+key+'">'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="state"]').empty();
             }
        });
    });

    $(document).ready(function(){
        $('select[name="state"]').on('change', function(){
             var state = $(this).val();

             if (state){
                $.ajax({
                    url: '/admin/lga/fetchLgas/'+state,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                         console.log(data);

                         $('select[name="lga"]').empty();
                         $.each(data, function(key, value){
                            $('select[name="lga"]').append(
                                '<option value="'+key+'">'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="lga"]').empty();
             }
        });
    });
    $(document).ready(function(){
        $('select[name="lga"]').on('change', function(){
             var lga = $(this).val();

             if (lga){
                $.ajax({
                    url: '/admin/lga/fetchSchools/'+lga,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                         console.log(data);

                         $('select[name="school"]').empty();
                         $.each(data, function(key, value){
                            $('select[name="school"]').append(
                                '<option value="'+key+'">'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="school"]').empty();
             }
        });
    });

    window.datatable = $('#datatable').DataTable( {
        data: [],
        columns: [
            { title: "First Name" },
            { title: "Last Name" },
            { title: "File No" },
            { title: "DOB" },
            { title: "Phone No" },
            { title: "Actions" }
        ]
    });

    $(document).ready(function(){
        $('select[name="school"]').on('change', function(){
             var school = $(this).val();

             if (school){
                $.ajax({
                    url: '/admin/lga/fetchData/'+school,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                         console.log(data);

                         datatable.clear();
                         $.each(data, function(index, value) {
                        var showUrl = '{{ route("admin.teachers.show", ":id") }}';
                        showUrl = showUrl.replace(':id', value.id);
                        var editUrl = '{{ route("admin.teachers.edit", ":id") }}';
                        editUrl = editUrl.replace(':id', value.id);
                        var deleteUrl = '{{ route("admin.teachers.destroy", ":id") }}';
                        deleteUrl = deleteUrl.replace(':id', value.id);
                        datatable.row.add([
                            value.first_name,
                            value.last_name,
                            value.staff_file_number,
                            value.date_of_birth,
                            value.phone_number,
                            '<div class="form-group">'+
                                @can('subject_show')
                                    '<a class="btn btn-xs btn-primary mr-2" href="'+showUrl+'">'+
                                        '{{ trans('global.view') }}'+
                                    '</a>'+
                                @endcan
                                @can('subject_show')
                                    '<a class="btn btn-xs btn-info mr-2" href="'+editUrl+'">'+
                                        '{{ trans('global.edit') }}'+
                                    '</a>'+
                                @endcan                                
                                @can('subject_show')
                                    '<form action="" method="POST" onsubmit="return confirm({{ trans('global.areYouSure') }});" style="display: inline-block;">'
                                     
                                    +'<input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">'+ 
                                    '</form>'+
                                @endcan
                            '</div>'
                        ]).draw();
                    });

                    }
                });
             } else {
                $('select[name="datatable"]').empty();
             }
        });
    });
</script>
@endsection