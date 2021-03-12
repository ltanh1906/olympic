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
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
class Clist extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->Model('Mthisinh');
    }

    function index()
    {
        $makhoa = getSession()->sMaKhoa;
        if(isset($makhoa)){
            if($makhoa != 13 && $makhoa != 14){
                $list = $this->Mthisinh->getdata($makhoa);
            }
            else{     
                $list = $this->Mthisinh->list();
            }
        }
        else{
            setToast('error', 'Chưa đăng nhập');
            redirect(base_url('Clogin'));
        }
        if($this->input->post('xuatexcel')){
            $this->xuatexcel($this->input->post());
        }
        $monthi     = $this->Mthisinh->listMon($mon);
        $listKhoa   = $this->Mthisinh->listKhoa($makhoa);
        $dLeft = array(
            'MaKhoa'  => $makhoa,
            'list'  => $list,
            'listkhoa' => $listKhoa,
            'MonThi'   => $monthi
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
        // $sql = "SELECT tbl_thisinh.sMaSinhVien,tbl_thisinh.sHoTenDem,tbl_thisinh.sTen,tbl_thisinh.sGhiChu,tbl_thisinh.sTruong,tbl_monthi.sTenMon,tbl_monthi.sMaMon,tbl_khoa.sMaKhoa,tbl_khoa.sTenKhoa 
        // FROM tbl_thisinh, tbl_khoa, tbl_monthi 
        // WHERE tbl_thisinh.FK_sMaKhoa = tbl_khoa.sMaKhoa 
        // and tbl_thisinh.sMaMon = tbl_monthi.sMaMon
        // and tbl_thisinh.sNamThi =".substr($today,6,4);
        // if(!empty($mon)){
        //     $sql .=" AND tbl_monthi.sMaMon='$mon'";
        // }
        // if($khoa != '13'){
        //     $sql .=" AND tbl_khoa.sMaKhoa='$khoa'";
        // }
        // $sql .= " ORDER by tbl_thisinh.sMaMon ASC, tbl_thisinh.sGhiChu ASC, tbl_thisinh.sTen ASC, tbl_khoa.sTenKhoa ASC";
        // return $this->db->query($sql)->result_array();
        $dataSinhVien = $this->Mthisinh->layDanhSachThiSinh($khoa,$mon);
        return $dataSinhVien;
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
            $ds[$sv['sTruong']][$sv['sMaKhoa']][$sv['sMaMon']][] = $sv;
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman')->setSize(12);

        $today = date("d/m/Y");
        $array_merge = array('A1:I1','A2:I2','A3:I3','A4:I4','A5:I5','A6:I6','A7:I7');
        $array_bold = array('A2','A3','A5','A6');
        $array_size = array('A1','A2','A3','A5');
        $array_chieucao = array ('2','3','5');
        $array_can = array ('A1','A2','A3','A5','A6','A8','B8','C8','D8','E8','F8','G8','H8','I8');
        $array_outborder = array('F8:G8');
        // nội dung
        // nội dung fix cứng
        $array_content = array(
            'A1'    => 'TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI',
            'A2'    => 'BTC CUỘC THI OLYMPIC TIN HỌC, TIẾNG ANH',
            'A3'    => 'KHÔNG CHUYÊN NĂM '. substr($today,6,4),
            'A5'    => 'DANH SÁCH THÍ SINH DỰ THI',
            'A8'    => 'STT1',
            'B8'    => 'STT2',
            'C8'    => 'Trường',
            'D8'    => 'Khoa',
            'E8'    => 'Môn',
            'F8'    => 'Họ và',
            'G8'    => 'Tên',
            'H8'    => 'Mã SV',
            'I8'    => 'Ghi chú'
        );

        $i=1;
        $row = 9;
        $starttruong = 9;
        $startkhoa = 9;
        $startmon = 9;
        foreach ($ds as  $key => $truong){
            foreach($truong as $key => $khoa){
                foreach($khoa as $key => $mon){
                    foreach($mon as $key => $sv){
                        $array_content['A'.$row] = $i;
                        $array_content['B'.$row] = $key+1;
                        $array_content['C'.$row] = $sv['sTruong'];
                        if($sv['sMaKhoa'] != 14){
                        $array_content['D'.$row] = $sv['sTenKhoa'];
                        }
                        else{
                        $array_content['D'.$row] = $sv['sKhoa'];
                        }
                        $array_content['E'.$row] = $sv['sTenMon'];
                        $array_content['F'.$row] = $sv['sHoTenDem'];
                        $array_content['G'.$row] = $sv['sTen'];
                        $array_content['H'.$row] = $sv['sMaSinhVien'];
                        $array_content['I'.$row] = $sv['sGhiChu'];
                        $array_outborder[] = 'F'.$row.':'.'G'.$row;
                        $row++;
                        $i++;
                    }
                    $array_merge[] = 'E'.$startmon.':E'.($row-1);
                    $startmon = $row;
                }
                $array_merge[] = 'D'.$startkhoa.':D'.($row-1);
                $startkhoa = $row;
            }
            $array_can[] = 'A8:A'.($row-1);
            $array_can[] = 'B8:B'.($row-1);
            $array_can[] = 'C8:C'.($row-1);
            $array_can[] = 'D8:D'.($row-1);
            $array_can[] = 'E8:E'.($row-1);
            $array_can[] = 'H8:H'.($row-1);
            $array_can[] = 'I8:I'.($row-1);
            $array_merge[] = 'C'.$starttruong.':C'.($row-1);
            $starttruong = $row;
        }


        foreach($array_content as $key => $value){
            $sheet->setCellValue($key,$value);
        }

        //in dam
        foreach($array_bold as $cell){
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }
        // size
        foreach($array_size as $cell){
            $sheet->getStyle($cell)->getFont()->setSize(16);
        }
        // gach chan
        $sheet->getStyle('A3')->getFont()->setUnderline(true);
        //  gom giong
        foreach($array_merge as $cell){
            $sheet->mergeCells($cell);
        }
        // can giua 
        foreach($array_can as $cell){
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cell)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        }
        $styleThinBlackAllBorder = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $sheet->getStyle('A8:E'.($row-1))->applyFromArray($styleThinBlackAllBorder);
        $sheet->getStyle('H8:I'.($row-1))->applyFromArray($styleThinBlackAllBorder);
        $styleThinBlackOutlBorder = [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        foreach ($array_outborder as $cell){
            $sheet->getStyle($cell)->applyFromArray($styleThinBlackOutlBorder);
        }
        $array_column = array(
            'A' => 5,
            'B' => 5,
            'C' => 25,
            'D' => 25,
            'E' => 15,
            'F' => 20,
            'G' => 15,
            'H' => 15,
            'I' => 10,
        );
        foreach($array_column as $key => $value){
            $sheet->getColumnDimension($key)->setAutoSize(false);
            $sheet->getColumnDimension($key)->setWidth($value);
        }
        $sheet->getStyle("A8:I".($row-1))->getAlignment()->setWrapText(true);

        // size, đinh hướng
        $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);
        // căn lề
        $sheet->getPageMargins()->setTop(1);
        $sheet->getPageMargins()->setRight(0.75);
        $sheet->getPageMargins()->setLeft(0.75);
        $sheet->getPageMargins()->setBottom(1);
        $spreadsheet->getActiveSheet()->getPageSetup()->setFitToWidth(1);
        $spreadsheet->getActiveSheet()->getPageSetup()->setFitToHeight(1);


        $writer = new Xlsx($spreadsheet);
        $filename = 'DSOLYMPIC'.substr($today,6,4);
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
