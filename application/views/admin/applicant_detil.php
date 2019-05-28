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
        <li><a href="<?php echo site_url('StudentIntern') ?>"><i class="fa fa-table"></i> Siswa magang</a></li>
        <li class="<?php echo active_link('StudentIntern'); ?>"><a href="#">Detil</a></li>
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
              <h3 class="box-title">Identitas Pendaftar</h3>
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
                  <b>Nama:<br>
                  </b> <?php echo $applicant->registered_name ?><br>
                  <b>NIM / NIS:<br>
                  </b> <?php echo $applicant->idsch_num ?><br>
                  <b>Jenis Kelamin:<br>
                  </b> <?php echo $applicant->sex ?><br>
                  <b>Tempat / Tanggal Lahir:<br>
                  </b> <?php 
                  $bln = array ( 
                        1 => 'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                      ); 
                  echo $applicant->pob .' / '. date('d', strtotime($applicant->dob)) .' '. $bln[ date('n', strtotime($applicant->dob)) ] .' '. date('Y', strtotime($applicant->dob)) ?><br>
                  <b>Jenis Kelamin:<br>
                  </b> <?php echo $applicant->email ?><br>
                  <b>No Handphone:<br>
                  </b> <?php echo $applicant->phone ?><br>
                </div>
                <!-- /.col -->
                <div class="col-xs-3">
                  <b>Tingkat Pendidikan:<br>
                  </b> <?php echo $applicant->edulvl_name ?><br>
                  <b>Asal Sekolah/Lembaga:<br>
                  </b> <?php echo $applicant->origin ?><br>
                  <b>Jurusan:<br>
                  </b> <?php echo $applicant->vocational ?><br>
                  <b>Alamat:<br>
                  </b> <?php echo $applicant->address ?><br>
                  <b>Pengajuan Periode Magang:<br>
                  </b> <?php echo date('d/m/Y', strtotime($applicant->start)); ?> ~ <?php echo date('d/m/Y', strtotime($applicant->end)) ?><br>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                  <b>Permohonan diterima:<br>
                  </b> <?php echo date('d', strtotime($applicant->date_received)) .' '. $bln[ date('n', strtotime($applicant->date_received)) ] .' '. date('Y', strtotime($applicant->date_received)) ?><br>
                  <b>Pesan yang disampaikan:<br>
                  </b> <?php echo $applicant->story ?><br>
                </div>
                <!-- /.col -->
                <div class="col-xs-2">
                  <b>Status Pendaftaran:<br>
                    <?php if ($applicant->approve != true) {
                      $label_active = 'label-danger';
                      $label_text = 'Belum Diterima';
                    } else {
                      $label_active = 'label-success';
                      $label_text = 'Diterima';
                    } ?>
                    </b> <span class="label <?php echo $label_active; ?>"><?php echo $label_text ?></span><br>
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
              <h3 class="box-title">Dokumen Pendaftar</h3>
              <div class="pull-right">
                <i class="fa fa-file-pdf-o"></i>
                <a href="<?php echo 'http://localhost/presensi-bi/upload/pdf/'.$applicant->resume?>">Download PDF</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo ($applicant->resume != false)?'<iframe src="https://docs.google.com/viewer?url=https://calonwisudawan.com/uploads/PresensiSiswaMagang.pdf&embedded=true" frameborder="0" height="500px" width="100%"></iframe>':'<div class="col pull-center" style="height:150px; text-align: center; vertical-align: middle; line-height: 150px;"> Dokumen tidak ditemukan </div>'?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-left">
                <?php echo ($applicant->resume != false)? '<a href="'.site_url('InternshipRegistration/pdf_delete/'.$applicant->regis_id).'" class="delete-pdf">Hapus PDF</a>':''?>
              </div>
            <?php if ($applicant->approve != true):?>
              <a href="javascript:void(0)" onclick="send_mail()" class="btn btn-info pull-right">Terima Pendaftar</a>
            <?php endif ?>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <?php if ($applicant->approve != false): ?>
       <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Riwayat</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <?php 
            $bln = array ( 
                    1 => 'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                  );

              $hari = array ( 
                    1 => 'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                  );
            ?>
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <th>Tanggal Dikirim</th>
                  <th>Tanggal Wawancara</th>
                  <th>Waktu</th>
                  <th>Tempat</th>
                  <th>Alamat</th>
                </tr>
                <tr>
                  <td><?php echo $hari[ date('N', strtotime($applicant->date_sent)) ].', '.date('N', strtotime($applicant->date_sent)) .' '. $bln[ date('n', strtotime($applicant->date_sent)) ] .' '. date('Y', strtotime($applicant->date_sent)) ?></td>
                  <td><?php echo $hari[ date('N', strtotime($applicant->invitation_date)) ].', '.date('d', strtotime($applicant->invitation_date)) .' '. $bln[ date('n', strtotime($applicant->invitation_date)) ] .' '. date('Y', strtotime($applicant->invitation_date)) ?></td>
                  <td><?php echo $applicant->invitation_time ?></td>
                  <td>Gedung KPwBI Riau</td>
                  <td>Jalan Jenderal Sudirman No. 464 Pekanbaru</td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <?php endif ?>
    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal-send">
      <div class="modal-dialog">
        <div class="modal-content">
          <form role="form" id="form-approve" action="" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title-send"></h4>
          </div>
          <div class="box-body">
            <div class="form-group col-xs-12">
              <label>Tanggal Undangan</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-calendar"></i>
                </div>
                <input type="text" name="invt_date" class="form-control datepicker">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="form-group col-xs-12">
              <label>Waktu Undangan</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-time"></i>
                </div>
                <input type="text" name="invt_time" class="form-control timepicker">
              </div>
              <!-- /.input group -->
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="reg" value="<?php echo $applicant->regis_id ?>">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" name="submit" value="1" class="btn btn-primary">Kirim</button>
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

    //Date picker
    $('.datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom auto",
      todayHighlight: true,  
    })

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false,
      showMeridian: false,
      minuteStep: 5
    }).on('changeTime.timepicker', function(e) {
    var hours=e.time.hours, //Returns an integer
        min=e.time.minutes
      if(hours < 10) {
        if(min < 10){
          $(e.currentTarget).val('0' + hours + ':' + '0' + min);
        }else{
          $(e.currentTarget).val('0' + hours + ':' + min);
        }
      }
    })

    $('.delete-pdf').on('click', function(e) {
      e.preventDefault();
      const href = $(this).attr('href');
      Swal.fire({
        title: 'Yakin ingin menghapus dokumen \npendaftar magang?',
        text: "pastikan anda telah men-download dokumen tersebut sebelum dihapus!",
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
  function send_mail()
  {
    $('#form-approve')[0].reset(); // reset form on modals
 
    $('#form-approve').attr('action', '<?php echo $approve_action ?>');
    $('#modal-send').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title-send').text('Kirim Undangan Wawancara'); // Set title to Bootstrap modal title
  }
</script>
<script src="<?php echo base_url() ?>assets/dist/js/sweetalert2.all.min.js"></script>
</body>
</html>