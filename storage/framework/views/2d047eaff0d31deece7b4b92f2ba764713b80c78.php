<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
        <?php echo e(trans('global.show')); ?> <?php echo e(trans('cruds.classroom.title')); ?>

    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.classrooms.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
                </button>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('classroom_edit')): ?>
                <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.classrooms.edit', $classroom->id)); ?>">
                    <?php echo e(trans('global.edit')); ?>

                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('classroom_delete')): ?>
                    <form action="<?php echo e(route('admin.classrooms.destroy', $classroom->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input type="submit" class="btn btn-xs btn-danger" value="<?php echo e(trans('global.delete')); ?>">
                    </form>
                <?php endif; ?>
            </div>
                                
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.classroom.fields.capacity')); ?>

                        </th>
                        <td>
                            <?php echo e($classroom->capacity ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Current Class Capacity
                        </th>
                        <td>
                            <?php echo e($classroom->current_capacity ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.classroom.fields.school_enrolled')); ?>

                        </th>
                        <td>
                            <?php echo e($classroom->school->name ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.classroom.fields.year')); ?>

                        </th>
                        <td>
                            <?php echo e($classroom->year ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.classroom.fields.condition')); ?>

                        </th>
                        <td>
                            <?php echo e($classroom->classCondition->title ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.classroom.fields.length')); ?>

                        </th>
                        <td>
                            <?php echo e($classroom->length ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.classroom.fields.width')); ?>

                        </th>
                        <td>
                            <?php echo e($classroom->width ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.classroom.fields.floor_material')); ?>

                        </th>
                        <td>
                            <?php echo e($classroom->floorMaterial->title ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.classroom.fields.wall_material')); ?>

                        </th>
                        <td>
                            <?php echo e($classroom->wallMaterial->title ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.classroom.fields.roof_material')); ?>

                        </th>
                        <td>
                            <?php echo e($classroom->roofMaterial->title ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.classroom.fields.seating')); ?>

                        </th>
                        <td>
                            <?php echo e($classroom->availableSeating->title ?? ''); ?>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?php echo e(trans('cruds.classroom.fields.writing_board')); ?>

                        </th>
                        <td>
                            <?php echo e($classroom->writingBoard->title ?? ''); ?>

                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <button type="button" class="btn-fill-md text-light bg-orange-peel">
                <a class="btn btn-default" href="<?php echo e(route('admin.classrooms.index')); ?>">
                    <?php echo e(trans('global.back_to_list')); ?>

                </a>
                </button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/classroom/show.blade.php ENDPATH**/ ?>