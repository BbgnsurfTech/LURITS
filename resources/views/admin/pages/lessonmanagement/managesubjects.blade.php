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
                    <h1>Manage Subjects</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage Subjects</li>
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
                                    <h3 class="card-title">List of Subjects</h3>
                                    @can('manage_subjects_access')
                                    <button class="btn btn-primary ml-auto" id="createNewSubject"><i class="fa fa-plus"></i>&nbsp;Add New Subject</button>
                                    @endcan
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
                                                <th>Subject</th>
                                                <th>Class Title</th>
                                                <th>Class Section</th>
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

   
    {{-- create/update subject modal--}}
    <div class="modal fade" data-backdrop="static" id="subjectModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="spiner">
                </div>
                <form id="subjectForm" name="subjectForm" class="form-horizontal">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="hidden" name="subject_id" id="subject_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Class</label>
                            <div class="col-sm-12 err">
                                <select class="form-control" name="class_id" id="class_id" required>
                                    <option disabled selected value="">Please Select</option>
                                    @foreach($classes as $class_id)
                                        <option value="{{ $class_id->id }}" {{ old('last_class_attended') == $class_id->id ? 'selected' : '' }}>{{ $class_id["classTitle"]->title }} - {{ $class_id["armTitle"]->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Subject</label>
                            <div class="col-sm-12 err">
                                <select class="form-control" name="subject" id="subject" required>
                                    <option selected disabled value="">Please Select</option>
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->ds_subject_name }}</option>
                                    @endforeach
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
                ajax: "{{ url('admin/subjects') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'subject_name.ds_subject_name', name: 'subject'},
                        {data: 'class_name.class_title.title', name: 'class'},
                        {data: 'class_name.arm_title.title', name: 'arm'},
                        {data: 'actions', name: 'actions', orderable: false, searchable: false},
                    ]
            });

            @can('manage_subjects_store')
            // create new subject
            $('#createNewSubject').click(function () {
                $('#saveBtn').html("Add");
                $('#subject_id').val('');
                $('#subjectForm').trigger("reset");
                $('.modal-title').html("Add New Subject");
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                //reset the client side form validation
                $('.invalid-feedback').remove();
                var elements = document.getElementsByClassName('form-control');
                [].forEach.call(elements, function(el) {
                    el.className = el.className.replace(/\bis-invalid\b/, "");
                });
                $('#subjectModel').modal('show');
            });

            //create/update class
            $('#subjectForm').validate({
                rules: {
                    class_id: {
                        required: true
                    },
                    subject: {
                        required: true
                    },
                },
                messages: {
                    class_id: {
                        required: "Please select class"
                    },
                    subject: {
                        required: "Please select subject"
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
                        data: $('#subjectForm').serialize(),
                        url: "{{ url('admin/subjects') }}",
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
                                $('#subjectForm').trigger("reset");
                                $('#subjectModel').modal('hide');
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
            @endcan
            @can('manage_subjects_edit')
            // edit subject
            $('body').on('click', '.editSubject', function () {
                var subject_id = $(this).data('id');
                 $.get("{{ url('admin/subjects') }}" + '/' + subject_id + '/edit', function (data) {
                    $('.modal-title').html("Edit Subject");
                    $('#saveBtn').html('Update');
                    $('#subject_id').val(data.id);
                    $('#subject').val(data.subject_id);
                    $('#class_id').val(data.class_id);
                    $('#subjectModel').modal('show');
                 })
            });
            @endcan
            @can('manage_subjects_delete')
            // delete subject
            $('body').on('click', '.deleteSubject', function () {
                var subject_id = $(this).data("id");
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
                            url: "{{ url('admin/subjects') }}" + '/' + subject_id,
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
            @endcan

        });
    </script>
@endsection
