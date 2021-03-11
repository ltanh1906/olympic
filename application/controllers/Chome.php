<?php
    class Chome extends CI_Controller{
        public function __construct() {
            parent::__construct();
        }


        public function index()
        {
            $page = array(
                'title' => 'Trang chủ'
            );
            

            $this->load->model('Mimg');
            $this->load->model('Mbaiviet');
            $this->load->model('Mtimeline');
            $timeline = $this->Mtimeline->get_list();

            $input = array();
            $input['limit'] = array(1, 0);
            $input['where']['FK_sIDLoaiTin '] = 7;
            $thongbao = $this->Mbaiviet->get_list($input);

            $input['limit'] = array(4, 0);
            $input['where']['FK_sIDLoaiTin '] = 1;
            $gioithieu = $this->Mbaiviet->get_list($input);

            $input['limit'] = array(1, 0);
            $input['where']['FK_sIDLoaiTin '] = 6;
            $dangcai = $this->Mbaiviet->get_list($input);
            
            $input['limit'] = array(4, 0);
            $input['where']['FK_sIDLoaiTin '] = 4;
            $ontap = $this->Mbaiviet->get_list($input);
            
            $input = array();
            $input['limit'] = array(13, 0);
            $input['where']['type'] = 'video';
            $listvid = $this->Mimg->get_list($input);
            
            $dLeft = array(
                'thongbao'  => $thongbao,
                'gioithieu' => $gioithieu,
                'ontap'     => $ontap,
                'listvid'   => $listvid,
                'dangcai'   => $dangcai,
            );


            $input = array();
            $input['limit'] = array(5, 0);
            $input['where']['type'] = 'slide';
            $carousel = array(
                'carousel' => $this->Mimg->get_list($input),
            );
            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            $data = array(
                'left'      => 'site/Vleft',
                'slide'     => 'site/Vslide',
                'right'     => 'site/Vright',
                'album'     => 'site/Vvideo',
                'dLeft'     => $dLeft,
                'page'      => $page,
                'carousel'  => $carousel,
                
            );
            $data['messages'] = $messages;
            
            $this->load->view('layout/Vlayout', $data);
        }



        public function thongbao()
        {
            $page = array(
                'title' => 'Thông báo'
            );
            $this->load->model('Mtimeline');
            $timeline = $this->Mtimeline->get_list();

            $this->load->model('Mbaiviet');
            $input = array();
            $input['limit'] = array(1, 0);
            $input['where']['FK_sIDLoaiTin '] = 7;
            $thongbao = $this->Mbaiviet->get_list($input);

            $input = array();
            $input['where']['FK_sIDLoaiTin '] = 2;
            $list = $this->Mbaiviet->get_list($input);

            $dLeft = array(
                'thongbao'  => $thongbao,
                'timeline'  => $timeline,
                'list'   => $list,
                'img_title' => 'tittle11.png',
            );


            
            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            $data = array(
                'left'      => 'site/Vdanhmuc',
                'right'     => 'site/Vright',
                'dLeft'     => $dLeft,
                'page'      => $page,
            );
            $data['messages'] = $messages;
            
            $this->load->view('layout/Vlayout', $data);
        }

        public function gioithieu()
        {
            $page = array(
                'title' => 'Giới thiệu'
            );
            
            $this->load->model('Mtimeline');
            $timeline = $this->Mtimeline->get_list();

            $this->load->model('Mbaiviet');
            $input = array();
            $input['limit'] = array(1, 0);
            $input['where']['FK_sIDLoaiTin '] = 7;
            $thongbao = $this->Mbaiviet->get_list($input);

            $input = array();
            $input['where']['FK_sIDLoaiTin '] = 1;
            $list = $this->Mbaiviet->get_list($input);

            $dLeft = array(
                'thongbao'  => $thongbao,
                'timeline'  => $timeline,
                'list'   => $list,
                'img_title' => 't-gioithieu.png',
            );


            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            $data = array(
                'left'      => 'site/Vdanhmuc',
                'right'     => 'site/Vright',
                'dLeft'     => $dLeft,
                'page'      => $page,
            );
            $data['messages'] = $messages;
            
            $this->load->view('layout/Vlayout', $data);
        }

        public function tochuc()
        {
            $page = array(
                'title' => 'Tổ chức'
            );
            $this->load->model('Mtimeline');
            $timeline = $this->Mtimeline->get_list();
            
            $this->load->model('Mbaiviet');
            $input = array();
            $input['limit'] = array(1, 0);
            $input['where']['FK_sIDLoaiTin '] = 7;
            $thongbao = $this->Mbaiviet->get_list($input);

            $input = array();
            $input['where']['FK_sIDLoaiTin '] = 3;
            $list = $this->Mbaiviet->get_list($input);

            $dLeft = array(
                'thongbao'  => $thongbao,
                'timeline'  => $timeline,
                'list'   => $list,
                'img_title' => 't-tochuc.png',
            );


            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            $data = array(
                'left'      => 'site/Vdanhmuc',
                'right'     => 'site/Vright',
                'dLeft'     => $dLeft,
                'page'      => $page,
            );
            $data['messages'] = $messages;
            
            $this->load->view('layout/Vlayout', $data);
        }

        public function ontap()
        {
            $page = array(
                'title' => 'Ôn tập'
            );
            $this->load->model('Mtimeline');
            $timeline = $this->Mtimeline->get_list();
            
            $this->load->model('Mbaiviet');
            $input = array();
            $input['limit'] = array(1, 0);
            $input['where']['FK_sIDLoaiTin '] = 7;
            $thongbao = $this->Mbaiviet->get_list($input);

            $input = array();
            $input['where']['FK_sIDLoaiTin '] = 4;
            $list = $this->Mbaiviet->get_list($input);

            $dLeft = array(
                'thongbao'  => $thongbao,
                'timeline'  => $timeline,
                'list'   => $list,
                'img_title' => 't-ontap.png',
            );


            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            $data = array(
                'left'      => 'site/Vdanhmuc',
                'right'     => 'site/Vright',
                'dLeft'     => $dLeft,
                'page'      => $page,
            );
            $data['messages'] = $messages;
            
            $this->load->view('layout/Vlayout', $data);
        }

        public function dvdangcai()
        {
            $page = array(
                'title' => 'Đơn vị đăng cai'
            );
            $this->load->model('Mtimeline');
            $timeline = $this->Mtimeline->get_list();
            $this->load->model('Mbaiviet');
            $input = array();
            $input['limit'] = array(1, 0);
            $input['where']['FK_sIDLoaiTin '] = 7;
            $thongbao = $this->Mbaiviet->get_list($input);

            $input = array();
            $input['where']['FK_sIDLoaiTin '] = 6;
            $list = $this->Mbaiviet->get_list($input);

            $dLeft = array(
                'thongbao'  => $thongbao,
                'timeline'  => $timeline,
                'list'   => $list,
                'img_title' => 't-dangcai.png',
            );


            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            $data = array(
                'left'      => 'site/Vdanhmuc',
                'right'     => 'site/Vright',
                'dLeft'     => $dLeft,
                'page'      => $page,
            );
            $data['messages'] = $messages;
            
            $this->load->view('layout/Vlayout', $data);
        }

        function album(){
            $page = array(
                'title' => 'Album'
            );
            
            $this->load->model('Mimg');
            // $input = array();
            // $input['limit'] = array(1, 0);
            // $input['where']['FK_sIDLoaiTin '] = 7;
            // $thongbao = $this->Mbaiviet->get_list($input);

            $input = array();
            $input['where']['Type'] = 'album';
            // $listvid = $this->Mimg->get_list($input);
            $anh= $this->Mimg->get_list($input);
            $dLeft = array(
                'img_title' => 't-album.png',
                'anh'   => $anh,
            );


            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            $data = array(
                'left'      => 'site/Valbum',
                'dLeft'     => $dLeft,
                'page'      => $page,
            );
            $data['messages'] = $messages;
            
            $this->load->view('layout/Vlayout', $data);
        }
        public function danhsach()
        {
            $page = array(
                'title' => 'Tổ chức'
            );
            $this->load->model('Mtimeline');
            $timeline = $this->Mtimeline->get_list();
            $this->load->model('Mbaiviet');
            $input = array();
            $input['limit'] = array(1, 0);
            $input['where']['FK_sIDLoaiTin '] = 7;
            $thongbao = $this->Mbaiviet->get_list($input);

            $input = array();
            $input['where']['FK_sIDLoaiTin '] = 8;
            $list = $this->Mbaiviet->get_list($input);

            $dLeft = array(
                'thongbao'  => $thongbao,
                'timeline'  => $timeline,
                'list'   => $list,
                'img_title' => 't-danhsach.png',
            );


            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            $data = array(
                'left'      => 'site/Vdanhmuc',
                'right'     => 'site/Vright',
                'dLeft'     => $dLeft,
                'page'      => $page,
            );
            $data['messages'] = $messages;
            
            $this->load->view('layout/Vlayout', $data);
        }

        


    }
?>