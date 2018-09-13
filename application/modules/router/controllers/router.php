<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class router extends MX_Controller 
{

 function __construct()
    {
        parent::__construct();
		
		//$this->load->helper('cookie');
		$this->load->helper('url');
    }
    
public function category($cat_id)
{
    	redirect( base_url()."product/browse/0?cat_id=".$cat_id ) ;
	
}



}

/* End of file router.php */
/* Location: ./application/modules/router/controllers/router.php */