<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class categories extends MX_Controller {


	function __construct()
    {
        parent::__construct();
        
         //load the language module
		$this->load->module("lng");
       
       // call cache module
		$this->load->module("cachy");
        
        //$this->load->model('checkout_mdl'); // needed for the template info (template path)
    }

	
	public function index()
	{
		//load file
		$this->load->helper("url");
		$jsonFilename = file_get_contents(base_url()."application/modules/categories/controllers/categories.json");
		$json = json_decode($jsonFilename);
		
		//count num of objects in the json file
		$total_cat=0; 
		foreach($json->categories as $foo) $total_cat++;
		
		$A["json"] = $json;
		$A["total_cat"] = $total_cat;
		
		$this->load->view('categories_vew',$A);
		
		
	}
	
	// get_subcategories($cat_id)  will return somethinglike this 
	/*	
	Array
	(
    [0] => Array
        (
            [name] => Activewear Jackets
            [id] => 15
        )

    [1] => Array
        (
            [name] => Activewear Pants
            [id] => 16
        )
    ....
    */
    
	public function get_subcategories($cat_id)
	{
		$subcat_id_array = array();
		$subcat_name_array = array();
		$this->load->model("categories_mdl");
		$categories_id = $this->categories_mdl->get_cat_tree($cat_id);
		foreach($categories_id as $row)
		{
			//populate the array with categories id
			//todo maybe no need forelseifbut just use if 
			if($row->lev5_id) $subcat_id_array[] = $row->lev5_id ;
			elseif($row->lev4_id) $subcat_id_array[] = $row->lev4_id ;
			elseif($row->lev3_id) $subcat_id_array[] = $row->lev3_id ;
			elseif($row->lev2_id) $subcat_id_array[] = $row->lev2_id ;
		}
		
		$lang_id = $this->lng->get_n_set_language_id();	
					
		foreach($subcat_id_array as $key=>$value)
		{
			$category_name = $this->categories_mdl->get_cat_name($value,$lang_id);
			foreach($category_name as $row)
			{
				if($row->name) {$subcat_name_array[] = ["name"=>$row->name ,"id"=> $row->id_category] ;}
				elseif($row->shortName) {$subcat_name_array[] = ["name"=>$row->shortName ,"id"=> $row->id_category] ;} 
				elseif($row->localizedId) {$subcat_name_array[] = ["name"=>$row->localizedId ,"id"=> $row->id_category] ;} 
			}	
		}
		sort($subcat_name_array);
		
		//echo "<pre>";
		//print_r($subcat_name_array) ;
		//echo "</pre>";
		
		return $subcat_name_array;	
	}
	
	//get subcat with new options 
		public function get_subcategories_plus($cat_id)
	{
		$this->load->model('categories_mdl');
		
		$lang_id = $this->lng->get_n_set_language_id();	
		$subcat_id_array = array();
		$subcat_name_array = array();
		
		$categories_id =  $this->categories_mdl->get_first_subcat_children_all($cat_id,$lang_id);
		
		foreach($categories_id as $row)
		{
			//populate the array with categories id
			$subcat_id_array[] = $row->main_id ;
		}
		
		//delete redundent ids if any 
		$subcat_id_array = array_unique($subcat_id_array);
		
		foreach($subcat_id_array as $key=>$value)
		{
			$category_name = $this->categories_mdl->get_cat_options($value,$lang_id);
			foreach($category_name as $row)
			{
				if($row->name) {$subcat_name_array[] = 			  ["name"=>$row->name        ,"id"=> $row->id_category,"active"=> $row->active,"service_fee"=> $row->service_fee,"shipping_factor"=> $row->shipping_factor,"promotion_code"=> $row->promotion_code,"discount_money"=> $row->discount_money,"discount_percentage"=> $row->discount_percentage] ;}
				elseif($row->shortName) {$subcat_name_array[] =   ["name"=>$row->shortName   ,"id"=> $row->id_category,"active"=> $row->active,"service_fee"=> $row->service_fee,"shipping_factor"=> $row->shipping_factor,"promotion_code"=> $row->promotion_code,"discount_money"=> $row->discount_money,"discount_percentage"=> $row->discount_percentage] ;} 
				elseif($row->localizedId) {$subcat_name_array[] = ["name"=>$row->localizedId ,"id"=> $row->id_category,"active"=> $row->active,"service_fee"=> $row->service_fee,"shipping_factor"=> $row->shipping_factor,"promotion_code"=> $row->promotion_code,"discount_money"=> $row->discount_money,"discount_percentage"=> $row->discount_percentage] ;} 
			}	
		}
		sort($subcat_name_array);
		
		/*echo "<pre>";
		print_r($subcat_name_array) ;
		echo "</pre>";*/
		
		return $subcat_name_array;	
	}
	
	public function get_subcategories_plus_for_view($cat_id)
	{
		$this->load->model('categories_mdl');
		
		$lang_id = $this->lng->get_n_set_language_id();	
		$subcat_id_array = array();
		$subcat_name_array = array();
		
		$categories_id =  $this->categories_mdl->get_first_subcat_children_all_only_active($cat_id,$lang_id);
		
		foreach($categories_id as $row)
		{
			//populate the array with categories id
			$subcat_id_array[] = $row->main_id ;
		}
		
		//delete redundent ids if any 
		$subcat_id_array = array_unique($subcat_id_array);
		
		foreach($subcat_id_array as $key=>$value)
		{
			$category_name = $this->categories_mdl->get_cat_options($value,$lang_id);
			foreach($category_name as $row)
			{
				if($row->shortName) {$subcat_name_array[] =   ["name"=>$row->shortName   ,"id"=> $row->id_category] ;} 
			}	
		}
		sort($subcat_name_array);
		
		/*echo "<pre>";
		print_r($subcat_name_array) ;
		echo "</pre>";*/
		
		return $subcat_name_array;	
	}
	
	//get the subcategories id
	public function get_sub_cat_id($cat_id)
	{
		$oo = 55;
		$this->load->model("categories_mdl");
		$categories_ids = $this->categories_mdl->get_cat_tree($cat_id);
		$sub_cat_list_id_arr = array();
		foreach($categories_ids as $row)
		{
			// check for duplicate and NULL value
			if(!array_search($row->lev6_id,$sub_cat_list_id_arr )&& $row->lev6_id ) $sub_cat_list_id_arr[] = $row->lev6_id ;
			if(!array_search($row->lev5_id,$sub_cat_list_id_arr )&& $row->lev5_id ) $sub_cat_list_id_arr[] = $row->lev5_id ;
			if(!array_search($row->lev4_id,$sub_cat_list_id_arr )&& $row->lev4_id ) $sub_cat_list_id_arr[] = $row->lev4_id ;
			if(!array_search($row->lev3_id,$sub_cat_list_id_arr )&& $row->lev3_id ) $sub_cat_list_id_arr[] = $row->lev3_id ;
			if(!array_search($row->lev2_id,$sub_cat_list_id_arr )&& $row->lev2_id ) $sub_cat_list_id_arr[] = $row->lev2_id ;
			if(!array_search($row->lev1_id,$sub_cat_list_id_arr )&& $row->lev1_id ) $sub_cat_list_id_arr[] = $row->lev1_id ;
		}
		
		$sub_cat_list = "0";
		foreach($sub_cat_list_id_arr as $key=>$value)
		{
			$sub_cat_list = $sub_cat_list.",".$value;
		}
		
		//return $sub_cat_list;
		//echo "<pre>";
		//print_r($sub_cat_list) ;
		//echo "</pre>";
	
	}
	
	public function get_ancestors_categories($id)
	{
		$lang_id = $this->lng->get_n_set_language_id();	
					
		$this->load->model("categories_mdl");
		$current_cat = $this->categories_mdl->get_cat_name($id,$lang_id);
		$ancestors_cat[] = $current_cat[0];
		
		$is_root = false;
		while(!$is_root)
		{
			$parent_cat = $this->categories_mdl->get_parent_category($id,$lang_id);
			if(!$parent_cat) 
			{$is_root = TRUE;} 
			else {
			$ancestors_cat[] = $parent_cat[0];
			$id = $parent_cat[0]->id_category;
			}
		}
		
		/*echo "<pre>";
		print_r($ancestors_cat) ;
		echo "</pre>";*/
		
		return $ancestors_cat;
		
	}
	
	public function get_product_category_id($id)
	{
		$this->load->model("categories_mdl");
		$category_id_arr  = $this->categories_mdl->get_product_category($id);
		if(!empty($category_id_arr)) 
			$category_id = $category_id_arr[0]->category_id;
		else 
			//if couldn't find a category for this item then return women category id as a fallback id
			$category_id = 2;
		
		//echo $category_id;
		
		return $category_id;
	}
	
	
	//get the id from the idd 
	private function get_cat_id($idd)
	{
		$this->load->model("categories_mdl");
		return $this->categories_mdl->get_cat_id($idd);
	}
	
	public function get_subcat_details($idd)
	{
		//load file
		$this->load->helper("url");
		$jsonFilename = file_get_contents(base_url()."application/modules/categories/controllers/categories.json");
		$json = json_decode($jsonFilename);
		
		//count num of objects in the json file
		$total_cat=0; 
		foreach($json->categories as $foo) $total_cat++;	
		
		$lang_id = $this->lng->get_n_set_language_id();	
	
		$this->load->model("categories_mdl");
		$subcategories_details  =  $this->categories_mdl->get_subcat($idd,$lang_id);
	
		/*echo "<pre>";
			print_r($subcategories_details) ;
		echo "</pre>";*/
		
		$this->load->module("product");
		$cat_id = $this->get_cat_id($idd); 
		
		
		
		//echo $cat_id[0]->id;
		
		$cat_products = $this->product->get_cat_products($cat_id[0]->id);
		
		/*echo "----- <br>";*/
		
		/*echo "<pre>";
			print_r($cat_products) ;
		echo "</pre>";*/
		
		$data = array();
		$data[] = ["subcategories_details"=>$subcategories_details , "cat_products" => $cat_products];
		
		/*echo "<pre>";
			print_r($data) ;
		echo "</pre>";*/
	}
	
	
	/**
	* will return the 1st subcategories a given category id
	* @param int $id
	* 
	* @return category list 
	*/
	public function get_first_subcat_children($id)
	{
		$this->load->model("categories_mdl");
		$lang_id = $this->lng->get_n_set_language_id();	
		
		$cat_list =  $this->categories_mdl->get_first_subcat_children($id,$lang_id);
			
		/*echo "<pre>";
			print_r($cat_list) ;
		echo "</pre>";*/
		
		return $cat_list; 
		
	}
	
	//this method seems to be deprecated  and need to be deleted after further tests use get_all_subcat_ids instead
	public function get_all_children_id($id)
	{
		$this->load->model("categories_mdl");
		$children_cat_id  = $this->categories_mdl->get_all_children_id($id);
		
		//echo "<pre>";
		//	print_r($children_cat_id) ;
		//echo "</pre>";
		
	}
	
  //// cache this result : $first_subcat_children
  private function cache_first_subcat_children($method_name,$var_name,$cat_id,$lang_id)
  {
  		//if cache is enabled
  		if(CACHE_IS_ON)
  		{
			$this->load->module("cachy");
			$rcache = $this->cachy->new_redis_instance();
			
			$cache_id = $method_name.":".$var_name.":".$cat_id.":".$lang_id;
			$cache_content = json_decode($rcache->get($cache_id)) ;
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from categories->".$method_name.":".$var_name.")<br>";
				$first_subcat_children = $cache_content;
			}
			//else cache it and return result
			else 
			{
				$first_subcat_children  =  $this->categories_mdl->get_first_subcat_children($cat_id,$lang_id);	
				//save to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from categories->".$method_name.":".$var_name.")<br>";
				$rcache->set($cache_id, json_encode($first_subcat_children))or die ("Failed to save data to cash server");
			}
		}
		// if cache is disabled 
		else
		{
			$first_subcat_children  =  $this->categories_mdl->get_first_subcat_children($cat_id,$lang_id);	
			/*
			if((int)$cat_id == 109)
				{
					//debug women shoes category
					$oo = 55;
				}
			*/
		}
	return $first_subcat_children;
  }
	
	
	
	/**
	 * this function returns an array with all the subcategories for the menu.
	*/
	public function get_categories_list()
	{
		$lang_id = $this->lng->get_n_set_language_id();	
		
		$this->load->model("categories_mdl");
		
		$oo=55;
		
		//$this->load->module("cachy");
		//$rcache = $this->cachy->new_redis_instance();
		
		// caching categories for the categories menu if cache is enabled
		{
			$women_clothing_cat = $this->cache_first_subcat_children("get_categories_list","women_clothing_cat",544,$lang_id);
			$men_clothing_cat = $this->cache_first_subcat_children("get_categories_list","men_clothing_cat",1741,$lang_id);
			
			$women_shoes_cat = $this->cache_first_subcat_children("get_categories_list","women_shoes_cat",109,$lang_id);
			$men_shoes_cat = $this->cache_first_subcat_children("get_categories_list","men_shoes_cat",219,$lang_id);
			
			$women_bags_cat = $this->cache_first_subcat_children("get_categories_list","women_bags_cat",31,$lang_id);
			$men_bags_cat = $this->cache_first_subcat_children("get_categories_list","men_bags_cat",168,$lang_id);
			
			$women_beauty_cat = $this->cache_first_subcat_children("get_categories_list","women_beauty_cat",413,$lang_id);
			$men_grooming_cat = $this->cache_first_subcat_children("get_categories_list","men_grooming_cat",172,$lang_id);
			
			$kids_boys_girls_clothes = $this->cache_first_subcat_children("get_categories_list","kids_boys_girls_clothes",323,$lang_id);
			$kids_stuff = $this->cache_first_subcat_children("get_categories_list","kids_stuff",1099,$lang_id);
			
			$kids_cat =  array_merge($kids_stuff,$kids_boys_girls_clothes) ;
			
			
			$home_cat = $this->cache_first_subcat_children("get_categories_list","home_cat",806,$lang_id);

			$women_jewelry_cat = $this->cache_first_subcat_children("get_categories_list","women_jewelry_cat",65,$lang_id);
			$men_jewelry_cat = $this->cache_first_subcat_children("get_categories_list","men_jewelry_cat",244,$lang_id);
			
			$women_accessories_cat = $this->cache_first_subcat_children("get_categories_list","women_accessories_cat",3,$lang_id);
			$men_accessories_cat = $this->cache_first_subcat_children("get_categories_list","men_accessories_cat",167,$lang_id);
		}
		
		
		$data ["women_cat"] =   $women_clothing_cat;
		$data ["men_cat"] =   	$men_clothing_cat;
		
		$data ["women_shoes_cat"] =   $women_shoes_cat;
		$data ["men_shoes_cat"] =   	$men_shoes_cat;
		
		$data ["women_bags_cat"] =   $women_bags_cat;
		$data ["men_bags_cat"] =   	  $men_bags_cat;
		
		$data ["women_beauty_cat"] =   $women_beauty_cat;
		$data ["men_grooming_cat"] =   $men_grooming_cat;
		
		$data ["kids_cat"] =   $kids_cat;
		$data ["home_cat"] =   $home_cat;
		
		$data ["women_jewelry_cat"] =   $women_jewelry_cat;
		$data ["men_jewelry_cat"] =   	$men_jewelry_cat;
		
		$data ["women_accessories_cat"] =   $women_accessories_cat;
		$data ["men_accessories_cat"] =   	$men_accessories_cat;
		
		//echo "<pre>";
		//	print_r($data);
		//echo "</pre>";
		
		return $data;
		
	}
	
	
	// this function gets the ids of all the subcategories of a certain id   like so (2,85,103)
	
	/**
	* this method will return the list of all the subcategories of a certain category id  
	* 
	* @param int $id
	* 
	* @return csv list of category ids
	*/
	
	
	public function get_all_subcat_ids($id)
	{
		////////caching start//////////
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $cat_id_range
			$signature_id = $id; 
			$cache_id ="categories:get_all_subcat_ids:".$signature_id;
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from categories->get_all_subcat_ids)<br>";
				$cat_id_range = $cache_content;
			}
			else 
			{
				// long work here
				$this->load->model("categories_mdl");
				$resut_all_subcat_ids = $this->categories_mdl->get_cat_tree($id);
				
				$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($resut_all_subcat_ids));
				foreach($it as $v) 
				{
				  $all_subcat_ids[] =  $v;
				}
				// delete duplicates
				$all_subcat_ids = array_unique($all_subcat_ids);
				// reset the internal index
				$all_subcat_ids = array_values($all_subcat_ids);
				
				for ($i = 0 ; $i < sizeof($all_subcat_ids); $i++)
				{
					if($all_subcat_ids[$i] == "") unset($all_subcat_ids[$i]);
				}
				// reset the internal index 
				$all_subcat_ids = array_values($all_subcat_ids);
				
				// the string that will be used in the in SQL statement
				$cat_id_range = null;
				$num_of_items = sizeof($all_subcat_ids);
				
				//if the array contains only 1 category id
				if($num_of_items == 1) $cat_id_range = $all_subcat_ids[0];
				else 
				{
					
					for ($i = 0 ; $i < sizeof($all_subcat_ids); $i++)
					{
						// if 1st element
						if($i == 0)
						{	
							$cat_id_range .= $all_subcat_ids[$i].",";
						}
						// if its not the last element
						elseif($i != sizeof($all_subcat_ids)-1)
						{
							$cat_id_range .= $all_subcat_ids[$i].",";
						}
						// if its the last element
						else
						{
							$cat_id_range .= $all_subcat_ids[$i];
						}
					}
				}
				
				//save long work output to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from categories->get_all_subcat_ids)<br>";
				$rcache->set($cache_id, json_encode($cat_id_range))or die ("Failed to save data to cash server");
			}
		}
		// if cache is disabled
		else
		{
			// long work here
			$this->load->model("categories_mdl");
			$resut_all_subcat_ids = $this->categories_mdl->get_cat_tree($id);
			
			$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($resut_all_subcat_ids));
			foreach($it as $v) 
			{
			  $all_subcat_ids[] =  $v;
			}
			// delete duplicates
			$all_subcat_ids = array_unique($all_subcat_ids);
			// reset the internal index
			$all_subcat_ids = array_values($all_subcat_ids);
			
			for ($i = 0 ; $i < sizeof($all_subcat_ids); $i++)
			{
				if($all_subcat_ids[$i] == "") unset($all_subcat_ids[$i]);
			}
			// reset the internal index 
			$all_subcat_ids = array_values($all_subcat_ids);
			
			// the string that will be used in the in SQL statement
			$cat_id_range = null;
			$num_of_items = sizeof($all_subcat_ids);
			
			//if the array contains only 1 category id
			if($num_of_items == 1) $cat_id_range = $all_subcat_ids[0];
			else 
			{
				
				for ($i = 0 ; $i < sizeof($all_subcat_ids); $i++)
				{
					// if 1st element
					if($i == 0)
					{	
						$cat_id_range .= $all_subcat_ids[$i].",";
					}
					// if its not the last element
					elseif($i != sizeof($all_subcat_ids)-1)
					{
						$cat_id_range .= $all_subcat_ids[$i].",";
					}
					// if its the last element
					else
					{
						$cat_id_range .= $all_subcat_ids[$i];
					}
				}
			}
		}
		////////caching finish//////////
		
		return $cat_id_range;
	}


	public function footer()
	{
		//load file
		$this->load->helper("url");
		$jsonFilename = file_get_contents(base_url()."application/modules/categories/controllers/categories.json");
		$json = json_decode($jsonFilename);

		//count num of objects in the json file
		$total_cat=0;
		foreach($json->categories as $foo) $total_cat++;

		$A["json"] = $json;
		$A["total_cat"] = $total_cat;

		$this->load->view('categories_vew_footer',$A);
	}	
	
	public function get_cat_meta_info($id,$lang_id)
	{
		$this->load->model("categories_mdl");
		$cat_meta_info = $this->categories_mdl->get_cat_meta_info($id,$lang_id);
		return $cat_meta_info;
	}
	
	public function get_avlbl_colors_in_cat($subcat_range_id,$q_str)
	{
		$this->load->model("categories_mdl");
		$avlbl_colors_in_cat = $this->categories_mdl->get_avlbl_colors_in_cat($subcat_range_id,$q_str);
		return $avlbl_colors_in_cat;
	}
	
	public function get_avlbl_brands_in_cat($subcat_range_id,$q_str)
	{
		$this->load->model("categories_mdl");
		$avlbl_brands_in_cat = $this->categories_mdl->get_avlbl_brands_in_cat($subcat_range_id,$q_str);
		return $avlbl_brands_in_cat;
	}
	
	public function get_avlbl_sizes_in_cat($subcat_range_id,$q_str)
	{
		$this->load->model("categories_mdl");
		$avlbl_sizes_in_cat = $this->categories_mdl->get_avlbl_sizes_in_cat($subcat_range_id,$q_str);
		return $avlbl_sizes_in_cat;
	}
	
	public function get_avlbl_categories_for_srch($q_str,$lang_id)
	{
		$this->load->model("categories_mdl");
		$avlbl_categories_for_srch = $this->categories_mdl->get_avlbl_categories_for_srch($q_str,$lang_id);
		return $avlbl_categories_for_srch;
	}
	
	// hello 2016 
	
	public function get_cat_localized_id($cat_id,$lang_id)
	{
		$this->load->model("categories_mdl");
		$localized_id = $this->categories_mdl->get_localized_id($cat_id,$lang_id);
		return $localized_id[0]->localizedId;	
	}
	
	/**
	* activates / desactivates a category and its subcategories
	* 
	* @param int $node_cat_id
	* @param bool $status
	* 
	* @return bool
	*/
	public function set_category_tree_status()
	{
		$node_cat_id = $this->input->get('node_cat_id');
		$status = $this->input->get('node_status');
		
		$this->load->model("categories_mdl");
		$category_tree = $this->categories_mdl->get_cat_tree($node_cat_id);
		
		//convert multidimensional array into 1 dimension
		$subcat_ids = $this->flat_array($category_tree);
		
		//convert array to csv string
		$subcat_ids_csv = $this->array2csv($subcat_ids);
		
		$flag = $this->categories_mdl->set_category_tree_status($subcat_ids_csv,$status);
		
		echo $flag ;
		
		//echo $subcat_ids_csv;
	}
	
	/**
	* sets the service fee status of a category and its subcategories 
	* 
	* @param int $node_cat_id
	* @param bool $status
	* 
	* @return bool
	*/
	public function set_category_tree_service_fee()
	{
		$node_cat_id = $this->input->get('node_cat_id');
		$status = $this->input->get('node_status');
		
		$this->load->model("categories_mdl");
		$category_tree = $this->categories_mdl->get_cat_tree($node_cat_id);
		
		//convert multidimensional array into 1 dimension
		$subcat_ids = $this->flat_array($category_tree);
		
		//convert array to csv string
		$subcat_ids_csv = $this->array2csv($subcat_ids);
		
		$flag = $this->categories_mdl->set_category_tree_service_fee($subcat_ids_csv,$status);
		
		echo $flag ;
		
		//echo $subcat_ids_csv;
	}
	
	/**
	*  sets the shipping factor of a category and its subcategories 
	* 
	* @param int $node_cat_id
	* @param int $shipping_factor
	* 
	* @return bool
	*/
	public function set_category_tree_shipping_factor()
	{
		$node_cat_id 	 = $this->input->get('node_cat_id');
		$shipping_factor = $this->input->get('shipping_factor');
		
		$this->load->model("categories_mdl");
		$category_tree = $this->categories_mdl->get_cat_tree($node_cat_id);
		
		//convert multidimensional array into 1 dimension
		$subcat_ids = $this->flat_array($category_tree);
		
		//convert array to csv string
		$subcat_ids_csv = $this->array2csv($subcat_ids);
		
		$flag = $this->categories_mdl->set_category_tree_shipping_factor($subcat_ids_csv,$shipping_factor);
		
		echo $flag ;
		
		//echo $subcat_ids_csv;
	}
	
	/**
	*  sets the promotion code of a category and its subcategories 
	* 
	* @param int $node_cat_id
	* @param string $shipping_factor
	* 
	* @return bool
	*/
	public function set_category_tree_promotion_code()
	{
		$node_cat_id = $this->input->get('node_cat_id');
		$promotion_code = $this->input->get('promotion_code');
		
		$promotion_code = strtoupper($promotion_code);
		$promotion_code = str_replace(' ', '', $promotion_code);
		
		$this->load->model("categories_mdl");
		$category_tree = $this->categories_mdl->get_cat_tree($node_cat_id);
		
		//convert multidimensional array into 1 dimension
		$subcat_ids = $this->flat_array($category_tree);
		
		//convert array to csv string
		$subcat_ids_csv = $this->array2csv($subcat_ids);
		
		$flag = $this->categories_mdl->set_category_tree_promotion_code($subcat_ids_csv,$promotion_code);
		
		echo $flag ;
		
		//echo $subcat_ids_csv;
	}
	
	/**
	*  sets the amount of money to discount for a category
	*  and its subcategories and clear the percentage of money
	*  to discount for the same category and its subcategories 
	* 
	* @param int $node_cat_id
	* @param float $shipping_factor
	* 
	* @return bool
	*/
	public function set_category_tree_discount_money()
	{
		$node_cat_id = $this->input->get('node_cat_id');
		$discount_money = $this->input->get('discount_money');
		
		
		$this->load->model("categories_mdl");
		$category_tree = $this->categories_mdl->get_cat_tree($node_cat_id);
		
		//convert multidimensional array into 1 dimension
		$subcat_ids = $this->flat_array($category_tree);
		
		//convert array to csv string
		$subcat_ids_csv = $this->array2csv($subcat_ids);
		
		$flag = $this->categories_mdl->set_category_tree_discount_money($subcat_ids_csv,$discount_money);
		
		echo $flag ;
		
		//echo $subcat_ids_csv;
	}
	
	/**
	*  sets the percentage of money to discount for a category 
	*  and its subcategories and clear the amount of money 
	*  to discount for the same category and its subcategories 
	* 
	* @param int $node_cat_id
	* @param float $shipping_factor
	* 
	* @return bool
	*/
	public function set_category_tree_discount_percentage()
	{
		$node_cat_id = $this->input->get('node_cat_id');
		$discount_percentage = $this->input->get('discount_percentage');
		
		$this->load->model("categories_mdl");
		$category_tree = $this->categories_mdl->get_cat_tree($node_cat_id);
		
		//convert multidimensional array into 1 dimension
		$subcat_ids = $this->flat_array($category_tree);
		
		//convert array to csv string
		$subcat_ids_csv = $this->array2csv($subcat_ids);
		
		$flag = $this->categories_mdl->set_category_tree_discount_percentage($subcat_ids_csv,$discount_percentage);
		
		echo $flag ;
		
		//echo $subcat_ids_csv;
	}
	
	public function get_categories_for_menu()
	{
		$lang_id = $this->lng->get_n_set_language_id();	
		$this->load->model("categories_mdl");
		
		$categories_for_menu = $this->categories_mdl->get_categories_for_menu($lang_id);
		
		/*echo "<pre>";
		var_dump($categories_for_menu) ;
		echo "</pre>";*/
		
		return $categories_for_menu;
	}
	
	public function get_category_options($cat_id)
	{
		$this->load->model("categories_mdl");
		$category_money_discount = $this->categories_mdl->get_category_options($cat_id);
		return $category_money_discount;
	}
	
	
	
	
	
	// private methods below ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	private function flat_array($array_to_flaten)
	{
		$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($array_to_flaten));
		foreach($it as $v) 
		{
		  //ignore nulls
		  if($v != NULL)
		  {
		  	$output_array[] =  $v;
		  }
		}
		// delete duplicates
		$output_array = array_unique($output_array);
		sort($output_array);
		
		//the 1 dim array 
		return $output_array;
	}
	
	private function array2csv($array)
	{
		$array_csv = "";
		$array_csv .= implode(",", $array) . "\r\n";
		
		return $array_csv;
	}
	
	

	
	
	
}

/* End of file categories.php */
/* Location: .application/modules/categories/controllers/categories.php */