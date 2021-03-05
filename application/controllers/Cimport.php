<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include 'F:\Xampp\htdocs\olympic\application\vendor\autoload.php';
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
    class Cimport extends CI_Controller{
        public function __construct() {
            parent::__construct();
        }
        
        public function preview()
        {
            if($this->input->is_ajax_request()){
                if(isset($_FILES["file"])){
                    if($_FILES["file"]["name"]!=''){
                        $allowed_extension = array('xls', 'xlsx');
                        $file_array = explode(".", $_FILES['file']['name']);
                        $file_extension = end($file_array);
                        if(in_array($file_extension, $allowed_extension)){
                            $reader = IOFactory::createReader('Xlsx');
                            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                            $writer = IOFactory::createWriter($spreadsheet, 'Html');
                            $message = $writer->save('php://output');
                        }
                        else{
                            $message = "<span class='error'><p>Không phải file excel</p></span>";
                        }
                        echo $message;
                    }
                    
                }  
            }
            else{
                return redirect('error404');
            }
        }
        public function import()
        {
            $this->load->model('Mthisinh');
            if($this->input->post()){ // kiem tra ajax yeu cau server
                if(isset($_FILES["file"])){
                    $allowed_extension = array('xls', 'xlsx');
                    $file_array = explode(".", $_FILES["file"]["name"]);
                    $file_extension = end($file_array);
                    if(in_array($file_extension, $allowed_extension)){
                        $file_name = time() . '.' . $file_extension;
                        move_uploaded_file($_FILES["file"]['tmp_name'], $file_name);
                        $file_type = IOFactory::identify($file_name);
                        $reader = IOFactory::createReader($file_type);
                        $spreadsheet = $reader->load($file_name);
                        unlink($file_name);
                        $data = $spreadsheet->getActiveSheet()->toArray();
                        $user = $this->session->userdata('user');
                        $numRow = 1;
                        
                        foreach($data as $row)
                        {  
                            if($numRow >6){
                                $ten = $row[1];
                                if($ten != ''){
                                $ten = $this->Mthisinh->tachten($ten);
                                }
                                $thisinh = array(
                                    'sMaSinhVien' => $row[7],
                                    'FK_sMaKhoa'      => $user->sMaKhoa,
                                    'sMaMon'         => $row[8],
                                    'sHoTenDem'        => $ten['hodem'],
                                    'sTen'         => $ten['ten'],
                                    'sLop'       => $row[6],
                                    'sGioiTinh' => $row[3],
                                    'dNgaySinh'      => strtotime($row[2]),
                                    'sSDT'         => $row[5],
                                    'sEmail'        => $row[4],
                                    'sGhiChu'         => $row[9],
                                    'sTruong'       => 'ĐH Mở Hà Nội',
                                );
                                if($thisinh['sTen'] != ''){
                                $this->Mthisinh->create($thisinh);
                                }
                            }
                            $numRow++;
                        }
                        $this->data['messages']	= $this->session->flashdata('messages');
                        setToast('success', 'Đăng kí thành công');
                        redirect('Clist');
                        
                        
                    }
                }
            }
            else{
                return redirect('error404');
            }
        }

//FIle mẫu / Export

        public function filemau()
        {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            for ($i=0; $i < 3; $i++) { 
                $data[$i] = array(
                    'hoten' => 'Sinh viên '.$i,
                    'sGioiTinh' => 'Nam',
                    'dNgaySinh' => '19-06-2002',
                    'sEmail' => 'ltanh1906@gmail.com',
                    'sSDT' => '0961962002',
                    'sLop' => '1501',
                    'sMaSinhVien' => '10',
                    'sMaMon' => '9.0',
                    'sGhiChu' => 'Dự bị',
                );
            }
            
        
        $array_content = array(
            "A1" => "TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI",
            "A2" => "DANH SÁCH DỰ THI OLYMPIC TIẾNG ANH, TIN HỌC KHÔNG CHUYÊN",
            "A4" => "Khoa: ",
            "A5" => "Số thí sinh: ",
            "C4" => "*Lưu ý:",
            "D4" => "- Thí sinh thi môn Tiếng Anh ghi 0 ở cột môn thi",
            "D5" => "- Thí sinh thi môn Tin Học ghi 1 ở cột môn thi",
            "A7" => "STT",
            "B7" => "Họ và tên",
            "C7" => "Ngày sinh",
            "D7" => "Giới tính",
            "E7" => "Email",
            "F7" => "Số điện thoại",
            "G7" => "Lớp hành chính",
            "H7" => "Mã Sinh Viên",
            "I7" => "Môn thi",
            "J7" => "Ghi chú",
        );
        //Thêm data vào bảng
        $numRow = 8;
        if(!empty($data)){
        	foreach ($data as $k => $v) {
        		$array_content['A'.$numRow] = $k+1;
        		$array_content['B'.$numRow] = $v['hoten'];
                $array_content['C'.$numRow] = $v['dNgaySinh'];
        		$array_content['D'.$numRow] = $v['sGioiTinh'];
                $array_content['E'.$numRow] = $v['sEmail'];
                $array_content['F'.$numRow] = $v['sSDT'];
        		$array_content['G'.$numRow] = $v['sLop'];
        		$array_content['H'.$numRow] = $v['sMaSinhVien'];
        		$array_content['I'.$numRow] = $v['sMaMon'];
        		$array_content['J'.$numRow++] = $v['sGhiChu'];
        	}
    		// kết thức bằng $numRow++ để xuống dòng tiếp theo
        }
        foreach($array_content as $key => $value){
			$sheet->setCellValue($key,$value);
        }
        //...............................................

            
            //Default Style
            $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
            $spreadsheet->getDefaultStyle()->getFont()->setSize(13);

            
            $styleheading = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $sheet->getStyle('A1:A2')->applyFromArray($styleheading);
            //warp text
            $sheet->getStyle('A1:G'.($numRow+2))->getAlignment()->setWrapText(true);

            //tô màu :) 
            $sheet->getStyle('A7:J7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('D9D9D9');
            
            $styleThinBlackBorderOutline = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ];
            $sheet->getStyle('A7:J'.$numRow)->applyFromArray($styleThinBlackBorderOutline);

            // $sheet->getStyle('A9:K'.($numRow-7))->applyFromArray($styleArray);

            
            
            //gộp ô
            $array_merge = array(
                'A1:J1', 'A2:J3', 'D4:F4', 'D5:F5', 'A5:B5'
            );
            foreach ($array_merge as $key => $cell) {
                $sheet->mergeCells($cell);
            }

            // Chỉnh độ rộng cột
            $array_column = array(
                'A' => 7,
                'B' => 30,
                'C' => 15,
                'D' => 11,
                'E' => 28,
                'F' => 19,
                'G' => 18,
                'H' => 18,
                'I' => 13,
                'J' => 15,
               
            );
            foreach ($array_column as $key => $value) {
                $sheet->getColumnDimension($key)->setAutoSize(false);
                $sheet->getColumnDimension($key)->setWidth($value);
            }

            //cỡ chữ
            $array_font_size = array(
                'A1' => 16,
                'A2' => 22,
            );
            foreach($array_font_size as $key => $value){
                $sheet->getStyle($key)->getFont()->setSize($value);
            }
            //in đậm
            $array_bold = array(
                'A1', 'A2', 'A4', 'A5', 'C4', 'A7:J7',
            );
            foreach($array_bold as $key => $cell){
                $sheet->getStyle($cell)->getFont()->setBold(true);
            }


            //can giua ngang
            $array_horizional = array(
            );
            foreach ($array_horizional as $key => $cell) {
                $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
            //can giua doc
            $array_vertical = array(
                
            );
            foreach($array_vertical as $key => $cell){
                $sheet->getStyle($cell)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            }
            //căn giữa đều
            $array_center = array(
                'A7:J7', 'A1', 'A2'	    	
            );
            $numRow = 8;
            foreach ($data as $k => $v) {
                array_push($array_center, 'A'.$numRow);
                array_push($array_center, 'C'.$numRow);
                array_push($array_center, 'D'.$numRow);
                array_push($array_center, 'F'.$numRow);
                array_push($array_center, 'G'.$numRow);
                array_push($array_center, 'H'.$numRow);
                array_push($array_center, 'I'.$numRow);
                array_push($array_center, 'J'.$numRow++);
            }
            foreach ($array_center as $key => $cell) {
                $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle($cell)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            }
            
        
            //in file
            $writer = new Xlsx($spreadsheet);
            $filename = 'File mẫu';
            ob_end_clean();
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        }
    }
?>