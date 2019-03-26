<?php $this->load->view('headerfooter/header_admin'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data
        <small>admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <div class="col-xs-12">
    <?php if ($this->session->has_userdata('failed_message')) { ?>
    <div class="alert alert-danger alert-dismissible" style="margin-top:30px;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-ban"></i><?php echo $this->session->flashdata('failed_message'); ?>
      </div>
      <?php } ?>
    </div>
    <?php if ($resetpassword) { ?>
    <section class="content">
      <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <form role="form" action="<?php echo $action_username; ?>" method="post">
            <div class="box-header with-border">
              <h3 class="box-title">Update Profil</h3>
            </div>
            <!-- /.box-header -->
            <div style="padding-top: 10px;"></div>
            <div class="box-body no-padding">
              <div class="form-group col-xs-12">
                <label>Username</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                  </div>
                  <input type="text" class="form-control" name="username" value="<?php echo $data_admin->username; ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group col-xs-12">
                <label>Email</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                  </div>
                  <input type="email" class="form-control" name="email" value="<?php echo $data_admin->email; ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input name="admin_id" value="<?php echo $data_admin->admin_id; ?>" hidden>
              <button type="reset" class="btn btn-default">Reset</button>
              <button type="submit" class="btn btn-primary pull-right">Perbarui</button>
            </div>
          </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <div class="box">
            <form role="form" action="<?php echo $action_resetpassword; ?>" method="post">
            <div class="box-header with-border">
              <h3 class="box-title">Update Password</h3>
            </div>
            <!-- /.box-header -->
            <div style="padding-top: 10px;"></div>
            <div class="box-body no-padding">
              <div class="form-group col-xs-12">
                <label>Password Lama</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-lock"></i>
                  </div>
                  <input type="password" class="form-control" name="old_password" disabled>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group col-xs-12">
                <label>Password Baru</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-lock"></i>
                  </div>
                  <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group col-xs-12">
                <label>Ulangi Password Baru</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-lock"></i>
                  </div>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group col-xs-12">
                <span id="message"></span>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input name="admin_id" value="<?php echo $data_admin->admin_id; ?>" hidden>
              <button type="reset" class="btn btn-default">Reset</button>
              <button type="submit" class="btn btn-primary pull-right">Perbarui</button>
            </div>
          </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  <?php } else { ?>
    <section class="content">
      <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <form role="form" action="<?php echo $action_username; ?>" method="post">
            <div class="box-header with-border">
              <h3 class="box-title">Update Profil</h3>
            </div>
            <!-- /.box-header -->
            <div style="padding-top: 10px;"></div>
            <div class="box-body no-padding">
              <div class="form-group col-xs-12">
                <label>Username</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                  </div>
                  <input type="text" class="form-control" name="username" value="<?php echo $data_admin->username; ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group col-xs-12">
                <label>Email</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                  </div>
                  <input type="email" class="form-control" name="email" value="<?php echo $data_admin->email; ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input name="admin_id" value="<?php echo $data_admin->admin_id; ?>" hidden>
              <button type="reset" class="btn btn-default">Reset</button>
              <button type="submit" class="btn btn-primary pull-right">Perbarui</button>
            </div>
          </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <div class="box">
            <form role="form" action="<?php echo $action_password; ?>" method="post">
            <div class="box-header with-border">
              <h3 class="box-title">Update Password</h3>
            </div>
            <!-- /.box-header -->
            <div style="padding-top: 10px;"></div>
            <div class="box-body no-padding">
              <div class="form-group col-xs-12">
                <label>Password Lama</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-lock"></i>
                  </div>
                  <input type="password" class="form-control" name="old_password" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group col-xs-12">
                <label>Password Baru</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-lock"></i>
                  </div>
                  <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group col-xs-12">
                <label>Ulangi Password Baru</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="glyphicon glyphicon-lock"></i>
                  </div>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group col-xs-12">
                <span id="message"></span>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input name="admin_id" value="<?php echo $data_admin->admin_id; ?>" hidden>
              <button type="reset" class="btn btn-default">Reset</button>
              <button type="submit" class="btn btn-primary pull-right">Perbarui</button>
            </div>
          </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  <?php } ?>
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('headerfooter/footer_admin'); ?>
<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    //on keypress 
    $('#confirm_password').on('keyup', function () {
    if ($('#new_password').val() == $('#confirm_password').val()) {
      $('#message').html('Password sesuai').css('color', 'green');
    } else 
      $('#message').html('Password tidak sesuai').css('color', 'red');
    })
})
</script>
</body>
</html>