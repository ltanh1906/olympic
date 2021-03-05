<?php
//tạo ra các link trong admin
    function admin_url($url=''){
        return base_url('admin/'.$url);
    }