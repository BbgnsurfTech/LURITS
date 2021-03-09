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
                    <h1>Add LGAs to Zone</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Manage LGAs</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="container-fluid">
                                <div class="row">
                                    <h3 class="card-title">List of LGAs in Zones</h3>
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
                                                <th>Zone Name</th>
                                                <th>LGA</th>
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


    {{-- add/update lgas modal--}}
    <div class="modal fade" id="lgasModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="lgasForm" name="lgasForm" class="form-horizontal">
                        <input type="hidden" name="zoneslga_id" id="zoneslga_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">LGA</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"
                                value="" maxlength="50" required="" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Zone</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="zones" id="zones">
                                    <option value="">Select</option>
                                </select>
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

            //Load zones
            $.ajax({
                url: '{{route("zones.filter")}}',
            }).done(function(data) {
                $('#zones').html("<option value=''>Select</option>" + data);
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
                ajax: "{{ url('zoneslgas') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'zonelga', name: 'zonelga'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            // add new lga
            $('#addLGA').click(function () {
                $('#saveBtn').html("Create");
                $('#zoneslga_id').val('');
                $('#lgasForm').trigger("reset");
                $('.modal-title').html("Add New LGA");
                $('#lgasModel').modal('show');
            });

            // add or update lga
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Saving...');

                $.ajax({
                    data: $('#lgasForm').serialize(),
                    url: "{{ url('zoneslgas') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#lgasForm').trigger("reset");
                        $('#lgasModel').modal('hide');
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

            // edit lgas
            $('body').on('click', '.editLGA', function () {
                var zoneslga_id = $(this).data('id');
                 $.get("{{ url('zoneslgas') }}" + '/' + zoneslga_id + '/edit', function (data) {
                     $('.modal-title').html("Edit LGA");
                    $('#saveBtn').html('Update');
                    $('#lgasModel').modal('show');
                    $('#zoneslga_id').val(data.id);
                    $('#zones').val(data.zone_id);
                    $('#name').val(data.name);
                 })
            });

            // remove lga
            $('body').on('click', '.removeLGA', function () {
                var lgas_id = $(this).data("id");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('zoneslgas') }}" + '/' + zoneslgas_id,
                            success: function (data) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'LGA has been removed.',
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
