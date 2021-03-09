@extends('layouts.master')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection



@section('content')
    <div class="content-wrapper" style="min-height: 1249.6px;">
    <!-- Page title -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Voice Call Templates</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage  Voice Call Templates</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="container-fluid">
                                <div class="row">
                                    <h3 class="card-title">List of CallTemplates</h3>
                                    <button class="btn btn-primary ml-auto" id="createNewCallTemplate"><i class="fa fa-plus"></i>&nbsp;Create CallTemplate</button>
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
                                                <th>Title</th>
                                                <th>Audio File</th>
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


    {{-- create/update calltemplate modal--}}
    <div class="modal fade" id="calltemplateModel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="calltemplateForm" name="calltemplateForm" class="form-horizontal"
                              enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">                                
                                    <input type="hidden" name="calltemplate_id" id="calltemplate_id">
                                    <div class="form-group">
                                        <label for="title" class="col-sm-12 control-label">Title</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter the Title"
                                                value="" maxlength="150" required="" autocomplete="off">
                                        </div>
                                    </div><div class="form-group">
                                        <label class="col-sm-12 control-label">Audio File</label>
                                        <div class="col-sm-12">
                                            <input id="recording" type="file" name="recording">
                                            <input type="hidden" name="hidden_file" id="hidden_file">
                                        </div>
                                    </div>

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>

                        <div class="alert alert-danger alert-dismissible" style="display: none">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveBtn" style="background: #1e7e34; color: white">Save</button>
                        </div>
                        </form>
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

                    //ajax setup
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    // datatable
                    var table = $('#dataTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        processing: true,
                        serverSide: true,
                        ajax: "{{ url('admin/calltemplates') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                            {data: 'title', name: 'title'},
                            {data: 'recording', name: 'recording'},
                            {data: 'action', name: 'action', orderable: false, searchable: false},
                        ]
                    });

                    // create new calltemplate
                    $('#createNewCallTemplate').click(function () {
                        $('#saveBtn').html("Create");
                        $('#calltemplate_id').val('');
                        $('#calltemplateForm').trigger("reset");
                        $('.modal-title').html("Create New Call Template");
                        $('.alert-danger').html('');
                        $('.alert-danger').hide();
                        $('#calltemplateModel').modal('show');
                        $('#modal-preview').attr('src', 'uploads/avatar.jpg');
                    });

                    // create or update calltemplate
                    $('#saveBtn').click(function (e) {
                        e.preventDefault();
                        $(this).html('Saving..');
                        // Get form
                        var form = $('#calltemplateForm')[0];
                        // Create an FormData object
                        var formdata = new FormData(form);
                        // disabled the submit button
                        $("#saveBtn").prop("disabled", true);

                        $.ajax({
                            enctype: 'multipart/form-data',
                            data: formdata,
                            url: "{{ url('admin/calltemplates') }}",
                            type: "POST",
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                $('#calltemplateForm').trigger("reset");
                                table.draw();
                                $('#saveBtn').html('Save');
                                if ($.isEmptyObject(data.errors)) {
                                    Swal.fire({
                                        position: 'top-center',
                                        icon: 'success',
                                        title: data.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    $('#calltemplateModel').modal('hide');
                                    // disabled the submit button
                                    $("#saveBtn").prop("disabled", false);
                                } else {
                                    $('.alert-danger').show();
                                    $.each(data.errors, function (key, value) {
                                        $('.alert-danger').append('<p class="mb-0">' + value + '</p>');
                                    });
                                    // disabled the submit button
                                    $("#saveBtn").prop("disabled", false);
                                }
                            }
                        });
                    });

                    // edit calltemplate
                    $('body').on('click', '.editCallTemplate', function () {
                        var calltemplate_id = $(this).data('id');
                         $.get("{{ url('admin/calltemplates') }}" + '/' + calltemplate_id + '/edit', function (data) {
                            $('.modal-title').html("Edit Call Template");
                            $('#saveBtn').html('Update');
                            $('.alert-danger').html('');
                            $('.alert-danger').hide();
                            $('#calltemplateModel').modal('show');
                            $('#calltemplate_id').val(data.id);
                            $('#title').val(data.title);
                            $('#recording').val(data.recording);
                            $('#modal-preview').attr('alt', 'No image available');
                            if (data.recording) {
                                $('#modal-preview').attr('src', '../uploads/calltemplates/' + data.recording);
                                $('#hidden_file').val(data.recording);
                            }

                        })
                    });

                    // delete calltemplate
                    $('body').on('click', '.deleteCallTemplate', function () {
                        var calltemplate_id = $(this).data("id");

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
                            url: "{{ url('admin/calltemplates') }}" + '/' + calltemplate_id,
                            success: function (data) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Call Template has been deleted.',
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
