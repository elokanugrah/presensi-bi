<?php $this->load->view('headerfooter/header_admin'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data
        <small>kehadiran magang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Report') ?>"><i class="fa fa-files-o"></i> Laporan Rekapitulasi</a></li>
        <li class="<?php echo active_link('Report/add_perdate'); ?>"><a href="#">Form Pertanggal</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <div class="col-xs-12">
      <?php if ($this->session->has_userdata('input_success')) { ?>
      <div class="alert alert-success alert-dismissible" style="margin-top:30px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-check-circle"></i><?php echo $this->session->flashdata('input_success'); ?>
        </div>
      <?php } ?>
      <?php if ($this->session->has_userdata('edit_success')) { ?>
      <div class="alert alert-info alert-dismissible" style="margin-top:30px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-check-circle"></i><?php echo $this->session->flashdata('edit_success'); ?>
        </div>
        <?php } ?>
        <?php if ($this->session->has_userdata('delete_success')) { ?>
      <div class="alert alert-danger alert-dismissible" style="margin-top:30px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-check-circle"></i><?php echo $this->session->flashdata('delete_success'); ?>
        </div>
        <?php } ?>
    </div>
    <section class="content">
      <div class="row">
      <form role="form" action="<?php echo $action; ?>" method="post">
        <div class="col-xs-9">
          <?php date_default_timezone_set("Asia/Bangkok"); ?>
          <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Daftar Siswa Magang Aktif</h3>
              </div>
              <!-- /.box-header -->
              <div style="padding-top: 10px;"></div>
              <div class="box-body no-padding">
                <?php foreach ($data_student as $key => $row) {?>
                <input name="student_id<?php echo $key; ?>" value="<?php echo $row->student_id; ?>" hidden>
                <div class="form-group col-xs-2">
                  <label>Nomor Identitas</label>
                  <div class="input-group">
                    <?php echo $row->id_number; ?>
                    <input type="text" value="<?php echo $row->id_number; ?>" hidden>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group col-xs-3">
                  <label>Nama</label>
                  <div class="input-group">
                    <?php echo $row->name; ?>
                    <input type="text" value="<?php echo $row->name; ?>" hidden>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group col-xs-2">
                  <label for="inputTimeIn" class="control-label">Waktu Masuk</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="glyphicon glyphicon-time"></i>
                      </div>
                      <input type="text" name="time_in<?php echo $key; ?>" class="form-control timepicker" value="<?php echo date('H:i:s'); ?>">
                    </div>
                </div>
                <!-- /.form group -->
                <div class="form-group col-xs-2">
                  <label for="inputTimeIn" class="control-label">Waktu Keluar</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="glyphicon glyphicon-time"></i>
                      </div>
                      <input type="text" name="time_out<?php echo $key; ?>" class="form-control timepicker" value="<?php echo date('H:i:s'); ?>">
                    </div>
                </div>
                <!-- /.form group -->
                <div class="form-group col-xs-3">
                  <label class="control-label">Kehadiran</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-list-alt"></i>
                    </div>
                    <div class="form-group has-feedback">
                      <select class="form-control" name="note<?php echo $key; ?>" required>
                          <option value="" selected hidden>Kehadiran</option>
                          <option value="Hadir">Hadir</option>
                          <option value="Alpha">Alpha</option>
                          <option value="Sakit">Sakit</option>
                          <option value="Izin">Izin</option>
                      </select>
                    </div>
                  </div>
                </div>
                <?php }?> 
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input name="member_id" value="" hidden>
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-primary pull-right">Simpan</button>
              </div>
            <!-- /.box-header -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-xs-3">
          <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Tanggal dan Waktu</h3>
              </div>
              <!-- /.box-header -->
              <div style="padding-top: 10px;"></div>
              <div class="box-body no-padding">
                <div class="form-group col-xs-12">
                  <label for="inputTimeIn" class="control-label">Tanggal</label>
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="date_in" class="form-control" id="datepicker" value="<?php echo date('d-M-Y'); ?>">
                    </div>
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.box-body -->
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
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

    //Timepicker
    $('.timepicker').timepicker({
        showInputs: false,
        showMeridian: false,
        minuteStep: 5,
        secondStep: 10,
        showSeconds: true
      }).on('changeTime.timepicker', function(e) {
      var hours=e.time.hours, //Returns an integer
          min=e.time.minutes
          sec=e.time.seconds
      if(hours < 10) {
        if(min < 10 && sec < 10){
          $(e.currentTarget).val('0' + hours + ':' + '0' + min + ':' + '0' + sec);
        }
        else if(min >= 10 && sec < 10){
          $(e.currentTarget).val('0' + hours + ':' + min + ':' + '0' + sec);
        }
        else if(min < 10 && sec >= 10){
          $(e.currentTarget).val('0' + hours + ':' + '0' + min + ':' + sec);
        }
        else{
          $(e.currentTarget).val('0' + hours + ':' + min + ':' + sec);
        }
      }
    })

    //Date picker
    $('#datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom auto",
      todayHighlight: true,  
    })

    $('#datepicker2').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom auto",
      todayHighlight: true,  
    })
  })
</script>
<script src="<?php echo base_url() ?>assets/dist/js/sweetalert2.all.min.js"></script>
</body>
</html>