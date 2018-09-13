<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class main extends MX_Controller {

	
	public function cat_left()
	{
		$this->load->view("cat_left");	
	}
	
		public function css()
	{
		$this->load->view("css");	
	}
	
	public function script()
	{
		$this->load->view("script");	
	}
	
	public function header()
	{
		$this->load->view("header");	
	}
	
	public function footer()
	{
		$this->load->view("footer");	
	}
	public function slider()
	{
		$this->load->view("slider");	
	}

}

/* End of file main.php */
/* Location: ./application/controllers/welcome.php */