<?php
    function public_url($url = ''){
        return base_url('public/'.$url);
    }

    function home_url($url=''){
        return base_url('Chome/'.$url);
    }

    function pre($list, $exit = true){
        echo "<pre>";
        print_r($list);
        if($exit){
            die();
        }
    }
    if (!function_exists('getSession')){
        function getSession($name = 'user'){
            $CI =& get_instance();
            return $CI->session->userdata($name);
        }
    }
    
    if(! function_exists('setToast'))
{
    function setToast($icon = 'info', $title = '') {
        $CI =& get_instance();
		$messages = array(
			'title'		=> $title,
			'icon'		=> $icon
		);
		$CI->session->set_flashdata('messages', $messages);
    }
}
