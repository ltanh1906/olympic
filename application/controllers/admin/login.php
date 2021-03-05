<?php
class Login extends MY_Controller
{
    function index(){
        //load thư viện validation
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post()){
            $username = $this->input->post('username');
            $this->form_validation->set_rules('login', 'login', 'callback_check_login');
            if($this->form_validation->run()){
                //kiểmtra xem đăng nhập chưa
                $this->session->set_userdata('login',true);
                $account = $this->Maccount->get_info($username);
                $session = array(
                    'username' 	=> $account->sTenTaiKhoan,
                    'khoa' 		=> $account->sIDMaKhoa,
                    'quyen'		=> $account->sIDQuyen,
                );
                $this->session->set_userdata('admin', $session);
                redirect(admin_url('Chome'));
            }
        }
        //load view trang đăng nhập
        $data = array(
            'temp' => 'admin/Vlogin/index',
            'dtemp'=> '',
            'login' => 'login',
        );
        $this->load->view('admin/Vmain', $data);
    }

    /*
    Check thông tin đăng nhập
     */
    function check_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password = md5($password);

        $this->load->model('Maccount');
        $this->session->userdata($username);
        $where = array('sTenTaiKhoan' => $username, 'sMatKhau' => $password);
        if($this->Maccount->check_exists($where)){
            $where = array('sTenTaiKhoan' => $username, 'sIDQuyen' => 0);
            if($this->Maccount->check_exists($where)){
                return true;
            }
            else{
                $this->form_validation->set_message(__FUNCTION__, 'Bạn không có quyền đăng nhập trang này');
                return false;
            }
        }
        else{
            $this->form_validation->set_message(__FUNCTION__, 'Đăng nhập thất bại');
            return false;
        }
        

    }
}
