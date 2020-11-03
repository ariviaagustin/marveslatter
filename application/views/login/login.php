<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MENKO MARITIM | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link href="<?php echo base_url('assets/img/LogoKemenkoMaritim.PNG')?>" rel="icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="<?php echo site_url('assets/img/logo_marlet.png'); ?>" width = "100%">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <!-- <p class="login-box-msg">Sign in to start your session</p> -->
      <center><b><span style="font-size: 40px">Log In</span></b></center>
      <hr>
      <?php
          if($this->session->userdata("msg2")){ ?>
          <div class="alert alert-warning alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
              <span><i class="fa fa-exclamation"></i> Username atau Password Salah.</span>
          </div>
      <?php } ?>
      <?php
          if($this->session->userdata("msg3")){ ?>
          <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
              <span><i class="fa fa-exclamation-triangle"></i> Akun Belum Terdaftar</span>
          </div>
      <?php } ?>
      <form class="form-signin" method="POST" action="<?php echo site_url('Login/aksi_login');?>">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" autofocus required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">LOGIN <i class="fa fa-arrow-right"></i></button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <hr>
        <p style="font-size: 13px">Copyright © 2020 - maritim.go.id - All rights reserved.</p>
        <!-- <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a> -->
      </div>
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo site_url(); ?>assets/new/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo site_url(); ?>assets/new/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo site_url(); ?>assets/new/dist/js/adminlte.min.js"></script>

</body>
</html>
