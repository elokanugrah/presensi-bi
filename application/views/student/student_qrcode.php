<?php $this->load->view('headerfooter/header_guest'); ?>

<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <img src="<?php echo base_url() ?>assets/dist/img/perpustakaan.png" height="64">
    </div>
    <!-- /.login-logo -->
    <?php if ($this->session->has_userdata('login_message')) { ?>
     <div class="alert alert-danger alert-dismissible" style="margin-top:30px;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-ban"></i><?php echo $this->session->flashdata('login_message'); ?>
      </div>
    <?php } ?>
    <div class="login-box-body">
        <p class="login-box-msg">Masuk untuk memulai sesi anda</p>
        <div class="main_panel">
            <form id="form-student" role="form" action="" method="post">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-qrcode"></i>
                </div>
                <input type="file" class="form-control" name="qrcode" id="file-selector" required>
                <input type="hidden" name="old_qrcode">
              </div>
              <span style="font-size: 13px; color: #999;">Tipe file yang diizinkan: jpg, png, gif (maks : 3 MB)</span>
              <!-- /.input group -->
              <label style="padding-top: 10px;">Hasil QR Code</label>
              <div class="input-group" id="bg-qrcode">
                <span id="file-qr-result">None</span>
              </div>
              <div class="input-group" style="display: block; padding-top: 10px;">
                <img id="blah" name="preview" src="" alt="your image" style="max-height: : 100px; max-width: 100px; display: block; margin: auto;" />
              </div>

            <div class="social-auth-links">
              <input name="qrcode_id" id="qrcode_id" hidden>
              <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
          </div>
      </form>
      <script type="module">
        import QrScanner from "<?php echo base_url() ?>assets/qr-scanner.min.js";
        QrScanner.WORKER_PATH = '<?php echo base_url() ?>assets/qr-scanner-worker.min.js';

        const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');
        const fileSelector = document.getElementById('file-selector');
        const fileQrResult = document.getElementById('file-qr-result');
        const fileQrBg = document.getElementById('bg-qrcode');
        const fileQrResultQr = document.getElementById('qrcode_id');

        function setResult(label, result) {
            label.textContent = result;
            label.style.color = "white";
            fileQrBg.style.backgroundColor = "#00a65a";
            fileQrResultQr.value = result;
            clearTimeout(label.highlightTimeout);
            label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 500);
            clearTimeout(fileQrBg.highlightTimeout);
            fileQrBg.highlightTimeout = setTimeout(() => fileQrBg.style.backgroundColor = 'inherit', 500);
        }

        // ####### File Scanning #######

        fileSelector.addEventListener('change', event => {
            const file = fileSelector.files[0];
            if (!file) {
                return;
            }
            QrScanner.scanImage(file)
                .then(result => setResult(fileQrResult, result))
                .catch(e => setResult(fileQrResult, e || 'No QR code found.'));
        });
    </script>
  </div>
</div>
</div>
<!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('[name="preview"]').attr('src', './upload/default.jpg');
    $('#form-student').attr('action', '<?php echo site_url('Student')?>');

    //Initialize Select2 Elements
    $('.select2').select2()

    $("#file-selector").change(function (e) {
      var fileExtension = ['jpg', 'png', 'gif'];
      if (this.files[0].size >= 3000000){
        e.preventDefault();
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          text: 'Ukuran maksimal QR Code yang diizinkan : 3 MB'
        })
        $('#form-student')[0].reset();
        $('[name="preview"]').attr('src', './upload/default.jpg');
      }
      if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        e.preventDefault();
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          text: 'Format QR Code yang diizinkan : '+fileExtension.join(', ')
        })
        $('#form-student')[0].reset();
        $('[name="preview"]').attr('src', './upload/default.jpg');
      }
      readURL(this);
    })
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