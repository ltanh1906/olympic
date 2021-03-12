<?php
class Cbaiviet extends CI_Controller{
    function __construct(){
        parent::__construct();
    }

    public function view()
        {
            $this->load->model('Mbaiviet');
            $input = array();
            $input['limit'] = array(1, 0);
            $input['where']['FK_sIDLoaiTin '] = 7;
            $thongbao = $this->Mbaiviet->get_list($input);
            $this->load->model('Mtimeline');
            $timeline = $this->Mtimeline->get_list();
            $this->Mbaiviet->joindb();

            $idbv = $this->uri->rsegment('3');
            $baiviet = $this->Mbaiviet->get_info($idbv);
            
            $input = array();
            $input['limit'] = array(3, 0);
            $input['where']['FK_sIDLoaiTin '] = $baiviet->FK_sIDLoaiTin ;
            $relate = $this->Mbaiviet->get_list($input);

            $link_dm = $baiviet->FK_sIDLoaiTin ;
            switch($link_dm){
                case 1: $link_dm = 'gioithieu'; break;
                case 2: $link_dm = 'thongbao'; break;
                case 3: $link_dm = 'tochuc'; break;
                case 4: $link_dm = 'ontap'; break;
                case 5: $link_dm = 'video'; break;
                case 6: $link_dm = 'dvdangcai'; break;
                case 8: $link_dm = 'danhsach'; break;
            }
            $dLeft = array(
                'thongbao'  => $thongbao,
                'baiviet'   => $baiviet,
                'relate'    => $relate,
                'timeline'  => $timeline,
                'link_dm'   => $link_dm,
            );


            $page = array(
                'title' => $baiviet->sTieuDe,
            );
            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            $data = array(
                'left'      => 'site/Vbaiviet',
                'right'     => 'site/Vright',
                'dLeft'     => $dLeft,
                'page'      => $page,
            );
            $data['messages'] = $messages;
            
            $this->load->view('layout/Vlayout', $data);
        }
    }