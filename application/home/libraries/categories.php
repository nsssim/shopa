<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories 
 {
 	
    function __construct() 
    {
     	 
   	}

    
    public function get_categories($main_category)
    {
	    $CI =& get_instance();
	    $CI->load->model('categories_mdl');
	    
		$result=  $CI->categories_mdl->get_subcategories($main_category);// get all subcategories of a main category
		//$tmp_array = array();

		/*		
		foreach($result  as $r )
		{
			if(!is_null($r->level1_idd))
			{
				$tmp_array(main_idd=>level1_idd)($,$r->main_idd);
				if(!is_null($r->level2_idd))
				{
					array_push($tmp_array[0][0],$r->level1_idd);
					if(!is_null($r->level3_idd))
					{
						array_push($tmp_array[0][0][0],$r->level2_idd);
					}
				}
				
			}
			
		}*/
		// remove duplicates from the temporary array
		// array_unique($tmp_array);
		//$y=88888;
		return $result;
	}
    
}

/* End of file Categories.php */