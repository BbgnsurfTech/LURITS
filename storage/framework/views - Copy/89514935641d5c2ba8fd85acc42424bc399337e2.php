<?php $__env->startSection('content'); ?>
<section class="content-header">


</section>
<section class="content">
	<div class="card">
		<div class="card-header"><h1>Reports</h1></div>
		<div class="card-body">
			<!-- ZONE REPORT -->
			<?php if($zoneReport): ?>
				<?php if($report == "school1"): ?>
				<h4><?php echo e($zoneName); ?> Zone : Number of schools</h4>
				<hr>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php if($report == 'enrolment1'): ?>
				<h4><?php echo e($zoneName); ?> Zone : Enrolment by Class</h4>
				<h6>Male: <?php echo e($total->where('gender_id', 1)->count()); ?> Female: <?php echo e($total->where('gender_id', 2)->count()); ?></h6>
				<h5>Total Students: <?php echo e($total->count()); ?></h5>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php if($report == "enrolment2"): ?>
				<h4><?php echo e($zoneName); ?> Zone : Enrolment by Age</h4>
				<hr>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php if($report == 'disabilities'): ?>
				<h4><?php echo e($zoneName); ?> Zone : Students with disabilities</h4>
				<hr>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php if($report == 'staff1' || $report == 'staff2' || $report == 'staff3'): ?>
				<h4><?php echo e($zoneName); ?> Zone : Staffs by <?php if($report == 'staff1'): ?> Type of Staff <?php endif; ?> <?php if($report == 'staff2'): ?> Academic Qualification <?php endif; ?> <?php if($report == 'staff3'): ?> Teaching Qualification <?php endif; ?></h4>
				<hr>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>

			<?php endif; ?>

			<!-- LGA REPORT -->
			<?php if($lgaReport): ?>
				<?php if($report == 'school1'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA : Number of schools</h4>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php if($report == 'enrolment1'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA : Enrolment by Class</h4>
				<h6>Male: <?php echo e($total->where('gender_id', 1)->count()); ?> Female: <?php echo e($total->where('gender_id', 2)->count()); ?></h6>
				<h5>Total Students: <?php echo e($total->count()); ?></h5>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php if($report == 'enrolment2'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA : Enrolment by Age</h4>
				<hr>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php if($report == 'disabilities'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA : Students with disabilities</h4>
				<hr>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php if($report == 'staff1' || $report == 'staff2' || $report == 'staff3'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA : Staffs by <?php if($report == 'staff1'): ?> Type of Staff <?php endif; ?> <?php if($report == 'staff2'): ?> Academic Qualification <?php endif; ?> <?php if($report == 'staff3'): ?> Teaching Qualification <?php endif; ?></h4>
				<hr>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
            <?php endif; ?>

			<!-- SECTOR REPORT -->
			<?php if($sectorReport): ?>
				<?php if($report == 'school1'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA - <?php echo e($sectorName); ?> Sector: Number of schools = <?php echo e($schoolSector); ?></h4>
				<?php endif; ?>
				<?php if($report == 'enrolment1'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA - <?php echo e($sectorName); ?> Sector: Enrolment by Class</h4>
				<h6>Male: <?php echo e($total->where('gender_id', 1)->count()); ?> Female: <?php echo e($total->where('gender_id', 2)->count()); ?></h6>
				<h5>Total Students: <?php echo e($total->count()); ?></h5>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php if($report == 'enrolment2'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA - <?php echo e($sectorName); ?> Sector: Enrolment by Age</h4>
				<hr>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php if($report == 'disabilities'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA - <?php echo e($sectorName); ?> Sector: Students with disabilities</h4>
				<hr>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php if($report == 'staff1' || $report == 'staff2' || $report == 'staff3'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA - <?php echo e($sectorName); ?> Sector: Staffs by <?php if($report == 'staff1'): ?> Type of Staff <?php endif; ?> <?php if($report == 'staff2'): ?> Academic Qualification <?php endif; ?> <?php if($report == 'staff3'): ?> Teaching Qualification <?php endif; ?></h4>
				<hr>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>

                <!--Teacher deployment index -->
                <?php if($report == 'teacher_deployment_index'): ?>
                <input type="button" class="btn btn-primary" onclick="printDiv('printarea')" value="Print Teacher deployment consistency index" />
                <div class="wrapper" id='printarea'>
                <!-- Main content -->
                <section class="invoice p-3 mb-3">
                <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h3 class="page-header"><p class="text-center"><b><?php echo e('Teacher Deployment Consistency Index'); ?></p>
                            </h3>
                        </div>
                        <!-- /.col -->
                    </div>    
                    <div class="row">
                        <div class="col-6">
                            <h5 class="page-header"><p class="text-center">Year: <?php echo e(date('Y')); ?></p>
                            </h5>
                        </div>
                        <!-- /.col -->      
                        <div class="col-6" id="sectorName" value="<?php echo e($sectorName); ?>">
                            <h5 class="page-header"><p class="text-center" >Education Level: <?php echo e($sectorName); ?></p>
                            </h5>
                        </div>
                        <!-- /.col -->
                    </div>
                    <?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
				
			<?php endif; ?>

			<!-- SCHOOL REPORT -->
			<?php if($schoolReport): ?>
				<?php if($report == 'enrolment1'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA - <?php echo e($sectorName); ?> Sector - <?php echo e($schoolName->name); ?>: Enrolment by Class</h4>
				<h6>Male: <?php echo e($total->where('gender_id', 1)->count()); ?> Female: <?php echo e($total->where('gender_id', 2)->count()); ?></h6>
				<h5>Total Students: <?php echo e($total->count()); ?></h5>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php if($report == 'enrolment2'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA - <?php echo e($sectorName); ?> Sector - <?php echo e($schoolName->name); ?>: Enrolment by Class</h4>
				<hr>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>
				<?php if($report == 'disabilities'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA - <?php echo e($sectorName); ?> Sector - <?php echo e($schoolName->name); ?>: Students with disabilities</h4>
				<hr>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>

				<?php if($report == 'staff1' || $report == 'staff2' || $report == 'staff3'): ?>
				<h4><?php echo e($zoneName); ?> Zone - <?php echo e($lgaName); ?> LGA - <?php echo e($sectorName); ?> Sector - <?php echo e($schoolName->name); ?>: Staffs by <?php if($report == 'staff1'): ?> Type of Staff <?php endif; ?> <?php if($report == 'staff2'): ?> Academic Qualification <?php endif; ?> <?php if($report == 'staff3'): ?> Teaching Qualification <?php endif; ?></h4>
				<hr>
				<?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endif; ?>

                <!--report card -->
                <?php if($report == 'report_card'): ?>
                <input type="button" class="btn btn-primary" onclick="printDiv('printarea')" value="Print School Report card" />
                <div class="wrapper" id='printarea'>
                <!-- Main content -->
                <section class="invoice p-3 mb-3">
                <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h3 class="page-header"><p class="text-center"><?php echo e($schoolName->name.' - '.$lgaName.' LGA'); ?></p>
                            </h3>
                        </div>
                        <!-- /.col -->
                    </div>    
                    <div class="row">
                        <div class="col-6">
                            <h5 class="page-header"><p class="text-center">Year: <?php echo e(date('Y')); ?></p>
                            </h5>
                        </div>
                        <!-- /.col -->      
                        <div class="col-6">
                            <h5 class="page-header"><p class="text-center">Education Level: <?php echo e($sectorName); ?></p>
                            </h5>
                        </div>
                        <!-- /.col -->
                    </div>
                    <?php echo $__env->make('admin.reports.templates.zone-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			     <?php endif; ?>  
		<?php endif; ?>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php if($schoolReport): ?>
<?php if($report == 'report_card'): ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-data-adapter.min.js"></script>
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
        // google.charts.setOnLoadCallback(drawBarChart3);
        // google.charts.setOnLoadCallback(drawBarChart4);
        google.charts.setOnLoadCallback(drawChartScatter);
        function drawChartScatter() {
        var data = google.visualization.arrayToDataTable([
          ['Age', 'Weight'],
          [ 8,      12],
          [ 4,      5.5],
          [ 11,     14],
          [ 4,      5],
          [ 3,      3.5],
          [ 6.5,    7]
        ]);

        var options = {
          title: 'Age vs. Weight comparison',
          hAxis: {title: 'Age', minValue: 0, maxValue: 15},
          vAxis: {title: 'Weight', minValue: 0, maxValue: 15},
          legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }

        function drawChart() {
        
            var data = google.visualization.arrayToDataTable([
            <?php
            echo "['Parameter', 'Value'],";
             echo "['Male', ".$students->where('gender_id', 1)->count()."],";
             echo "['Female', ".$students->where('gender_id', 2)->count()."]";
            ?>
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
        <?php
		    foreach($classes as $class){
		      echo "['".$class->title."', ".$students->where('classs.classTitle.id', $class->id)->where('gender_id', 1)->count().", ".$students->where('classs.classTitle.id', $class->id)->where('gender_id', 2)->count()."],";
        }
    	?>
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
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php endif; ?>
<?php if($sectorReport): ?>
<?php if($report == 'teacher_deployment_index'): ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('anychart/js/anychart-base.min.js')); ?>"></script>
    <script src="<?php echo e(asset('anychart/js/anychart-data-adapter.min.js')); ?>"></script>
      
    </script>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php endif; ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/reports/report-page.blade.php ENDPATH**/ ?>