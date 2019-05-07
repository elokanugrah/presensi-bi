<!DOCTYPE HTML>
<html lang="en">
<head>
  <title>Presensi Magang Bank Indonesia</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
      var timestamp = '<?=time();?>';
      function updateTime(){
        var tanggallengkap = new String();
        var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
        namahari = namahari.split(" ");
        var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
        namabulan = namabulan.split(" ");
        var tgl = new Date();
        var hour=tgl.getHours();
        var minute=tgl.getMinutes();
        var second=tgl.getSeconds();
        if(hour <10 ){hour='0'+hour;}
        if(minute <10 ) {minute='0' + minute; }
        if(second<10){second='0' + second;}
        var hari = tgl.getDay();
        var tanggal = tgl.getDate();
        var bulan = tgl.getMonth();
        var tahun = tgl.getFullYear();
        tanggallengkap = namahari[hari] + ", " +tanggal + " " + namabulan[bulan] + " " + tahun;
        $('#hour').html(hour);
        $('#minute').html(minute);
        $('#second').html(second);
        $('#date').html(tanggallengkap);
        timestamp++;
      }
      $(function(){
        setInterval(updateTime, 1000);
      });
    </script>
  
  <!-- Font -->
  
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CPoppins:400,500" rel="stylesheet">
  <!-- <link href="<?php echo base_url() ?>assets/common-css/ionicons.css" rel="stylesheet"> -->
  <link href="<?php echo base_url() ?>assets/06-comming-soon/css/styles.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/06-comming-soon/css/responsive.css" rel="stylesheet">
</head>
<body>
  <div class="main-area-wrapper" style="background-image:url(assets/dist/img/background_bi.jpg);">
    <div class="main-area center-text" >
      <div hidden>
        <b>Device has camera: </b>
        <span id="cam-has-camera"></span>
        <br>
        <video muted playsinline id="qr-video"></video>
        <b>Detected QR code: </b>
        <span id="cam-qr-result">None</span>
        <br>
        <b>Last detected at: </b>
        <span id="cam-qr-result-timestamp"></span>
        <div>
          <select id="inversion-mode-select">
              <option value="original">Scan original (dark QR code on bright background)</option>
          </select>
        </div>
      </div>
      <script type="module">
          import QrScanner from "<?php echo base_url() ?>assets/qr-scanner.min.js";
          QrScanner.WORKER_PATH = '<?php echo base_url() ?>assets/qr-scanner-worker.min.js';

          const video = document.getElementById('qr-video');
          const camHasCamera = document.getElementById('cam-has-camera');
          const camQrResult = document.getElementById('cam-qr-result');
          const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');
          /*const fileSelector = document.getElementById('file-selector');
          const fileQrResult = document.getElementById('file-qr-result');*/
          function myTimer()
          {
            var tgl = new Date(),
                year = tgl.getFullYear(),
                hour=tgl.getHours(),
                minute=tgl.getMinutes(),
                second=tgl.getSeconds();
            if(hour <10 ){hour='0'+hour;}
            if(minute <10 ) {minute='0' + minute; }
            if(second<10){second='0' + second;}

            var time = [hour, minute, second].join(':');
            return time;
          }
          function myDate()
          {
            var tgl = new Date(),
              month = '' + (tgl.getMonth() + 1),
              day = '' + tgl.getDate(),
              year = tgl.getFullYear();
            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;
            var today = [year, month, day].join('-');
            return today;
          }
          setInterval(function(){myTimer()},1000);
          setInterval(function(){myDate()},3600000);

          function setResult(label, result) {
              label.textContent = result;
              camQrResultTimestamp.textContent = new Date().toString();
              check_att(result, myTimer(), myDate());
              label.style.color = 'teal';
              clearTimeout(label.highlightTimeout);
              label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
              scanner.stop();
              setTimeout(function(){ scanner.start(); }, 4000);
          }

          // ####### Web Cam Scanning #######

          QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);

          const scanner = new QrScanner(video, result => setResult(camQrResult, result));
          scanner.start();

          document.getElementById('inversion-mode-select').addEventListener('change', event => {
              scanner.setInversionMode(event.target.value);
          });

          function check_att(qrcode_id, time, date)
          {
            $.ajax({
                url : "<?php echo site_url('Attendance/get_byqr/')?>",
                type: "POST",
                data: {qrcode_id: qrcode_id, date: date, time: time},
                dataType: "JSON",
                success: function(data)
                {
                  if (!$.trim(data.active)){   
                        alert('Error');
                  } else {  
                    if (data.active == 'Aktif') {
                      if (data.already == true) {
                          Swal.fire({
                            title: 'Kehadiran kamu sudah tercatat!',
                            html: 'Kehadiran a/n <strong>' + data.name + '</strong><br> ' + 'pada ' + date + ' sudah tersimpan',
                            imageUrl: 'https://media.giphy.com/media/U4VXRfcY3zxTi/giphy.gif',
                            showConfirmButton: false,
                            timer: 3000
                          })
                        } else {
                          if (data.status == 'on time' || data.status == 'on time') {
                          Swal.fire({
                            title: 'Mantap! kamu ' + data.inout + ' ' + data.status,
                            html: 'Kehadiran a/n <strong>' + data.name + '</strong><br> ' +
                                  'pada ' + date + ' tersimpan',
                            imageUrl: 'https://media.giphy.com/media/111ebonMs90YLu/giphy.gif',
                            showConfirmButton: false,
                            timer: 3000
                          })
                        }
                        else if (data.status == 'telat' || data.status == 'lebih awal') {
                          Swal.fire({
                            title: 'Kok kamu ' + data.inout + ' ' + data.status + ' ?',
                            html: 'Kehadiran a/n <strong>' + data.name + '</strong><br> ' +
                                  'pada ' + date + ' tersimpan',
                            imageUrl: 'https://media.giphy.com/media/U4VXRfcY3zxTi/giphy.gif',
                            showConfirmButton: false,
                            timer: 3000
                            })
                          }
                        }
                      } else {
                        if (data.att_active == true) {
                          if (data.already == true) {
                            Swal.fire({
                              title: 'Kehadiran kamu sudah tercatat!',
                              html: 'Kehadiran a/n <strong>' + data.name + '</strong><br> ' + 'pada ' + date + ' sudah tersimpan',
                              imageUrl: 'https://media.giphy.com/media/U4VXRfcY3zxTi/giphy.gif',
                              showConfirmButton: false,
                              timer: 3000
                            })
                          } else {
                            if (data.status == 'on time' || data.status == 'on time') {
                            Swal.fire({
                              title: 'Mantap! kamu ' + data.inout + ' ' + data.status,
                              html: 'Kehadiran a/n <strong>' + data.name + '</strong><br> ' +
                                    'pada ' + date + ' tersimpan',
                              imageUrl: 'https://media.giphy.com/media/111ebonMs90YLu/giphy.gif',
                              showConfirmButton: false,
                              timer: 3000
                            })
                          }
                          else if (data.status == 'telat' || data.status == 'lebih awal') {
                            Swal.fire({
                              title: 'Kok kamu ' + data.inout + ' ' + data.status + ' ?',
                              html: 'Kehadiran a/n <strong>' + data.name + '</strong><br> ' +
                                    'pada ' + date + ' tersimpan',
                              imageUrl: 'https://media.giphy.com/media/U4VXRfcY3zxTi/giphy.gif',
                              showConfirmButton: false,
                              timer: 3000
                              })
                            }
                          }
                        } else {
                          Swal.fire({
                            title: 'Maaf anda sudah tidak aktif',
                            imageUrl: 'https://media.giphy.com/media/ac7MA7r5IMYda/giphy.gif',
                            showConfirmButton: false,
                            timer: 3000
                          })
                        } 
                      }
                    }
         
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    Swal.fire({
                      title: 'Maaf anda tidak terdaftar',
                      imageUrl: 'https://media.giphy.com/media/4bjIn0rsYmutZRFKmQ/source.gif',
                      showConfirmButton: false,
                      timer: 3300
                    })
                    console.log('jqXHR: ' + jqXHR.responseText);
                    console.log('textStatus: ' + textStatus);
                    console.log('errorThrown: ' + errorThrown);
                }
            })
          }

          /*function check_std(date, student_id) {
            $.ajax({
               url : "<?php echo site_url('Attendance/check_datestd/')?>" + date + "/" + student_id,
               type: "GET",
               dataType: "JSON",
               success: function(data) {
                  alert(data.student_id);
               },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax check std');
                }
              })
          }*/

          // ####### File Scanning #######

          /*fileSelector.addEventListener('change', event => {
              const file = fileSelector.files[0];
              if (!file) {
                  return;
              }
              QrScanner.scanImage(file)
                  .then(result => setResult(fileQrResult, result))
                  .catch(e => setResult(fileQrResult, e || 'No QR code found.'));
          });*/

      </script>
      <!-- <span id="cam-qr-result-timestamp"></span> -->
      <div class="display-table">
        <div class="display-table-cell">
          <img src="<?php echo base_url() ?>assets/dist/img/magang.png" style="max-height: 15%; width: 30%; margin-bottom: 32px;">
          <div id="normal-countdown" data-date="2018/01/01" style="padding-top: 20px;"><div class="time-sec"><h3 class="main-time"><div id="hour"></div></h3></div><div class="time-sec"><h3 class="main-time"><div id="minute"></div></h3></div><div class="time-sec"><h3 class="main-time"><div id="second"></div></h3></div></div>
          <p class="font-white" id="date" style="font-size: 14pt; margin-top: 20px; margin-bottom: 10%;"></p>
        </div><!-- display-table -->
      </div><!-- display-table-cell -->
    </div><!-- main-area -->
  </div><!-- main-area-wrapper -->
</body>
</html>
<script src="<?php echo base_url() ?>assets/dist/js/sweetalert2.all.min.js"></script>