<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="row">
        <p class="col-lg-12">
            <?php echo $__env->yieldContent('title'); ?>
        </p>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <p>
                <a href="<?php echo e(route('admin.messenger.createTopic')); ?>" class="btn btn-primary btn-block">
                    <?php echo e(trans('global.new_message')); ?>

                </a>
            </p>
            <div class="list-group">
                <a href="<?php echo e(route('admin.messenger.index')); ?>" class="list-group-item">
                    <?php echo e(trans('global.all_messages')); ?>

                </a>
                <a href="<?php echo e(route('admin.messenger.showInbox')); ?>" class="list-group-item">
                    <?php if($unreads['inbox'] > 0): ?>
                        <strong>
                            <?php echo e(trans('global.inbox')); ?>

                            (<?php echo e($unreads['inbox']); ?>)
                        </strong>
                    <?php else: ?>
                        <?php echo e(trans('global.inbox')); ?>

                    <?php endif; ?>
                </a>
                <a href="<?php echo e(route('admin.messenger.showOutbox')); ?>" class="list-group-item">
                    <?php if($unreads['outbox'] > 0): ?>
                        <strong>
                            <?php echo e(trans('global.outbox')); ?>

                            (<?php echo e($unreads['outbox']); ?>)
                        </strong>
                    <?php else: ?>
                        <?php echo e(trans('global.outbox')); ?>

                    <?php endif; ?>
                </a>
            </div>
        </div>
        <div class="col-lg-9">
            <?php echo $__env->yieldContent('messenger-content'); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/messenger/template.blade.php ENDPATH**/ ?>