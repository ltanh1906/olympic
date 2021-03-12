<?php
class Mthisinh extends MY_Model{
    var $table = 'tbl_thisinh';
    var $key ='sIdThisinh';

    function tachten($ten){
        $fullName = $ten;
        $arrName = explode(" ", $fullName);
        $firstName = array_shift($arrName);
        $lastName = array_pop($arrName); 
        $middleName = implode(" ", $arrName);
        $hotendem = $firstName. " " .$middleName;

        $ten = array(
            'ten'     => $lastName,
            'hodem'      => $hotendem,
        );
        return $ten;
    }

    public function joindb()
	{
        $this->db->join('tbl_khoa AS khoa', 'tbl_thisinh.FK_sMaKhoa = khoa.sMaKhoa', 'left');
        $this->db->join('tbl_monthi AS monthi', 'tbl_thisinh.sMaMon = monthi.sMaMon', 'left');

	}

    public function getdata($makhoa)
    {
        $this->db->where('FK_sMaKhoa ', $makhoa);
        $this->db->select('*');
        $this->db->join('tbl_khoa AS khoa', 'tbl_thisinh.FK_sMaKhoa = khoa.sMaKhoa', 'left');
        $this->db->join('tbl_monthi AS monthi', 'tbl_thisinh.sMaMon = monthi.sMaMon', 'left');
    
        return $this->db->get()->result_array();
    }

    public function list(){
        $this->db->select("*")
                    -> from('tbl_thisinh')
					->join("tbl_monthi", "tbl_monthi.sMaMon = tbl_thisinh.sMaMon")
                    ->order_by('sTruong asc, tbl_thisinh.sMaMon desc, sGhiChu asc, sTen asc');
        $result = $this->db->get();
        if($result->num_rows()!=0){
            return $result->result_array();
        }else{
            return false;
        }

    }
    

    public function layDanhSachThiSinh($khoa, $mon){

        $today = date("d/m/Y");
        $sql = "SELECT tbl_thisinh.sMaSinhVien,tbl_thisinh.sHoTenDem,tbl_thisinh.sTen,tbl_thisinh.sGhiChu,tbl_thisinh.sTruong,tbl_monthi.sTenMon,tbl_monthi.sMaMon,tbl_khoa.sMaKhoa,tbl_khoa.sTenKhoa 
        FROM tbl_thisinh, tbl_khoa, tbl_monthi 
        WHERE tbl_thisinh.FK_sMaKhoa = tbl_khoa.sMaKhoa 
        and tbl_thisinh.sMaMon = tbl_monthi.sMaMon
        and tbl_thisinh.sNamThi =".substr($today,6,4);
        if(!empty($mon)){
            $sql .=" AND tbl_monthi.sMaMon='$mon'";
        }
        if($khoa != '13'){
            $sql .=" AND tbl_khoa.sMaKhoa='$khoa'";
        }
        $sql .= " ORDER by tbl_thisinh.sMaMon ASC, tbl_thisinh.sGhiChu ASC, tbl_thisinh.sTen ASC, tbl_khoa.sTenKhoa ASC";
        return $this->db->query($sql)->result_array();
    }
    public function listKhoa($makhoa = 13)
    {
        $data = '';
        if($makhoa == 13){
            $data = $this->db->query('SELECT sMaKhoa, sTenKhoa FROM tbl_khoa WHERE not sMaKhoa = '.$makhoa)->result_array();
        }
        else{
            $data = $this->db->query('SELECT sMaKhoa, sTenKhoa FROM tbl_khoa WHERE sMaKhoa = '.$makhoa)->result_array();
        }
        return $data;
    }
    public function listMon($mon = null)
    {
        $data = $this->db->get('tbl_monthi')->result_array();
        return $data;
    }

}