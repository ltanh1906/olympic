<?php
    class Cimg extends MY_Controller{
        function __construct()
        {
            parent::__construct();
            $this->load->model('Mimg');
            $message = '';
        }

        function index(){
            $total_rows = $this->Mimg->get_total();
            //load thư viện phân trang
            $this->load->library('pagination');
            //
            $config = array();
            $config['total_rows'] = $total_rows; //Tổng tất cả sản phẩm trên website
            $config['base_url'] = admin_url('Cimg/index'); 
            $config['per_page'] = 6; //Số lượng sản phẩm hiển thị trên 1 trang
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
            $page = $this->pagination->create_links();
            /////////////////////////////////
            $type = $this->input->get('type');
            if($type){
                $input['where']['Type'] = $type;
            }

            //lấy danh sách
            $list = $this->Mimg->get_list($input);
  

            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            
            $dtemp = array(
                'page' => 'Thêm tài nguyên',
                'total_rows' => $total_rows,
                'pagi'  => $page,
                'list'  => $list,
            );
            $data = array(
                'temp' => 'admin/Vimg/index',
                'dtemp'=> $dtemp,
            );
            $data['messages'] = $messages;
            $this->load->view('admin/Vmain', $data);
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
            // else{
            //     $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            //     return false;
            // }
        }


        function add(){
            
            $this->load->library('form_validation');
            $this->load->helper('form');
            $dau = 'tn';
            if($this->input->post()){
                
                $this->form_validation->set_rules('tieude', 'Tiêu đề', 'required');
                $this->form_validation->set_rules('type', 'Thể loại', 'required');
                $this->form_validation->set_rules('image', '', 'callback_file_check');
                
                
                //nhập liệu chính xác
                if($this->form_validation->run() == true){
                    //them vao csdl
                    $sMoTa     = $this->input->post('tieude');
                    $type = $this->input->post('type');
                    $date = now();
                    if($type != 'video'){
                        $this->load->library('upload_library');
                        $upload_path = './upload/slide';
                        $upload_data = $this->upload_library->upload($upload_path, 'image', $dau);
                        $image_link = '';
                        if(isset($upload_data['file_name'])){
                            $image_link = $upload_data['file_name']; //nếu có ảnh tải lên thì lấy tên ảnh
                        }
                    }
                    else{
                        $image_link = $this->input->post('linkvideo');
                    }
                    
                    

                    $data = array(
                        'sLink'          => $image_link,
                        'sMoTa'          => $sMoTa,
                        'Type'           => $type,
                        'dNgayTao'       => $date,
                    );

                    //thêm mới vào csdl
                    if($this->Mimg->create($data))
                    {
                        //tạo ra nôi dung thông báo
                        $this->session->set_flashdata('message', 'Thêm thành công');
                    }else{
                        $this->session->set_flashdata('message', 'Cập nhật thất bại');
                    }
                    //Chuyển tới trang danh sách
                    redirect(admin_url('Cimg'));
                }
            }
            

            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            
            $dtemp = array(
                'page' => 'Thêm tài nguyên',
            );
            $data = array(
                'temp' => 'admin/Vimg/add',
                'dtemp'=> $dtemp,
            );
            $data['messages'] = $messages;
            $this->load->view('admin/Vmain', $data);
        }

        function delete(){
            
            //lấy id cần xoá trên đường link
            $id = $this->uri->rsegment('3');
            //ép kiểu 
            $id = intval($id);
            //lấy thông tin của id để xem có tồn tại không
            $info = $this->Mimg->get_info($id);
            if(!$info){
                $this->session->set_flashdata('message', 'Không tồn tại bài viết này');
                redirect(admin_url('Cimg'));
            }
            //thực hiện xoá
            $this->Mimg->delete($id);
            //xoa cac anh cua san pham
            $image_link = './upload/slide/'.$info->sLink;
            if(file_exists($image_link))
            {
                unlink($image_link);
            }
            //xoa cac anh kem theo cua san pham
            $this->session->set_flashdata('message', 'Xoá dữ liệu thành công');
            redirect(admin_url('Cimg'));
        }

        function edit(){
           
            $this->load->library('form_validation');
            $this->load->helper('form');

            $id = $this->uri->rsegment('3');
            $tainguyen = $this->Mimg->get_info($id);
            $oldpic = $tainguyen->sLink;
            
            $dau = 'tn';
            if($this->input->post()){
                $this->form_validation->set_rules('tieude', 'Tiêu đề', 'required');
                $this->form_validation->set_rules('type', 'Thể loại', 'required');
                $this->form_validation->set_rules('image', '', 'callback_file_check');
                //nhập liệu chính xác
                if($this->form_validation->run() == true){
                    //them vao csdl
                    $sMoTa     = $this->input->post('tieude');
                    $type = $this->input->post('type');
                    $date = now();
                    if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
                        if($type != 'video'){
                            $t = './upload/slide/'.$oldpic;   
                            unlink($t);
                            $this->load->library('upload_library');
                            $upload_path = './upload/slide';
                            $upload_data = $this->upload_library->upload($upload_path, 'image', $dau);
                            $image_link = '';
                            if(isset($upload_data['file_name'])){
                                $image_link = $upload_data['file_name']; //nếu có ảnh tải lên thì lấy tên ảnh
                            }
                        }
                        else{
                            $image_link = $this->input->post('linkvideo');
                        }
                    }

                    
                    
                    if($image_link != ''){
                        $data = array(
                            'sLink'          => $image_link,
                            'sMoTa'          => $sMoTa,
                            'type'           => $type,
                            'dNgayTao'       => $date,
                        );
                    }
                    else{
                        $data = array(
                            'sMoTa'          => $sMoTa,
                            'type'           => $type,
                            'dNgayTao'       => $date,
                        );
                    }
                    
                    //thêm mới vào csdl
                    if($this->Mimg->update($id, $data))
                    {
                        $this->session->set_flashdata('message', 'Thêm thành công');
                    }else{
                        $this->session->set_flashdata('message', 'Cập nhật thất bại');
                    }
                    //Chuyển tới trang danh sách
                    redirect(admin_url('Cimg/index'));
                }
            }

            $messages = array(
                'messages'	=> $this->session->flashdata('messages'),
            );
            
            $dtemp = array(
                'page' => 'Sửa tài nguyên',
                'tn'    => $tainguyen,
            );
            $data = array(
                'temp' => 'admin/Vimg/edit',
                'dtemp'=> $dtemp,
            );
            $data['messages'] = $messages;
            $this->load->view('admin/Vmain', $data);
        }

        
    }
?>