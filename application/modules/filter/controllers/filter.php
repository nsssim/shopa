<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class filter extends MX_Controller {

 function __construct()
    {
        parent::__construct();
        
        $this->load->model('filter_mdl');
        
        // call cache module
		$this->load->module("cachy");
        
         //load the language module
		$this->load->module("lng");
        
	 
    }

	/**
	* calls the subfilter methods and manage partial chaching
	*	                   ______________    ___________    __________    ___________    ____________    __________ 
	*                     |              |  |           |  |          |  |           |  |            |  |          |
	*	 (Q)---[price]---/\---[category]---/\---[brand]---/\---[size]---/\---[color]---/\---[onsale]---/\---[find]---(R)
	*	         |               |                |              |             |               |              |
	*	      {cache}         {cache}          {cache}        {cache}       {cache}         {cache}        {cache}   
	*
	* @param string $product_name_like
	* @param int $min_price
	* @param int $max_price
	* @param string $price_sorting
	* @param int $offset
	* @param int $num_of_items
	* 
	* @return string a csv string of product_id	
	*/	
	
	
	// ~~~~~~~ main filter function ~~~~~~~~~~
	// this is the main filter method that will call the subfilters methods
	public function filterchain($product_name_like,$min_price,$max_price,$price_sorting,$offset,$num_of_items,$category_id=NULL,$brand_range_id=NULL,$size_range_id=NULL,$color_range_id=NULL,$is_on_sale=FALSE)
	{
		$output = NULL;
		
		//'<strong>Filter synoptic</strong><br><img src="http://s28.postimg.org/ecdkw4m0b/filter_synoptic.png">';
		
		$lang_id = $this->lng->get_n_set_language_id();
		
		//1st filter - price 
		$output_price_filter =  $this->filter_product_by_price($product_name_like,$min_price,$max_price,$price_sorting,$offset,$num_of_items);
		$output = $output_price_filter;
		
		//echo "<br><strong>output_price_filter: </strong>".$output;
		
		//$category_id = 2; // just for testing 
		
		//2nd filter - category 
		if($category_id and $output)
		{
			$output_category_filter = $this->filter_product_by_categoy($output,$category_id);
			$output = $output_category_filter;
			
			if(is_null($output_category_filter))
			{
				$offset += $num_of_items;
				$product_input_ids = $this->filter_product_by_price($product_name_like,$min_price,$max_price,$price_sorting,$offset,$num_of_items);
				$output_category_filter = $this->filter_product_by_categoy($output,$category_id);
				$output = $output_category_filter;
				
			}
			//echo "<br><strong>output_category_filter: </strong>".$output;
		}
		
		//3rd filter - brand
		if($brand_range_id and $output)
		{
			$output_brand_filter = $this->filter_product_by_brand($output,$brand_range_id);
			$output = $output_brand_filter;
			//echo "<br><strong>output_brand_filter: </strong>".$output;
		}
		
		//4th filter - size
		if($size_range_id and $output)
		{
			//note the $size_range_id is the cannonical size idd
			$output_size_filter = $this->filter_product_by_size($output,$size_range_id);
			$output = $output_size_filter;
			//echo "<br><strong>output_size_filter: </strong>".$output;
		}
		
	
		//5th filter 
		if($color_range_id and $output)
		{
			//note the $color_range_id is the cannonical color idd
			$output_color_filter = $this->filter_product_by_color($output,$color_range_id);
			$output = $output_color_filter;
			//echo "<br><strong>output_color_filter: </strong>".$output;
		}
		
		//$is_on_sale = 1 ;
		
		//6th filter 
		if($is_on_sale == "FALSE") $is_on_sale = NULL;
		if($is_on_sale and $output )
		{
			$output_sale_filter = $this->filter_product_on_sale($output);
			$output = $output_sale_filter;
			//echo "<br><strong>output_sale_filter: </strong><br>".$output;
		}
		
		return $output;	
	}
	
	public function get_product_list_count($product_name_like,$min_price,$max_price,$price_sorting,$offset,$num_of_items,$category_id=NULL,$brand_range_id=NULL,$size_range_id=NULL,$color_range_id=NULL,$is_on_sale=FALSE)
	{
		////////caching start//////////
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $search_count
			$id = sha1($product_name_like."-".$min_price."-".$max_price."-".$category_id."-".$brand_range_id."-".$size_range_id."-".$color_range_id."-".$is_on_sale);
			$cache_id ="filter:get_product_list_count:".$id;
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from filter->get_product_list_count)<br>";
				$search_count = $cache_content;
			}
			else 
			{
				$porduct_ids = $this->filterchain($product_name_like,$min_price,$max_price,$price_sorting,$offset,$num_of_items,$category_id,$brand_range_id,$size_range_id,$color_range_id,$is_on_sale);
		
				$search_count_arr = explode(",", $porduct_ids);
				//remove duplicates
				$search_count_arr = array_unique($search_count_arr);
				$search_count = count($search_count_arr);
				
				//save long work output to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from filter->get_product_list_count)<br>";
				$rcache->set($cache_id, json_encode($search_count))or die ("Failed to save data to cash server");
			}
		}
		// if cache is disabled
		else
		{
			$porduct_ids = $this->filterchain($product_name_like,$min_price,$max_price,$price_sorting,$offset,$num_of_items,$category_id,$brand_range_id,$size_range_id,$color_range_id,$is_on_sale);
		
			$search_count_arr = explode(",", $porduct_ids);
			//remove duplicates
			$search_count_arr = array_unique($search_count_arr);
			$search_count = count($search_count_arr);
		}
		////////caching finish//////////

		return $search_count;
		
		//echo "--------->".$search_count;
		
	}
	
	public function get_product_list($product_name_like,$min_price,$max_price,
									 $price_sorting,$offset,$num_of_items,$category_id=NULL,
									 $brand_range_id=NULL,$size_range_id=NULL,
									 $color_range_id=NULL,$is_on_sale=FALSE)
	{
		$porduct_ids = $this->filterchain($product_name_like,$min_price,$max_price,$price_sorting,
										  $offset,$num_of_items,$category_id,$brand_range_id,
										  $size_range_id,$color_range_id,$is_on_sale);
		
		if($porduct_ids)
		{
			$output = $this->get_product_partial_details($porduct_ids);
			
			/*echo "<br><strong>output_find: </strong><br>";
			echo "<pre>";
			print_r($output);
			echo "</pre>";*/
		
		}
		else
		{
			$output = NULL;
		}
		
		return $output;
	}
	
	
	
	
	
	//=========================================================================================================================
		
	/**
	* this is the price filter method that gets a search term as input and outputs a list of product ids 
	* of products containing that term and matching the prile range [$min_price,$max_price] for the next filter, 
	* this filter is not optional and all the search terms will pass through this filter 
	* 
	* @param string $product_name_like
	* @param int $min_price
	* @param int $max_price
	* @param string $price_sorting
	* @param int $offset
	* @param int $num_of_items
	* 
	* @return string a csv string of product_id	
	*/
	public function filter_product_by_price($product_name_like,$min_price,$max_price,$price_sorting,$offset,$num_of_items)
	{
		$lang_id = $this->lng->get_n_set_language_id();		
		
		////////caching start//////////
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $output_price_filter
			$id = sha1($product_name_like."-".$min_price."-".$max_price."-".$price_sorting."-".$offset."-".$num_of_items);
			$cache_id ="filter:filter_product_by_price:".$id;
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from filter->filter_product_by_price)<br>";
				$output_price_filter = $cache_content;
			}
			else 
			{
				$product_by_price_arr = $this->filter_mdl->find_product_by_price($lang_id,$product_name_like,$min_price,$max_price,$price_sorting,$offset,$num_of_items);
		
				if(!empty($product_by_price_arr))
				{
				foreach($product_by_price_arr as $product_by_price){ $ids[] = $product_by_price->id;}
				$output_price_filter = join(',',$ids); //output of the price filter 
				}
				else 
				{
					$output_price_filter = NULL;
				}
				//save to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from filter->filter_product_by_price)<br>";
				$rcache->set($cache_id, json_encode($output_price_filter))or die ("Failed to save data to cash server");
			}
		}
		// if cache is disabled
		else
		{
			$product_by_price_arr = $this->filter_mdl->find_product_by_price($lang_id,$product_name_like,$min_price,$max_price,$price_sorting,$offset,$num_of_items);
		
			if(!empty($product_by_price_arr))
			{
			foreach($product_by_price_arr as $product_by_price){ $ids[] = $product_by_price->id;}
			$output_price_filter = join(',',$ids); //output of the price filter 
			}
			else 
			{
				$output_price_filter = NULL;
			}
		}
		////////caching finish//////////
		
		return $output_price_filter ;
	}
	
	
	/**
	* gets a range of product_id as input and gets all the products that belongs to a category and its descendents subcategories 
	* 
	* @param undefined $product_input_ids
	* @param undefined $category_range_id
	* 
	* @return string a csv string of product_id	
	*/
	public function filter_product_by_categoy($product_input_ids,$category_id)
	{
		
		////////caching start//////////
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $product_output_category_ids
			$id = sha1($product_input_ids."-".$category_id);
			$cache_id ="filter:filter_product_by_categoy:".$id;
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from filter->filter_product_by_categoy)<br>";
				$product_output_category_ids = $cache_content;
			}
			else 
			{
				$this->load->module("categories");

				// /!\carefull this range starts with open parenthesis ( and finishes with close parenthesis ) unlike other ranges since I made it long ago
				$category_range_id = $this->categories->get_all_subcat_ids($category_id);
				
				
				$product_by_category_arr = $this->filter_mdl->find_product_by_categoy($product_input_ids,$category_range_id);
				
				/*echo "<pre>";
				print_r($product_by_category_arr);
				echo "</pre>";*/
				
				if(!empty($product_by_category_arr))
				{
					foreach($product_by_category_arr as $product_by_category){ $ids[] = $product_by_category->id;}
					$product_output_category_ids = join(',',$ids); //output of the category filter 
				}
				else 
				{
					$product_output_category_ids = NULL;
				}
				
				//save to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from filter->filter_product_by_categoy)<br>";
				$rcache->set($cache_id, json_encode($product_output_category_ids))or die ("Failed to save data to cash server");
			}
		}
		// if cache is disabled
		else
		{
			$this->load->module("categories");

			// /!\carefull this range starts with open parenthesis ( and finishes with close parenthesis ) unlike other ranges since I made it long ago
			$category_range_id = $this->categories->get_all_subcat_ids($category_id);
			
			
			$product_by_category_arr = $this->filter_mdl->find_product_by_categoy($product_input_ids,$category_range_id);
			
			/*echo "<pre>";
			print_r($product_by_category_arr);
			echo "</pre>";*/
			
			if(!empty($product_by_category_arr))
			{
				foreach($product_by_category_arr as $product_by_category){ $ids[] = $product_by_category->id;}
				$product_output_category_ids = join(',',$ids); //output of the category filter 
			}
			else 
			{
				$product_output_category_ids = NULL;
			}
			
			//return $product_output_category_ids;
		}
		////////caching finish//////////
				
		return $product_output_category_ids;
		
	}
	
	
	public function filter_product_by_brand($product_input_ids,$brand_range_id)
	{
		////////caching start//////////
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $product_output_brand_ids
			$id = sha1($product_input_ids."-".$brand_range_id);
			$cache_id ="filter:filter_product_by_brand:".$id;
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from filter->filter_product_by_brand)<br>";
				$product_output_brand_ids = $cache_content;
			}
			else 
			{
				$product_by_brand_arr = $this->filter_mdl->find_product_by_brand($product_input_ids,$brand_range_id);
		
				if(!empty($product_by_brand_arr))
				{
					foreach($product_by_brand_arr as $product_by_brand){ $ids[] = $product_by_brand->id;}
					$product_output_brand_ids = join(',',$ids); //output of the brand filter 
				}
				else 
				{
					$product_output_brand_ids = NULL;
				}
				
				//save to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from filter->filter_product_by_brand)<br>";
				$rcache->set($cache_id, json_encode($product_output_brand_ids))or die ("Failed to save data to cash server");
			}
		}
		// if cache is disabled
		else
		{
			$product_by_brand_arr = $this->filter_mdl->find_product_by_brand($product_input_ids,$brand_range_id);
		
			if(!empty($product_by_brand_arr))
			{
				foreach($product_by_brand_arr as $product_by_brand){ $ids[] = $product_by_brand->id;}
				$product_output_brand_ids = join(',',$ids); //output of the brand filter 
			}
			else 
			{
				$product_output_brand_ids = NULL;
			}
		}
		////////caching finish//////////
		
		return $product_output_brand_ids;
		
	}
	
	public function filter_product_by_size($product_input_ids,$size_range_id)
	{
		////////caching start//////////
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $product_output_size_ids
			$id = sha1($product_input_ids."-".$size_range_id);
			$cache_id ="cachy:filter_product_by_size:".$id;
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from cachy->filter_product_by_size)<br>";
				$product_output_size_ids = $cache_content;
			}
			else 
			{
				$product_by_size_arr = $this->filter_mdl->find_product_by_size($product_input_ids,$size_range_id);

				if(!empty($product_by_size_arr))
				{
					foreach($product_by_size_arr as $product_by_size){ $ids[] = $product_by_size->id;}
					$product_output_size_ids = join(',',$ids); //output of the brand filter 
				}
				else 
				{
					$product_output_size_ids = NULL;
				}
				
				//save long work output to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from cachy->filter_product_by_size)<br>";
				$rcache->set($cache_id, json_encode($product_output_size_ids))or die ("Failed to save data to cash server");
			}
		}
		// if cache is disabled
		else
		{
			$product_by_size_arr = $this->filter_mdl->find_product_by_size($product_input_ids,$size_range_id);

			if(!empty($product_by_size_arr))
			{
				foreach($product_by_size_arr as $product_by_size){ $ids[] = $product_by_size->id;}
				$product_output_size_ids = join(',',$ids); //output of the brand filter 
			}
			else 
			{
				$product_output_size_ids = NULL;
			}
		}
		////////caching finish//////////
		
		
		return $product_output_size_ids;
	}
	
	
	public function filter_product_by_color($product_input_ids,$color_range_id)
	{
		////////caching start//////////
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $product_output_color_ids
			$id = sha1($product_input_ids."-".$color_range_id);
			$cache_id ="filter:filter_product_by_color:".$id;
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from filter->filter_product_by_color)<br>";
				$product_output_color_ids = $cache_content;
			}
			else 
			{
				$product_by_color_arr = $this->filter_mdl->find_product_by_color($product_input_ids,$color_range_id);
				
				if(!empty($product_by_color_arr))
				{
					foreach($product_by_color_arr as $product_by_color){ $ids[] = $product_by_color->id;}
					$product_output_color_ids = join(',',$ids); //output of the brand filter 
				}
				else 
				{
					$product_output_color_ids = NULL;
				}
				
				//save long work output to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from filter->filter_product_by_color)<br>";
				$rcache->set($cache_id, json_encode($product_output_color_ids))or die ("Failed to save data to cash server");
			}
		}
		// if cache is disabled
		else
		{
			$product_by_color_arr = $this->filter_mdl->find_product_by_color($product_input_ids,$color_range_id);
			
			if(!empty($product_by_color_arr))
			{
				foreach($product_by_color_arr as $product_by_color){ $ids[] = $product_by_color->id;}
				$product_output_color_ids = join(',',$ids); //output of the brand filter 
			}
			else 
			{
				$product_output_color_ids = NULL;
			}
		}
		////////caching finish//////////

		return $product_output_color_ids;
	}
	

	public function filter_product_on_sale($product_input_ids)
	{
		////////caching start//////////
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $product_output_sale_ids
			$id = $product_input_ids;
			$cache_id ="filter:filter_product_on_sale:".$id;
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from filter->filter_product_on_sale)<br>";
				$product_output_sale_ids = $cache_content;
			}
			else 
			{
				$product_by_sale_arr = $this->filter_mdl->find_product_by_sale($product_input_ids);
		
				if(!empty($product_by_sale_arr))
				{
					foreach($product_by_sale_arr as $product_by_sale){ $ids[] = $product_by_sale->id;}
					$product_output_sale_ids = join(',',$ids); //output of the brand filter 
				}
				else 
				{
					$product_output_sale_ids = NULL;
				}
				
				//save long work output to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from filter->filter_product_on_sale)<br>";
				$rcache->set($cache_id, json_encode($product_output_sale_ids))or die ("Failed to save data to cash server");
			}
		}
		// if cache is disabled
		else
		{
			$product_by_sale_arr = $this->filter_mdl->find_product_by_sale($product_input_ids);
		
			if(!empty($product_by_sale_arr))
			{
				foreach($product_by_sale_arr as $product_by_sale){ $ids[] = $product_by_sale->id;}
				$product_output_sale_ids = join(',',$ids); //output of the brand filter 
			}
			else 
			{
				$product_output_sale_ids = NULL;
			}
		}
		////////caching finish//////////

		return $product_output_sale_ids;
	}
	
	// 
	/**
	* 
	* will get a rage of product ids and will return the following 
	*id,
	*inStock, 
	*price, 
	*salePrice, 
	*lang.`name`, 
	*lang.brandedName, 
	*lang.unbrandedName 
	*lang.description 
	* I am not sure if this method really needs cache ... will wait for result
	* 
	* 
	* @param cvs $product_input_ids
	* 
	* @return array of product id , stock-status, price, saleprice, name, branded name, unbranded name, description
	*/
	public function get_product_partial_details($product_input_ids)
	{
		$lang_id = $this->lng->get_n_set_language_id();
		
		$product_arr = $this->filter_mdl->find_product($product_input_ids,$lang_id);
		
		if(!empty($product_arr))
		{
			$product_filter_output = $product_arr;
		}
		else 
		{
			$product_filter_output = NULL;
		}
		
		return $product_filter_output;
		
	}
	
	//// hybrid method ///////////////
	
	// 
	/**
	* gets the number of filtred products 
	* 
	* @param string $term
	* @param int $cat_id
	* @param long $min_price
	* @param long $max_price
	* @param csv $brand_id_range
	* @param csv $size_id_range
	* @param csv $color_id_range
	* @param bool $on_sale
	* 
	* @return int number of filtered products
	*/ 
	
	public function  get_num_filtred_products($term,$cat_id,$min_price,
											$max_price,$brand_id_range,$size_id_range,$color_id_range,$on_sale)
	{
		
		$lang_id = $this->lng->get_n_set_language_id();
		
		$this->load->module("categories");
		$cat_id_range = $this->categories->get_all_subcat_ids($cat_id);
		
		
		////////caching start//////////
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $num_filtred_products
			$signature_id = sha1($term."-".$cat_id_range."-".$lang_id."-".$min_price."-".$max_price."-".$brand_id_range."-".$size_id_range."-".$color_id_range."-".$on_sale);
			$cache_id ="filter:get_num_filtred_products:".$signature_id;
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from filter->get_num_filtred_products)<br>";
				$num_filtred_products = $cache_content;
			}
			else 
			{
				// long work here
				$num_filtred_products = $this->filter_mdl->get_count_filtred_products($term,$cat_id_range,$lang_id,$min_price,
											$max_price,$brand_id_range,$size_id_range,$color_id_range,$on_sale);
				//save long work output to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from filter->get_num_filtred_products)<br>";
				if(!empty($num_filtred_products)) 
				$rcache->set($cache_id, json_encode($num_filtred_products))or die ("Failed to save data to cash server");
			}
		}
		// if cache is disabled
		else
		{
			// long work here
			$num_filtred_products = $this->filter_mdl->get_count_filtred_products($term,$cat_id_range,$lang_id,$min_price,
											$max_price,$brand_id_range,$size_id_range,$color_id_range,$on_sale);
		}
		////////caching finish//////////
		
		return 	$num_filtred_products;					
	}
	
	
	
	
	
	
	
	/**
	* filters products with by name color size brand sale and order the result  and paginate the result  and cache it 
	* 
	* @param string $term
	* @param int $cat_id
	* @param int $offset
	* @param int $per_page
	* @param long $min_price
	* @param long $max_price
	* @param csv $brand_id_range
	* @param csv $size_id_range
	* @param csv $color_id_range
	* @param string $price_order_str
	* @param bool $on_sale
	* 
	* @return csv product id list
	*/ 
	private function get_filtred_product_id_list($term,$cat_id,$offset,$per_page,
											$min_price,$max_price,$brand_id_range,$size_id_range,$color_id_range,$price_order_str,$on_sale)
	{
		$lang_id = $this->lng->get_n_set_language_id();
		
		$this->load->module("categories");
		$cat_id_range = $this->categories->get_all_subcat_ids($cat_id);
		
		////////caching start//////////
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $product_id_range
			$signature_id = sha1($term."-".$cat_id_range."-".$lang_id."-".$offset."-".$per_page."-".
												$min_price."-".$max_price."-".$brand_id_range."-".$size_id_range."-".$color_id_range."-".$price_order_str."-".$on_sale);
			$cache_id ="filter:get_filtred_product_id_list:".$signature_id;
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from filter->get_filtred_product_id_list)<br>";
				$product_id_range = $cache_content;
			}
			else 
			{
				// long work here
						$product_id_range_arr = $this->filter_mdl->get_filtred_product_id_range($term,$cat_id_range,$lang_id,$offset,$per_page,
												$min_price,$max_price,$brand_id_range,$size_id_range,$color_id_range,$price_order_str,$on_sale);
		
				if(!empty($product_id_range_arr))
					{
						foreach($product_id_range_arr as $product_id_range_row){ $ids[] = $product_id_range_row->id;}
						$product_id_range = join(',',$ids); 
					}
				
				//save long work output to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from filter->get_filtred_product_id_list)<br>";
				if(!empty($product_id_range)) 
				$rcache->set($cache_id, json_encode($product_id_range))or die ("Failed to save data to cash server");
			}
		}
		// if cache is disabled
		else
		{
			// long work here
			$product_id_range_arr = $this->filter_mdl->get_filtred_product_id_range($term,$cat_id_range,$lang_id,$offset,$per_page,
											$min_price,$max_price,$brand_id_range,$size_id_range,$color_id_range,$price_order_str,$on_sale);
			
			if(!empty($product_id_range_arr))
				{
					foreach($product_id_range_arr as $product_id_range_row){ $ids[] = $product_id_range_row->id;}
					$product_id_range = join(',',$ids); 
				}
		}
		////////caching finish//////////
		
		if(!empty($product_id_range))	
			return $product_id_range;
	}
	
	/**
	* gets the id ,name and description and some other data  
	*
	* @param string $term
	* @param int $cat_id
	* @param int $offset
	* @param int $per_page
	* @param long $min_price
	* @param long $max_price
	* @param csv $brand_id_range
	* @param csv $size_id_range
	* @param csv $color_id_range
	* @param string $price_order_str
	* @param bool $on_sale
	* 
	* @return array product details
	*/
	public function get_filtred_product_list($term,$cat_id,$offset,$per_page,$min_price,
											 $max_price,$brand_id_range,$size_id_range,
											 $color_id_range,$price_order_str,$on_sale)
	{
		
		$product_id_range = $this->get_filtred_product_id_list($term,$cat_id,$offset,$per_page,
															   $min_price,$max_price,$brand_id_range,$size_id_range,
															   $color_id_range,$price_order_str,$on_sale);
		// get the some details - not all details- of the products id 
		
		if($product_id_range)
		{
		$filtred_product_list = $this->filter_mdl->get_filtred_product_list($product_id_range,$price_order_str);
		return $filtred_product_list;
		}
		else
		{
			// no item found
		}
	}
	

	
	
}

/* End of file filter.php */
/* Location: ./application/modules/controllers/filter.php */