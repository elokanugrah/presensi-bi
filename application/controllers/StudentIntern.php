<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class StudentIntern extends CI_Controller
{
    private $filename = "import_data_student";
	function __construct()
	{
		parent::__construct();
        $this->load->helper(array('form', 'url'));
        if(!$this->session->userdata('logined_att') || $this->session->userdata('logined_att') != true)
        {
            redirect('Login');
        }
		$this->load->model('Student_model');
        $this->load->model('Attendance_model');
        $this->load->model('Mentor_model');
        $this->load->model('Unit_model');
        $this->load->model('EduLvl_model');
        $this->load->model('Regis_model');
        $this->load->model('Regisauto_model');
	}

	public function index()
	{
		$student=$this->Student_model->ambil_data();
        $mentor=$this->Mentor_model->ambil_data();
        $unit=$this->Unit_model->ambil_data();
        $level=$this->EduLvl_model->ambil_data();
        $data=array(
            'data_student'  => $student,
            'mentor' => $mentor,
            'unit'  => $unit,
            'level'  => $level
        );
		$this->load->view('admin/student_table',$data);
    }

    public function student($id)
    {
        $student=$this->Student_model->getdata_by_id($id);
        $attendance=$this->Attendance_model->getall_by_student($id);
        $percentage=$this->Attendance_model->get_percentage($id);
        $in_stats=$this->Attendance_model->get_instats($id);
        $data=array(
            'data_student'  => $student,
            'data_attendance'  => $attendance,
            'data_percent' => $percentage->percentage,
            'present' => $percentage->present,
            'alpha' => $percentage->alpha,
            'sick' => $percentage->sick,
            'permit' => $percentage->permit,
            'nan' => $percentage->nan,
            'total' => $percentage->total,
            'in_stats' => $in_stats
        );
        $this->load->view('admin/student_attendance',$data);
    }

    function add_action()
    {
        $data=array(
            // 'qrcode'    => $this->_uploadImage(),
            'qrcode_id'  => $this->input->post('qrcode_id'),
            'mentor_id'  => $this->input->post('mentor_id'),
            'edulvl_id'  => $this->input->post('edulvl_id'),
            'unit_id'  => $this->input->post('unit_id'),
            'id_number'  => $this->input->post('id_number'),
            'name'      => $this->input->post('name'),
            'sex'    => $this->input->post('sex'),
            'active' => $this->input->post('active'),
            'collage' => $this->input->post('collage'),
            'date_in' => date("Y-m-d", strtotime($this->input->post('date_in'))),
            'date_out' => date("Y-m-d", strtotime($this->input->post('date_out'))),
            'vocational' => $this->input->post('vocational'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address')
        );
        $this->Student_model->data_adding($data);
        $this->session->set_flashdata('input_success', 'Data dengan NIM '.$this->input->post('id_number').' a/n '.$this->input->post('name').' berhasil ditambahkan!');
        redirect(site_url('StudentIntern'));
    }

    function edit($id)
	{
		$data=$this->Student_model->getdata_by_id($id);
        $data->date_in = ($data->date_in == '0000-00-00') ? '' : $data->date_in; // if 0000-00-00 set tu empty for datepicker compatibility
        $data->date_out = ($data->date_out == '0000-00-00') ? '' : $data->date_out; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
	}

    function max()
    {
        $data=$this->Student_model->get_max_qr();
        $data->qrcode_id = substr($data->qrcode_id, -4);
        echo json_encode($data);
    }

    function edit_action()
    {
        $id=$this->input->post('student_id');
        /*$old=$this->input->post('old_qrcode');
        if($_FILES['qrcode']['name'] != "") {
            $this->Student_model->_deleteOldImage($old);
            $img = $this->_uploadImage();
        } else {
            $img = $old;
        }*/
        
        $data=array(
            //'qrcode'    => $img,
            'qrcode_id'  => $this->input->post('qrcode_id'),
            'mentor_id'  => $this->input->post('mentor_id'),
            'edulvl_id'  => $this->input->post('edulvl_id'),
            'unit_id'  => $this->input->post('unit_id'),
            'id_number'  => $this->input->post('id_number'),
            'name'      => $this->input->post('name'),
            'sex'    => $this->input->post('sex'),
            'active' => $this->input->post('active'),
            'collage' => $this->input->post('collage'),
            'date_in' => date("Y-m-d", strtotime($this->input->post('date_in'))),
            'date_out' => date("Y-m-d", strtotime($this->input->post('date_out'))),
            'vocational' => $this->input->post('vocational'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address')
        );
        $this->Student_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Data dengan NIM '.$this->input->post('id_number').' a/n '.$this->input->post('name').' berhasil diubah!');
        redirect(site_url('StudentIntern'));
    }

    function print($id)
    {
        $student=$this->Student_model->getdata_by_id($id);
        $attendance=$this->Attendance_model->getall_by_student($id);
        $percentage=$this->Attendance_model->get_percentage($id);
        $in_stats=$this->Attendance_model->get_instats($id);
        $data=array(
            'data_student'  => $student,
            'data_attendance'  => $attendance,
            'data_percent' => $percentage->percentage,
            'present' => $percentage->present,
            'alpha' => $percentage->alpha,
            'sick' => $percentage->sick,
            'permit' => $percentage->permit,
            'nan' => $percentage->nan,
            'total' => $percentage->total,
            'in_stats' => $in_stats
        );
        $this->load->view('admin/student_attendance_print',$data);
    }
    
    function delete($id)
    {
        $student = $this->Student_model->getdata_by_id($id);
        // $this->Student_model->_deleteImage($id);
        $this->Student_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data dengan NIM '.$student->id_number.' a/n '.$student->name.' berhasil dihapus!');
        redirect(site_url('StudentIntern'));
    }


    /*private function _uploadImage()
    {
        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = uniqid();
        $config['overwrite']            = true;
        $config['max_size']             = 200; // 200KB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('qrcode')) {
            return $this->upload->data("file_name");
        }
        
        return "default.jpg";
    }*/

    public function import_data()
    {
        $this->load->view('admin/student_import');
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
        $this->load->view('admin/student_import', $data);
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
          if($numrow > 1){
            // Kita push (add) array data ke variabel data
            $cek_std=$this->Student_model->getdata_by_qr($row['A']);
            $cek_edu=$this->EduLvl_model->getdata_by_name($row['G']);
            $cek_unit=$this->Unit_model->getdata_by_name($row['L']);
            $cek_mentor=$this->Mentor_model->getdata_by_nip($row['M']);
            if(empty($cek_std))
            {
                $student_id = (empty($cek_std))? null : $cek_std->student_id;
                $edulvl_id = (empty($cek_edu))? null : $cek_edu->edulvl_id;
                $unit_id = (empty($cek_unit))? null : $cek_unit->unit_id;
                $mentor_id = (empty($cek_mentor))? null : $cek_mentor->mentor_id;
                $mentor_name = (empty($cek_mentor))? null : $cek_mentor->name;
                $start_ts = date('Y-m-d',strtotime($row['J']));
                $end_ts = date('Y-m-d',strtotime($row['K']));
                $date_now = date("Y-m-d");
                $status = (($date_now >= $date_now) && ($date_now <= $end_ts))? 'Aktif' : 'Non Aktif';

                array_push($data, array(
                  'student_id'=>$student_id,
                  'mentor_id'=>$mentor_id,
                  'edulvl_id'=>$edulvl_id,
                  'unit_id'=>$unit_id,
                  'qrcode_id'=>$row['A'],
                  'id_number'=>$row['C'],
                  'name'=>$row['B'],
                  'sex'=>$row['D'],
                  'collage'=>$row['H'],
                  'vocational'=>$row['I'],
                  'address'=>$row['F'],
                  'phone'=>$row['E'],
                  'date_in'=>$start_ts,
                  'date_out'=>$end_ts,
                  'active'=>$status
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
        $this->Student_model->insert_multiple($data);
        $this->session->set_flashdata('input_success', 'Data rekapitulasi sebanyak '.count($data).' baris berhasil di import!');
        redirect("StudentIntern"); // Redirect ke halaman awal (ke controller siswa fungsi index)
    }

    public function export()
    {
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php';
        
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Sistem Magang KPw BI Prov. Riau')
                     ->setLastModifiedBy('Sistem Magang KPw BI Prov. Riau')
                     ->setTitle("Data Siswa Magang")
                     ->setSubject("Sistem Magang KPw BI Prov. Riau")
                     ->setDescription("Data Siswa Magang Magang KPw BI Prov. Riau")
                     ->setKeywords("Data Siswa Magang Magang KPw BI Prov. Riau");
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

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA SISWA MAGANG KPw BI PROV. RIAU"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:O1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NOMOR INDUK MAGANG");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NIM/NIS");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "JENIS KELAMIN");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "TINGKAT PENDIDIKAN");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "ASAL SEKOLAH/LEMBAGA");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "JURUSAN");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "NO HANDPHONE");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "TANGGAL MULAI");
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "TANGGAL SELESAI");
        $excel->setActiveSheetIndex(0)->setCellValue('L3', "UNIT");
        $excel->setActiveSheetIndex(0)->setCellValue('M3', "MENTOR");
        $excel->setActiveSheetIndex(0)->setCellValue('N3', "ALAMAT");
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "STATUS");
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $data_student = $this->Student_model->ambil_data();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($data_student as $key => $row){ // Lakukan looping pada variabel siswa
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $key+1);
          $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $row->qrcode_id);
          $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $row->id_number);
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $row->name);
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $row->sex);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $row->edulvl_name);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $row->collage);
          $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $row->vocational);
          $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $row->phone);
          $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, date("d / m / Y", strtotime($row->date_in)));
          $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, date("d / m / Y", strtotime($row->date_out)));
          $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $row->unit_name);
          $excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $row->mentor_name);
          $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $row->address);
          $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $row->active);
          
            if ($row->active == 'Aktif') {
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
                    'color' => array('rgb' => 'FF0000')
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
          $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($label);
          
          $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(30); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Siswa Magang KPw BI Prov. Riau");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Siswa Magang KPw BI Prov. Riau.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}

?>