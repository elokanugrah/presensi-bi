<?php $this->load->view('headerfooter/header_admin'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Import
        <small>rekapitulasi kehadiran</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Report') ?>"><i class="fa fa-table"></i> Laporan Rekapitulasi</a></li>
        <li class="<?php echo active_link('Report') ?>"><a href="#">Import</a></li>
      </ol>
    </section>

    <div class="col-xs-12">
    <?php if(isset($_POST['preview'])){ ?>
      <div class='alert alert-danger alert-dismissible' style='margin-top:30px;' id='kosong' hidden>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <i class='icon fa fa-times-circle'></i><span id='data_failed'></span>
      </div>
      <div class="alert alert-info alert-dismissible" style="margin-top:30px;" id="ada" hidden>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-check-circle"></i>Silahkan cek data yang akan diimport
      </div>
    <?php } ?>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Rekapitulasi kehadiran siswa magang</h3>
              <a href="<?php echo site_url('excel/format_rekapitulasi.xlsx') ?>" class="btn btn-success btn-sm badge mt-1 pull-right"><span class="fa fa-file-excel-o" style="padding-right: 4px;"></span> Download Format</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="post" action="<?php echo site_url('Report/form'); ?>" enctype="multipart/form-data">
                <!-- 
                -- Buat sebuah input type file
                -- class pull-left berfungsi agar file input berada di sebelah kiri
                -->
                <div class="row">
                  <div class="col-md-12 form-group">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-files-o"></i>
                      </div>
                      <input type="file" class="form-control" name="file" id="file-selector" required>
                      <div class="input-group-addon">
                        <button type="submit" name="preview" value="Preview" class="btn btn-info badge btn-sm mt-1">Preview</button>
                        <a href="<?php echo site_url('Report/import_data') ?>" class="btn btn-default btn-sm badge mt-1">Reset</a>
                      </div>
                    </div>
                    <span style="font-size: 13px; color: #999;">Tipe file yang diizinkan: xlsx (maks : 1 MB)</span>
                  </div>
                </div>
                <!--
                -- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
                -->
              </form>
              <?php
                $kosong = 0;
                $numrow = 1;
                $button = 0;
                if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
                  if(isset($upload_error)){ // Jika proses upload gagal
                    echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
                    die; // stop skrip
                  }
                  
                  // Buat sebuah tag form untuk proses import data ke database
                  echo "<form method='post' action='".site_url('Report/import')."'>";
                  
                  echo "<table class='table table-bordered'>
                  <tr>
                    <th>Nomor Induk Magang</th>
                    <th>Name</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Status Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Status Pulang</th>
                    <th>Keterangan</th>
                  </tr>";
                  
                  // Lakukan perulangan dari data yang ada di excel
                  // $sheet adalah variabel yang dikirim dari controller
                  $time_inout=$this->Workinghours_model->getTime("1");
                  $time_in_w=date('H:i:s', strtotime($time_inout->time_in));
                  $time_out_w=date('H:i:s', strtotime($time_inout->time_out));

                  foreach($sheet as $row){ 
                    // Ambil data pada excel sesuai Kolom
                    $qrcode = $row['A'];
                    $date = $row['B'];
                    $time_in = $row['C'];
                    $time_out = $row['D'];
                    $note = $row['E'];
                    $cek_std=$this->Student_model->getdata_by_qr(
                        $row['A']
                    );
                    if(!empty($cek_std))
                    {
                        $student_id=$cek_std->student_id;
                        $name=$cek_std->name;
                    }
                    else 
                    {
                        $student_id=null;
                        $name="";
                    }
                    // Cek jika semua data tidak diisi
                    if(empty($student_id) && empty($qrcode) && empty($date) && empty($time_in) && empty($time_out) && empty($note))
                      continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                    
                    // Cek $numrow apakah lebih dari 1
                    // Artinya karena baris pertama adalah nama-nama kolom
                    // Jadi dilewat saja, tidak usah diimport
                    if($numrow > 2){
                      // Validasi apakah semua data telah diisi
                      if(! empty($student_id)){
                        $qrcode_td = ( ! empty($qrcode))? "" : " class='bg-red-active color-palette'"; 
                      } else {
                        $qrcode_td = " class='bg-red-active color-palette'";
                        $button++;
                      }

                      if(!empty($time_in)){
                        $time_in_post=date('H:i:s', strtotime($time_in));
                          if ($time_in_post > $time_in_w) {
                            $status_in='telat';
                            $statusin_td=" class='label label-warning'";
                          } else {
                            $status_in='on time';
                            $statusin_td=" class='label label-success'";
                          }
                        } else {
                            $status_in='';
                      }

                      if(!empty($time_out)){
                        $time_out_post=date('H:i:s', strtotime($time_out));
                          if ($time_out_post < $time_out_w) {
                              $status_out='lebih awal';
                              $statusout_td=" class='label label-warning'";
                          } else {
                              $status_out='on time';
                              $statusout_td=" class='label label-success'";
                          }
                        } else {
                          $status_out='';
                      }

                      if ($note == 'Hadir') {
                        $label_note = " class='label label-success'";
                      } elseif ($note == 'Sakit') {
                        $label_note = " class='label label-warning'";
                      } elseif ($note == 'Izin') {
                        $label_note = " class='label label-info'";
                      } else {
                        $label_note = " class='label label-danger'";
                      }
                      $name_td = ( ! empty($name))? "" : " class='bg-red-active color-palette'";
                      // Jika Nama kosong, beri warna merah
                      $date_td = ( ! empty($date))? "" : " class='bg-red-active color-palette'"; // Jika Jenis Kelamin kosong, beri warna merah
                      $time_in_td = ( ! empty($time_in))? "" : " class='bg-red-active color-palette'"; // Jika Alamat kosong, beri warna merah
                      $time_out_td = ( ! empty($time_out))? "" : " class='bg-red-active color-palette'";
                      $note_td = ( ! empty($note))? "" : " class='bg-red-active color-palette'";
                      
                      // Jika salah satu data ada yang kosong
                      if(empty($student_id) or empty($qrcode) or empty($date) or empty($time_in) or empty($time_out) or empty($note)){
                        $kosong++; // Tambah 1 variabel $kosong
                      }
                      
                      echo "<tr>";
                      echo "<td".$qrcode_td.">".$qrcode."</td>";
                      echo "<td".$name_td.">".$name."</td>";
                      echo "<td".$date_td.">".date("d M Y", strtotime($date))."</td>";
                      echo "<td".$time_in_td.">".date("H:i:s", strtotime($time_in))."</td>";
                      echo "<td><span".$statusin_td.">".$status_in."</span></td>";
                      echo "<td".$time_out_td.">".date("H:i:s", strtotime($time_out))."</td>";
                      echo "<td><span".$statusout_td.">".$status_out."</span></td>";
                      echo "<td".$note_td."><span".$label_note.">".$note."</span></td>";
                      echo "</tr>";
                    }
                    
                    $numrow++; // Tambah 1 setiap kali looping
                  }
                  
                  echo "</table>";

                  echo "<button type='submit' name='import' id='btn-submit' class='btn btn-info pull-right'>Import</button>";
                  // Cek apakah variabel kosong lebih dari 0
                  // Jika lebih dari 0, berarti ada data yang masih kosong
                  echo "</form>";
                }
                ?>  
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
<?php if($kosong > 0) { ?>
<script>
  $(function(){
    // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
    $("#data_failed").html('Ada <?php echo $kosong; ?> baris data yang kosong!');
    
    $("#kosong").show(); // Munculkan alert validasi kosong
    $("#ada").hide();
    $("#btn-submit").hide();
  })
</script>
<?php
} if($button > 0)  { ?>
<script>
  $(function(){
    // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
    $("#data_failed").html('Ada yang tidak terdaftar!');
    
    $("#kosong").show(); // Munculkan alert validasi kosong
    $("#ada").hide();
    $("#btn-submit").hide();
  })
</script>
<?php
} else { ?>
<script>
  $(function(){
    $("#kosong").hide();
    $("#ada").show();
    $("#btn-submit").show();
  })
</script>
<?php } ?>
</body>
</html>