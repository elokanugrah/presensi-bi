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
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="form-group col-xs-12">
                <label>Hari</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-credit-card"></i>
                  </div>
                  <input type="text" class="form-control" name="id_number" value="Senin">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div id="new-input"></div>
              <div class="form-group col-xs-1 pull-right">
                <button class="btn btn-primary btn-sm badge mt-1 pull-right" id="add"><i class="fa fa-plus"></i></button>
              </div>
              <div class="form-group col-xs-1 pull-right">
                <button class="btn btn-danger btn-sm badge mt-1 pull-right disabled" id="remove"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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
  <script>
  $(function () {
    $('#add').on('click', add);
    $('#remove').on('click', remove);
    
    var max_fields = 6;
    var x = 1;
    var d = 0;
    var days = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
    function add() {
      if(x <= max_fields){
        x++;
        d++;
        var new_input = "<div class='form-group col-xs-12 form_"+x+"'><label>Hari</label><div class='input-group'><div class='input-group-addon'><i class='glyphicon glyphicon-credit-card'></i></div><input type='text' class='form-control' name='id_number' value='"+days[d]+"'></div></div>";

        $('#new-input').append(new_input);
      }

      if(d == max_fields){
        $('#add').attr('class','btn btn-primary btn-sm badge mt-1 pull-right disabled');
      } else {
        $('#add').attr('class','btn btn-primary btn-sm badge mt-1 pull-right');
      }

      if(x <= 1){
        $('#remove').attr('class','btn btn-danger btn-sm badge mt-1 pull-right disabled');
      } else {
        $('#remove').attr('class','btn btn-danger btn-sm badge mt-1 pull-right');
      }
    }

    function remove() {
      var last_chq_no = x;

      if (last_chq_no > 1) {
        $('.form_' + last_chq_no).remove();
        x--;
        d--;
      }

      if(d == max_fields){
        $('#add').attr('class','btn btn-primary btn-sm badge mt-1 pull-right disabled');
      } else {
        $('#add').attr('class','btn btn-primary btn-sm badge mt-1 pull-right');
      }

      if(x <= 1){
        $('#remove').attr('class','btn btn-danger btn-sm badge mt-1 pull-right disabled');
      } else {
        $('#remove').attr('class','btn btn-danger btn-sm badge mt-1 pull-right');
      }
    }
  })
</script>
<script src="<?php echo base_url() ?>assets/dist/js/sweetalert2.all.min.js"></script>
</body>
</html>