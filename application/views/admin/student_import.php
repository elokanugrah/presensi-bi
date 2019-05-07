<?php $this->load->view('headerfooter/header_admin'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Import
        <small>data siswa magang</small>
      </h1>
      <ol class="breadcrumb">
        <li class="<?php echo active_link('StudentIntern') ?>"><a href="<?php echo site_url('StudentIntern') ?>"><i class="fa fa-table"></i> Siswa Magang</a></li>
        <li class="active"><a href="">Import</a></li>
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
              <h3 class="box-title">Data siswa magang</h3>
              <a href="<?php echo site_url('excel/format_siswaMagang.xlsx') ?>" class="btn btn-success btn-sm badge mt-1 pull-right"><span class="fa fa-file-excel-o" style="padding-right: 4px;"></span> Download Format</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="post" action="<?php echo site_url('StudentIntern/form'); ?>" enctype="multipart/form-data">
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
                        <a href="<?php echo site_url('StudentIntern/import_data') ?>" class="btn btn-default btn-sm badge mt-1">Reset</a>
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
                $std_qr = 0;
                if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
                  if(isset($upload_error)){ // Jika proses upload gagal
                    echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
                    die; // stop skrip
                  }
                  
                  // Buat sebuah tag form untuk proses import data ke database
                  echo "<form method='post' action='".site_url('StudentIntern/import')."'>";
                  
                  echo "<table class='table table-bordered'>
                  <tr>
                    <th>Nomor Induk Magang</th>
                    <th>Name</th>
                    <th>NIM/NIS</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Handphone</th>
                    <th>Alamat</th>
                    <th>Tingkat Pendidikan</th>
                    <th>Asal Sekolah/<br>Lembaga</th>
                    <th>Jurusan</th>
                    <th>Tgl. Mulai</th>
                    <th>Tgl. Selesai</th>
                    <th>Status</th>
                    <th>Unit</th>
                    <th>NIP Mentor</th>
                    <th>Nama Mentor</th>
                  </tr>";
                  
                  // Lakukan perulangan dari data yang ada di excel
                  // $sheet adalah variabel yang dikirim dari controller

                  foreach($sheet as $row){ 
                    // Ambil data pada excel sesuai Kolom
                    $qrcode = $row['A'];
                    $name = $row['B'];
                    $id_number = $row['C'];
                    $sex = $row['D'];
                    $phone = $row['E'];
                    $address = $row['F'];
                    $edulvl_name = $row['G'];
                    $collage = $row['H'];
                    $vocational = $row['I'];
                    $date_in = $row['J'];
                    $date_out = $row['K'];
                    $unit_name = $row['L'];
                    $nip = $row['M'];
                    $cek_std=$this->Student_model->getdata_by_qr(
                        $row['A']
                    );
                    $student_id = (empty($cek_std))? null : $cek_std->student_id;

                    $cek_edu=$this->EduLvl_model->getdata_by_name(
                        $row['G']
                    );
                    $edulvl_id = (empty($cek_edu))? null : $cek_edu->edulvl_id;
                    $cek_unit=$this->Unit_model->getdata_by_name(
                        $row['L']
                    );
                    $unit_id = (empty($cek_unit))? null : $cek_unit->unit_id;
                    $cek_mentor=$this->Mentor_model->getdata_by_nip(
                        $row['M']
                    );
                    $mentor_id = (empty($cek_mentor))? null : $cek_mentor->mentor_id;
                    $mentor_name = (empty($cek_mentor))? null : $cek_mentor->name;

                    $start_ts = date('d-m-Y',strtotime($row['J']));
                    $end_ts = date('d-m-Y',strtotime($row['K']));
                    $date_now = date("d-m-Y");
                    $status = (($date_now >= $start_ts) && ($date_now <= $end_ts))? 'Aktif' : 'Non Aktif';

                    // Cek jika semua data tidak diisi
                    if(empty($qrcode) && empty($name) && empty($id_number) && empty($sex) && empty($phone) && empty($address) && empty($edulvl_name) && empty($collage) && empty($vocational) && empty($date_in) && empty($date_out) && empty($unit_name) && empty($nip))
                      continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                    
                    // Cek $numrow apakah lebih dari 1
                    // Artinya karena baris pertama adalah nama-nama kolom
                    // Jadi dilewat saja, tidak usah diimport
                    if($numrow > 1){
                      // Validasi apakah semua data telah diisi
                      if(!empty($student_id)){
                        $qrcode_td = (!empty($student_id))? " class='bg-red-active color-palette'" : "";
                        $std_qr++; 
                      } else {
                        $qrcode_td = "";
                      }
                      $name_td = ( ! empty($name))? "" : " class='bg-red-active color-palette'";
                      $id_number_td = ( ! empty($id_number))? "" : " class='bg-red-active color-palette'";
                      $sex_td = ( ! empty($sex))? "" : " class='bg-red-active color-palette'";
                      $phone_td = ( ! empty($phone))? "" : " class='bg-red-active color-palette'";
                      $address_td = ( ! empty($address))? "" : " class='bg-red-active color-palette'";
                      if(!empty($edulvl_id)){
                        $edulvl_td = (!empty($edulvl_id))? "" : " class='bg-red-active color-palette'";
                      } else {
                        $edulvl_td = " class='bg-red-active color-palette'";
                        $button++;
                      }
                      $collage_td = ( ! empty($collage))? "" : " class='bg-red-active color-palette'";
                      $vocational_td = ( ! empty($vocational))? "" : " class='bg-red-active color-palette'";
                      $date_in_td = ( ! empty($date_in))? "" : " class='bg-red-active color-palette'";
                      $date_out_td = ( ! empty($date_out))? "" : " class='bg-red-active color-palette'";
                      if(!empty($unit_id)){
                        $unit_td = (!empty($unit_id))? "" : " class='bg-red-active color-palette'";
                      } else {
                        $unit_td = " class='bg-red-active color-palette'";
                        $button++;
                      }
                      if(!empty($mentor_id)){
                        $mentor_td = (!empty($mentor_id))? "" : " class='bg-red-active color-palette'";
                      } else {
                        $mentor_td = " class='bg-red-active color-palette'";
                        $button++;
                      }

                      $status_td = ($status == 'Aktif')? " class='label label-success'" : " class='label label-danger'";
                      
                      // Jika salah satu data ada yang kosong
                      if(empty($qrcode) or empty($name) or empty($id_number) or empty($sex) or empty($phone) or empty($address) or empty($edulvl_name) or empty($collage) or empty($vocational) or empty($unit_name) or empty($nip)){
                        $kosong++; // Tambah 1 variabel $kosong
                      }
                      
                      echo "<tr>";
                      echo "<td".$qrcode_td.">".$qrcode."</td>";
                      echo "<td".$name_td.">".$name."</td>";
                      echo "<td".$id_number_td.">".$id_number."</td>";
                      echo "<td".$sex_td.">".$sex."</td>";
                      echo "<td".$phone_td.">".$phone."</td>";
                      echo "<td".$address_td.">".$address."</td>";
                      echo "<td".$edulvl_td.">".$edulvl_name."</td>";
                      echo "<td".$collage_td.">".$collage."</td>";
                      echo "<td".$vocational_td.">".$vocational."</td>";
                      echo "<td".$date_in_td.">".$date_in."</td>";
                      echo "<td".$date_out_td.">".$date_out."</td>";
                      echo "<td><span".$status_td.">".$status."</span></td>";
                      echo "<td".$unit_td.">".$unit_name."</td>";
                      echo "<td".$mentor_td.">".$nip."</td>";
                      echo "<td".$mentor_td.">".$mentor_name."</td>";
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
} elseif($button > 0)  { ?>
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
} elseif($std_qr > 0)  { ?>
<script>
  $(function(){
    // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
    $("#data_failed").html('Ada yang sudah terdaftar!');
    
    $("#kosong").show(); // Munculkan alert validasi kosong
    $("#ada").hide();
    $("#btn-submit").hide();
  })
</script>
<?php
} else { ?>
<script>
  $(function(){
    $("#kosong").hide(); // Munculkan alert validasi kosong
    $("#ada").show();
    $("#btn-submit").show();
  })
</script>
<?php } ?>
</body>
</html>