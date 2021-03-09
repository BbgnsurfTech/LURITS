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
                        <h1>Manage Class Settings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Settings</a></li>
                            <li class="breadcrumb-item active">Manage Class Settings</li>
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
                                        <h3 class="card-title">List of Classes</h3>
                                        <button class="btn btn-primary ml-auto" id="createNewClass"><i
                                                class="fa fa-plus"></i>&nbsp;Add New Class
                                        </button>
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
                                                    <th>Class Name</th>
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


        {{-- create/update class modal--}}
        <div class="modal fade" data-backdrop="static" id="classModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div id="spiner">
                    </div>
                         <form id="classForm" name="classForm" data-parsley-validate class="form-horizontal form-label-left"
                              method="post">
                        <div class="modal-header primary">
                            <h4 class="modal-title" id="modelHeading"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="class_id" id="class_id">
                            <div class="form-group">
                                <label for="class" class="col-sm-4 control-label">Class Name</label>
                                <div class="col-sm-12 err">
                                    <select class="form-control" name="class" id="class">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="alert alert-danger alert-dismissible" style="display: none">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                             <input type="submit" id="saveBtn" name="saveBtn" value="Save" class="btn btn-primary">
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
                processing: true,
                serverSide: true,
                pageLength: 100,
                ajax: "{{ url('admin/classsettings') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ]
            });


            // create new section
            $('#createNewClass').click(function () {
                $('#saveBtn').html("Add");
                $('#class_id').val('');
                $('#classForm').trigger("reset");
                $('.modal-title').html("Add New Class");
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                //reset the client side form validation
                $('.invalid-feedback').remove();
                var elements = document.getElementsByClassName('form-control');
                [].forEach.call(elements, function(el) {
                    el.className = el.className.replace(/\bis-invalid\b/, "");
                });
                $('#classModel').modal('show');
            });


            //create/update class
                $('#classForm').validate({
                    rules: {
                        class: {
                            required: true
                        } 
                    },
                    messages: {
                        name: {
                            required: "Please select a class"
                        },
                         
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.err').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    },
                    submitHandler: function (form) {
                         $.ajax({
                            data: $('#classForm').serialize(),
                            url: "{{ url('admin/classsettings') }}",
                            type: "POST",
                            dataType: 'json',
                            beforeSend: function () {
                                $('.alert-danger').html('');
                                $('.alert-danger').hide();
                                $('#spiner').html('<div class="overlay d-flex justify-content-center align-items-center">\n' +
                                    '                        <i class="fas fa-2x fa-sync fa-spin"></i>\n' +
                                    '                    </div>');
                                $("#saveBtn").prop("disabled", true);// disable button
                            },
                            success: function (data) {
                                $('#spiner').html('');
                                $("#saveBtn").prop("disabled", false);// disable button
                                if (data.type === 'success') {
                                    Swal.fire({
                                        position: 'top-center',
                                        icon: 'success',
                                        title: data.message,
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    $('#classForm').trigger("reset");
                                    $('#classModel').modal('hide');
                                    table.draw();
                                    $('#saveBtn').html('Save');
                                } else if (data.type === 'error') {
                                    if (data.errors) {
                                        $('.alert-danger').show();
                                        $.each(data.errors, function (key, value) {
                                            $('.alert-danger').append('<p class="mb-0">' + value + '</p>');
                                        });
                                    }
                                    Swal.fire({
                                        title: 'Error saving data!',
                                        text: 'Try again',
                                        icon: 'error',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }
                            }
                        });
                     }
            });

            // edit class
            $('body').on('click', '.editClass', function () {
                var class_id = $(this).data('id');
                $.get("{{ url('admin/classsettings') }}" + '/' + class_id + '/edit', function (data) {
                     $('.modal-title').html("Edit Class");
                    $('#saveBtn').html('Update');
                    $('#class_id').val(data.id);
                    $('#class').val(data.class_id);
                     $('#classModel').modal('show');
                })
            });

            // delete class
            $('body').on('click', '.deleteClass', function () {
                var class_id = $(this).data("id");
                Swal.fire({
                    title: "Are you sure?",
                    text: "Deleted data cannot be recovered!!",
                    icon: 'warning',
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('admin/classsettings') }}" + '/' + class_id,
                            beforeSend: function () {
                                $('.alert-danger').html('');
                                $('.alert-danger').hide();
                                $('#spiner').html('<div class="overlay d-flex justify-content-center align-items-center">\n' +
                                    '                        <i class="fas fa-2x fa-sync fa-spin"></i>\n' +
                                    '                    </div>');
                            },
                            success: function (data) {
                                $('#spiner').html('');
                                if (data.type === 'success') {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Successfully Deleted',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                    table.draw();
                                } else if (data.type === 'danger') {
                                    Swal.fire({
                                        title: 'Error deleting!',
                                        text: 'Try again',
                                        icon: 'error',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                }
                            },
                            error: function (data) {
                                $('#spiner').html('');
                                Swal.fire({
                                    title: 'Error deleting!',
                                    text: 'Try again',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            }
                        });
                    }
                })
            });

        });
    </script>
@endsection
