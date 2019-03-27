<?php $this->load->view('headerfooter/header_admin'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data
        <small>siswa magang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <form role="form" action="<?php echo $action; ?>" method="post">
            <div class="box-header with-border">
              <h3 class="box-title">Data Siswa Magang</h3>
            </div>
            <!-- /.box-header -->
            <div style="padding-top: 10px;"></div>
            <div class="box-body no-padding">
              <div class="form-group col-xs-12">
                <label>NIM</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-credit-card"></i>
                  </div>
                  <input type="text" class="form-control" name="id_number" value="<?php echo $id_number;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="col-xs-6">
                <label>Nama Pengunjung</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                  </div>
                  <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="col-xs-6">
                <label>Jenis Kelamin</label>
                <div class="form-group has-feedback">
                  <select class="form-control" name="sex" required>
                      <option value="Tidak diketahui" selected hidden>Jenis Kelamin</option>
                      <option value="Laki-laki" <?php if($sex == "Laki-laki") echo 'selected="selected"';?> >Laki-laki</option>
                      <option value="Perempuan" <?php if($sex == "Perempuan") echo 'selected="selected"';?> >Perempuan</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="col-xs-6">
                <label>Status</label>
                <div class="form-group has-feedback">
                  <select class="form-control" name="active" required>
                    <option value="Tidak diketahui" selected hidden>Status</option>
                    <option value="Aktif" <?php if($active == "Aktif") echo 'selected="selected"';?> >Aktif</option>
                    <option value="Non Aktif" <?php if($active == "Non Aktif") echo 'selected="selected"';?> >Non Aktif</option>
                  </select>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group col-xs-6">
                <label>Asal</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-university"></i>
                  </div>
                  <input type="text" class="form-control" name="collage" value="<?php echo $collage;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group col-xs-12">
                <label>Alamat</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-home"></i>
                  </div>
                  <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input name="student_id" value="<?php echo $student_id;?>" hidden>
              <button type="reset" class="btn btn-default">Reset</button>
              <button type="submit" class="btn btn-primary pull-right">Simpan</button>
            </div>
          </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('headerfooter/footer_admin'); ?>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
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