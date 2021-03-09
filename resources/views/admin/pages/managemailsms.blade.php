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
                    <h1>Send Mail/SMS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Contact Management</a></li>
                        <li class="breadcrumb-item active">Send Mail/SMS</li>
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
                                    <h3 class="card-title">List of Sent Messages (Mail/SMS)</h3>
                                    <button class="btn btn-primary ml-auto" id="createNewMailSMS"><i class="fa fa-plus"></i>&nbsp;Send Mail/SMS</button>
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
                                                <th>Sender</th>
                                                <th>Receiver</th>
                                                <th>Subject</th>
                                                <th>Message Type</th>
                                                <th>Message</th>
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



    {{-- create/update mailsms modal--}}
    <div class="modal fade" id="mailsmsModel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="mailsmsForm" name="mailsmsForm" class="form-horizontal"
                              enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">                                
                                <input type="hidden" name="mailsms_id" id="mailsms_id">
                                <div class="form-group">
                                    <label for="staff_to" class="col-sm-6 control-label">Receiver</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="staff_to" id="staff_to">
                                            <option value="" disabled selected>Select</option>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <label for="mailsms_template" class="col-sm-12 control-label">Email/SMS Template</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="mailsms_template" id="mailsms_template">
                                            <option value="" disabled selected>Select</option>
                                        </select>
                                    </div>
                                </div>
                                </div> <!-- /.col -->
                                <div class="col-6">                                 
                                <div class="form-group">
                                    <label for="message_type" class="col-sm-6 control-label">Message Type</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="message_type" id="message_type">
                                            <option value="" disabled selected>Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="col-sm-2 control-label">Subject</label>
                                    <div class="col-sm-12">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter the Subject"
                                       value="" maxlength="50" required="" autocomplete="off">
                                    </div>
                                </div>
                            </div> <!-- /.col -->
                        </div> <!-- /.row -->

                        <div class="row">
                            <div class="col-12"> 
                                <div class="form-group">
                                    <label for="message" class="col-sm-2 control-label">Message</label>
                                    <div class="col-sm-12">
                                    <textarea id="message" name="message_body" rows="7" cols="50" class="form-control" placeholder="Enter Message"></textarea>
                                    </div>
                                </div>
                            </div> <!-- /.col -->
                            </div><!-- /.row -->
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
    <!-- include summernote css/js -->
    <script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>
    
    <script type="text/javascript">
        $(function () {

    /*$(document).ready(function() {
        $('#message').summernote();
    });*/

    //ajax setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Load Staff with Email
    $.ajax({
        url: '{{route("admin.staff.filterstaffemail")}}',
            }).done(function(data) {
                $('#staff_from').html("<option value=''>Select</option>" + data);
            });
    //Load Staff with Email
    $.ajax({
        url: '{{route("admin.staff.filterstaffemail")}}',
            }).done(function(data) {
                $('#staff_to').html("<option value=''>Select</option>" + data);
            });

    //Load Message Types
    $.ajax({
        url: '{{route("admin.staff.filtermessagetype")}}',
            }).done(function(data) {
                $('#message_type').html("<option value=''>Select</option>" + data);
            });

    //Load template
    $( "#message_type" ).change(function() {
        $.ajax({
            url: '{{route("admin.staff.filtermailsmstemplate")}}',
            data:{messagetype: $(message_type).val()},
            type:"GET",
            success: function(data) {
                $('#mailsms_template').html('<option value="" disabled selected>Select Template</option>' + data);
            }
        });
    });

    //Load template title and message
    $( "#mailsms_template" ).change(function() {
        var template_id = $(this).val();
        var returnValue;
        $.ajax({
            url: '{{route("admin.staff.filtermailsmsbody")}}',
            data:{id: template_id},
            type:"GET",
            dataType:"json",
            success: function(data) {
                $('#subject').val(data.title);
                if(data.type=="Email"){
                    $('#message').summernote('code', data.message);
                }
                else{
                    $('#message').each(function( index ) {
                        $(this).summernote('destroy');
                        $(this).val(data.message);
                    });
                }
            }
        });
    });

    // datatable
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('admin/mailsms') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'sender', name: 'sender'},
                    {data: 'receiver', name: 'receiver'},
                    {data: 'subject', name: 'subject'},
                    {data: 'message_type', name: 'message_type'},
                    {data: 'message', name: 'message'},
                ]
            });

            // create new mailsms
            $('#createNewMailSMS').click(function () {
                $('#message').each(function( index ) {
                    $(this).summernote('destroy');
                    $(this).val('');
                });
                $('#message').empty();
                $('#mailsms_template').html('<option value="" disabled selected>Select</option>');
                $('#saveBtn').html("Send");
                $('#mailsms_id').val('');
                $('#mailsmsForm').trigger("reset");
                $('.modal-title').html("Send New Mail/SMS");
                $('#mailsmsModel').modal('show');
            });

            // create or update mailsms
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Saving...');

                $.ajax({
                    data: $('#mailsmsForm').serialize(),
                    url: "{{ url('admin/mailsms') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#mailsmsForm').trigger("reset");
                        $('#mailsmsModel').modal('hide');
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

        });
    </script>
@endsection