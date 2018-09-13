<?php
class customer_mdl extends CI_Model
{
       
        public function add_address($address)
        {
        	$address1  =  $address["address1"];
        	$address2  =  $address["address2"];
        	$address3  =  $address["address3"];
        	$city      =  $address["city"];
        	$region    =  $address["region"];
        	$zipcode   =  $address["zipcode"];
        	$country   =  $address["country"];
        	
        	$qry_str = '
        				INSERT INTO addresses SET
        				 line_1="'.$address1.'",
        				 line_2="'.$address2.'",
        				 line_3="'.$address3.'",
        				 city="'.$city.'",
        				 country_province="'.$region.'",
        				 zip_code="'.$zipcode.'",
        				 coutry="'.$country.'"';
        				 
        	$q = $this->db->query($qry_str);
        	return $q;
        	           
        }
        
        
        public function add_customer($customer,$lang_id)
        {
        	$lang_id = 2;
        	
        	$firstname      =  $customer["firstname"];
        	$lasname        =  $customer["lasname"];
        	$phone          =  $customer["phone"];
        	$alt_phone      =  $customer["alt_phone"];
        	$email          =  $customer["email"];
        	
        	$qry_str = '
        				 INSERT INTO customers SET
        				 email="'.      $email.'",
        				 language_id_fk="'.$lang_id.'",
        				 first_name="'. $firstname.'",
        				 last_name="'.  $lasname.'",
        				 password="'.  $this->randomPassword().'",
        				 newsletter= TRUE,
        				 date_add= NOW(),
        				 status_id_fk= 1,
        				 phone="'.  $phone.'",
        				 note ="'.$alt_phone.'"';
        				 
        	$q = $this->db->query($qry_str);
        	return $q;
        	           
        }
        
        
        public function  randomPassword() 
        {
	    	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    	$pass = array(); //remember to declare $pass as an array
	    	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    	for ($i = 0; $i < 8; $i++) 
	    	{
	        	$n = rand(0, $alphaLength);
	        	$pass[] = $alphabet[$n];
	    	}
	    	return implode($pass); //turn the array into a string
		}
        
        public function get_last_id($table_name)
        {
			$qry_str = "SELECT MAX(ID) AS last_id FROM " . $table_name ;
			$q = $this->db->query($qry_str);
        	return $q->result();  
		}
		
		public function link_customers_to_addresses($last_customer_id, $last_address_id)
		{
			
			$qry_str = '
        				 INSERT INTO customer_addresses SET
        				 date_address_from= NOW(),
        				 address_id_fk ="'.      $last_address_id.'",
        				 customer_id_fk ="'.$last_customer_id.'",
        				 is_for_delivery = 1,
        				 is_for_invoice = 1';
        				 
        	$q = $this->db->query($qry_str);
        	return $q;

		}
		
		public function check_customer($email)
	{
			$qry_str = '
				SELECT
				customers.id
				FROM `customers`
				WHERE
				customers.email = "'.$email.'";
				';
			
        	$q = $this->db->query($qry_str);
        	echo "<pre>";
        	print_r ($q->result()); 
        	echo "</pre>";
        	
        	if(!empty($q->result())) return TRUE ;
        	
        	else return FALSE ;
        	//return $q;
	}
	
	
	
	public function get_user_id($email)
	{
		$qry_str = '
				SELECT
				customers.id AS customer_id
				FROM `customers`
				WHERE
				customers.email = "'.$email.'";
				';
			
        	$q = $this->db->query($qry_str);
        	return $q->result();
	}
	
	
	public function get_customer_address_delivery_id($customer_id)
	{
		$qry_str = '
				SELECT
				customer_addresses.id AS address_delivery_id
				FROM `customer_addresses`
				WHERE
				customer_addresses.is_for_delivery = 1 AND
				customer_addresses.customer_id_fk = '.$customer_id.'
				';
			
        	$q = $this->db->query($qry_str);
        	return $q->result();
	}
	
		public function get_customer_address_invoice_id($customer_id)
	{
		$qry_str = '
				SELECT
				customer_addresses.id AS address_invoice_id
				FROM `customer_addresses`
				WHERE
				customer_addresses.is_for_invoice = 1 AND
				customer_addresses.customer_id_fk = '.$customer_id.'
				';
			
        	$q = $this->db->query($qry_str);
        	return $q->result();
	}
}


?>


