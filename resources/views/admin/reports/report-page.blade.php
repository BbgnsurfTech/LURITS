@extends('layouts.admin')
@section('content')
<section class="content-header">


</section>
<section class="content">
	<div class="card">
		<div class="card-header"><h1>Reports</h1></div>
		<div class="card-body">
			<!-- ZONE REPORT -->
			@if($zoneReport)
				@if($report == "school1")
				<h4>{{ $zoneName }} Zone : Number of schools</h4>
				<hr>
				@include('admin.reports.templates.zone-report')
				@endif
				@if($report == 'enrolment1')
				<h4>{{ $zoneName }} Zone : Enrolment by Class</h4>
				<h6>Male: {{ $total->where('gender_id', 1)->count() }} Female: {{ $total->where('gender_id', 2)->count() }}</h6>
				<h5>Total Students: {{ $total->count() }}</h5>
				@include('admin.reports.templates.zone-report')
				@endif
				@if($report == "enrolment2")
				<h4>{{ $zoneName }} Zone : Enrolment by Age</h4>
				<hr>
				@include('admin.reports.templates.zone-report')
				@endif
				@if($report == 'disabilities')
				<h4>{{ $zoneName }} Zone : Students with disabilities</h4>
				<hr>
				@include('admin.reports.templates.zone-report')
				@endif
				@if($report == 'staff1' || $report == 'staff2' || $report == 'staff3')
				<h4>{{ $zoneName }} Zone : Staffs by @if($report == 'staff1') Type of Staff @endif @if($report == 'staff2') Academic Qualification @endif @if($report == 'staff3') Teaching Qualification @endif</h4>
				<hr>
				@include('admin.reports.templates.zone-report')
				@endif

			@endif

			<!-- LGA REPORT -->
			@if($lgaReport)
				@if($report == 'school1')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA : Number of schools</h4>
				@include('admin.reports.templates.zone-report')
				@endif
				@if($report == 'enrolment1')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA : Enrolment by Class</h4>
				<h6>Male: {{ $total->where('gender_id', 1)->count() }} Female: {{ $total->where('gender_id', 2)->count() }}</h6>
				<h5>Total Students: {{ $total->count() }}</h5>
				@include('admin.reports.templates.zone-report')
				@endif
				@if($report == 'enrolment2')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA : Enrolment by Age</h4>
				<hr>
				@include('admin.reports.templates.zone-report')
				@endif
				@if($report == 'disabilities')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA : Students with disabilities</h4>
				<hr>
				@include('admin.reports.templates.zone-report')
				@endif
				@if($report == 'staff1' || $report == 'staff2' || $report == 'staff3')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA : Staffs by @if($report == 'staff1') Type of Staff @endif @if($report == 'staff2') Academic Qualification @endif @if($report == 'staff3') Teaching Qualification @endif</h4>
				<hr>
				@include('admin.reports.templates.zone-report')
				@endif

			@endif

			<!-- SECTOR REPORT -->
			@if($sectorReport)
				@if($report == 'school1')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA - {{ $sectorName }} Sector: Number of schools = {{ $schoolSector }}</h4>
				@endif
				@if($report == 'enrolment1')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA - {{ $sectorName }} Sector: Enrolment by Class</h4>
				<h6>Male: {{ $total->where('gender_id', 1)->count() }} Female: {{ $total->where('gender_id', 2)->count() }}</h6>
				<h5>Total Students: {{ $total->count() }}</h5>
				@include('admin.reports.templates.zone-report')
				@endif
				@if($report == 'enrolment2')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA - {{ $sectorName }} Sector: Enrolment by Age</h4>
				<hr>
				@include('admin.reports.templates.zone-report')
				@endif
				@if($report == 'disabilities')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA - {{ $sectorName }} Sector: Students with disabilities</h4>
				<hr>
				@include('admin.reports.templates.zone-report')
				@endif
				@if($report == 'staff1' || $report == 'staff2' || $report == 'staff3')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA - {{ $sectorName }} Sector: Staffs by @if($report == 'staff1') Type of Staff @endif @if($report == 'staff2') Academic Qualification @endif @if($report == 'staff3') Teaching Qualification @endif</h4>
				<hr>
				@include('admin.reports.templates.zone-report')
				@endif
				 <!--Teacher deployment index -->
                @if($report == 'teacher_deployment_index')
                <input type="button" class="btn btn-primary" onclick="printDiv('printarea')" value="Print Teacher deployment consistency index" />
                <div class="wrapper" id='printarea'>
                <!-- Main content -->
                <section class="invoice p-3 mb-3">
                <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h3 class="page-header"><p class="text-center"><b>{{'Teacher Deployment Consistency Index'}}</b></p>
                            </h3>
                        </div>
                        <!-- /.col -->
                    </div>    
                    <div class="row">
                        <div class="col-6">
                            <h5 class="page-header"><p class="text-center">Year: {{ date('Y') }}</p>
                            </h5>
                        </div>
                        <!-- /.col -->      
                        <div class="col-6">
                            <h5 class="page-header"><p class="text-center">Education Level: {{$sectorName}}</p>
                            </h5>
                        </div>
                        <!-- /.col -->
                    </div>
                    @include('admin.reports.templates.zone-report')
                @endif
			@endif

			<!-- SCHOOL REPORT -->
			@if($schoolReport)
				@if($report == 'enrolment1')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA - {{ $sectorName }} Sector - {{ $schoolName->name }}: Enrolment by Class</h4>
				<h6>Male: {{ $total->where('gender_id', 1)->count() }} Female: {{ $total->where('gender_id', 2)->count() }}</h6>
				<h5>Total Students: {{ $total->count() }}</h5>
				@include('admin.reports.templates.zone-report')
				@endif
				@if($report == 'enrolment2')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA - {{ $sectorName }} Sector - {{ $schoolName->name }}: Enrolment by Class</h4>
				<hr>
				@include('admin.reports.templates.zone-report')
				@endif
				@if($report == 'disabilities')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA - {{ $sectorName }} Sector - {{ $schoolName->name }}: Students with disabilities</h4>
				<hr>
				@include('admin.reports.templates.zone-report')
				@endif

				@if($report == 'staff1' || $report == 'staff2' || $report == 'staff3')
				<h4>{{ $zoneName }} Zone - {{ $lgaName }} LGA - {{ $sectorName }} Sector - {{ $schoolName->name }}: Staffs by @if($report == 'staff1') Type of Staff @endif @if($report == 'staff2') Academic Qualification @endif @if($report == 'staff3') Teaching Qualification @endif</h4>
				<hr>
				@include('admin.reports.templates.zone-report')
				@endif

                <!--report card -->
                @if($report == 'report_card')
                <input type="button" class="btn btn-primary" onclick="printDiv('printarea')" value="Print School Report card" />
                <div class="wrapper" id='printarea'>
                <!-- Main content -->
                <section class="invoice p-3 mb-3">
                <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h3 class="page-header"><p class="text-center">{{$schoolName->name.' - '.$lgaName.' LGA'}}</p>
                            </h3>
                        </div>
                        <!-- /.col -->
                    </div>    
                    <div class="row">
                        <div class="col-6">
                            <h5 class="page-header"><p class="text-center">Year: {{ date('Y') }}</p>
                            </h5>
                        </div>
                        <!-- /.col -->      
                        <div class="col-6">
                            <h5 class="page-header"><p class="text-center">Education Level: {{$sectorName}}</p>
                            </h5>
                        </div>
                        <!-- /.col -->
                    </div>
                    @include('admin.reports.templates.zone-report')
			@endif
		@endif
		</div>
	</div>
</section>
@endsection
@if($schoolReport)
@if($report == 'report_card')
@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
        google.charts.load('current', {'packages':['corechart']});
        google.charts.load('current', {'packages':['bar']});

        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawBarChart1);
        google.charts.setOnLoadCallback(drawBarChart2);
        //google.charts.setOnLoadCallback(drawBarChart3);
        //google.charts.setOnLoadCallback(drawBarChart4);

        function drawChart() {
        
            var data = google.visualization.arrayToDataTable([
            @php
            echo "['Parameter', 'Value'],";
             echo "['Male', ".$students->where('gender_id', 1)->count()."],";
             echo "['Female', ".$students->where('gender_id', 2)->count()."]";
            @endphp
        ]);

        var options = {
            title: 'Students by Gender (School)',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
        }
      
        function drawBarChart1() {
        var data = google.visualization.arrayToDataTable([
          ['Gender', 'Male', 'Female', 'Total'],
          ['School', 100, 50, 150],
          ['LGA', 200, 100, 300],
          ['State', 400, 200, 600]
        ]);

        var options = {
          chart: {
            title: 'Gender Chart',
            subtitle: 'Male, Female, and Total for School, LGA, and State',
          },
          bars: 'horizontal'
        };

        var chart = new google.charts.Bar(document.getElementById('barchart1'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }      
        
        function drawBarChart2() {
        var data = google.visualization.arrayToDataTable([
            ['Class', 'Male', 'Female'],
        @php
		    foreach($classes as $class){
		      echo "['".$class->title."', ".$students->where('classs.classTitle.id', $class->id)->where('gender_id', 1)->count().", ".$students->where('classs.classTitle.id', $class->id)->where('gender_id', 2)->count()."],";
        }
    	@endphp
          ]);

        var options = {
        title: 'Enrolment of Students by Classes (School)',
        chartArea: {width: '50%'},
        isStacked: true,
        hAxis: {
          title: 'Total Enrolment',
          minValue: 0,
        },
        vAxis: {
          title: 'Class'
        }
      };
      var chart = new google.visualization.BarChart(document.getElementById('barchart2'));
      chart.draw(data, options);
      }
      
    </script>
@endsection
@endif
@endif