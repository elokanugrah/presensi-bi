<?php $this->load->view('headerfooter/header_admin'); ?>
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- bootstrap toggle -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Sistem presensi magang KPw BI Riau</small>
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
        <!-- small box -->
        <div class="small-box bg-teal">
          <div class="inner">
            <h3>
              <?php
              $date_a = new DateTime($working_hours->time_in);
              $date_b = new DateTime($working_hours->time_out);
              $interval = date_diff($date_a,$date_b);
              echo $working_hours->time_in.' - '.$working_hours->time_out; ?>
            </h3>
            <p><?php echo $interval->format('%h jam %i menit'); ?> (termasuk istirahat)</p>
          </div>
          <div class="icon">
            <i class="fa fa-clock-o"></i>
          </div>
          <a href="<?php echo site_url('Workinghours') ?>" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-4 col-sm-6 col-xs-12">
        <!-- small box -->
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>
              <?php echo $mentor; ?>
            </h3>
            <p>Total Mentor</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="<?php echo site_url('Mentor') ?>" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>
              <?php echo $active_student; ?>
            </h3>
            <p>Siswa Magang Aktif</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="<?php echo site_url('StudentIntern') ?>" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="callout callout-info">
      Data terakhir <?php
      $hari = array ( 
                1 => 'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu'
              ); 
      $dateday=$hari[ date('N', strtotime($latest)) ] .', '. date("d M Y", strtotime($latest));
      echo $dateday; ?> 
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="info-box bg-green">
          <span class="info-box-icon"><i class="fa fa-calendar-check-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Sudah presensi</span>
            <span class="info-box-number"><?php echo $already_notyet->ontime; ?> <small>orang on time /</small> <?php echo $already_notyet->late; ?> <small>orang telat</small></span>

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
      <div class="col-md-5">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Asal Siswa Magang <span style="margin-left: 18px;"></span><input id="cbx_active" type="checkbox" checked data-toggle="toggle" data-size="mini" data-on="Aktif" data-off="Semua" data-onstyle="success"></a></li>
            <li><a href="#tab_2" data-toggle="tab">Jumlah</a></li>
          </ul>
          <div class="tab-content no-padding">
            <div class="tab-pane active" id="tab_1">
              <script src="<?php echo base_url() ?>assets/code/highcharts.js"></script>
              <script src="<?php echo base_url() ?>assets/code/modules/exporting.js"></script>
              <script src="<?php echo base_url() ?>assets/code/modules/export-data.js"></script>
              <script src="<?php echo base_url() ?>assets/code/modules/data.js"></script>
              <script src="<?php echo base_url() ?>assets/code/modules/drilldown.js"></script>
              <div id="container_activeorigin" style="margin: 0 auto; padding-top: 10px;"></div>
              <script type="text/javascript">
              Highcharts.chart('container_activeorigin', {
                  chart: {
                      type: 'pie'
                  },
                  title: {
                      text: 'Asal Siswa Magang Aktif'
                  },
                  subtitle: {
                      text: 'Klik kolom untuk melihat lebih lanjut'
                  },
                  plotOptions: {
                      series: {
                          dataLabels: {
                              enabled: true,
                              format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                              distance: -50,
                              filter: {
                                  property: 'percentage',
                                  operator: '>',
                                  value: 4
                              }
                          }
                      }
                  },

                  tooltip: {
                          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> orang<br/>'
                  },
                  "series": [
                      {
                      name: 'Asal Sekolah/Lembaga',
                      colorByPoint: true,
                      data: [
                      <?php
                          foreach ($active_level as $key => $row) {
                      ?>
                      {
                          name: '<?php echo $row->edulvl_name; ?>',
                          y: <?php echo $row->total; ?>,
                          drilldown: '<?php echo $row->edulvl_id; ?>'
                      },
                      <?php } ?>
                      ]
                  }],
                  "drilldown": {
                      "series": [
                          <?php foreach ($active_level as $key => $row) {
                          $origin=$this->Student_model->get_data_activeorigin($row->edulvl_id);
                          $string = '{
                              "name":"'.$row->edulvl_name.'",
                              "colorByPoint": true,
                              "id":"';
                              $string .= $row->edulvl_id;
                              $string .= '",
                              "data":[';
                              foreach ($origin as $key => $rows) { 
                                  $string .= "['".$rows->collage."',".$rows->total."],";
                              }
                              $string .=']
                          },'; 
                          echo $string;
                          }?>
                        ]
                      }
              });
              </script>
              <div id="container_origin" style="padding-top: 10px; margin: 0 auto"></div>
              <script type="text/javascript">
                // Create the chart
                Highcharts.chart('container_origin', {
                    chart: {
                        type: 'pie'
                    },
                    title: {
                        text: 'Asal siswa magang keseluruhan'
                    },
                    subtitle: {
                        text: 'Klik kolom untuk melihat lebih lanjut'
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'Kunjungan'
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                                distance: -50,
                                filter: {
                                    property: 'percentage',
                                    operator: '>',
                                    value: 4
                                }
                            }
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> kunjungn<br/>'
                    },
                    "series": [
                      {
                      name: 'Asal Sekolah/Lembaga',
                      colorByPoint: true,
                      data: [
                      <?php
                          foreach ($level as $key => $row) {
                      ?>
                      {
                          name: '<?php echo $row->edulvl_name; ?>',
                          y: <?php echo $row->total; ?>,
                          drilldown: '<?php echo $row->edulvl_id; ?>'
                      },
                      <?php } ?>
                      ]
                  }],
                  "drilldown": {
                      "series": [
                          <?php foreach ($level as $key => $row) {
                          $origin=$this->Student_model->get_data_origin($row->edulvl_id);
                          $string = '{
                              "name":"'.$row->edulvl_name.'",
                              "colorByPoint": true,
                              "id":"';
                              $string .= $row->edulvl_id;
                              $string .= '",
                              "data":[';
                              foreach ($origin as $key => $rows) { 
                                  $string .= "['".$rows->collage."',".$rows->total."],";
                              }
                              $string .=']
                          },'; 
                          echo $string;
                          }?>
                        ]
                      }
                });
                </script>

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                <div id="container_year" style="margin: 0 auto; padding-top: 10px;"></div>
                <script type="text/javascript">
                // Create the chart
                Highcharts.chart('container_year', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Siswa magang terdaftar tiap tahun'
                    },
                    subtitle: {
                        text: 'Klik kolom untuk melihat tiap bulan'
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'Kunjungan'
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                            }
                        },
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> kunjungn<br/>'
                    },

                    "series": [
                        {
                            "name": "Tahun",
                            "colorByPoint": true,
                            "data": [
                            <?php foreach ($year_student as $key => $row) {
                              echo ' {
                            "name": "'.$row->year.'",
                            "y":'.$row->total.',
                            "drilldown": "'.$row->year.'"
                            },'; } ?>
                            ]
                        }
                    ],
                    "drilldown": {
                        "series": [
                            <?php foreach ($year_student as $key => $row) {
                              $string = '{
                                  "type": "spline",
                                  "name":"'.$row->year.'",
                                  "id":"';
                                  $string .= $row->year;
                                  $string .= '",
                                  "data":[';
                                  if ($row->year != date('Y')) {
                                    for ($x = 1; $x <= 12; $x++) {
                                        $guestbook=$this->Student_model->data_monthandcount($row->year, $x);
                                          foreach ($guestbook as $key => $rows) { 
                                            $string .= "['".date('F', mktime(0, 0, 0, $x, 10))."',".$rows->total."],";
                                          }
                                      }
                                  } else {
                                    for ($x = 1; $x <= $row->max_month; $x++) {
                                        $guestbook=$this->Student_model->data_monthandcount($row->year, $x);
                                          foreach ($guestbook as $key => $rows) { 
                                            $string .= "['".date('F', mktime(0, 0, 0, $x, 10))."',".$rows->total."],";
                                          }
                                      }
                                  }
                                    /*foreach ($guestbook as $key => $rows) { 
                                      $string .= "['".$rows->month_name."',".$rows->total."],";
                                    }*/
                                  $string .='],
                                  "marker": {
                                    "symbol": "circle",
                                    "lineWidth": "2",
                                    "lineColor": Highcharts.getOptions().colors[3],
                                    "fillColor": "white",
                                    "states": {
                                        "hover": {
                                            "lineWidth": "2"
                                        }
                                    }
                                }
                              },'; 
                              echo $string;
                              }?>
                        ]
                    }
                });
                </script>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
      </div>
      <!-- /.col -->
      <div class="col-md-7">
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
                  <input type="text" name="date" class="form-control pull-right" id="reservation" value="<?php echo $date; ?>">
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
$(function () {

  //Date range picker
  $('#reservation').daterangepicker({
      locale: {
          format: 'DD-MMM-YYYY'
      }
  })

  $('#cbx_active').bootstrapToggle('on')
  $("#container_origin").hide()

  $('#cbx_active').change(function() {
    if ($(this).prop('checked')){
      $("#container_activeorigin").show()
      $("#container_origin").hide()  
    } else {
      $("#container_activeorigin").hide()
      $("#container_origin").show()
    }
  })

  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
  })
  //Red color scheme for iCheck
  $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_minimal-red',
    radioClass   : 'iradio_minimal-red'
  })
  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
  })
})
</script>
</body>
</html>