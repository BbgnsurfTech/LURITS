<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(trans('panel.site_title')); ?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('img/favicon/favicon.ico')); ?>">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/normalize.css')); ?>">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/all.min.css')); ?>">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('fonts/flaticon.css')); ?>">
    <!-- Full Calender CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/fullcalendar.min.css')); ?>">
    <link href="<?php echo e(asset('css/dropzone.min.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('css/select2.min.css')); ?>" rel="stylesheet" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/animate.min.css')); ?>">
     <!-- Data Table CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/buttons.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/responsive.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/searchPanes.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/select.dataTables.min.css')); ?>">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/datepicker.min.css')); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/icons.min.css')); ?>">
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="<?php echo e(asset('css/sweetalert2.min.css')); ?>">
     
    

    <!-- Modernize js -->
    <script src="<?php echo e(asset('js/modernizr-3.6.0.min.js')); ?>"></script>

    <style type="text/css">
    .container {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
    .container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
      border-radius: 50%;
    }
    .container:hover input ~ .checkmark {
      background-color: #ccc;
    }
    .container input:checked ~ .checkmark {
      background-color: #f0b247;
    }
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }
    .container input:checked ~ .checkmark:after {
      display: block;
    }
    .container .checkmark:after {
      top: 9px;
      left: 9px;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: white;
    }  

    .spinner {
       position: absolute;
        top:0px;
        right:0px;
        width:100%;
        height:100%;
        background-color:#eceaea;
        background-image:url(<?php echo e(config('app.url')); ?>/loader.svg);
        background-size: 100%;
        background-repeat:no-repeat;
        background-position:center;
        z-index:10000000;
        opacity: 0.4;
        filter: alpha(opacity=40);
    }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!--Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
       <!-- Header Menu Area Start Here -->
        <div class="navbar navbar-expand-md header-menu-one bg-light">
            <div class="nav-bar-header-one">
                <div class="header-logo">
                    <a href="<?php echo e(route('admin.home')); ?>">
                        <img src="<?php echo e(asset('img/logo.png')); ?>" alt="logo">
                    </a>
                </div>
                 <div class="toggle-button sidebar-toggle">
                    <button type="button" class="item-link">
                        <span class="btn-icon-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="d-md-none mobile-nav-bar">
               <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
                    <i class="far fa-arrow-alt-circle-down"></i>
                </button>
                <button type="button" class="navbar-toggler sidebar-toggle-mobile">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
                <ul class="navbar-nav">
                    <li class="navbar-item header-search-bar">
                        <div class="input-group stylish-input-group">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="flaticon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                            <input type="text" class="searchable-field form-control" placeholder="Find Something . . .">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="navbar-item dropdown header-admin">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="admin-title">
                                <h5 class="item-title"><?php echo e(Auth::user()->name); ?></h5>
                                
                            </div>
                            <div class="admin-img">
                                <img src="<?php echo e(asset('img/figure/default_avatar.png')); ?>" alt="Admin">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title"><?php echo e(Auth::user()->name); ?></h6>
                            </div>
                            <div class="item-content">
                                <ul class="settings-list">
                                    <li><a href="#"><i class="flaticon-user"></i>My Profile</a></li>
                                    <li><a href="#"><i class="flaticon-list"></i>Task</a></li>
                                    <li><a href="#"><i class="flaticon-gear-loading"></i>Account Settings</a></li>
                                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            
                                <i class="fas  fa-sign-out-alt"></i>
                                <span><?php echo e(trans('global.logout')); ?></span>
                        </a>
                    </li>   
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="navbar-item dropdown header-message">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="far fa-envelope"></i>
                            <div class="item-title d-md-none text-16 mg-l-10">Message</div>
                            <span><?php echo e($unread = \App\QaTopic::unreadCount()); ?></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                               <a href="<?php echo e(route("admin.messenger.index")); ?>" class="<?php echo e(request()->is('admin/messenger') || request()->is('admin/messenger/*') ? 'active' : ''); ?> nav-link"> <h6 class="item-title"><?php echo e($unread = \App\QaTopic::unreadCount()); ?> Unread Message</h6></a>
                            </div>
                            
                        </div>
                    </li>
                    
                      <!-- Right navbar links -->
            <?php if(count(config('panel.available_languages', [])) > 1): ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <?php echo e(strtoupper(app()->getLocale())); ?>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <?php $__currentLoopData = config('panel.available_languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langLocale => $langName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="dropdown-item" href="<?php echo e(url()->current()); ?>?change_language=<?php echo e($langLocale); ?>"><?php echo e(strtoupper($langLocale)); ?> (<?php echo e($langName); ?>)</a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </li>
                </ul>
            <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- Header Menu Area End Here -->
        
        <?php echo $__env->make('partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
        
            <div class="dashboard-content-one">
               
                <!-- Breadcubs Area End Here -->
                <!-- Babagana #define - message section -->
                  
                 <?php if(session('message')): ?>
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-success" role="alert"><?php echo e(session('message')); ?></div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-danger" role="alert"><?php echo e(session('error')); ?></div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($errors->count() > 0): ?>
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <!-- Babagana #enddefine - message section -->
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <ul>
                        <li>
                            <a href="<?php echo e(route("admin.home")); ?>">Home</a>
                        </li>
                        <li><?php echo e($activePage ?? 'Dashboard'); ?></li>
                        <li><?php echo e(Auth::user()->team_id ?? ''); ?><?php echo e(' | '); ?><?php echo e(Auth::user()->team->name ?? '(Super Admin) - All Schools'); ?></li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <?php echo $__env->yieldContent('content'); ?>
                <!-- Footer Area Start Here -->
                <footer class="footer-wrap-layout1">
                    <b>Version</b> 1.1.0-BETA
                    <div class="copyright">© Copyrights <a href="#">DataStamp | LURITS</a> 2021. All rights reserved. Designed by <a
                            href="#">Bbgnsurf Technologies</a></div>
                </footer>
                <!-- Footer Area End Here -->
                <form id="logoutform" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo e(csrf_field()); ?>

        </form>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="<?php echo e(asset('js/jquery-3.4.1.min.js')); ?>"></script>
    <!-- Plugins js -->
    <script src="<?php echo e(asset('js/plugins.js')); ?>"></script>
    <!-- Popper js -->
    <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <!-- Counterup Js -->
    <script src="<?php echo e(asset('js/jquery.counterup.min.js')); ?>"></script>
    <!-- Moment Js -->
    <script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>
    <!-- Waypoints Js -->
    <script src="<?php echo e(asset('js/jquery.waypoints.min.js')); ?>"></script>
    <!-- Scroll Up Js -->
    <script src="<?php echo e(asset('js/jquery.scrollUp.min.js')); ?>"></script>
    <!-- Full Calender Js -->
    <script src="<?php echo e(asset('js/fullcalendar.min.js')); ?>"></script>
     <!-- Data Table & buttons Js -->
    <script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/buttons.flash.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/dataTables.searchPanes.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/buttons.colVis.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/ckeditor.js')); ?>"></script>
    <script src="<?php echo e(asset('js/dataTables.select.min.js')); ?>"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo e(asset('js/datepicker.min.js')); ?>"></script>
    <!-- Select 2 Js -->
    <script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/dropzone.min.js')); ?>"></script>
    <!-- Chart Js -->
    <script src="<?php echo e(asset('js/Chart.min.js')); ?>"></script>
    <!-- Custom Js -->
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <!-- Sweetalert2 -->
    <script src="<?php echo e(asset('js/sweetalert2.all.min.js')); ?>"></script>
<!-- Babagana- Sweetalert success message on data save -->
<script>
    var hasmessage = <?php echo e(session('message') ? 'true' : 'false'); ?>;
    var msg = '<?php echo e(session('message') ??  false); ?>';
if (hasmessage) {
        Swal.fire({
        toast: true,
        position: 'top-end',
        icon: '<?php echo e(session('icon')); ?>',
        title: '<?php echo e(session('message')); ?>',
        showConfirmButton: false,
        timer: 1500
                });
            }
</script>
   
    <!--Babagana inherit from adminlte -->
<script>
        $(function() {
 
  let csvButtonTrans = '<?php echo e(trans('global.datatables.csv')); ?>'
  let excelButtonTrans = '<?php echo e(trans('global.datatables.excel')); ?>'
  let pdfButtonTrans = '<?php echo e(trans('global.datatables.pdf')); ?>'
  let printButtonTrans = '<?php echo e(trans('global.datatables.print')); ?>'
  let colvisButtonTrans = '<?php echo e(trans('global.datatables.colvis')); ?>'
  let selectAllButtonTrans = '<?php echo e(trans('global.select_all')); ?>'
  let selectNoneButtonTrans = '<?php echo e(trans('global.deselect_all')); ?>'

  let languages = {
    'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
        'fr': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/French.json',
        'pt': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese.json',
        'es': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json',
        'ar': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
        'hi': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Hindi.json'
  };

  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
  $.extend(true, $.fn.dataTable.defaults, {
    language: {
      url: languages['<?php echo e(app()->getLocale()); ?>']
    },
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
    order: [],
    scrollX: true,
    pageLength: 100,
    dom: 'lBfrtip<"actions">',
    buttons: [
      {
        extend: 'selectAll',
        className: 'btn-primary',
        text: selectAllButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'selectNone',
        className: 'btn-primary',
        text: selectNoneButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'csv',
        className: 'btn-info',
        text: csvButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'excel',
        className: 'btn-info',
        text: excelButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdf',
        className: 'btn-info',
        text: pdfButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'print',
        className: 'btn-info',
        text: printButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      /*{
        extend: 'colvis',
        className: 'btn-default',
        text: colvisButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      }*/   
    ]
  });

  $.fn.dataTable.ext.classes.sPageButton = '';
});

    </script>
    <script>
        $(document).ready(function() {
    $('.searchable-field').select2({
        minimumInputLength: 3,
        ajax: {
            url: '<?php echo e(route("admin.globalSearch")); ?>',
            dataType: 'json',
            type: 'GET',
            delay: 200,
            data: function (term) {
                return {
                    search: term
                };
            },
            results: function (data) {
                return {
                    data
                };
            }
        },
        escapeMarkup: function (markup) { return markup; },
        templateResult: formatItem,
        templateSelection: formatItemSelection,
        placeholder : '<?php echo e(trans('global.search')); ?>...',
        language: {
            inputTooShort: function(args) {
                var remainingChars = args.minimum - args.input.length;
                var translation = '<?php echo e(trans('global.search_input_too_short')); ?>';

                return translation.replace(':count', remainingChars);
            },
            errorLoading: function() {
                return '<?php echo e(trans('global.results_could_not_be_loaded')); ?>';
            },
            searching: function() {
                return '<?php echo e(trans('global.searching')); ?>';
            },
            noResults: function() {
                return '<?php echo e(trans('global.no_results')); ?>';
            },
        }

    });
    function formatItem (item) {
        if (item.loading) {
            return '<?php echo e(trans('global.searching')); ?>...';
        }
        var markup = "<div class='searchable-link' href='" + item.url + "'>";
        markup += "<div class='searchable-title'>" + item.model + "</div>";
        $.each(item.fields, function(key, field) {
            markup += "<div class='searchable-fields'>" + item.fields_formated[field] + " : " + item[field] + "</div>";
        });
        markup += "</div>";

        return markup;
    }

    function formatItemSelection (item) {
        if (!item.model) {
            return '<?php echo e(trans('global.search')); ?>...';
        }
        return item.model;
    }
    $(document).delegate('.searchable-link', 'click', function() {
        var url = $(this).attr('href');
        window.location = url;
    });
});

    </script>
  
    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH C:\Users\bbgnsurf\PhpStom Project\LURITS\DataStamp-LURITS_QA_v1.1\resources\views/layouts/admin.blade.php ENDPATH**/ ?>