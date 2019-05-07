<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Report extends CI_Controller
{
    private $filename = "import_data_recapitulation";
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined_att') || $this->session->userdata('logined_att') != true)
        {
            redirect('Login');
        }
        $this->load->model('Attendance_model');
        $this->load->model('Student_model');
        $this->load->model('Workinghours_model');
	}

	public function index()
	{
        $active_student=$this->Student_model->get_data_activeonly();
        $earliest=$this->Attendance_model->get_earliest();
        $latest=$this->Attendance_model->get_latest();
        $start=$earliest->date;
        $end=$latest->date;
        $attendance=$this->Attendance_model->getall_data_bydate($start,$end);
        $date = date("d-M-Y", strtotime($start)).' - '.date("d-M-Y", strtotime($end));
        if(!$this->input->get())
        {
            $data=array(
                'data_attendance'  => $attendance,
                'data_student'     => $active_student,
                'date'             => $date

            );
    		$this->load->view('admin/attendance_table',$data);
        }
        else
        {
        $start = date("Y-m-d", strtotime(substr($this->input->get('date'), 0, 11)));
        $end = date("Y-m-d", strtotime(substr($this->input->get('date'), 14, 11)));
        $attendance=$this->Attendance_model->getall_data_bydate($start,$end);
        $active_student=$this->Student_model->get_data_activeonly();
        $date = date("d-M-Y", strtotime($start)).' - '.date("d-M-Y", strtotime($end));
        $data=array(
            'data_attendance'  => $attendance,
            'data_student'     => $active_student,
            'date'             => $date

        );
        $this->load->view('admin/attendance_table',$data);
        }
    }

    public function add_perdate()
    {
        $active_student=$this->Student_model->get_data_activeonly();
        $data=array(
            'data_student'     => $active_student,
            'action'    => site_url('Report/add_perdate_action')
        );
        $this->load->view('admin/attendance_form',$data);
    }

    function add_perdate_action()
    {
        $time=$this->Workinghours_model->getTime("1");
        $time_in=date('H:i:s', strtotime($time->time_in));
        $time_out=date('H:i:s', strtotime($time->time_out));
        $active_student=$this->Student_model->get_data_activeonly();
        $date=date("Y-m-d", strtotime($this->input->post('date_in')));
        if ($this->Attendance_model->check_date($date)) {
                $data->date_status = 'Already';
                $this->session->set_flashdata('delete_success', 'Data kehadiran siswa magang aktif per tanggal '.date("d m Y", strtotime($date)).' sudah ada!');
            } else {
                $i=0;
                foreach ($active_student as $key) {
                $time_in_post=date('H:i:s', strtotime($this->input->post('time_in'.$i)));
                $time_out_post=date('H:i:s', strtotime($this->input->post('time_out'.$i)));
                $status_in='on time';
                $status_out='on time';
                if(!empty($this->input->post('time_in'.$i))){
                    if ($time_in_post > $time_in) {
                        $status_in='telat';
                        }
                } else {
                    $status_in='';
                }

                if (!empty($this->input->post('time_out'.$i))) {
                    if ($time_out_post < $time_out) {
                        $status_out='lebih awal';
                    }
                } else {
                    $status_out='';
                }
                $data=array(
                    'student_id' => $this->input->post('student_id'.$i),
                    'date'      => $date,
                    'time_in'      => $this->input->post('time_in'.$i),
                    'time_out'      => $this->input->post('time_out'.$i),
                    'status_in'      => $status_in,
                    'status_out'      => $status_out,
                    'note'      => $this->input->post('note'.$i)
                );
                $this->Attendance_model->add_data($data);
                $i++;
            }
            $date = $hari[ date('N', strtotime($this->input->post('date_in'))) ] .', '. date("d M Y", strtotime($this->input->post('date_in')));
            $this->session->set_flashdata('input_success', 'Data kehadiran siswa magang aktif per tanggal '.$date.' berhasil ditambahkan!');
        }
        redirect('Report');
    }

    function add_studentatt_action()
    {
        $s_id=$this->input->post('student_id');
        $date=$this->input->post('date_in');
        $student = $this->Student_model->getdata_by_id($s_id);
        $time=$this->Workinghours_model->getTime("1");
        $time_in=date('H:i:s', strtotime($time->time_in));
        $time_out=date('H:i:s', strtotime($time->time_out));
        $time_in_post=date('H:i:s', strtotime($this->input->post('time_in')));
        $time_out_post=date('H:i:s', strtotime($this->input->post('time_out')));
        $status_in='on time';
        $status_out='on time';
        $hari = array ( 
          1 => 'Senin',
          'Selasa',
          'Rabu',
          'Kamis',
          'Jumat',
          'Sabtu',
          'Minggu'
        ); 
        $dates = $hari[ date('N', strtotime($this->input->post('date_in'))) ] .', '. date("d M Y", strtotime($this->input->post('date_in')));
        if (!$this->Attendance_model->check_stddate($s_id, date("Y-m-d", strtotime($date)))) {
            if(!empty($this->input->post('time_in'))){
                if ($time_in_post > $time_in) {
                    $status_in='telat';
                }
            } else {
                $status_in='';
            }

            if (!empty($this->input->post('time_out'))) {
                if ($time_out_post < $time_out) {
                    $status_out='lebih awal';
                }
            } else {
                $status_out='';
            }
            $data=array(
                'student_id' => $s_id,
                'date'      => date("Y-m-d", strtotime($date)),
                'time_in'      => $this->input->post('time_in'),
                'time_out'      => $this->input->post('time_out'),
                'status_in'      => $status_in,
                'status_out'      => $status_out,
                'note'      => $this->input->post('note')
            );
            $this->Attendance_model->add_data($data);
            $this->session->set_flashdata('input_success', 'Data kehadiran siswa a/n '.$student->name.' pada '.$dates.' berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('delete_success', 'Data kehadiran siswa a/n '.$student->name.' pada '.$dates.' sudah ada!');
        }
        redirect('Report');
    }

    function edit_studentnote_action()
    {
        $data=array(
            'note'      => $this->input->post('note')
        );
        $id=$this->input->post('attendance_id');
        $s_id=$this->input->post('student_id');
        $name=$this->input->post('name2');
        $hari = array ( 
          1 => 'Senin',
          'Selasa',
          'Rabu',
          'Kamis',
          'Jumat',
          'Sabtu',
          'Minggu'
        ); 
        $date = $hari[ date('N', strtotime($this->input->post('date_inn'))) ] .', '. date("d M Y", strtotime($this->input->post('date_inn')));
        $this->Attendance_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Keterangan siswa magang a/n '.$name.' pada hari '.$date.' diubah!');
        redirect('Report');
    }

    function edit_studentatt_action()
    {
        $time=$this->Workinghours_model->getTime("1");
        $time_in=date('H:i:s', strtotime($time->time_in));
        $time_out=date('H:i:s', strtotime($time->time_out));
        $time_in_post=date('H:i:s', strtotime($this->input->post('time_in')));
        $time_out_post=date('H:i:s', strtotime($this->input->post('time_out')));
        $status_in='on time';
        $status_out='on time';
        if(!empty($this->input->post('time_in'))){
            if ($time_in_post > $time_in) {
                $status_in='telat';
                }
        } else {
            $status_in='';
        }

        if (!empty($this->input->post('time_out'))) {
            if ($time_out_post < $time_out) {
                $status_out='lebih awal';
            }
        } else {
            $status_out='';
        }

        $data=array(
            'date'      => date("Y-m-d", strtotime($this->input->post('date_in'))),
            'time_in'      => $this->input->post('time_in'),
            'time_out'      => $this->input->post('time_out'),
            'status_in'      => $status_in,
            'status_out'      => $status_out
        );
        $id=$this->input->post('attendance_id');
        $s_id=$this->input->post('student_id');
        $this->Attendance_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Tanggal / waktu kehadiran a/n '.$this->input->post('name3').' berhasil diubah!');
        redirect('Report');
    }
    
    function delete($id)
    {
        $attendance = $this->Attendance_model->getdata_by_id($id);
        $hari = array ( 
          1 => 'Senin',
          'Selasa',
          'Rabu',
          'Kamis',
          'Jumat',
          'Sabtu',
          'Minggu'
        ); 
        $s_id=$attendance->student_id;
        $student = $this->Student_model->getdata_by_id($s_id);
        $date = $hari[ date('N', strtotime($attendance->date)) ] .', '. date("d M Y", strtotime($attendance->date));
        $this->Attendance_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data kehadiran a/n '.$student->name.' pada hari '.$date.' berhasil dihapus!');
        redirect('Report');
    }

    function print()
    {
        $attendance=$this->Attendance_model->getall_data_comp();
        $active_student=$this->Student_model->get_data_activeonly();
        $earliest=$this->Attendance_model->get_earliest();
        $start=$earliest->date;
        $end=date("Y-m-d");
        $attendance=$this->Attendance_model->getall_data_bydate($start,$end);
        $date = date("d M Y", strtotime($start)).' - '.date("d M Y", strtotime($end));
        if(!$this->input->get())
        {
            $data=array(
                'data_attendance'  => $attendance,
                'data_student'     => $active_student,
                'date'             => $date

            );
            $this->load->view('admin/attendance_table_print',$data);
        }
        else
        {
        $start = date("Y-m-d", strtotime(substr($this->input->get('date'), 0, 11)));
        $end = date("Y-m-d", strtotime(substr($this->input->get('date'), 14, 11)));
        $attendance=$this->Attendance_model->getall_data_bydate($start,$end);
        $active_student=$this->Student_model->get_data_activeonly();
        $earliest=$this->Attendance_model->get_earliest();
        $date = date("d M Y", strtotime($start)).' - '.date("d M Y", strtotime($end));
        $data=array(
            'data_attendance'  => $attendance,
            'data_student'     => $active_student,
            'date'             => $date

        );
        $this->load->view('admin/attendance_table_print',$data);
        }
    }

    public function import_data()
    {
        $this->load->view('admin/report_import');
    }

    public function form()
    {
        $data = array(); // Buat variabel $data sebagai array

        if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
          // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
          $upload = $this->Attendance_model->upload_file($this->filename);
          
          if($upload['result'] == "success"){ // Jika proses upload sukses
            // Load plugin PHPExcel nya
            include APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php';
            
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
            
            // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
            // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
            $data['sheet'] = $sheet; 
          }else{ // Jika proses upload gagal
            $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
          }
        }
        $this->load->view('admin/report_import', $data);
    }

    public function import()
    {
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php';

        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

        // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
        $data = array();

        $numrow = 1;
        foreach($sheet as $key => $row){
          // Cek $numrow apakah lebih dari 1
          // Artinya karena baris pertama adalah nama-nama kolom
          // Jadi dilewat saja, tidak usah diimport
          if($numrow > 2){
            // Kita push (add) array data ke variabel data
            $cek_std=$this->Student_model->getdata_by_qr($row['A']);
            $time_inout=$this->Workinghours_model->getTime("1");
            $time_in_w=date('H:i:s', strtotime($time_inout->time_in));
            $time_out_w=date('H:i:s', strtotime($time_inout->time_out));
            if(!empty($cek_std))
            {
                $student_id=$cek_std->student_id;
                if(!empty($row['C'])){
                $time_in_post=date('H:i:s', strtotime($row['C']));
                    if ($time_in_post > $time_in_w) {
                        $status_in='telat';
                    } else {
                        $status_in='on time';
                    }
                } else {
                    $status_in='';
                }

                if(!empty($row['D'])){
                $time_out_post=date('H:i:s', strtotime($row['D']));
                    if ($time_out_post < $time_out_w) {
                        $status_out='lebih awal';
                    } else {
                        $status_out='on time';
                    }
                } else {
                    $status_out='';
                }

                array_push($data, array(
                  'student_id'=>$student_id,
                  'date'=>date('Y-m-d',strtotime($row['B'])),
                  'time_in'=>$row['C'],
                  'status_in'=>$status_in,
                  'time_out'=>$row['D'],
                  'status_out'=>$status_out,
                  'note'=>$row['E']
                ));
            }
            else 
            {
                $student_id=null;
            }
          }
          
          $numrow++; // Tambah 1 setiap kali looping
        }
        // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
        $this->Attendance_model->insert_multiple($data);
        $this->session->set_flashdata('input_success', 'Data rekapitulasi sebanyak '.count($data).' baris berhasil di import!');
        redirect("Report"); // Redirect ke halaman awal (ke controller siswa fungsi index)
    }

    public function export()
    {
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php';
        
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Sistem Magang BI Riau')
                     ->setLastModifiedBy('Sistem Magang BI Riau')
                     ->setTitle("Rekapitulasi Presensi")
                     ->setSubject("Sistem Magang BI Riau")
                     ->setDescription("Laporan Rekapitulasi Presensi Magang BI Riau")
                     ->setKeywords("Laporan Rekapitulasi Presensi");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
          'font' => array('bold' => true), // Set font nya jadi bold
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );

        $style_no = array(
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA REKAPITULASI PRESENSI MAGANG BI RIAU"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        $excel->setActiveSheetIndex(0)->setCellValue('A4', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B4', "NOMOR INDUK MAGANG");
        $excel->setActiveSheetIndex(0)->setCellValue('C4', "NAMA");
        $excel->setActiveSheetIndex(0)->setCellValue('D4', "KEHADIRAN");
        $excel->setActiveSheetIndex(0)->setCellValue('D5', "TANGGAL");
        $excel->setActiveSheetIndex(0)->setCellValue('E5', "JAM MASUK");
        $excel->setActiveSheetIndex(0)->setCellValue('F5', "STATUS MASUK");
        $excel->setActiveSheetIndex(0)->setCellValue('G5', "JAM PULANG");
        $excel->setActiveSheetIndex(0)->setCellValue('H5', "STATUS PULANG");
        $excel->setActiveSheetIndex(0)->setCellValue('I4', "KETERANGAN");
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->mergeCells('D4:H4');
        $excel->getActiveSheet()->mergeCells('A4:A5');
        $excel->getActiveSheet()->mergeCells('B4:B5');
        $excel->getActiveSheet()->mergeCells('C4:C5');
        $excel->getActiveSheet()->mergeCells('I4:I5');
        $excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I4')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        if(!$this->input->get())
        {
            $attendance=$this->Attendance_model->getall_data_comp();
            $earliest=$this->Attendance_model->get_earliest();
            $start=$earliest->date;
            $end=date("Y-m-d");
            $attendance=$this->Attendance_model->getall_data_bydate($start,$end);
            $date = date("d M Y", strtotime($start)).' - '.date("d M Y", strtotime($end));
        } else {
            $start = date("Y-m-d", strtotime(substr($this->input->get('date'), 0, 11)));
            $end = date("Y-m-d", strtotime(substr($this->input->get('date'), 14, 11)));
            $attendance=$this->Attendance_model->getall_data_bydate($start,$end);
            $earliest=$this->Attendance_model->get_earliest();
            $date = date("d M Y", strtotime($start)).' - '.date("d M Y", strtotime($end));
        }
        $excel->getActiveSheet()->mergeCells('A2:I2');
        $excel->setActiveSheetIndex(0)->setCellValue('A2', "Tanggal : ".$date);
        $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_no);
        $excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_row);
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
        // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
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
        foreach($attendance as $key => $row){ // Lakukan looping pada variabel siswa
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $key+1);
          $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $row->qrcode_id);
          $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $row->name);
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $hari[ date('N', strtotime($row->date)) ] .', '. date("d M Y", strtotime($row->date)));
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $row->time_in);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $row->status_in);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $row->time_out);
          $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $row->status_out);
          $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $row->note);
          
          if ($row->note == 'Hadir') {
            $style_stats = array(
                'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '7CFC00')
                )
            );
          } elseif ($row->note == 'Sakit') {
            $style_stats = array(
                'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FFFF00')
                )
            );
          } elseif ($row->note == 'Izin') {
            $style_stats = array(
                'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '00CED1')
                )
            );
          } else {
            $style_stats = array(
                'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FF0000')
                )
            );
          }

        if ($row->status_in == 'on time' || $row->status_out == 'on time') {
              $label = array(
                'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '7CFC00')
                )
            );
        } else {
              $label = array(
                'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FFFF00')
                )
            );
        }
          // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
          $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_no);
          $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($label);
          $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($label);
          $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_stats);
          
          $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Rekapitulasi Presensi Magang");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Rekapitulasi Presensi Magang.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
      }
}

?>