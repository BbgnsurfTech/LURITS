@extends('layouts.master')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- include summernote css/js -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote.min.css') }}" >
@endsection

@section('content')
    <div class="content-wrapper" style="min-height: 1249.6px;">
    <!-- Page title -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Mail/SMS Templates</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Contact Management</a></li>
                        <li class="breadcrumb-item active">Manage Mail/SMS Templates</li>
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
                                    <h3 class="card-title">List of Mail/SMS Templates</h3>
                                    <button class="btn btn-primary ml-auto" id="createNewMailSMSTemplate"><i class="fa fa-plus"></i>&nbsp;Create Mail/SMS Template</button>
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
                                                <th>Message</th>
                                                <th>Message Type</th>
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


    {{-- create/update mailsmstemplate modal--}}
    <div class="modal fade" id="mailsmstemplateModel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="mailsmstemplateForm" name="mailsmstemplateForm" class="form-horizontal">
                        <input type="hidden" name="mailsmstemplate_id" id="mailsmstemplate_id">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                                       value="" maxlength="50" required="" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                                    <label for="message_type" class="col-sm-12 control-label">Message Type</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="message_type" id="message_type">
                                            <option value="" disabled selected>Select</option>
                                            <option value="Email">Email</option>
                                            <option value="SMS">SMS</option>
                                        </select>
                                    </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Message</label>
                            <div class="col-sm-12">
                                <textarea id="message" name="message" rows="4" cols="50" class="form-control" placeholder="Enter Message"></textarea>
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
    <!-- include summernote css/js -->
    <script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>
    
    <script type="text/javascript">
        $(function () {

            //ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

    //Load template title and message
    $( "#message_type" ).change(function() {
        var template_id = $(this).val();
        if(template_id=="Email"){
            $('#message').summernote();
        }
        else{
            $('#message').each(function( index ) {
                $(this).summernote('destroy');
                $(this).val('');
            });
        }
        
    });

            // datatable
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('admin/mailsmstemplates') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'title', name: 'title'},
                    {data: 'message', name: 'message'},
                    {data: 'type', name: 'type'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            // create new mailsmstemplate
            $('#createNewMailSMSTemplate').click(function () {
                $('#message').each(function( index ) {
                    $(this).summernote('destroy');
                    $(this).val('');
                });
                $('#message').empty();
                $('#saveBtn').html("Create");
                $('#mailsmstemplate_id').val('');
                $('#mailsmstemplateForm').trigger("reset");
                $('.modal-title').html("Create New Mail/SMS Template");
                $('#mailsmstemplateModel').modal('show');
            });

            // create or update mailsmstemplate
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Saving...');

                $.ajax({
                    data: $('#mailsmstemplateForm').serialize(),
                    url: "{{ url('admin/mailsmstemplates') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#mailsmstemplateForm').trigger("reset");
                        $('#mailsmstemplateModel').modal('hide');
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

            // edit mailsmstemplate
            $('body').on('click', '.editMailSMSTemplate', function () {
                var mailsmstemplate_id = $(this).data('id');
                 $.get("{{ url('admin/mailsmstemplates') }}" + '/' + mailsmstemplate_id + '/edit', function (data) {
                     $('.modal-title').html("Edit Mail/SMS Template");
                    $('#saveBtn').html('Update');
                    $('#mailsmstemplateModel').modal('show');
                    $('#mailsmstemplate_id').val(data.id);
                    $('#title').val(data.title);
                    $('#message_type').val(data.type);
                    if(data.type=="SMS"){
                        $('#message').each(function( index ) {
                            $(this).summernote('destroy');
                            $(this).val('');
                        });
                        $('#message').val(data.message);
                    }
                    else{
                        $('#message').summernote('code', data.message);
                    }
                 })
            });

            // delete mailsmstemplate
            $('body').on('click', '.deleteMailSMSTemplate', function () {
                var mailsmstemplate_id = $(this).data("id");
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
                            url: "{{ url('admin/mailsmstemplates') }}" + '/' + mailsmstemplate_id,
                            success: function (data) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Mail/SMS Template has been deleted.',
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