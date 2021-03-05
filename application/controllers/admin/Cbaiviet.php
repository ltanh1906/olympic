<?php
    class Cbaiviet extends MY_Controller{
        function __construct()
        {
            parent::__construct();
            $this->load->model('Mbaiviet');
            $message = '';
        }

        

        function index(){
            
            $total_rows = $this->Mbaiviet->get_total();
            
            

            $this->load->model('Mloaitin');
            $input = array();
            $loaitin = $this->Mloaitin->get_list($input);


            //load thư viện phân trang
            $this->load->library('pagination');
            //
            $config = array();
            $config['total_rows'] = $total_rows; //Tổng tất cả sản phẩm trên website
            $config['base_url'] = admin_url('Cbaiviet/index'); // link hiển thị ra danh sách sản phẩm
            $config['per_page'] = 7; //Số lượng sản phẩm hiển thị trên 1 trang
            $config['uri_segment'] = 4; //phân đoạn hiển thị ra số trang trên url;
            $config['next_link'] = "Next page";
            $config['prev_link'] = "Prev Page";
            
            //khởi tạo các cấu hình phân trang
            $this->pagination->initialize($config);
            //

            $segment = $this->uri->segment(4);
            $segment = intval($segment);

            $input = array();
            $input['limit'] = array($config['per_page'] , $segment);

            /////////////////////////////////
            $this->Mbaiviet->joindb();
            $id = $this->input->get('id');
            $id = intval($id);
            $input['where'] = array();
            if($id > 0){
                $input['where']['sIDBaiviet'] = $id;
            }
            
            //lọc theo tên
            $tieude = $this->input->get('tieude');
            if($tieude){
                $input['like'] = array('sTieuDe', $tieude);
            }
            //lọc theo catalog
            $id_loaitin = $this->input->get('loaitin');
            $id_loaitin = intval($id_loaitin);
            if($id_loaitin){
                $input['where']['sIDLoaiTin'] = $id_loaitin;
            }

            //lấy danh sách
            $list = $this->Mbaiviet->get_list($input);
            $page = $this->pagination->create_links();
    
            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            
            $dtemp = array(
                'page' => 'Danh sách bài viết',
                'loaitin' => $loaitin,
                'list'=> $list,
                'total_rows'=> $total_rows,
                'pagi'  => $page,
            );
            $data = array(
                'temp' => 'admin/Vbaiviet/index',
                'dtemp'=> $dtemp,
            );
            $data['messages'] = $messages;
            $this->load->view('admin/Vmain', $data);
        }

        function file_check($str){
            $allowed_mime_type_arr = array('application/pdf','application/msword','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
            $mime = get_mime_by_extension($_FILES['image']['name']);
            if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
                if(in_array($mime, $allowed_mime_type_arr)){
                    return true;
                }else{
                    $this->form_validation->set_message('file_check', 'Chỉ cho phép pdf/gif/jpg/png/doc/xls file');
                    return false;
                }
            }
            // else{
            //     $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            //     return false;
            // }
        }


        function add(){
  
            $this->load->model('Mloaitin');
            $input = array();
            $loaitin = $this->Mloaitin->get_list($input);

            $this->load->library('form_validation');
            $this->load->helper('form');
            if($this->input->post()){
                $this->form_validation->set_rules('tieude', 'Tiêu đề', 'required');
                $this->form_validation->set_rules('loaitin', 'Loại tin', 'required');
                $this->form_validation->set_rules('image', '', 'callback_file_check');
                //nhập liệu chính xác
                if($this->form_validation->run() == true){
                    //them vao csdl
                    $tieude     = $this->input->post('tieude');
                    $id_loaitin = $this->input->post('loaitin');
                    $tomtat = $this->input->post('tomtat');
                    $noidung = $this->input->post('content');
                    $date = now();
                    //lấy tên file ảnh minh hoạ đc upload lên
                    $this->load->library('upload_library');
                    $upload_path = './upload/product';
                    $upload_data = $this->upload_library->upload($upload_path, 'image');
                    $image_link = '';
                    if(isset($upload_data['file_name'])){
                        $image_link = $upload_data['file_name']; //nếu có ảnh tải lên thì lấy tên ảnh
                    }



                    //lưu dữ liệu
                    $data = array(
                        'sHinhAnhMinhHoa' => $image_link,
                        'sIDLoaiTin'      => $id_loaitin,
                        'sTieuDe'         => $tieude,
                        'tNoiDung'        => $noidung,
                        'tTomTat'         => $tomtat,
                        'dNgayDang'       => $date,
                    );

                    //thêm mới vào csdl
                    if($this->Mbaiviet->create($data))
                    {
                        //tạo ra nôi dung thông báo
                        $this->session->set_flashdata('message', 'Thêm thành công');
                    }else{
                        $this->session->set_flashdata('message', 'Cập nhật thất bại');
                    }
                    //Chuyển tới trang danh sách
                
                    redirect(admin_url('Cbaiviet'));
                }
            }

            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            
            $dtemp = array(
                'page' => 'Thêm bài viết',
                'loaitin' => $loaitin,
            );
            $data = array(
                'temp' => 'admin/Vbaiviet/add',
                'dtemp'=> $dtemp,
            );
            $data['messages'] = $messages;
            $this->load->view('admin/Vmain', $data);
        }


        
        function edit(){
            $id = $this->uri->rsegment('3');
            $baiviet = $this->Mbaiviet->get_info($id);
            if(!$baiviet){
                $this->session->set_flashdata('message', 'Không tồn tại bài viết này');
                redirect(admin_url('Cbaiviet'));
            }

            $this->load->library('form_validation');
            $this->load->helper('form');
            
            //lấy danh sách danh mục
            $this->load->model('Mloaitin');
            $input = array();
            $loaitin = $this->Mloaitin->get_list($input);

            if($this->input->post()){
                $this->form_validation->set_rules('tieude', 'Tiêu đề', 'required');
                $this->form_validation->set_rules('loaitin', 'Loại tin', 'required');
                $this->form_validation->set_rules('image', '', 'callback_file_check');
                //nhập liệu chính xác
                if($this->form_validation->run() == true){
                    //them vao csdl
                    $tieude     = $this->input->post('tieude');
                    $id_loaitin = $this->input->post('loaitin');
                    $tomtat = $this->input->post('tomtat');
                    $noidung = $this->input->post('content');
                    $date = now();
                    //lấy tên file ảnh minh hoạ đc upload lên
                    $this->load->library('upload_library');
                    $upload_path = './upload/product';
                    $upload_data = $this->upload_library->upload($upload_path, 'image');
                    $image_link = '';
                    if(isset($upload_data['file_name'])){
                        $image_link = $upload_data['file_name']; //nếu có ảnh tải lên thì lấy tên ảnh
                    }

                    $data = array(
                        'sIDLoaiTin'      => $id_loaitin,
                        'sTieuDe'         => $tieude,
                        'tNoiDung'        => $noidung,
                        'tTomTat'         => $tomtat,
                        'dNgayDang'       => $date,
                    );
                    //lưu dữ liệu
                    if($image_link!=''){
                        $data = array(
                            'sHinhAnhMinhHoa' => $image_link,
                        );
                    }
                    //update vào csdl
                    if($this->Mbaiviet->update($id, $data)){
                        $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                    }
                    else{
                        $this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
                    }
                    redirect(admin_url('Cbaiviet'));
                }
                    
            }


            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            
            $dtemp = array(
                'page' => 'Thêm bài viết',
                'loaitin' => $loaitin,
                'baiviet'   => $baiviet,
            );
            $data = array(
                'temp' => 'admin/Vbaiviet/edit',
                'dtemp'=> $dtemp,
            );
            $data['messages'] = $messages;
            $this->load->view('admin/Vmain', $data);

        }


        function delete(){

            
            $id = $this->uri->rsegment('3');
            
            $id = intval($id);
            
            $info = $this->Mbaiviet->get_info($id);
            if(!$info){
                $this->session->set_flashdata('message', 'Không tồn tại bài viết này');
                redirect(admin_url('Cbaiviet'));
            }
            
            $this->Mbaiviet->delete($id);
            
            $image_link = './upload/product/'.$info->sHinhAnhMinhHoa;
            if(file_exists($image_link))
            {
                unlink($image_link);
            }
            
            $this->session->set_flashdata('message', 'Xoá dữ liệu thành công');
            redirect(admin_url('Cbaiviet'));
        }
    }
?>