<?php $__env->startSection('content'); ?>
<section class="content-header">
<div class="row">
    <div class="col">
        <h3 class="page-title"><?php echo e(trans('cruds.expenseReport.reports.title')); ?></h3>

        <form method="get">
            <div class="row">
                <div class="col-3 form-group">
                    <label class="control-label" for="y"><?php echo e(trans('global.year')); ?></label>
                    <select name="y" id="y" class="form-control">
                        <?php $__currentLoopData = array_combine(range(date("Y"), 1900), range(date("Y"), 1900)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($year); ?>" <?php if($year===old('y', Request::get('y', date('Y')))): ?> selected <?php endif; ?>>
                                <?php echo e($year); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-3 form-group">
                    <label class="control-label" for="m"><?php echo e(trans('global.month')); ?></label>
                    <select name="m" for="m" class="form-control">
                        <?php $__currentLoopData = cal_info(0)['months']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($month); ?>" <?php if($month===old('m', Request::get('m', date('m')))): ?> selected <?php endif; ?>>
                                <?php echo e($month); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-4">
                    <label class="control-label">&nbsp;</label><br>
                    <button class="btn btn-primary" type="submit"><?php echo e(trans('global.filterDate')); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
</section>

<section class="content">
<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.expenseReport.reports.incomeReport')); ?>

    </div>

    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th><?php echo e(trans('cruds.expenseReport.reports.income')); ?></th>
                        <td><?php echo e(number_format($incomesTotal, 2)); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo e(trans('cruds.expenseReport.reports.expense')); ?></th>
                        <td><?php echo e(number_format($expensesTotal, 2)); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo e(trans('cruds.expenseReport.reports.profit')); ?></th>
                        <td><?php echo e(number_format($profit, 2)); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th><?php echo e(trans('cruds.expenseReport.reports.incomeByCategory')); ?></th>
                        <th><?php echo e(number_format($incomesTotal, 2)); ?></th>
                    </tr>
                    <?php $__currentLoopData = $incomesSummary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?php echo e($inc['name']); ?></th>
                            <td><?php echo e(number_format($inc['amount'], 2)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
            <div class="col">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th><?php echo e(trans('cruds.expenseReport.reports.expenseByCategory')); ?></th>
                        <th><?php echo e(number_format($expensesTotal, 2)); ?></th>
                    </tr>
                    <?php $__currentLoopData = $expensesSummary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?php echo e($inc['name']); ?></th>
                            <td><?php echo e(number_format($inc['amount'], 2)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>

    </div>
</div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
<script>
    $('.date').datepicker({
        autoclose: true,
        dateFormat: "<?php echo e(config('panel.date_format_js')); ?>"
      })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/expenseReports/index.blade.php ENDPATH**/ ?>