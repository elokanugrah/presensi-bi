<?php $this->load->view('headerfooter/header_admin'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data
        <small>jenis buku</small>
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
              <h3 class="box-title">Data Jenis Buku</h3>
              <button type="button" class="btn btn-success btn-sm badge mt-1 pull-right" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis Buku</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data_booktype as $key => $row) {?>
                <tr>
                  <td><?php echo $key+1; ?></td>
                  <td><?php echo $row->booktype_name; ?></td>
                  <td align="center">
                    <button type="button" class="btn btn-info btn-sm badge mt-1" data-toggle="modal" data-target="#modal-default<?php echo $row->booktype_id; ?>"><i class="fa fa-pencil"></i></button>
                    <button type="button" class="btn btn-danger btn-sm badge mt-1" data-toggle="modal" data-target="#modal-delete<?php echo $row->booktype_id; ?>"><i class="fa fa-trash"></i></button>
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
              <form role="form" action="<?php echo site_url('Booktype/add_action');?>" method="post">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Data Jenis Buku</h4>
              </div>
              <div class="modal-body">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-book"></i>
                  </div>
                  <input type="text" class="form-control" name="booktype_name" placeholder="Jenis Buku">
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
    <!-- /.content -->
      <?php foreach ($data_booktype as $key => $row) {?>
        <div class="modal fade" id="modal-default<?php echo $row->booktype_id; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <form role="form" action="<?php echo $action; ?>" method="post">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Data Jenis Buku</h4>
              </div>
              <div class="modal-body">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-book"></i>
                  </div>
                  <input type="text" class="form-control" name="booktype_name" value="<?php echo $row->booktype_name;?>" placeholder="Jenis Buku" >
                </div>
              </div>
              <div class="modal-footer">
                <input name="booktype_id" value="<?php echo $row->booktype_id;?>" hidden>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      <?php }?>
        <!-- /.modal -->
      <?php foreach ($data_booktype as $key => $row) {?>
        <div class="modal modal-danger fade" id="modal-delete<?php echo $row->booktype_id; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <form role="form" action="<?php echo site_url('Booktype/delete/'.$row->booktype_id) ?>" method="post">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data Jenis Buku</h4>
              </div>
              <div class="modal-body">
                <p>Yakin ingin menghapus jenis buku <?php echo $row->booktype_name; ?>?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline">Hapus</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      <?php }?>
        <!-- /.modal -->
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
  })
</script>
</body>
</html>