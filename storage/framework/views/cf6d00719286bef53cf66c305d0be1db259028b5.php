<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Styles -->
    <link href="<?php echo e(asset('public/adminLTE/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/font-awesome/css/fontawesome-all.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/adminLTE/dist/css/AdminLTE.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/adminLTE/dist/css/skins/skin-blue.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/adminLTE/plugins/datatables/dataTables.bootstrap.css')); ?>" rel="stylesheet">
    
    <link href="<?php echo e(asset('public/adminLTE/plugins/datepicker/datepicker3.css')); ?>" rel="stylesheet">

</head>
<body class="hold-transition skin-blue sidebar-mini">
    
      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>HM</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Hey</b>Mart</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?php echo e(asset('public/images/'.Auth::user()->foto)); ?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo e(Auth::user()->name); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?php echo e(asset('public/images/'.Auth::user()->foto)); ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo e(Auth::user()->name); ?>

                    </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo e(route('user.profil')); ?>" class="btn btn-default btn-flat">Profile</a>
                      
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo e(route('logout')); ?>" class="btn btn-default btn-flat"
                      onclick="event.preventDefault();document.getElementByID('logout-form').submit();">Logout</a>
                      
                      <form class="" action="#" method="post" style="display: none;">
                        <?php echo e(csrf_field()); ?>

                      </form>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>


    

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
          <li class="header">MENU NAVIGASI</li>
          <!-- Optionally, you can add icons to the links -->
          <li class="active"><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

          <?php if( Auth::user()->level == 1 ): ?>

          

          <li><a href="<?php echo e(route('kategori.index')); ?>"><i class="fa fa-cube"></i> <span>Kategori</span></a></li>
          <li><a href="<?php echo e(route('produk.index')); ?>"><i class="fa fa-cubes"></i> <span>Produk</span></a></li>
          <li><a href="<?php echo e(route('member.index')); ?>"><i class="fa fa-credit-card"></i> <span>Member</span></a></li>
          <li><a href="<?php echo e(route('supplier.index')); ?>"><i class="fa fa-truck"></i> <span>Supplier</span></a></li>
          <li><a href="<?php echo e(route('pengeluaran.index')); ?>"><i class="fa fa-money-bill-alt"></i> <span>Pengeluaran</span></a></li>
          <li><a href="<?php echo e(route('user.index')); ?>"><i class="fa fa-user"></i> <span>User</span></a></li>
          <li><a href="<?php echo e(route('penjualan.index')); ?>"><i class="fa fa-upload"></i> <span>Penjualan</span></a></li>
          <li><a href="<?php echo e(route('pembelian.index')); ?>"><i class="fa fa-download"></i> <span>Pembelian</span></a></li>
          <li><a href="#"><i class="fa fa-file-pdf"></i> <span>Laporan</span></a></li>
          <li><a href="#"><i class="fa fa-cogs"></i> <span>Setting</span></a></li>

          <?php else: ?>

          
          <li><a href="#"><i class="fa fa-shopping-cart"></i> <span>Transaksi</span></a></li>
          <li><a href="#"><i class="fa fa-cart-plus"></i> <span>Transaksi Baru</span></a></li>

          <?php endif; ?>

        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?php echo $__env->yieldContent('title'); ?>
        </h1>
        <ol class="breadcrumb">
          <?php $__env->startSection('breadcrumb'); ?>
          <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
          <?php echo $__env->yieldSection(); ?>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Your Page Content Here -->
        <?php echo $__env->yieldContent('content'); ?>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        Aplikasi POS oleh: Hendra Gunawan
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2018 <a href="#">Company</a>.</strong> All rights reserved.
    </footer>

    <!-- Scripts -->
    <script src="<?php echo e(asset('public/adminLTE/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/adminLTE/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/adminLTE/dist/js/app.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/adminLTE/plugins/chartjs/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/adminLTE/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/adminLTE/plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
    
    <script src="<?php echo e(asset('public/adminLTE/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('public/js/validator.min.js')); ?>"></script>
    <!-- <script src="<?php echo e(asset('js/app.js')); ?>"></script> -->

    <?php echo $__env->yieldContent('script'); ?>
</body>
</html>
