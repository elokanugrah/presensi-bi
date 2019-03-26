<?php $this->load->view('headerfooter/header_guest'); ?>

<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <img src="<?php echo base_url() ?>assets/dist/img/perpustakaan.png" height="64">
      </div>
    <!-- /.login-logo -->
    <?php if ($this->session->has_userdata('success_message')) { ?>
      <div class="alert alert-success alert-dismissible" style="margin-top:20px;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-check"></i><?php echo $this->session->flashdata('success_message'); ?>
      </div>
    <?php } ?>
    <?php if ($this->session->has_userdata('failed_message')) { ?>
      <div class="alert alert-info alert-dismissible" style="margin-top:20px;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-info"></i><?php echo $this->session->flashdata('failed_message'); ?>
      </div>
    <?php } ?>
    <div class="login-box-body">
        <p class="login-box-msg">Rekomendasi Buku Perpustakaan</p>
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
            <div class="form-group has-feedback">
                <select class="form-control select2" name="type" style="width: 100%;" required>
                    <option value="" disabled selected hidden>Jenis Buku</option>
                    <?php foreach ($data_booktype as $key => $row) {?>
                    <option value="<?php echo $row->booktype_name; ?>" ><?php echo $row->booktype_name; ?></option>
                    <?php } ?>
                </select>
              </div>
            <div class="form-group has-feedback">
                <textarea class="form-control" name="title" rows="4" placeholder="Judul Buku" required></textarea>
                <span class="glyphicon glyphicon-book form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" name="author" class="form-control" placeholder="Pengarang" required>
                <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" name="version" class="form-control" placeholder="Versi / Edisi (Optional)">
                <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" name="publisher" class="form-control" placeholder="Penerbit (Optional)">
                <span class="fa fa-university form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" name="publication_year" class="form-control" data-inputmask='"mask": "9999"' data-mask placeholder="Tahun Terbit (Optional)">
                <span class="fa fa-calendar form-control-feedback"></span>
            </div>
            <div class="social-auth-links">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
            </div>
            <a href="<?php echo site_url('/') ?>">Kembali ke buku tamu</a>
      </form>
    </div>
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
<!-- InputMask -->
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    })
    //Money Euro
    $('[data-mask]').inputmask()
})
</script>
</body>
</html>