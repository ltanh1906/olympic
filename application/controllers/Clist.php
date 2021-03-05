<?php
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
        
        $dLeft = array(
            'list'  => $list,
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
}