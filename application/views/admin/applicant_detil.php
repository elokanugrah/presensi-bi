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
        <li><a href="<?php echo site_url('StudentIntern') ?>"><i class="fa fa-table"></i> Siswa magang</a></li>
        <li class="<?php echo active_link('StudentIntern'); ?>"><a href="#">Detil</a></li>
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
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-user"></i>
              <h3 class="box-title">Identitas Pendaftar</h3>
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
                  <b>Nama:<br>
                  </b> <?php echo $applicant->registered_name ?><br>
                  <b>NIM / NIS:<br>
                  </b> <?php echo $applicant->idsch_num ?><br>
                  <b>Jenis Kelamin:<br>
                  </b> <?php echo $applicant->sex ?><br>
                  <b>Tempat / Tanggal Lahir:<br>
                  </b> <?php 
                  $bln = array ( 
                        1 => 'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                      ); 
                  echo $applicant->pob .' / '. date('d', strtotime($applicant->dob)) .' '. $bln[ date('n', strtotime($applicant->dob)) ] .' '. date('Y', strtotime($applicant->dob)) ?><br>
                  <b>Jenis Kelamin:<br>
                  </b> <?php echo $applicant->email ?><br>
                  <b>No Handphone:<br>
                  </b> <?php echo $applicant->phone ?><br>
                </div>
                <!-- /.col -->
                <div class="col-xs-3">
                  <b>Asal Sekolah/Lembaga:<br>
                  </b> <?php echo $applicant->origin ?><br>
                  <b>Jurusan:<br>
                  </b> <?php echo $applicant->vocational ?><br>
                  <b>Alamat:<br>
                  </b> <?php echo $applicant->address ?><br>
                  <b>Pengajuan Periode Magang:<br>
                  </b> <?php echo date('d/m/Y', strtotime($applicant->start)); ?> ~ <?php echo date('d/m/Y', strtotime($applicant->end)) ?><br>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                  <b>Pesan yang disampaikan:<br>
                  </b> <?php echo $applicant->story ?><br>
                  <b>Status Pendaftaran:<br>
                    <?php if ($applicant->approve != true) {
                      $label_active = 'label-danger';
                      $label_text = 'Belum Diterima';
                    } else {
                      $label_active = 'label-success';
                      $label_text = 'Diterima';
                    } ?>
                    </b> <span class="label <?php echo $label_active; ?>"><?php echo $label_text ?></span><br>
                </div>
                <!-- /.col -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <form role="form" action="<?php echo $approve_action ?>" method="post">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Dokumen Pendaftar</h3>
              <div class="pull-right">
              <i class="fa fa-file-pdf-o"></i>
              <a href="https://calonwisudawan.com/uploads/PresensiSiswaMagang.pdf">Download PDF</a></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <iframe src="https://docs.google.com/viewer?url=https://calonwisudawan.com/uploads/PresensiSiswaMagang.pdf&embedded=true" frameborder="0" height="500px" width="100%"></iframe>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="hidden" name="reg" value="<?php echo $applicant->regis_id ?>">
              <button name="submit" type="submit" value="1" class="btn btn-info pull-right">Terima Pendaftar</button>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        </form>
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
<!-- bootstrap time picker -->
<script src="<?php echo base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
  }
</script>
<script src="<?php echo base_url() ?>assets/dist/js/sweetalert2.all.min.js"></script>
</body>
</html>