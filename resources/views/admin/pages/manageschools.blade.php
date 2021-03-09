@extends('layouts.master')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper" style="min-height: 1249.6px;">
    <!-- Page title -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Schools</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage Schools</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="container-fluid">
                                <div class="row">
                                    <h3 class="card-title">List of Schools</h3>
                                    <button class="btn btn-primary ml-auto" id="createNewSchool">Create School</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="dataTable" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>LGA</th>
                                                <th>Ward</th>
                                                <th>Type</th>
                                                <th>Category</th>
                                                 <th width="280px">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>


    {{-- create/update school modal--}}
    <div class="modal fade" id="schoolModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="schoolForm" name="schoolForm" class="form-horizontal">
                        <input type="hidden" name="school_id" id="school_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                       value="" maxlength="50" required="" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="school_type" class="col-sm-6 control-label">School Type</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="school_type" id="school_type">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="school_category" class="col-sm-6 control-label">School Category</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="school_category" id="school_category">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lga" class="col-sm-2 control-label">LGA</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="lga" id="lga">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ward" class="col-sm-2 control-label">Ward</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="ward" id="ward">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {

            //Load lga
            $.ajax({
                url: '{{route("lgas.filter")}}',
            }).done(function(data) {
                $('#lga').html("<option value=''>Select</option>" + data);
            });

            //Load School Type
            $.ajax({
                url: '{{route("schooltypes.filter")}}',
            }).done(function(data) {
                $('#school_type').html("<option value=''>Select</option>" + data);
            });            
            
            //Load School Category
            $.ajax({
                url: '{{route("schoolcategories.filter")}}',
            }).done(function(data) {
                $('#school_category').html("<option value=''>Select</option>" + data);
            });

            $( "#lga" ).change(function() {
                 $.ajax({
                   url: "{{route('wards.filter')}}",
                   data: {lga:$('#lga').val()},
                   type: 'POST',
                    success:function (data) {
                        $('#ward').html('<option value="">Select</option>' + data);
                    }
                });
            });

            //ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // datatable
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('schools') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'lga', name: 'lga'},
                    {data: 'ward', name: 'ward'},
                    {data: 'type', name: 'type'},
                    {data: 'category', name: 'category'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            // create new school
            $('#createNewSchool').click(function () {
                $('#saveBtn').html("Create");
                $('#school_id').val('');
                $('#school_type').val('');
                $('#school_category').val('');
                $('#lga').val('');
                $('#ward').val('');
                $('#schoolForm').trigger("reset");
                $('.modal-title').html("Create New School");
                $('#schoolModel').modal('show');
            });

            // create or update school
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Saving..');

                $.ajax({
                    data: $('#schoolForm').serialize(),
                    url: "{{ url('schools') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#schoolForm').trigger("reset");
                        $('#schoolModel').modal('hide');
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        table.draw();
                        $('#saveBtn').html('Save');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save');
                    }
                });
            });

            // edit school
            $('body').on('click', '.editSchool', function () {
                var school_id = $(this).data('id');
                $.get("{{ url('schools') }}" + '/' + school_id + '/edit', function (data) {
                    $('.modal-title').html("Edit School");
                    $('#saveBtn').html('Update');
                    $('#schoolModel').modal('show');
                    $('#school_id').val(data.id);
                    $('#name').val(data.name);
                    $('#school_type').val(data.school_type_id);
                    $('#school_category').val(data.school_category_id);
                    $('#lga').val(data.lga_id);
                    $('#ward').val(data.ward_id);
                })
            });

            // delete school
            $('body').on('click', '.deleteSchool', function () {
                var school_id = $(this).data("id");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('schools') }}" + '/' + school_id,
                            success: function (data) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'School has been deleted.',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                table.draw();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                })
            });

        });
    </script>
@endsection
