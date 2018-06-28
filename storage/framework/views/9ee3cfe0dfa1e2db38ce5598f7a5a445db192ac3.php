<?php $__env->startSection('title'); ?>
  Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
  ##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
  <li>Dashboard</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <h1>Selamat Datang</h1>
          <h2>Anda login sebagai Admin</h2>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>