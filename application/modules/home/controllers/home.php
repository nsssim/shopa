<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends MX_Controller 
{
	function __construct()
    {
        parent::__construct();
        
		$this->load->module("seo");
        $this->load->model("seo_mdl");
		
		 //load the message module
		
		$this->load->helper('url');
		
		
    }
	
	public function index()
	{
		//featured items are inside lists
		$API_KEY = API_KEY ;
		
		/*$API_USER_ID = API_USER_ID ;
		
		$q_url_lists = "http://api.shopstyle.com/api/v2/lists?pid=$API_KEY&userId=$API_USER_ID&offset=0&limit=8";
		$lists_file = file_get_contents($q_url_lists );
		
		$data['lists']= json_decode($lists_file);*/
		
		$this->load->module("lists");
		$data['lists']['featured_home'] = $this->lists->get_featured_home_list();
		
		
		//session cleanup
		$this->load->module("sessman");
		$this->sessman->clean_up_session_table();
		
		$this->load->module("lng");
		$lang_id = $this->lng->get_n_set_language_id();			
				
		// load the template manager
		$this->load->module('templateman');
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details 
		$template_path_info = $data['template_info']['path'];  
		
		$this->load->model('home_mdl');
		
		//SEO
		$data['meta_info']  =  $this->seo_mdl->get_meta_info("index",$lang_id);// get the meta info from database 
		
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
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
				
		
		$this->load->module("msg");
		$data['words'] = $this->msg->get_words("home");
		$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
		
        $this->load->view($template_path_info.'/common/css',$data);  
        $this->load->view($template_path_info.'/common/header',$header_data);  
        $this->load->view($template_path_info.'/common/slider');  
        $this->load->view($template_path_info.'/home_vew',$data);  
        $this->load->view($template_path_info.'/common/footer',$footer_data);  
        $this->load->view($template_path_info.'/common/script_home');  
		
		//$this->load->view('index');
	}
	/**
	* this function is called whenever the session expires and the user tries to access session data (this function is depricated)
	* @param string $param
	* 
	* @return null
	*/
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