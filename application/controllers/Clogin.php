<?php
class Clogin extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('Maccount');
    }

    public function index()
    {
        $page = array(
            'title' => 'Đăng nhập'
        );
        $session = getSession();
        if(isset($session)){
            redirect(base_url('Chome'));
        }
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post()){
            $username = $this->input->post('username');
            $this->form_validation->set_rules('login', 'login', 'callback_check_login');
            if($this->form_validation->run() == true){
                $user = $this->_get_user_info();
                $this->session->set_userdata('user', $user);
                setToast('success', 'Đăng nhập thành công');
                redirect(base_url('Chome'));
            }
            else{
                setToast('error', 'Sai tên đăng nhập hoặc mật khẩu');
                redirect(base_url('Clogin'));
            }
        }
    
     

        $dLeft = array(
        );

        $messages = array(
            'messages'	=> $this->session->flashdata('messages'),
        );
        $data = array(
            'left'      => 'site/Vlogin',
            'dLeft'     => $dLeft,
            'page'      => $page,
        );
        $data['messages'] = $messages;
        
        $this->load->view('layout/Vlayout', $data);
    }

    function check_login(){
        $user = $this->_get_user_info();
        if($user){
                return true;
        }
        else{
            setToast('error', 'Sai tên đăng nhập hoặc mật khẩu');
            return false;
        }
    }

    private function _get_user_info()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password = md5($password);
        $this->load->model('Maccount');
        $where = array('sTenTaiKhoan' => $username , 'sMatKhau' => $password);
        $user = $this->Maccount->get_info_rule($where);
        return $user;
    }

    function logout(){
        if($this->session->userdata('user'))
        {
            $this->session->unset_userdata('user');
        }
        setToast('info', 'Đã đăng xuất');
        redirect('Chome');
    }

    function changepass(){
        $session = getSession();
        if(!isset($session)){
            redirect(base_url('Chome'));
        }
        $id = $session->sIDTaiKhoan;
        $this->load->library('form_validation');
        $this->load->helper('form');
        if($this->input->post()){
            
            $this->form_validation->set_rules('new', 'Mật khẩu mới', 'required');
            $this->form_validation->set_rules('renew', 'Nhập lại mật khẩu mới', 'required|matches[new]');
            if($this->form_validation->run())
            {
                $new = $this->input->post('new');
                $data = array(
                    'sMatKhau' => md5($new),
                );
                if($this->Maccount->update($id, $data)){
                    setToast('info', 'Cập nhật mật khẩu thành công');
                    redirect('Chome');
                }
                else{
                    setToast('error', 'Cập nhật mật khẩu thất bại');
                    redirect('Clogin/changepass');
                }
            }
        }
        $page = array(
            'title' => 'Đổi mật khẩu',
        );
        $dLeft = array(
        );

        $messages = array(
            'messages'	=> $this->session->flashdata('messages'),
        );
        $data = array(
            'left'      => 'site/VchangePassword',
            'dLeft'     => $dLeft,
            'page'      => $page,
        );
        $data['messages'] = $messages;
        
        $this->load->view('layout/Vlayout', $data);
    }

    
}
