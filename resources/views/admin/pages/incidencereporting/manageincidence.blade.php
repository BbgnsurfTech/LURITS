@extends('layouts.admin')
@section('content')
<div class="content-wrapper" style="min-height: 1249.6px;">
    <!-- Page title -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Incidences</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Incidences</a></li>
                        <li class="breadcrumb-item active">Manage Incidences</li>
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
                                    <h3 class="card-title">List of Indcidences</h3>
                                    @can('incidence_create')
                                    <button class="btn btn-primary ml-auto" id="createNewIncidence"><i
                                            class="fa fa-plus"></i>&nbsp;Add New Incidence
                                    </button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @include('partials.filter.school')
                            
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="dataTable" class="table table-hover table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Rate</th>
                                                <th>Title</th>
                                                <th>Image</th>
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

    @can('incidence_create')
    {{-- create/update class modal--}}
    <div class="modal fade" data-backdrop="static" id="incidenceModel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="spiner">
                </div>
                <form id="incidenceForm" name="incidenceForm" data-parsley-validate
                      class="form-horizontal form-label-left"
                      method="post" enctype="multipart/form-data">
                    <input type="hidden" name="incidence_id" id="incidence_id">
                    <div class="modal-header primary">
                        <h4 class="modal-title" id="modelHeading"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="col-sm-2">
                            <label for="title">Title</label>
                            </div>
                            <div class="col-sm-12 err">
                            <input class="form-control" name="title" id="title" value="{{ old('title') }}"
                                   placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">
                            <label for="incidence_body">Body</label>
                            </div>
                            <div class="col-sm-12 err">
                            <textarea name="incidence_body" id="incidence_body"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="rate">Rate</label>
                            </div>
                            <div class="col-sm-2 err">
                                <select class="form-control" name="rate" id="rate">
                                    <option value="" disabled selected>Select Rate</option>
                                    <option value="extreme" {{ old('rate') === 'extreme' ? 'selected' : null }}>
                                        Extreme
                                    </option>
                                    <option value="high" {{ old('rate') === 'high' ? 'selected' : null }}>High
                                    </option>
                                    <option value="medium" {{ old('rate') === 'medium' ? 'selected' : null }}>
                                        Medium
                                    </option>
                                    <option value="low" {{ old('rate') === 'low' ? 'selected' : null }}>Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">
                                     <i class="fas fa-paperclip"></i> Attachment
                                    <input type="file" name="attachment">
                                 <p class="help-block">Max. 32MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input type="submit" id="saveBtn" name="saveBtn" value="Save" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endcan

    {{-- create/update class modal--}}
    <div class="modal fade" data-backdrop="static" id="incidenceViewModel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                    <div class="modal-header primary">
                        <h4 class="modal-title" id="modelHeading"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="mailbox-read-info" id="incidence_title">
                         </div>

                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message" id="incidence_description">



                        </div>
                        <!-- /.mailbox-read-message -->
                    </div>
                    <div class="card-footer bg-white">
                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">

                            <li>
                                <span class="mailbox-attachment-icon has-img" id="image_div">

                                </span>
                             </li>
                        </ul>
                    </div>
                    <div class="card-footer justify-content-between">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-info"><i class="fas fa-print"></i> Print</button>
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
<script>
    $(function () {
        //Add text editor
        $('#incidence_body').summernote()
    })
</script>
<script type="text/javascript">
    $(function () {
        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 100,
            ajax: {
                url: "{{ route('admin.incidences.index') }}",
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'rate', name: 'rate'},
                {data: 'title', name: 'title'},
                {data: 'photo', name: 'photo'},
                {data: 'time', name: 'time'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ]
        });

        // create new section
        $('#createNewIncidence').click(function () {
            $('#saveBtn').html("Add");
            $('#incidence_id').val('');
            $('#incidenceForm').trigger("reset");
            $('.modal-title').html("Add New Incidence");
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            //reset the client side form validation
            $('.invalid-feedback').remove();
            
            $('#incidenceModel').modal('show');
        });

        // view incidence
        $('body').on('click', '.viewIncidence', function () {
            var incidence_id = $(this).data('id');
            $('#image_div').empty();
             $.get("{{ url('admin/incidences') }}" + '/' + incidence_id, function (data) {
                 $('.modal-title').html("Incidence View");
                 $('#incidence_title').html('<h4>'+data.title+'</h4>');
                $('#incidence_description').html(data.description);
                 if (data.photo) {
                     $('#image_div').html('<img src="images/incidences/' + data.photo + '" alt="image"/>');
                  }
                $('#incidenceViewModel').modal('show');
            })
        });

        // edit Schedule
        $('body').on('click', '.editIncidence', function () {
            var incidence_id = $(this).data('id');
             $.get("{{ url('admin/incidences') }}" + '/' + incidence_id + '/edit', function (data) {
                $('.modal-title').html("Edit Incidence");
                $('#saveBtn').html('Update');
                 $('#incidence_id').val(data.id);
                $('#title').val(data.title);
                $('#incidence_body').summernote('code', data.description);
                $('#rate').val(data.rate);
                $('#incidenceModel').modal('show');
            })
        });

        //create/update class
        $('#incidenceForm').validate({
            rules: {
                title: {
                    required: true
                },
                incidence_body: {
                    required: true
                },
                rate: {
                    required: true
                },
            },
            messages: {
                title: {
                    required: "Please provide the the incidence title"
                },
                incidence_body: {
                    required: "Please provide the incidence body"
                },
                rate: {
                    required: "Please select the incidence rate"
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
                // Get form
                var form = $('#incidenceForm')[0];
                // Create an FormData object
                var formdata = new FormData(form);
                $.ajax({
                    url: "{{ url('admin/incidences') }}",
                    type: "POST",
                    data: formdata,
                    contentType: false,
                    cache: false,
                    processData: false,
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
                            $('#incidenceForm').trigger("reset");
                            $('#incidenceModel').modal('hide');
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

    });
</script>

@if(Auth::User()->is_superAdmin || Auth::User()->is_admin)
<script src="{{ asset('js/filter.js') }}"></script>
@endif
@if(Auth::User()->is_zeqa)
<script src="{{ asset('js/zeqa.js') }}"></script>
@endif
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="school"]').on('change', function(){
            var school = $(this).val();

            // datatable
        var table = $('#dataTable').DataTable({
            processing: true,
          serverSide: true,
          destroy: true,
          retrieve: false,
            pageLength: 100,
            ajax: {
                url: "{{ route('admin.incidences.index') }}",
                data: {
                school: school 
                },
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'rate', name: 'rate'},
                {data: 'title', name: 'title'},
                {data: 'photo', name: 'photo'},
                {data: 'time', name: 'time'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ]
        });

             // $('#datatable').DataTable({
             //    processing: true,
             //    serverSide: true,
             //    destroy: true,
             //    retrieve: false,
             //    aaSorting: [],
             //    ajax: {
             //        url: "{{ route('admin.staffs.index') }}",
             //        data: {
             //        school: school 
             //        },
             //    },
                
             //    columns: [
             //        { data: 'placeholder', name: 'placeholder' },
             //        { data: 'staff_id', name: 'staff_id' },
             //        { data: 'first_name', name: 'first_name' },
             //        { data: 'middle_name', name: 'middle_name' },
             //        { data: 'last_name', name: 'last_name' },
             //        { data: 'email', name: 'email' },
             //        { data: 'phone_number', name: 'phone_number' },
             //        { data: 'actions', name: '{{ trans('global.actions') }}' }
             //    ],
             //    order: [[ 1, 'desc' ]],
             //    pageLength: 50,
             // });
        });
    });
</script>
@if(Auth::User()->is_headTeacher)
<script>

  $(function () {
    // datatable
    var school = {!! Auth::User()->school_id !!};
    // alert(school);
    var table = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 100,
        ajax: {
                url: "{{ route('admin.incidences.index') }}",
                data: {
                school: school 
                },
            },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'rate', name: 'rate'},
            {data: 'title', name: 'title'},
            {data: 'photo', name: 'photo'},
            {data: 'time', name: 'time'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false},
        ]
    });
  });
</script>
@endif
@endsection
