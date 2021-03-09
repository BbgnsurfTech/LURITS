<div class="m-3">

    <div class="card">
        <div class="card-header">
            <?php echo e(trans('cruds.assetsHistory.title_singular')); ?> <?php echo e(trans('global.list')); ?>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-AssetsHistory">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                <?php echo e(trans('cruds.assetsHistory.fields.id')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.assetsHistory.fields.asset')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.assetsHistory.fields.status')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.assetsHistory.fields.location')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.assetsHistory.fields.assigned_user')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.assetsHistory.fields.created_at')); ?>

                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $assetsHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $assetsHistory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-entry-id="<?php echo e($assetsHistory->id); ?>">
                                <td>

                                </td>
                                <td>
                                    <?php echo e($assetsHistory->id ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($assetsHistory->asset->name ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($assetsHistory->status->name ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($assetsHistory->location->name ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($assetsHistory->assigned_user->name ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($assetsHistory->created_at ?? ''); ?>

                                </td>
                                <td>



                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-AssetsHistory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
<?php $__env->stopSection(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/assetStatuses/relationships/statusAssetsHistories.blade.php ENDPATH**/ ?>