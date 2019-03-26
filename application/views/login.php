<?php $this->load->view('headerfooter/header_guest'); ?>

<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <img src="<?php echo base_url() ?>assets/dist/img/perpustakaan.png" height="64">
    </div>
    <!-- /.login-logo -->
    <?php if ($this->session->has_userdata('edit_success')) { ?>
     <div class="alert alert-success alert-dismissible" style="margin-top:30px;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-check-circle"></i><?php echo $this->session->flashdata('edit_success'); ?>
      </div>
    <?php } ?>
    <?php if ($this->session->has_userdata('email_success')) { ?>
     <div class="alert alert-info alert-dismissible" style="margin-top:30px;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-info"></i><?php echo $this->session->flashdata('email_success'); ?>
      </div>
    <?php } ?>
    <?php if ($this->session->has_userdata('login_message')) { ?>
     <div class="alert alert-danger alert-dismissible" style="margin-top:30px;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-ban"></i><?php echo $this->session->flashdata('login_message'); ?>
      </div>
    <?php } ?>
    <div class="login-box-body">
        <p class="login-box-msg">Masuk untuk memulai sesi anda</p>
        <div class="main_panel">
            <form role="form" action="" method="post">
              <div class="form-group has-feedback">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="social-auth-links">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
          </div>
           <a href="" data-toggle="modal" data-target="#modal-reset">Lupa password?</a>
      </form>
  </div>
</div>
</div>
<!-- /.login-box-body -->
<div class="modal modal-info fade" id="modal-reset">
    <div class="modal-dialog">
      <div class="modal-content">
        <form role="form" action="<?php echo site_url('ResetPassword/reset'); ?>" method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Data Pengunjung</h4>
        </div>
        <div class="modal-body">
          <p>Pemberitahuan reset password akan dikirimkan ke email admin buku tamu digital perpustakaan Bank Indonesia Riau</p>
          <small>Dengan memilih kirim maka pemberitahuan akan dikirimkan ke email yang terdaftar.</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline">Kirim</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
  })
})
</script>
</body>
</html>