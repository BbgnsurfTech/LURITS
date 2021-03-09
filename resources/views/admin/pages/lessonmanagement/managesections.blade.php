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
                    <h1>Manage Sections</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage Sections</li>
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
                                    <h3 class="card-title">List of Sections</h3>
                                    <button class="btn btn-primary ml-auto" id="createNewSection"><i class="fa fa-plus"></i>&nbsp;Add New Section</button>
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
                                                <th>Class</th>
                                                <th>Section Name</th>
                                                <th>Section Title</th>
                                                <th>Section Teacher</th>
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
    <div class="modal fade" data-backdrop="static" id="sectionModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="spiner">
                </div>
                <form id="sectionForm" name="sectionForm" class="form-horizontal">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="hidden" name="section_id" id="section_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Class</label>
                        <div class="col-sm-12 err">
                            <select class="form-control errhighlight" name="class" id="class">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Section Name</label>
                            <div class="col-sm-12 err">
                                <input type="text" class="form-control errhighlight" id="name" name="name" placeholder="Enter name"
                                       value="" maxlength="50" required="" autocomplete="off">
                            </div>
                        </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Section Title</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter name"
                                   value="" maxlength="50" required="" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">Section Teacher</label>
                        <div class="col-sm-12 err">
                            <select class="form-control errhighlight" name="sectionteacher" id="sectionteacher">
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

        {{-- show schedule modal--}}
        <div class="modal fade" id="scheduleModel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Time Table</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" id="time_table_data">

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <div class="row no-print">
                                    <div class="col-12">
                                        <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Cancel
                                        </button>
                                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                            <i class="fas fa-download"></i> Generate PDF
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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

            //Load classes
            $.ajax({
                url: '{{route("admin.classes.filter")}}',
            }).done(function(data) {
                $('#class').html("<option value=''>Select</option>" + data);
            });

            //Load Class Masters
            $.ajax({
                url: '{{route("admin.staff.filter")}}',
            }).done(function(data) {
                $('#sectionteacher').html("<option value=''>Select</option>" + data);
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
                ajax: "{{ url('admin/sections') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'class', name: 'class'},
                    {data: 'name', name: 'name'},
                    {data: 'title', name: 'title'},
                    {data: 'teacher', name: 'teacher'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ]
            });


            // create new section
            $('#createNewSection').click(function () {
                $('#saveBtn').html("Add");
                $('#section_id').val('');
                $('#sectionForm').trigger("reset");
                $('.modal-title').html("Add New Section");
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                //reset the client side form validation
                $('.invalid-feedback').remove();
                var elements = document.getElementsByClassName('form-control');
                [].forEach.call(elements, function(el) {
                    el.className = el.className.replace(/\bis-invalid\b/, "");
                });
                $('#sectionModel').modal('show');
            });


            //create/update class
            $('#sectionForm').validate({
                rules: {
                    name: {
                        required: true
                    },
                    class: {
                        required: true
                    },
                    sectionteacher: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: "Please provide the class name"
                    },
                    class: {
                        required: "Please provide a class"
                    },
                    sectionteacher: {
                        required: "Please select a section teacher"
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.err').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).find('.errhighlight').addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    $.ajax({
                        data: $('#sectionForm').serialize(),
                        url: "{{ url('admin/sections') }}",
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
                                $('#sectionForm').trigger("reset");
                                $('#sectionModel').modal('hide');
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


            // edit section
            $('body').on('click', '.editSection', function () {
                var section_id = $(this).data('id');
                 $.get("{{ url('admin/sections') }}" + '/' + section_id + '/edit', function (data) {
                     $('.modal-title').html("Edit Section");
                    $('#saveBtn').html('Update');
                    $('#section_id').val(data.id);
                    $('#name').val(data.name);
                    $('#class').val(data.class_id);
                    $('#title').val(data.title);
                    $('#sectionteacher').val(data.staff_id);
                    $('#sectionModel').modal('show');
                 })
            });

            // show Schedule
            $('body').on('click', '.viewSchedule', function () {
                $('#time_table_data').empty();
                var section_id = $(this).data('id');
                $.ajax({
                    data: {section_id: section_id},
                    url: "{{ route('admin.timetable.index') }}",
                    type: "GET",
                    dataType: 'json',
                     success: function (data) {
                        $('#time_table_data').html(data.html);
                        $('#scheduleModel').modal('show');
                     },
                    error: function (result) {
                        $("#time_table_data").html("Sorry Cannot Load Time Table Data");
                    }
                });

             });

            // delete section
            $('body').on('click', '.deleteSection', function () {
                var section_id = $(this).data("id");
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
                            url: "{{ url('admin/sections') }}" + '/' + section_id,
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
