@extends('layouts.master')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

@endsection

@section('content')
    <div class="content-wrapper" style="min-height: 1249.6px;">
    <!-- Page title -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Calls</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Mail/SMS</a></li>
                        <li class="breadcrumb-item active">Send Message</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch">
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                    <div class="col-7">
                        <h2 class="lead"><b>Mohammed Abdullahi</b></h2>
                        <p class="text-muted text-sm"><b>About: </b> Teacher </p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: No 200, GRA, Katsina</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span><a href="skype:123456789">
                        Phone #: + 123456789</a></li>
                        </ul>
                    </div>
                    <div class="col-5 text-center">
                        <img src="../../dist/img/avatar5.png" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                        <i class="fas fa-sms"></i>
                    </a>
                    <a href="#" class="btn btn-sm bg-teal">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-primary">
                        <i class="fas fa-user"></i> View Profile
                    </a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer -->
        </div>
        <!-- /.card -->

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
                            <label class="col-sm-2 control-label">Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="code" name="code"
                                       placeholder="Enter school code"
                                       value="" maxlength="50" required="" autocomplete="off">
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
                    {data: 'code', name: 'code'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            // create new school
            $('#createNewSchool').click(function () {
                $('#saveBtn').html("Create");
                $('#school_id').val('');
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
                    $('#code').val(data.code);
                })
            });

            // delete school
            $('body').on('click', '.deleteSchool', function () {
                var school_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ url('schools') }}" + '/' + school_id,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script>
@endsection
