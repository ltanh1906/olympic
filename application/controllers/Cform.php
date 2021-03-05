<?php
class Cform extends CI_Controller{
    function __construct(){
        parent::__construct();
        
    }

    function index(){
        if ($this->session->userdata('user')){
            $khoa = getSession()->sMaKhoa;
            $this->form($khoa);
        }
        else{
            $this->publicForm();
        }

    }

    function edit(){
        $session = getSession();
        if(isset($session)){
        $khoa = getSession()->sMaKhoa;
        $check = getSession()->sIDQuyen;
        }
        else{
            redirect('Clogin');
        }
        $this->load->Model('Mthisinh');
        $id = $this->uri->segment(3);
        $thisinh = $this->Mthisinh->get_info($id);
        if($thisinh->FK_sMaKhoa != getSession()->sMaKhoa && $check != 0){
            setToast('error', 'Không tồn tại sinh viên này');
            redirect('Clist');
        }
        $this->load->model('Mmonthi');
        $listmon = $this->Mmonthi->get_list();
        $this->load->model('Mkhoa');
        $listkhoa = $this->Mkhoa->get_list();
        $this->load->library('form_validation');
        $this->load->helper('form');


        if($this->input->post())
        {
            if($check == 0)
            $this->form_validation->set_rules('khoa', 'Khoa', 'required');
            if($thisinh->FK_sMaKhoa == 14)
            $this->form_validation->set_rules('image', '', 'callback_file_check'); 
            $this->form_validation->set_rules('truong', 'Trường', 'required');
            $this->form_validation->set_rules('hoten', 'Họ và tên', 'required');
            $this->form_validation->set_rules('dob', 'Ngày sinh', 'required');
            $this->form_validation->set_rules('sdt', 'Số điện thoại', 'required|numeric|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('mail', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('lop', 'Lớp', 'required');
            $this->form_validation->set_rules('masv', 'Mã Sinh Viên', 'required');
            $this->form_validation->set_rules('mon', 'Môn Thi', 'required');

            $dau = 'mc';
            if($this->form_validation->run() == true){
                if($check == 0)
                $khoa = $this->input->post('khoa');
                $truong = $this->input->post('truong');
                $ten = $this->input->post('hoten');
                $ten = $this->Mthisinh->tachten($ten);
                $dob = $this->input->post('dob');
                $dob = strtotime($dob);
                $sdt = $this->input->post('sdt');
                $mail = $this->input->post('mail');
                $lop = $this->input->post('lop');
                $masv = $this->input->post('masv');
                $mon = $this->input->post('mon');
                $gioitinh = $this->input->post('gioi-tinh');
                $hinhthuc = $this->input->post('hinhthuc');
                $info = array(
                    
                    'sMaSinhVien' => $masv,
                    
                    'sMaMon'         => $mon,
                    'sHoTenDem'        => $ten['hodem'],
                    'sTen'         => $ten['ten'],
                    'sLop'       => $lop,
                    'sGioiTinh' => $gioitinh[0],
                    'dNgaySinh'      => $dob,
                    'sSDT'         => $sdt,
                    'sEmail'        => $mail,
                    'sTruong'       => $truong,
                );
                if($thisinh->FK_sMaKhoa == 14){
                    $info['FK_sMaKhoa'] = 14;
                    $info['sKhoa']     = $khoa;
                    $info['sGhichu']    = 'Tự do';
                    if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
                        $t = './upload/minhchung/'.$thisinh->sMinhchung;   
                        if(file_exists($t))
                        {
                            unlink($t);
                        };
                        $this->load->library('upload_library');
                        $upload_path = './upload/minhchung';
                        $upload_data = $this->upload_library->upload($upload_path, 'image', $dau);
                        $image_link = '';
                        if(isset($upload_data['file_name'])){
                            $image_link = $upload_data['file_name']; //nếu có ảnh tải lên thì lấy tên ảnh
                        }
                        $info['sMinhchung']    = $image_link;
                    }
                }else{
                    $info['FK_sMaKhoa']      = $khoa;
                    $info['sGhiChu']    = $hinhthuc[0];
                };
    
                if($this->Mthisinh->update($id, $info))
                    {
                        setToast('success', 'Cập nhật thành công');
                    }else{
                        setToast('error', 'Cập nhật thất bại');
                    }
                redirect('Clist');
            }
            else{
                setToast('error', 'Cập thất bại');
            }
        }

        
        $dLeft = array(
            'listmon' => $listmon,
            'listkhoa'=> $listkhoa,
            't'   => $thisinh,
        );
        $page = array(
            'title' => 'Sửa thông tin thí sinh',
        );
        $messages = array(
            'messages'	=> $this->session->flashdata('messages'),
        );
        $data = array(
            'left'      => 'site/VupdateForm',
            'dLeft'     => $dLeft,
            'page'      => $page,
            
        );
        $data['messages'] = $messages;
        $this->load->view('layout/Vlayout', $data);
    }

    function form($khoa){
        $check=getSession()->sIDQuyen;
        if(!isset($check)){
            redirect('Cform');
        }
        $this->load->model('Mthisinh');
        $this->load->model('Mkhoa');
        $listkhoa = $this->Mkhoa->get_list();
        $this->load->model('Mmonthi');
        $listmon = $this->Mmonthi->get_list();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->Mthisinh->joindb();

        if($this->input->post())
        {
            if($check == 0)
            $this->form_validation->set_rules('khoa', 'Khoa', 'required');
            $this->form_validation->set_rules('hoten', 'Họ và tên', 'required');
            $this->form_validation->set_rules('dob', 'Ngày sinh', 'required');
            $this->form_validation->set_rules('sdt', 'Số điện thoại', 'required|numeric|min_length[10]|max_length[15]');
            $this->form_validation->set_rules('mail', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('lop', 'Lớp', 'required');
            $this->form_validation->set_rules('masv', 'Mã Sinh Viên', 'required');
            $this->form_validation->set_rules('mon', 'Môn Thi', 'required');

            if($this->form_validation->run() == true){
                if($check == 0)
                $khoa = $this->input->post('khoa');
                $ten = $this->input->post('hoten');
                $ten = $this->Mthisinh->tachten($ten);
                $dob = $this->input->post('dob');
                $dob = strtotime($dob);
                $sdt = $this->input->post('sdt');
                $mail = $this->input->post('mail');
                $lop = $this->input->post('lop');
                $masv = $this->input->post('masv');
                $mon = $this->input->post('mon');
                $gioitinh = $this->input->post('gioi-tinh');
                $hinhthuc = $this->input->post('hinhthuc');

    
                $info = array(
                    'sMaSinhVien' => $masv,
                    'FK_sMaKhoa'      => $khoa,
                    'sMaMon'         => $mon,
                    'sHoTenDem'        => $ten['hodem'],
                    'sTen'         => $ten['ten'],
                    'sLop'       => $lop,
                    'sGioiTinh' => $gioitinh[0],
                    'dNgaySinh'      => $dob,
                    'sSDT'         => $sdt,
                    'sEmail'        => $mail,
                    'sGhiChu'         => $hinhthuc[0],
                    'sTruong'       => 'ĐH Mở Hà Nội',
                );
                
                if($this->Mthisinh->create($info))
                    {
                        setToast('success', 'Đăng kí thành công');
                    }else{
                        setToast('error', 'Đăng kí thất bại');
                    }
                redirect('Clist');
            }
            
        }
        
       
        $dLeft = array(
            'listmon' => $listmon,
            'listkhoa'=> $listkhoa,
        );
        $page = array(
            'title' => 'Đăng kí dự thi',
        );
        $messages = array(
            'messages'	=> $this->session->flashdata('messages'),
        );
        $data = array(
            'left'      => 'site/Vform',
            'dLeft'     => $dLeft,
            'page'      => $page,
        );
        $data['messages'] = $messages;
        
        $this->load->view('layout/Vlayout', $data);
    }


    
    function file_check($str){
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['image']['name']);
        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Chỉ cho phép file ảnh');
                return false;
            }
        }

    }


    // Form public
    function publicForm(){
        $check=getSession();
        if(isset($check)){
            redirect('Cform');
        }
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Mthisinh');
        $this->load->model('Mduthi');
        if($this->input->post())
        {
            $this->form_validation->set_rules('hoten', 'Họ và tên', 'required');
            $this->form_validation->set_rules('dob', 'Ngày sinh', 'required');
            $this->form_validation->set_rules('sdt', 'Số điện thoại', 'required|numeric|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('mail', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('truong', 'Đơn vị đào tạo', 'required');
            $this->form_validation->set_rules('khoa', 'Khoa', 'required');
            $this->form_validation->set_rules('lop', 'Lớp', 'required');
            $this->form_validation->set_rules('masv', 'Mã Sinh Viên', 'required');
            $this->form_validation->set_rules('mon', 'Môn Thi', 'required');
            $this->form_validation->set_rules('image', 'Minh chứng', 'callback_file_check');

            if($this->form_validation->run() == true){
                $ten = $this->input->post('hoten');
                $ten = $this->Mthisinh->tachten($ten);
                $dob = $this->input->post('dob');
                $dob = strtotime($dob);
                $truong = $this->input->post('truong');
                $sdt = $this->input->post('sdt');
                $mail = $this->input->post('mail');
                $khoa = $this->input->post('khoa');
                $lop = $this->input->post('lop');
                $masv = $this->input->post('masv');
                $mon = $this->input->post('mon');
                $gioitinh = $this->input->post('gioi-tinh');
                $hinhthuc = 'Tự do';

                $dau ='mc';
                $this->load->library('upload_library');
                $upload_path = './upload/minhchung';
                $upload_data = $this->upload_library->upload($upload_path, 'image', $dau);
                $image_link = '';
                if(isset($upload_data['file_name'])){
                    $image_link = $upload_data['file_name']; //nếu có ảnh tải lên thì lấy tên ảnh
                }

                $info = array(
                    'sMaSinhVien' => $masv,
                    'FK_sMaKhoa'     => 14,
                    'sKhoa'      => $khoa,
                    'sMaMon'         => $mon,
                    'sHoTenDem'        => $ten['hodem'],
                    'sTen'         => $ten['ten'],
                    'sLop'       => $lop,
                    'sGioiTinh' => $gioitinh[0],
                    'dNgaySinh'      => $dob,
                    'sSDT'         => $sdt,
                    'sEmail'        => $mail,
                    'sGhiChu'         => $hinhthuc,
                    'sTruong'       => $truong,
                    'sMinhchung'    => $image_link,
                );
                
                if($this->Mduthi->create($info))
                    {
                        setToast('success', 'Đăng kí thành công');
                    }else{
                        setToast('error', 'Đăng kí thất bại');
                    }
                redirect('Chome');
            }
            else{
                setToast('error', 'Đăng kí thất bại');
            }
        }


        $this->load->model('Mmonthi');
        $listmon = $this->Mmonthi->get_list();
        $dLeft = array(
            'listmon' => $listmon,
        );
        $page = array(
            'title' => 'Đăng kí dự thi',
        );
        $messages = array(
            'messages'	=> $this->session->flashdata('messages'),
        );
        $data = array(
            'left'      => 'site/VpublicForm',
            'dLeft'     => $dLeft,
            'page'      => $page,
        );
        $data['messages'] = $messages;
        $this->load->view('layout/Vlayout', $data);
    }

    function delete(){
        $khoa = getSession()->sMaKhoa;
        $check = getSession()->sIDQuyen;
        $this->load->Model('Mthisinh');
        $id = $this->uri->segment(3);
        $thisinh = $this->Mthisinh->get_info($id);
        if(!$thisinh)
        setToast('error', 'Không tồn tại sinh viên này');
        if($thisinh->FK_sMaKhoa != getSession()->sMaKhoa && $check != 0){
            setToast('error', 'Không tồn tại sinh viên này');
            redirect('Clist');
        }
        if($this->Mthisinh->delete($id)){
            $image_link = './upload/minhchung/'.$thisinh->sMinhchung;
            if(file_exists($image_link))
            {
                unlink($image_link);
            }
            setToast('info', 'Xoá thành công');
            redirect('Clist');
        }
    }


}