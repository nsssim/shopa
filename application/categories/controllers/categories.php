<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class categories extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
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
			if($row->lev5_id) $subcat_id_array[] = $row->lev5_id ;
			elseif($row->lev4_id) $subcat_id_array[] = $row->lev4_id ;
			elseif($row->lev3_id) $subcat_id_array[] = $row->lev3_id ;
			elseif($row->lev2_id) $subcat_id_array[] = $row->lev2_id ;
		}
		
		$lang_id = $this->session->userdata("language_id");
		foreach($subcat_id_array as $key=>$value)
		{
			$category_name = $this->categories_mdl->get_cat_name($value,$lang_id);
			foreach($category_name as $row)
			{
				if($row->name) {$subcat_name_array[] = ["name"=>$row->name ,"id"=> $row->id] ;}
				elseif($row->shortName) {$subcat_name_array[] = ["name"=>$row->shortName ,"id"=> $row->id] ;} 
				elseif($row->localizedId) {$subcat_name_array[] = ["name"=>$row->localizedId ,"id"=> $row->id] ;} 
			}	
		}
		sort($subcat_name_array);
		
		//echo "<pre>";
		//print_r($subcat_name_array) ;
		//echo "</pre>";
		
		//return $subcat_name_array;	
	}
	
	//get the subcategories id
	public function get_sub_cat_id($cat_id)
	{
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
		
		$lang_id = $this->session->userdata("language_id");
	
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
	
	// this method will return the first subcategories children
	public function get_first_subcat_children($id)
	{
		$this->load->model("categories_mdl");
		$lang_id = $this->session->userdata("language_id");
		$lang_id=2;	
		$cat_list =  $this->categories_mdl->get_first_subcat_children($id,$lang_id);
		
		//echo "<pre>";
		//	print_r($cat_list) ;
		//echo "</pre>";
		return $cat_list;
		
	}
	
	public function get_all_children_id($id)
	{
		$this->load->model("categories_mdl");
		$children_cat_id  = $this->categories_mdl->get_all_children_id($id);
		
		//echo "<pre>";
		//	print_r($children_cat_id) ;
		//echo "</pre>";
		
	}
	
	/**
	 * this function returns an array with all the subcategories for the menu.
	*/
	public function get_categories_list()
	{
		
		$this->load->model("categories_mdl");
		
		$lang_id = $this->session->userdata("language_id");
		$lang_id=2;
		$women_clothing_cat  =  $this->categories_mdl->get_first_subcat_children(544,$lang_id);	
		$men_clothing_cat  =    $this->categories_mdl->get_first_subcat_children(1741,$lang_id);
		
		$women_bags_cat  =  $this->categories_mdl->get_first_subcat_children(31,$lang_id);	
		$men_bags_cat  	 =  $this->categories_mdl->get_first_subcat_children(168,$lang_id);
		
		$women_shoes_cat  =  $this->categories_mdl->get_first_subcat_children(109,$lang_id);	
		$men_shoes_cat  	 =  $this->categories_mdl->get_first_subcat_children(219,$lang_id);
		
		$women_beauty_cat  =  $this->categories_mdl->get_first_subcat_children(413,$lang_id);	
		$men_grooming_cat  =  $this->categories_mdl->get_first_subcat_children(172,$lang_id);
		
		$kids_cat  =  $this->categories_mdl->get_first_subcat_children(323,$lang_id);	
		$home_cat  =  $this->categories_mdl->get_first_subcat_children(806,$lang_id);
		
		$women_jewelry_cat  =  $this->categories_mdl->get_first_subcat_children(65,$lang_id);	
		$men_jewelry_cat  =  $this->categories_mdl->get_first_subcat_children(244,$lang_id);
		
		$women_accessories_cat  =  $this->categories_mdl->get_first_subcat_children(3,$lang_id);	
		$men_accessories_cat  =  $this->categories_mdl->get_first_subcat_children(167,$lang_id);
		
		$data ["women_cat"] =   $women_clothing_cat;
		$data ["men_cat"] =   $men_clothing_cat;
		
		$data ["women_bags_cat"] =   $women_bags_cat;
		$data ["men_shoes_cat"] =   $men_shoes_cat;
		
		$data ["women_shoes_cat"] =   $women_shoes_cat;
		$data ["men_bags_cat"] =   $men_bags_cat;
		
		$data ["women_beauty_cat"] =   $women_beauty_cat;
		$data ["men_grooming_cat"] =   $men_grooming_cat;
		
		$data ["kids_cat"] =   $kids_cat;
		$data ["home_cat"] =   $home_cat;
		
		$data ["women_jewelry_cat"] =   $women_jewelry_cat;
		$data ["men_jewelry_cat"] =   $men_jewelry_cat;
		
		$data ["women_accessories_cat"] =   $women_accessories_cat;
		$data ["men_accessories_cat"] =   $men_accessories_cat;
		
		//echo "<pre>";
		//	print_r($data);
		//echo "</pre>";
		
		return $data;
		
	}
	
	// this function gets the ids of all the subcategories of a certain id   like so (2,85,103)
	public function get_all_subcat_ids($id)
	{
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
		if($num_of_items == 1) $cat_id_range = "(".$all_subcat_ids[0].")";
		else 
		{
			
			for ($i = 0 ; $i < sizeof($all_subcat_ids); $i++)
			{
				// if 1st element
				if($i == 0)
				{	
					$cat_id_range .= "(".$all_subcat_ids[$i].",";
				}
				// if its not the last element
				elseif($i != sizeof($all_subcat_ids)-1)
				{
					$cat_id_range .= $all_subcat_ids[$i].",";
				}
				// if its the last element
				else
				{
					$cat_id_range .= $all_subcat_ids[$i].")";
				}
			}
		}
		
		//echo "<pre>";
		//	print_r($cat_id_range) ;
		//echo "</pre>";
		
		//echo "--------------<br>";
		
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
	
	//return $subcategories_details;
	
}

/* End of file categories.php */
/* Location: .application/modules/categories/controllers/categories.php */