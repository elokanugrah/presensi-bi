<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class InternshipRegistration extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined_att') || $this->session->userdata('logined_att') != true)
        {
            redirect('Login');
        }
        $this->load->model('Student_model');
        $this->load->model('Regis_model');
        $this->load->model('Regisauto_model');
        $this->load->model('Email_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
	}

	public function index()
	{
        $student=$this->Student_model->ambil_data();
        $max_date=$this->Student_model->get_max_mth();
        $active=count($this->Student_model->get_data_activeonly());
        $lastmonth=date('Y-m-d', strtotime($max_date->date_out));
        $regis=$this->Regisauto_model->getdata();
        $open = ($regis->start == '0000-00-00') ? date("d-m-Y") : date('d-m-Y', strtotime($regis->start));
        $end = ($regis->end == '0000-00-00') ? date("d-m-Y", strtotime('+30 days')) : date('d-m-Y', strtotime($regis->end));
        $registered=$this->Regis_model->ambil_data();
        $amonthafter = 0;
        $twomonthbafter = 0;
        foreach ($student as $key => $row) {
            if (date('Y-m', strtotime('+1 Month')) == date('Y-m', strtotime($row->date_out))){
                $amonthafter++;
            }
            if (date('Y-m', strtotime('+2 Month')) <= date('Y-m', strtotime($row->date_out))) {
                $twomonthbafter++;
            }
        }

        $registered_unread=$this->Regis_model->get_unread();
        $registered_approve=$this->Regis_model->get_apr();
        $registered_notapprove=$this->Regis_model->get_notapr();
        $data=array(
            'data_regis' => $registered,
            'regis_new' => $registered_unread,
            'regis_app' => $registered_approve,
            'regis_notapp' => $registered_notapprove,
            'data_student' => $student,
            'realslot'  => ($regis->slot-$twomonthbafter)-$amonthafter,
            'nextmonth' => date('n', strtotime('+1 Month')),
            'lastmonth' => $lastmonth,
            'regis' => $regis,
            'open' => $open,
            'close' => $end
        );
        $this->load->view('admin/registration_table',$data);
    }

    public function post_action()
    {
        $regis_auto = ($this->input->post('regis_auto')!=true)?0:1;
        $regis_open = ($this->input->post('regis_open')!=true)?0:1;

        if ($this->input->post('regis_auto')!=true) {
            if ($this->input->post('regis_open')==true) {
                $start = date('Y-m-d', strtotime($this->input->post('start')));
                $end = date('Y-m-d', strtotime($this->input->post('end')));
            }else{
               $start = '';
               $end = '';
            }
        } else {
            $start = '';
            $end = '';
        }
        $data=array(
            'regis_open'  => $regis_open,
            'regis_auto'  => $regis_auto,
            'start'       => $start,
            'end'         => $end
        );
        $this->Regisauto_model->edit_data('1',$data);
        redirect(site_url('InternshipRegistration'));
    }

    public function slot_action()
    {
        $data=array(
            'slot'  => $this->input->post('slot')
        );
        $this->Regisauto_model->edit_data('1',$data);
        redirect(site_url('InternshipRegistration'));
    }

    public function applicant($id)
    {
        $applicant=$this->Regis_model->getdata_by_id($id);
        $data=array(
            'applicant'  => $applicant,
            'approve_action' => site_url('InternshipRegistration/approve')
        );
        $data2=array(
            'already_read'  => 1
        );
        $this->Regis_model->edit_data($id, $data2);
        $this->load->view('admin/applicant_detil', $data);
    }

    public function pdf_delete($id)
    {
        $applicant=$this->Regis_model->getdata_by_id($id);
        $this->Regis_model->_deleteImage($applicant->resume);
        $data=array(
            'resume'  => 0
        );
        $this->Regis_model->edit_data($id, $data);
    }

    public function approve()
    {
        $this->form_validation->set_rules('invt_date', 'Invitation Date', 'required');
        $this->form_validation->set_rules('invt_time', 'Invitation Time', 'required');
        $id=$this->input->post('reg');
        $applicant=$this->Regis_model->getdata_by_id($id);
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('validation_errors','');
            redirect(site_url('InternshipRegistration/applicant/'.$id));
        } else {
            $data=array(
            'approve'      => $this->input->post('submit'),
            'invitation_date'      => date('Y-m-d', strtotime($this->input->post('invt_date'))),
            'invitation_time'      => $this->input->post('invt_time'),
            'date_sent'      => date('Y-m-d')
            );
            $this->Regis_model->edit_data($id,$data);
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
                $email=$applicant->email;
                $in_date=$this->input->post('invt_date');
                $in_time=$this->input->post('invt_time');
                $today=date('d') .' '. $bln[ date('n') ] .' '. date('Y');
                $user=$applicant->registered_name;
                $sex=($applicant->sex!='Perempuan')?'Saudara':'Saudari';
                $recdate=date('d', strtotime($applicant->date_received)) .' '. $bln[ date('n', strtotime($applicant->date_received)) ] .' '. date('Y', strtotime($applicant->date_received));
                $inv_date=$hari[ date('N', strtotime($in_date)) ].'/'.date('d', strtotime($in_date)) .' '. $bln[ date('n', strtotime($in_date)) ] .' '. date('Y', strtotime($in_date));
                $this->Email_model->sendApproveEmail($email,$user,$today,$sex,$recdate,$inv_date,$in_time);
            redirect(site_url('InternshipRegistration'));
        }
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
                     ->setTitle("Data Registrasi Magang")
                     ->setSubject("Sistem Magang KPw BI Prov. Riau")
                     ->setDescription("Data Registrasi Magang KPw BI Prov. Riau")
                     ->setKeywords("Data Registrasi Magang KPw BI Prov. Riau");
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

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA REGISTRASI MAGANG KPw BI PROV. RIAU"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:O1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFA500');
        $excel->getActiveSheet()->getStyle('A2:O2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFA500');
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "JENIS KELAMIN");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "TEMPAT/TANGGAL LAHIR");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "EMAIL");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "NO HP");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "ALAMAT");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "TINGKAT PENDIDIKAN");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "NIM/NIS");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "ASAL SEKOLAH/LEMBAGA");
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "JURUSAN");
        $excel->setActiveSheetIndex(0)->setCellValue('L3', "PESAN YANG DISAMPAIKAN");
        $excel->setActiveSheetIndex(0)->setCellValue('M3', "PERIODE PENGAJUAN");
        $excel->setActiveSheetIndex(0)->setCellValue('N3', "DITERIMA/DITOLAK");
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "TANGGAL DAFTAR");
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
        $data_regis = $this->Regis_model->ambil_data();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($data_regis as $key => $row){ // Lakukan looping pada variabel siswa
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $key+1);
          $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $row->registered_name);
          $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $row->sex);
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $row->pob.'/'.date("d-m-Y", strtotime($row->dob)));
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $row->email);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $row->phone);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $row->address);
          $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $row->edulvl_name);
          $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $row->idsch_num);
          $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $row->origin);
          $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $row->vocational);
          $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $row->story);
          $excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, date("d-m-Y", strtotime($row->start)).' ~ '.date("d-m-Y", strtotime($row->end)));
          $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, ($row->approve!=true)?'Ditolak':'Diterima');
          $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $row->date_received);
          
            if ($row->approve == true) {
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
          $excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($label);
          $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
          
          $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(18);
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Daftar Magang KPw BI Prov. Riau");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Pendaftaran Magang KPw BI Prov. Riau.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

}

?>