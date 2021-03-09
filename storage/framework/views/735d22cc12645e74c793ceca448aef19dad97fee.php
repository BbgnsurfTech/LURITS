<?php if($report == "school1"): ?>
<table class="table table-bordered">
	<thead>
		<tr>
			<?php if($zoneReport): ?>
			<th>LGA</th>
			<?php else: ?>
			<th>#</th>
			<?php endif; ?>

		<?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<th  style="text-align:center"><?php echo e($sector->title); ?></th>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<th>Total</th>
	</thead>
	<tbody>
		
		<?php if($zoneReport): ?>
		<?php $__currentLoopData = $lgaName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($lga); ?></td>
		<?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<td><?php echo e($schoolSector->where('atlas.atlas.name_atlas_entity', $lga)->where('code_type_sector', $sector->id)->count()); ?></td>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<td><?php echo e($schoolSector->where('atlas.atlas.name_atlas_entity', $lga)->count()); ?></td>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php else: ?>
		<tr>
			<td></td>
		<?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<td><?php echo e($schoolSector->where('code_type_sector', $sector->id)->count()); ?></td>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<td><?php echo e($schoolSector->count()); ?></td>
		</tr>
		<?php endif; ?>

		<?php if($zoneReport): ?>
		<tr>
			<th>Total</th>
		<?php $__currentLoopData = $sectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<td><?php echo e(number_format($schoolSector->where('code_type_sector', $sector->id)->count())); ?></td>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<td><?php echo e(number_format($schoolSector->count())); ?></td>
		</tr>
		<?php endif; ?>
	</tbody>
</table>
<?php endif; ?>

<?php if($report == "enrolment1"): ?>
<table class="table table-bordered">
	<thead>
		<tr>
			<?php if($zoneReport): ?>
			<th rowspan="2">LGA</th>
			<?php else: ?>
			<th rowspan="2">#</th>
			<?php endif; ?>

		<?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<th colspan="3" style="text-align:center"><?php echo e($class->title); ?></th>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<tr>
		<?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<th>Male</th>
			<th>Female</th>
			<th>Total</th>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
	</thead>
	<tbody>
		
		<?php if($zoneReport): ?>
		<?php $__currentLoopData = $lgaName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($lga); ?></td>
		<?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<td><?php echo e(number_format($total->where('name_atlas_entity', $lga)->where('classs.classTitle.id', $class->id)->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($total->where('name_atlas_entity', $lga)->where('classs.classTitle.id', $class->id)->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($total->where('name_atlas_entity', $lga)->where('classs.classTitle.id', $class->id)->count())); ?></td>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php else: ?>
		<tr>
			<td></td>
		<?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<td><?php echo e(number_format($total->where('classs.classTitle.id', $class->id)->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($total->where('classs.classTitle.id', $class->id)->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($total->where('classs.classTitle.id', $class->id)->count())); ?></td>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<?php endif; ?>

		<!-- <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($class->title); ?></td>
			<td><?php echo e($total->where('classs.classTitle.id', $class->id)->where('gender_id', 1)->count()); ?></td>
			<td><?php echo e($total->where('classs.classTitle.id', $class->id)->where('gender_id', 2)->count()); ?></td>
			<td><?php echo e($total->where('classs.classTitle.id', $class->id)->count()); ?></td>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
		<tr>
			<th>Total</th>
		<?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<th><?php echo e(number_format($total->where('classs.classTitle.id', $class->id)->where('gender_id', 1)->count())); ?></th>
			<th><?php echo e(number_format($total->where('classs.classTitle.id', $class->id)->where('gender_id', 2)->count())); ?></th>
			<th><?php echo e(number_format($total->where('classs.classTitle.id', $class->id)->count())); ?></th>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<!-- <tr><th><?php echo e($total); ?></th></tr> -->
	</tbody>
</table>
<?php endif; ?>
<?php if($report == "enrolment2"): ?>
<table class="table table-bordered">
	<thead>
		<tr>
			<?php if($zoneReport): ?>
			<th rowspan="2">#</th>
			<?php else: ?>
			<th rowspan="2">#</th>
			<?php endif; ?>

		<?php $__currentLoopData = $ages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<th colspan="3"><?php echo e($name); ?></th>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<tr>
			<?php $__currentLoopData = $ages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $age): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<th>Male</th>
			<th>Female</th>
			<th>Total</th>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
		
		</tr>
	</thead>
	<tbody>
		
		<?php if($zoneReport): ?>
		<?php $__currentLoopData = $lgaName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($lga); ?></td>
		<td><?php echo e(number_format($bSixYears->where('name_atlas_entity', $lga)->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($bSixYears->where('name_atlas_entity', $lga)->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($bSixYears->where('name_atlas_entity', $lga)->count())); ?></td>
		<td><?php echo e(number_format($sixYears->where('name_atlas_entity', $lga)->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($sixYears->where('name_atlas_entity', $lga)->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($sixYears->where('name_atlas_entity', $lga)->count())); ?></td>
		<td><?php echo e(number_format($sevenYears->where('name_atlas_entity', $lga)->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($sevenYears->where('name_atlas_entity', $lga)->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($sevenYears->where('name_atlas_entity', $lga)->count())); ?></td>
		<td><?php echo e(number_format($eightYears->where('name_atlas_entity', $lga)->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($eightYears->where('name_atlas_entity', $lga)->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($eightYears->where('name_atlas_entity', $lga)->count())); ?></td>
		<td><?php echo e(number_format($nineYears->where('name_atlas_entity', $lga)->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($nineYears->where('name_atlas_entity', $lga)->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($nineYears->where('name_atlas_entity', $lga)->count())); ?></td>
		<td><?php echo e(number_format($tenYears->where('name_atlas_entity', $lga)->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($tenYears->where('name_atlas_entity', $lga)->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($tenYears->where('name_atlas_entity', $lga)->count())); ?></td>
		<td><?php echo e(number_format($elevenYears->where('name_atlas_entity', $lga)->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($elevenYears->where('name_atlas_entity', $lga)->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($elevenYears->where('name_atlas_entity', $lga)->count())); ?></td>
		<td><?php echo e(number_format($aElevenYears->where('name_atlas_entity', $lga)->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($aElevenYears->where('name_atlas_entity', $lga)->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($aElevenYears->where('name_atlas_entity', $lga)->count())); ?></td>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
		<?php else: ?>
		
		<tr>
			<th></th>
		<td><?php echo e(number_format($bSixYears->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($bSixYears->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($bSixYears->count())); ?></td>
		<td><?php echo e(number_format($sixYears->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($sixYears->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($sixYears->count())); ?></td>
		<td><?php echo e(number_format($sevenYears->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($sevenYears->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($sevenYears->count())); ?></td>
		<td><?php echo e(number_format($eightYears->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($eightYears->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($eightYears->count())); ?></td>
		<td><?php echo e(number_format($nineYears->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($nineYears->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($nineYears->count())); ?></td>
		<td><?php echo e(number_format($tenYears->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($tenYears->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($tenYears->count())); ?></td>
		<td><?php echo e(number_format($elevenYears->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($elevenYears->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($elevenYears->count())); ?></td>
		<td><?php echo e(number_format($aElevenYears->where('gender_id', 1)->count())); ?></td>
		<td><?php echo e(number_format($aElevenYears->where('gender_id', 2)->count())); ?></td>
		<td><?php echo e(number_format($aElevenYears->count())); ?></td>
		</tr>

		<?php endif; ?>
		<?php if($zoneReport): ?>
		<tr>
			<th>Total</th>
			<td><?php echo e(number_format($bSixYears->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($bSixYears->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($bSixYears->count())); ?></td>
			<td><?php echo e(number_format($sixYears->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($sixYears->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($sixYears->count())); ?></td>
			<td><?php echo e(number_format($sevenYears->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($sevenYears->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($sevenYears->count())); ?></td>
			<td><?php echo e(number_format($eightYears->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($eightYears->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($eightYears->count())); ?></td>
			<td><?php echo e(number_format($nineYears->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($nineYears->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($nineYears->count())); ?></td>
			<td><?php echo e(number_format($tenYears->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($tenYears->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($tenYears->count())); ?></td>
			<td><?php echo e(number_format($elevenYears->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($elevenYears->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($elevenYears->count())); ?></td>
			<td><?php echo e(number_format($aElevenYears->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($aElevenYears->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($aElevenYears->count())); ?></td>
		</tr>
		<?php endif; ?>
	</tbody>
</table>
<!-- <table class="table table-bordered">
	<tbody>
		<tr>
			<th>Below 6 Years</th>
			<td>Male</td>
			<td><?php echo e($bSixYears->where('gender_id', 1)->count()); ?></td>
			<td>Female</td>
			<td><?php echo e($bSixYears->where('gender_id', 2)->count()); ?></td>
			<th>Total</th>
			<td><?php echo e($bSixYears->count()); ?></td>
		</tr>
		<tr>
			<th>6 Years</th>
			<td>Male</td>
			<td><?php echo e($sixYears->where('gender_id', 1)->count()); ?></td>
			<td>Female</td>
			<td><?php echo e($sixYears->where('gender_id', 2)->count()); ?></td>
			<th>Total</th>
			<td><?php echo e($sixYears->count()); ?></td>
		</tr>
		<tr>
			<th>7 Years</th>
			<td>Male</td>
			<td><?php echo e($sevenYears->where('gender_id', 1)->count()); ?></td>
			<td>Female</td>
			<td><?php echo e($sevenYears->where('gender_id', 2)->count()); ?></td>
			<th>Total</th>
			<td><?php echo e($sevenYears->count()); ?></td>
		</tr>
		<tr>
			<th>8 Years</th>
			<td>Male</td>
			<td><?php echo e($eightYears->where('gender_id', 1)->count()); ?></td>
			<td>Female</td>
			<td><?php echo e($eightYears->where('gender_id', 2)->count()); ?></td>
			<th>Total</th>
			<td><?php echo e($eightYears->count()); ?></td>
		</tr>
		<tr>
			<th>9 Years</th>
			<td>Male</td>
			<td><?php echo e($nineYears->where('gender_id', 1)->count()); ?></td>
			<td>Female</td>
			<td><?php echo e($nineYears->where('gender_id', 2)->count()); ?></td>
			<th>Total</th>
			<td><?php echo e($nineYears->count()); ?></td>
		</tr>
		<tr>
			<th>10 Years</th>
			<td>Male</td>
			<td><?php echo e($tenYears->where('gender_id', 1)->count()); ?></td>
			<td>Female</td>
			<td><?php echo e($tenYears->where('gender_id', 2)->count()); ?></td>
			<th>Total</th>
			<td><?php echo e($tenYears->count()); ?></td>
		</tr>
		<tr>
			<th>11 Years</th>
			<td>Male</td>
			<td><?php echo e($elevenYears->where('gender_id', 1)->count()); ?></td>
			<td>Female</td>
			<td><?php echo e($elevenYears->where('gender_id', 2)->count()); ?></td>
			<th>Total</th>
			<td><?php echo e($elevenYears->count()); ?></td>
		</tr>
		<tr>
			<th>Above 11 Years</th>
			<td>Male</td>
			<td><?php echo e($aElevenYears->where('gender_id', 1)->count()); ?></td>
			<td>Female</td>
			<td><?php echo e($aElevenYears->where('gender_id', 2)->count()); ?></td>
			<th>Total</th>
			<td><?php echo e($aElevenYears->count()); ?></td>
		</tr>
	</tbody>
</table> -->
<?php endif; ?>
<?php if($report == "disabilities"): ?>
<table class="table table-bordered">
	<thead>
		<tr>
			<?php if($zoneReport): ?>
			<th rowspan="2">LGA</th>
			<?php else: ?>
			<th rowspan="2">#</th>
			<?php endif; ?>

		<?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<th colspan="3" style="text-align:center"><?php echo e($class->title); ?></th>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<tr>
		<?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<th>Male</th>
			<th>Female</th>
			<th>Total</th>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
	</thead>
	<tbody>
		
		<?php if($zoneReport): ?>
		<?php $__currentLoopData = $lgaName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($lga); ?></td>
		<?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<td><?php echo e(number_format($total->where('name_atlas_entity', $lga)->where('classs.classTitle.id', $class->id)->where('disability', 1)->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($total->where('name_atlas_entity', $lga)->where('classs.classTitle.id', $class->id)->where('disability', 1)->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($total->where('name_atlas_entity', $lga)->where('classs.classTitle.id', $class->id)->where('disability', 1)->count())); ?></td>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php else: ?>
		<tr>
			<td></td>
		<?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<td><?php echo e(number_format($total->where('classs.classTitle.id', $class->id)->where('disability', 1)->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($total->where('classs.classTitle.id', $class->id)->where('disability', 1)->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($total->where('classs.classTitle.id', $class->id)->where('disability', 1)->count())); ?></td>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<?php endif; ?>

		<!-- <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($class->title); ?></td>
			<td><?php echo e($total->where('classs.classTitle.id', $class->id)->where('gender_id', 1)->count()); ?></td>
			<td><?php echo e($total->where('classs.classTitle.id', $class->id)->where('gender_id', 2)->count()); ?></td>
			<td><?php echo e($total->where('classs.classTitle.id', $class->id)->count()); ?></td>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
		<tr>
			<th>Total</th>
		<?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<th><?php echo e(number_format($total->where('classs.classTitle.id', $class->id)->where('disability', 1)->where('gender_id', 1)->count())); ?></th>
			<th><?php echo e(number_format($total->where('classs.classTitle.id', $class->id)->where('disability', 1)->where('gender_id', 2)->count())); ?></th>
			<th><?php echo e(number_format($total->where('classs.classTitle.id', $class->id)->where('disability', 1)->count())); ?></th>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<!-- <tr><th><?php echo e($total); ?></th></tr> -->
	</tbody>
</table>
<?php endif; ?>
<?php if($report == "staff1" || $report == "staff2" || $report == "staff3"): ?>
<table class="table table-bordered">
	<thead>
		<tr>
			<?php if($zoneReport): ?>
			<th rowspan="2">LGA</th>
			<?php else: ?>
			<th rowspan="2">#</th>
			<?php endif; ?>

		<?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<th colspan="3" style="text-align:center"><?php echo e($type->title); ?></th>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<tr>
		<?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<th>Male</th>
			<th>Female</th>
			<th>Total</th>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
	</thead>
	<tbody>
		
		<?php if($zoneReport): ?>
		<?php $__currentLoopData = $lgaName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($lga); ?></td>
		<?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($report == 'staff1'): ?>
			<td><?php echo e(number_format($total->where('school.lga.atlas.name_atlas_entity', $lga)->where('type_staff_id', $type->id)->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($total->where('school.lga.atlas.name_atlas_entity', $lga)->where('type_staff_id', $type->id)->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($total->where('school.lga.atlas.name_atlas_entity', $lga)->where('type_staff_id', $type->id)->count())); ?></td>
		<?php endif; ?>
		<?php if($report == 'staff2'): ?>
			<td><?php echo e(number_format($total->where('school.lga.atlas.name_atlas_entity', $lga)->where('academic_qualification_id', $type->id)->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($total->where('school.lga.atlas.name_atlas_entity', $lga)->where('academic_qualification_id', $type->id)->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($total->where('school.lga.atlas.name_atlas_entity', $lga)->where('academic_qualification_id', $type->id)->count())); ?></td>
		<?php endif; ?>
		<?php if($report == 'staff3'): ?>
			<td><?php echo e(number_format($total->where('school.lga.atlas.name_atlas_entity', $lga)->where('teaching_qualification_id', $type->id)->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($total->where('school.lga.atlas.name_atlas_entity', $lga)->where('teaching_qualification_id', $type->id)->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($total->where('school.lga.atlas.name_atlas_entity', $lga)->where('teaching_qualification_id', $type->id)->count())); ?></td>
		<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php else: ?>
		<tr>
			<td></td>
		<?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($report == 'staff1'): ?>
			<td><?php echo e(number_format($total->where('type_staff_id', $type->id)->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($total->where('type_staff_id', $type->id)->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($total->where('type_staff_id', $type->id)->count())); ?></td>
		<?php endif; ?>
		<?php if($report == 'staff2'): ?>
			<td><?php echo e(number_format($total->where('academic_qualification_id', $type->id)->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($total->where('academic_qualification_id', $type->id)->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($total->where('academic_qualification_id', $type->id)->count())); ?></td>
		<?php endif; ?>
		<?php if($report == 'staff3'): ?>
			<td><?php echo e(number_format($total->where('teaching_qualification_id', $type->id)->where('gender_id', 1)->count())); ?></td>
			<td><?php echo e(number_format($total->where('teaching_qualification_id', $type->id)->where('gender_id', 2)->count())); ?></td>
			<td><?php echo e(number_format($total->where('teaching_qualification_id', $type->id)->count())); ?></td>
		<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<?php endif; ?>
		<?php if($zoneReport): ?>
		<tr>
			<th>Total</th>
		<?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($report == 'staff1'): ?>
			<th><?php echo e(number_format($total->where('type_staff_id', $type->id)->where('gender_id', 1)->count())); ?></th>
			<th><?php echo e(number_format($total->where('type_staff_id', $type->id)->where('gender_id', 2)->count())); ?></th>
			<th><?php echo e(number_format($total->where('type_staff_id', $type->id)->count())); ?></th>
		<?php endif; ?>
		<?php if($report == 'staff2'): ?>
			<th><?php echo e(number_format($total->where('academic_qualification_id', $type->id)->where('gender_id', 1)->count())); ?></th>
			<th><?php echo e(number_format($total->where('academic_qualification_id', $type->id)->where('gender_id', 2)->count())); ?></th>
			<th><?php echo e(number_format($total->where('academic_qualification_id', $type->id)->count())); ?></th>
		<?php endif; ?>
		<?php if($report == 'staff3'): ?>
			<th><?php echo e(number_format($total->where('teaching_qualification_id', $type->id)->where('gender_id', 1)->count())); ?></th>
			<th><?php echo e(number_format($total->where('teaching_qualification_id', $type->id)->where('gender_id', 2)->count())); ?></th>
			<th><?php echo e(number_format($total->where('teaching_qualification_id', $type->id)->count())); ?></th>
		<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
		</tr>
		<!-- <tr><th><?php echo e($total); ?></th></tr> -->
	</tbody>
</table>
<?php endif; ?>
<!-- REPORT CARD-->
<?php if($schoolReport): ?>
<?php if($report == 'report_card'): ?>			
<!-- Table row -->
<div class="row">
    <div class="col-6 table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th style="width:40%">LGEA:</th>
                    <td><?php echo e($lgaName); ?></td>
                </tr>
                <tr>
                    <th style="width:40%">School Name:</th>
                    <td><?php echo e($schoolName->name); ?></td>
                </tr>
                <tr>
                    <th style="width:40%">Pseudo Code:</th>
                    <td><?php echo e($schoolName->pseudo_code); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.col -->      
    <div class="col-6 table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th style="width:40%">Nemis Code:</th>
                    <td><?php echo e($schoolName->nemis_code); ?></td>
                </tr>
                <tr>
                    <th style="width:40%">DB Code:</th>
                    <td><?php echo e($schoolName->id); ?></td>
                </tr>
                <tr>
                    <th style="width:40%">School Status:</th>
                    <td><?php echo e($schoolName->code_type_sector !=4 ? "Public" : "Private"); ?></td>
                </tr>
                <tr>
                    <th style="width:40%">School Type:</th>
                    <td><?php echo e($schoolName->background->schoolType->title); ?></td>
                </tr>
            </tbody>
        </table>
     </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="tab-custom-content">
    <p>&nbsp;</p>
</div>
<!-- Table row -->
<div class="row">
    <div class="col-12 table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Context</th>
                <th>School</th>
                <th>LGA</th>
                <th>State</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="width:40%">Number of Schools:</th>
                <td><?php echo e(number_format($schoolName->where('id', $schoolName->id)->count())); ?></td>
                <td><?php echo e(number_format($schoolLGAS->count())); ?></td>
                <td><?php echo e(number_format($schoolState->count())); ?></td>
            </tr>
            <tr>
                <th style="width:40%">School Location:</th>
                <td><?php echo e($schoolName->background->schoolLocation->title); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolLGAS)->where('location',2)->count()/$schoolLGAS->count())*100,0)."% Rural"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolState)->where('location',2)->count()/$schoolState->count())*100,0)."% Rural"); ?></td>
            </tr>
            <tr>
                <th style="width:40%">Availability of Water Source:</th>
                <td><?php echo e($schoolName->background->source_of_water ==1 || $schoolName->background->source_of_water ==2 || $schoolName->background->source_of_water ==3 ? "Yes": "No"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolLGAS)->whereIn('source_of_water',[4,5])->count()/$schoolLGAS->count())*100,0)."% W/O Water"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolState)->whereIn('source_of_water',[4,5])->count()/$schoolState->count())*100,0)."% W/O Water"); ?></td>
            </tr>         
            <tr>
                <th style="width:40%">Availability of Electricity:</th>
                <td><?php echo e($schoolName->background->source_of_electricity ==1 || $schoolName->background->source_of_electricity ==2 || $schoolName->background->source_of_electricity ==3 || $schoolName->background->source_of_electricity ==5 ? "Yes": "No"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolLGAS)->where('source_of_electricity',4)->count()/$schoolLGAS->count())*100,0)."% W/O Electrivity"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolState)->where('source_of_electricity',4)->count()/$schoolState->count())*100,0)."% W/O Electrivity"); ?></td>
            </tr>          
            <tr>
                <th style="width:40%">Fence/Wall:</th>
                <td><?php echo e($schoolName->background->fence_wall ==1 || $schoolName->background->fence_wall ==2 || $schoolName->background->fence_wall ==3 ? "Yes": "No"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolLGAS)->where('fence_wall',4)->count()/$schoolLGAS->count())*100,0)."% W/O Fence/Wall"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolState)->where('fence_wall',4)->count()/$schoolState->count())*100,0)."% W/O Fence/Wall"); ?></td>
            </tr>
            <tr>
                <th style="width:40%">Health Facility:</th>
                <td><?php echo e($schoolName->background->health_facility ==1 || $schoolName->background->health_facility ==2 ? "Yes": "No"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolLGAS)->where('health_facility',3)->count()/$schoolLGAS->count())*100,0)."% W/O Health Facility"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolState)->where('health_facility',3)->count()/$schoolState->count())*100,0)."% W/O Health Facility"); ?></td>	
            </tr>
            <tr>
                <th style="width:40%">Classes Held Out:</th>
                <td><?php echo e($schoolName->background->any_classes_held_outside_y_n ==1 ? "Yes": "No"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolLGAS)->where('any_classes_held_outside_y_n',2)->count()/$schoolLGAS->count())*100,0)."% Classes Held out"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolState)->where('any_classes_held_outside_y_n',2)->count()/$schoolState->count())*100,0)."% Classes Held out"); ?></td>
            </tr>         
            <tr>
                <th style="width:40%">Inspection Visit:</th>
                <td><?php echo e(number_format(date('Y')-substr($schoolName->background->date_last_inspection,0,4))<=1 ? "Yes":"No"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolLGAS)->where(substr('date_last_inspection',0,4),"<=",1)->count()/$schoolLGAS->count())*100,0)."% W/O Inspected"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolState)->where(substr('date_last_inspection',0,4),"<=",1)->count()/$schoolState->count())*100,0)."% W/O Inspected"); ?></td>
            </tr>          
            <tr>
                <th style="width:40%">Availability of Pupils Toilets:</th>
                <td><?php echo e($schoolName->background->any_classes_held_outside_y_n ==1 ? "Yes(need correction)": "No(need correction)"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolLGAS)->where('any_classes_held_outside_y_n',2)->count()/$schoolLGAS->count())*100,0)."% W/O Pupils Toilet"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolState)->where('any_classes_held_outside_y_n',2)->count()/$schoolState->count())*100,0)."% W/O Pupils Toilet"); ?></td>
            </tr>
            <tr>
                <th style="width:40%">Separate Girls Toilets:</th>
                <td><?php echo e($schoolName->background->any_classes_held_outside_y_n ==1 ? "Yes(need correction)": "No(need correction)"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolLGAS)->where('any_classes_held_outside_y_n',2)->count()/$schoolLGAS->count())*100,0)."% W/O Girls Toilet"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolState)->where('any_classes_held_outside_y_n',2)->count()/$schoolState->count())*100,0)."% W/O Girls Toilet"); ?></td>
            </tr>
            <tr>
                <th style="width:40%">SBMC Exists and Met in Past 12 Months:</th>
                <td><?php echo e($schoolName->background->sbmc ==1 ? "Yes": "No"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolLGAS)->where('sbmc',2)->count()/$schoolLGAS->count())*100,0)."% W/O SBMC established"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolState)->where('sbmc',2)->count()/$schoolState->count())*100,0)."% SBMC established"); ?></td>
            </tr>          
            <tr>
                <th style="width:40%">School Dev Plan Prepared in Past 12 Months:</th>
                <td><?php echo e($schoolName->background->sdp ==1 ? "Yes": "No"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolLGAS)->where('sdp',2)->count()/$schoolLGAS->count())*100,0)."% W/O SDP developed"); ?></td>
                <td><?php echo e(number_format(($schoolBackground->whereIn('school_id', $schoolState)->where('sdp',2)->count()/$schoolState->count())*100,0)."% SDP developed"); ?></td>
            </tr>
        </tbody>
    </table>
    </div>
    <!-- /.col -->      
</div>
<!-- /.row -->
<div class="tab-custom-content">
    <p>&nbsp;</p>
</div>
<!-- Table row -->
<div class="row">
    <div class="col-12 table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Resources and Inputs</th>
                <th>Male</th>
                <th>Female</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Enrolment in School</td>
                <td><?php echo e(number_format($students->where('school_enrolled_id', $school)->where('gender_id', 1)->count())); ?></td>
                <td><?php echo e(number_format($students->where('school_enrolled_id', $school)->where('gender_id', 2)->count())); ?></td>
                <td><?php echo e(number_format($studentsSchool)); ?></td>
            </tr>
            <tr>
                <td>Staffs in School</td>
                <td><?php echo e(number_format($staffs->where('school_id', $school)->where('gender_id', 1)->count())); ?></td>
                <td><?php echo e(number_format($staffs->where('school_id', $school)->where('gender_id', 2)->count())); ?></td>
                <td><?php echo e(number_format($staffs->where('school_id', $school)->count())); ?></td>
            </tr>                                
            <tr>
                <td>Teachers in School</td>
                <td><?php echo e(number_format($staffs->where('school_id', $school)->where('gender_id', 1)->whereIn('type_staff_id', [1,2,3,4,7,8])->count())); ?></td>
                <td><?php echo e(number_format($staffs->where('school_id', $school)->where('gender_id', 2)->whereIn('type_staff_id', [1,2,3,4,7,8])->count())); ?></td>
                <td><?php echo e(number_format($staffs->where('school_id', $school)->whereIn('type_staff_id', [1,2,3,4,7,8])->count())); ?></td>
            </tr>                                <tr>
                <td>Qualified Teachers in School</td>
                <td><?php echo e(number_format($staffs->where('school_id', $school)->where('gender_id', 1)->whereIn('type_staff_id', [1,2,3,4,7,8])->whereNotIn('teaching_qualification_id', [6])->count())); ?></td>
                <td><?php echo e(number_format($staffs->where('school_id', $school)->where('gender_id', 2)->whereIn('type_staff_id', [1,2,3,4,7,8])->whereNotIn('teaching_qualification_id', [6])->count())); ?></td>
                <td><?php echo e(number_format($staffs->where('school_id', $school)->whereIn('type_staff_id', [1,2,3,4,7,8])->whereNotIn('teaching_qualification_id', [6])->count())); ?></td>
            </tr>                                <tr>
                <td>Enrolment in LGA</td>
                <td><?php echo e(number_format($students->whereIn('school_enrolled_id', $schoolLGAS)->where('gender_id', 1)->count())); ?></td>
                <td><?php echo e(number_format($students->whereIn('school_enrolled_id', $schoolLGAS)->where('gender_id', 2)->count())); ?></td>
                <td><?php echo e(number_format($studentsLGA)); ?></td>
            </tr>
            <tr>
                <td>Staffs in LGA</td>
                <td><?php echo e(number_format($staffs->whereIn('school_id', $schoolLGAS)->where('gender_id', 1)->count())); ?></td>
                <td><?php echo e(number_format($staffs->whereIn('school_id', $schoolLGAS)->where('gender_id', 2)->count())); ?></td>
                <td><?php echo e(number_format($staffs->whereIn('school_id', $schoolLGAS)->count())); ?></td>
            </tr>                                
            <tr>
                <td>Teachers in LGA</td>
                <td><?php echo e(number_format($staffs->whereIn('school_id', $schoolLGAS)->where('gender_id', 1)->whereIn('type_staff_id', [1,2,3,4,7,8])->count())); ?></td>
                <td><?php echo e(number_format($staffs->whereIn('school_id', $schoolLGAS)->where('gender_id', 2)->whereIn('type_staff_id', [1,2,3,4,7,8])->count())); ?></td>
                <td><?php echo e(number_format($staffs->whereIn('school_id', $schoolLGAS)->whereIn('type_staff_id', [1,2,3,4,7,8])->count())); ?></td>
            </tr>                                
            <tr>
                <td>Qualified Teachers in LGA</td>
                <td><?php echo e(number_format($staffs->whereIn('school_id', $schoolLGAS)->where('gender_id', 1)->whereIn('type_staff_id', [1,2,3,4,7,8])->whereNotIn('teaching_qualification_id', [6])->count())); ?></td>
                <td><?php echo e(number_format($staffs->whereIn('school_id', $schoolLGAS)->where('gender_id', 2)->whereIn('type_staff_id', [1,2,3,4,7,8])->whereNotIn('teaching_qualification_id', [6])->count())); ?></td>
                <td><?php echo e(number_format($staffs->whereIn('school_id', $schoolLGAS)->whereIn('type_staff_id', [1,2,3,4,7,8])->whereNotIn('teaching_qualification_id', [6])->count())); ?></td>
            </tr>                                
            <tr>
                <td>Enrolment in State</td>
                <td><?php echo e(number_format($students->where('gender_id', 1)->count())); ?></td>
                <td><?php echo e(number_format($students->where('gender_id', 2)->count())); ?></td>
                <td><?php echo e(number_format($studentsState)); ?></td>
            </tr>   
            <tr>
                <td>Staffs in State</td>
                <td><?php echo e(number_format($staffs->where('gender_id', 1)->count())); ?></td>
                <td><?php echo e(number_format($staffs->where('gender_id', 2)->count())); ?></td>
                <td><?php echo e(number_format($staffs->count())); ?></td>
            </tr>                              
            <tr>
                <td>Teachers in State</td>
                <td><?php echo e(number_format($staffs->where('gender_id', 1)->whereIn('type_staff_id', [1,2,3,4,7,8])->count())); ?></td>
                <td><?php echo e(number_format($staffs->where('gender_id', 2)->whereIn('type_staff_id', [1,2,3,4,7,8])->count())); ?></td>
                <td><?php echo e(number_format($staffs->whereIn('type_staff_id', [1,2,3,4,7,8])->count())); ?></td>
            </tr>                                
            <tr>
                <td>Qualified Teachers in State</td>
                <td><?php echo e(number_format($staffs->where('gender_id', 1)->whereIn('type_staff_id', [1,2,3,4,7,8])->whereNotIn('teaching_qualification_id', [6])->count())); ?></td>
                <td><?php echo e(number_format($staffs->where('gender_id', 2)->whereIn('type_staff_id', [1,2,3,4,7,8])->whereNotIn('teaching_qualification_id', [6])->count())); ?></td>
                <td><?php echo e(number_format($staffs->whereIn('type_staff_id', [1,2,3,4,7,8])->whereNotIn('teaching_qualification_id', [6])->count())); ?></td>
            </tr>
        </tbody>
    </table>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->                    
<div class="tab-custom-content">
    <p>&nbsp;</p>
</div>
<!-- Table row -->
<div class="row">
    <div class="col-12 table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Resources and Inputs</th>
                <th>School</th>
                <th>LGA</th>
                <th>State</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Pupils/Teachers Ratio (all teachers)</td>
                <td><?php echo e(number_format($studentsSchool/$staffs->where('school_id', $school)->count(),0)); ?></td>
             	<td><?php echo e(number_format($studentsLGA/$staffs->whereIn('school_id', $schoolLGAS)->count(),0)); ?></td>
                <td><?php echo e(number_format($studentsState/$staffs->count(),0)); ?></td>
            </tr>                                
            <tr>
                <td>Pupils/Qualified Teacher Ratio</td>
                <td><?php echo e(number_format($studentsSchool/$staffs->where('school_id', $school)->whereNotIn('teaching_qualification_id', [6])->count(),0)); ?></td>
             	<td><?php echo e(number_format($studentsLGA/$staffs->whereIn('school_id', $schoolLGAS)->whereNotIn('teaching_qualification_id', [6])->count(),0)); ?></td>
                <td><?php echo e(number_format($studentsState/$staffs->whereNotIn('teaching_qualification_id', [6])->count(),0)); ?></td>
            </tr>                                
            <tr>
                <td>% Female Teachers</td>
                <td><?php echo e(number_format(($staffs->where('school_id', $school)->where('gender_id', 2)->count()/$staffs->where('school_id', $school)->count())*100)."%"); ?></td>
             	<td><?php echo e(number_format(($staffs->whereIn('school_id', $schoolLGAS)->where('gender_id', 2)->count()/$staffs->whereIn('school_id', $schoolLGAS)->count())*100)."%"); ?></td>
                <td><?php echo e(number_format(($staffs->where('gender_id', 2)->count()/$staffs->count())*100)."%"); ?></td>
            </tr>                                
            <tr>
                <td>% Teachers Attended Training</td>
                <td><?php echo e(number_format(($staffs->where('school_id', $school)->where('seminar_workshop_id', 1)->count()/$staffs->where('school_id', $school)->count())*100)."%"); ?></td>
             	<td><?php echo e(number_format(($staffs->whereIn('school_id', $schoolLGAS)->where('seminar_workshop_id', 1)->count()/$staffs->whereIn('school_id', $schoolLGAS)->count())*100)."%"); ?></td>
                <td><?php echo e(number_format(($staffs->where('seminar_workshop_id', 1)->count()/$staffs->count())*100)."%"); ?></td>
            </tr>                                <tr>
                <td>% Teachers Present</td>
                <td><?php echo e(number_format(($staffs->where('school_id', $school)->whereIn('present_status_id', [1,5])->count()/$staffs->where('school_id', $school)->count())*100)."%"); ?></td>
             	<td><?php echo e(number_format(($staffs->whereIn('school_id', $schoolLGAS)->whereIn('present_status_id', [1,5])->count()/$staffs->whereIn('school_id', $schoolLGAS)->count())*100)."%"); ?></td>
                <td><?php echo e(number_format(($staffs->whereIn('present_status_id', [1,5])->count()/$staffs->count())*100)."%"); ?></td>
            </tr>                                
            <tr>
                <td>Girl Pupils/Female Teachers Ratio</td>
                <td><?php echo e(number_format($students->where('school_enrolled_id', $school)->where('gender_id', 2)->count()/$staffs->where('gender_id', 2)->where('school_id', $school)->count(),0)); ?></td>
             	<td><?php echo e(number_format($students->whereIn('school_enrolled_id', $schoolLGAS)->where('gender_id', 2)->count()/$staffs->where('gender_id', 2)->whereIn('school_id', $schoolLGAS)->count(),0)); ?></td>
                <td><?php echo e(number_format($students->where('gender_id', 2)->count()/$staffs->where('gender_id', 2)->count(),0)); ?></td>
            </tr>                               
            <tr>
                <td>Pupils/Useable Classroom Ratio</td>
                <td><?php echo e(number_format($studentsSchool/$useableClassroomsSchool)); ?></td>
             	<td><?php echo e(number_format($studentsLGA/$useableClassroomsLGA)); ?></td>
                <td><?php echo e(number_format($studentsState/$useableClassroomsState)); ?></td>
            </tr>                                
            <tr>
                <td>% of Classrooms with Adequate Seats</td>
                <td><?php echo e(number_format(($adequateSeatClassroomsSchool/$nbClassroomsSchool)*100)."%"); ?></td>
             	<td><?php echo e(number_format(($adequateSeatClassroomsLGA/$nbClassroomsLGA)*100)."%"); ?></td>
                <td><?php echo e(number_format(($adequateSeatClassroomsState/$nbClassroomsState)*100)."%"); ?></td>
            </tr>
            <tr>
                <td>% of Classrooms with Good Blackboard</td>
                <td><?php echo e(number_format(($goodBlackBoardClassroomsSchool/$nbClassroomsSchool)*100)."%"); ?></td>
             	<td><?php echo e(number_format(($goodBlackBoardClassroomsLGA/$nbClassroomsLGA)*100)."%"); ?></td>
                <td><?php echo e(number_format(($goodBlackBoardClassroomsState/$nbClassroomsState)*100)."%"); ?></td>
            </tr>
            <tr>
                <td>% of Classrooms in Need of Minor Repair</td>
                <td><?php echo e(number_format(($minorRepairClassroomsSchool/$nbClassroomsSchool)*100)."%"); ?></td>
             	<td><?php echo e(number_format(($minorRepairClassroomsLGA/$nbClassroomsLGA)*100)."%"); ?></td>
                <td><?php echo e(number_format(($minorRepairClassroomsState/$nbClassroomsState)*100)."%"); ?></td>
            </tr>
            <tr>
                <td>% of Classrooms in Need of Major Repair</td>
                <td><?php echo e(number_format(($majorRepairClassroomsSchool/$nbClassroomsSchool)*100)."%"); ?></td>
             	<td><?php echo e(number_format(($majorRepairClassroomsLGA/$nbClassroomsLGA)*100)."%"); ?></td>
                <td><?php echo e(number_format(($majorRepairClassroomsState/$nbClassroomsState)*100)."%"); ?></td>
            </tr>
            <tr>
                <td>Pupils/Toilet Ratio</td>
                <td><?php echo e(number_format($studentsSchool/$nbToiletsSchool==0 ? 1 : $nbToiletsSchool,2)); ?></td>
                <td><?php echo e(number_format($studentsLGA/$nbToiletsLGA,0)); ?></td>
                <td><?php echo e(number_format($studentsState/$nbToiletsState,0)); ?></td>
            </tr>                                
            <tr>
                <td>Pupils/Math Textbooks Ratio</td>
                <td><?php echo e($schoolName->nemis_code); ?></td>
                <td><?php echo e($schoolName->nemis_code); ?></td>
                <td><?php echo e($schoolName->nemis_code); ?></td>
            </tr>                                
            <tr>
                <td>Pupils/English Textbooks Ratio</td>
                <td><?php echo e($schoolName->nemis_code); ?></td>
                <td><?php echo e($schoolName->nemis_code); ?></td>
                <td><?php echo e($schoolName->nemis_code); ?></td>
            </tr>
        </tbody>
    </table>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="tab-custom-content">
    <p>&nbsp;</p>
</div>
<!-- Table row -->
<div class="row">
    <div class="col-12 table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Results</th>
                <th>School</th>
                <th>LGA</th>
                <th>State</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Gender Parity Index (F/M)</td>
                <td><?php echo e(number_format($studentsFSchool/$studentsMSchool,2)); ?></td>
                <td><?php echo e(number_format($studentsFLGA/$studentsMLGA,2)); ?></td>
                <td><?php echo e(number_format($studentsFState/$studentsMState,2)); ?></td>
            </tr>                                
            <tr>
                <td>% Female</td>
                <td><?php echo e(number_format(($studentsFSchool/$studentsSchool)*100)."%"); ?></td>
                <td><?php echo e(number_format(($studentsFLGA/$studentsLGA)*100)."%"); ?></td>
                <td><?php echo e(number_format(($studentsFState/$studentsState)*100)."%"); ?></td>
            </tr> 
        </tbody>
    </table>
    </div>
    <!-- /.col -->
</div>

<!-- /.row -->                    
<div class="tab-custom-content">
    <p>&nbsp;</p>
</div>
<!-- Table row -->
<div class="row">
    <div class="col-12 table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Results</th>
                <th colspan='3'>School</th>
                <th colspan='3'>LGA</th>
                <th colspan='3'>State</th>
            </tr>                                
            <tr>
                <th>Enrolment</th>
                <th>Male</th>
                <th>Female</th>
                <th>Total</th>
                <th>Male</th>
                <th>Female</th>
                <th>Total</th>                          
                <th>Male</th>
                <th>Female</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        	<?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
                <td><?php echo e($class->title); ?></td>
                <td><?php echo e($students->where('school_enrolled_id', $school)->where('classs.classTitle.id', $class->id)->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('school_enrolled_id', $school)->where('classs.classTitle.id', $class->id)->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->where('school_enrolled_id', $school)->where('classs.classTitle.id', $class->id)->count()); ?></td>
                <td><?php echo e($students->whereIn('school_enrolled_id', $schoolLGAS)->where('classs.classTitle.id', $class->id)->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->whereIn('school_enrolled_id', $schoolLGAS)->where('classs.classTitle.id', $class->id)->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->whereIn('school_enrolled_id', $schoolLGAS)->where('classs.classTitle.id', $class->id)->count()); ?></td>
                <td><?php echo e($students->where('classs.classTitle.id', $class->id)->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('classs.classTitle.id', $class->id)->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->where('classs.classTitle.id', $class->id)->count()); ?></td>
            </tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           <!--  <tr>
                <td>Primary 1</td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
            </tr>
            <tr>
                <td>Primary 2</td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
            </tr>
            <tr>
                <td>Primary 3</td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
            </tr>
            <tr>
                <td>Primary 4</td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
            </tr>
            <tr>
                <td>Primary 5</td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
            </tr>
            <tr>
                <td>Primary 6</td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
            </tr>         -->                        
           <!--  <tr>
                <td>Survival (Retention) Rate</td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 1)->count()); ?></td>
                <td><?php echo e($students->where('gender_id', 2)->count()); ?></td>
                <td><?php echo e($students->count()); ?></td>
            </tr> -->
        </tbody>
    </table>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<div class="tab-custom-content">
    <p><b>Comparison of Context, Inputs, Results and Efficiency indexes between the School, LGA, and State</b></p>
</div>
<!-- Table row -->
<div class="row">
    <div class="col-6">
    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>School</th>
                <th>LGA</th>
                <th>State</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Context Index</td>
                <td><?php echo e($contextIndexScoreSchool); ?></td>
                <td><?php echo e($contextIndexScoreLGA); ?></td>
                <td><?php echo e($contextIndexScoreState); ?></td>
            </tr>                                
            <tr>
                <td>Inputs Index</td>
                <td><?php echo e($inputIndexScoreSchool); ?></td>
                <td><?php echo e($inputIndexScoreLGA); ?></td>
                <td><?php echo e($inputIndexScoreState); ?></td>
            </tr> 
            <tr>
                <td>Results Index</td>
                <td><?php echo e($resultIndexScoreSchool); ?></td>
                <td><?php echo e($resultIndexScoreLGA); ?></td>
                <td><?php echo e($resultIndexScoreState); ?></td>
            </tr>                                
            <tr>
                <td>Efficiency Index (Results/Inputs)</td>
                <td><?php echo e($efficiencyIndexSchool1); ?></td>
                <td><?php echo e($efficiencyIndexLGA1); ?></td>
                <td><?php echo e($efficiencyIndexState1); ?></td>
            </tr>                                 
            <tr>
                <td>Efficiency Index (Results/Context)</td>
                <td><?php echo e($efficiencyIndexSchool2); ?></td>
                <td><?php echo e($efficiencyIndexLGA2); ?></td>
                <td><?php echo e($efficiencyIndexState2); ?></td>
            </tr> 
        </tbody>
    </table>
    </div>
    <!-- /.col -->
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div id="piechart" style="width: 500px; height: 300px;"></div>
            </div>
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
    <!-- Table row -->
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div id="barchart1" style="width: 500px; height: 300px;"></div>
            </div>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div id="barchart2" style="width: 500px; height: 300px;"></div>
            </div>
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- ./wrapper -->
<?php endif; ?>
<?php endif; ?>
<?php if($sectorReport): ?>
<?php if($report == 'teacher_deployment_index'): ?>			
<!-- Table row -->
<div class="row">
    <div class="col-6 table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th style="width:40%">LGEA:</th>
                    <td><?php echo e($lgaName); ?></td>
                </tr>
                <tr>
                    <th style="width:40%">Total No. Schools:</th>
                    <td><?php echo e(number_format($schoolSector->count())); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.col -->      
    <div class="col-6 table-responsive">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th style="width:60%">Total Number of Teachers:</th>
                    <td><?php echo e($teachers->count()); ?></td>
                </tr>
                <tr>
                    <th style="width:60%">Total Student Enrolment:</th>
                    <td><?php echo e($students->count()); ?></td>
                </tr>
            </tbody>
        </table>
     </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="tab-custom-content">
    <p>&nbsp;</p>
</div>
<!-- Table row -->
<div class="row">
    <div class="col-12 table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Schoo DB Code</th>
                <th>School Name</th>
                <th>Number of Students</th>
                <th>Number of Teachers</th>
                <th>Pupil-Teacher ratio</th>
            </tr>
        </thead>
        <tbody>
        	<?php $__currentLoopData = $schoolSector; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($school->id); ?></td>
                <td><?php echo e($school->name); ?></td>
                <td><?php echo e($students->where('school_enrolled_id', $school->id)->count()); ?></td>
                <td><?php echo e($teachers->where('school_id', $school->id)->count()); ?></td>
                <td><?php echo e($teachers->where('school_id', $school->id)->count() >0 ? number_format($students->where('school_enrolled_id', $school->id)->count()/$teachers->where('school_id', $school->id)->count(),2) : number_format($students->where('school_enrolled_id', $school->id)->count()/1,2)); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    </div>
    <!-- /.col -->      
</div>
<!-- /.row -->
<div class="tab-custom-content">
    <p>&nbsp;</p>
</div>

</section>
<!-- /.content -->
</div>
<!-- ./wrapper -->
<?php endif; ?>
<?php endif; ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/reports/templates/zone-report.blade.php ENDPATH**/ ?>