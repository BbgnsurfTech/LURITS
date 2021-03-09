<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('student_transfer_create')): ?>
<section class="content-header">
<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="<?php echo e(route("admin.transfer.create")); ?>">
                <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.transfers.title_singular')); ?>

            </a>
            <?php if(Auth::User()->is_headTeacher): ?>
            <a class="btn btn-primary ml-2" href="<?php echo e(route("admin.transfer.request")); ?>">
                Request Transfer
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<section class="content">
<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.transfers.title_singular')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
        <?php echo $__env->make('partials.filter.school', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Transfers" id="datatable">
                <thead>
                    <tr>
                        <th width="10">
                            
                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            Reason for Leaving
                        </th>
                        <th>
                            Pupils Conduct
                        </th>
                        <th>
                            Last Attendance Date
                        </th>
                        <th>
                            Head Teacher Name
                        </th>
                        <th>
                            Head Teacher Phone
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('transfer_delete')): ?>
  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.transfer.massDestroy')); ?>",
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
  $('.datatable-Transfers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
<?php if(Auth::User()->is_superAdmin || Auth::User()->is_admin || Auth::User()->is_zeqa): ?>
<script src="<?php echo e(asset('js/filter.js')); ?>"></script>
<?php endif; ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="school"]').on('change', function(){
            var school = $(this).val();

             $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                retrieve: false,
                aaSorting: [],
                ajax: {
                    url: "<?php echo e(route('admin.transfer.index')); ?>",
                    data: {
                    school: school 
                    },
                },
                
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'pupils_conduct', name: 'pupils_conduct' },
                    { data: 'reason_for_leaving', name: 'reason_for_leaving' },
                    { data: 'last_attendance_date', name: 'last_attendance_date' },
                    { data: 'headteacher_name', name: 'headteacher_name' },
                    { data: 'headteacher_phone', name: 'headteacher_phone' },
                    { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
                ],
                order: [[ 1, 'desc' ]],
                pageLength: 50,
             });
        });
    });
</script>
<?php if(Auth::User()->is_headTeacher): ?>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "<?php echo e(route('admin.transfer.massDestroy')); ?>",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "<?php echo e(route('admin.transfer.getTransfer')); ?>",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'name', name: 'name' },
{ data: 'pseudo_code', name: 'pseudo_code' },
{ data: 'nemis_code', name: 'nemis_code' },
{ data: 'school_community', name: 'school_community' },
{ data: 'village_town', name: 'village_town' },
{ data: 'code_type_sector', name: 'code_type_sector' },
{ data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-Transfers').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});


  // $(function () {
  //   // datatable
  //   var table = $('#datatable').DataTable({
  //       processing: true,
  //       serverSide: true,
  //       destroy: true,
  //       retrieve: true,
  //       aaSorting: [],
  //       ajax: "<?php echo e(route('admin.transfer.getTransfer')); ?>",
  //       columns: [
  //           { data: 'placeholder', name: 'placeholder' },
  //           { data: 'id', name: 'id' },
  //           { data: 'pupils_conduct', name: 'pupils_conduct' },
  //           { data: 'reason_for_leaving', name: 'reason_for_leaving' },
  //           { data: 'last_attendance_date', name: 'last_attendance_date' },
  //           { data: 'headteacher_name', name: 'headteacher_name' },
  //           { data: 'headteacher_phone', name: 'headteacher_phone' },
  //           { data: 'actions', name: '<?php echo e(trans('global.actions')); ?>' }
  //       ],
  //   });
  //   if (table) {console.log(table)}
  // });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/admin/transfer/index.blade.php ENDPATH**/ ?>