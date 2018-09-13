<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class price_rules extends MX_Controller {

 function __construct()
    {
        parent::__construct();
        
        $this->load->model('price_rules_mdl'); // needed for the template info (template path)

        
    }


	/**
	* this method gets you the price rule of an id from the price rule table (see price_rule table in the database)  
	* 
	* 
	* @param int $rule_code
	* 
	* @return int price rule value
	*/
	
	public function get_price_rule_value($rule_code)
	{
		$rule_value_arr = $this->price_rules_mdl->get_price_rule_value($rule_code);
		
		/*echo "<pre>";
		print_r($rule_value_arr);
		echo "<pre>";*/
		
		 $rule_value_arr[0]->value ; 
		return $rule_value_arr[0]->value ; 
	}
	
	/**
	* calculate the shipping fee, depending on the number of items 
	* 
	* @param undefined $num_of_items
	* 
	* @return mixed return NULL if number of items = 1 or the shipping fee from the database if number of items is bigger than 1
	*/
	
	public function get_shipping_fee($num_of_items)
	{
		
		$no_item =0;
		if($num_of_items == 0)
		{
			$no_item =1;
		}
		elseif($num_of_items >= 10)
		{
			$rule_value_arr = $this->price_rules_mdl->get_shipping_fee(10);
		}
		else
		{
			$rule_value_arr = $this->price_rules_mdl->get_shipping_fee($num_of_items);
		} 
		
		if($no_item == 1)
		{
			//echo "NULL" ; 
			return NULL ; 	
		}
		else
		{
			//echo $rule_value_arr[0]->value ; 
			return $rule_value_arr[0]->value ;  ;
		}		
	}
	
	/**
	* gets the service fee depending on the number of items 
	* 
	* @param int $num_of_items
	* 
	* @return int service_fee 
	*/
	
	public function get_service_fee($num_of_items)
	{
		
		if ($num_of_items > 0)
		{
			$rule_value_arr = $this->price_rules_mdl->get_service_fee($num_of_items);
			//echo $rule_value_arr[0]->value ; 
			return $rule_value_arr[0]->value ; 
		}
		else
		{
			//echo $rule_value_arr[0]->value ; 
			return 0 ;
		}	
		
	}
	
	public function update_max_price()
	{
		$max_price_id  = $this->input->post('max_price_id',TRUE);
		
		$error = 1;
		if($max_price_id == "not")
		{
			//reset max_price_column
			$flag_reset = $this->price_rules_mdl->reset_max_price();
			if($flag_reset) $error = 0;
		}
		else
		{
			// update max_price_record
			$flag_reset = $this->price_rules_mdl->reset_max_price();
			$flag_set = $this->price_rules_mdl->set_max_price($max_price_id);
			
			if($flag_reset and $flag_set) $error = 0;
		}
		
		//$error = 1; for testing worst scenario

		if($error == 0)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	
	
}

/* End of file cart.php */
/* Location: ./application/controllers/cart.php */