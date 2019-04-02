<!DOCTYPE HTML>
<html lang="en">
<head>
  <title>TITLE</title>
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
      <div class="display-table">
        <div class="display-table-cell">
          <img src="<?php echo base_url() ?>assets/dist/img/magang.png" style="max-height: 15%; width: 30%; margin-bottom: 32px;">
          <div id="normal-countdown" data-date="2018/01/01" style="padding-top: 20px;"><div class="time-sec"><h3 class="main-time"><div id="hour"></div></h3></div><div class="time-sec"><h3 class="main-time"><div id="minute"></div></h3></div><div class="time-sec"><h3 class="main-time"><div id="second"></div></h3></div></div>
          <p class="font-white" id="date" style="font-size: 14pt; margin-top: 20px; margin-bottom: 10%;"></p>
          <button type="button" id="ontime">On Time</button>
          <button type="button" id="telat">Telat</button>
        </div><!-- display-table -->
      </div><!-- display-table-cell -->
    </div><!-- main-area -->
  </div><!-- main-area-wrapper -->
</body>
</html>
<script>
  $('#ontime').on('click', function() {
    Swal.fire({
      /*type: 'success',*/
      title: 'Ontime!',
      imageUrl: 'https://media.giphy.com/media/111ebonMs90YLu/giphy.gif',
      showConfirmButton: false,
      timer: 3000
    })
  })

  $('#telat').on('click', function() {
    Swal.fire({
      /*type: 'success',*/
      title: 'Telat!',
      imageUrl: 'https://media.giphy.com/media/U4VXRfcY3zxTi/giphy.gif',
      showConfirmButton: false,
      timer: 3000
    })
  })
</script>
<script src="<?php echo base_url() ?>assets/dist/js/sweetalert2.all.min.js"></script>