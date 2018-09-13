<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends MX_Controller 
{
	
	public function index()
	{
					
		$this->load->library('language'); // call the custom class Language 
		$data_args = func_get_args(); // get the argument from index() ... "tr", "en", "ru" ...etc
		$this->language->set_user_language($data_args); 
		
		/*//$cart_flag = $this->session->userdata('cart');
		if(!( $this->session->userdata('cart')))
		{
			$cart = array(55, 1999,888);
			$this->session->set_userdata('cart', $cart);
		}*/
		
		// check if userdata languageid is set 
		$lang_id = $this->session->userdata('language_id');
		
		// needed for cleanin the session 
		$this->load->library('session_cleanser'); 
		// clean old non-active sessions in the database (I use my own garbage-collection)
		//$this->session_cleanser->clean_session();
		 
		//$this->load->library('categories'); // call the custom class categories 
		//$category = "womens-clothes";
		//$data['women_clothes_subcategories']  = $this->categories->get_categories($category);
		
		$this->load->model('home_mdl');
		$data['meta_info']  =  $this->home_mdl->get_meta_info($lang_id);// get the meta info from database 
		$data['template_info'] = $this->home_mdl->get_template_info();// get the template for the active shop   
		
		// save the template information in the Session for further use in other views
		$this->session->set_userdata('template_info', $data['template_info']); 
		$template_info = $this->session->userdata('template_info');
		
		$combo_name = "featured";
		$data['featured_items'] = $this->home_mdl->get_combo($combo_name,2,1);// get the featured products for the main shop  2 is english and 1 is the id of the main shop  
		
        //load REST data from the API to check availability 
		$featured_items_list = array();
		foreach($data['featured_items'] as $featured_item)
		{
			$idd = $featured_item->product_idd;
			$product_stream = file_get_contents("http://api.shopstyle.com/api/v2/products/".$idd."?pid=sugar");
			//echo $product_stream;
			$jproduct = json_decode($product_stream);
			$featured_items_list[] = ["id"=>$featured_item->prod_id,"instorck"=>$jproduct->inStock]; 
		}
		
		//get product deals
		$deals_list = array();
		$this->load->module("deals");
		
		foreach($data['featured_items'] as $featured_item)
		{
			$id = $featured_item->prod_id;
			$product_deal = $this->deals->get_product_deal($id);
			$deals_list[] = ["id"=>$featured_item->prod_id,"product_deal"=>$product_deal]; 
		}
		
		$data['products_deal'] = $deals_list;
        
        $this->load->module("categories");
        
        $data["women_cat_id"] = 2 ;
        $data["men_cat_id"] =   166 ;
        $data["kids_cat_id"] =  323 ;
        $data["living_cat_id"] = 806 ;
        
		$data["women_subcat"] = $this->categories->get_subcategories($data["women_cat_id"]);
		$data["men_subcat"] = $this->categories->get_subcategories( $data["men_cat_id"]); 
		$data["kids_and_babies_subcat"] = $this->categories->get_subcategories($data["kids_cat_id"]);
		$data["living_subcat"] = $this->categories->get_subcategories($data["living_cat_id"]);
		
		// get all the brands from database 
		$this->load->module("brands");
		$data["all_brands"] = $this->brands->get_all_brands();
		  
        
        //for debugging session
		$session_id = $this->session->userdata('session_id');
		//echo $session_id;
		      
		      
		
		/*
		echo "<pre>";
		var_dump($data);
		echo "</pre>";  
		*/
		
        
        $this->load->view($template_info['path'].'/home_vew',$data);  
		
		//$this->load->view('index');
	}
	public function error($param)
	{
		$this->load->helper('url');
		if($param == "lng") 
		{
			echo "you've been away for a long time your session expired .... " ;
			echo '<a href="'.base_url().'" >click here to go back</a>'	;	
		}
		$this->session->sess_destroy();
	}
	
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */