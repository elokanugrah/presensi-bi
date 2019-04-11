<?php $this->load->view('headerfooter/header_admin'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data
        <small>mentor</small>
      </h1>
      <ol class="breadcrumb">
        <li class="<?php echo active_link('Mentor'); ?>"><a href="<?php echo site_url('Mentor') ?>"><i class="fa fa-table"></i> Mentor</a></li>
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
              <h3 class="box-title">Data Mentor</h3>
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
<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
  <script>
  $(function () {
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