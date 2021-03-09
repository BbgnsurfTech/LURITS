<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.show')); ?> <?php echo e(trans('cruds.assetStatus.title')); ?>

    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.asset-statuses.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.assetStatus.fields.id')); ?>

                        </th>
                        <td>
                            <?php echo e($assetStatus->id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.assetStatus.fields.name')); ?>

                        </th>
                        <td>
                            <?php echo e($assetStatus->name); ?>

                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.asset-statuses.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.relatedData')); ?>

    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#status_assets" role="tab" data-toggle="tab">
                <?php echo e(trans('cruds.asset.title')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#status_assets_histories" role="tab" data-toggle="tab">
                <?php echo e(trans('cruds.assetsHistory.title')); ?>

            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="status_assets">
            <?php if ($__env->exists('admin.assetStatuses.relationships.statusAssets', ['assets' => $assetStatus->statusAssets])) echo $__env->make('admin.assetStatuses.relationships.statusAssets', ['assets' => $assetStatus->statusAssets], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="tab-pane" role="tabpanel" id="status_assets_histories">
            <?php if ($__env->exists('admin.assetStatuses.relationships.statusAssetsHistories', ['assetsHistories' => $assetStatus->statusAssetsHistories])) echo $__env->make('admin.assetStatuses.relationships.statusAssetsHistories', ['assetsHistories' => $assetStatus->statusAssetsHistories], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/assetStatuses/show.blade.php ENDPATH**/ ?>