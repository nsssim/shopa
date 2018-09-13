<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class brands extends MX_Controller {

	function __construct()
    {
        parent::__construct();
        
        //load the language module
		$this->load->module("lng");
       
        // call cache module
		$this->load->module("cachy");
		
		// call cache module
		$this->load->model("brands_mdl");
    }
    
	public function index()
	{
		
	}
	
	//this function is made especially for cache so it only gets the ids to optimize cache memory 
	private function get_brands_ids_alpha($cat_id,$letter)
	{
		//get all the subcategories of the given category_id
		$this->load->module("categories");
		$cat_range_id = $this->categories->get_all_subcat_ids($cat_id);
		
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $brands_id_alpha[$letter]
			$cache_id ="brands:get_brands_ids_alpha:".$cat_id."_".$letter;
			//$cache_id = sha1($cache_id_str);
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from brands->get_brands_ids_alpha($cat_id,$letter))<br>";
				$brands_id_alpha[$letter] = $cache_content;
			}
			else 
			{
				$brands_id_alpha_arr = $this->brands_mdl->get_brands_ids_starting_by($letter,$cat_range_id);
				
				//flatten the array 
				foreach($brands_id_alpha_arr as $brnd_id)
				{
					$brand_id_list[] = $brnd_id->brand_id;
				}
				if(isset($brand_id_list))
				{
					$brands_id_alpha[$letter] = $brand_id_list;
					//save to cache 
					if (VERBOSE_DEBUG) echo "saving to cache ... (from brands->get_brands_ids_alpha($cat_id,$letter))<br>";
					$rcache->set($cache_id, json_encode($brands_id_alpha[$letter]))or die ("Failed to save data to cash server");
				}
			}
		}
		// if cache is disabled
		else
		{
			$brands_id_alpha_arr = $this->brands_mdl->get_brands_ids_starting_by($letter,$cat_range_id);
			
			//flatten the array 
			foreach($brands_id_alpha_arr as $brnd_id)
			{
				$brand_id_list[] = $brnd_id->brand_id;
			}
			if(isset($brand_id_list)) $brands_id_alpha[$letter] = $brand_id_list;
		}
		
		//
		if(isset($brands_id_alpha)) return $brands_id_alpha;
		else return NULL;
	}
	
	private function get_brands_alpha($cat_id)
	{
		$alphabet   = range('A', 'Z');
		// append # to the alphabet
		$alphabet[]="#";
		foreach($alphabet as $letter)
		{
			// this call is cached
			$character_brands_arr = $this->get_brands_ids_alpha($cat_id,$letter);
			if(!is_null($character_brands_arr))
			{
				foreach($character_brands_arr as $character_arr)
				{
					foreach($character_arr as $brand_id)
					{
						//echo ("$letter -->".$character->brand_id."<br>");
						//$brand_id = $character->brand_id;
						$brand_name_arr = $this->brands_mdl->get_brand_name($brand_id);
						$brand_name = $brand_name_arr[0]->name;
						$brands_alpha[$letter][] = ["id"=>$brand_id,"name"=>$brand_name];
					}
				}
			}
			
		}
	//$oo = 55 ; 
	if(isset($brands_alpha))	return $brands_alpha;
	else return NULL ;
	}
	
	public function get_all_brands()
	{
		$all_brands = $this->brands_mdl->get_all_brands();
		return $all_brands;
	}
	
	public function get_cat_brands($cat_id,$first_letter)
	{
		$this->load->module("categories");
		$cat_id_range = $this->categories->get_all_subcat_ids($cat_id);
		
		$this->load->model("brands_mdl");
		$brands_in_cat = $this->brands_mdl->get_cat_brands($cat_id_range,$first_letter);
		
		echo "<pre>";
		var_dump($brands_in_cat);
		echo "</pre>";
		
		return $brands_in_cat;
	}
	
	/// view call here
	public function brands_list($cat_id =1)
	{
		
		$subcat_flag = 0;
		
		$women_sub_cat_ids = array(31,413,544,109);
		if (in_array($cat_id, $women_sub_cat_ids)) $subcat_flag = 2;
		$men_sub_cat_ids = array(168,1741,172,219);
		if (in_array($cat_id, $men_sub_cat_ids)) $subcat_flag = 166;
		$kids_sub_cat_ids = array(1037,839,1699,1099,1122,1135);
		if (in_array($cat_id, $kids_sub_cat_ids)) $subcat_flag = 323;
		$home_sub_cat_ids = array(837,838,805,621,736,746,1237,760,673);
		if (in_array($cat_id, $home_sub_cat_ids)) $subcat_flag = 806;
		
		$data['subcat_flag'] = $subcat_flag;
		$main_cats = array(2,166,323,806);
		$categories_ids  = array_merge($main_cats,$women_sub_cat_ids,$men_sub_cat_ids,$kids_sub_cat_ids,$home_sub_cat_ids);
		$categories_icons = $this->get_categories_icons($categories_ids);
		
		/*foreach($categories_icons as $key=>$value)
		{
			echo $key."->".$value."<img src=".$value." /><br>";
		}*/
		
		$data['categories_icons'] = $categories_icons;
		
		$data['category_id'] = $cat_id;
		//$data['brands_alpha'] = $this->get_brands_alpha($cat_id);
		//$data['left_categories_ids'] = $this->get_main_categories_ids_for_brands();
		
		//new !!! get brands from api 
		$data["brands_list"] = $this->get_available_brands_in_category($cat_id);
		
		
		//get wording for the page 
	   	$this->load->module('msg');
	   	$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
		$footer_data['brands'] = $this->msg->get_words("footer");
	   	$data['words_cat'] = $this->msg->get_words("brands");
		
		// for template_info
		$this->load->model('home_mdl');
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
		
		$data['template_info']   = $this->home_mdl->get_template_info();
        $this->load->view($data['template_info']['path'].'/common/css',$data);  
        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
         
        $this->load->view($data['template_info']['path'].'/brands_vew', $data);
        
        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
        $this->load->view($data['template_info']['path'].'/common/script_brands',$data); 
	}
	
	private function get_categories_icons($categories_ids)
	{
		$this->load->helper("url");
		$this->load->model("brands_mdl");
		$a = array();
		foreach($categories_ids as $cat_id )
		{
			
			try
			{
				if(empty($this->brands_mdl->get_cat_icon($cat_id)[0]->icon))
					throw new Exception("no icon for category ".$cat_id); 
				$cat_icon = $this->brands_mdl->get_cat_icon($cat_id)[0]->icon;
				$cat_icon = base_url().$cat_icon;
				$a [$cat_id]= $cat_icon;	
			} 
			catch (Exception $e) 
			{
				echo $e->getMessage()."<br/>";
			}
			
			
			
		}
		/*echo "<pre>";
		var_dump($a);
		echo "</pre>";*/
		return $a;
	}
	
	private function get_main_categories_ids_for_brands()
	{
		$this->load->module('categories');
		////////////////////////////$this->categories->get_first_subcat_children($)
		$data['women_clothing_cat'] 	= 544;
		$data['men_clothing_cat'] 		= 1741;
		
		$data['women_shoes_cat'] 		= 109;
		$data['men_shoes_cat'] 			= 219;
		
		$data['women_bags_cat'] 		= 31;
		$data['men_bags_cat'] 			= 168;
		
		$data['women_beauty_cat'] 		= 413;
		$data['men_grooming_cat'] 		= 172;
		
		$data['kids_cat'] 				= 323;
		$data['home_cat'] 				= 806;
		
		$data['women_jewelry_cat'] 		= 65;
		$data['men_jewelry_cat'] 		= 244;
		
		$data['women_accessories_cat'] 	= 3;
		$data['men_accessories_cat'] 	= 167;
		
		/*echo "<pre>";
		var_dump($data);
		echo "</pre>";*/
		
		return $data;	
	}
	
	//get available brands in a category
	public function get_available_brands_in_category($cat_id)
	{
		$api_key = API_KEY;
		
		$lang_id = $this->lng->get_n_set_language_id();
		
		$this->load->module("categories");
		$localized_cat_id = $this->categories->get_cat_localized_id($cat_id,$lang_id);
		
		$qurl_available_brands = 'http://api.shopstyle.com/api/v2/products/histogram?cat='.$localized_cat_id.'&pid='.$api_key.'&filters=Brand';
			
		$available_brands_json = file_get_contents($qurl_available_brands);
		$available_brands = json_decode($available_brands_json);
		
		// destroy the json file Save memory live better
		unset($available_brands_json);
		
		//$data['available_brands'] = $available_brands;
		
		//todo send them to the view instead of the old array 
		//echo "<pre>";
		//var_dump($available_brands);
		//echo "</pre>";
		
		return $available_brands;
	}
	
	
	
	// just phpinfo
	public  function info(){
		
		phpinfo();
		
	}
	
}

/* End of file brands.php */
/* Location: ./application/modules/brands/controllers/brands.php */