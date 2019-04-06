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
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Siswa Magang</h3>
              <a href="javascript:void(0)" onclick="add_datetime()" class="btn btn-primary btn-sm badge mt-1 pull-right" style="margin-left: 20px;"><i class="fa fa-plus"></i></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Asal</th>
                  <th>Alamat</th>
                  <th>Status Magang</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data_student as $key => $row) {?>
                <tr>
                  <td><?php echo $key+1; ?></td>
                  <td><?php echo $row->id_number; ?></td>
                  <td><?php echo $row->name; ?></td>
                  <td><?php echo $row->sex; ?></td>
                  <td><?php echo $row->collage; ?></td>
                  <?php if ($row->active == 'Aktif') {
                    $label = 'label-success';
                  } else {
                    $label = 'label-danger';
                  } ?>
                  <td><?php echo $row->address; ?></td>
                  <td><span class="label <?php echo $label; ?>"><?php echo $row->active; ?></span></td>
                  <td align="center">
                    <a href="<?php echo site_url('StudentIntern/student/'.$row->student_id) ?>" class="btn btn-default btn-sm badge mt-1"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-info btn-sm badge mt-1" href="javascript:void(0)" onclick="edit_datetime('<?php echo $row->student_id; ?>')"><i class="fa fa-pencil"></i></a>
                    <a href="<?php echo site_url('StudentIntern/delete/'.$row->student_id) ?>" data-name="<?php echo $row->name; ?>" class="btn btn-danger btn-sm badge mt-1 delete-data"><i class="fa fa-trash"></i></a>
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
            <h4 class="modal-title-add"></h4>
          </div>
          <div class="box-body">
            <div class="form-group col-xs-12">
              <label>NIM</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-credit-card"></i>
                </div>
                <input type="text" class="form-control" name="id_number" required>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-6">
              <label>Nama Pengunjung</label>

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
            <div class="form-group col-xs-6">
              <label>Asal</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-university"></i>
                </div>
                <input type="text" class="form-control" name="collage" required>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="form-group col-xs-12">
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
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


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
              <label>NIM</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-credit-card"></i>
                </div>
                <input type="text" class="form-control" name="id_number" required>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-6">
              <label>Nama Pengunjung</label>

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
                    <option value="Tidak diketahui" selected hidden>Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-6">
              <label>Status</label>
              <div class="form-group has-feedback">
                <select class="form-control" name="active" required>
                  <option value="Tidak diketahui" selected hidden>Status</option>
                  <option value="Aktif">Aktif</option>
                  <option value="Non Aktif">Non Aktif</option>
                </select>
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group col-xs-6">
              <label>Asal</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-university"></i>
                </div>
                <input type="text" class="form-control" name="collage" required>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="form-group col-xs-12">
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
  })

  function add_datetime()
  {
    $('#form_add')[0].reset(); // reset form on modals
 
    $('#form_add').attr('action', '<?php echo site_url('StudentIntern/add_action')?>');
    $('#modal-add').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title-add').text('Tambah Siswa Magang'); // Set title to Bootstrap modal title
  }

  function edit_datetime(id)
  {
    $('#form_edit')[0].reset(); // reset form on modals
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('StudentIntern/edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="student_id"]').val(data.student_id);
            $('[name="id_number"]').val(data.id_number);
            $('[name="name"]').val(data.name);
            $('[name="sex"]').val(data.sex);
            $('[name="active"]').val(data.active);
            $('[name="collage"]').val(data.collage);
            $('[name="address"]').val(data.address);
            $('#form_edit').attr('action', '<?php echo site_url('StudentIntern/edit_action')?>');
            $('#modal-edit').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title-edit').text('Ubah Data Siswa Magang'); // Set title to Bootstrap modal title
 
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