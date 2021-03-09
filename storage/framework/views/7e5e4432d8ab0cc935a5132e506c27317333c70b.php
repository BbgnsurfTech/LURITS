<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($viewGate)): ?>
    <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.' . $crudRoutePart . '.show', $row->id)); ?>">
        <?php echo e(trans('global.view')); ?>

    </a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($editGate)): ?>
    <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.' . $crudRoutePart . '.edit', $row->id)); ?>">
        <?php echo e(trans('global.edit')); ?>

    </a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($deleteGate)): ?>
    <form action="<?php echo e(route('admin.' . $crudRoutePart . '.destroy', $row->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <input type="submit" class="btn btn-xs btn-danger" value="<?php echo e(trans('global.delete')); ?>">
    </form>
<?php endif; ?>
<?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/partials/datatablesActions.blade.php ENDPATH**/ ?>