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
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
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
                  <b>NIM:<br>
                  </b> <?php echo $data_student->id_number; ?><br>
                  <b>Jenis Kelamin:<br>
                  </b> <?php echo $data_student->sex; ?><br>
                  <b>Asal:<br>
                  </b> <?php echo $data_student->collage; ?><br>
                  <b>Alamat:<br>
                  </b> <?php echo $data_student->address; ?><br>
                  <b>Status Magang:<br>
                  <?php if ($data_student->active == 'Aktif') {
                    $label_active = 'label-success';
                  } else {
                    $label_active = 'label-danger';
                  } ?>
                  </b> <span class="label <?php echo $label_active; ?>"><?php echo $data_student->active; ?></span>
                </div>
                <!-- /.col -->
                <div class="col-xs-3">
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Kehadiran</h3>
              <a href="javascript:void(0)" onclick="add_datetime()" class="btn btn-primary btn-sm badge mt-1 pull-right"><i class="fa fa-plus"></i></a>
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
                  <th>Aksi</th>
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
                        $dateday=$hari[ date('N', strtotime($row->date)) ] .', '. date("d-M-Y", strtotime($row->date));
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
                  <td><span class="label <?php echo $label_note; ?>"><?php echo $row->note; ?></span> <a class="btn btn-default btn-sm badge mt-1 pull-right" href="javascript:void(0)" onclick="edit_note('<?php echo $row->attendance_id; ?>')"><i class="fa fa-edit"></i></a></td>
                  <td align="center">
                    <a class="btn btn-info btn-sm badge mt-1" href="javascript:void(0)" onclick="edit_datetime('<?php echo $row->attendance_id; ?>')"><i class="fa fa-pencil"></i></a>
                    <a href="<?php echo site_url('Attendance/delete/'.$row->attendance_id) ?>" data-date="<?php echo $dateday; ?>" class="btn btn-danger btn-sm badge mt-1 delete-data"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php }?>
                </tfoot>
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
    <div class="modal fade" id="modal-add">
      <div class="modal-dialog">
        <div class="modal-content">
          <form role="form" id="form_add" action="#" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title-edit"></h4>
          </div>
          <div class="box-body">
            <div class="form-group col-xs-12">
              <label for="inputTimeIn" class="control-label">Tanggal</label>
                <div class="input-group date">
                  <input type="text" name="date_in" class="form-control" id="datepicker" value="<?php echo date('d-M-Y'); ?>">
                  <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                  </div>
                </div>
            </div>
            <div class="form-group col-xs-6">
              <label for="inputTimeIn" class="control-label">Masuk</label>
                <div class="input-group">
                  <input type="text" name="time_in" class="form-control timepicker" value="<?php echo date('H:i:s'); ?>">
                  <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                  </div>
                </div>
            </div>
            <div class="form-group col-xs-6">
              <label for="inputTimeOut" class="control-label">Keluar</label>
                <div class="input-group">
                  <input type="text" name="time_out" class="form-control timepicker" value="<?php echo date('H:i:s'); ?>">
                  <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                  </div>
                </div>
            </div>
            <div class="form-group col-xs-12">
              <label class="control-label">Kehadiran</label>
                <select class="form-control" name="note" required>
                    <option value="" selected hidden>Kehadiran</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Alpha">Alpha</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin">Izin</option>
                </select>
            </div>
          </div>
          <div class="modal-footer">
            <input name="student_id" value="<?php echo $data_student->student_id; ?>" hidden>
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
    <div class="modal fade" id="modal-note">
      <div class="modal-dialog">
        <div class="modal-content">
          <form role="form" id="form_note" action="#" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title-note"></h4>
          </div>
          <div class="modal-body">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="glyphicon glyphicon-list-alt"></i>
              </div>
              <div class="form-group has-feedback">
                <select class="form-control" name="note" required>
                    <option value="Tidak diketahui" selected hidden>Kehadiran</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Alpha">Alpha</option>
                     <option value="Sakit">Sakit</option>
                      <option value="Izin">Izin</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input name="attendance_id" hidden>
            <input name="student_id" hidden>
            <input type="text" name="date_inn" hidden>
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
              <label for="inputTimeIn" class="control-label">Tanggal</label>
                <div class="input-group date">
                  <input type="text" name="date_in" class="form-control" id="datepicker">
                  <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                  </div>
                </div>
            </div>
            <div class="form-group col-xs-6">
              <label for="inputTimeIn" class="control-label">Masuk</label>
                <div class="input-group">
                  <input type="text" name="time_in" class="form-control timepicker">
                  <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                  </div>
                </div>
            </div>
            <div class="form-group col-xs-6">
              <label for="inputTimeOut" class="control-label">Keluar</label>
                <div class="input-group">
                  <input type="text" name="time_out" class="form-control timepicker">
                  <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                  </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <input name="attendance_id" hidden>
            <input name="student_id" hidden>
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
<!-- bootstrap time picker -->
<script src="<?php echo base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
  $(function () {
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
          labels: ["On time", "Telat"],
          datasets: [{
            label: "Population (millions)",
            backgroundColor: ["#00a65a", "#f39c12"],
            data: [<?php echo $in_stats->ontime; ?>, <?php echo $in_stats->late; ?>]
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
          labels: ["Hadir", "Alpha", "Sakit", "Izin"],
          datasets: [{
            label: "Population (millions)",
            backgroundColor: ["#00a65a", "#f56954", "#f39c12", "#00c0ef"],
            data: [<?php echo $present; ?>, <?php echo $alpha; ?>, <?php echo $sick; ?>, <?php echo $permit; ?>]
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

  function add_datetime(id)
  {
      $('#form_add')[0].reset(); // reset form on modals
   
      $('#form_add').attr('action', '<?php echo site_url('Attendance/add_studentatt_action')?>');
      $('#modal-add').modal('show'); // show bootstrap modal when complete loaded
      $('.modal-title-add').text('Tambah Kehadiran'); // Set title to Bootstrap modal title
    }

  function edit_note(id)
  {
      $('#form_note')[0].reset(); // reset form on modals
   
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('Attendance/edit_student_attendance/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="attendance_id"]').val(data.attendance_id);
              $('[name="student_id"]').val(data.student_id);
              $('[name="note"]').val(data.note);
              $('[name="date_inn"]').val(data.date);
              $('#form_note').attr('action', '<?php echo site_url('Attendance/edit_studentnote_action')?>');
              $('#modal-note').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title-note').text('Ubah Keterangan'); // Set title to Bootstrap modal title
   
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      })
    }

  function edit_datetime(id)
  {
      $('#form_edit')[0].reset(); // reset form on modals
   
      //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('Attendance/edit_student_attendance/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              var st = data.date;
              var dt = new Date(st);
              var tanggal = dt.getDate();
              if(tanggal <10 ){tanggal='0'+tanggal;}
              var bulan = dt.getMonth();
              var tahun = dt.getFullYear();
              var namabulan = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
              $('[name="attendance_id"]').val(data.attendance_id);
              $('[name="student_id"]').val(data.student_id);
              $('[name="date_in"]').datepicker('update',tanggal+'-'+namabulan[bulan]+'-'+tahun);
              $('[name="time_in"]').val(data.time_in);
              $('[name="time_out"]').val(data.time_out);
              $('#form_edit').attr('action', '<?php echo site_url('Attendance/edit_studentatt_action')?>');
              $('#modal-edit').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title-edit').text('Ubah Waktu'); // Set title to Bootstrap modal title
   
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      })
    }
</script>
<script src="<?php echo base_url() ?>assets/dist/js/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</body>
</html>