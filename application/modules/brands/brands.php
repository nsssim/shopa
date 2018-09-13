<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class brands extends CI_Controller 
{

 function __construct()
    {
        parent::__construct();
		$this->load->model('brands_mdl');
    }

	// this function will be called via ajax to load all the brands 
	public function all()
	{
		$result_all_brands = $this->brands_mdl->get_all_brand_name(); 
		$array_all_brands = array(); 
		$i = 0;
		
		
		foreach ($result_all_brands as $row_brand)
		{
			$array_all_brands [$i]["id"]= $row_brand->id;
			$array_all_brands [$i]["name"]= $row_brand->name;
			$i++;
		}
		
		$ajax_result =  json_encode($array_all_brands);
		echo($ajax_result);
	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */