<?php $this->load->view('headerfooter/header_admin'); ?>
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-eye-open"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Hari Ini</span>
              <span class="info-box-number"></span>
              <small>kunjungan</small>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-signal"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">7 Hari Terakhir</span>
              <span class="info-box-number"></span>
              <small>kunjungan</small>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Rekomendasi</span>
              <span class="info-box-number"></span>
              <small>buku</small>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tamu Terdaftar</span>
              <span class="info-box-number"></span>
              <small>orang</small>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-6">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Kunjungan tiap minggu</a></li>
              <li><a href="#tab_2" data-toggle="tab">Kunjungan tiap tahun</a></li>
            </ul>
            <div class="tab-content no-padding">
              <div class="tab-pane active" id="tab_1">
                <script src="<?php echo base_url() ?>assets/code/highcharts.js"></script>
                <script src="<?php echo base_url() ?>assets/code/modules/exporting.js"></script>
                <script src="<?php echo base_url() ?>assets/code/modules/export-data.js"></script>
                <div class="col-md-10">
                  <label>Minggu</label>
                </div>
                <div class="col-md-12">
                  <select class="form-control select2" name="select1" id="select1">
                    <option value="1">Minggu ini</option>
                    <option value="2">Minggu lalu</option>
                    <option value="3">2 Minggu lalu</option>
                    <option value="4">3 Minggu lalu</option>
                  </select>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                  <script src="<?php echo base_url() ?>assets/code/modules/data.js"></script>
                  <script src="<?php echo base_url() ?>assets/code/modules/drilldown.js"></script>
                  <div id="container" style="margin: 0 auto"></div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <!-- MAP & BOX PANE -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Kriteria Pengunjung</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body no-padding">
              <!-- Date -->
              <form role="form" action="" method="post">
              <div class="form-group has-feedback">
                <div class="col-md-10">
                  <label>Tanggal</label>
                </div>
                <div class="col-md-10">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="date" class="form-control pull-right" id="reservation" value="">
                  </div>
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-info btn-block btn-flat">Lihat</button>
                </div>
                <!-- /.input group -->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="pad">
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-8">
          <!-- MAP & BOX PANE -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Rekomendasi Buku</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body no-padding">
              <!-- Date -->
              <div class="form-group has-feedback">
                <div class="col-md-10">
                  <label>Tanggal</label>
                </div>
                <div class="col-md-10">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="date1" class="form-control pull-right" id="reservation1" value="">
                  </div>
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-warning btn-block btn-flat">Lihat</button>
                </div>
                <!-- /.input group -->
              </div>
              </form>
              <!-- /.form group -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="pad">
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <!-- MAP & BOX PANE -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Rekomendasi Buku</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body no-padding">
            </div>
            <!-- /.box-header -->
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
<!-- date-range-picker -->
<script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
  $(function () {
    //Date range picker
    $('#reservation').daterangepicker({
        locale: {
            format: 'DD-MMM-YYYY'
        }
    })
    $('#reservation1').daterangepicker({
        locale: {
            format: 'DD-MMM-YYYY'
        }
    })
    $('#container_thisweek').show();
    $('#container_lastweek').hide();
    $('#container_twoweekago').hide();
    $('#container_threeweekago').hide();
    $('#select1').on('change', function(event) {
        var opt = this.options[ this.selectedIndex ];
        var minggu_ini = $(opt).text().match(/Minggu ini/);
        var minggu_lalu = $(opt).text().match(/Minggu lalu/);
        var dua_minggu_lalu = $(opt).text().match(/2 Minggu lalu/);
        var tiga_minggu_lalu = $(opt).text().match(/3 Minggu lalu/);
        if(minggu_ini) {
            $('#container_thisweek').show();
            $('#container_lastweek').hide();
            $('#container_twoweekago').hide();
            $('#container_threeweekago').hide();
        } 
        if(minggu_lalu) {
            $('#container_thisweek').hide();
            $('#container_lastweek').show();
            $('#container_twoweekago').hide();
            $('#container_threeweekago').hide();
        }
        if(dua_minggu_lalu) {
            $('#container_thisweek').hide();
            $('#container_lastweek').hide();
            $('#container_twoweekago').show();
            $('#container_threeweekago').hide();
        }
        if(tiga_minggu_lalu) {
            $('#container_thisweek').hide();
            $('#container_lastweek').hide();
            $('#container_twoweekago').hide();
            $('#container_threeweekago').show();
        }
    })
  })
</script>
</body>
</html>