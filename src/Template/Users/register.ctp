<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <?php $this->layout = false; ?>
    <?= $this->Html->charset() ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- <?//= $this->Html->css('base.css') ?>
    <?//= $this->Html->css('cake.css') ?> -->
    <?= $this->Html->css('AdminLTE.css') ?>
    <?= $this->Html->css('skin-blue.css') ?>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('blue.css') ?>
    <?= $this->Html->css('font-awesome.min.css') ?>
    <?= $this->Html->css('ionicons.min.css') ?>
      
</head>
    
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a style="text-decoration: none;" href="/home"><b>Books</b>Trade<small>.com</small></a>
  </div>
  <!-- /.login-logo -->
    <?= $this->Flash->render() ?>
  <div class="login-box-body">
    <p class="login-box-msg">Register a new membership with us</p>

    
      <!-- <?= $this->Form->create(); ?>
        	<?= $this->Form->input('name'); ?>
            <?= $this->Form->input('email'); ?>
            <?= $this->Form->input('password', array('type' =>'password')); ?>
            <?= $this->Form->submit('Register', array('class' => 'button')); ?>
        <?= $this->Form->end(); ?> -->
      
      <?= $this->Form->create(); ?>
      <div class="form-group has-feedback">
          <?= $this->Form->input('name', ['class' => 'form-control', 'placeholder' => 'Full Name']);?>
      </div>
      <div class="form-group has-feedback">
          <?= $this->Form->input('email', ['class' => 'form-control', 'placeholder' => 'Email']);?>
      </div>
      <div class="form-group has-feedback">
        <?= $this->Form->input('password', ['class' => 'form-control', 'placeholder' => 'password']);?>
      </div>
      <div class="form-group has-feedback">
        <?= $this->Form->input('confirmPassword', ['class' => 'form-control', 'placeholder' => 'Confirm Password']);?>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
            <?= $this->Form->submit('Register', array('class' => 'btn btn-primary btn-block btn-flat')); ?>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

    
    
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="/js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/js/bootstrap.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>


    <?= $this->Html->script('jquery-2.2.3.min.js'); ?>
    <?= $this->Html->script('app.min.js'); ?>
    <!-- <?= $this->Html->script('bootstrap.js'); ?> -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>


<!--------------------------------------------->












<!-----------------------------------------------------------
<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
    <div class="panel">
        <h2 class="text-center">Register</h2>
        <?= $this->Form->create(); ?>
        	<?= $this->Form->input('name'); ?>
            <?= $this->Form->input('email'); ?>
            <?= $this->Form->input('password', array('type' =>'password')); ?>
            <?= $this->Form->submit('Register', array('class' => 'button')); ?>
        <?= $this->Form->end(); ?>
    </div>
</div> -->
