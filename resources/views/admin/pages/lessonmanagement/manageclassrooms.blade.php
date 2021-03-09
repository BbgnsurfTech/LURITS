@extends('layouts.admin')

@section('content')
    <div class="content-wrapper" style="min-height: 1249.6px;">
        <!-- Page title -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage Classes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Settings</a></li>
                            <li class="breadcrumb-item active">Manage Classes</li>
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
                                        @can('manage_classes_store')
                                        <button class="btn btn-primary ml-auto" id="createNewClass"><i
                                                class="fa fa-plus"></i>&nbsp;Add New Class
                                        </button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="dataTable" class="table table-striped table-bordered" style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Class Name</th>
                                                    <th>Class Section</th>
                                                    <th>Class Teacher</th>
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

        <div class="modal fade" data-backdrop="static" id="classModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div id="spiner">
                    </div>
                         <form id="classForm" name="classForm" action="/admin/classes" data-parsley-validate class="form-horizontal form-label-left"
                              method="post">
                        @csrf
                        <div class="modal-header primary">
                            <h4 class="modal-title" id="modelHeading"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if(!Auth::User()->is_headTeacher)
                            <div class="form-group">
                                <input type="hidden" name="class_idd" id="class_idd">
                                <label for="school_id" class="col-sm-4 control-label">School</label>
                                <div class="col-sm-12 err">
                                    <select class="form-control" name="school_id" id="school_id" required>
                                        <option disabled selected value="">Please Select</option>
                                        @foreach($schools as $school)
                                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <input type="hidden" name="class_idd" id="class_idd">
                                <label for="name" class="col-sm-4 control-label">Class Title</label>
                                <div class="col-sm-12 err">
                                    <select class="form-control" name="class_id" id="class_id" required>
                                        <option disabled selected value="">Please Select</option>
                                        @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label">Section Title</label>
                                <div class="col-sm-12 err">
                                    <select class="form-control" name="arm_id" id="arm_id" required>
                                        <option disabled selected value="">Please Select</option>
                                        @foreach($arms as $arm)
                                        <option value="{{ $arm->id }}">{{ $arm->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-4 control-label">Class Teacher</label>
                                <div class="col-sm-12 err">
                                    <select class="form-control" name="teacher" id="teacher" >
                                        <option disabled selected value="">Please Select</option>
                                        @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->middle_name }} {{ $teacher->last_name }} - {{ $teacher->lga_staff_id }}</option>
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

            //ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $(document).ready(function(){
            $('select[name="school_id"]').on('change', function(){
                var school = $(this).val();
                if(school){
                    $.ajax({
                       url: 'school-staff' ,
                       data: { school_idd: school },
                       beforeSend: function () {
                         $('.spinner').show();  
                       },
                       success: function(data){
                           $('.spinner').hide();
                            $('select[name="teacher"]').empty();
                            $('select[name="teacher"]').prepend('<option disabled selected value="">Please Select</option>');
                            $.each(data, function(key, value){
                                $('select[name="teacher"]').append('<option value="'+value.id+'">'+value.first_name+' '+value.middle_name+' '+value.last_name+' - '+value.lga_staff_id+'</option>');
                            });
                       }
                    });
                }

            });
            });
            
            // datatable
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 100,
                ajax: "{{ url('admin/classes') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'class_title.title', name: 'name'},
                    {data: 'arm_title.title', name:'arm'},
                    {data: 'staff_data.lga_staff_id', name:'teacher'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ]
            });

            @can('manage_classes_store')
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


            //create/update class
                $('#classForm').validate({
                    rules: {
                        class_id: {
                            required: true
                        },
                        arm_id: {
                            required: true
                        },
                        teacher: {
                            required: true
                        },
                    },
                    messages: {
                        class_id: {
                            required: "Please select an class"
                        },
                        arm_id: {
                            required: "Please select an section"
                        },
                        teacher: {
                            required: "Please select an section"
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
                            url: "{{ url('admin/classes') }}",
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
                alert(class_id);
                $.get("{{ url('admin/classes') }}" + '/' + class_id + '/edit', function (data) {
                     $('.modal-title').html("Edit Class");
                    $('#saveBtn').html('Update');
                    $('#class_id').val(data.class_title.id);
                    $('#class_idd').val(data.id);
                    $('#arm_id').val(data.arm_title.id);
                    $('#name').val(data.name);
                    $('#teacher').val(data.lga_staff_id);
                    $('#classModel').modal('show');
                })
            });
            @endcan
            @can('manage_classes_destroy')
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
                            url: "{{ url('admin/classes') }}" + '/' + class_id,
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
