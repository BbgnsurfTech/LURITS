<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.show')); ?> <?php echo e(trans('cruds.asset.title')); ?>

    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.assets.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.asset.fields.id')); ?>

                        </th>
                        <td>
                            <?php echo e($asset->id); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.asset.fields.category')); ?>

                        </th>
                        <td>
                            <?php echo e($asset->category->name ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.asset.fields.serial_number')); ?>

                        </th>
                        <td>
                            <?php echo e($asset->serial_number); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.asset.fields.name')); ?>

                        </th>
                        <td>
                            <?php echo e($asset->name); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.asset.fields.photos')); ?>

                        </th>
                        <td>
                            <?php $__currentLoopData = $asset->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($media->getUrl()); ?>" target="_blank">
                                    <?php echo e(trans('global.view_file')); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.asset.fields.status')); ?>

                        </th>
                        <td>
                            <?php echo e($asset->status->name ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.asset.fields.notes')); ?>

                        </th>
                        <td>
                            <?php echo e($asset->notes); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.asset.fields.assigned_to')); ?>

                        </th>
                        <td>
                            <?php echo e($asset->staff->first_name ?? ''); ?> <?php echo e($asset->staff->middle_name ?? ''); ?> <?php echo e($asset->staff->last_name ?? ''); ?>

                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="<?php echo e(route('admin.assets.index')); ?>">
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
            <a class="nav-link" href="#asset_assets_histories" role="tab" data-toggle="tab">
                <?php echo e(trans('cruds.assetsHistory.title')); ?>

            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="asset_assets_histories">
            <?php if ($__env->exists('admin.assets.relationships.assetAssetsHistories', ['assetsHistories' => $asset->assetAssetsHistories])) echo $__env->make('admin.assets.relationships.assetAssetsHistories', ['assetsHistories' => $asset->assetAssetsHistories], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/assets/show.blade.php ENDPATH**/ ?>