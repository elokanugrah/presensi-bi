<?php $this->load->view('headerfooter/header_admin'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data
        <small>kehadiran magang</small>
      </h1>
      <ol class="breadcrumb">
        <li class="<?php echo active_link('Report'); ?>"><a href="#"><i class="fa fa-files-o"></i> Laporan Rekapitulasi</a></li>
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
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Kehadiran Magang</h3>
              <a href="javascript:void(0)" onclick="add_datetime()" class="btn btn-primary btn-sm badge mt-1 pull-right" style="margin-left: 20px;"><i class="fa fa-plus" style="margin-right: 5px;"></i> Per nama</a>
              <a href="<?php echo site_url('Report/add_perdate') ?>" class="btn btn-primary btn-sm badge mt-1 pull-right" style="margin-left: 20px;"><i class="fa fa-plus" style="margin-right: 5px;"></i> Per tanggal</a>
              <a href="<?php echo site_url('Report/import_data') ?>" class="btn bg-teal btn-sm badge mt-1 pull-right" style="margin-left: 20px;"><span class="fa fa-file-excel-o" style="padding-right: 5px;"></span>Import</a>
              <a href="javascript:void(0)" onclick="exp()" class="btn bg-teal btn-sm badge mt-1 pull-right" style="margin-left: 20px;"><span class="fa fa-file-excel-o" style="padding-right: 5px;"></span> Export</a>
              <a href="javascript:void(0)" onclick="print()" class="btn btn-info btn-sm badge mt-1 pull-right"><span class="fa fa-print"></span> Print</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="form-group has-feedback">
                  <div class="col-md-12 pull-right">
                    <form role="form" id="date-form" action="" method="get">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="reservation" value="<?php echo $date; ?>">
                      <input type="hidden" name="start" value="<?php echo $start; ?>">
                      <input type="hidden" name="end" value="<?php echo $end; ?>">
                      <div class="input-group-addon">
                        <button type="submit" class="btn btn-info btn-sm badge mt-1">Lihat</button>
                        <a href="<?php echo site_url('Report') ?>" class="btn btn-default btn-sm badge mt-1">Reset</a>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <div style="padding-top: 20px;"></div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>PIN</th>
                  <th>Tanggal</th>
                  <th>Nama</th>
                  <th>Waktu Masuk</th>
                  <th>Status Masuk</th>
                  <th>Waktu Keluar</th>
                  <th>Status Keluar</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data_attendance as $key => $row) {?>
                <tr>
                  <td><?php echo $key+1; ?></td>
                  <td><?php echo $row->qrcode_id; ?></td>
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
                  <td><?php echo $row->name; ?></td>
                  <td><?php echo $row->time_in; ?></td>
                  <?php if ($row->status_in == 'on time') {
                    $label_in = 'label-success';
                  } else {
                    $label_in = 'label-warning';
                  } ?>
                  <td><span class="label <?php echo $label_in; ?>"><?php echo $row->status_in; ?></span></td>
                  <td><?php echo $row->time_out; ?></td>
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
                  <td><span class="label <?php echo $label_note; ?>"><?php echo $row->note; ?></span> <a class="btn btn-default btn-sm badge mt-1 pull-right" href="javascript:void(0)" onclick="edit_note('<?php echo $row->attendance_id; ?>', '<?php echo $row->name; ?>')" ><i class="fa fa-edit"></i></a></td>
                  <td align="center">
                    <a class="btn btn-info btn-sm badge mt-1" href="javascript:void(0)" onclick="edit_datetime('<?php echo $row->attendance_id; ?>', '<?php echo $row->name; ?>')"><i class="fa fa-pencil"></i></a>
                    <a href="<?php echo site_url('Report/delete/'.$row->attendance_id) ?>" data-name="<?php echo $row->name; ?>" data-date="<?php echo $dateday; ?>" class="btn btn-danger btn-sm badge mt-1 delete-data"><i class="fa fa-trash"></i></a>
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
    <!-- modal-add -->
    <div class="modal fade" id="modal-add">
      <div class="modal-dialog">
        <div class="modal-content">
          <form role="form" id="form_add" action="#" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title-add"></h4>
          </div>
          <div class="box-body">
            <div class="form-group col-xs-12">
              <label class="control-label">Nama</label>
                <select class="form-control select2" name="student_id" style="width: 100%;" required>
                    <?php foreach ($data_student as $key => $row) {?>
                    <option value="<?php echo $row->student_id; ?>"><?php echo $row->id_number; ?> - <?php echo $row->name; ?></option>
                    <?php } ?>
                </select>
            </div>
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
                <div class="input-group">
                <div class="form-group has-feedback">
                  <select class="form-control" name="note" required>
                      <option value="" selected hidden>Kehadiran</option>
                      <option value="Hadir">Hadir</option>
                      <option value="Alpha">Alpha</option>
                      <option value="Sakit">Sakit</option>
                      <option value="Izin">Izin</option>
                  </select>
                </div>
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-list-alt"></i>
                </div>
              </div>
            </div>
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
    <!-- modal-note -->
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
                    <option value="" selected hidden>Kehadiran</option>
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
            <input name="date_inn" hidden>
            <input name="name2" hidden>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- modal-edit -->
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
                  <input type="text" name="date_in" class="form-control" id="datepicker2">
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
            <input name="name3" hidden>
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
<!-- date-range-picker -->
<script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    $('#example1').DataTable()

  //Date range picker
  function cb(start, end) {
      $('[name="start"]').val(start.format('DD-MM-YYYY'));
      $('[name="end"]').val(end.format('DD-MM-YYYY'));
  }

  $('#reservation').daterangepicker({
      locale: {
          format: 'DD-MMM-YYYY'
      },
      ranges: {
         'Hari ini': [moment(), moment()],
         'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         '7 Hari terakhir': [moment().subtract(6, 'days'), moment()],
         '30 Hari terakhir': [moment().subtract(30, 'days'), moment()],
         'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
         'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
  }, cb)

    /*$(".applyBtn").on('click', function() {
        const name = $('[name="date"]').val();
        alert("Form submitted " + name);
        $("#date-form").submit();
    })*/

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
      const name = $(this).attr('data-name');
      const date = $(this).attr('data-date');
      Swal.fire({
        title: 'Yakin ingin menghapus data \nkehadiran '+name+'?',
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
  })

  function print()
  {
    $('#date-form')[0].reset();
    $('#date-form').attr('action', '<?php echo site_url('Report/print')?>');
    $('#date-form').attr('target', '_blank');
    $('#date-form').submit();
  }

  function exp()
  {
    $('#date-form')[0].reset();
    $('#date-form').attr('action', '<?php echo site_url('Report/export')?>');
    $('#date-form').submit();
  }

  function add_datetime()
  {
    $('#form_add')[0].reset(); // reset form on modals
 
    $('#form_add').attr('action', '<?php echo site_url('Report/add_studentatt_action')?>');
    $('#modal-add').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title-add').text('Tambah Kehadiran'); // Set title to Bootstrap modal title
  }

  function edit_note(id, name)
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
            $('[name="name2"]').val(name);
            $('#form_note').attr('action', '<?php echo site_url('Report/edit_studentnote_action')?>');
            $('#modal-note').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title-note').text('Ubah Keterangan'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    })
  }

  function edit_datetime(id, name)
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
            $('[name="name3"]').val(name);
            $('#form_edit').attr('action', '<?php echo site_url('Report/edit_studentatt_action')?>');
            $('#modal-edit').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title-edit').text('Ubah waktu kehadiran a/n '+name); // Set title to Bootstrap modal title
 
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