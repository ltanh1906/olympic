<?php
class Mbaiviet extends MY_Model{
    var $table = 'tbl_baiviet';
    var $key = 'sIDBaiviet';

    public function __construct() {
            parent::__construct();
    }
    
    public function joindb()
    {
        $this->db->join('tbl_loaitin AS loaitin', 'tbl_baiviet.FK_sIDLoaiTin = loaitin.sIDLoaiTin', 'left');
    }
}