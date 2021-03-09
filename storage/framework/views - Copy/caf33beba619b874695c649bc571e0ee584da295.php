<?php $__env->startSection('title', trans('global.new_message')); ?>

<?php $__env->startSection('messenger-content'); ?>

<div class="row">
    <div class="col-lg-12">
        <form action="<?php echo e(route("admin.messenger.reply", [$topic->id])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label for="content" class="control-label">
                                <?php echo e(trans('global.content')); ?>

                            </label>
                            <textarea name="content" class="form-control"></textarea>
                        </div>
                    </div>
                    <input type="submit" value="<?php echo e(trans('global.reply')); ?>" class="btn btn-success" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.messenger.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Project/DataStamp-LURITS_QA/resources/views/admin/messenger/reply.blade.php ENDPATH**/ ?>