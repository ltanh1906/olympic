<?php
    class Ctimeline extends MY_Controller{
        function __construct()
        {
            parent::__construct();
            $this->load->model('Mtimeline');
        }

        function index(){
            $time = $this->Mtimeline->get_list();
            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            
            $dtemp = array(
                'page' => 'Timeline Cuộc Thi',
                'time'  => $time,
                'list'  => $list,
            );
            $data = array(
                'temp' => 'admin/Vtimeline/index',
                'dtemp'=> $dtemp,
            );
            $data['messages'] = $messages;
            $this->load->view('admin/Vmain', $data);
        }

        function edit(){
            $id = $this->uri->segment(4);
            $vongthi = $this->Mtimeline->get_info($id);
            
            if($this->input->post()){
                $date = $this->input->post('date');
                
                $data = array(
                    'sThoiGian' => strtotime($date),
                );
                if($this->Mtimeline->update($id, $data)){
                    settoast('success', 'Cập nhật thành công');
                    redirect(admin_url('Ctimeline'));
                }
            }
            
            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            
            $dtemp = array(
                'page' => 'Timeline Cuộc Thi',
                'time'  => $time,
                'list'  => $list,
                'vongthi'=> $vongthi,
            );
            $data = array(
                'temp' => 'admin/Vtimeline/edit',
                'dtemp'=> $dtemp,
            );
            $data['messages'] = $messages;
            $this->load->view('admin/Vmain', $data);
        }
        

        
    }
?>