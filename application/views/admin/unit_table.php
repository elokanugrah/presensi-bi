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
        <li class="<?php echo active_link('Unit'); ?>"><a href="<?php echo site_url('Unit') ?>"><i class="fa fa-table"></i> Unit</a></li>
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
              <h3 class="box-title">Data Unit</h3>
              <a href="javascript:void(0)" onclick="add_datetime()" class="btn btn-primary btn-sm badge mt-1 pull-right" style="margin-left: 20px;"><i class="fa fa-plus"></i></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Unit</th>
                  <th>Icon Unit</th>
                  <th>Deskripsi</th>
                  <th>Terlihat oleh umum</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data_unit as $key => $row) {?>
                <tr>
                  <td><?php echo $key+1; ?></td>
                  <td><?php echo $row->unit_name; ?></td>
                  <td><img src="./upload/<?php echo $row->unit_icon; ?>" alt="<?php echo $row->unit_name; ?>" style="width: 36px; height: 36px; background-color: #cccccc;" /></td>
                  <td><?php echo $str = (strlen($row->description) >= 50)? substr($row->description, 0, 50).'...' : $row->description; ?> <a class="btn btn-info btn-sm badge mt-1 pull-right" href="<?php echo site_url('Unit/description/'.$row->unit_id) ?>"><i class="fa fa-file-text-o"></i></a></td>
                  <td><?php echo ($row->active != true)? 'Tersembunyi <a class="btn btn-danger btn-sm badge mt-1 pull-right active-data" href="'.site_url('Unit/active/'.$row->unit_id).'" data-name="'.$row->unit_name.'" data-active="'.$row->active.'"><i class="fa fa-eye-slash"></i></a>' : 'Terlihat <a class="btn btn-success btn-sm badge mt-1 pull-right active-data" href="'.site_url('Unit/active/'.$row->unit_id).'" data-name="'.$row->unit_name.'" data-active="'.$row->active.'"><i class="fa fa-eye"></i></a>'; ?></td>
                  <td align="center">
                    <a class="btn btn-info btn-sm badge mt-1" href="javascript:void(0)" onclick="edit_datetime('<?php echo $row->unit_id; ?>')"><i class="fa fa-pencil"></i></a>
                    <a href="<?php echo site_url('Unit/delete/'.$row->unit_id) ?>" data-name="<?php echo $row->unit_name; ?>" class="btn btn-danger btn-sm badge mt-1 delete-data"><i class="fa fa-trash"></i></a>
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
    <div class="modal fade" id="modal-unit">
      <div class="modal-dialog">
        <div class="modal-content">
          <form role="form" id="form-unit" action="#" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title-unit"></h4>
          </div>
          <div class="box-body">
            <div class="form-group col-xs-9">
              <label>Icon Unit</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-picture"></i>
                </div>
                <input type="file" class="form-control" name="unit_icon" id="file-selector" required onchange="readURL(this);">
                <input type="hidden" name="old_icon">
              </div>
              <span style="font-size: 13px; color: #999;">Tipe file yang diizinkan: png (maks : 120 KB)</span>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-3">
              <label>Preview</label>

              <div class="input-group">
                <img id="blah" name="preview" src="" alt="your image" style="width: 100px; height: 100px; background-color: #cccccc;" />
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="form-group col-xs-12">
              <label>Nama Unit</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-building"></i>
                </div>
                <input type="text" class="form-control" name="unit" required>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="col-xs-12">
              <label>Terlihat oleh umum</label>

              <div class="form-group has-feedback">
                <select class="form-control" name="active" required>
                  <option value="1">Terlihat</option>
                  <option value="0">Tersembunyi</option>
                </select>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
          </div>
          <div class="modal-footer">
            <input name="unit_id" hidden>
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
        title: 'Yakin ingin menghapus \ndata unit?',
        text: "data unit "+name+" akan dihapus!",
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

    $('.active-data').on('click', function(e) {
      e.preventDefault();
      const href = $(this).attr('href');
      const name = $(this).attr('data-name');
      var active = ($(this).attr('data-active') != true) ? 'tampilkan' : 'sembunyikan';
      Swal.fire({
        title: 'Yakin ingin '+active+' \ndata unit?',
        text: "data unit "+name+" akan di "+active+"!",
        type: 'question',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: (active != 'sembunyikan') ? '#71cc00' : '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, '+active+'!'
      }).then((result) => {
        if (result.value) {
          document.location.href = href;
        }
      })
    })
  })

  function add_datetime()
  {
    $('#form-unit')[0].reset(); // reset form on modals
 
    $('#form-unit').attr('action', '<?php echo site_url('Unit/add_action')?>');
    $('[name="preview"]').attr('src', './upload/default.jpg');
    $('#modal-unit').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title-unit').text('Tambah Unit'); // Set title to Bootstrap modal title
  }

  function edit_datetime(id)
  {
    $('#form-unit')[0].reset(); // reset form on modals
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('Unit/edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('[name="unit_id"]').val(data.unit_id);
          $('[name="unit"]').val(data.unit_name);
          $('[name="unit_icon"]').prop('required',false);
          $('[name="old_icon"]').val(data.unit_icon);
          $('[name="active"]').val(data.active);
          $('[name="preview"]').attr('src', './upload/'+data.unit_icon);
          $('#form-unit').attr('action', '<?php echo site_url('Unit/edit_action')?>');
          $('#modal-unit').modal('show'); // show bootstrap modal when complete loaded
          $('.modal-title-unit').text('Ubah Data Unit'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    })
  }

  $("#file-selector").change(function (e) {
      var fileExtension = ['png'];
      if (this.files[0].size >= 120000){
        e.preventDefault();
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          text: 'Ukuran maksimal icon diizinkan : 120 KB'
        })
        $('#modal-unit').modal('hide');
      }
      if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        e.preventDefault();
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          text: 'Format icon yang diizinkan : '+fileExtension.join(', ')
        })
        $('#modal-unit').modal('hide');
      }
  })

  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#blah')
                  .attr('src', e.target.result);
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
</script>
<script src="<?php echo base_url() ?>assets/dist/js/sweetalert2.all.min.js"></script>
</body>
</html>