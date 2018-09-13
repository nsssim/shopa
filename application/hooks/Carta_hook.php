<?php 

class Carta_hook
 {
 	
    function __construct() 
    {
     	 
   	}
   	
   	public function restore_customer_cart()
   	{
		$CI =& get_instance();
		
		$number_of_items = $CI->cart->total_items();
		
		if(!empty($CI->session->userdata("user_id"))) $is_logged_in = TRUE; else $is_logged_in = FALSE;
		
		if($is_logged_in and $number_of_items = 0)
		{
			//get user cart copy from database
			$cart_dump = 1;/////////////-------------------------><<<--------------------
		}
	}
   	
   	public function  restore_guest_cart()
   	{
    	$CI =& get_instance();
    	
    	$number_of_items = $CI->cart->total_items();
    	$is_logged_in = FALSE;
    	
    	
    	$CI->load->library('firebug'); 
		
		// if the cart is empty and there is a cookie populate the cart from the browser cookie 
		if ($number_of_items = 0 and !$is_logged_in)
		{
			//get cart anchor id from cookie
			$test = $CI->input->cookie('test', TRUE);
    		//$CI->input->set_cookie("test", "1234567897777", 3600*2); // set the cookie for 2 hours
			
			//$CI->firebug->info($test,"test_cookie_value");
			
			//-------------
			
			//$user_finger_print = sha1($CI->input->ip_address().$CI->input->user_agent());
			//$CI->input->set_cookie("fp", "c5465465464" , 3600*2); // set the cookie for 2 hours
			
		}
		 
    	
    	/*if cart empty
		{
			if cart_cookie
			{
				cart <- cart_cookies;
			}
			
		}*/
    	
	}
    
}

/* End of file Carta_cookie.php */