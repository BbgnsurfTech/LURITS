<div class="m-3">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('student_admission_create')): ?>
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="<?php echo e(route("admin.student-admissions.create")); ?>">
                    <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.studentAdmission.title_singular')); ?>

                </a>
            </div>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <?php echo e(trans('cruds.studentAdmission.title_singular')); ?> <?php echo e(trans('global.list')); ?>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-StudentAdmission">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.child_name')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.middle_name')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.last_name')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.admission')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.gender')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.state_origin')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.nationality_1')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.hubby')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.student_picture')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.student_document')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.school_enrolled')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.studentAdmission.fields.parent_guardian')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.parentGuardianregister.fields.middle_name')); ?>

                            </th>
                            <th>
                                <?php echo e(trans('cruds.parentGuardianregister.fields.last_name')); ?>

                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $studentAdmissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $studentAdmission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-entry-id="<?php echo e($studentAdmission->id); ?>">
                                <td>

                                </td>
                                <td>
                                    <?php echo e($studentAdmission->child_name ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($studentAdmission->middle_name ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($studentAdmission->last_name ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($studentAdmission->admission ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e(App\StudentAdmission::GENDER_SELECT[$studentAdmission->gender] ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e(App\StudentAdmission::STATE_ORIGIN_SELECT[$studentAdmission->state_origin] ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e(App\StudentAdmission::NATIONALITY_1_SELECT[$studentAdmission->nationality_1] ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($studentAdmission->hubby ?? ''); ?>

                                </td>
                                <td>
                                    <?php if($studentAdmission->student_picture): ?>
                                        <a href="<?php echo e($studentAdmission->student_picture->getUrl()); ?>" target="_blank">
                                            <img src="<?php echo e($studentAdmission->student_picture->getUrl('thumb')); ?>" width="50px" height="50px">
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php $__currentLoopData = $studentAdmission->student_document; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e($media->getUrl()); ?>" target="_blank">
                                            <?php echo e(trans('global.view_file')); ?>

                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td>
                                    <?php echo e($studentAdmission->school_enrolled->name ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($studentAdmission->parent_guardian->first_name ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($studentAdmission->parent_guardian->middle_name ?? ''); ?>

                                </td>
                                <td>
                                    <?php echo e($studentAdmission->parent_guardian->last_name ?? ''); ?>

                                </td>
                                <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('student_admission_show')): ?>
                                        <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.student-admissions.show', $studentAdmission->id)); ?>">
                                            <?php echo e(trans('global.view')); ?>

                                        </a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('student_admission_edit')): ?>
                                        <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.student-admissions.edit', $studentAdmission->id)); ?>">
                                            <?php echo e(trans('global.edit')); ?>

                                        </a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('student_admission_delete')): ?>
                                        <form action="<?php echo e(route('admin.student-admissions.destroy', $studentAdmission->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                            <input type="submit" class="btn btn-xs btn-danger" value="<?php echo e(trans('global.delete')); ?>">
                                        </form>
                                    <?php endif; ?>

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
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('student_admission_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.student-admissions.massDestroy')); ?>",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('<?php echo e(trans('global.datatables.zero_selected')); ?>')

        return
      }

      if (confirm('<?php echo e(trans('global.areYouSure')); ?>')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
<?php endif; ?>

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  $('.datatable-StudentAdmission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
<?php $__env->stopSection(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/parentGuardianregisters/relationships/parentGuardianStudentAdmissions.blade.php ENDPATH**/ ?>