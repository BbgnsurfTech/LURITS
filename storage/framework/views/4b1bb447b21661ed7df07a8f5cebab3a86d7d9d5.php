<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.auditLog.title_singular')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AuditLog">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        <?php echo e(trans('cruds.auditLog.fields.id')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.auditLog.fields.description')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.auditLog.fields.subject_id')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.auditLog.fields.subject_type')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.auditLog.fields.user_id')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.auditLog.fields.host')); ?>

                    </th>
                    <th>
                        <?php echo e(trans('cruds.auditLog.fields.created_at')); ?>

                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "<?php echo e(route('admin.audit-logs.index')); ?>",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'description', name: 'description' },
{ data: 'subject_id', name: 'subject_id' },
{ data: 'subject_type', name: 'subject_type' },
{ data: 'user_id', name: 'user_id' },
{ data: 'host', name: 'host' },
{ data: 'created_at', name: 'created_at' },
{ data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-AuditLog').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/auditLogs/index.blade.php ENDPATH**/ ?>