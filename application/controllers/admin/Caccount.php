<?php
Class Caccount extends MY_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Maccount');
        $this->Maccount = new Maccount();
        $message = '';
    }
    /*
     * Lay danh sach admin
     */
    function index()
    {   
        

        $list = $this->Maccount->joindb();
        $list = $this->Maccount->get_list();
        $this->data['list'] = $list;
        //lấy nội dung của biến message (thông báo khi thêm thành công)
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $total = $this->Maccount->get_total();
        $this->data['total'] = $total;
        
       
        $messages = array(
            'messages'	=> $this->session->flashdata('messages'),
        );

        $dtemp = array(
            'page' => 'Trang quản trị',
            'list' => $list,
            'total'=> $total,
        );
        $data = array(
            'temp' => 'admin/Vadmin/index',
            'dtemp'=> $dtemp,
        );
        $data['messages'] = $messages;
        $this->load->view('admin/Vmain', $data);
    }
    
    /*
     * Kiểm tra username đã tồn tại chưa
     */
    function check_username()
    {
        $username = $this->input->post('username');
        $where = array('sTenTaiKhoan' => $username);
        //kiêm tra xem username đã tồn tại chưa
        if($this->Maccount->check_exists($where))
        {
            //trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Tài khoản đã tồn tại');
            return false;
        }
        return true;
    }
    
    /*
     * Thêm mới quản trị viên
     */
    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        //Load quyền
        $this->load->model('Mpermission');
        $input = array();
        $quyen = $this->Mpermission->get_list($input);
        $this->data['quyen'] = $quyen;

        //Load khoa
        $this->load->model('Mkhoa');
        $input = array();
        $khoa = $this->Mkhoa->get_list($input);
        $this->data['khoa'] = $khoa;
        


        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('khoa', 'Khoa', 'required');
            $this->form_validation->set_rules('quyen', 'Quyền', 'required');
            $this->form_validation->set_rules('username', 'Tài khoản đăng nhập', 'required|callback_check_username');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Mật khẩu', 'required|matches[password]');
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $id_khoa  = $this->input->post('khoa');
                $id_quyen = $this->input->post('quyen');
                $name     = $this->input->post('name');
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                
                $data = array(
                    'sIDTaiKhoan' => $this->Maccount->id(), 
                    'sMaKhoa'     => $id_khoa,
                    'sIDQuyen'  => $id_quyen,
                    'sTenTaiKhoan' => $username,
                    'sMatKhau' => md5($password)
                );
                if($this->Maccount->create($data))
                {
                    //tạo ra nôi dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới thành công');
                }else{
                    $this->session->set_flashdata('message', 'Thêm mới thất bại');
                }
                //Chuyển tới trang danh sách
                redirect(admin_url('Caccount'));
            }
        }
        $messages = array(
            'messages'	=> $this->session->flashdata('messages'),
        );

        $dtemp = array(
            'page' => 'Thêm mới tài khoản',
            'quyen' => $quyen,
            'khoa'=> $khoa,
        );
        $data = array(
            'temp' => 'admin/Vadmin/add',
            'dtemp'=> $dtemp,
        );
        $data['messages'] = $messages;
        $this->load->view('admin/Vmain', $data);
    }

    /*
     * hàm sửa thông tin quản trị viên
     */
    function edit(){
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Mpermission');
        $input = array();
        $quyen = $this->Mpermission->get_list($input);
        //lấy id cần chỉnh sửa
        $id = $this->uri->rsegment('3');
        
        //ép kiểu 
        $id = intval($id);
        //lấy thông tin của id
        $info = $this->Maccount->get_info($id);
        if(!$info){
            $this->session->set_flashdata('message', 'Không tồn tại id này');
            redirect(admin_url('admin'));
        }
        $info = json_decode(json_encode($info), true);
        //Load khoa
        $this->load->model('Mkhoa');
        $input = array();
        $khoa = $this->Mkhoa->get_list($input);
        //Nếu có dữ liệu nhập vào thì kiểm tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('khoa', 'Khoa', 'required');
            $this->form_validation->set_rules('quyen', 'Quyền', 'required');
            $this->form_validation->set_rules('username', 'Tài khoản đăng nhập');
            
            if ($this->input->post('password')){
            $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Mật khẩu', 'required|matches[password]');
            }
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $id_khoa  = $this->input->post('khoa');
                $id_quyen = $this->input->post('quyen');
                $name     = $this->input->post('name');
                $username = $this->input->post('username');
                if ($this->input->post('password'))
                $password = $this->input->post('password');
                if ($this->input->post('password'))
                $data = array(
                    'sMaKhoa'     => $id_khoa,
                    'sIDQuyen'  => $id_quyen,
                    'sMatKhau' => md5($password)
                );
                else{
                    $data = array(
                        'sMaKhoa '     => $id_khoa,
                        'sIDQuyen'  => $id_quyen,
                    );
                }
                if($this->Maccount->update($id, $data))
                {
                    //tạo ra nôi dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật thành công');
                }else{
                    $this->session->set_flashdata('message', 'Cập nhật thất bại');
                }
                //Chuyển tới trang danh sách
                redirect(admin_url('Caccount'));
            }
        }

        $messages = array(
            'messages'	=> $this->session->flashdata('messages'),
        );

        $dtemp = array(
            'page' => 'Sửa tài khoản',
            'quyen' => $quyen,
            'khoa'=> $khoa,
            'info'=> $info,
        );
        $data = array(
            'temp' => 'admin/Vadmin/edit',
            'dtemp'=> $dtemp,
        );
        $data['messages'] = $messages;
        $this->load->view('admin/Vmain', $data);
    
    }


     /*
     * HÀM XOÁ DỮ LIỆU
     */
    function delete(){

        //lấy id cần chỉnh sửa
        $id = $this->uri->rsegment('3');

        //ép kiểu 
        $id = intval($id);

        //lấy thông tin của id để xem có tồn tại không
        $info = $this->Maccount->get_info($id);
        if(!$info){
            $this->session->set_flashdata('message', 'Không tồn tại id này');
            redirect(admin_url('Caccount'));
        }


        //thực hiện xoá
        $this->Maccount->delete($id);
        $this->session->set_flashdata('message', 'Xoá dữ liệu thành công');
        redirect(admin_url('Caccount'));
    }

    /*
     * HÀM ĐĂNG XUẤT
     */
    function logout()
    {
        if($this->session->userdata('login'))
        {
            $this->session->unset_userdata('login');
        }
        redirect(admin_url('login'));
    }

 



}



