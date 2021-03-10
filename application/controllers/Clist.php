<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Reader\IReader;
class Clist extends CI_Controller{
    function __construct(){
        parent::__construct();
    }

    function index()
    {
        $this->load->Model('Mthisinh');
        $makhoa = getSession()->sMaKhoa;
        if(isset($makhoa)){
            if($makhoa != 13 && $makhoa != 14){
                $list = $this->Mthisinh->getdata($makhoa);
            }
            else{     
                $this->Mthisinh->joindb();
                $list = $this->Mthisinh->get_list();
            }
        }
        else{
            setToast('error', 'Chưa đăng nhập');
            redirect(base_url('Clogin'));
        }
        if($this->input->post('xuatexcel')){
            $this->xuatexcel($this->input->post());
        }
        
        $dLeft = array(
            'MaKhoa'  => getSession()->sMaKhoa,
            'list'  => $list,
            'listkhoa' => (getSession()->sMaKhoa == 13)?$this->db->query('SELECT sMaKhoa, sTenKhoa FROM tbl_khoa WHERE not sMaKhoa = 13')->result_array():$this->db->query('SELECT sMaKhoa, sTenKhoa FROM tbl_khoa WHERE sMaKhoa = '.getSession()->sMaKhoa)->result_array(),
            'MonThi'   => $this->db->get('tbl_monthi')->result_array()
        );
        $page = array(
            'title' => 'Danh sách thí sinh',
        );
        $messages = array(
            'messages'	=> $this->session->flashdata('messages'),
        );
        $data = array(
            'left'      => 'site/Vlist',
            'dLeft'     => $dLeft,
            'page'      => $page,
        );
        $data['messages'] = $messages;
        
        $this->load->view('layout/Vlayout', $data);
    }
    public function ds_thisinh($mon=null)
    {
        $khoa = getSession()->sMaKhoa;
        $today = date("d/m/Y");
        $sql = "SELECT tbl_thisinh.sMaSinhVien,tbl_thisinh.sHoTenDem,tbl_thisinh.sTen,tbl_thisinh.sGhiChu,tbl_thisinh.sTruong,tbl_monthi.sTenMon,tbl_khoa.sMaKhoa,tbl_khoa.sTenKhoa 
        FROM tbl_thisinh, tbl_khoa, tbl_monthi 
        WHERE tbl_thisinh.FK_sMaKhoa = tbl_khoa.sMaKhoa 
        and tbl_thisinh.sMaMon = tbl_monthi.sMaMon
        and tbl_thisinh.sNamThi =".substr($today,6,4);
        if(!empty($mon)){
            $sql .=" AND tbl_monthi.sMaMon='$mon'";
        }
        if($khoa != '13'){
            $sql .=" AND tbl_khoa.sMaKhoa='$khoa'";
        }
        // $sql .="ORDER BY tbl_khoa.sTenKhoa ASC, tbl_monthi.sTenMon ASC, tbl_thisinh.sTen ASC";
        return $this->db->query($sql)->result_array();
    }
    public function xuatexcel($post)
    {
        $mon = $this->input->post('mon');
        if($mon == 'tatca'){
            $data = $this->ds_thisinh();
        }
        else{
            $data = $this->ds_thisinh($mon);
        }
        $ds = array();
        foreach($data as $sv){
            $ds[$sv['sMaKhoa']][] = $sv;
        }
        // print_r($ds); exit;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman')->setSize(12);

        // gop dong
        $array_merge = array('A1:G1','A2:G2','A3:G3','A4:G4','A5:G5','A6:G6','A7:G7','C9:D9');
        foreach($array_merge as $cell){
            $sheet->mergeCells($cell);
        }
        // in dam
        $array_bold1 = array('A2','A3','A5');
        foreach($array_bold1 as $cell){
            $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(16);
        }
        $array_bold2 = array('A6','A7');
        foreach($array_bold2 as $cell){
            $sheet->getStyle($cell)->getFont()->setBold(true)->setSize(14);
        }

        // chieu cao hang 2,3,4
        $chieucao = array('2','3','5');
        foreach($$chieuca as $row){
            $sheet->getRowDimension($row)->setRowHeight(20);
        }
        // can giua
        $canngang= array('A1','A2','A3','A5','A6','A7','A9','B9','C9','D9','E9','F9','G9','H9');
        foreach($canngang as $cell){
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }
        // căn doc
        $canngang= array('A1','A2','A3','A5','A6','A7','A9','B9','C9','D9','E9','F9','G9','H9');
        foreach($canngang as $cell){
            $sheet->getStyle($cell)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        }
        $today = date("d/m/Y");
        $array_content = array(
            "A1" => "TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI",
            "A2" => "BTC CUỘC THI OLYMPIC TIN HỌC, TIẾNG ANH",
            "A3" => "KHÔNG CHUYÊN NĂM ". substr($today,6,4),
            "A5" => "DANH SÁCH THÍ SINH DỰ THI",
            "A6" => "MÔN: ". ($mon == 'tatca')?'':(($mon == '1')?'Tin học':'Tiếng Anh'),
            "A9" => "STT1",
            "B9" => "STT2",
            "C9" => "Họ và tên",
            "E9" => "Mã SV",
            "F9" => "Khoa",
            "G9" => "Trường",
            "H9" => "Ghi chú",
            "I9" => "Môn thi",
        );
        $sheet->getStyle("A9:H9")->getAlignment()->setWrapText(true);
        $array_bold1 = array('A9','B9','C9','D9','E9','F9','G9','H9','I9');
        foreach($array_bold1 as $cell){
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
        $i=1;
        $numRow=10;
        // vien bao ngoai
        $styleThinBlackBorderOutline = [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['argb' => '#636e72'],
                ],
            ],
        ];
        $styleThinBlackBorderOutlineThin = [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '#636e72'],
                ],
            ],
        ];
        //vien trong
        $styleThinBlackBorderInline = [
            'borders' => [
                'inside' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '#636e72'],
                ],
            ],
        ];
        $styleThinBlackBorderallBorders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '#636e72'],
                ],
            ],
        ];
        $sheet->getStyle('A9:I9')->applyFromArray($styleThinBlackBorderOutline);
        $start = 10;
        foreach($ds AS  $key => $khoa){
            foreach ($khoa as $k => $sv){
                $array_content['A'.$numRow] = $i;
        		$array_content['B'.$numRow] = $k+1;
                $array_content['C'.$numRow] = $sv['sHoTenDem'];
        		$array_content['D'.$numRow] = $sv['sTen'];
                $array_content['E'.$numRow] = $sv['sMaSinhVien'];
                $array_content['F'.$numRow] = $sv['sTenKhoa'];
        		$array_content['G'.$numRow] = $sv['sTruong'];
                $array_content['H'.$numRow] = $sv['sGhiChu'];
                if($mon == 'tatca'){
                    $array_content['I'.$numRow] = $sv['sTenMon'];
                }
                $canngang= array('A'.$numRow,'B'.$numRow,'E'.$numRow,'H'.$numRow);
                foreach($canngang as $cell){
                    $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }
                $sheet->getStyle("A".$numRow.":H".$numRow)->getAlignment()->setWrapText(true);
                $sheet->getStyle("A".$numRow.":B".$numRow)->applyFromArray($styleThinBlackBorderallBorders);
                $sheet->getStyle("E".$numRow.":H".$numRow)->applyFromArray($styleThinBlackBorderallBorders);
                $sheet->getStyle("C".$numRow.":D".$numRow)->applyFromArray($styleThinBlackBorderOutlineThin);
                $numRow++;
                $i++;
            }
            $sheet->getStyle('A'.$start.':H'.($numRow-1))->applyFromArray($styleThinBlackBorderOutline);
            $start = $numRow;
        }

        $array_border = array('A','B','E','F','G','H','I');
        foreach($array_border as $cell){
            $sheet->getStyle($cell.'9:'.$cell.($numRow-1))->applyFromArray($styleThinBlackBorderOutline);
        }

        foreach($array_content as $key => $value){
			$sheet->setCellValue($key,$value);
        }
        $array_column = array(
            'A' => 5,
            'B' => 5,
            'C' => 20,
            'D' => 10,
            'E' => 15,
            'F' => 40,
            'G' => 20,
            'H' => 15,
        );
        foreach($array_column as $key => $value){
            $sheet->getColumnDimension($key)->setAutoSize(false);
            $sheet->getColumnDimension($key)->setWidth($value);
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'DSOLYMPIC'.substr($today,6,4);
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}