<?php $this->load->view('headerfooter/header_admin'); ?>
<!-- <style type="text/css">
  body {
    padding-right: 0 !important;
  }
</style> -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data
        <small>siswa magang</small>
      </h1>
      <ol class="breadcrumb">
        <li class="<?php echo active_link('StudentIntern'); ?>"><a href="#"><i class="fa fa-table"></i> Siswa magang</a></li>
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
              <h3 class="box-title">Data Siswa Magang</h3>
              <a href="javascript:void(0)" onclick="add_datetime()" class="btn btn-primary btn-sm badge mt-1 pull-right" style="margin-left: 20px;"><i class="fa fa-plus"></i>
              <a href="<?php echo site_url('StudentIntern/import_data') ?>" class="btn bg-teal btn-sm badge mt-1 pull-right" style="margin-left: 20px;"><span class="fa fa-file-excel-o" style="padding-right: 5px;"></span>Import</a>
              <a href="<?php echo site_url('StudentIntern/export')?>" class="btn bg-teal btn-sm badge mt-1 pull-right" style="margin-left: 20px;"><span class="fa fa-file-excel-o" style="padding-right: 5px;"></span> Export</a></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>No. Induk Magang</th>
                  <th>Unit</th>
                  <th>Mentor</th>
                  <th>Asal</th>
                  <th>Status Magang</th>
                  <th>Periode Magang</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data_student as $key => $row) {?>
                <tr>
                  <td><?php echo $key+1; ?></td>
                  <td><?php echo $row->name; ?></td>
                  <td><?php echo $row->qrcode_id; ?> <a href="javascript:void(0)"  id="download" onclick="download_qr('<?php echo $row->qrcode_id; ?>', '<?php echo $row->name; ?>')" class="btn btn-default btn-sm badge mt-1 pull-right"><i class="fa fa-qrcode"></i></a></td>
                  <td><?php echo $row->unit_name; ?></td>
                  <td><?php echo $row->mentor_name; ?></td>
                  <td><?php echo $row->collage; ?></td>
                  <?php if ($row->active == 'Aktif') {
                    $label = 'label-success';
                  } else {
                    $label = 'label-danger';
                  } ?>
                  <td><span class="label <?php echo $label; ?>"><?php echo $row->active; ?></span></td>
                  <td><?php 
                  $date_now = date("Y-m-d");
                  // $status = (($date_now >= $row->date_in) && ($date_now <= $row->date_out))? 'Aktif' : 'Non Aktif';
                  if (($date_now >= $row->date_in) && ($date_now <= $row->date_out)) {
                     $status = ($row->active == 'Aktif')? 'bg-purple' : 'bg-orange';
                  } else {
                  $status = ($row->active == 'Non Aktif')? 'bg-purple' : 'bg-orange';
                  }
                  echo date("d-m-Y", strtotime($row->date_in)).' ~ '. date("d-m-Y", strtotime($row->date_out));
                  ?>
                  <div class="pull-right"><span class="label <?php echo $status; ?>"><li class="fa <?php echo $icon = ($status == 'bg-purple')? 'fa-check' : 'fa-close'; ?>"></li></span></div><div class="hidden"><?php echo $forsearch = ($status == 'bg-purple')? 'benar' : 'salah'; ?></div></td>
                  <td align="center">
                    <a href="<?php echo site_url('StudentIntern/student/'.$row->student_id) ?>" class="btn btn-default btn-sm badge mt-1"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-info btn-sm badge mt-1" href="javascript:void(0)" onclick="edit_datetime('<?php echo $row->student_id; ?>')"><i class="fa fa-pencil"></i></a>
                    <a href="<?php echo site_url('StudentIntern/delete/'.$row->student_id) ?>" data-name="<?php echo $row->name; ?>" class="btn btn-danger btn-sm badge mt-1 delete-data"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php } ?>
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
    <div class="modal fade" id="modal-qr">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title-qr"></h4>
          </div>
          <div class="box-body">
            <div id="qrCanvas" align="center"></div>
          </div>
          <div class="modal-footer">
            <p align="center" style="font-size: 13px; color: #999; font-weight: lighter;">Klik kanan untuk menyimpan gambar</p>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-add">
      <div class="modal-dialog">
        <div class="modal-content">
          <form role="form" id="form_add" action="#" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title-add"></h4>
          </div>
          <div class="box-body">
            <div class="form-group col-xs-9">
              <label>Nomor Induk Magang (QR Code)</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-qrcode"></i>
                </div>
                <input type="text" class="form-control" name="qrcode_id" name="qrcode_id" placeholder="format: M-XX-XXXX" maxlength="9" required>
              </div>
              <label style="font-size: 13px; color: #999; font-weight: lighter;">Nomor Induk Magang (NIM) dihasilkan secara automatis.</label>
              <!-- /.input group -->
              <br>
              <label>Format</label>
              <div class="input-group" id="bg-qrcode">
                <span>M-(Tahun Buku)-XXXX</span>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-3">
              <label>Preview</label>

              <div class="input-group">
                <div id="canvasQR"></div>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="form-group col-xs-12">
              <label>NIM / NIS</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-credit-card"></i>
                </div>
                <input type="text" class="form-control" name="id_number" id="id_number" required>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-6">
              <label>Nama</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-user"></i>
                </div>
                <input type="text" class="form-control" name="name" required>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-6">
              <label>Jenis Kelamin</label>
              <div class="form-group has-feedback">
                <select class="form-control" name="sex" required>
                    <option value="NaN" selected hidden>Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-12">
              <label>Tingkat Pendidikan</label>
              <div class="form-group has-feedback">
                <select class="form-control select2" name="edulvl_id" style="width: 100%;" required>
                  <option></option>
                  <?php foreach ($level as $key => $row) {?>
                    <option value="<?php echo $row->edulvl_id; ?>"><?php echo $row->edulvl_name; ?></option>
                  <?php } ?>
                </select>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-6">
              <label>Asal Sekolah / Lembaga</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-university"></i>
                </div>
                <input type="text" class="form-control" name="collage" required>
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group col-xs-6">
              <label>Jurusan</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-gears"></i>
                </div>
                <input type="text" class="form-control" name="vocational" required>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-6">
              <label>No Handphone</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-phone"></i>
                </div>
                <input type="text" class="form-control" name="phone" required>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-6">
              <label>Status</label>
              <div class="form-group has-feedback">
                <select class="form-control" name="active" required>
                  <option value="NaN" selected hidden>Status</option>
                  <option value="Aktif">Aktif</option>
                  <option value="Non Aktif">Non Aktif</option>
                </select>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-6">
              <label>Tanggal Mulai</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="date_in" class="form-control" id="datepicker" value="">
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group col-xs-6">
              <label>Tanggal Selesai</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="date_out" class="form-control" id="datepicker2" value="">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-6">
              <label>Unit</label>
              <div class="form-group has-feedback">
                <select class="form-control select2" name="unit_id" style="width: 100%;" required>
                  <option></option>
                  <?php foreach ($unit as $key => $row) {?>
                    <option value="<?php echo $row->unit_id; ?>"><?php echo $row->unit_name; ?></option>
                  <?php } ?>
                </select>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-6">
              <label>Mentor</label>
              <div class="form-group has-feedback">
                <select class="form-control select2" name="mentor_id" style="width: 100%;" required>
                  <option></option>
                  <?php foreach ($mentor as $key => $row) {?>
                    <option value="<?php echo $row->mentor_id; ?>"><?php echo $row->nip; ?> - <?php echo $row->name; ?></option>
                  <?php } ?>
                </select>
              </div>
              <!-- /.input group -->
            </div>
            <div class="col-xs-12">
              <label>Alamat</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-home"></i>
                </div>
                <textarea rows="2" class="form-control" name="address" required></textarea>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
          </div>
          <div class="modal-footer">
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
<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/jquery.qrcode.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/qrcode.js"></script>
<script src="<?php echo base_url() ?>assets/dist/js/sweetalert2.all.min.js"></script>
<script>
  $(function () {
    $('[name="qrcode_id"]').on('keyup', function () {
      $('#canvasQR').empty();
      var value = $('[name="qrcode_id"]').val();
      $('#canvasQR').qrcode({width: 100, height: 100, text  : value});
    })

    $('[name="qrcode_id"]').on( "keydown", function( event ) {
      
      
      // When user select text in the document, also abort.
      var selection = window.getSelection().toString();
      if ( selection !== '' ) {
        return;
      }
      
      // When the arrow keys are pressed, abort.
      if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
        return;
      }
      
      var $this = $(this);
      var input = $this.val();
          input = input.replace(/[\W\s\._\-]+/g, '');
        
        var split = 1;
        var chunk = [];

        for (var i = 0, len = input.length; i < len; i += split) {
          if (i < 1) {
            split = 1;
          } else {
            split = ( i >= 2 ) ? 4 : 2;
          }
          chunk.push( input.substr( i, split ) );
        }

        $this.val(function() {
          return chunk.join("-").toUpperCase();
        });
    
    });
    //Initialize Select2 Elements
    $('[name="edulvl_id"]').select2({
        placeholder: "Pilih tingkat pendidikan..."
    })

    $('[name="unit_id"]').select2({
        placeholder: "Pilih unit..."
    })

    $('[name="mentor_id"]').select2({
        placeholder: "Pilih mentor..."
    })

    $('#example1').DataTable()


    //Date picker
    $('#datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "top auto",
      todayHighlight: true,  
    })

    $('#datepicker2').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "top auto",
      todayHighlight: true,  
    })

    $('.delete-data').on('click', function(e) {
      e.preventDefault();
      const href = $(this).attr('href');
      const name = $(this).attr('data-name');
      Swal.fire({
        title: 'Yakin ingin menghapus data \nsiswa magang?',
        text: "data siswa magang a/n "+name+" akan dihapus!",
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

    $('#canvasQR').empty();
  })

  function add_datetime()
  {
    $('#form_add')[0].reset(); // reset form on modals
    $('#canvasQR').empty();
    
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('StudentIntern/max/')?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          var d = new Date();
          var ybook = d.getFullYear();
          var qr = (parseInt(data.qrcode_id)+1);
          var newqr = 'M-'+(ybook - 1998)+'-'+qr.toString().padStart(4, "0");
          $('[name="qrcode_id"]').val(newqr);
          $('#canvasQR').qrcode({width: 100, height: 100, text  : newqr});
          $('#form_add').attr('action', '<?php echo site_url('StudentIntern/add_action')?>');
          $('#modal-add').modal('show'); // show bootstrap modal when complete loaded
          $('.modal-title-add').text('Tambah Siswa Magang'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    })
  }

  function edit_datetime(id)
  {
    $('#form_add')[0].reset(); // reset form on modals
    $('#canvasQR').empty();
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('StudentIntern/edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          var namabulan = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var st_in = data.date_in;
            var dt_in = new Date(st_in);
            var tanggal_in = dt_in.getDate();
            if(tanggal_in <10 ){tanggal_in='0'+tanggal_in;}
            var bulan_in = dt_in.getMonth();
            var tahun_in = dt_in.getFullYear();
            var date_in = (data.date_in != '') ? tanggal_in+'-'+namabulan[bulan_in]+'-'+tahun_in : '';

            var st_out = data.date_out;
            var dt_out = new Date(st_out);
            var tanggal_out = dt_out.getDate();
            if(tanggal_out <10 ){tanggal_out='0'+tanggal_out;}
            var bulan_out = dt_out.getMonth();
            var tahun_out = dt_out.getFullYear();
            var date_out = (data.date_out != '') ? tanggal_out+'-'+namabulan[bulan_out]+'-'+tahun_out : '';

            $('[name="student_id"]').val(data.student_id);
            $('[name="qrcode_id"]').val(data.qrcode_id);
            $('#canvasQR').qrcode({width: 100, height: 100, text  : data.qrcode_id});
            // $('[name="preview"]').attr('src', './upload/'+data.qrcode);
            $('[name="id_number"]').val(data.id_number);
            $('[name="name"]').val(data.name);
            $('[name="sex"]').val(data.sex);
            $('[name="active"]').val(data.active);
            $('[name="date_in"]').datepicker('update',date_in);
            $('[name="date_out"]').datepicker('update',date_out);
            $('[name="collage"]').val(data.collage);
            $('[name="vocational"]').val(data.vocational);
            $('[name="phone"]').val(data.phone);
            $('[name="mentor_id"]').val(data.mentor_id).trigger('change');
            $('[name="unit_id"]').val(data.unit_id).trigger('change');
            $('[name="edulvl_id"]').val(data.edulvl_id).trigger('change');
            $('[name="address"]').val(data.address);
            $('#form_add').attr('action', '<?php echo site_url('StudentIntern/edit_action')?>');
            $('#modal-add').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title-add').text('Ubah Data Siswa Magang'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    })
  }

  function download_qr($qrcode_id, $name)
  {
    $('#modal-qr').modal('show');
    $('.modal-title-qr').text('Kode QR a/n '+$name);
    $('#qrCanvas').empty();
    $('#qrCanvas').qrcode({width: 240, height: 240, text  : $qrcode_id});
  }

  /*function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
  }*/
</script>
</body>
</html>