<!DOCTYPE html>
<html>
<head>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <style type="text/css" media="all">
  @page {
    margin-top: 2cm;
    margin-bottom: 2cm;
    margin-left: 1cm;
    margin-right: 1cm;
  }

  @media print {
    * {
      font-size: 10px;
    }
    #print {
      display: none;
    }
  }

  * {
    box-sizing: border-box;
    }

  body{
    -webkit-print-color-adjust: exact;
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  }

  .column-top-center {
    float: left;
    text-align: center;
    font-size: 26px;
    width: 60%;
    height: 100px;
    padding: 0px;
    margin-bottom: 20px;
    display: flex;
    justify-content: center; /* align horizontal */
    align-items: center; /* align vertical */
    border-bottom: 1px solid #ddd;
  }

  .column-top-left {
    float: left;
    text-align: center;
    width: 20%;
    height: 100px;
    padding: 20px;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
  }

  .column-top-right {
    float: left;
    text-align: center;
    width: 20%;
    height: 100px;
    padding: 0px;
    margin-bottom: 20px;
    display: flex;
    justify-content: center; /* align horizontal */
    align-items: center; /* align vertical */
    border-bottom: 1px solid #ddd;
  }

  .column-1 {
    float: left;
    width: 25%;
    padding: 0px;
    margin-bottom: 20px;
  }

  .column-2 {
    float: left;
    width: 40%;
    padding: 0px;
    margin-bottom: 20px;
  }

  .column-3 {
    float: right;
    text-align: center;
    width: 20%;
    padding: 6px;
    margin-bottom: 20px;
  }

  img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 20%;
    min-height: 60px;
    min-width: 60px;
  }

  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }
  .other {background-color: #e7e7e7; color: black;} /* Gray */ 

  #students {
    font-size: 12px;
    border-collapse: collapse;
    width: 100%;
    text-align: center;
    margin-bottom: 0;
  }

  #students td, #students th {
    border: 1px solid #ddd;
    padding: 6px;
  }

  #students tr:nth-child(even){background-color: #f2f2f2;}

  #students th {
    padding-top: 6px;
    padding-bottom: 6px;
    background-color: #00477f;
    color: white;
  }

  .label {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
  }
  .success {background-color: #5cb85c;} /* Green */
  .info {background-color: #3c8dbc;} /* Blue */
  .warning {background-color: #f39c12;} /* Orange */
  .danger {background-color: #dd4b39;} /* Red */ 
  
</style>
</head>
<body onload="window.print()"> <!-- onload="window.print()" -->
  <div class="row">
    <div class="column-top-left">
      <img src="<?php echo base_url() ?>assets/dist/img/LogoBI.png" alt="Logo Bank Indonesia">
    </div>
    <div class="column-top-center">
      Laporan Kehadiran<br>
      Siswa Magang Bank Indonesia Riau
    </div>
    <div class="column-top-right">
      <a id="print" style="color:#3c8dbc;text-decoration:none;" href="javascript:window.print()"> <i class="fa fa-print"></i> Cetak</a>
    </div>
  </div>
  <div class="row">
    <div class="column-1">
      <table>
        <tr> 
          <td>Tanggal</td> 
          <td>:</td> 
          <td><?php echo $date; ?></td> 
        </tr>
      </table>
    </div>
    <div class="column-2">
    </div>
    <div class="column-3">
    </div>
  </div>
  <table id="students"> 
    <tr> 
      <th rowspan="2">No.</th> 
      <th rowspan="2">PIN</th> 
      <th rowspan="2">Nama</th> 
      <th colspan="3">Kehadiran</th> 
      <th colspan="2" rowspan="2">Keterangan</th>
    </tr> 
    <tr> 
      <th>Tanggal</th> 
      <th>Jam Masuk</th> 
      <th>Jam Pulang</th>
    </tr> 
    <?php foreach ($data_attendance as $key => $row) {?>
    <tr> 
      <td><?php echo $key+1; ?></td> 
      <td><?php echo $row->qrcode_id; ?></td>
      <td><?php echo $row->name; ?></td>
      <td>
        <?php 
        date_default_timezone_set("Asia/Bangkok");
        $hari = array ( 
                1 => 'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu'
              ); 
      $dateday=$hari[ date('N', strtotime($row->date)) ] .', '. date("d M Y", strtotime($row->date));
      echo $dateday; ?>
      </td> 
      <td><?php echo $row->time_in; ?></td> 
      <td><?php echo $row->time_out; ?></td>
      <?php if ($row->note == 'Hadir') {
          $label_note = 'success';
        } elseif ($row->note == 'Sakit') {
          $label_note = 'warning';
        } elseif ($row->note == 'Izin') {
          $label_note = 'info';
        } else {
          $label_note = 'danger';
        }?>
      <td><span class="label <?php echo $label_note; ?>"><?php echo $row->note; ?></span></td>
    </tr> 
    <?php }?>
  </table>
</body>
</html>
