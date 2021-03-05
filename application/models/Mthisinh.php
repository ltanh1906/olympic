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
            $this->db->from('tbl_thisinh');
        
            return $this->db->get()->result_array();
        }
}