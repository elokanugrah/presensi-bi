<?php $this->load->view('headerfooter/header_guest'); ?>

<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <img src="<?php echo base_url() ?>assets/dist/img/perpustakaan.png" height="64">
      </div>
    <!-- /.login-logo -->
    <?php if ($this->session->has_userdata('input_success')) { ?>
      <div class="alert alert-success alert-dismissible" style="margin-top:20px;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-check"></i><?php echo $this->session->flashdata('input_success'); ?>
      </div>
    <?php } ?>
    <?php if ($this->session->has_userdata('guest_message')) { ?>
      <div class="alert alert-warning alert-dismissible" style="margin-top:20px;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-warning"></i><?php echo $this->session->flashdata('guest_message'); ?>
      </div>
    <?php } ?>
    <?php if ($this->session->has_userdata('failed_message')) { ?>
      <div class="alert alert-warning alert-dismissible" style="margin-top:20px;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-warning"></i><?php echo $this->session->flashdata('failed_message'); ?>
      </div>
    <?php } ?>
    <div class="login-box-body">
        <p class="login-box-msg">Identitas Pengunjung Perpustakaan</p>
        <div class="main_panel">
            <form role="form" action="" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="id_number" class="form-control" placeholder="Nomor Identitas" required>
                <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" name="name" class="form-control" placeholder="Nama Pengunjung" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="social-auth-links">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
            </div>
            <a href="<?php echo site_url('BookRecomendation') ?>">Rekomendasikan buku baru</a>
      </form>
  </div>
  <?php if ($this->session->has_userdata('guest_message')) { ?>
  <style type="text/css">
  div.main_panel
  {
    display:none;
  }
  </style>
<div class="second_panel">
    <form role="form" action="<?php echo site_url('GuestBook/register_action');?>" method="post">
      <div class="form-group has-feedback">
          <input type="text" name="id_number" class="form-control" placeholder="Nomor identitas Pegawai/Pelajar" value="<?php echo $this->session->flashdata('id_number'); ?>" required>
          <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="name" class="form-control" placeholder="Nama Pengunjung" value="<?php echo $this->session->flashdata('name'); ?>" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="social-auth-links text-center">
      <p>- Lengkapi form dibawah ini -</p>
  </div>
  <div class="form-group has-feedback">
    <select class="form-control" name="sex" style="width: 100%;" required>
        <option value="" selected hidden>Jenis Kelamin</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>
  </div>
  <?php 
  $occupation=$this->Occupation_model->getall_data();
  ?>
  <div class="form-group has-feedback">
    <select class="form-control select2" name="occupation" style="width: 100%;" required>
        <option value="" disabled selected hidden>Status</option>
        <?php foreach ($occupation as $key => $row) {?>
        <option value="<?php echo $row->occupation_name; ?>" ><?php echo $row->occupation_name; ?></option>
        <?php } ?>
    </select>
  </div>
  <div class="form-group has-feedback">
    <input type="text" name="instance" class="form-control" placeholder="Instansi" required>
      <span class="fa fa-university form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <textarea class="form-control" name="address" rows="4" placeholder="Alamat" required></textarea>
    <span class="glyphicon glyphicon-home form-control-feedback"></span>
  </div>
<div class="social-auth-links text-center">
  <button type="submit" class="btn btn-primary btn-block btn-flat">Daftarkan</button>
</form>
</div>
<?php } ?>
</div>
</div>
<!-- /.login-box-body -->
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