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
              <span class="info-box-number"><?php echo $visit; ?></span>
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
              <span class="info-box-number"><?php echo $data_countweek->total; ?></span>
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
              <span class="info-box-number"><?php echo $data_countbook->total; ?></span>
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
              <span class="info-box-number"><?php echo $guest; ?></span>
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
                <div id="container_thisweek" style="margin: 0 auto"></div>
                <div id="container_lastweek" style="margin: 0 auto"></div>
                <div id="container_twoweekago" style="margin: 0 auto"></div>
                <div id="container_threeweekago" style="margin: 0 auto"></div>
                <!-- Highcharts.chart('container4', {
                  chart: {
                          type: 'line'
                      },
                      title: {
                          text: 'Kunjungan seminggu terakhir'
                      },
                      subtitle: {
                          text: '<?php echo date("d M Y", strtotime('-6 days')); ?> - <?php echo date("d M Y"); ?>'
                      },
                      xAxis: {
                          categories: [
                          <?php 
                          $start = date("d", strtotime('-6 days'));
                          $end = date("d");
                          for ($x = $start; $x <= $end; $x++) {
                          $dt = ($x-$start)-6; ?>
                            '<?php echo date("d M", strtotime('+'.$dt.' days')); ?>',
                          <?php } ?>
                          ]
                      },
                      yAxis: {
                          title: {
                              text: 'Kunjungan'
                          }
                      },
                      plotOptions: {
                          line: {
                              dataLabels: {
                                  enabled: true
                              },
                              enableMouseTracking: false
                          }
                      },
                      series: [{
                          name: 'Kunjungan',
                          data: [
                          <?php 
                          $start = date("d", strtotime('-6 days'));
                          $end = date("d");
                          for ($x = $start; $x <= $end; $x++) {
                          $dt = ($x-$start)-6; 
                          $dtt = date("Y-m-d", strtotime('+'.$dt.' days'));
                          $data_guestweek=$this->Guestbook_model->data_by_date($dtt);
                            echo $data_guestweek->total.',';
                          } ?>
                          ]
                      }]
                  }); -->
                <script type="text/javascript">
                Highcharts.chart('container_thisweek', {
                  chart: {
                          type: 'line'
                      },
                      title: {
                          text: 'Kunjungan seminggu terakhir'
                      },
                      subtitle: {
                          text: '<?php echo date("d M Y", strtotime('monday this week')); ?> - <?php echo date("d M Y", strtotime('friday this week')); ?>'
                      },
                      xAxis: {
                          categories: [
                          <?php
                          $weekdays = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
                          $weekday = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat");
                          for($x=0; $x<5; $x++) { ?>
                            '<?php echo $weekday[$x].' '.date("d M", strtotime(''.$weekdays[$x].' this week')); ?>',
                          <?php } ?>
                          ]
                      },
                      yAxis: {
                          title: {
                              text: 'Kunjungan'
                          }
                      },
                      plotOptions: {
                          line: {
                              dataLabels: {
                                  enabled: false
                              },
                              enableMouseTracking: true
                          }
                      },
                      series: [{
                          name: 'Kunjungan',
                          data: [
                          <?php 
                          for($x=0; $x<5; $x++) {
                            $dt = date("Y-m-d", strtotime(''.$weekdays[$x].' this week'));
                            $dts =  $this->Guestbook_model->data_by_date($dt);
                            echo $dts->total.','; 
                          } ?> 
                          ]
                      }]
                  });
                    </script>
                    <script type="text/javascript">
                Highcharts.chart('container_lastweek', {
                  chart: {
                          type: 'line'
                      },
                      title: {
                          text: 'Kunjungan minggu lalu'
                      },
                      subtitle: {
                          text: '<?php echo date("d M Y", strtotime('monday last week')); ?> - <?php echo date("d M Y", strtotime('friday last week')); ?>'
                      },
                      xAxis: {
                          categories: [
                          <?php
                          $weekdays = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
                          $weekday = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat");
                          for($x=0; $x<5; $x++) { ?>
                            '<?php echo $weekday[$x].' '.date("d M", strtotime(''.$weekdays[$x].' last week')); ?>',
                          <?php } ?>
                          ]
                      },
                      yAxis: {
                          title: {
                              text: 'Kunjungan'
                          }
                      },
                      plotOptions: {
                          line: {
                              dataLabels: {
                                  enabled: false
                              },
                              enableMouseTracking: true
                          }
                      },
                      series: [{
                          name: 'Kunjungan',
                          data: [
                          <?php 
                          for($x=0; $x<5; $x++) {
                            $dt = date("Y-m-d", strtotime(''.$weekdays[$x].' last week'));
                            $dts =  $this->Guestbook_model->data_by_date($dt);
                            echo $dts->total.','; 
                          } ?> 
                          ]
                      }]
                  });
                    </script>
                    <script type="text/javascript">
                Highcharts.chart('container_twoweekago', {
                  chart: {
                          type: 'line'
                      },
                      title: {
                          text: 'Kunjungan dua minggu lalu'
                      },
                      subtitle: {
                          text: '<?php echo date("d M Y", strtotime('monday 1 week ago')); ?> - <?php echo date("d M Y", strtotime('friday 1 week ago')); ?>'
                      },
                      xAxis: {
                          categories: [
                          <?php
                          $weekdays = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
                          $weekday = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat");
                          for($x=0; $x<5; $x++) { ?>
                            '<?php echo $weekday[$x].' '.date("d M", strtotime(''.$weekdays[$x].' 1 week ago')); ?>',
                          <?php } ?>
                          ]
                      },
                      yAxis: {
                          title: {
                              text: 'Kunjungan'
                          }
                      },
                      plotOptions: {
                          line: {
                              dataLabels: {
                                  enabled: false
                              },
                              enableMouseTracking: true
                          }
                      },
                      series: [{
                          name: 'Kunjungan',
                          data: [
                          <?php 
                          for($x=0; $x<5; $x++) {
                            $dt = date("Y-m-d", strtotime(''.$weekdays[$x].' 1 week ago'));
                            $dts =  $this->Guestbook_model->data_by_date($dt);
                            echo $dts->total.','; 
                          } ?> 
                          ]
                      }]
                  });
                    </script>
                    <script type="text/javascript">
                Highcharts.chart('container_threeweekago', {
                  chart: {
                          type: 'line'
                      },
                      title: {
                          text: 'Kunjungan tiga minggu lalu'
                      },
                      subtitle: {
                          text: '<?php echo date("d M Y", strtotime('monday 2 week ago')); ?> - <?php echo date("d M Y", strtotime('friday 2 week ago')); ?>'
                      },
                      xAxis: {
                          categories: [
                          <?php
                          $weekdays = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
                          $weekday = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat");
                          for($x=0; $x<5; $x++) { ?>
                            '<?php echo $weekday[$x].' '.date("d M", strtotime(''.$weekdays[$x].' 2 week ago')); ?>',
                          <?php } ?>
                          ]
                      },
                      yAxis: {
                          title: {
                              text: 'Kunjungan'
                          }
                      },
                      plotOptions: {
                          line: {
                              dataLabels: {
                                  enabled: false
                              },
                              enableMouseTracking: true
                          }
                      },
                      series: [{
                          name: 'Kunjungan',
                          data: [
                          <?php 
                          for($x=0; $x<5; $x++) {
                            $dt = date("Y-m-d", strtotime(''.$weekdays[$x].' 2 week ago'));
                            $dts =  $this->Guestbook_model->data_by_date($dt);
                            echo $dts->total.','; 
                          } ?> 
                          ]
                      }]
                  });
                    </script>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                  <script src="<?php echo base_url() ?>assets/code/modules/data.js"></script>
                  <script src="<?php echo base_url() ?>assets/code/modules/drilldown.js"></script>
                  <div id="container" style="margin: 0 auto"></div>
                  <script type="text/javascript">
                  // Create the chart
                  Highcharts.chart('container', {
                      chart: {
                          type: 'column'
                      },
                      title: {
                          text: 'Kunjungan tiap tahun'
                      },
                      subtitle: {
                          text: 'Klik kolom untuk melihat kunjungan tiap bulan'
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
                          }
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
                              <?php foreach ($data_guestbook as $key => $row) {
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
                              <?php foreach ($data_guestbook as $key => $row) {
                                $string = '{
                                    "name":"'.$row->year.'",
                                    "id":"';
                                    $string .= $row->year;
                                    $string .= '",
                                    "data":[';
                                    if ($row->year != date('Y')) {
                                      for ($x = 1; $x <= 12; $x++) {
                                          $guestbook=$this->Guestbook_model->data_monthandcount($row->year, $x);
                                            foreach ($guestbook as $key => $rows) { 
                                              $string .= "['".date('F', mktime(0, 0, 0, $x, 10))."',".$rows->total."],";
                                            }
                                        }
                                    } else {
                                      for ($x = 1; $x <= $row->max_month; $x++) {
                                          $guestbook=$this->Guestbook_model->data_monthandcount($row->year, $x);
                                            foreach ($guestbook as $key => $rows) { 
                                              $string .= "['".date('F', mktime(0, 0, 0, $x, 10))."',".$rows->total."],";
                                            }
                                        }
                                    }
                                      /*foreach ($guestbook as $key => $rows) { 
                                        $string .= "['".$rows->month_name."',".$rows->total."],";
                                      }*/
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
                    <input type="text" name="date" class="form-control pull-right" id="reservation" value="<?php echo $date; ?>">
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
                    <?php if (!$data_guestbookoccuptaion) { /*echo date("Y-m-d", strtotime('-6 days')).' - '.date("Y-m-d");*/ ?>
                    <?php } else { /*echo date("Y-m-d", strtotime('-6 days')).' - '.date("Y-m-d");*/ ?>
                    <div id="container2" style="margin: 0 auto"></div>
                    <script type="text/javascript">
                    Highcharts.chart('container2', {
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: 'Persentase kriteria pengunjung'
                        },
                        subtitle: {
                            text: 'Pilih kolom untuk rentang tanggal lainnya'
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
                            name: 'Kunjungan',
                            colorByPoint: true,
                            data: [
                            <?php
                                foreach ($data_guestbookoccuptaion as $key => $row) {
                            ?>
                            {
                                name: '<?php echo $row->occupation; ?>',
                                y: <?php echo $row->total; ?>,
                                drilldown: '<?php echo $row->occupation; ?>'
                            },
                            <?php } ?>
                            ]
                        }],
                        "drilldown": {
                            "series": [
                                <?php foreach ($data_guestbookoccuptaion as $key => $row) {
                                $guestbookoccupation=$this->Guestbook_model->data_occupationandinstance($dates, $row->occupation);
                                $string = '{
                                    "name":"'.$row->occupation.'",
                                    "colorByPoint": true,
                                    "id":"';
                                    $string .= $row->occupation;
                                    $string .= '",
                                    "data":[';
                                    foreach ($guestbookoccupation as $key => $rows) { 
                                        $string .= "['".$rows->instance."',".$rows->total."],";
                                    }
                                    $string .=']
                                },'; 
                                echo $string;
                                }?>
                              ]
                            }
                    });
                    </script>
                    <?php } ?>
                    <!-- Map will be created here -->
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
                    <input type="text" name="date1" class="form-control pull-right" id="reservation1" value="<?php echo $date1; ?>">
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
                    <?php if (!$data_booktype) { /*echo date("Y-m-d", strtotime('-6 days')).' - '.date("Y-m-d");*/ ?>
                    <?php } else { /*echo date("Y-m-d", strtotime('-6 days')).' - '.date("Y-m-d");*/ ?>
                    <div id="container3" style="margin: 0 auto"></div>
                    <script type="text/javascript">
                    Highcharts.chart('container3', {
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
                                foreach ($data_booktype as $key => $row) {
                            ?>
                            {
                                name: '<?php echo $row->type; ?>',
                                y: <?php echo $row->total; ?>,
                                drilldown: '<?php echo $row->type; ?>'
                            },
                            <?php } ?>
                            ]
                        }],
                        "drilldown": {
                            "series": [
                                <?php foreach ($data_booktype as $key => $row) {
                                $recomendationtitle=$this->Bookrecomendation_model->booktitle_by_type($dates1, $row->type);
                                $string = '{
                                    "name":"'.$row->type.'",
                                    "colorByPoint": true,
                                    "id":"';
                                    $string .= $row->type;
                                    $string .= '",
                                    "data":[';
                                    foreach ($recomendationtitle as $key => $rows) { 
                                        $string .= "['".$rows->title."',".$rows->total."],";
                                    }
                                    $string .=']
                                },'; 
                                echo $string;
                                }?>
                              ]
                            }
                    });
                    </script>
                    <?php } ?>
                    <!-- Map will be created here -->
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
              <table class="table table-striped">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Jenis Buku</th>
                  <th>Persentase Bar</th>
                  <th style="width: 40px">%</th>
                  <th style="width: 40px">Aksi</th>
                </tr>
                <?php 
                $color=array("red","yellow","blue","green","gray");
                foreach ($data_bookrec as $key => $row) {  ?>
                <tr>
                  <td><?php echo $key+1; ?></td>
                  <td><?php echo $row->type; ?></td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-<?php echo $color[$key] ?>" style="width: <?php echo (100*$row->total)/$data_countbook->total; ?>%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-<?php echo $color[$key] ?>"><?php echo (100*$row->total)/$data_countbook->total; ?>%</span></td>
                  <td align="center">
                    <a href="<?php echo site_url('BookrecomendationList/type/'.$row->type) ?>"><button type="button" class="btn btn-sm badge mt-1"><i class="fa fa-eye"></i></button></a>
                  </td>
                </tr>
              <?php } ?>
                <!-- <tr>
                  <td>2.</td>
                  <td>Clean database</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-yellow">70%</span></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Cron job running</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-light-blue">30%</span></td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Fix and squish bugs</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-green">90%</span></td>
                </tr> -->
              </table>
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