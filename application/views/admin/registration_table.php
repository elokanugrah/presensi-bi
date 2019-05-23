<?php $this->load->view('headerfooter/header_admin'); ?>
<!-- bootstrap toggle -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Registrasi
      <small>magang</small>
    </h1>
    <ol class="breadcrumb">
      <li class="<?php echo active_link('InternshipRegistration'); ?>"><a href="<?php echo site_url('InternshipRegistration') ?>"><i class="fa fa-table"></i> Registrasi Magang</a></li>
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
            <h3 class="box-title">Aktivasi Periode Pendaftaran</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <form role="form" id="posting" action="#" method="post">
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <?php
                    $month = array ( 
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
                  ?>
                  <dt><u><?php echo $realslot; ?></u> Kuota tersedia untuk bulan depan (<u><?php echo $month[$nextmonth]; ?></u>)</dt>
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group pull-right">
                  <a href="javascript:void(0)" onclick="edit_slot('<?php echo $regis->regisauto_id; ?>')">Ubah kuota</a>
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <div class="input-group">
                    <dt>Daftar pemagang keluar:</dt>
                    <ul>
                    <?php
                    $s1 = date('d-m-Y'); // Added one day to start from 03-05-2018
                    $s2 = date('d-m-Y', strtotime($lastmonth.' +1 month')); //Added one day to end with 08-05-2018
                    $start = new DateTime($s1);
                    $end   = new DateTime($s2);
                    $interval = DateInterval::createFromDateString('1 month');
                    $period   = new DatePeriod($start, $interval, $end);
                    $amonthafter=0;
                    foreach ($period as $dt) {
                      $counter = $this->Student_model->count_by_date($dt->format("Y-m"));
                      echo '<li>'.$dt->format('Y').','.PHP_EOL, $month[$dt->format('n')], PHP_EOL, $counter.' orang <br></li>';
                    }  
                    ?>
                    </ul>
                  </div>
                </div>
                <!-- /.form group -->
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Automatis:</label>
                <div class="input-group">
                  <input id="cb_auto" name="regis_auto" type="checkbox" data-toggle="toggle" data-size="medium" data-on="Automatis" data-off="Manual" data-onstyle="success" value="1">
                  <label style="font-size: 13px; color: #999; font-weight: lighter;">Automatis: dibuka selama masih ada kuota tersedia.</label>
                </div>
                <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col -->
            <div class="col-md-2">
              <div class="form-group">
                <label>Buka pendaftaran:</label>
                <div class="input-group">
                  <?php echo($realslot>0)? '<input id="cb_active" name="regis_open" type="checkbox" data-toggle="toggle" data-size="medium" data-on="Buka" data-off="Tutup" data-onstyle="success" data-offstyle="danger">' : '<input id="" type="checkbox" data-toggle="toggle" data-size="medium" data-on="Buka" data-off="Tutup" data-onstyle="success" data-offstyle="danger" disabled>'; ?>
                </div>
                <?php if ($realslot==0): ?>
                <label style="font-size: 13px; color: #999; font-weight: lighter;">Kuota tidak tersedia.</label>
                <?php endif ?>
                <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col -->
              <?php if ($realslot>0): ?>
              <div id="actived">
              <div class="col-md-5">
                <div class="form-group col-xs-12">
                  <label>Buka pendaftaran:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="glyphicon glyphicon-calendar"></i>
                    </div>
                    <input type="text" class="form-control" id="reservation" value="<?php echo date('d-M-Y', strtotime($open)).' - '.date('d-M-Y', strtotime($close)); ?>">
                    <input type="hidden" name="start" value="<?php echo $open; ?>">
                    <input type="hidden" name="end" value="<?php echo $close; ?>">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                </div>
              </div>
              <?php endif ?>
          </div>
          <!-- /.row -->
        </div>
          <div class="box-footer">
            <button id="submit" type="submit" class="btn btn-info pull-right">Posting</button>
          </div>
      </form>
      </div>
    </div>
  </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Registrasi Magang</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Email</th>
                <th>Asal</th>
                <th>Pengajuan Periode Magang</th> 
                <th>Durasi</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($data_regis as $key => $row) {?>
              <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $row->registered_name; ?></td>
                <td><?php echo $row->sex; ?></td>
                <td><?php echo $row->email; ?></td>
                <td><?php echo $row->origin; ?></td>
                <td><?php echo date('d/m/Y', strtotime($row->start)); ?> ~ <?php echo date('d/m/Y', strtotime($row->end)); ?></td>
                <td><?php
                $start = new DateTime($row->start);
                $end = new DateTime($row->end);
                $interval = $start->diff($end);
                echo ($interval->d != 0)?(($interval->m != 0)?$interval->m." bulan, ".$interval->d." hari":$interval->d." hari"):$interval->m." bulan";
                ?></td>
                <td><?php if ($row->approve != true) {
                      $label_active = 'label-danger';
                      $label_text = 'Belum Diterima';
                    } else {
                      $label_active = 'label-success';
                      $label_text = 'Diterima';
                    } ?>
                  <span class="label <?php echo $label_active; ?>"><?php echo $label_text ?></span>
                </td>
                <td align="center">
                  <?php echo ($row->already_read != true)?'<a class="btn btn-success btn-sm badge mt-1" href="'.site_url('InternshipRegistration/applicant/'.$row->regis_id).'"><i class="fa fa-eye"></i></a>':'<a class="btn btn-default btn-sm badge mt-1" href="'.site_url('InternshipRegistration/applicant/'.$row->regis_id).'"><i class="fa fa-eye"></i></a>'; ?>
                  
                </td>
              </tr>
              <?php }?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <div class="modal fade" id="modal-slot">
      <div class="modal-dialog">
        <div class="modal-content">
          <form role="form" id="form-slot" action="#" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title-slot"></h4>
          </div>
          <div class="box-body">
            <div class="form-group col-xs-12">
              <label>Maksimum kuota</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-group"></i>
                </div>
                <input type="number" class="form-control" name="slot" min="0" required>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('headerfooter/footer_admin'); ?>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
$(function () {
  $('#submit').on('click', function(e) {
    alert($("#cb_active").prop('checked'));
  })
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

  function cb(start, end) {
      $('[name="start"]').val(start.format('DD-MM-YYYY'));
      $('[name="end"]').val(end.format('DD-MM-YYYY'));
  }
  //Date range picker
  $('#reservation').daterangepicker({
      locale: {
          format: 'DD-MMM-YYYY',
      },
      ranges: {
         'Hari ini': [moment(), moment()],
         'Besok': [moment().add(1, 'days'), moment().add(1, 'days')],
         '7 hari kedepan': [moment(), moment().add(6, 'days')],
         '30 hari kedepan': [moment(), moment().add(30, 'days')],
         'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
         'Bulan depan': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
      }
  }, cb);

  <?php if ($regis->regis_auto != true) { ?>
    $("#cb_auto").prop('checked', false).change()
      <?php if ($regis->regis_open != true) { ?>
      $("#cb_active").prop('checked', false).change()
      $("#actived").hide() 
      <?php } else { ?>
      // $('[name="first_date"]').datepicker('update','<?php echo date('d-m-Y', strtotime($regis->start)) ?>');
      // $('[name="last_date"]').datepicker('update','<?php echo date('d-m-Y', strtotime($regis->end)) ?>');
      $("#cb_active").prop('checked', true).change()
      $("#actived").show() 
      <?php } ?>
    // $("#submit").removeClass("disabled")
  <?php } else { ?>
    $("#cb_auto").prop('checked', true).change()
    $("#cb_active").prop('checked', false).change()
    $("#cb_active").prop('disabled', true).change()
    $("#actived").hide() 
    // $("#submit").removeClass("disabled")
  <?php } ?>
  $('#cb_auto').change(function() {
      if ($(this).prop('checked')){
        $("#cb_active").prop('checked', false).change()
        $("#cb_active").prop('disabled', true).change()
        // $("#submit").removeClass("disabled")
      } else {
        $("#cb_active").prop('disabled', false).change()
        // $("#submit").addClass("disabled")
      }
    })

  <?php if ($realslot>0): ?>
    // $("#submit").addClass("disabled")
    
    $('#cb_active').change(function() {
      if ($(this).prop('checked')){
        $("#actived").show() 
        // $("#submit").removeClass("disabled")
      } else {
        $("#actived").hide()
        // $("#submit").addClass("disabled")
      }
    })
  <?php endif ?>
    
  <?php if ($realslot==0): ?>
    $("#actived").hide()
  <?php endif ?>

  $('#posting').attr('action', '<?php echo site_url('InternshipRegistration/post_action')?>');
})

function edit_slot(id)
{
  $('#form-slot')[0].reset(); // reset form on modals

  $('[name="slot"]').val(<?php echo $regis->slot; ?>);
  $('#form-slot').attr('action', '<?php echo site_url('InternshipRegistration/slot_action')?>');
  $('#modal-slot').modal('show'); // show bootstrap modal when complete loaded
  $('.modal-title-slot').text('Ubah Kuota'); // Set title to Bootstrap modal title
}
</script>
<script src="<?php echo base_url() ?>assets/dist/js/sweetalert2.all.min.js"></script>
</body>
</html>