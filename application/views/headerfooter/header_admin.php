<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Presensi Siswa Magang</title>
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
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">
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
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo site_url('Dashboard') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>BI</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Presensi <b>BI</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <?php 
      $student=$this->Student_model->ambil_data(); 
      $a = 0;
      $total = 0;
      for ($i=0; $i < count($student) ; $i++) { 
        $date_now = date("Y-m-d");
        // $status = (($date_now >= $row->date_in) && ($date_now <= $row->date_out))? 'Aktif' : 'Non Aktif';
        if (($date_now >= $student[$i]->date_in) && ($date_now <= $student[$i]->date_out)) {
          ($student[$i]->active == 'Aktif')? $a++ : $total++ ;
          $menu = ($student[$i]->active == 'Aktif')? '' : $student[$i]->name.'<li><a href="#"><i class="fa fa-user text-green"></i> '.$student[$i]->active.'</a></li>';
        } else {
          ($student[$i]->active == 'Non Aktif')? $a++ : $total++ ;
          $menu = ($student[$i]->active == 'Aktif')? '' : $student[$i]->name.'<li><a href="#"><i class="fa fa-user text-red"></i> '.$student[$i]->active.'</a></li>';
        }
      }
      ?>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <?php echo ($total != 0)? '<span class="label label-warning">'.$total.'</span>' : '' ; ?>
            </a>
            <ul class="dropdown-menu">
              <?php echo ($total != 0)? '<li class="header">Ada '.$total.' status siswa magang belum diubah</li>' : '<li class="header">Status seluruh peserta magang sesuai</li>' ; ?>
              <li>
                
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php 
                    for ($i=0; $i < count($student) ; $i++) { 
                      $date_now = date("Y-m-d");
                      // $status = (($date_now >= $row->date_in) && ($date_now <= $row->date_out))? 'Aktif' : 'Non Aktif';
                      if (($date_now >= $student[$i]->date_in) && ($date_now <= $student[$i]->date_out)) {
                        // $menu = ($student[$i]->active == 'Aktif')? '' : '<li><a href='.site_url('StudentIntern').'><i class="fa fa-user text-red"></i> '.$student[$i]->name.' saatnya <span class="label label-success">Aktif</span></a></li>';
                        // $this->session->set_flashdata('std_change_date', $student[$i]->name);
                        if ($student[$i]->active == 'Aktif') {
                          $menu = '';
                        } else {
                          $menu = '<li><a href='.site_url('StudentIntern').'><i class="fa fa-user text-red"></i> '.$student[$i]->name.' ubah <span class="label label-success">Aktif</span></a></li>';
                        }
                      } else {
                        // $menu = ($student[$i]->active == 'Non Aktif')? '' : '<li><a href='.site_url('StudentIntern').'><i class="fa fa-user text-green"></i> '.$student[$i]->name.' saatnya <span class="label label-danger">Non Aktif</span></a></li>';
                        // $this->session->set_flashdata('std_change_date', $student[$i]->name);
                        if ($student[$i]->active == 'Non Aktif') {
                          $menu = '';
                        } else {
                          $menu = '<li><a href='.site_url('StudentIntern').'><i class="fa fa-user text-green"></i> '.$student[$i]->name.' ubah <span class="label label-danger">Non Aktif</span></a></li>';
                        }
                      }
                    echo $menu;
                    }
                  ?>
                </ul>
              </li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li>
            <a href="<?php echo site_url('Attendance') ?>">
              <span>Halaman scanner presensi magang</span>
            </a>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?php echo $this->session->userdata('uname_att'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="max-height: 60px;">
                <p>
                  <?php echo $this->session->userdata('uname_att'); ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url('Profile') ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('Login/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() ?>assets/dist/img/LogoBI.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('uname_att'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="<?php echo active_link('Dashboard'); ?>">
          <a href="<?php echo site_url('Dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="<?php echo active_link('Report'); ?>">
          <a href="<?php echo site_url('Report') ?>">
            <i class="fa fa-files-o"></i> <span>Laporan Rekapitulasi</span>
          </a>
        </li>
        <li class="<?php echo active_link('StudentIntern'); ?> <?php echo active_link('Workinghours'); ?> <?php echo active_link('Unit'); ?> <?php echo active_link('Mentor'); ?> <?php echo active_link('EduLvl'); ?> <?php echo active_link('InternshipRegistration'); ?> treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_link('StudentIntern'); ?>"><a href="<?php echo site_url('StudentIntern') ?>"><i class="fa fa-circle-o"></i> Siswa Magang</a></li>
            <li class="<?php echo active_link('Workinghours'); ?>"><a href="<?php echo site_url('Workinghours') ?>"><i class="fa fa-circle-o"></i> Jam Kerja</a></li>
            <li class="<?php echo active_link('Unit'); ?>"><a href="<?php echo site_url('Unit') ?>"><i class="fa fa-circle-o"></i> Unit</a></li>
            <li class="<?php echo active_link('Mentor'); ?>"><a href="<?php echo site_url('Mentor') ?>"><i class="fa fa-circle-o"></i> Mentor</a></li>
            <li class="<?php echo active_link('EduLvl'); ?>"><a href="<?php echo site_url('EduLvl') ?>"><i class="fa fa-circle-o"></i> Tingkat Pendidikan</a>
              <li class="<?php echo active_link('InternshipRegistration'); ?>"><a href="<?php echo site_url('InternshipRegistration') ?>"><i class="fa fa-circle-o"></i> Registrasi Magang</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>