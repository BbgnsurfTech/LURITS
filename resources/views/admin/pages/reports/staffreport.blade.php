@extends('layouts.admin')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
        <!-- Page title -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Staff Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Reports</a></li>
                            <li class="breadcrumb-item active">Staffs</li>
                        </ol>
                    </div>
                </div>
                <hr>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="overlay-wrapper">
                                <div class="overlay dark spiner" style="display: none;"><i
                                        class="fas fa-3x fa-sync-alt fa-spin"></i></div>
                                <div class="card-header">
                                    <div class="container-fluid">
                                        <div class="row ml-2 mt-2">
                                            <div class="col-sm-2">
                                                <!-- select -->
                                                <div class="form-group">
                                                    <label>Zones</label>
                                                    <select class="form-control" id="zone" name="zone">
                                                        <option disabled selected>Select ZEQA</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>LGA</label>
                                                    <select class="form-control" id="lga" name="lga">
                                                        <option disabled selected>Select LGA</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>School</label>
                                                    <select class="form-control" id="school" name="school">
                                                        <option disabled selected>Select School</option>

                                                    </select>
                                                </div>
                                            </div>                                            
                                            <div class="col-sm-4 ml-4 mt-2">
                                                <button class="btn btn-primary btn-report" style="margin-top:23px;">
                                                    Generate
                                                </button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="ml-2 mt-2 mr-2 mb-2" id="records">
                                
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
@endsection

@section('scripts')
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
            //Load zones
            $.ajax({
                url: '{{route("admin.zones.filter")}}',
            }).done(function (data) {
                $('#zone').html("<option selected disabled>Select ZEQA</option>" + data);
            });

            //Load LGAs on select of zone
            $(document).on("change", "#zone", function (event) {
                $("#lga").html("<option value=''>Loading...</option>");
                $.ajax({
                    url: '{{route("admin.zoneslgas.filter")}}',
                    type: 'GET',
                    data: {
                        zone_id: $("#zone").val()
                    }
                }).done(function (data) {
                    $("#lga").html("<option disabled selected>Select LGA</option>" + data);
                });
            });

            //Load schools on select of lgas
            $(document).on("change", "#lga", function (event) {
                $("#school").html("<option value=''>Loading...</option>");
                $.ajax({
                    url: '{{route("admin.schools.filter")}}',
                    type: 'GET',
                    data: {
                        lga_id: $("#lga").val()
                    }
                }).done(function (data) {
                    $("#school").html("<option disabled selected>Select School</option>" + data);
                });
            });

 /*           $(".btn-report").click(function () {
                $("#records").empty();
                $(".spiner").show();
                $.ajax({
                    url: '{{route('admin.reports.staff')}}',
                    type: "GET",
                    data: {
                        "school_id": $('#school').val()
                    },
                    success: function (response) {
                        $(".spiner").hide();
                        $("#records").html(response);
                        //alert(response);
                        // datatable
                        $('#staffreporttb').DataTable({
                        processing: true,
                        serverSide: true,
                        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                        pageLength: 50,
                        dom: "<'row'<'col-sm-2'l><'col-sm-6'B><'col-sm-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                                ajax: "{{ url('reports/staff') }}",
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
                    
                    }
                });
            });*/
            //


            $(".btn-report").click(function () {
                $("#records").empty();
                $(".spiner").show();
                $.ajax({
                    type: 'GET',
                    error: function (data) {
                        alert(console.log(data));
                    },
                    url: "{{route('admin.reports.staff')}}",
                    data: {
                        "school_id": $('#school').val()
                    },
                    success: function (response) {
                        $(".spiner").hide();
                        $("#records").html(response);
                        //alert(response);
                        // datatable
                        $('#staffreporttb').DataTable({
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                pageLength: 50,
                "scrollX": true,
                dom: "<'row'<'col-sm-2'l><'col-sm-6'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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
                    }
                });
            });

        });
    </script>
@endsection
