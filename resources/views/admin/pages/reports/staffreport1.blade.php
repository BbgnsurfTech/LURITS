@extends('staff.layouts.master')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection


@section('content')
    <div class="content-wrapper" style="min-height: 1249.6px;">
    <!-- Page title -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Staff Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Report</a></li>
                        <li class="breadcrumb-item active">Staff</li>
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
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-2 my-2">
                                    <label class="control-label">Ministry :</label>
                                    <select id="ministry" name="ministry" class="form-control">
                                        <option value="">Select ...</option>
                                    </select>
                                    <span class="help-block">{{ $errors->first('ministry', ':message') }}</span>                    
                                </div>
                                <div class="col-md-2 my-2">
                                    <label class="control-label">Department :</label>
                                    <select id="department" name="department" class="form-control">
                                        <option value="">Select ...</option>
                                    </select>
                                    <span class="help-block">{{ $errors->first('department', ':message') }}</span>                    
                                </div>
                            </div>
                                <div class="row">
                                    <h3 class="card-title">List of Staff</h3>
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
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone No.</th>
                                                <th>State</th>
                                                <th>LGA of Origin</th>
                                                <th>ZEQA</th>
                                                <th>LGA</th>
                                                <th>School</th>
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

    </div>
    </div>
@endsection

@section('js')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    
    <script type="text/javascript">
    $(function () { 

        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'DD/MM/YYYY'
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
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                pageLength: 50,
                dom: "<'row'<'col-sm-2'l><'col-sm-6'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        ajax: "{{ url('report/staff') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                            {data: 'photo', name: 'photo'},
                            {data: 'name', name: 'name'},
                            {data: 'email', name: 'email'},
                            {data: 'gsm', name: 'gsm'},                            
                            {data: 'state', name: 'state'},
                            {data: 'lga', name: 'lga'},
                            {data: 'zeqa', name: 'zeqa'},
                            {data: 'slga', name: 'slga'},
                            {data: 'school', name: 'school'},
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

});

</script>
@endsection
