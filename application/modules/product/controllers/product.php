<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends MX_Controller {

 function __construct()
    {
        $jproduct = NULL;
        parent::__construct();
        $this->load->helper('url');
		$this->load->model('home_mdl'); // needed for the template info (template path)
		$this->load->model('product_mdl');  // needed for the product details and images 
		
		$this->load->module('seo');  // needed for the product details and images 
		$this->load->model('seo_mdl');  // needed for the product details and images 
		
		// call cache module
		$this->load->module("cachy");
		
		//call messages module
		$this->load->module("msg");
		
		//load the language module
		$this->load->module("lng");
		
		//session cleanup
		$this->load->module("sessman");
		$this->sessman->clean_up_session_table();
		
		//loadfilter module
		$this->load->module("filter");
    }

	// for crypting url
	private	function getDataURI($image, $mime = '') 
		{
			return 'data: '.(function_exists('mime_content_type') ? mime_content_type($image) : $mime).';base64,'.base64_encode(file_get_contents($image));
		}
	
	private function show_images($matches)
	{
		$matches_unique = array_unique($matches[0]);
		foreach($matches_unique as $image_url)
		{
			if (strpos($image_url, '_best.jpg') !== false)
			{
				echo "<img src='".$image_url."'> /";
			}
		}
	}
	
	private function save_image($matches,$local_path)
	{
		$this->load->helper('file');
		//remove duplicated urls
		$matches_unique = array_unique($matches[0]);
		foreach($matches_unique as $image_url)
		{
			//save only best images
			$pattern = '/https:\/\/.+_best.jpg/';
			//if(preg_match($pattern, $image_url))
			//if (strpos($image_url, '_best.jpg') !== false)
			if (strpos($image_url, '_best.jpg') !== false)
			{
					
				//$image_url = 'https://resources.shopstyle.com/pim/d3/1f/d31f48ba1d1b83208cfbe39a4f744e56_best.jpg';
				$image_data = file_get_contents($image_url);
				$search = array('https://','.','shopstyle','local_com','/','jpg');
				$replace = array('','_','local','local','@','.jpg');
				$image_new_name = str_replace($search,$replace,$image_url);
				
				/*$image_new_name = str_replace('https://','',$image_url);
				$image_new_name = str_replace('.','_',$image_new_name);
				$image_new_name = str_replace('shopstyle','local',$image_new_name);
				$image_new_name = str_replace('local_com','local',$image_new_name);
				$image_new_name = str_replace('/','@',$image_new_name);
				$image_new_name = str_replace('jpg','.jpg',$image_new_name);*/
				
				$local_path = './images/'.$image_new_name;
				
				//if file does not exist then write it
				//$file = @fopen($local_path,'r');
				$file = file_exists ($local_path);
				if(!$file)
				{
					if ( ! write_file($local_path, $image_data))
					{
					     echo 'Unable to write the file<br>';
					}
					else
					{
					     echo "writting $local_path <br>";
					}
				}
				else
				{
					echo "file already saved <br>";
				}
			}
		}
		echo("<br>[ done saving! ]<br>");
	}
	
	private function get_images($matches)
	{
		$matches_unique = array_unique($matches[0]);
		foreach($matches_unique as $image_url)
		{
			if (strpos($image_url, '_best.jpg') !== false)
			{
				$search = array('https://','.','shopstyle','local_com','/','jpg');
				$replace = array('','_','local','local','@','.jpg');
				$image_new_name = str_replace($search,$replace,$image_url);
				//$this->load->helper('url');
				$local_image_path = base_url().'/images/'.$image_new_name;
				
				echo "<img src='".$local_image_path."'> /";
			}
		}
	}
	
		public function details000000000($id)
	{
		//featured items are inside lists
		$API_KEY = API_KEY ;
		//$API_USER_ID = API_USER_ID ;
		
		$this->load->module("lists");
		$data['lists']['featured_single_right'] = $this->lists->get_featured_single_right();
		$data['lists']['featured_single_bottom'] = $this->lists->get_featured_single_bottom();
		
		
		/*$q_url_lists = "http://api.shopstyle.com/api/v2/lists?pid=$API_KEY&userId=$API_USER_ID&offset=0&limit=8";
		$lists_file = file_get_contents($q_url_lists );
		
		$data['lists']= json_decode($lists_file);
		unset($lists_file);*/
		
		//save images to local disc
		$q_url_product_details = "http://api.shopstyle.com/api/v2/products/$id?pid=$API_KEY";
		$product_details = file_get_contents($q_url_product_details);
		
		$data['product_details']= json_decode($product_details);
		
		// prepare the metadata information for the view page
		//if ($data['product_details'][0]->meta_description) $data['meta_description'] =   $data['product_details'][0]->meta_description; else $data['meta_description'] = "";
		//if ($data['product_details'][0]->meta_keywords) 	$data['meta_keywords']    =   $data['product_details'][0]->meta_keywords; else $data['meta_keywords'] = "";
		//if ($data['product_details'][0]->name)				$data['page_title'] 	   =   $data['product_details'][0]->name ; else $data['name'] = "";
		
		//$tmp = $data['product_details'][0]->name ;
		 
       // $data['meta_info'] = $this->product_mdl->get_meta_info($id,$lang_id);
        
        //get wording for the page 
	   	$data['words'] = $this->msg->get_words("single");
	   	$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
        
        $data['template_info']   = $this->home_mdl->get_template_info();// get the template for the active shop 
        
        $this->load->view($data['template_info']['path'].'/common/css',$data);  
        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
        //$this->load->view($data['template_info']['path'].'/common/slider'); 
         
        $this->load->view($data['template_info']['path'].'/single_vew',$data);  // send the result from the model to the view */
        
        //////////////////////////////////////////////////////////////
        
        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
        $this->load->view($data['template_info']['path'].'/common/script_single'); 
        
		
		/*$this->load->model('product_mdl'); // load the model that will get the alternative pictures
		$data['product_alt_img'] = $this->product_mdl->get_product_alt_images($id); // call the method get_product_alt_images inside the class test_mdl
        $page_path =  'templates\\'.$this->template.'\product_details_vew' ;
        $this->load->view($page_path,$data);  // send the result from the model to the view */
	}
	
	public function details1($id)
	{
		$API_KEY = API_KEY;
		$API_USER_ID = 'shopamerika34';
		
		//save images to local disc
		$q_url_product_details = "http://api.shopstyle.com/api/v2/products/$id?pid=$API_KEY";
		$product_details = file_get_contents($q_url_product_details);
		
		//$start = microtime(1);
		// thing to time
		//$xtime = microtime(1)-$start;
		//echo($xtime);
		
		//find all jpg images in response
		//$pattern = '/https:\/\/(.+)\.jpg/im';
		$pattern = '/https:\/\/(.+\.jpg)/U';
		if(preg_match_all($pattern, $product_details, $matches))
		{
		    echo "Found matches:<br>";
		   /* echo '<pre>';
		    print_r($matches);
			echo '</pre>';*/
			
			$start = $xtime = 0;
			$start = microtime(1);
				//$this->save_image($matches,"");
			$xtime = microtime(1)-$start;
			echo('<div style="border:1px solid red; background-color:pink" >');
			echo("Saving images to local disk took :".$xtime." seconds<br>");
			echo("</div>");
			
			$start = $xtime = 0;
			$start = microtime(1);
				$this->get_images($matches);
			$xtime = microtime(1)-$start;
			echo('<div style="border:1px solid green; background-color:#D9DA61" >');
			echo("<br>Loading images from local disk took :".$xtime." seconds");
			echo("</div>");
			
			
			$start = $xtime = 0;
			$start = microtime(1);
				$this->show_images($matches);
			$xtime = microtime(1)-$start;
			echo('<div style="border:1px solid green; background-color:#D9DA61" >');
			echo("<br>Loading images from api took :".$xtime." seconds");
			echo("</div>");
		}
		
		//get my lists from api lists
		$my_lists_url = "http://api.shopstyle.com/api/v2/lists?pid=sugar&userId=$API_USER_ID";
		$my_lists  = json_decode(file_get_contents($my_lists_url)) ;
		$data['my_lists_url'] = $my_lists; 
		echo '<pre>';
		echo var_dump($my_lists) ;
		echo '</pre>';
		
		/////////////////////////////////////////////////////////////
		/*
		$product_details_array = json_decode($product_details);
		
		//$this->save_product_visit_history($id);
		
		
		// get the language from the session 
		$lang_id = $this->lng->get_n_set_language_id();	
		//$lng = $this->session->userdata("language_id");
		// if language is not in session 
		//if (!$lang_id)			redirect(base_url().'home/error/lng');
		
		///getting combos
		$this->load->module("categories");
		
		//combo women 
		$subcat_range_id_women_str = $this->categories->get_all_subcat_ids(2);
		$subcat_range_id_women_str_sanitized1 = str_replace("(", '', $subcat_range_id_women_str);
		$subcat_range_id_women_str_sanitized2 = str_replace(")", '', $subcat_range_id_women_str_sanitized1);
		$subcat_range_id_women_array =  explode(',',$subcat_range_id_women_str_sanitized2);
		
		//combo men 
		$subcat_range_id_men_str = $this->categories->get_all_subcat_ids(166);
		$subcat_range_id_men_str_sanitized1 = str_replace("(", '', $subcat_range_id_men_str);
		$subcat_range_id_men_str_sanitized2 = str_replace(")", '', $subcat_range_id_men_str_sanitized1);
		$subcat_range_id_men_array =  explode(',',$subcat_range_id_men_str_sanitized2);
		
		//combo kids
		$subcat_range_id_kids_str = $this->categories->get_all_subcat_ids(323);
		$subcat_range_id_kids_str_sanitized1 = str_replace("(", '', $subcat_range_id_kids_str);
		$subcat_range_id_kids_str_sanitized2 = str_replace(")", '', $subcat_range_id_kids_str_sanitized1);
		$subcat_range_id_kids_array =  explode(',',$subcat_range_id_kids_str_sanitized2);
		
		//combo home 
		$subcat_range_id_home_str = $this->categories->get_all_subcat_ids(806);
		$subcat_range_id_home_str_sanitized1 = str_replace("(", '', $subcat_range_id_home_str);
		$subcat_range_id_home_str_sanitized2 = str_replace(")", '', $subcat_range_id_home_str_sanitized1);
		$subcat_range_id_home_array =  explode(',',$subcat_range_id_home_str_sanitized2);
		
		/*
		2	>>> women
		166	>>>	men
		323	>>>	kids-and-baby
		806	>>>	living
		*/
		
		/////////////////////////////////////////////////////////////////
		/*
		//get ctegory id from th eseesion
		$cat_id = $this->session->userdata("cat_id");
		//if it fails from getting category_id from session, then find the category of the actual product
		if(empty($cat_id))
		{
			$cat_id = $this->product_mdl->get_category_id_of_a_product($id);
		}
		// check if the actual category is women category or one if its decendents 
		if( in_array($cat_id,$subcat_range_id_women_array) )
		{
			$data['combo'] = $this->product_mdl->get_combo("combo_women",$lang_id);
		}
		if( in_array($cat_id,$subcat_range_id_men_array) )
		{
			$data['combo'] = $this->product_mdl->get_combo("combo_men",$lang_id);
		}
		if( in_array($cat_id,$subcat_range_id_kids_array) )
		{
			$data['combo'] = $this->product_mdl->get_combo("combo_kids",$lang_id);
		}
		if( in_array($cat_id,$subcat_range_id_home_array) )
		{
			$data['combo'] = $this->product_mdl->get_combo("combo_home",$lang_id);
		}
		
		//end getting combos 
		
		$data['related_products'] = $this->product_mdl->get_related_products($id,$lang_id);
		
		$data['product_details'] = $this->product_mdl->get_product_details($id,$lang_id);
				
		//load REST data from the API to check availability 
		$idd = $data['product_details'][0]->idd;
		$product_stream = file_get_contents("http://api.shopstyle.com/api/v2/products/".$idd."?pid=sugar");
		$jproduct = json_decode($product_stream);
		
		$Stock_status = $jproduct->inStock;
		
		//update database stock 
		$update_stock_while_visiting_item = $this->product_mdl->update_stock_while_visiting_item($id,$Stock_status);
		
		
		$data['product_inStock'] = $Stock_status;
		
		$data['template_info']   = $this->home_mdl->get_template_info();// get the template for the active shop 
		
		
		$data['product_alt_img'] = $this->product_mdl->get_product_alt_images($id);
		$data['product_img'] 	  = $this->product_mdl->get_product_images($id);
		
		// try to crype source 
		/*$img_url = $data['product_img'][0]->image;
		$oo = $this->getDataURI($img_url, $mime = '');
		$data['product_img'][0]->image = $oo;*/
		
		///////////////////////////////////////////////////////////////////////
		/*
		$data['product_brand'] 	  = $this->product_mdl->get_product_brand($id);
		
		$data['product_reviews'] = $this->product_mdl->get_product_reviews($id);
		$data['product_sizes'] = $this->product_mdl->get_product_sizes($id);
		$data['product_colors']  = $this->product_mdl->get_product_colors_images_original_size($id);
		
		// prepare the metadata information for the view page
		if ($data['product_details'][0]->meta_description) $data['meta_description'] =   $data['product_details'][0]->meta_description; else $data['meta_description'] = "";
		if ($data['product_details'][0]->meta_keywords) 	$data['meta_keywords']    =   $data['product_details'][0]->meta_keywords; else $data['meta_keywords'] = "";
		if ($data['product_details'][0]->name)				$data['page_title'] 	   =   $data['product_details'][0]->name ; else $data['name'] = "";
		
		//$tmp = $data['product_details'][0]->name ;
		 
        $data['meta_info'] = $this->product_mdl->get_meta_info($id,$lang_id);
        
        $this->load->view($data['template_info']['path'].'/common/css',$data);  
        $this->load->view($data['template_info']['path'].'/common/header');  
        //$this->load->view($data['template_info']['path'].'/common/slider'); 
         
        $this->load->view($data['template_info']['path'].'/single_vew',$data);  // send the result from the model to the view */
        
        //////////////////////////////////////////////////////////////
        /*
        $this->load->view($data['template_info']['path'].'/common/footer');  
        $this->load->view($data['template_info']['path'].'/common/script_single'); 
        
		
		/*$this->load->model('product_mdl'); // load the model that will get the alternative pictures
		$data['product_alt_img'] = $this->product_mdl->get_product_alt_images($id); // call the method get_product_alt_images inside the class test_mdl
        $page_path =  'templates\\'.$this->template.'\product_details_vew' ;
        $this->load->view($page_path,$data);  // send the result from the model to the view */
	}
	
	public function details0($id)
	{
		
		$this->save_product_visit_history($id);
		
		
		// get the language from the session 
		$lang_id = $this->lng->get_n_set_language_id();	
		//$lng = $this->session->userdata("language_id");
		// if language is not in session 
		//if (!$lang_id)			redirect(base_url().'home/error/lng');
		
		///getting combos
		$this->load->module("categories");
		
		//combo women 
		$subcat_range_id_women_str = $this->categories->get_all_subcat_ids(2);
		$subcat_range_id_women_str_sanitized1 = str_replace("(", '', $subcat_range_id_women_str);
		$subcat_range_id_women_str_sanitized2 = str_replace(")", '', $subcat_range_id_women_str_sanitized1);
		$subcat_range_id_women_array =  explode(',',$subcat_range_id_women_str_sanitized2);
		
		//combo men 
		$subcat_range_id_men_str = $this->categories->get_all_subcat_ids(166);
		$subcat_range_id_men_str_sanitized1 = str_replace("(", '', $subcat_range_id_men_str);
		$subcat_range_id_men_str_sanitized2 = str_replace(")", '', $subcat_range_id_men_str_sanitized1);
		$subcat_range_id_men_array =  explode(',',$subcat_range_id_men_str_sanitized2);
		
		//combo kids
		$subcat_range_id_kids_str = $this->categories->get_all_subcat_ids(323);
		$subcat_range_id_kids_str_sanitized1 = str_replace("(", '', $subcat_range_id_kids_str);
		$subcat_range_id_kids_str_sanitized2 = str_replace(")", '', $subcat_range_id_kids_str_sanitized1);
		$subcat_range_id_kids_array =  explode(',',$subcat_range_id_kids_str_sanitized2);
		
		//combo home 
		$subcat_range_id_home_str = $this->categories->get_all_subcat_ids(806);
		$subcat_range_id_home_str_sanitized1 = str_replace("(", '', $subcat_range_id_home_str);
		$subcat_range_id_home_str_sanitized2 = str_replace(")", '', $subcat_range_id_home_str_sanitized1);
		$subcat_range_id_home_array =  explode(',',$subcat_range_id_home_str_sanitized2);
		
		/*
		2	>>> women
		166	>>>	men
		323	>>>	kids-and-baby
		806	>>>	living
		*/
		
		//get ctegory id from th eseesion
		$cat_id = $this->session->userdata("cat_id");
		//if it fails from getting category_id from session, then find the category of the actual product
		if(empty($cat_id))
		{
			$cat_id = $this->product_mdl->get_category_id_of_a_product($id);
		}
		// check if the actual category is women category or one if its decendents 
		if( in_array($cat_id,$subcat_range_id_women_array) )
		{
			$data['combo'] = $this->product_mdl->get_combo("combo_women",$lang_id);
		}
		if( in_array($cat_id,$subcat_range_id_men_array) )
		{
			$data['combo'] = $this->product_mdl->get_combo("combo_men",$lang_id);
		}
		if( in_array($cat_id,$subcat_range_id_kids_array) )
		{
			$data['combo'] = $this->product_mdl->get_combo("combo_kids",$lang_id);
		}
		if( in_array($cat_id,$subcat_range_id_home_array) )
		{
			$data['combo'] = $this->product_mdl->get_combo("combo_home",$lang_id);
		}
		
		//end getting combos 
		
		$data['related_products'] = $this->product_mdl->get_related_products($id,$lang_id);
		
		$data['product_details'] = $this->product_mdl->get_product_details($id,$lang_id);
				
		//load REST data from the API to check availability 
		$idd = $data['product_details'][0]->idd;
		$product_stream = file_get_contents("http://api.shopstyle.com/api/v2/products/".$idd."?pid=sugar");
		$jproduct = json_decode($product_stream);
		
		$Stock_status = $jproduct->inStock;
		
		//update database stock 
		$update_stock_while_visiting_item = $this->product_mdl->update_stock_while_visiting_item($id,$Stock_status);
		
		
		$data['product_inStock'] = $Stock_status;
		
		$data['template_info']   = $this->home_mdl->get_template_info();// get the template for the active shop 
		
		
		$data['product_alt_img'] = $this->product_mdl->get_product_alt_images($id);
		$data['product_img'] 	  = $this->product_mdl->get_product_images($id);
		
		// try to crype source 
		/*$img_url = $data['product_img'][0]->image;
		$oo = $this->getDataURI($img_url, $mime = '');
		$data['product_img'][0]->image = $oo;*/
		
		$data['product_brand'] 	  = $this->product_mdl->get_product_brand($id);
		
		$data['product_reviews'] = $this->product_mdl->get_product_reviews($id);
		$data['product_sizes'] = $this->product_mdl->get_product_sizes($id);
		$data['product_colors']  = $this->product_mdl->get_product_colors_images_original_size($id);
		
		// prepare the metadata information for the view page
		if ($data['product_details'][0]->meta_description) $data['meta_description'] =   $data['product_details'][0]->meta_description; else $data['meta_description'] = "";
		if ($data['product_details'][0]->meta_keywords) 	$data['meta_keywords']    =   $data['product_details'][0]->meta_keywords; else $data['meta_keywords'] = "";
		if ($data['product_details'][0]->name)				$data['page_title'] 	   =   $data['product_details'][0]->name ; else $data['name'] = "";
		
		//$tmp = $data['product_details'][0]->name ;
		 
        $data['meta_info'] = $this->product_mdl->get_meta_info($id,$lang_id);
        
        $this->load->view($data['template_info']['path'].'/common/css',$data);  
        $this->load->view($data['template_info']['path'].'/common/header');  
        //$this->load->view($data['template_info']['path'].'/common/slider'); 
         
        $this->load->view($data['template_info']['path'].'/single_vew',$data);  // send the result from the model to the view */
        
        
        $this->load->view($data['template_info']['path'].'/common/footer');  
        $this->load->view($data['template_info']['path'].'/common/script_single'); 
        
		
		/*$this->load->model('product_mdl'); // load the model that will get the alternative pictures
		$data['product_alt_img'] = $this->product_mdl->get_product_alt_images($id); // call the method get_product_alt_images inside the class test_mdl
        $page_path =  'templates\\'.$this->template.'\product_details_vew' ;
        $this->load->view($page_path,$data);  // send the result from the model to the view */
	}
	
	// this function is just to recieve a get http request and call another method since you can't use route.php for question mark "?" unless...
	public function presearch()
	{
		$oo = 55 ;
		// get the variable from url and remove %....etc
		$q_url =urldecode($this->input->get("q"));
		
		// if the function is called with an empty search string then use the last session query string
		if(empty($q_url))
		{
		 	$this->search();
		}
		else
		{
			$cat_url = urldecode($this->input->get("cat"));
			if(empty($cat_url)) $cat_url=0;
			
			$min_price_url =urldecode($this->input->get("min_price"));
			if(empty($min_price_url)) $min_price_url=0;
			
			$max_price_url =urldecode($this->input->get("max_price"));
			if(empty($max_price_url)) $max_price_url=0;
				
			$this->cart->product_name_rules = '[:print:]';
			$this->session->set_userdata("search_term",(string)$q_url ); // put the term in session  
			
			$fooou = $this->session->userdata("search_term");  	
			
			$this->session->set_userdata("category_id", $cat_url );  // put the category id in the session 
			
			$this->session->set_userdata("min_price", $min_price_url ); // put the price filter  	
			$this->session->set_userdata("max_price", $max_price_url ); // put the price filter   
			$this->search();
		}
	}
	
	public function search(){
		$term = $this->session->userdata("search_term");
		if(!empty($term))
		{
			
			$min_price = $this->session->userdata("min_price");
			$max_price = $this->session->userdata("max_price");
			
			//prepare the pagination links 
			$this->load->library('pagination');
			$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$per_page = 20;
			$config['base_url'] = base_url().'/product/search/';
			$product_count = $this->product_mdl->get_product_count_per_price($term,$min_price,$max_price);
			$config['per_page'] = $per_page;
			$config['total_rows'] = $product_count;
			$this->pagination->initialize($config);
			$data['pagination'] =  $this->pagination->create_links();
			
			$product_match = $this->product_mdl->get_product_price_filter($term,$min_price,$max_price,$per_page,$offset);
			
			// get the language id 
			$lang_id = $this->lng->get_n_set_language_id();
			
			$data['template_info']   = $this->home_mdl->get_template_info();// get the template for the active shop 
			
			$search_result = $B = array();
			foreach ($product_match as $row)
			{
				$B['id'] 	  = $row->product_id;
				$B['product_img'] 	  = $this->product_mdl->get_product_images($row->product_id);
				
				$B['product_details'] = $this->product_mdl->get_product_details($row->product_id,$lang_id);
				$B['product_reviews'] = $this->product_mdl->get_product_reviews($row->product_id);
				$B['product_colors']  = $this->product_mdl->get_product_colors_images_original_size($row->product_id);
				
				$search_result[] =$B;
			}
			
			// the price range for the slider on the search view 
			$data['prince_range'] = "[$min_price,$max_price]";
			
			//show search result with pagination 
			$data['data'] = $search_result ; 
			$this->load->view($data['template_info']['path'].'/search_result_vew',$data);  
			
		}
		else
		{
			//session expired redirect to home page
			redirect(base_url().'home/');
		}
		
	}
	
	public function GetUserAgent()
	{
		$this->load->library('user_agent');
		$data['agent'] = $agent ;
		$useragent=$_SERVER['HTTP_USER_AGENT'];
	}
	
	public function language ($lang)
	{
		$this->load->library('user_agent');	
	}
	
	// for autocomplete
	public function autosearch()
	{
    	//$oo = 55 ; 
    	if (isset($_GET['term']))
	    {
	      	
	      	$auto_complete_suggestions = ""; // init variable
	      	
	      	$q = strtolower($_GET['term']);
	      	
	      	// query and cache ...etc if the term is 2 characters or more
	      	if( strlen($q) > 1 )
	      	{
		      	// let's cache this search result
		      	if(CACHE_IS_ON)
				{
					//// cache this result : $auto_complete_suggestions
					$rcache = $this->cachy->new_redis_instance();
					$cache_id ="product:autosearch:".$q;
					$cache_content = json_decode($rcache->get($cache_id)) ;
					
					//if already in cache 
					if (!empty($cache_content))
					{
						if (VERBOSE_DEBUG) echo "getting data from cache ... (from product->autosearch)";
						$auto_complete_suggestions = $cache_content;
					}
					//else cache it and return result
					else 
					{
						
						//query database and get the json result
						$auto_complete_suggestions = $this->product_mdl->search_product($q);
						
						//save to cache 
						if (VERBOSE_DEBUG) echo "saving to cache ... (from products->get_category_decendents_product)";
						$rcache->set($cache_id, json_encode($auto_complete_suggestions))or die ("Failed to save data to cash server");
						
					}
				}
				// if cache is disabled
				else
				{
					//query database and get the json result
					$auto_complete_suggestions = $this->product_mdl->search_product($q);
				}
				
				echo $auto_complete_suggestions;
			}
    	}	
	}

	//get all products under a certain category 
	public function get_cat_products($cat_id)
	{
		$cat_products = $this->product_mdl->get_cat_products($cat_id);
		return $cat_products; 
		
		/*echo "<pre>";
		print_r($cat_products) ;
		echo "<pre>";*/
		
	}
	
	/**
	 * called by listing : sets the value of the filtre from the post else from a cookie else from the default value
	 * 
	 * @param mixed $var_name
	 * @param string $cookie_name
	 * @param mixed $default_value
	 * 
	 * @return mixed the value of the filter
	 */
	
	
	private function set_filter($var_name,$cookie_name,$default_value)
	{
		
		$this->load->helper('cookie');
		
		//~~$var_name
		// get value from GET, notice that the cookie_name is the same as field name in the form
		$get_val    = $this->input->get($cookie_name);
		
		$cookie_val = $this->input->cookie($cookie_name);
		
		//since cookies can't be really null, can they ?  so we will convert from string to a real NULL lets call a cat a cat ...
		if($get_val == "NULL")
		{
			$get_val = 0;
		}
		
		if($cookie_val == "NULL")
		{
			$cookie_val = 0;
		}
		
		if (($cookie_name) == "min_price" 	and $get_val === "0" )   $get_val = "any"; 
		if (($cookie_name) == "max_price" 	and $get_val === "0" )   $get_val = "any"; 
		if (($cookie_name) == "brand_id"  	and $get_val === "0" )   $get_val = "any"; 
		if (($cookie_name) == "color_id"  	and $get_val === "0" )   $get_val = "any"; 
		if (($cookie_name) == "on_sale"  	and $get_val === "0" )   $get_val = "any"; 
		if (($cookie_name) == "price_order" and $get_val === "0" )   $get_val = "any"; 
		
		if (($cookie_name) == "brand_name_id"  	and $get_val === "0" )   $get_val = "any";
		if (($cookie_name) == "color_name"  	and $get_val === "0" )   $get_val = "any"; 
		if (($cookie_name) == "size_id" and $get_val === "0" )   $get_val = "any";
		if (($cookie_name) == "size_name" and $get_val === "0" )   $get_val = "any";
		
		if (($cookie_name) == "brand_id_fltr" and $get_val === "0" )   $get_val = "any";
		
		if(!empty($get_val)) 
		{
			// if it is brand_id is not set 
			if ($get_val == "any") $var_name = $default_value;
			else
			$var_name = $get_val;
			$this->input->set_cookie($cookie_name, $var_name, 3600*2); // set the cookie for 2 hours
			
		}
		//if GET is empty get it from cookies 
		elseif (!empty($cookie_val) )
		{
			$var_name = $cookie_val ;
		}
		// if no cookie set it to the defaul tvalue 
		else $var_name  =  $default_value;
		
		return $var_name;
		
	}
	
	
	// show products of a category with pagination ------------------------------------ 
	public function listing($arg=NULL)
	{
		// no search query here
		$q_str = '%';
		
		//$this->load->helper('cookie');
		
		// initialize $min_price,$max_price,$brand_id,$size_id , $color_id , $on_sale, $price_order
		$size_name=$color_name=$brand_name_id=$min_price = $max_price = $brand_id = $size_id = $color_id = $on_sale = $price_order = 0;
		
		$min_price 		= $this->set_filter($min_price,"min_price",0);
		$max_price 		= $this->set_filter($max_price,"max_price",100000000);
		$brand_id 		= $this->set_filter($brand_id,"brand_id",NULL);
		$size_id 		= $this->set_filter($size_id,"size_id",NULL);
		$color_id 		= $this->set_filter($color_id,"color_id",NULL);
		$on_sale 		= $this->set_filter($on_sale,"on_sale",NULL);
		$price_order 	= $this->set_filter($price_order,"price_order","ASC");
		
		// new cookies
		$brand_name_id 		= $this->set_filter($brand_name_id,"brand_name_id",NULL);
		$color_name 		= $this->set_filter($color_name,"color_name",NULL);
		$size_name 		= $this->set_filter($size_name,"size_name",NULL);
		//
		
		//$segment3 = $this->uri->segment(3);
		// check if it is a pagination number or the first call 
		
		// look for "id" in the argument   
		preg_match('/(id)[0-9]+/im', $arg, $regex_results);
		if(!empty($regex_results[1]))
		{
			$flag_id = $regex_results[1];
		}
		else
		{
			$flag_id = "not_set";
		}
		
		
		//get the first 2 characters to check if it starts with "id" 
		//$flag_id = substr($arg,0,2);
		//echo "$flag_id = $flag_id  ";
		
		//~~ FIRST PAGE 
		if ($flag_id == "id" || $flag_id == NULL )
		{ 
			//echo "1st time call";
			// set offset to zero for the first page
			$offset = 0;
			if(!$flag_id) $cat_id = $this->session->userdata("cat_id");
			else 
			{
				preg_match('/id([0-9]+)/im', $arg, $regex_results);
				$cat_id = $regex_results[1];
				//$cat_id =  substr($arg,2);
				//echo "catid = ".$cat_id."  ";	
			}
			if($cat_id!=$this->session->userdata("cat_id") )
			{
				//clear filter cookies 
				$this->input->set_cookie("min_price"  , 0			, 3600*2); // set the cookie for 2 hours
				$this->input->set_cookie("max_price"  , 100000000	, 3600*2); // set the cookie for 2 hours
				$this->input->set_cookie("brand_id"   , NULL		, 3600*2); // set the cookie for 2 hours
				$this->input->set_cookie("size_id"    , NULL		, 3600*2); // set the cookie for 2 hours
				$this->input->set_cookie("color_id"   , NULL		, 3600*2); // set the cookie for 2 hours
				$this->input->set_cookie("on_sale"    , NULL		, 3600*2); // set the cookie for 2 hours
				$this->input->set_cookie("price_order", NULL		, 3600*2); // set the cookie for 2 hours
			} 
			//substr($arg,2);
			
			//save category id in the session
			$this->session->set_userdata("cat_id",$cat_id);
			
			//get available colors brands and sizes for that category
			$data["available_cat_colors"] =  $this->get_avlbl_colors_in_cat($cat_id,$q_str);
			$data["available_cat_brands"] =  $this->get_avlbl_brands_in_cat($cat_id,$q_str);
			$data["available_cat_sizes"] =   $this->get_avlbl_sizes_in_cat($cat_id,$q_str);
			
			// calculate the number of items in the category
			//new way
			//$num_of_items = $this->filter->get_product_list_count('%',$min_price,$max_price,0,0,0,$cat_id,$brand_id,$size_id,$color_id,$on_sale);
			// $num_of_items = $this->get_number_of_products_in_category($cat_id,$min_price,$max_price,$brand_id,$size_id,$color_id,$on_sale);
			
			//hybrid way 
			$brand_id_range = $brand_id; // to be parsed into csv if more than 1 brand was selected
			$size_id_range = $size_id; // to be parsed into csv if more than 1 size was selected
			$color_id_range = $color_id; // same as previous comment
			
			$num_of_items = $this->filter->get_num_filtred_products("any",$cat_id,$min_price,$max_price,$brand_id_range,
																		$size_id_range,$color_id_range,$on_sale);
			
			//save the num_of_items for the category in the session in the session 
			$this->session->set_userdata("num_of_item",$num_of_items);
			
			//prepare the pagination links 
			$this->load->library('pagination');
			
			$per_page =$this->input->post("per_page"); // get the number of items per page from user
			if(empty($per_page)) $per_page = $this->session->userdata("per_page"); // if no form get from session
			if(empty($per_page)) $per_page = 90; // if no session get 90 
			
			$this->session->set_userdata("per_page",$per_page);
			
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
			
			$config['base_url'] = base_url().'/product/listing/';
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			$config['first_url'] = $config['base_url'].'0?'.http_build_query($_GET);
			$config['per_page'] = $per_page;
			$config['total_rows'] = $num_of_items;
			$this->pagination->initialize($config);
			$data['pagination'] =  $this->pagination->create_links();
			
			//prepare the products 
			//$this->filter->get_product_list('%',$min_price,$max_price,$price_order,$offset,$per_page,$cat_id,$brand_id);
			//new way
			//$data['products'] = $this->filter->get_product_list('%',$min_price,$max_price,$price_order,$offset,$per_page,$cat_id,$brand_id,$size_id,$color_id,$on_sale);
			//$data['products'] = $this->get_category_decendents_product($cat_id,$offset,$per_page,$min_price,$max_price,$brand_id,$size_id,$color_id,$price_order,$on_sale);
			
		
			
			//hybrid way 
			$data['products'] =$this->filter->get_filtred_product_list("any",$cat_id,$offset,$per_page,
														$min_price,$max_price,$brand_id_range,
														$size_id_range,$color_id_range,$price_order,$on_sale);
		}
		//~~ N PAGE 
		else
		{
			//echo "pagination now" ; 
			
			// get the numbers of items from the session 
			$num_of_items = $this->session->userdata("num_of_item");
			if (!$num_of_items) echo("session expired");
			
			// get the offset from the uri 
			$offset =   $arg;
			
			//prepare the pagination links 
			$this->load->library('pagination');
			$per_page = $this->session->userdata("per_page");
			if(empty($per_page)) $per_page = 90;
			
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
			
			$config['base_url'] = base_url().'/product/listing/';
			
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			$config['first_url'] = $config['base_url'].'0?'.http_build_query($_GET);
			
			$config['per_page'] = $per_page;
			$config['total_rows'] = $num_of_items;
			$this->pagination->initialize($config);
			$data['pagination'] =  $this->pagination->create_links();
			
			//prepare the products 
			$cat_id = $this->session->userdata("cat_id");
			
			//get available colors brands and sizes for that category
			$data["available_cat_colors"] =  $this->get_avlbl_colors_in_cat($cat_id,$q_str);
			$data["available_cat_brands"] =  $this->get_avlbl_brands_in_cat($cat_id,$q_str);
			$data["available_cat_sizes"] =   $this->get_avlbl_sizes_in_cat($cat_id,$q_str);
			
			//new
			//$data['products'] = $this->filter->get_product_list('%',$min_price,$max_price,$price_order,$offset,$per_page,$cat_id,$brand_id,$size_id,$color_id,$on_sale);
			//$data['products'] = $this->get_category_decendents_product($cat_id,$offset,$per_page,$min_price,$max_price,$brand_id,$size_id,$color_id,$price_order,$on_sale);
			
			//hybrid way 
			$brand_id_range = $brand_id; // to be parsed into csv if more than 1 brand was selected
			$size_id_range = $size_id; // to be parsed into csv if more than 1 size was selected
			$color_id_range = $color_id; // same as previous comment
			
			$data['products'] = $this->filter->get_filtred_product_list("any",$cat_id,$offset,$per_page,
														$min_price,$max_price,$brand_id_range,
														$size_id_range,$color_id_range,$price_order,$on_sale);
			
		}
		
		//$product_count = $this->product_mdl->get_product_count_per_price($term,$min_price,$max_price);
		
		$lang_id = $this->lng->get_n_set_language_id();
		
		$this->input->set_cookie("language_id", $lang_id, 86400*30*12*10); // set the cookie for 10 years
		//redirect(base_url().'home/error/lng');
		
		// goto view
		$this->load->module("categories");
		$cat_id = $this->session->userdata("cat_id");
		$data['meta_info'] = $this->categories->get_cat_meta_info($cat_id,$lang_id);
        
        $data['template_info']   = $this->home_mdl->get_template_info();
        $this->load->view($data['template_info']['path'].'/common/css',$data);  
        $this->load->view($data['template_info']['path'].'/common/header');  
         
        $this->load->view($data['template_info']['path'].'/product_vew', $data);
        
        $this->load->view($data['template_info']['path'].'/common/footer');  
        $this->load->view($data['template_info']['path'].'/common/script'); 
		
	}
	
	// show products of a search with pagination ------------------------------------ 
	public function srch($arg=NULL)
	{
		$lang_id = $this->lng->get_n_set_language_id();
		
		// get the variable from url and remove %....etc
		$q_str =urldecode($this->input->get("q"));
			
		// initialize $min_price,$max_price,$brand_id,$size_id , $color_id , $on_sale, $price_order
		$size_name=$color_name=$brand_name_id=$min_price = $max_price = $brand_id = $size_id = $color_id = $on_sale = $price_order = $brand_id_fltr = 0;
		
		$min_price 		= $this->set_filter($min_price,"min_price",0);
		$max_price 		= $this->set_filter($max_price,"max_price",100000000);
		$brand_id 		= $this->set_filter($brand_id,"brand_id",NULL);
		$size_id 		= $this->set_filter($size_id,"size_id",NULL);
		$color_id 		= $this->set_filter($color_id,"color_id",NULL);
		$on_sale 		= $this->set_filter($on_sale,"on_sale",NULL);
		$price_order 	= $this->set_filter($price_order,"price_order","ASC");
		
		// new cookies
		$brand_name_id 		= $this->set_filter($brand_name_id,"brand_name_id",NULL);
		$color_name 		= $this->set_filter($color_name,"color_name",NULL);
		$size_name 		= $this->set_filter($size_name,"size_name",NULL);
		
		//available brands  ( default = 1 means all brands )
		$brand_id_fltr	= $this->set_filter($brand_id_fltr,"brand_id_fltr",1);
		
		// check if it is a pagination number or the first call 
		
		
		//get the first 2 characters to check if it starts with "id" 
		//$flag_id = substr($arg,0,2);
		//echo "$flag_id = $flag_id  ";
		
		//~~ FIRST PAGE 
		if ($arg == 0 or $arg =NULL )
		{ 
			//echo "arg----------->".$arg ;
			//$this->session->set_userdata("q_str",$q_str);
			
			//get category_id from session
			//$cat_id = $this->session->userdata("cat_id");
			// if not set then set it to the root category id = 1 
			if(!isset($cat_id) ) $cat_id = 1;
			
			//echo "1st time call";
			// set offset to zero for the first page
			$offset = 0;

			//clear filter cookies 
			$this->input->set_cookie("min_price"  , 0			, 3600*2); // set the cookie for 2 hours
			$this->input->set_cookie("max_price"  , 100000000	, 3600*2); // set the cookie for 2 hours
			$this->input->set_cookie("brand_id"   , NULL		, 3600*2); // set the cookie for 2 hours
			$this->input->set_cookie("size_id"    , NULL		, 3600*2); // set the cookie for 2 hours
			$this->input->set_cookie("color_id"   , NULL		, 3600*2); // set the cookie for 2 hours
			$this->input->set_cookie("on_sale"    , NULL		, 3600*2); // set the cookie for 2 hours
			$this->input->set_cookie("price_order", NULL		, 3600*2); // set the cookie for 2 hours
	
			
			//save category id in the session
			$this->session->set_userdata("cat_id",$cat_id);
			
			//get available colors brands and sizes for that category
			$data["available_cat_colors"] =  $this->get_avlbl_colors_in_cat($cat_id,$q_str);
			$data["available_cat_brands"] =  $this->get_avlbl_brands_in_cat($cat_id,$q_str);
			$data["available_cat_sizes"] =   $this->get_avlbl_sizes_in_cat($cat_id,$q_str);
			$data["available_categories"] =   $this->get_avlbl_categories_for_srch($q_str,$lang_id);
			
			// calculate the number of items in the category
			//hybrid way 
			$brand_id_range = $brand_id; // to be parsed into csv if more than 1 brand was selected
			$size_id_range = $size_id; // to be parsed into csv if more than 1 size was selected
			$color_id_range = $color_id; // same as previous comment
			
			$num_of_items = $this->filter->get_num_filtred_products($q_str,$cat_id,$min_price,$max_price,$brand_id_range,
																		$size_id_range,$color_id_range,$on_sale);
			
			//save the num_of_items for the category in the session in the session 
			$this->session->set_userdata("num_of_item",$num_of_items);
			
			//prepare the pagination links 
			$this->load->library('pagination');
			
			$per_page =$this->input->post("per_page"); // get the number of items per page from user
			if(empty($per_page)) $per_page = $this->session->userdata("per_page"); // if no form get from session
			if(empty($per_page)) $per_page = 90; // if no session get 90 
			
			$this->session->set_userdata("per_page",$per_page);
			
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
			
			$config['base_url'] = base_url().'/product/srch/';
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			$config['first_url'] = $config['base_url'].'0?'.http_build_query($_GET);
			$config['per_page'] = $per_page;
			$config['total_rows'] = $num_of_items;
			$this->pagination->initialize($config);
			$data['pagination'] =  $this->pagination->create_links();
			
			//prepare the products 
			//$this->filter->get_product_list('%',$min_price,$max_price,$price_order,$offset,$per_page,$cat_id,$brand_id);
			//new way
			//$data['products'] = $this->filter->get_product_list('%',$min_price,$max_price,$price_order,$offset,$per_page,$cat_id,$brand_id,$size_id,$color_id,$on_sale);
			//$data['products'] = $this->get_category_decendents_product($cat_id,$offset,$per_page,$min_price,$max_price,$brand_id,$size_id,$color_id,$price_order,$on_sale);
			
			
			//hybrid way 
			$data['products'] =$this->filter->get_filtred_product_list($q_str,$cat_id,$offset,$per_page,
														$min_price,$max_price,$brand_id_range,
														$size_id_range,$color_id_range,$price_order,$on_sale);
		}
		//~~ N PAGE 
		else
		{
			
			// get the offset from the uri 
			$uri_str = uri_string();
			$uri_arr = explode('/',$uri_str);
			$offset =   $uri_arr[2];
			
			/*echo "uri_string-------->".uri_string()."<br>" ;
			echo "offset-------->".$uri_arr[2]."<br>" ;
			echo "pagination now" ; */
			
			//$q_str = $this->session->userdata("q_str");
			
			// get the numbers of items from the session 
			$num_of_items = $this->session->userdata("num_of_item");
			if (!$num_of_items) echo("session expired");
			
			
			//prepare the pagination links 
			$this->load->library('pagination');
			$per_page = $this->session->userdata("per_page");
			if(empty($per_page)) $per_page = 90;
			
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
			
			$config['base_url'] = base_url().'/product/srch/';
			
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			$config['first_url'] = $config['base_url'].'0?'.http_build_query($_GET);
			
			$config['per_page'] = $per_page;
			$config['total_rows'] = $num_of_items;
			$this->pagination->initialize($config);
			$data['pagination'] =  $this->pagination->create_links();
			
			//prepare the products 
			$cat_id = $this->session->userdata("cat_id");
			
			//get available colors brands and sizes for that category
			$data["available_cat_colors"] =  $this->get_avlbl_colors_in_cat($cat_id,$q_str);
			$data["available_cat_brands"] =  $this->get_avlbl_brands_in_cat($cat_id,$q_str);
			$data["available_cat_sizes"]  =  $this->get_avlbl_sizes_in_cat($cat_id,$q_str);
			$data["available_categories"] =  $this->get_avlbl_categories_for_srch($q_str,$lang_id);
			
			//new
			//$data['products'] = $this->filter->get_product_list('%',$min_price,$max_price,$price_order,$offset,$per_page,$cat_id,$brand_id,$size_id,$color_id,$on_sale);
			//$data['products'] = $this->get_category_decendents_product($cat_id,$offset,$per_page,$min_price,$max_price,$brand_id,$size_id,$color_id,$price_order,$on_sale);
			
			//hybrid way 
			$brand_id_range = $brand_id; // to be parsed into csv if more than 1 brand was selected
			$size_id_range = $size_id; // to be parsed into csv if more than 1 size was selected
			$color_id_range = $color_id; // same as previous comment
			
			$data['products'] = $this->filter->get_filtred_product_list($q_str,$cat_id,$offset,$per_page,
														$min_price,$max_price,$brand_id_range,
														$size_id_range,$color_id_range,$price_order,$on_sale);
			
		}
		
		//$product_count = $this->product_mdl->get_product_count_per_price($term,$min_price,$max_price);
		
		$lang_id = $this->lng->get_n_set_language_id();
		
		$this->input->set_cookie("language_id", $lang_id, 86400*30*12*10); // set the cookie for 10 years
		//redirect(base_url().'home/error/lng');
		
		// goto view
		$this->load->module("categories");
		$cat_id = $this->session->userdata("cat_id");
		$data['meta_info'] = $this->categories->get_cat_meta_info($cat_id,$lang_id);
        
        $data['template_info']   = $this->home_mdl->get_template_info();
        
        $data['is_search_result']   = 1; // flag for the view to detect that it's coming from srch() method
        
        
        $this->load->view($data['template_info']['path'].'/common/css',$data);  
        $this->load->view($data['template_info']['path'].'/common/header');  
         
        $this->load->view($data['template_info']['path'].'/product_vew', $data);
        
        $this->load->view($data['template_info']['path'].'/common/footer');  
        $this->load->view($data['template_info']['path'].'/common/script'); 
		
	}
	
	//////////////////////////////////////
	public function search_by_brand($brand_id,$cat_id,$x_arg=NULL)
	{
		
		$cat_ids = $brand_ids = array();
		
		$cat_id = 1;
		$brand_id = "any";
		
		
		$arg_list = func_get_args();
		
		//parse categories and brands from the function arguments b1/b2/b3/c10/c20/c30 <=> brands_ids = array(1,2,3) and cat_ids = array(10,20,30)
		foreach($arg_list as $argmt)
		{
			$first_character = substr ($argmt,0,1);
			if($first_character == "c" ) $cat_ids[] = substr ($argmt,1);
			if($first_character == "b" ) $brand_ids[] = substr ($argmt,1);
		}
		
		// if the cat_ids array is not empty get the 1st element (for now we proccess only 1 category)
		if(!empty($cat_ids))
		{
			$cat_id = $cat_ids[0];
		}
		
		// if the cat_ids array is not empty get the 1stelement (for now we proccess only 1 category)
		if(!empty($brand_ids))
		{
			$brand_id = $brand_ids[0];
		}
		
		
		$lang_id = $this->lng->get_n_set_language_id();
		
		$q_str ='%';
			
		// initialize $min_price,$max_price,$size_id , $color_id , $on_sale, $price_order
		$size_name=$color_name=$brand_name_id=$min_price = $max_price = $size_id = $color_id = $on_sale = $price_order = $brand_id_fltr = 0;
		
		$min_price 		= $this->set_filter($min_price,"min_price",0);
		$max_price 		= $this->set_filter($max_price,"max_price",100000000);
		//$brand_id 		= $this->set_filter($brand_id,"brand_id",NULL);
		$size_id 		= $this->set_filter($size_id,"size_id",NULL);
		$color_id 		= $this->set_filter($color_id,"color_id",NULL);
		$on_sale 		= $this->set_filter($on_sale,"on_sale",NULL);
		$price_order 	= $this->set_filter($price_order,"price_order","ASC");
		
		// new cookies
		$brand_name_id 		= $this->set_filter($brand_name_id,"brand_name_id",NULL);
		$color_name 		= $this->set_filter($color_name,"color_name",NULL);
		$size_name 		= $this->set_filter($size_name,"size_name",NULL);
		
		
		//~~ FIRST PAGE 
		if ($x_arg == 0 or $x_arg =NULL )
		{ 

			// if not set then set it to the root category id = 1 
			if(!isset($cat_id) ) $cat_id = 1;
			
			//echo "1st time call";
			// set offset to zero for the first page
			$offset = 0;

			//clear filter cookies 
			$this->input->set_cookie("min_price"  , 0			, 3600*2); // set the cookie for 2 hours
			$this->input->set_cookie("max_price"  , 100000000	, 3600*2); // set the cookie for 2 hours
			$this->input->set_cookie("brand_id"   , NULL		, 3600*2); // set the cookie for 2 hours
			$this->input->set_cookie("size_id"    , NULL		, 3600*2); // set the cookie for 2 hours
			$this->input->set_cookie("color_id"   , NULL		, 3600*2); // set the cookie for 2 hours
			$this->input->set_cookie("on_sale"    , NULL		, 3600*2); // set the cookie for 2 hours
			$this->input->set_cookie("price_order", NULL		, 3600*2); // set the cookie for 2 hours
	
			
			//save category id in the session
			$this->session->set_userdata("cat_id",$cat_id);
			
			//get available colors brands and sizes for that category
			$data["available_cat_colors"] =  $this->get_avlbl_colors_in_cat($cat_id,$q_str);
			$data["available_cat_brands"] =  $this->get_avlbl_brands_in_cat($cat_id,$q_str);
			$data["available_cat_sizes"] =   $this->get_avlbl_sizes_in_cat($cat_id,$q_str);
			$data["available_categories"] =   $this->get_avlbl_categories_for_srch($q_str,$lang_id);
			
			// calculate the number of items in the category
			//hybrid way 
			$brand_id_range = $brand_id; // to be parsed into csv if more than 1 brand was selected
			$size_id_range = $size_id; // to be parsed into csv if more than 1 size was selected
			$color_id_range = $color_id; // same as previous comment
			
			$num_of_items = $this->filter->get_num_filtred_products($q_str,$cat_id,$min_price,$max_price,$brand_id_range,
																		$size_id_range,$color_id_range,$on_sale);
			
			//save the num_of_items for the category in the session in the session 
			$this->session->set_userdata("num_of_item",$num_of_items);
			
			//prepare the pagination links 
			$this->load->library('pagination');
			
			$per_page =$this->input->post("per_page"); // get the number of items per page from user
			if(empty($per_page)) $per_page = $this->session->userdata("per_page"); // if no form get from session
			if(empty($per_page)) $per_page = 90; // if no session get 90 
			
			$this->session->set_userdata("per_page",$per_page);
			
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
			
			$config['base_url'] = base_url().'/product/srch/';
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			$config['first_url'] = $config['base_url'].'0?'.http_build_query($_GET);
			$config['per_page'] = $per_page;
			$config['total_rows'] = $num_of_items;
			$this->pagination->initialize($config);
			$data['pagination'] =  $this->pagination->create_links();
			
			//prepare the products 
			//$this->filter->get_product_list('%',$min_price,$max_price,$price_order,$offset,$per_page,$cat_id,$brand_id);
			//new way
			//$data['products'] = $this->filter->get_product_list('%',$min_price,$max_price,$price_order,$offset,$per_page,$cat_id,$brand_id,$size_id,$color_id,$on_sale);
			//$data['products'] = $this->get_category_decendents_product($cat_id,$offset,$per_page,$min_price,$max_price,$brand_id,$size_id,$color_id,$price_order,$on_sale);
			
			
			//hybrid way 
			$data['products'] =$this->filter->get_filtred_product_list($q_str,$cat_id,$offset,$per_page,
														$min_price,$max_price,$brand_id_range,
														$size_id_range,$color_id_range,$price_order,$on_sale);
		}
		//~~ N PAGE 
		else
		{
			
			// get the offset from the uri 
			$uri_str = uri_string();
			$uri_arr = explode('/',$uri_str);
			$offset =   $uri_arr[2];
			
			echo "uri_string-------->".uri_string()."<br>" ;
			echo "offset-------->".$uri_arr[2]."<br>" ;
			echo "pagination now" ; 
			
			//$q_str = $this->session->userdata("q_str");
			
			// get the numbers of items from the session 
			$num_of_items = $this->session->userdata("num_of_item");
			if (!$num_of_items) echo("session expired");
			
			
			//prepare the pagination links 
			$this->load->library('pagination');
			$per_page = $this->session->userdata("per_page");
			if(empty($per_page)) $per_page = 90;
			
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
			
			$config['base_url'] = base_url().'/product/srch/';
			
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			$config['first_url'] = $config['base_url'].'0?'.http_build_query($_GET);
			
			$config['per_page'] = $per_page;
			$config['total_rows'] = $num_of_items;
			$this->pagination->initialize($config);
			$data['pagination'] =  $this->pagination->create_links();
			
			//prepare the products 
			$cat_id = $this->session->userdata("cat_id");
			
			//get available colors brands and sizes for that category
			$data["available_cat_colors"] =  $this->get_avlbl_colors_in_cat($cat_id,$q_str);
			$data["available_cat_brands"] =  $this->get_avlbl_brands_in_cat($cat_id,$q_str);
			$data["available_cat_sizes"]  =  $this->get_avlbl_sizes_in_cat($cat_id,$q_str);
			$data["available_categories"] =  $this->get_avlbl_categories_for_srch($q_str,$lang_id);
			
			//new
			//$data['products'] = $this->filter->get_product_list('%',$min_price,$max_price,$price_order,$offset,$per_page,$cat_id,$brand_id,$size_id,$color_id,$on_sale);
			//$data['products'] = $this->get_category_decendents_product($cat_id,$offset,$per_page,$min_price,$max_price,$brand_id,$size_id,$color_id,$price_order,$on_sale);
			
			//hybrid way 
			$brand_id_range = $brand_id; // to be parsed into csv if more than 1 brand was selected
			$size_id_range = $size_id; // to be parsed into csv if more than 1 size was selected
			$color_id_range = $color_id; // same as previous comment
			
			$data['products'] = $this->filter->get_filtred_product_list($q_str,$cat_id,$offset,$per_page,
														$min_price,$max_price,$brand_id_range,
														$size_id_range,$color_id_range,$price_order,$on_sale);
			
		}
		
		//$product_count = $this->product_mdl->get_product_count_per_price($term,$min_price,$max_price);
		
		$lang_id = $this->lng->get_n_set_language_id();
		
		$this->input->set_cookie("language_id", $lang_id, 86400*30*12*10); // set the cookie for 10 years
		//redirect(base_url().'home/error/lng');
		
		// goto view
		$this->load->module("categories");
		$cat_id = $this->session->userdata("cat_id");
		$data['meta_info'] = $this->categories->get_cat_meta_info($cat_id,$lang_id);
        
        $data['template_info']   = $this->home_mdl->get_template_info();
        
        $data['is_search_result']   = 1; // flag for the view to detect that it's coming from srch() method
        
        
        $this->load->view($data['template_info']['path'].'/common/css',$data);  
        $this->load->view($data['template_info']['path'].'/common/header');  
         
        $this->load->view($data['template_info']['path'].'/product_vew', $data);
        
        $this->load->view($data['template_info']['path'].'/common/footer');  
        $this->load->view($data['template_info']['path'].'/common/script'); 
			
	
	}
	
	// on sale
	public function onsale($c_cat_id,$arg=NULL)
	{
		$cat_id = 1;
		
		$arg_list = func_get_args();
		
		//parse categories and brands from the function arguments /c31 <=> cat_ids = array(10,20,30)
		foreach($arg_list as $argmt)
		{
			$first_character = substr ($argmt,0,1);
			if($first_character == "c" ) $cat_ids[] = substr ($argmt,1);
			//if($first_character == "b" ) $brand_ids[] = substr ($argmt,1);
		}
		if(isset($cat_ids))$cat_id = $cat_ids[0] ;
		
		// no search query here
		$q_str = '%';
		
		//$this->load->helper('cookie');
		
		// initialize $min_price,$max_price,$brand_id,$size_id , $color_id , $on_sale, $price_order
		$size_name=$color_name=$brand_name_id=$min_price = $max_price = $brand_id = $size_id = $color_id = $price_order = 0;
		$on_sale = 1;
		
		$min_price 		= $this->set_filter($min_price,"min_price",0);
		$max_price 		= $this->set_filter($max_price,"max_price",100000000);
		$brand_id 		= $this->set_filter($brand_id,"brand_id",NULL);
		$size_id 		= $this->set_filter($size_id,"size_id",NULL);
		$color_id 		= $this->set_filter($color_id,"color_id",NULL);
		$on_sale 		= $this->set_filter($on_sale,"on_sale",1);
		$price_order 	= $this->set_filter($price_order,"price_order","ASC");
		//$cat_id = 1;
		// new cookies
		$brand_name_id 		= $this->set_filter($brand_name_id,"brand_name_id",NULL);
		$color_name 		= $this->set_filter($color_name,"color_name",NULL);
		$size_name 		= $this->set_filter($size_name,"size_name",NULL);
		//
		
		//$segment3 = $this->uri->segment(3);
		// check if it is a pagination number or the first call 
		
		// look for "id" in the argument   
		preg_match('/(id)[0-9]+/im', $arg, $regex_results);
		if(!empty($regex_results[1]))
		{
			$flag_id = $regex_results[1];
		}
		else
		{
			$flag_id = "not_set";
		}
		
		
		//get the first 2 characters to check if it starts with "id" 
		//$flag_id = substr($arg,0,2);
		//echo "$flag_id = $flag_id  ";
		
		//~~ FIRST PAGE 
		if ( $arg == NULL )
		{ 
			//echo "1st time call";
			// set offset to zero for the first page
			$offset = 0;
			
			if($cat_id!=$this->session->userdata("cat_id") )
			{
				//clear filter cookies 
				$this->input->set_cookie("min_price"  , 0			, 3600*2); // set the cookie for 2 hours
				$this->input->set_cookie("max_price"  , 100000000	, 3600*2); // set the cookie for 2 hours
				$this->input->set_cookie("brand_id"   , NULL		, 3600*2); // set the cookie for 2 hours
				$this->input->set_cookie("size_id"    , NULL		, 3600*2); // set the cookie for 2 hours
				$this->input->set_cookie("color_id"   , NULL		, 3600*2); // set the cookie for 2 hours
				$this->input->set_cookie("on_sale"    , 1		, 3600*2); // set the cookie for 2 hours
				$this->input->set_cookie("price_order", NULL		, 3600*2); // set the cookie for 2 hours
			} 
			//substr($arg,2);
			
			//save category id in the session
			$this->session->set_userdata("cat_id",$cat_id);
			
			//get available colors brands and sizes for that category
			$data["available_cat_colors"] =  $this->get_avlbl_colors_in_cat($cat_id,$q_str);
			$data["available_cat_brands"] =  $this->get_avlbl_brands_in_cat($cat_id,$q_str);
			$data["available_cat_sizes"] =   $this->get_avlbl_sizes_in_cat($cat_id,$q_str);
			
			// calculate the number of items in the category
			//new way
			//$num_of_items = $this->filter->get_product_list_count('%',$min_price,$max_price,0,0,0,$cat_id,$brand_id,$size_id,$color_id,$on_sale);
			// $num_of_items = $this->get_number_of_products_in_category($cat_id,$min_price,$max_price,$brand_id,$size_id,$color_id,$on_sale);
			
			//hybrid way 
			$brand_id_range = $brand_id; // to be parsed into csv if more than 1 brand was selected
			$size_id_range = $size_id; // to be parsed into csv if more than 1 size was selected
			$color_id_range = $color_id; // same as previous comment
			
			$num_of_items = $this->filter->get_num_filtred_products("any",$cat_id,$min_price,$max_price,$brand_id_range,
																		$size_id_range,$color_id_range,$on_sale);
			
			//save the num_of_items for the category in the session in the session 
			$this->session->set_userdata("num_of_item",$num_of_items);
			
			//prepare the pagination links 
			$this->load->library('pagination');
			
			$per_page =$this->input->post("per_page"); // get the number of items per page from user
			if(empty($per_page)) $per_page = $this->session->userdata("per_page"); // if no form get from session
			if(empty($per_page)) $per_page = 90; // if no session get 90 
			
			$this->session->set_userdata("per_page",$per_page);
			
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
			
			$config['base_url'] = base_url().'/product/onsale/';
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			$config['first_url'] = $config['base_url'].'0?'.http_build_query($_GET);
			$config['per_page'] = $per_page;
			$config['total_rows'] = $num_of_items;
			$this->pagination->initialize($config);
			$data['pagination'] =  $this->pagination->create_links();
			
			//prepare the products 
			//$this->filter->get_product_list('%',$min_price,$max_price,$price_order,$offset,$per_page,$cat_id,$brand_id);
			//new way
			//$data['products'] = $this->filter->get_product_list('%',$min_price,$max_price,$price_order,$offset,$per_page,$cat_id,$brand_id,$size_id,$color_id,$on_sale);
			//$data['products'] = $this->get_category_decendents_product($cat_id,$offset,$per_page,$min_price,$max_price,$brand_id,$size_id,$color_id,$price_order,$on_sale);
			
		
			
			//hybrid way 
			$data['products'] =$this->filter->get_filtred_product_list("any",$cat_id,$offset,$per_page,
														$min_price,$max_price,$brand_id_range,
														$size_id_range,$color_id_range,$price_order,$on_sale);
		}
		//~~ N PAGE 
		else
		{
			//echo "pagination now" ; 
			
			// get the numbers of items from the session 
			$num_of_items = $this->session->userdata("num_of_item");
			if (!$num_of_items) echo("session expired");
			
			// get the offset from the uri 
			$offset =   $arg;
			
			//prepare the pagination links 
			$this->load->library('pagination');
			$per_page = $this->session->userdata("per_page");
			if(empty($per_page)) $per_page = 90;
			
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
			
			$config['base_url'] = base_url().'/product/listing/';
			
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			$config['first_url'] = $config['base_url'].'0?'.http_build_query($_GET);
			
			$config['per_page'] = $per_page;
			$config['total_rows'] = $num_of_items;
			$this->pagination->initialize($config);
			$data['pagination'] =  $this->pagination->create_links();
			
			//prepare the products 
			$cat_id = $this->session->userdata("cat_id");
			
			//get available colors brands and sizes for that category
			$data["available_cat_colors"] =  $this->get_avlbl_colors_in_cat($cat_id,$q_str);
			$data["available_cat_brands"] =  $this->get_avlbl_brands_in_cat($cat_id,$q_str);
			$data["available_cat_sizes"] =   $this->get_avlbl_sizes_in_cat($cat_id,$q_str);
			
			//new
			//$data['products'] = $this->filter->get_product_list('%',$min_price,$max_price,$price_order,$offset,$per_page,$cat_id,$brand_id,$size_id,$color_id,$on_sale);
			//$data['products'] = $this->get_category_decendents_product($cat_id,$offset,$per_page,$min_price,$max_price,$brand_id,$size_id,$color_id,$price_order,$on_sale);
			
			//hybrid way 
			$brand_id_range = $brand_id; // to be parsed into csv if more than 1 brand was selected
			$size_id_range = $size_id; // to be parsed into csv if more than 1 size was selected
			$color_id_range = $color_id; // same as previous comment
			
			$data['products'] = $this->filter->get_filtred_product_list("any",$cat_id,$offset,$per_page,
														$min_price,$max_price,$brand_id_range,
														$size_id_range,$color_id_range,$price_order,$on_sale);
			
		}
		
		//$product_count = $this->product_mdl->get_product_count_per_price($term,$min_price,$max_price);
		
		$lang_id = $this->lng->get_n_set_language_id();
		
		$this->input->set_cookie("language_id", $lang_id, 86400*30*12*10); // set the cookie for 10 years
		//redirect(base_url().'home/error/lng');
		
		// goto view
		$this->load->module("categories");
		$cat_id = $this->session->userdata("cat_id");
		$data['meta_info'] = $this->categories->get_cat_meta_info($cat_id,$lang_id);
        
        $data['template_info']   = $this->home_mdl->get_template_info();
        $this->load->view($data['template_info']['path'].'/common/css',$data);  
        $this->load->view($data['template_info']['path'].'/common/header');  
         
        $this->load->view($data['template_info']['path'].'/product_vew', $data);
        
        $this->load->view($data['template_info']['path'].'/common/footer');  
        $this->load->view($data['template_info']['path'].'/common/script'); 
		
	}
	
	///////////////////////////////
	public function get_subcat_ids($cat_id)
	{
		$this->load->module("categories");
		
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $subcat_range_id
			$cache_id ="product:get_subcat_ids:".$cat_id;
			//$cache_id = sha1($cache_id_str);
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from products->get_subcat_ids)<br>";
				$subcat_range_id = $cache_content;
			}
			else 
			{
				$this->load->module("categories");
				$subcat_range_id = $this->categories->get_all_subcat_ids($cat_id);
				//save to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from products->get_subcat_ids)<br>";
				$rcache->set($cache_id, json_encode($subcat_range_id))or die ("Failed to save data to cash server");
			}
		}
		// if cache is disabled
		else
		{
			$this->load->module("categories");
			$subcat_range_id = $this->categories->get_all_subcat_ids($cat_id);
		}
		
		
		return $subcat_range_id;
	}
	
	
	/*public function get_number_of_products_in_category($cat_id,$min_price,$max_price,$brand_id,$size_id,$color_id,$on_sale){
		
		$subcat_range_id = $this->get_subcat_ids($cat_id);
		
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			$cache_id ="product:num_of_items:".$cat_id."-".$min_price."-".$max_price."-".$brand_id."-".$size_id."-".$color_id."-".$on_sale;
			$cache_content_num_of_items = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content_num_of_items))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from products->get_number_of_products_in_category:num_of_items)<br>";
				$num_of_items = $cache_content_num_of_items;
			}
			else 
			{
				$this->load->model('product_mdl');
				$num_of_items = $this->product_mdl->get_number_of_products_in_category_range($subcat_range_id,$min_price,$max_price,$brand_id,$size_id,$color_id,$on_sale);
			
				//save to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from products->get_number_of_products_in_category:num_of_items)<br>";
				$rcache->set($cache_id, json_encode($num_of_items))or die ("Failed to save data to cash server");
			}
			
			/// end cache
		}
		// if cache is disabled
		else
		{
			$num_of_items = $this->product_mdl->get_number_of_products_in_category_range($subcat_range_id,$min_price,$max_price,$brand_id,$size_id,$color_id,$on_sale);
			
		}
		//echo "num_of_items = ".$num_of_items."  ";
		
		// return $num_of_items in any case with or without cache
		return $num_of_items;
		
	}*/
	
	
	/*public function get_category_decendents_product($cat_id,$offset,$num_of_items,$min_price,$max_price,$brand_id,$size_id,$color_id,$price_order,$on_sale)
	{
		$lang_id = $this->lng->get_n_set_language_id();
		
		if(CACHE_IS_ON)
		{
			//// cache this result : $product_list
			$rcache = $this->cachy->new_redis_instance();
			$cache_id ="product:get_category_decendents_product:".$cat_id.":".$offset."-".$num_of_items."-".$min_price."-".$max_price."-".$brand_id."-".$size_id."-".$color_id."-".$price_order."-".$on_sale;
			//hash the string to help the cache server to get the cache_id faster
			//$cache_id = sha1($cache_id_str);
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from products->get_category_decendents_product)";
				$product_list = $cache_content;
			}
			//else cache it and return result
			else 
			{
				
				$this->load->module("categories");
				$subcat_range_id = $this->categories->get_all_subcat_ids($cat_id);
				
				$product_list = $this->product_mdl->get_category_decendents_products($subcat_range_id,$lang_id,$offset,$num_of_items,$min_price,$max_price,$brand_id,$size_id,$color_id,$price_order,$on_sale);
			
				
				//save to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from products->get_category_decendents_product)";
				$rcache->set($cache_id, json_encode($product_list))or die ("Failed to save data to cash server");
				
			}
		return $product_list;
		}
		// if cache is disabled
		else
		{
			$this->load->module("categories");
			$subcat_range_id = $this->categories->get_all_subcat_ids($cat_id);
			
			$product_list = $this->product_mdl->get_category_decendents_products($subcat_range_id,$lang_id,$offset,$num_of_items,$min_price,$max_price,$brand_id,$size_id,$color_id,$price_order,$on_sale);
			return $product_list;
		}
	
	
	}*/
	
	

	
	public function get_product_images($id)
	{
		$product_images = $this->product_mdl->get_product_images($id);
		
		//echo "<pre>";
		//	print_r($product_images) ;
		//echo "</pre>";
		
		return $product_images;	
	}
	
	public function get_product_alt_images($id)
	{
		$product_alt_images = $this->product_mdl->get_product_alt_images($id);
		
		//echo "<pre>";
		//	print_r($product_alt_images) ;
		//echo "</pre>";	
		
		return $product_alt_images;	
	}
	
	public function get_product_sizes($id)
	{
		$product_sizes = $this->product_mdl->get_product_sizes($id);
		
		/*echo "<pre>";
			print_r($product_sizes) ;
		echo "</pre>";	*/
		
		return $product_sizes;	
	}
	
	public function get_product_colors($id)
	{
		$product_colors_details =  $this->product_mdl->get_product_colors_images_original_size($id);
		
		/*echo "<pre>";
			print_r($product_colors_details) ;
		echo "</pre>";*/	
		
		return $product_colors_details;
	}
	
	public function get_product_availability ($id)
	{
	 	$lang_id = $this->lng->get_n_set_language_id();
	 	
	 	$product_details = $this->product_mdl->get_product_details($id,$lang_id);
		
		//load REST data from the API to check availability 
		$idd = $product_details[0]->idd;
		$product_stream = file_get_contents("http://api.shopstyle.com/api/v2/products/".$idd."?pid=sugar");
		$jproduct = json_decode($product_stream);
		$Stock_status = $jproduct->inStock;
		
		/*echo "<pre>";
			print_r($Stock_status) ;
		echo "</pre>";*/
		
		
		return $Stock_status;  	
	}
	
	
	
	public function get_category_decendents_products_sale($cat_id)
	{
		$lang_id = $this->lng->get_n_set_language_id();		
		
		$this->load->module("categories");
		$subcat_range_id = $this->categories->get_all_subcat_ids($cat_id);
		$product_list = $this->product_mdl->get_category_decendents_products_sale($subcat_range_id,$lang_id);
		
		//echo "<pre>";
		//	print_r($product_list) ;
		//echo "</pre>";
	}
	
	
	// to delete later
    /*	public function get_category_random_products($cat_id,$num_of_items)
	{
		$this->load->module("categories");
		$cat_id_range = $this->categories->get_all_subcat_ids($cat_id);
		$this->load->model("product_mdl");
		
		$random_products = $this->product_mdl->get_category_random_products($cat_id_range,$num_of_items);
		
		//echo "<pre>";
		//print_r($random_products); 
		//echo "</pre>";
		
		return $random_products;
	}*/
	
	
	/**
	* test for memcache if present will echo the server version
	* 
	* @return string memcache server version
	*/
	public function memctest()
	{
		
		$memkach = $this->cachy->new_memcache_instance("memk");
		$version = $memkach->getVersion();
		echo "Server's version: ".$version."<br/>\n";
	}
	
	public function get_avlbl_colors_in_cat($cat_id,$q_str)
	{
		//let's cache available colors  in a category  and its subcategories 
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $subcat_range_id
			$cache_id ="product:get_avlbl_colors_in_cat:".$cat_id;
			//$cache_id = sha1($cache_id_str);
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from products->get_avlbl_colors_in_cat)<br>";
				$avlbl_colors_in_cat = $cache_content;
			}
			else 
			{
				$this->load->module("categories");
				$subcat_range_id = $this->categories->get_all_subcat_ids($cat_id);
				$avlbl_colors_in_cat = $this->categories->get_avlbl_colors_in_cat($subcat_range_id,$q_str);
				//save to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from products->get_avlbl_colors_in_cat)<br>";
				$rcache->set($cache_id, json_encode($avlbl_colors_in_cat))or die ("Failed to save data to cash server");
			}
		} // end of caching
		
		// if cahe is disabled
		else
		{
			$this->load->module("categories");
			$subcat_range_id = $this->categories->get_all_subcat_ids($cat_id);
			$avlbl_colors_in_cat = $this->categories->get_avlbl_colors_in_cat($subcat_range_id,$q_str);
		}
		
		return $avlbl_colors_in_cat;
	}
	
	
	public function get_avlbl_brands_in_cat($cat_id,$q_str)
	{
		//let's cache available brands  in a category  and its subcategories 
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $subcat_range_id
			$cache_id ="product:get_avlbl_brands_in_cat:".$cat_id;
			//$cache_id = sha1($cache_id_str);
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from products->get_avlbl_brands_in_cat)<br>";
				$avlbl_brands_in_cat = $cache_content;
			}
			else 
			{
				$this->load->module("categories");
				$subcat_range_id = $this->categories->get_all_subcat_ids($cat_id);
				$avlbl_brands_in_cat = $this->categories->get_avlbl_brands_in_cat($subcat_range_id,$q_str);
				//save to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from products->get_avlbl_brands_in_cat)<br>";
				$rcache->set($cache_id, json_encode($avlbl_brands_in_cat))or die ("Failed to save data to cash server");
			}
		} // end of caching
		
		// if cahe is disabled
		else
		{
			$this->load->module("categories");
			$subcat_range_id = $this->categories->get_all_subcat_ids($cat_id);
			$avlbl_brands_in_cat = $this->categories->get_avlbl_brands_in_cat($subcat_range_id,$q_str);
		}
		
		return $avlbl_brands_in_cat;
	}
	
	public function get_avlbl_sizes_in_cat($cat_id,$q_str)
	{
		//let's cache available brands in a category  and its subcategories 
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $subcat_range_id
			$cache_id ="product:get_avlbl_sizes_in_cat:".$cat_id;
			//$cache_id = sha1($cache_id_str);
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from products->get_avlbl_sizes_in_cat)<br>";
				$avlbl_sizes_in_cat = $cache_content;
			}
			else 
			{
				$this->load->module("categories");
				$subcat_range_id = $this->categories->get_all_subcat_ids($cat_id);
				$avlbl_sizes_in_cat = $this->categories->get_avlbl_sizes_in_cat($subcat_range_id,$q_str);
				//save to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from products->get_avlbl_sizes_in_cat)<br>";
				$rcache->set($cache_id, json_encode($avlbl_sizes_in_cat))or die ("Failed to save data to cash server");
			}
		} // end of caching
		
		// if cahe is disabled
		else
		{
			$this->load->module("categories");
			$subcat_range_id = $this->categories->get_all_subcat_ids($cat_id);
			$avlbl_sizes_in_cat = $this->categories->get_avlbl_sizes_in_cat($subcat_range_id,$q_str);
		}
		
		return $avlbl_sizes_in_cat;
	}
	
	public function get_avlbl_categories_for_srch($q_str,$lang_id)
	{
		//let's cache available brands in a category  and its subcategories 
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $avlbl_categories_for_srch
			$cache_id ="product:get_avlbl_categories_for_srch:".$lang_id."_".$q_str;
			//$cache_id = sha1($cache_id_str);
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from products->get_avlbl_categories_for_srch)<br>";
				$avlbl_categories_for_srch = $cache_content;
			}
			else 
			{
				$this->load->module("categories");
				$avlbl_categories_for_srch = $this->categories->get_avlbl_categories_for_srch($q_str,$lang_id);
				//save to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from products->get_avlbl_categories_for_srch)<br>";
				$rcache->set($cache_id, json_encode($avlbl_categories_for_srch))or die ("Failed to save data to cash server");
			}
		} // end of caching
		
		// if cahe is disabled
		else
		{
			$this->load->module("categories");
			$avlbl_categories_for_srch = $this->categories->get_avlbl_categories_for_srch($q_str,$lang_id);
		}
		
		return $avlbl_categories_for_srch;
	}
	
	//// 
	public function get_image_wh($img_url)
	{
		//let's cache the calculated image width and height 
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			$cache_id ="img_sz:".$img_url;

			$cache_content = $rcache->get($cache_id) ;
			
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from products->get_image_wh)<br>";
				$image_with_height = json_decode($cache_content) ;
			}
			//else calculate and cache
			else 
			{
				list($widthp, $heightp) = getimagesize($img_url);
				$img_wh = array($widthp,$heightp);
				
				$image_with_height["width"] = $img_wh[0];
				$image_with_height["height"] = $img_wh[1];
				
				//save to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from products->get_image_wh)<br>";
				$rcache->set($cache_id, json_encode($image_with_height) )or die ("Failed to save data to cash server");
			}
		} // end of caching
		
		// if cahe is disabled calculate
		else
		{
			list($widthp, $heightp) = getimagesize($img_url);
			$img_wh = array($widthp,$heightp);
				
			$image_with_height["width"]  = $img_wh[0];
			$image_with_height["height"] = $img_wh[1];
		}
		
		return $image_with_height;
	}
	

	
	
	private function save_product_visit_history($product_id)
	{
		//get the customer_id from the session if user is logged in
		$customer_id = $this->session->userdata("customer_id");
		if(empty($customer_id)) $customer_id = "NULL";
		// get the session cookie from the user browser
		$cookie_id = $this->input->cookie("shopamerika");
		
		$save_flag =  $this->product_mdl->save_product_visit_history($product_id,$customer_id,$cookie_id);
		
	}
	
	//this function is to be called only by the admin
	public function adopt_orphan_product()
	{
		echo "forbiden method!";
		
		/*
		//th id of the parent (adoptive) category
		$cat_id = 1; // for the root category

		// the ids of orphan products
		// local machine
		$data=array( 18620 ,18621 ,18622 ,18623 ,18624 ,18625 ,18627 ,18628 ,18629 ,18630 ,18632 ,18633 ,18634 ,18635 ,18636 ,18637 ,18638 ,18639 ,18641 ,18642 ,18643 ,18644 ,18645 ,18646 ,18647 ,18648 ,18649 ,18650 ,18651 ,18652 ,18653 ,18654 ,18655 ,18656 ,18657 ,18658 ,18659 ,18660 ,18661 ,18662 ,18663 ,18664 ,18665 ,18666 ,18667 ,18668 ,18669 ,18670 ,18671 ,18672 ,18673 ,18674 ,18675 ,18676 ,18677 ,18678 ,18679 ,18680 ,18681 ,18682 ,18683 ,18684 ,18685 ,18686 ,18687 ,18688 ,18689 ,18690 ,18691 ,18692 ,18693 ,18694 ,18695 ,18696 ,18697 ,18698 ,18699 ,18700 ,18701 ,18702 ,18703 ,18704 ,18705 ,18706 ,18707 ,18708 ,18709 ,18710 ,18711 ,18712 ,18713 ,18714 ,18715 ,18716 ,18717 ,18718 ,18719 ,18720 ,18721 ,18722 ,18723 ,18724 ,18725 ,18726 ,18727 ,18728 ,18729 ,18730 ,18731 ,18732 ,18733 ,18734 ,18735 ,18736 ,18737 ,18738 ,18739 ,18740 ,18741 ,18742 ,18743 ,18744 ,18745 ,18746 ,18747 ,18748 ,18749 ,18750 ,18751 ,18752 ,18753 ,18754 ,18755 ,18756 ,18757 ,18758 ,18759 ,18760 ,18761 ,18762 ,18763 ,18764 ,18765 ,18766 ,18767 ,18768 ,18769 ,18770 ,18771 ,18772 ,18773 ,18774 ,18775 ,18776 ,18777 ,18778 ,18779 ,18780 ,18781 ,18782 ,18783 ,18784 ,18785 ,18786 ,18787 ,18788 ,18789 ,18790 ,18791 ,18792 ,18793 ,18794 ,18795 ,18796 ,18797 ,18798 ,18799 ,18800 ,18801 ,18802 ,18803 ,18804 ,18805 ,18806 ,18807 ,18808 ,18809 ,18810 ,18811 ,18812 ,18813 ,18814 ,18815 ,18816 ,18817 ,18818 ,18819 ,18820 ,18821 ,18822 ,18823 ,18824 ,18825 ,18826 ,18827 ,18828 ,18829 ,18830 ,18831 ,18832 ,18833 ,18834 ,18835 ,18836 ,18837 ,18838 ,18839 ,18840 ,18841 ,18842 ,18843 ,18844 ,18845 ,18846 ,18847 ,18848 ,18849 ,18850 ,18851 ,18852 ,18853 ,18854 ,18855 ,18856 ,18857 ,18858 ,18859 ,18860 ,18861 ,18862 ,18863 ,18864 ,18865 ,18866 ,18867 ,18868 ,18869 ,18870 ,18871 ,18872 ,18873 ,18874 ,18875 ,18876 ,18877 ,18878 ,18879 ,18880 ,18881 ,18882 ,18883 ,18884 ,18885 ,18886 ,18887 ,18888 ,18889 ,18890 ,18891 ,18892 ,18893 ,18894 ,18895 ,18896 ,18897 ,18898 ,18899 ,18900 ,18901 ,18902 ,18903 ,18904 ,18905 ,18906 ,18907 ,18908 ,18909 ,18910 ,18911 ,18912 ,18913 ,18914 ,18915 ,18916 ,18917 ,18918 ,18919 ,18920 ,18921 ,18922 ,18923 ,18924 ,18925 ,18926 ,18927 ,18928 ,18929 ,18930 ,18931 ,18932 ,18933 ,18934 ,18935 ,18936 ,18937 ,18938 ,18939 ,18940 ,18941 ,18942 ,18943 ,18944 ,18945 ,18946 ,18947 ,18948 ,18949 ,18950 ,18951 ,18952 ,18953 ,18954 ,18955 ,18956 ,18957 ,18958 ,18959 ,18960 ,18961 ,18962 ,18963 ,18964 ,18965 ,18966 ,18967 ,18968 ,18969 ,18970 ,18971 ,18972 ,18973 ,18974 ,18975 ,18976 ,18977 ,18978 ,18979 ,18980 ,18981 ,18982 ,18983 ,18984 ,18985 ,18986 ,18987 ,18988 ,18989 ,18990 ,18991 ,18992 ,18993 ,18994 ,18995 ,18996 ,18997 ,18998 ,18999 ,19000 ,19001 ,19002 ,19003 ,19004 ,19005 ,19006 ,19007 ,19008 ,19009 ,19010 ,19011 ,19012 ,19013 ,19014 ,19015 ,19016 ,19017 ,19018 ,19019 ,19020 ,19021 ,19022 ,19023 ,19024 ,19025 ,19026 ,19027 ,19028 ,19029 ,19030 ,19031 ,19032 ,19033 ,19034 ,19035 ,19036 ,19037 ,19038 ,19039 ,19040 ,19041 ,19042 ,19043 ,19044 ,19045 ,19046 ,19047 ,19048 ,19049 ,19050 ,19051 ,19052 ,19053 ,19054 ,19055 ,19056 ,19057 ,19058 ,19059 ,19060 ,19061 ,19062 ,19063 ,19064 ,19065 ,19066 ,19067 ,19068 ,19069 ,19070 ,19071 ,19072 ,19073 ,19074 ,19075 ,19076 ,19077 ,19078 ,19079 ,19080 ,19081 ,19082 ,19083 ,19084 ,19085 ,19086 ,19087 ,19088 ,19089 ,19090 ,19091 ,19092 ,19093 ,19094 ,19095 ,19096 ,19097 ,19098 ,19099 ,19100 ,19101 ,19102 ,19103 ,19104 ,19105 ,19106 ,19107 ,19108 ,19109 ,19110 ,19111 ,19112 ,19113 ,19114 ,19115 ,19116 ,19117 ,19118 ,19119 ,19120 ,19121 ,19122 ,19123 ,19124 ,19125 ,19126 ,19127 ,19128 ,19129 ,19130 ,19131 ,19132 ,19133 ,19134 ,19135 ,19136 ,19137 ,19138 ,19139 ,19140 ,19141 ,19142 ,19143 ,19144 ,19145 ,19146 ,19147 ,19148 ,19149 ,19150 ,19151 ,19152 ,19153 ,19154 ,19155 ,19156 ,19157 ,19158 ,19159 ,19160 ,19161 ,19162 ,19163 ,19164 ,19165 ,19166 ,19167 ,19168 ,19169 ,19170 ,19171 ,19172 ,19173 ,19174 ,19175 ,19176 ,19177 ,19178 ,19179 ,19180 ,19181 ,19182 ,19183 ,19184 ,19185 ,19186 ,19187 ,19188 ,19189 ,19190 ,19191 ,19192 ,19193 ,19194 ,19195 ,19196 ,19197 ,19198 ,19199 ,19200 ,19201 ,19202 ,19203 ,19204 ,19205 ,19206 ,19207 ,19208 ,19209 ,19210 ,19211 ,19212 ,19213 ,19214 ,19215 ,19216 ,19217 ,19218 ,19219 ,19220 ,19221 ,19222 ,19223 ,19224 ,19225 ,19226 ,19227 ,19228 ,19229 ,19230 ,19231 ,19232 ,19233 ,19234 ,19235 ,19236 ,19237 ,19238 ,19239 ,19240 ,19241 ,19242 ,19243 ,19244 ,19245 ,19246 ,19247 ,19248 ,19249 ,19250 ,19251 ,19252 ,19253 ,19254 ,19255 ,19256 ,19257 ,19258 ,19259 ,19260 ,19261 ,19262 ,19263 ,19264 ,19265 ,19266 ,19267 ,19268 ,19269 ,19270 ,19271 ,19272 ,19273 ,19274 ,19275 ,19276 ,19277 ,19278 ,19279 ,19280 ,19281 ,19282 ,19283 ,19284 ,19285 ,19286 ,19287 ,19288 ,19289 ,19290 ,19291 ,19292 ,19293 ,19294 ,19295 ,19296 ,19297 ,19298 ,19299 ,19300 ,19301 ,19302 ,19303 ,19304 ,19305 ,19306 ,19307 ,19308 ,19309 ,19310 ,19311 ,19312 ,19313 ,19314 ,19315 ,19316 ,19317 ,19318 ,19319 ,19320 ,19321 ,19322 ,19323 ,19324 ,19325 ,19326 ,19327 ,19328 ,19329 ,19330 ,19331 ,19332 ,19333 ,19334 ,19335 ,19336 ,19337 ,19338 ,19339 ,19340 ,19341 ,19342 ,19343 ,19344 ,19345 ,19346 ,19347 ,19348 ,19349 ,19350 ,19351 ,19352 ,19353 ,19354 ,19355 ,19356 ,19357 ,19358 ,19359 ,19360 ,19361 ,19362 ,19363 ,19364 ,19365 ,19366 ,19367 ,19368 ,19369 ,19370 ,19371 ,19372 ,19373 ,19374 ,19375 ,19376 ,19377 ,19378 ,19379 ,19380 ,19381 ,19382 ,19383 ,19384 ,19385 ,19386 ,19387 ,19388 ,19389 ,19390 ,19391 ,19392 ,19393 ,19394 ,19395 ,19396 ,19397 ,19398 ,19399 ,19400 ,19401 ,19402 ,19403 ,19404 ,19405 ,19406 ,19407 ,19408 ,19409 ,19410 ,19411 ,19412 ,19413 ,19414 ,19415 ,19416 ,19417 ,19418 ,19419 ,19420 ,19421 ,19422 ,19423 ,19424 ,19425 ,19426 ,19427 ,19428 ,19429 ,19430 ,19431 ,19432 ,19433 ,19434 ,19435 ,19436 ,19437 ,19438 ,19439 ,19440 ,19441 ,19442 ,19443 ,19444 ,19445 ,19446 ,19447 ,19448 ,19449 ,19450 ,19451 ,19452 ,19453 ,19454 ,19455 ,19456 ,19457 ,19458 ,19459 ,19460 ,19461 ,19462 ,19463 ,19464 ,19465 ,19466 ,19467 ,19468 ,19469 ,19470 ,19471 ,19472 ,19473 ,19474 ,19475 ,19476 ,19477 ,19478 ,19479 ,19480 ,19481 ,19482 ,19483 ,19484 ,19485 ,19486 ,19487 ,19488 ,19489 ,19490 ,19491 ,19492 ,19493 ,19494 ,19495 ,19496 ,19497 ,19498 ,19499 ,19500 ,19501 ,19502 ,19503 ,19504 ,19505 ,19506 ,19507 ,19508 ,19509 ,19510 ,19511 ,19512 ,19513 ,19514 ,19515 ,19516 ,19517 ,19518 ,19519 ,19520 ,19521 ,19522 ,19523 ,19524 ,19525 ,19526 ,19527 ,19528 ,19529 ,19530 ,19531 ,19532 ,19533 ,19534 ,19535 ,19536 ,19537 ,19538 ,19539 ,19540 ,19541 ,19542 ,19543 ,19544 ,19545 ,19546 ,19547 ,19548 ,19549 ,19550 ,19551 ,19552 ,19553 ,19554 ,19555 ,19556 ,19557 ,19558 ,19559 ,19560 ,19561 ,19562 ,19563 ,19564 ,19565 ,19566 ,19567 ,19568 ,19569 ,19570 ,19571 ,19572 ,19573 ,19574 ,19575 ,19576 ,19577 ,19578 ,19579 ,19580 ,19581 ,19582 ,19583 ,19584 ,19585 ,19586 ,19587 ,19588 ,19589 ,19590 ,19591 ,19592 ,19593 ,19594 ,19595 ,19596 ,19597 ,19598 ,19599 ,19600 ,19601 ,19602 ,19603 ,19604 ,19605 ,19606 ,19607 ,19608 ,19609 ,19610 ,19611 ,19612 ,19613 ,19614 ,19615 ,19616 ,19617 ,19618 ,19619 ,19620 ,19621 ,19622 ,19623 ,19624 ,19625 ,19626 ,19627 ,19628 ,19629 ,19630 ,19631 ,19632 ,19633 ,19634 ,19635 ,19636 ,19637 ,19638 ,19639 ,19640 ,19641 ,19642 ,19643 ,19644 ,19645 ,19646 ,19647 ,19648 ,19649 ,19650 ,19651 ,19652 ,19653 ,19654 ,19655 ,19656 ,19657 ,19658 ,19659 ,19660 ,19661 ,19662 ,19663 ,19664 ,19665 ,19666 ,19667 ,19668 ,19669 ,19670 ,19671 ,19672 ,19673 ,19674 ,19675 ,19676 ,19677 ,19678 ,19679 ,19680 ,19681 ,19682 ,19683 ,19684 ,19685 ,19686 ,19687 ,19688 ,19689 ,19690 ,19691 ,19692 ,19693 ,19694 ,19695 ,19696 ,19697 ,19698 ,19699 ,19700 ,19701 ,19702 ,19703 ,19704 ,19705 ,19706 ,19707 ,19708 ,19709 ,19710 ,19711 ,19712 ,19713 ,19714 ,19715 ,19716);
		
		// shopamerika
		//$data = array(216485 ,873797 ,874308 ,924096 ,1348082 ,1354460 ,1354701 ,1358010 ,1358011 ,1358019 ,1358023 ,1358066 ,1358092 ,1358103 ,1360609 ,1360695 ,1360698 ,1360749 ,1360815 ,1360842 ,1360855 ,1360873 ,1360913 ,1360916 ,1360919 ,1360952 ,1360979 ,1360987 ,1361018 ,1361019 ,1361048 ,1361073 ,1361096 ,1361108 ,1361158 ,1361183 ,1361225 ,1361226 ,1361240 ,1363270 ,1370207 ,1370290 ,1370303 ,1371826);
		
		foreach($data as $product_id)
		{
			$this->product_mdl->adopt_orphan_product($product_id,$cat_id);
			// check the table categories_products after this is finished
		}
		*/
		
	}
	
	// 2016 - using api 
	public function browse()
	{
		
		log_message('debug', 'browse method called');
		$this->load->helper('url');
		$lang_id = $this->lng->get_n_set_language_id();	 ; 
		$this->load->module("categories");
		
		//the api key can be updated from application/config/constants.php and it is actually sugar;
		$api_key=API_KEY;
		
		//example 
		//www.usa.com/usa/product/browse/?cat=Women&fl=b14&fts=red+dress&fl=p20:23&offset=0&limit=50
		
		//http://www.shopamerika.com/beta/product/browse/?cat_id=2&clr=21&clr=45&brnd=45&brnd=10&sz=78&sz=78&mnp=23&mxp=25&hl=78&hl=80
		
		//get the offset from url ( the first number after method name )
		$offset = $this->uri->segment(3);
		if(!$offset) $offset = 0;
		
		$cat_id = $this->input->get('cat_id');
		
		$search_term = $this->input->get('term',true);
		
		
		if(!$search_term) 	$search_str_filter = "";
		else
		{
			//lowercase and replace spaces with +
			$search_term = strtolower($search_term);
			$search_term = str_ireplace(' ','+',$search_term);
				
			$search_str_filter =  "&fts=".$search_term;
			
			//if search came from search input without a category then set the category id to root category
			if( empty($cat_id) ) $cat_id = 1;
		}
		//$gets=$this->input->get();
		$query  = explode('&', $_SERVER['QUERY_STRING']);
		
		//to be sent to the view for saving filter status (Cookies like)
		$colors_fl = $brands_fl = $sizes_fl = $heelheight_fl = $sale_fl = $price_fl =  array(); 
	
		// my custom query string parser instead of parse_str() function :p  
		foreach( $query as $param )
		{
		  $var =  explode('=', $param, 2);
		  if($var[0]=="clr") 	$clr_ids[]=$var[1];
		  if($var[0]=="brnd") 	$brnd_ids[]=$var[1];
		  if($var[0]=="sz") 	$sz_ids[]=$var[1];
		  if($var[0]=="hl") 	$hl_ids[]=$var[1];
		  if($var[0]=="s") 		$sale_ids[]=$var[1];
		  if($var[0]=="p")   	$pr_ids[]=$var[1];
		}
		
		//we need those for the filter boxes 
		if(isset($clr_ids))  $data["clr_ids"] 	= $clr_ids;
		if(isset($sale_ids)) $data["sale_ids"] 	= $sale_ids;
		if(isset($brnd_ids)) $data["brnd_ids"] 	= $brnd_ids;
		if(isset($sz_ids))   $data["sz_ids"] 	= $sz_ids;
		if(isset($hl_ids))   $data["hl_ids"] 	= $hl_ids;
		if(isset($pr_ids))   $data["pr_ids"] 	= $pr_ids;
		
		//prepare the color query string
		$color_str_filter ="";
		if(isset($clr_ids))
		{
			foreach($clr_ids as $clr_id)
			{
				$color_str_filter .="&fl=c".$clr_id;
				$colors_fl[] = $clr_id;  	
			}
		}
		
		//prepare the brand query string
		$brand_str_filter ="";
		if(isset($brnd_ids))
		{
			foreach($brnd_ids as $brnd_id)
			{
				$brand_str_filter .="&fl=b".$brnd_id;
				$brands_fl[] =  $brnd_id;	
			}
		}
		
		//prepare the size query string
		$size_str_filter ="";
		if(isset($sz_ids))
		{
			foreach($sz_ids as $sz_id)
			{
				$size_str_filter .="&fl=s".$sz_id;
				$sizes_fl[] =  	$sz_id;
			}
		}
		
		//prepare the heel height query string
		$heelheight_str_filter ="";
		if(isset($hl_ids))
		{
			foreach($hl_ids as $hl_id)
			{
				$heelheight_str_filter .="&fl=h".$hl_id; 
				$heelheight_fl[] =  	$hl_id;
			}
		}
		
		//prepare the sale query string
		$sale_str_filter ="";
		if(isset($sale_ids))
		{
			foreach($sale_ids as $sale_id)
			{
				$sale_str_filter .="&fl=d".$sale_id; 	
				$sale_fl[] = $sale_id;
			}
		}
		
		//prepare the price query string
		$price_str_filter = "&fl=p7&fl=p8";
		$price_str_filter = "";
		if(isset($pr_ids))
		{
			foreach($pr_ids as $pr_id)
			{
				$price_str_filter .="&fl=p".$pr_id; 	
				$price_fl[] = $pr_id;
			}
		}
		
		//we need this to hide prices in the filter view
		$this->load->module('price_rules');
		$data['price_id_value'] = $this->price_rules_mdl->get_price_id_value();
		
		$max_price_admin_value_arr = $this->price_rules_mdl->get_max_price_admin_value();
		if(!empty($max_price_admin_value_arr))
		{
			$data['max_price_admin_id'] = $max_price_admin_value_arr[0]->id;
		}
		else
		{
			$data['max_price_admin_id'] = NULL;
		}
		
		if(empty($price_str_filter) and !empty($max_price_admin_value_arr))
		{
			$max_price_admin_id = $max_price_admin_value_arr[0]->id;
			$cpt=6;
			while($cpt != $max_price_admin_id)
			{
				$cpt++;
				$price_str_filter .="&fl=p".$cpt; 	
			}
		}
		$oo = 55 ;
		
		/*
		$min_price_value = $this->input->get('mnp',TRUE);
		$max_price_value = $this->input->get('mxp',TRUE);
		
		//control the maximum value from admin panel 
		$this->load->module('price_rules');
		
		$max_price_admin_value_arr = $this->price_rules_mdl->get_max_price_admin_value();
		if(!empty($max_price_admin_value_arr)) 
		{
			$max_price_admin_value = $max_price_admin_value_arr[0]->max_val;
		}
		else
		{
			
		}
		
		$max_price_admin_value = NULL;
		
		
		//if no price filter from view then use [0-5000] or [0-$max_price_admin_value]
		if(!$min_price_value) $min_price_value = 0;
		if(!$max_price_value) 
		{
			if(!empty($max_price_admin_value))
			{
				$max_price_value = $max_price_admin_value;
			}
			else
			{
				$max_price_value = 5000;
				
			}
		}
		
		
		//justify imposible values max scroller can never reach 0, and min scroller never 5000
		if($min_price_value > 4500) $min_price_value = 4500;
		if($max_price_value < 10) $max_price_value = 10;
		
		//if max value from view is bigger then max value from admin panel use max admin panel value instead
		if(!empty($max_price_admin_value))
		{
			
			if($max_price_value > $max_price_admin_value)
			{
				$max_price_value = $max_price_admin_value ;
			}
		}
		
		$min_price_id_arr = $this->product_mdl->get_min_price_id($min_price_value);
		$max_price_id_arr = $this->product_mdl->get_max_price_id($max_price_value);
		
		if(!empty($min_price_id_arr)) $min_price_id = $min_price_id_arr[0]->id; else $min_price_id = FALSE;
		if(!empty($max_price_id_arr)) $max_price_id = $max_price_id_arr[0]->id; else $max_price_id = FALSE;
		
		
		if((!$min_price_id) and(!$max_price_id) )  $price_str_filter="";
		else 
		{
			if($min_price_value != $max_price_value)
			{
				$price_str_filter = "&fl=p".$min_price_id.":".$max_price_id;
			}
			else
			{
				$price_str_filter = "&fl=p".$min_price_id.":".$max_price_id; ///////// to delete later 
				//get the current url and remove the price parameters from it and redirect to it 
				$current_qry_str = $_SERVER["QUERY_STRING"];
				
				$min_re = '/&mnp=[0-9]+/';
				$new_current_qry_str = preg_replace($min_re, "", $current_qry_str);
				
				$max_re = '/&mxp=[0-9]+/';
				$new_current_qry_str = preg_replace($max_re, "", $new_current_qry_str);
				
				$new_url = base_url()."product/browse/?".$new_current_qry_str;
				
				$oo = 55;
				// SAME MAX AND MIN PRICE go to the same url without prices 
				
				redirect($new_url);
				
				
			}
			
		}
		
		*/
		
		
		
		//prepare the sort query string
		$sort_str = $this->input->get('srt');
		if(!$sort_str) $sort_str="";
		else $sort_str =  "&sort=".$sort_str;
		
		
		
		//get the category name from db to be sent to the remote server
		$localized_cat_id = $this->categories->get_cat_localized_id($cat_id,$lang_id);
		
		$this->load->library('pagination');
		
		//$product_per_page =$this->input->get("ppp"); // get the number of items per page from user
		//if(empty($product_per_page)) $product_per_page = 25; // default value
		
		$product_per_page = 48;
		
		// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['base_url'] = base_url().'/product/browse/';
		$config['first_url'] = $config['base_url'].'0?'.http_build_query($_GET);
		
		$config['per_page'] = $product_per_page;
		
		//$qurl = "http://api.shopstyle.com/api/v2/products?pid=$api_key&cat=$localized_cat_id$brand_str_filter$color_str_filter$size_str_filter&offset=$offset&limit=$product_per_page";
		$qurl = 'http://api.shopstyle.com/api/v2/products?pid='.$api_key.
		'&cat='.$localized_cat_id.
		$search_str_filter.
		$color_str_filter.
		$brand_str_filter.
		$size_str_filter.
		$heelheight_str_filter.
		$price_str_filter.
		$sale_str_filter.
		$sort_str.
		'&offset='.$offset.
		'&limit='.$product_per_page;
		
	  	////////caching start//////////
		$cache_id ="product:browse:products_list:".$qurl;
		$api_response_json = $this->cachy->smart_cache($cache_id,$qurl);
		////////caching finish//////////
		  
		//$api_response_json = @file_get_contents($qurl);
		
		if($api_response_json)
		{
			
			$api_response = json_decode($api_response_json);
			
			// destroy the json file Save memory live better
			unset($api_response_json);
			
			$data['response'] = $api_response;
			$total_rows= $api_response->metadata->total;
			
			
			if($total_rows > 100000)
			{
				$config['total_rows'] = 100000; 
			}
			else
			{
				$config['total_rows'] = $total_rows; 
			}
			 
			//number of links before and after the active page 
			$config['num_links'] = 2; 
			 
			
			$this->pagination->initialize($config);
			$data['pagination'] =  $this->pagination->generate_links2();
			
			// ~~~~~begin filters responses ----//
			
			//get available colors in a category
			$flag_show_color_filter = $api_response->metadata->showColorFilter;
			if($flag_show_color_filter)
			{
				$qurl_available_colors = 'http://api.shopstyle.com/api/v2/products/histogram?cat='.$localized_cat_id.'&pid='.$api_key.'&filters=Color'.
				$search_str_filter.
				$color_str_filter.
				$brand_str_filter.
				$size_str_filter.
				$heelheight_str_filter.
				$price_str_filter.
				$sale_str_filter ; 
				
				////////caching start//////////
				$cache_id ="product:browse:available_colors:".$qurl_available_colors;
				$available_colors_json = $this->cachy->smart_cache($cache_id,$qurl_available_colors);
				////////caching finish//////////
				
				//$available_colors_json = file_get_contents($qurl_available_colors);
				$available_colors = json_decode($available_colors_json);
				
				// destroy the json file Save memory live better
				unset($available_colors_json);
				
				$data['available_colors'] = $available_colors;
			}
			
			//get available sizes in a category
			$flag_show_sizes_filter = $api_response->metadata->showSizeFilter;
			if($flag_show_sizes_filter)
			{
				$qurl_available_sizes = 'http://api.shopstyle.com/api/v2/products/histogram?cat='.$localized_cat_id.'&pid='.$api_key.'&filters=Size'.
				$search_str_filter.
				$color_str_filter.
				$brand_str_filter.
				$size_str_filter.
				$heelheight_str_filter.
				$price_str_filter.
				$sale_str_filter ; 
				
				////////caching start//////////
				$cache_id ="product:browse:available_sizes:".$qurl_available_sizes;
				$available_sizes_json = $this->cachy->smart_cache($cache_id, $qurl_available_sizes);
				////////caching finish//////////
				
				//$available_sizes_json = file_get_contents($qurl_available_sizes);
				$available_sizes = json_decode($available_sizes_json);
				
				// destroy the json file Save memory live better
				unset($available_sizes_json);
				
				$data['available_sizes'] = $available_sizes;
			}
			
			//get available heel-height in a category
			$flag_show_heelheight_filter = $api_response->metadata->showHeelHeightFilter;
			if($flag_show_heelheight_filter)
			{
				$qurl_available_heelheights = 'http://api.shopstyle.com/api/v2/products/histogram?cat='.$localized_cat_id.'&pid='.$api_key.'&filters=HeelHeight'.
				$search_str_filter.
				$color_str_filter.
				$brand_str_filter.
				$size_str_filter.
				$heelheight_str_filter.
				$price_str_filter.
				$sale_str_filter ; 
				
				////////caching start//////////
				$cache_id ="product:browse:available_heelheights:".$qurl_available_heelheights;
				$available_available_heelheights_json = $this->cachy->smart_cache($cache_id, $qurl_available_heelheights);
				////////caching finish//////////
				
				//$available_available_heelheights_json = file_get_contents($qurl_available_heelheights);
				$available_heelheights = json_decode($available_available_heelheights_json);
				
				// destroy the json file Save memory live better
				unset($available_available_heelheights_json);
				
				$data['available_heelheights'] = $available_heelheights;
			}
			
			//get available brands in a category
			{
				$qurl_available_brands = 'http://api.shopstyle.com/api/v2/products/histogram?cat='.$localized_cat_id.'&pid='.$api_key.'&filters=Brand'.
				$search_str_filter.
				$color_str_filter.
				//$brand_str_filter.
				$size_str_filter.
				$heelheight_str_filter.
				$price_str_filter.
				$sale_str_filter ;
				
				////////caching start//////////
				$cache_id ="product:browse:available_brands:".$qurl_available_brands;
				$available_brands_json = $this->cachy->smart_cache($cache_id, $qurl_available_brands);
				////////caching finish//////////
					
				//$available_brands_json = file_get_contents($qurl_available_brands);
				$available_brands = json_decode($available_brands_json);
				
				// destroy the json file Save memory live better
				unset($available_brands_json);
				
				$data['available_brands'] = $available_brands;
			}
			
			//get available sales in a category
			{
				$qurl_available_sales = 'http://api.shopstyle.com/api/v2/products/histogram?cat='.$localized_cat_id.'&pid='.$api_key.'&filters=Discount'.
				$search_str_filter.
				$color_str_filter.
				$brand_str_filter.
				$size_str_filter.
				$heelheight_str_filter.
				$price_str_filter.
				$sale_str_filter;
				
				////////caching start//////////
				$cache_id ="product:browse:available_sales:".$qurl_available_sales;
				$available_sales_json = $this->cachy->smart_cache($cache_id, $qurl_available_sales);
				////////caching finish//////////
				
				//$available_sales_json = file_get_contents($qurl_available_sales);
				$available_sales = json_decode($available_sales_json);
				
				// destroy the json file Save memory live better
				unset($available_sales_json);
				
				$data['available_sales'] = $available_sales;
			}
			
			//get available prices in a category
			{
				$qurl_prices = 'http://api.shopstyle.com/api/v2/products/histogram?cat='.$localized_cat_id.'&pid='.$api_key.'&filters=Price'.
				$search_str_filter.
				$color_str_filter.
				$brand_str_filter.
				$size_str_filter.
				$heelheight_str_filter.
				//$price_str_filter.
				$sale_str_filter;
				
				////////caching start//////////
				$cache_id ="product:browse:available_prices:".$qurl_prices;
				$available_prices_json = $this->cachy->smart_cache($cache_id, $qurl_prices);
				//echo("~~~~~~~~~~~~~~~~~~~~<br>");
				//var_dump($available_prices_json);
				////////caching finish//////////
				
				//$available_prices_json = file_get_contents($qurl_prices);
				$available_prices = json_decode($available_prices_json);
				//echo("~~~~~~~~~~~~~~~~~~~~<br>");
				//var_dump($available_prices);
				
				// destroy the json file Save memory live better
				unset($available_prices_json);
				
				$data['available_prices'] = $available_prices;
			}
			
			// ~~~~~end filters responses----//
			
			//get current url
			
			$current_url= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			$data['current_url'] = $current_url;
			
			//get price ids and values for price filter
			$data['price_id_values'] = $this->product_mdl->get_price_id_values();
			
			//cookies 
			$filters = array(
			'colors_fl'=>$colors_fl,
			'brands_fl'=>$brands_fl,
			'sizes_fl'=>$sizes_fl,
			'heelheight_fl'=>$heelheight_fl,
			'sale_fl'=>$sale_fl,
			'price_fl'=>$price_fl
			//'price_min_fl'=>$min_price_value,
			//'price_max_fl'=>$max_price_value
			);
			$data['filters'] = $filters;
			
			//get the categories for the menu 
			$this->load->module('categories');
			
			$main_cats = $this->categories->get_subcategories_plus_for_view(1); //get the 4 main categories 
			$data['main_cats'] = $main_cats;
			
			
			
			//$categories_for_menu = $this->categories->get_categories_for_menu();
			//$data['categories_for_menu'] = $categories_for_menu;
			
			//for the link that will be sent to product details -> single view then will be used for breadcrumbs
			if(!empty($search_term ))
			{
				$search_term = str_replace('+','-',$search_term);
				$data['cat_id_url'] = $cat_id.'-search-'.$search_term."~";
			}
			else
			{
				$data['cat_id_url'] = $cat_id;
			}
			
			//for breadcrumps
			$data['cat_id'] = $cat_id;
			$data['breadcrumbs'] = array_reverse($this->categories->get_ancestors_categories($cat_id));
			
			
			
			//$this->load->module("msg");
			$data['words_left']   = $this->msg->get_words("listing_left_menu");
			$data['words']   = $this->msg->get_words("product_list");
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			// currency
			$this->load->module('currency');
			$this->currency->set_currency(); // no parameter ==> usd will be the default
			$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
			$RATE = $this->session->userdata("CUR_RATE");
			
			$data['currency'] = $CURRENCY;
			$data['rate'] = $RATE;
			
			$script_data['currency'] = $CURRENCY;
			$script_data['rate'] = $RATE;
			
			//for SEO
			$meta_info = $this->seo_mdl->get_cat_meta_info($cat_id,$lang_id);
			
			if(empty($meta_info[0]->title))
			{
				$meta_info[0]->title =  $api_response->metadata->category->name;
				$meta_info[0]->description = $api_response->metadata->category->fullName;
				$meta_info[0]->keywords =  $api_response->metadata->category->id;
			}
		    
			//var_dump($meta_info);
		    $data['meta_info']   = $meta_info;
		    
		    $data['template_info']   = $this->home_mdl->get_template_info();
			// goto view
		    $this->load->view($data['template_info']['path'].'/common/css_browse',$data);  
		    $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
		     
		    $this->load->view($data['template_info']['path'].'/product_vew', $data);
		    
		    $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
		    $this->load->view($data['template_info']['path'].'/common/script_browse',$script_data); 	
		}
		else
		{
			echo("Sorry, we're experiencing a wardrobe malfunction. please try agin");
		}
		

	}
	
	public function autocomplete()
	{
		
		$foo = $_GET['term'];
		
		$search_term = $this->input->get('term');
		
		
		if(empty($search_term))
		{
			return NULL;
		}
		else
		{
			//if the term is 2 characters or more
	      	if( strlen($search_term) > 1 )
	      	{
				$search_term = strtolower($search_term);
				$search_term = str_ireplace(' ','+',$search_term);
				
				$api_key = API_KEY;
				
				$search_str_filter =  "&fts=".$search_term;
				
				$qurl = 'http://api.shopstyle.com/api/v2/products?pid='.$api_key.
				$search_str_filter.
				'&offset=0'.
				'&limit=50';
				
				$api_response_json = file_get_contents($qurl);
				$api_response_obj = json_decode($api_response_json);
				$products = $api_response_obj->products;
				$products_json = json_encode($products);
				
				$oo = 55 ;
				echo $products_json;
			}
		}
		
	}
	
	
	//new details
	public function details($id)
	{
		//for breadcrumbs
		//get the category id from url
		$cat_id_url = $this->get_url_cat_id();
		// get the searched item from url if from search bar
		$search_term_url = $this->get_search_term_url();
		// get the word cart-details if it came from the cart
		$is_from_cart = $this->get_cart_term_url();
		
		if(!empty($cat_id_url) and empty($search_term_url))
		{
			$this->load->module('categories');
			$data['breadcrumbs'] = array_reverse($this->categories->get_ancestors_categories($cat_id_url));
		}
		if(!empty($search_term_url))
		{
			$this->load->module('categories');
			$ancestors_categories = array_reverse($this->categories->get_ancestors_categories($cat_id_url));
			$search_breadcrumbs =array($ancestors_categories[0]->shortName,$ancestors_categories[0]->id_category,'back to result',$search_term_url) ;
						
			$data['search_breadcrumbs'] = $search_breadcrumbs;
		}
		if($is_from_cart)
		{
			$data['is_from_cart'] = $is_from_cart;	 //true
		}
		
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
		
		//featured items are inside lists
		$API_KEY = API_KEY ;
		//$API_USER_ID = API_USER_ID ;
		
		$this->load->module("lists");
		$data['lists']['featured_single_right'] = $this->lists->get_featured_single_right();
		$data['lists']['featured_single_bottom'] = $this->lists->get_featured_single_bottom();
		
		$q_url_product_details = "http://api.shopstyle.com/api/v2/products/$id?pid=$API_KEY";
	
		$product_details_json = @file_get_contents($q_url_product_details);
		if($product_details_json === FALSE)
		 { 
		 	$this->msg->show(80,"internal connection failed!"); // show internal error  
		 }
		else
		{
			$product_details 	  = json_decode($product_details_json);
			
			//generate stock matrix array  
			$stock_matrix = $this->stock_matrix_generator($product_details);
			
			$categories = $this->get_item_categories($product_details->categories);
			
			 
			//$flag = 123 ; 
			//generate product colors
			//$product_colors = $this->product_colors_generator($product_details);
			
			if(!empty($product_details->inStock))	$in_stock= $product_details->inStock;
			else	$in_stock= 0;
			
			//$in_stock= 0; // for testing 
			
			$data['in_stock']= $in_stock;
			
			$data['cat_id']= $this->get_url_cat_id();
			
			$data['product_details']= $product_details;
			$data['stock_matrix']= json_encode($stock_matrix);
			//$data['product_colors']= $product_colors;
			
			//for SEO
			
			
			$meta_info[0]= new stdClass(); 
			
			if(!empty($product_details->name))
			{
				$meta_info[0]->title =  		$product_details->name;
				$meta_info[0]->description = 	$product_details->name;
				$meta_info[0]->keywords =  		$product_details->name;
			}
			else
			{
				$meta_info[0]->title = "product";
				$meta_info[0]->description = "product";
				$meta_info[0]->keywords =  "product";
			}
		    
			//var_dump($meta_info);
		    $data['meta_info']   = $meta_info;
			
	        //get wording for the page 
		   	$data['words'] = $this->msg->get_words("single");
		   	$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
	        
	        $data['template_info']   = $this->home_mdl->get_template_info();
	        
	        $this->load->view($data['template_info']['path'].'/common/css',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  

	        $this->load->view($data['template_info']['path'].'/single_vew',$data); 
	        
	        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
	        $this->load->view($data['template_info']['path'].'/common/script_single',$data); 
		}
	}
	
	
	
	
	
	// this is just a test method ....for calling another controller in the background via ajax while doing something else
	public function ajaxcall()
	{
		
		echo '<script src="https://code.jquery.com/jquery-1.11.3.min.js"> </script>';
		echo
		'<script>
		var target_url = "http://www.usa.com/ushop/"
		var Data = {user_id:542,name:"Baci"};
		$.ajax(
				{
					url : target_url,
					type: "POST",
					data : Data,
					success: function(data)
					{
						
						alert("all right request was sent via Ajax  ");
						
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						alert("request failed !  ");
					}
				});
		</script>
		' ;
		echo "continue script ...";
	}
	
	private function stock_matrix_generator($product_details)
	{
		
		//generate stock matrix array  
		$stock_matrix  = array();
		
		if(!empty($product_details->stock))
		{
			foreach($product_details->stock as $product_color_size)
			{
				
				if (!empty($product_color_size->color->name) and !empty($product_color_size->size->name) )
				{
					$color_name = $product_color_size->color->name;
					$size_name  = $product_color_size->size->name;
					
					//for debugging without sha1 comment those 2 lines
					//$stock_matrix[$color_name."~".$size_name]	= 1;	
					//$stock_matrix[$size_name."~".$color_name]	= 1;	
					
					$stock_matrix[sha1($color_name)."~".sha1($size_name)]	= 1;	
					$stock_matrix[sha1($size_name)."~".sha1($color_name)]	= 1;	
				}
			}
		}
		return $stock_matrix;
	}
	
	private function product_colors_generator($product_details)
	{
		$product_colors = array();
		foreach($product_details->colors as $product_color)
		{
			$key = $product_color->name;
			$product_colors[$key]['name'] = $key;
			if(!empty($product_color->swatchUrl))$product_colors[$key]['swatch_url'] 					  = $product_color->swatchUrl; 
			if(!empty($product_color->canonicalColors[0]->name))$product_colors[$key]['cannonical_color'] = $product_color->canonicalColors[0]->name;
			if(!empty($product_color->image))$product_colors[$key]['image'] 							  = $product_color->image->sizes->Best->url; 
		}
		
		return $product_colors;
	}	
	
	private function get_item_categories($categories)
	{
		$cats = array();
		
		foreach ($categories as $c)
		{
			$cats[] = $c->numId;
		}
		
		return $cats;
	}
	
	public function get_url_cat_id()
	{
		$current_url = $_SERVER['REQUEST_URI'];
		
		$re = "/cat_id-([0-9]+)/"; 
     	preg_match($re, $current_url, $matches);
    	
    	$url_cat_id = NULL;
    	
		if(!empty($matches[1]))
		{
			$url_cat_id =  $matches[1];
		}
		
		return $url_cat_id;
	}
	
	public function get_search_term_url()
	{
		$current_url = $_SERVER['REQUEST_URI'];
		
		$re = "/-search-(.+)~/"; 
		preg_match($re, $current_url, $matches);
		
		$search_term = NULL;
    	
		if(!empty($matches[1]))
		{
			$search_term =  $matches[1];
			$search_term = str_replace('-',' ',$search_term);
		}
		
		return $search_term;
		
	}
	
	public function get_cart_term_url()
	{
		$current_url = $_SERVER['REQUEST_URI'];
		
		$re = "/cart-details-/"; 
		preg_match($re, $current_url, $matches);
		
		$is_from_cart = false;
    	
		if(!empty($matches[0]))
		{
			$is_from_cart = true;
		}
		
		return $is_from_cart;
	}
	
	
}















/* End of file product.php */
/* Location: ./application/controllers/product.php */