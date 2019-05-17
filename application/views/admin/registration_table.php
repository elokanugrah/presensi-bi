<?php $this->load->view('headerfooter/header_admin'); ?>
<!-- bootstrap toggle -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data
      <small>registrasi</small>
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
                  <dt><u><?php echo $realslot; ?></u> Slot tersedia untuk bulan depan (<u><?php echo $month[$nextmonth]; ?></u>)</dt>
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-md-4">
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
                  <label style="font-size: 13px; color: #999; font-weight: lighter;">Automatis: dibuka selama masih ada slot kosong.</label>
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
                <label style="font-size: 13px; color: #999; font-weight: lighter;">Slot tidak tersedia.</label>
                <?php endif ?>
                <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.col -->
              <?php if ($realslot>0): ?>
              <div id="actived">
              <div class="col-md-4">
                <div class="form-group pull-right">
                  <label>Buka pendaftaran:</label>
                  <div class="input-group">
                    <div class="row">
                      <div class="col-xs-5">
                        <input type="text" name="first_date" class="form-control datepicker">
                      </div>
                      <div class="col-xs-2" style="text-align: center;">
                        <h5>-----</h5>
                      </div>
                      <div class="col-xs-5">
                        <input type="text" name="last_date" class="form-control datepicker">
                      </div>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                </div>
              </div>
              <?php endif ?>
          </div>
          <!-- /.row -->
          <div class="box-footer">
            <button id="submit" type="submit" class="btn btn-info pull-right">Posting</button>
          </div>
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
            <a href="javascript:void(0)" onclick="add_datetime()" class="btn btn-primary btn-sm badge mt-1 pull-right" style="margin-left: 20px;"><i class="fa fa-plus"></i></a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($data_mentor as $key => $row) {?>
              <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $row->nip; ?></td>
                <td><?php echo $row->name; ?></td>
                <td align="center">
                  <a class="btn btn-info btn-sm badge mt-1" href="javascript:void(0)" onclick="edit_datetime('<?php echo $row->mentor_id; ?>')"><i class="fa fa-pencil"></i></a>
                  <a href="<?php echo site_url('Mentor/delete/'.$row->mentor_id) ?>" data-name="<?php echo $row->name; ?>" class="btn btn-danger btn-sm badge mt-1 delete-data"><i class="fa fa-trash"></i></a>
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
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <form role="form" id="form_edit" action="#" method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title-edit"></h4>
        </div>
        <div class="box-body">
          <div class="form-group col-xs-12">
            <label>NIP</label>

            <div class="input-group">
              <div class="input-group-addon">
                <i class="glyphicon glyphicon-credit-card"></i>
              </div>
              <input type="text" class="form-control" name="nip" required>
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->
          <div class="form-group col-xs-12">
            <label>Nama</label>

            <div class="input-group">
              <div class="input-group-addon">
                <i class="glyphicon glyphicon-user"></i>
              </div>
              <input type="text" class="form-control" name="name" required>
            </div>
            <!-- /.input group -->
          </div>
        </div>
        <div class="modal-footer">
          <input name="mentor_id" hidden>
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('headerfooter/footer_admin'); ?>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
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

  $('.delete-data').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    const name = $(this).attr('data-name');
    Swal.fire({
      title: 'Yakin ingin menghapus data \nmentor?',
      text: "data mentor a/n "+name+" akan dihapus!",
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
  //Date picker
  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    orientation: "bottom auto",
    todayHighlight: true
  })

  <?php if ($regis->regis_auto != true) { ?>
    $("#cb_auto").prop('checked', false).change()
      <?php if ($regis->regis_open != true) { ?>
      $("#cb_active").prop('checked', false).change()
      $("#actived").hide() 
      <?php } else { ?>
      $('[name="first_date"]').datepicker('update','<?php echo date('d-m-Y', strtotime($regis->start)) ?>');
      $('[name="last_date"]').datepicker('update','<?php echo date('d-m-Y', strtotime($regis->end)) ?>');
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

function add_datetime()
{
  $('#form_add')[0].reset(); // reset form on modals

  $('#form_add').attr('action', '<?php echo site_url('Mentor/add_action')?>');
  $('#modal-add').modal('show'); // show bootstrap modal when complete loaded
  $('.modal-title-add').text('Tambah Mentor'); // Set title to Bootstrap modal title
}

function edit_datetime(id)
{
  $('#form_edit')[0].reset(); // reset form on modals

  //Ajax Load data from ajax
  $.ajax({
      url : "<?php echo site_url('Mentor/edit/')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
          $('[name="mentor_id"]').val(data.mentor_id);
          $('[name="name"]').val(data.name);
          $('[name="nip"]').val(data.nip);
          $('#form_edit').attr('action', '<?php echo site_url('Mentor/edit_action')?>');
          $('#modal-edit').modal('show'); // show bootstrap modal when complete loaded
          $('.modal-title-edit').text('Ubah Data Mentor'); // Set title to Bootstrap modal title

      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          alert('Error get data from ajax');
      }
  })
}
</script>
<script src="<?php echo base_url() ?>assets/dist/js/sweetalert2.all.min.js"></script>
</body>
</html>