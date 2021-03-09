<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('messenger-content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="list-group">
            <?php $__empty_1 = true; $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="row list-group-item d-flex">
                    <div class="col-lg-4">
                        <a href="<?php echo e(route('admin.messenger.showMessages', [$topic->id])); ?>">
                            <?php ($receiverOrCreator = $topic->receiverOrCreator()); ?>
                                <?php if($topic->hasUnreads()): ?>
                                    <strong>
                                        <?php echo e($receiverOrCreator !== null ? $receiverOrCreator->email : ''); ?>

                                    </strong>
                                <?php else: ?>
                                    <?php echo e($receiverOrCreator !== null ? $receiverOrCreator->email : ''); ?>

                                <?php endif; ?>
                        </a>
                    </div>
                    <div class="col-lg-5">
                        <a href="<?php echo e(route('admin.messenger.showMessages', [$topic->id])); ?>">
                            <?php if($topic->hasUnreads()): ?>
                                <strong>
                                    <?php echo e($topic->subject); ?>

                                </strong>
                            <?php else: ?>
                                <?php echo e($topic->subject); ?>

                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="col-lg-2 text-right"><?php echo e($topic->created_at->diffForHumans()); ?></div>
                    <div class="col-lg-1 text-center">
                        <form action="<?php echo e(route('admin.messenger.destroyTopic', [$topic->id])); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');">
                            <input type="hidden" name="_method" value="DELETE">
                            <?php echo csrf_field(); ?>
                            <input type="submit" class="btn btn-xs btn-danger" value="<?php echo e(trans('global.delete')); ?>">
                        </form>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="row list-group-item">
                    <?php echo e(trans('global.you_have_no_messages')); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.messenger.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/messenger/index.blade.php ENDPATH**/ ?>