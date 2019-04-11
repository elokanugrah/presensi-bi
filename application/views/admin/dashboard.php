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
        <li class="<?php echo active_link('Dashboard'); ?>"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-time"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jam Kerja</span>
              <span class="info-box-number"><?php
              $date_a = new DateTime($working_hours->time_in);
              $date_b = new DateTime($working_hours->time_out);
              $interval = date_diff($date_a,$date_b);
              echo $working_hours->time_in.' - '.$working_hours->time_out; ?></span>
              <small><?php echo $interval->format('%h jam %i menit'); ?> (termasuk istirahat)</small>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Mentor</span>
              <span class="info-box-number"><?php echo $mentor; ?></span>
              <small>orang</small>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Siswa Magang Aktif</span>
              <span class="info-box-number"><?php echo $active_student; ?></span>
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
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-calendar-check-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sudah presensi</span>
              <span class="info-box-number"><?php echo $already_notyet->ontime; ?> orang</span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo $already_notyet->ontime_percentage; ?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo round($already_notyet->ontime_percentage); ?>%
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-calendar-times-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Belum presensi</span>
              <span class="info-box-number"><?php echo $already_notyet->nan; ?> orang</span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo $already_notyet->nan_percentage; ?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo round($already_notyet->nan_percentage); ?>%
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Asal Siswa Magang (Aktif)</a></li>
              <li><a href="#tab_2" data-toggle="tab">Asal Siswa Magang Pertahun</a></li>
            </ul>
            <div class="tab-content no-padding">
              <div class="tab-pane active" id="tab_1">
                <script src="<?php echo base_url() ?>assets/code/highcharts.js"></script>
                <script src="<?php echo base_url() ?>assets/code/modules/exporting.js"></script>
                <script src="<?php echo base_url() ?>assets/code/modules/export-data.js"></script>
                <div id="container_origin" style="margin: 0 auto"></div>
                <script type="text/javascript">
                Highcharts.chart('container_origin', {
                    chart: {
                        type: 'pie'
                    },
                    title: {
                        text: 'Kriteria buku yang direkomendasikan'
                    },
                    subtitle: {
                        text: 'Pilih kolom untuk melihat judul buku'
                    },
                    plotOptions: {
                        series: {
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}: {point.percentage:.1f}%'
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> kali<br/>'
                    },
                    "series": [
                        {
                        name: 'Rekomendasi',
                        colorByPoint: true,
                        data: [
                        <?php
                            foreach ($origin as $key => $row) {
                        ?>
                        {
                            name: '<?php echo $row->collage; ?>',
                            y: <?php echo $row->total; ?>,
                            drilldown: '<?php echo $row->collage; ?>'
                        },
                        <?php } ?>
                        ]
                    }],
                    "drilldown": {
                        "series": [
                          ]
                        }
                });
                </script>
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
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Kehadiran</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body no-padding">
              <!-- Date -->
              <form role="form" action="" method="get">
              <div class="form-group has-feedback">
                <div class="col-md-10">
                  <label>Tanggal</label>
                </div>
                <div class="col-md-12">
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="date" class="form-control pull-right" id="reservation1" value="<?php echo $date; ?>">
                    <div class="input-group-addon">
                      <button type="submit" class="btn btn-warning btn-sm badge mt-1">Lihat</button>
                      <a href="<?php echo site_url('Dashboard') ?>" class="btn btn-default btn-sm badge mt-1">Reset</a>
                    </div>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="pad">
                    <div id="container_recap" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                  </div>
                  <script type="text/javascript">
                  var days = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
                  Highcharts.chart('container_recap', {
                  title: {
                      text: 'Kehadiran dan Keterlambatan'
                  },
                  xAxis: {
                      categories: [
                        <?php 
                        date_default_timezone_set("Asia/Bangkok");
                        $hari = array ( 
                                1 => 'Senin',
                                'Selasa',
                                'Rabu',
                                'Kamis',
                                'Jumat',
                                'Sabtu',
                                'Minggu'
                              ); 
                        foreach ($data_attendance as $key => $row) {
                          $dateday=$hari[ date('N', strtotime($row->date)) ] .', '. date("d M Y", strtotime($row->date));
                          echo "'$dateday'".','; 
                        } ?> 
                      ,]
                  },
                  yAxis: {
                      allowDecimals: false,
                      min: 0,
                      title: {
                          text: 'Total kehadiran'
                      },
                      stackLabels: {
                          enabled: true,
                          style: {
                              fontWeight: 'bold',
                              color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                          }
                      }
                  },
                  tooltip: {
                      headerFormat: '<b>{series.name}</b><br/>',
                      pointFormat: '{point.y} orang'
                  },
                  plotOptions: {
                      column: {
                          stacking: 'normal',
                          dataLabels: {
                              enabled: true,
                              color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                          }
                      }
                  },
                  series: [
                  {
                      type: 'column',
                      name: 'Tanpa Keterangan',
                      data: [
                      <?php foreach ($data_attendance as $key => $row) {
                          $count = $this->Attendance_model->get_countperdate($row->date);
                          if ($count->nan != 0) {
                            echo $count->nan.',';
                          } else {
                            echo 'null'.',';
                          }  
                        } ?>
                      ]
                  },
                  {
                      type: 'column',
                      name: 'Alpha',
                      data: [
                      <?php foreach ($data_attendance as $key => $row) {
                          $count = $this->Attendance_model->get_countperdate($row->date);
                          if ($count->alpha != 0) {
                            echo $count->alpha.',';
                          } else {
                            echo 'null'.',';
                          } 
                        } ?>
                      ]
                  },
                  {
                      type: 'column',
                      name: 'Izin',
                      data: [
                      <?php foreach ($data_attendance as $key => $row) {
                          $count = $this->Attendance_model->get_countperdate($row->date);
                          if ($count->permit != 0) {
                            echo $count->permit.',';
                          } else {
                            echo 'null'.',';
                          } 
                        } ?>
                      ]
                  },
                  {
                      type: 'column',
                      name: 'Sakit',
                      data: [
                      <?php foreach ($data_attendance as $key => $row) {
                          $count = $this->Attendance_model->get_countperdate($row->date);
                          if ($count->sick != 0) {
                            echo $count->sick.',';
                          } else {
                            echo 'null'.',';
                          }
                        } ?>
                      ]
                  },
                  {
                      type: 'column',
                      name: 'Hadir',
                      data: [
                      <?php foreach ($data_attendance as $key => $row) {
                          $count = $this->Attendance_model->get_countperdate($row->date);
                          if ($count->present != 0) {
                            echo $count->present.',';
                          } else {
                            echo 'null'.',';
                          } 
                        } ?>
                      ]
                  },
                  {
                      type: 'spline',
                      name: 'Telat',
                      data: [<?php foreach ($data_attendance as $key => $row) {
                          $count = $this->Attendance_model->get_countperdate($row->date);
                          echo $count->late.','; 
                        } ?>
                          ],
                      marker: {
                          lineWidth: 2,
                          lineColor: Highcharts.getOptions().colors[8],
                          fillColor: 'white'
                      }
                  }]
              });
                      </script>
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
        <div class="col-md-12">
          
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