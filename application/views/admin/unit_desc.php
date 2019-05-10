<?php $this->load->view('headerfooter/header_admin'); ?>
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data
      <small>kehadiran magang</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo site_url('Report') ?>"><i class="fa fa-table"></i> Unit</a></li>
      <li class="<?php echo active_link('Report/add_perdate'); ?>"><a href="#">Form Deskripsi</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
    <form role="form" action="<?php echo $action; ?>" method="post">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Siswa Magang Aktif</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <textarea name="description" class="textarea" placeholder="Place some text here"
                          style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $description; ?></textarea>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input name="unit_id" value="<?php echo $id; ?>" hidden>
              <button type="submit" class="btn btn-primary pull-right">Simpan</button>
            </div>
          <!-- /.box-header -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('headerfooter/footer_admin'); ?>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
$(function () {
  //bootstrap WYSIHTML5 - text editor
  $('.textarea').wysihtml5()
})
</script>
</body>
</html>