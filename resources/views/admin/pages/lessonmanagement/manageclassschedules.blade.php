@extends('layouts.admin')
@section('content')
    <div class="content-wrapper" style="min-height: 1249.6px;">
        <!-- Page title -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage Class Schedules</h1>
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
                                        <h3 class="card-title">List of Schedules</h3>
                                        <button class="btn btn-primary ml-auto" id="addSchedule"><i
                                                class="fa fa-plus"></i>&nbsp;Add New Schedule
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
                                                    <th>Class</th>
                                                    <th>Section</th>
                                                    <th>Subject</th>
                                                    <th>Teacher</th>
                                                    <th>Day</th>
                                                    <th>Time</th>
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


        {{-- create/update schedule modal--}}
        <div class="modal fade" data-backdrop="static" id="classscheduleModel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div id="spiner">
                    </div>
                    <form id="classscheduleForm" name="classscheduleForm" data-parsley-validate
                          class="form-horizontal form-label-left"
                          method="post">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="classschedule_id" id="classschedule_id">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="section" class="col-sm-2 control-label">Class</label>
                                    <div class="col-sm-12 err">
                                        <select class="form-control" name="class" id="class">
                                            <option disabled selected value="">Please Select</option>
                                            @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class["classTitle"]->title }} - {{ $class["armTitle"]->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="subject" class="col-sm-2 control-label">Subject</label>
                                    <div class="col-sm-12 err">
                                        <select class="form-control" name="subject" id="subject">
                                            <option disabled selected value="">Please Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="teacher" class="col-sm-6 control-label">Teacher</label>
                                    <div class="col-sm-12 err">
                                        <select class="form-control" name="teacher" id="teacher" required>
                                            <option disabled selected value="">Please Select</option>
                                            @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->middle_name }} {{ $teacher->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="day" class="col-sm-2 control-label">Day</label>
                                    <div class="col-sm-12 err">
                                        <select name="day" id="day" class="form-control">
                                            <option disabled selected value="">Please Select</option>
                                            <option value="1">MONDAY</option>
                                            <option value="2">TUESDAY</option>
                                            <option value="3">WEDNESDAY</option>
                                            <option value="4">THURSDAY</option>
                                            <option value="5">FRIDAY</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="start_time" class="col-sm-12 control-label">Start Time</label>
                                    <div class="input-group date col-sm-12 err" id="start_time"
                                         data-target-input="nearest">
                                        <div class="input-group-prepend" data-target="#start_time"
                                             data-toggle="datetimepicker">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="text" name="start_time" class="form-control datetimepicker-input" autocomplete="off" 
                                               data-target="#start_time"/>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="end_time" class="col-sm-12 control-label">End Time</label>
                                    <div class="input-group date col-sm-12 err" id="end_time"
                                         data-target-input="nearest">
                                        <div class="input-group-prepend" data-target="#end_time"
                                             data-toggle="datetimepicker">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="text" name="end_time" class="form-control datetimepicker-input" autocomplete="off"
                                               data-target="#end_time"/>
                                    </div>
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
    <script type="text/javascript">
        $(function () {

         $('#start_time').datetimepicker({
                format: 'LT',
                disabledHours: [0, 1, 2, 3, 4, 5, 6, 16, 17, 18, 19, 20, 21, 22, 23, 24],
                enabledHours: [7, 8, 9, 10, 11, 12, 13, 14, 15],
                stepping: 30
            });

            $('#end_time').datetimepicker({
                format: 'LT',
                disabledHours: [0, 1, 2, 3, 4, 5, 6, 7, 17, 18, 19, 20, 21, 22, 23, 24],
                enabledHours: [8, 9, 10, 11, 12, 13, 14, 15, 16],
                stepping: 30
            });

            // load subjects
            $('body').on('change', '#class', function () {
                var class_id = $('#class').val();
                $('#spinner').show();
                $.ajax({
                    url: '{{route("admin.subjects.filter")}}',
                    data: {class_id: class_id},
                    type: "GET",
                }).done(function (data) {
                    $('#spinner').hide();
                    $.each(data, function(key, value){
                            $('select[name="subject"]').append(
                                '<option value="'+value.subject_name.id+'">'+ value.subject_name.ds_subject_name +'</option>'
                                );
                         });
                });

            });

            //ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //$.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' });
            // datatable
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                pageLength: 50,
                dom: "<'row'<'col-sm-2'l><'col-sm-6'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                ajax: "{{ url('admin/classschedules') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'class', name: 'class'},
                    {data: 'section', name: 'section'},
                    {data: 'subject', name: 'subject'},
                    {data: 'teacher', name: 'teacher'},
                    {data: 'day', name: 'day'},
                    {data: 'time', name: 'time'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ],
                columnDefs: [
                    {
                        targets: 0,
                        className: 'noVis'
                    }
                ],
                buttons: [
                    {
                        extend: 'csv',
                        className: 'btn btn-default',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        exportOptions: {
                            columns: ':visible'
                        }
                },
                    {
                        extend: 'excel',
                        className: 'btn btn-default',
                        text: '<i class="fa fa-file-excel"></i> Excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-default',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-default',
                        text: '<i class="fa fa-print"></i> Print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        className: 'btn btn-default',
                        text: '<i class="fa fa-eye"></i> Column Visibility',
                        postfixButtons: [ 'colvisRestore' ],
                        columns: ':not(.noVis)'
                    }
                ]
            });

            // show Schedule
            $('body').on('click', '#addSchedule', function () {
                $('#saveBtn').html("Add");
                $('#classscheduleForm').trigger("reset");
                $('.modal-title').html("Add New Schedule");
                $('.alert-danger').html('');
                $('.alert-danger').hide();
                //reset the client side form validation
                $('.invalid-feedback').remove();
                var elements = document.getElementsByClassName('form-control');
                [].forEach.call(elements, function (el) {
                    el.className = el.className.replace(/\bis-invalid\b/, "");
                });
                $('#class_id').val($(this).data('id'));
                $('#classscheduleModel').modal('show');
            });


            //create schedule
            $('#classscheduleForm').validate({
                rules: {
                    class: {
                        required: true
                    },
                    subject: {
                        required: true
                    },
                    teacher: {
                        required: true
                    },
                    day: {
                        required: true
                    },
                    start_time: {
                        required: true
                    },
                    end_time: {
                        required: true
                    },
                },
                messages: {
                    class: {
                        required: "Please select a class"
                    },
                    subject: {
                        required: "Please select a subject"
                    },
                    teacher: {
                        required: "Please select a teacher"
                    },
                    day: {
                        required: "Please select a day"
                    },
                    start_time: {
                        required: "Please provide a start time"
                    },
                    end_time: {
                        required: "Please select an end time"
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
                        data: $('#classscheduleForm').serialize(),
                        url: "{{ url('admin/classschedules') }}",
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
                                $('#classscheduleForm').trigger("reset");
                                $('#classscheduleModel').modal('hide');
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

            // edit Schedule
            $('body').on('click', '.editSchedule', function () {
                var classschedule_id = $(this).data('id');
                 $.get("{{ url('admin/classschedules') }}" + '/' + classschedule_id + '/edit', function (data) {
                     $('.modal-title').html("Edit Schedule");
                    $('#saveBtn').html('Update');
                    $('#classschedule_id').val(data.classschedule.id);
                    $('#class').val(data.classschedule.class_id);
                    $('#subject').val(data.classschedule.subject_id);
                    $('#teacher').val(data.classschedule.staff_id);
                    $('#day').val(data.classschedule.day_of_week);
                    $('#start_time').datetimepicker('date', moment(data.classschedule.start_time, 'h:mm a') );
                    $('#end_time').datetimepicker('date', moment(data.classschedule.end_time, 'h:mm a') );
                    $('#classscheduleModel').modal('show');
                })
            });

            // show Schedule
            $('body').on('click', '.viewSchedule', function () {
                var class_schedule_id = $(this).data('id');
                $.get("{{ url('admin/classschedules') }}" + '/' + class_schedule_id + '/edit', function (data) {
                    $('#saveBtn').html('Print');
                    $('#scheduleModel').modal('show');
                    $('#subject_ID').val(data.subject_id);

                })
            });

            // delete class
            $('body').on('click', '.deleteSchedule', function () {
                var classschedule_id = $(this).data("id");
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
                            url: "{{ url('admin/classschedules') }}" + '/' + classschedule_id,
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
