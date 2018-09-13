<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class deals extends MX_Controller {


	public function index()
	{
	}
	
	public function get_product_deal($id)
	{
		$this->load->model("deals_mdl");
		$product_deal =  $this->deals_mdl->get_product_deal($id);
		return $product_deal;
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */