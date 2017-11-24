<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mylib
{
	var $CI;
	
	 public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
		$this->CI->load->library(array('session','table'));
        $this->CI->config->item('base_url');
        $this->CI->load->database();
     }
	
	public function set_view($v, $data){
		$data['view'] = $v;
		$this->CI->load->view('TEMPLATE', $data);
	}
	
	
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */