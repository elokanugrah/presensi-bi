<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Top Navigation</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand"><b>Admin</b>LTE</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li>
              <a href="<?php echo site_url('Student/logout'); ?>">
                <span class="hidden-xs">Keluar</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Informasi
          <small>siswa magang</small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-user"></i>
              <h3 class="box-title">Identitas</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-xs-3">
                  <b>Nama Siswa:<br>
                  </b> <?php echo $data_student->name; ?><br>
                  <b>NIM / NIS:<br>
                  </b> <?php echo $data_student->id_number; ?><br>
                  <b>Jenis Kelamin:<br>
                  </b> <?php echo $data_student->sex; ?><br>
                  <b>Asal:<br>
                  </b> <?php echo $data_student->collage; ?><br>
                  <b>Jurusan:<br>
                  </b> <?php echo $data_student->vocational; ?><br>
                  <b>No Handphone:<br>
                  </b> <?php echo $data_student->phone; ?><br>
                  <b>Alamat:<br>
                  </b> <?php echo $data_student->address; ?><br>
                </div>
                <!-- /.col -->
                <div class="col-xs-3">
                  <b>Mulai-Selesai Magang:<br>
                  </b>
                  <?php 
                  $date_in = ($data_student->date_in == '0000-00-00') ? '?' : date("d M Y", strtotime($data_student->date_in));
                  $date_out = ($data_student->date_out == '0000-00-00') ? '?' : date("d M Y", strtotime($data_student->date_out));
                  echo $date_in.' - '.$date_out; ?> <br>
                  <b>Status Magang:<br>
                  <?php if ($data_student->active == 'Aktif') {
                    $label_active = 'label-success';
                  } else {
                    $label_active = 'label-danger';
                  } ?>
                  </b> <span class="label <?php echo $label_active; ?>"><?php echo $data_student->active; ?></span><br>
                  <b>QR Code:<br>
                  </b> <div id="canvasQR"></div>
                  <b>Mentor:<br>
                  </b> <?php echo $data_student->mentor_name; ?><br>
                  <b>Total Hari Kerja:<br>
                  </b> <?php echo $total; ?> hari<br>
                  <b>Persentase Kehadiran:<br>
                  <?php if ($data_percent >= 80) {
                    $label_percent = 'label-success';
                  } elseif ($data_percent >= 70 && $data_percent < 80) {
                    $label_percent = 'label-warning';
                  } else {
                    $label_percent = 'label-danger';
                  } ?>
                  </b> <span class="label <?php echo $label_percent; ?>"><?php echo number_format($data_percent, 2, '.', ''); ?> %</span><br>
                  <b>Kehadiran:<br>
                  </b> <?php echo $present.' hadir'; ?> <?php echo '/ '.$alpha.' alpha'; ?> <?php echo '/ '.$sick.' sakit'; ?> <?php echo '/ '.$permit.' izin'; ?>
                </div>
                <!-- /.col -->
                <div class="col-xs-3">
                  <b>Kehadiran:<br>
                  </b>
                  <br><div class="chart">
                    <canvas id="pie-chart2" class="pull-right" style="max-height: 180px; max-width: 180px;"></canvas>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-3">
                  <b>Ketepatan waktu:<br>
                  </b>
                  <br><div class="chart">
                    <canvas id="pie-chart" class="pull-right" style="max-height: 180px; max-width: 180px;"></canvas>
                  </div>
                </div>
                <!-- /.col -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Kehadiran</h3>
              <a href="<?php echo site_url('Student/print/'.$data_student->student_id) ?>" target="blank" class="btn btn-info btn-sm badge mt-1 pull-right"><span class="glyphicon glyphicon-print"></span> Print</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Hari / Tanggal</th>
                  <th>Waktu Masuk</th>
                  <th>Waktu Pulang</th>
                  <th>Status Masuk</th>
                  <th>Status Pulang</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data_attendance as $key => $row) {?>
                <tr>
                  <td><?php echo $key+1; ?></td>
                  <td><?php 
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
                        $dateday=$hari[ date('N', strtotime($row->date)) ] .', '. date("d M Y", strtotime($row->date));
                        echo $dateday; ?></td>
                  <td><?php echo $row->time_in; ?></td>
                  <td><?php echo $row->time_out; ?></td>
                  <?php if ($row->status_in == 'on time') {
                    $label_in = 'label-success';
                  } else {
                    $label_in = 'label-warning';
                  } ?>
                  <td><span class="label <?php echo $label_in; ?>"><?php echo $row->status_in; ?></span></td>
                  <?php if ($row->status_out == 'on time') {
                    $label_out = 'label-success';
                  } else {
                    $label_out = 'label-warning';
                  } ?>
                  <td><span class="label <?php echo $label_out; ?>"><?php echo $row->status_out; ?></span></td>
                  <?php if ($row->note == 'Hadir') {
                    $label_note = 'label-success';
                  } elseif ($row->note == 'Sakit') {
                    $label_note = 'label-warning';
                  } elseif ($row->note == 'Izin') {
                    $label_note = 'label-info';
                  } else {
                    $label_note = 'label-danger';
                  }?>
                  <td><span class="label <?php echo $label_note; ?>"><?php echo $row->note; ?></span></td>
                </tr>
                <?php }?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/jquery.qrcode.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/qrcode.js"></script>
<script>
  $(function () {
    $('#canvasQR').qrcode({width: 50, height: 50, text  :'<?php echo $data_student->qrcode_id; ?>'})
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

    $('.delete-data').on('click', function(e) {
      e.preventDefault();
      const href = $(this).attr('href');
      const date = $(this).attr('data-date');
      Swal.fire({
        title: 'Yakin ingin menghapus data \nkehadiran siswa?',
        text: "data kehadiran pada hari "+date+" akan dihapus!",
        type: 'warning',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.value) {
          document.location.href = href;
        }
      })
    })

    new Chart(document.getElementById("pie-chart"), {
        type: 'pie',
        data: {
          labels: ["On time", "Telat", "Tanpa Keterangan"],
          datasets: [{
            label: "Population (millions)",
            backgroundColor: ["#00a65a", "#f39c12", "#dddddd"],
            data: [<?php echo $in_stats->ontime; ?>, <?php echo $in_stats->late; ?>, <?php echo $in_stats->nan; ?>]
          }]
        },
        options: {
          title: {
            display: false,
            text: 'Persentase Ontime'
          },
          legend: {
            display: false
          }
        }
    })

    new Chart(document.getElementById("pie-chart2"), {
        type: 'pie',
        data: {
          labels: ["Hadir", "Alpha", "Sakit", "Izin", "Tanpa Keterangan", "#dddddd"],
          datasets: [{
            label: "Population (millions)",
            backgroundColor: ["#00a65a", "#f56954", "#f39c12", "#00c0ef"],
            data: [<?php echo $present; ?>, <?php echo $alpha; ?>, <?php echo $sick; ?>, <?php echo $permit; ?>, <?php echo $nan; ?>]
          }]
        },
        options: {
          title: {
            display: false,
            text: 'Persentase Ontime'
          },
          legend: {
            display: false
          }
        }
    })
  })
</script>
<script src="<?php echo base_url() ?>assets/dist/js/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</body>
</html>