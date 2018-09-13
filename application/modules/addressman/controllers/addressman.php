<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class addressman extends MX_Controller {

 function __construct()
    {
        parent::__construct();
        
    	$this->load->model('addressman_mdl');   
    	
    	$this->load->helper('url');
    }
    
    public function get_cities_tr()
    {
		$turkish_cities = $this->addressman_mdl->get_cities_tr();
		//var_dump($turkish_cities);
		return $turkish_cities;
		
	}
	
	//called via ajax 
	public function get_counties_tr()
    {
		$city_id = $this->input->get('city_id');
		$counties_for_tr_city = $this->addressman_mdl->get_counties_tr($city_id);
		$counties_for_tr_city_json = json_encode($counties_for_tr_city);
		echo $counties_for_tr_city_json;
	}
	
	public function get_counties_for_tr_city($city_id)
    {
		$counties_for_tr_city = $this->addressman_mdl->get_counties_tr($city_id);
		return $counties_for_tr_city;
	}
	
	//called via ajax 
	public function get_address_details()
	{
		$address_id = $this->input->get('addressid');
		$address_details = $this->addressman_mdl->get_address_details($address_id);
		$address_details_json = json_encode($address_details);
		echo $address_details_json;
		
	}
	
	public function get_all_counties_tr()
	{
		
		$all_counties_tr = $this->addressman_mdl->get_all_counties_tr();
		return $all_counties_tr;
	}
	
	//called via ajax 
	public function x_del_shipping_address()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			
			$address_id = $this->input->get('addressid',TRUE);
			
			$ssl_port_num    = ":".SSL_PORT;  // :443 is the default
			$base_url_str    = base_url();
			$sbu             = str_replace("http","https",$base_url_str );
			$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
		
			$re = "/((?![0-9]).+)/";  // wow negative look ahead to match anything but numbers 
	    	preg_match($re, $address_id, $matches);
	    	if(!empty($matches))  redirect( $secure_base_url."customer/my_address_book" ) ;
			
			$address_details = $this->addressman_mdl->get_address_details($address_id)[0];
			
			$is_primary_address = $address_details->is_default;
			
			
			if($is_primary_address == 1)
			{
				
				$flag = $this->addressman_mdl->del_shipping_address($address_id);
				
				// set another shipping address as primary 
				$user_shipping_addresses = $this->addressman_mdl->get_user_shipping_addresses($user_id);
				if(!empty($user_shipping_addresses))
				{
					$next_address = $user_shipping_addresses[0];
					// set next address as primary 
					
					$this->addressman_mdl->set_address_as_primary($next_address->id);
					
				}
				else
				{
					//no other shipping addresses found 
				}
				
			}
			else
			{
			 	// not primary nothing to worry about 	
				$flag = $this->addressman_mdl->del_shipping_address($address_id);
			}
			
			
			$next_path = $secure_base_url."customer/my_address_book";
	    	echo $next_path; 
		}
		
	}
	
	public function x_set_as_primary()
	{
		$user_id = $this->session->userdata('user_id');
		
		$ssl_port_num    = ":".SSL_PORT;  // :443 is the default
		$base_url_str    = base_url();
		$sbu             = str_replace("http","https",$base_url_str );
		$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
		
		if(!empty($user_id))
		{
			$address_id = $this->input->get('addressid',TRUE);
				
			$re = "/((?![0-9]).+)/";  // wow negative look ahead to match anything but numbers 
	    	preg_match($re, $address_id, $matches);
	    	if(!empty($matches))  redirect( $secure_base_url."customer/my_address_book" ) ;
	    	
	    	//set all shipping addresses as non primary for that user 
	    	$q1 =  $this->addressman_mdl->set_all_user_shipping_address_as_non_primary($user_id);
	    	
	    	//set THE selected shipping address to become primary 
	    	$q2 = $this->addressman_mdl->set_shipping_address_as_primary($address_id);
	    	
	    	if($q1 and $q2)
	    	{
	    		//success
	    		$next_path = $secure_base_url."customer/my_address_book";
	    		echo $next_path; 
			}
			else
			{
				echo "0"; // error
			}
	    	
	    	
	    	
		}
		else
		{
			//redirect to login 
			redirect( $secure_base_url."customer/my_address_book/?login=0" ) ;
		}
    	
    	
    	
    	
    	
	}
	

	
	
}

/* End of file addressman.php */
/* Location: ./application/modules/addressman/controllers/addressman.php */