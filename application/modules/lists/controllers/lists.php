<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* lists controller
*/

class lists extends MX_Controller 
{
 
 function __construct()
    {
        parent::__construct();
        
	$this->load->model("lists_mdl");
	 
    }

public function get_featured_home_list()
{
	$featured_list = array();
	$featured_list_details = $this->lists_mdl->get_featured_list_details("featured_home");
	$product_ids_csv = $featured_list_details[0]->product_ids;
	$product_ids = explode(",",$product_ids_csv);
	foreach($product_ids as $product_id)
	{
		$poduct_details = $this->get_product_details_from_api($product_id);
		if(!empty($poduct_details))
		{
			$featured_list[] = $this->get_product_details_from_api($product_id);
		}
	}
	return $featured_list;
}

public function get_featured_single_right()
{
	$featured_list = array();
	$featured_list_details = $this->lists_mdl->get_featured_list_details("featured_single_right");
	$product_ids_csv = $featured_list_details[0]->product_ids;
	$product_ids = explode(",",$product_ids_csv);
	foreach($product_ids as $product_id)
	{
		$poduct_details = $this->get_product_details_from_api($product_id);
		if(!empty($poduct_details))
		{
			$featured_list[] = $this->get_product_details_from_api($product_id);
		}
	}
	return $featured_list;
}	 

public function get_featured_cart_right()
{
	$featured_list = array();
	$featured_list_details = $this->lists_mdl->get_featured_list_details("featured_cart_right");
	$product_ids_csv = $featured_list_details[0]->product_ids;
	$product_ids = explode(",",$product_ids_csv);
	foreach($product_ids as $product_id)
	{
		$poduct_details = $this->get_product_details_from_api($product_id);
		if(!empty($poduct_details))
		{
			$featured_list[] = $this->get_product_details_from_api($product_id);
		}
	}
	return $featured_list;
}

public function get_featured_single_bottom()
{
	$featured_list = array();
	$featured_list_details = $this->lists_mdl->get_featured_list_details("featured_single_bottom");
	$product_ids_csv = $featured_list_details[0]->product_ids;
	$product_ids = explode(",",$product_ids_csv);
	foreach($product_ids as $product_id)
	{
		$poduct_details = $this->get_product_details_from_api($product_id);
		if(!empty($poduct_details))
		{
			$featured_list[] = $this->get_product_details_from_api($product_id);
		}
	}
	return $featured_list;
}	 


public function get_featured_items_4_emails()
{
	$featured_list = array();
	$featured_list_details = $this->lists_mdl->get_featured_list_details("emails");
	$product_ids_csv = $featured_list_details[0]->product_ids;
	$product_ids = explode(",",$product_ids_csv);
	foreach($product_ids as $product_id)
	{
		$poduct_details = $this->get_product_details_from_api($product_id);
		if(!empty($poduct_details))
		{
			$featured_list[] = $this->get_product_details_from_api($product_id);
		}
	}
	return $featured_list;
}	 


	
private function get_product_details_from_api($id)
	{
		$API_KEY = API_KEY ;
		$q_url_product_details = "http://api.shopstyle.com/api/v2/products/$id?pid=$API_KEY";
		$product_details = @file_get_contents($q_url_product_details);
		if(!empty($product_details))
		{
			return(json_decode($product_details));
		}
	}

 
 
 

	
    
}

/* End of file sessman.php */
/* Location: ./application/modules/sessman/controllers/sessman.php */