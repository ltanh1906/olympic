<?php
class Chome extends MY_Controller{
    function index(){
        $dtemp = array(
            'page' => 'Trang quản trị',
        );
        $data = array(
            'temp' => 'admin/Vhome',
            'dtemp'=> $dtemp,
        );
        $this->load->view('admin/Vmain', $data);
    }
}