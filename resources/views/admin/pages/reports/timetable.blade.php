@extends('staff.layouts.master')
@section('content')
    <div class="content-wrapper" style="min-height: 1249.6px;">
        <!-- Page title -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Reports</a></li>
                            <li class="breadcrumb-item active">Time Table</li>
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
                                                    <label>ZEQA</label>
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
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>Class</label>
                                                    <select class="form-control" id="class" name="class">
                                                        <option disabled selected>Select Class</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>Section</label>
                                                    <select class="form-control" id="section" name="section">
                                                        <option disabled selected>Select Section</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-sm-4 ml-2">
                                                <button class="btn btn-primary btn-report" style="margin-top:23px;">
                                                    Generate
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div id="records">

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
@endsection

@section('js')
    <script type="text/javascript">
        $(function () {
            //Load zones
            $.ajax({
                url: '{{route("zones.filter")}}',
            }).done(function (data) {
                $('#zone').html("<option selected disabled>Select ZEQA</option>" + data);
            });

            //Load LGAs on select of zone
            $(document).on("change", "#zone", function (event) {
                $("#lga").html("<option value=''>Loading...</option>");
                $.ajax({
                    url: '{{route("zoneslgas.filter")}}',
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
                    url: '{{route("schools.filter")}}',
                    type: 'GET',
                    data: {
                        lga_id: $("#lga").val()
                    }
                }).done(function (data) {
                    $("#school").html("<option disabled selected>Select School</option>" + data);
                });
            });

            //Load classes on select of school
            $(document).on("change", "#school", function (event) {
                $("#class").html("<option value=''>Loading...</option>");
                $.ajax({
                    url: '{{route("classes.filter")}}',
                    type: 'GET',
                    data: {
                        school_id: $("#school").val()
                    }
                }).done(function (data) {
                    $("#class").html("<option disabled selected>Select Class</option>" + data);
                });
            });

            //Load sections on select of class
            $(document).on("change", "#class", function (event) {
                $("#section").html("<option value=''>Loading...</option>");
                $.ajax({
                    url: '{{route("sections.filter")}}',
                    type: 'GET',
                    data: {
                        school_id: $("#school").val(),
                        class_id: $("#class").val()
                    }
                }).done(function (data) {
                    $("#section").html("<option disabled selected>Select Section</option>" + data);
                });
            });

            $(".btn-report").click(function () {
                $("#records").empty();
                $(".spiner").show();
                $.ajax({
                    url: '{{route('reports.timetable')}}',
                    method: "GET",
                    data: {
                        "section_id": $('#section').val()
                    },
                    dataType: "json",
                    success: function (response) {
                        $(".spiner").hide();
                        $("#records").html(response.html);
                    }
                });
            });

        });
    </script>
@endsection
