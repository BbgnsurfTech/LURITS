<?php $__env->startSection('title', $topic->subject); ?>

<?php $__env->startSection('messenger-content'); ?>
<div class="row">
    <p>
        <?php if($topic->receiverOrCreator() !== null && !$topic->receiverOrCreator()->trashed()): ?>
            <a href="<?php echo e(route('admin.messenger.reply', [$topic->id])); ?>" class="btn btn-primary">
                <?php echo e(trans('global.reply')); ?>

            </a>
        <?php endif; ?>
    </p>
    <div class="col-lg-12">
        <div class="list-group">
            <?php $__currentLoopData = $topic->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row list-group-item">
                    <div class="row">
                        <div class="col col-lg-10">
                            <strong><?php echo e($message->sender->email); ?></strong>
                        </div>
                        <div class="col col-lg-2">
                            <?php echo e($message->created_at->diffForHumans()); ?>

                        </div>
                    </div>
                    <div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-12">
                            <?php echo e($message->content); ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.messenger.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Project/DataStamp-LURITS_QA/resources/views/admin/messenger/show.blade.php ENDPATH**/ ?>