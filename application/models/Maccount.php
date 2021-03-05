<?php
class Maccount extends MY_Model{
    var $table = 'tbl_taikhoan';
    var $key ='sIDTaiKhoan';

	public function __construct() {
		parent::__construct();
	}

    public function joindb()
	{
        $this->db->join('tbl_quyen AS quyen', 'tbl_taikhoan.sIDQuyen = quyen.sIDQuyen', 'left');
        $this->db->join('tbl_khoa AS khoa', 'tbl_taikhoan.sMaKhoa = khoa.sMaKhoa', 'left');
	}

    public function id(){
        $this->db->select_max('sIDTaiKhoan');
        $this->db->from('tbl_taikhoan');
        $result = $this->db->get()->row();  
        $id = $result->sIDTaiKhoan;
        return ++$id;
    }
}