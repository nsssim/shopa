<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends MX_Controller {

 function __construct()
    {
        $jproduct = NULL;
        parent::__construct();
        $this->load->helper('url');
		$this->load->model('home_mdl'); // needed for the template info (template path)
		$this->load->model('product_mdl');  // needed for the product details and images 
    }

	// for crypting url
	private	function getDataURI($image, $mime = '') 
		{
			return 'data: '.(function_exists('mime_content_type') ? mime_content_type($image) : $mime).';base64,'.base64_encode(file_get_contents($image));
		}
	
	public function details($id)
	{
		// get the language from the session 
		$lng = $this->session->userdata("language_id");
		// if language isnot in session 
		if (!$lng) 
			redirect(base_url().'home/error/lng');
		
		$data['product_details'] = $this->product_mdl->get_product_details($id,$lng);
				
		//load REST data from the API to check availability 
		$idd = $data['product_details'][0]->idd;
		$product_stream = file_get_contents("http://api.shopstyle.com/api/v2/products/".$idd."?pid=sugar");
		$jproduct = json_decode($product_stream);
		$data['product_inStock'] = $jproduct->inStock;
		
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
		 
        $this->load->view($data['template_info']['path'].'/single_vew',$data);  // send the result from the model to the view */
		
		/*$this->load->model('product_mdl'); // load the model that will get the alternative pictures
		$data['product_alt_img'] = $this->product_mdl->get_product_alt_images($id); // call the method get_product_alt_images inside the class test_mdl
        $page_path =  'templates\\'.$this->template.'\product_details_vew' ;
        $this->load->view($page_path,$data);  // send the result from the model to the view */
	}
	
	// this function is just to recieve a get http request and call another method since you can't use route.php for question mark "?" unless...
	public function presearch(){
				
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
	
	public function search0(){
		if($this->session->userdata("search_term"))
		{
			$term = $this->session->userdata("search_term");
			//($this->session->userdata("search_term"))?	$term = $this->session->userdata("search_term") :$term = "dfgfgdgdfgdgbbcvgg005465464impossible" ;
			
			$product_match = $this->product_mdl->get_product_id($term);
			// if product was selected from autocomplete
			if(!empty($product_match) )
			{
				$product_id = NULL;
				foreach ($product_match as $row) 
				{
		    		$product_id = $row->product_id;
				}
				// send product id to details that will fetch all details 
				// and call the product details view
				$this->details($product_id);
			}
			else // search for the products like term 
			{
				//prepare the pagination links 
				$this->load->library('pagination');
				$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				$per_page = 20;
				$config['base_url'] = base_url().'/product/search/';
				$product_count = $this->product_mdl->get_product_count($term);
				$config['per_page'] = $per_page;
				$config['total_rows'] = $product_count;
				$this->pagination->initialize($config);
				$data['pagination'] =  $this->pagination->create_links();
				
				//get the categories
				if(($this->session->userdata("category_id"))) 
				$category_id = $this->session->userdata("category_id");
				else
				$category_id = 1; // this  is the root category
				$this->load->module("categories");
				
				// fetch all subcategories of the given category id and return a string like this 2,3,31,100,....
				$sub_cat_id_list = $this->categories->get_sub_cat_id($category_id);
								
				$product_match = $this->product_mdl->get_product($term,$sub_cat_id_list,$per_page,$offset);
				
				// get the language from the session 
				$lng = $this->session->userdata("language_id");
				// if language isnot in session 
				if (!$lng) 
					redirect(base_url().'home/error/lng');
				
				$data['template_info']   = $this->home_mdl->get_template_info();// get the template for the active shop 
				
				$search_result = $B = array();
				foreach ($product_match as $row)
				{
					$B['id'] 	  = $row->product_id;
					$B['product_img'] 	  = $this->product_mdl->get_product_images($row->product_id);
					
					$B['product_details'] = $this->product_mdl->get_product_details($row->product_id,$lng);
					$B['product_reviews'] = $this->product_mdl->get_product_reviews($row->product_id);
					$B['product_colors']  = $this->product_mdl->get_product_colors_images_original_size($row->product_id);
					
					$search_result[] =$B;
				}
				
				// the term that is being searched for 
				$data['term'] = $term ;
				$min_price = 0; 
				$max_price = 1000;
				$data['price_range'] = "[$min_price,$max_price]";
				
				//show search result with pagination 
				$data['data'] = $search_result ; 
				$this->load->view($data['template_info']['path'].'/search_result_vew',$data);  
			}
		}
		else
		{
			//session expired redirect to home page
			redirect(base_url().'home/');
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
			
			// get the language from the session 
			$lng = $this->session->userdata("language_id");
			// if language is not in session 
			if (!$lng) 
				redirect(base_url().'home/error/lng');
			
			$data['template_info']   = $this->home_mdl->get_template_info();// get the template for the active shop 
			
			$search_result = $B = array();
			foreach ($product_match as $row)
			{
				$B['id'] 	  = $row->product_id;
				$B['product_img'] 	  = $this->product_mdl->get_product_images($row->product_id);
				
				$B['product_details'] = $this->product_mdl->get_product_details($row->product_id,$lng);
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
	
	public function autosearch()
	{
    	if (isset($_GET['term']))
    	{
      		$q = strtolower($_GET['term']);
      		$this->product_mdl->search_product($q);
      		
			/*$search_result = $this->product_mdl->search_product($q);
      		var_dump($search_result);
      		$sdfsd= 54654 ; 
      		if(!empty($search_result) )
      		{
			    $product_result  = array();
			    foreach ($search_result as $row)
			    {
			   		$element = htmlentities(stripslashes($row['brandedName'])); //build an array
			   		array_push($product_result,$element);
			    }
			    
			    $product_json_result = json_encode($product_result); //format the array into json data
			    echo ("$product_json_result "); 
			}*/
			
			 //$q = strtolower($_GET['term']);
			
			
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
	
	public function get_category_decendents_products($cat_id)
	{
		$lang_id = $this->session->userdata("language_id");	
		$lang_id=2;
		$this->load->module("categories");
		$subcat_range_id = $this->categories->get_all_subcat_ids($cat_id);
		$children= $this->categories->get_first_subcat_children($cat_id);
		$product_list = $this->product_mdl->get_category_decendents_products($subcat_range_id,$lang_id);
		$data['product_list']=$product_list;
		$data['children']=$children;
		//echo "<pre>";
		//	print_r($product_list) ;
		//echo "</pre>";
		 $this->load->view('templates/eshopper/product_vew',$data);
		
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */