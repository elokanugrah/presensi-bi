<?php $this->load->view('headerfooter/header_admin'); ?>
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Waktu
        <small>magang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <div class="col-xs-12">
        <?php if ($this->session->has_userdata('edit_success')) { ?>
      <div class="alert alert-info alert-dismissible" style="margin-top:30px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-check-circle"></i><?php echo $this->session->flashdata('edit_success'); ?>
        </div>
        <?php } ?>
    </div>
    <section class="content">
      <div class="row">
        <div class="col-xs-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Waktu kerja siswa magang</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" role="form" action="<?php echo $action; ?>" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputTimeIn" class="col-sm-2 control-label">Masuk</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <input type="text" name="time_in" class="form-control timepicker" value="<?php echo $time->time_in; ?>">

                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                    </div>
                  <!-- /.input group -->
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputTimeOut" class="col-sm-2 control-label">Pulang</label>

                  <div class="col-sm-10">
                    <div class="input-group">
                      <input type="text" name="time_out" class="form-control timepicker" value="<?php echo $time->time_out; ?>">

                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                    </div>
                  <!-- /.input group -->
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-info pull-right">Simpan</button>
              </div>
              <!-- /.box-footer -->
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
<!-- bootstrap time picker -->
<script src="<?php echo base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
  $(function () {
      //Timepicker
      $('.timepicker').timepicker({
        showInputs: false,
        showMeridian: false,
        minuteStep: 5
      }).on('changeTime.timepicker', function(e) {
      var hours=e.time.hours, //Returns an integer
          min=e.time.minutes
      if(hours < 10) {
        if(min < 10){
          $(e.currentTarget).val('0' + hours + ':' + '0' + min);
        }else{
          $(e.currentTarget).val('0' + hours + ':' + min);
        }
      }
    })
  })
</script>
</body>
</html>