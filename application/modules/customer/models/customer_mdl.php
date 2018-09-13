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
        	$firstname =  $address["firstname"];
        	$lastname  =  $address["lastname"];
        	
        	$qry_str = '
        				INSERT INTO addresses SET
        				 line_1="'.$address1.'",
        				 line_2="'.$address2.'",
        				 line_3="'.$address3.'",
        				 city="'.$city.'",
        				 country_province="'.$region.'",
        				 zip_code="'.$zipcode.'",
        				 first_name="'.$firstname.'",
        				 last_name="'.$lastname.'",
        				 is_active = 1,
        				 is_default = 1,
        				 adding_date = NOW(),
        				 coutry="'.$country.'"';
        				 
        	$q = $this->db->query($qry_str);
        	return $q;
        	           
        }
        
        
        public function add_customer($customer)
        {
        	//$lang_id = 2;
        	
        	$firstname      		=  $customer["firstname"];
        	$lasname        		=  $customer["lasname"];
        	$phone          		=  $customer["phone"];
        	$alt_phone      		=  $customer["alt_phone"];
        	$email          		=  $customer["email"];
        	
        	if(!empty($customer["password"]))
        		$password          		=  $customer["password"];
        	else
        		$password				= $this->randomPassword();
        	
        	$primary_lang_id        =  $customer["prim_lang_id"];
        	
        	$status_id        		=  $customer["status_id"];
        	
        	$qry_str = '
        				 INSERT INTO customers SET
        				 email="'.      $email.'",
        				 language_id_fk="'.$primary_lang_id.'",
        				 first_name="'. $firstname.'",
        				 last_name="'.  $lasname.'",
        				 password="'.  $password.'",
        				 newsletter= TRUE,
        				 date_add= NOW(),
        				 status_id_fk= '.$status_id.',
        				 phone="'.  $phone.'",
        				 alt_phone ="'.$alt_phone.'"';
        				 
        	$q = $this->db->query($qry_str);
        	return $q;
        	           
        }
        
        public function save_customer($customer) // added september 2016
        {
        	
        	$firstname      		=  $customer["firstname"];
        	$lasname        		=  $customer["lastname"];
        	$email          		=  $customer["email"];
        	$gender          		=  $customer["gender"];
        	$password				=  md5(sha1($customer['password']));
        	$newsletter				=  $customer['newsletter'];
        	
        	$birthdate	          	=  $customer['year_select'].'-'.$customer['month_select'].'-'.$customer['date_select'].' 00:00:00' ;
        	
        	$phone          		=  $customer["phone"];
        	
        	$primary_lang_id        =  $customer["primary_lang"];
        	
        	$status_id        		=  $customer["status_id"];
        	
        	$qry_str = '
        				 INSERT INTO customers SET
        				 email="'.      $email.'",
        				 language_id_fk="'.$primary_lang_id.'",
        				 first_name="'. $firstname.'",
        				 last_name="'.  $lasname.'",
        				 password="'.  $password.'",
        				 gender_id_fk="'.  $gender.'",
        				 newsletter="'.  $newsletter.'",
        				 birthdate="'.  $birthdate.'",
        				 date_add= NOW(),
        				 status_id_fk= '.$status_id.',
        				 phone="'.  $phone.'"';
        				 
        	$q = $this->db->query($qry_str);
        	return $q;
        	           
        }
        
        public function verify($verification_code)
        {
			//get all the unverified customers
			$qry_unverified_customers_str = 
			'
				SELECT
				customers.id,
				customers.first_name,
				customers.email,
				customers.`password`
				FROM
				customers
				INNER JOIN customers_statuses ON customers.status_id_fk = customers_statuses.id
				WHERE
				customers_statuses.id = 2
			';
        	$q_unverified_customers = $this->db->query($qry_unverified_customers_str);
        	
        	$unverified_customers = $q_unverified_customers->result();
        	
        	if(!empty($unverified_customers))
        	{
	        	// check the verification code for each unverified customer
	        	foreach($unverified_customers as $unverified_customer)
	        	{
					//generate unique verification code from user email and password 
					$emlpass = $unverified_customer->email.$unverified_customer->password;
					$candidate_code = sha1($emlpass);
					
					//bingo
					if($candidate_code == $verification_code)
					{
						$result = $unverified_customer;
					} 
					else
					{
						//no match found
						$result = FALSE;
					}
					
				}
			}
			else
			{
				$result = FALSE;
			}
			return $result;
			
			
		}
		
		public function change_user_status($user_id,$status_id)
		{
			$qry_str=
			'UPDATE `customers` 
			SET 
				`status_id_fk`="'.$status_id.'"
			WHERE
			  (`id`="'.$user_id.'")' ;	
			
			$q = $this->db->query($qry_str);
			
        	return $q;
		}
        
        public function update_customer_from_checkout($customer_id,$customer_data)
        {
			$qry_str='UPDATE `customers` 
			SET 
				`first_name`		=	"'.$customer_data['firstname'].'",
				`last_name`			=	"'.$customer_data['lasname'].'",
				`phone`				=	"'.$customer_data['phone'].'",
				`alt_phone`			=	"'.$customer_data['alt_phone'].'",
				`email`				=	"'.$customer_data['email'].'",
				`language_id_fk`	=	"'.$customer_data['prim_lang_id'].'"
			WHERE
			  (`id`="'.$customer_id.'")' ;	
			
			$q = $this->db->query($qry_str);
			
        	return $q; 
		}
        
        public function update_password($pwd)
        {
			// todo 
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
        	$r = $q->result();
        	return $r;  
		}
		
		public function link_customers_to_addresses($last_customer_id, $last_address_id,$type)
		{
			if($type == "SHIPPING")
			{
				$qry_str = '
        				 INSERT INTO customer_addresses SET
        				 date_address_from= NOW(),
        				 address_id_fk ="'.      $last_address_id.'",
        				 customer_id_fk ="'.$last_customer_id.'",
        				 is_for_delivery = 1,
        				 is_for_invoice = 0';
			}
			elseif($type == "BILLING")
			{
				$qry_str = '
        				 INSERT INTO customer_addresses SET
        				 date_address_from= NOW(),
        				 address_id_fk ="'.      $last_address_id.'",
        				 customer_id_fk ="'.$last_customer_id.'",
        				 is_for_delivery = 0,
        				 is_for_invoice = 1';
			}
			else // the address is for both deliveryand invoice
			{
				$qry_str = '
        				 INSERT INTO customer_addresses SET
        				 date_address_from= NOW(),
        				 address_id_fk ="'.      $last_address_id.'",
        				 customer_id_fk ="'.$last_customer_id.'",
        				 is_for_delivery = 1,
        				 is_for_invoice = 1';
			}
        				 
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
        	//echo "<pre>";
        	//print_r ($q->result()); 
        	//echo "</pre>";
        	
        	$result = $q->result();
        	if(!empty($result)) return TRUE ;
        	
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
				customer_addresses.address_id_fk AS address_delivery_id
				FROM
				customer_addresses
				INNER JOIN addresses ON customer_addresses.address_id_fk = addresses.id
				WHERE
				customer_addresses.is_for_delivery = 1 AND
				customer_addresses.customer_id_fk = '.$customer_id.' AND
				addresses.is_active = 1
				';
			
        	$q = $this->db->query($qry_str);
        	return $q->result();
	}
	
		public function get_customer_address_invoice_id($customer_id)
	{
		$qry_str = '
				SELECT
				customer_addresses.address_id_fk AS address_invoice_id
				FROM `customer_addresses`
				WHERE
				customer_addresses.is_for_invoice = 1 AND
				customer_addresses.customer_id_fk = '.$customer_id.'
				';
			
        	$q = $this->db->query($qry_str);
        	return $q->result();
	}
	
	public function update_address($address_id,$address_details)
	{
		$qry_str =  '
        			UPDATE `addresses` SET
        			`line_1`="'.$address_details['address1'].'",
        			`line_2`="'.$address_details['address2'].'",
        			`line_3`="'.$address_details['address3'].'",
        			`city`="'.$address_details['city'].'",
        			`country_province`="'.$address_details['region'].'",
        			`zip_code`="'.$address_details['zipcode'].'",
        			`coutry`="'.$address_details['country'].'"
        			WHERE (`id`="'.$address_id.'");
        			';
        $q = $this->db->query($qry_str);
        return $q;
		
	}
	
		public function get_customers()
	{
		$qry_str = '
					SELECT
					customers.id,
					customers_statuses.type,
					customers.first_name,
					customers.last_name,
					customers.phone,
					customers.email,
					customers.note,
					customers.date_add
					FROM
					customers
					INNER JOIN customers_statuses ON customers.status_id_fk = customers_statuses.id
					INNER JOIN customer_addresses ON customer_addresses.customer_id_fk = customers.id
					ORDER BY
					customers.date_add DESC
					LIMIT 0, 300
					';
			
        	$q = $this->db->query($qry_str);
        	return $q->result();
	}
	
	/*public function get_customer_orders($id)
	{
		$qry_str = '
					SELECT
					orders.id,
					orders.date_add AS order_date
					FROM
					orders
					WHERE
					orders.customer_id_fk = '.$id;
			
        	$q = $this->db->query($qry_str);
        	return $q->result();
	}*/
	
		public function get_number_of_customers(){
			$qry_str= '
			SELECT
			Count(customers.id) AS num_customers
			FROM
			customers
			';
			$q = $this->db->query($qry_str);
        	return $q->result();
		}
		
		public function get_customer_details($id)
		{
			$qry_str='
			SELECT
			customers.id AS customer_id,
			customers.email,
			customers.first_name,
			customers.last_name,
			customers.phone,
			customers.alt_phone,
			customers.username,
			customers.birthdate,
			customers.newsletter,
			customers.newsletter_date_add,
			customers.deleted,
			customers.date_add AS order_date,
			customers.date_upd,
			customers.password,
			customers.note,
			customers.max_payment_days,
			customers.gender_id_fk,
			customers.language_id_fk,
			customers.status_id_fk,
			customers.is_admin,
			customers_statuses.type
			FROM
			customers
			INNER JOIN customers_statuses ON customers.status_id_fk = customers_statuses.id
			WHERE
			customers.id = '.$id.'
			';
			$q = $this->db->query($qry_str);
        	return $q->result();
		}
		
		public function get_customer_orders_paginated($cust_id,$offset,$item_per_page,$order_by_str)
		{
			$qry_str='
				SELECT
				orders.id,
				orders.shop_id_fk AS orders_shop_id_fk,
				orders.lang_id_fk AS orders_lang_id_fk,
				orders.cart_id_fk AS orders_cart_id_fk,
				orders.currency_id_fk AS orders_currency_id_fk,
				orders.address_delivery_id_fk AS orders_address_delivery_id_fk,
				orders.address_invoice_id_fk AS orders_address_invoice_id_fk,
				orders.conversion_rate AS orders_conversion_rate,
				orders.date_add AS orders_date_add,

				orders_detail.id					AS	orders_detail_id,
				orders_detail.custom_fees			AS	orders_detail_custom_fees,
				orders_detail.total_price			AS	orders_detail_total_price,
				orders_detail.shipping_fee			AS	orders_detail_shipping_fee,
				orders_detail.service_fee			AS	orders_detail_service_fee,
				orders_detail.grand_total			AS	orders_detail_grand_total,
				orders_detail.sale_tax				AS	orders_detail_sale_tax,
				orders_detail.credit_card_expanses	AS	orders_detail_credit_card_expanses,
				orders_detail.number_of_items		AS	orders_detail_number_of_items,
				orders_detail.cart_content			AS	orders_detail_cart_content,
				
				orders_detail.v_order_sub_total,
				orders_detail.v_shipping_and_handling_fee,
				orders_detail.v_discount_total,
				orders_detail.v_subtotal,
				orders_detail.v_optional_custom_fees,
				orders_detail.v_grand_total,
				
				orders_detail.is_taken,
				orders_detail.is_customer_charged,
				orders_detail.is_placed,
				orders_detail.is_arrived_to_warehouse,
				orders_detail.is_packed,
				orders_detail.is_shipped,
				orders_detail.is_customs_cleared,
				orders_detail.is_arrived_to_office,
				orders_detail.is_relabled,
				orders_detail.is_delivered,
				orders_detail.tracking_num,

				addresses.id AS addresses_id,
				addresses.coutry AS addresses_coutry,
				addresses.line_1 AS addresses_line_1,
				addresses.line_2 AS addresses_line_2,
				addresses.line_3 AS addresses_line_3,
				addresses.city AS addresses_city,
				addresses.country_province AS addresses_country_province,
				addresses.zip_code AS addresses_zip_code,
				addresses.other_details AS addresses_other_details,
				addresses.is_deleted AS addresses_is_deleted,
				addresses.is_active AS addresses_is_active
				FROM
				orders
				LEFT  JOIN orders_detail ON orders_detail.order_id_fk = orders.id
				LEFT JOIN addresses ON orders.address_delivery_id_fk = addresses.id AND orders.address_delivery_id_fk = addresses.id
				WHERE
				orders.customer_id_fk = '.$cust_id.' ORDER BY '.$order_by_str.'  LIMIT '.$offset.','.$item_per_page.'
			';
			$q = $this->db->query($qry_str);
        	return $q->result();
		}
		
		public function get_order_details($order_id)
		{
			$qry_str= 'SELECT
				orders.id,
				orders.shop_id_fk AS orders_shop_id_fk,
				orders.lang_id_fk AS orders_lang_id_fk,
				orders.cart_id_fk AS orders_cart_id_fk,
				orders.currency_id_fk AS orders_currency_id_fk,
				orders.address_delivery_id_fk AS orders_address_delivery_id_fk,
				orders.address_invoice_id_fk AS orders_address_invoice_id_fk,
				orders.conversion_rate AS orders_conversion_rate,
				orders.date_add AS orders_date_add,

				orders_detail.id					AS	orders_detail_id,
				orders_detail.custom_fees			AS	orders_detail_custom_fees,
				orders_detail.total_price			AS	orders_detail_total_price,
				orders_detail.shipping_fee			AS	orders_detail_shipping_fee,
				orders_detail.service_fee			AS	orders_detail_service_fee,
				orders_detail.grand_total			AS	orders_detail_grand_total,
				orders_detail.sale_tax				AS	orders_detail_sale_tax,
				orders_detail.credit_card_expanses	AS	orders_detail_credit_card_expanses,
				orders_detail.number_of_items		AS	orders_detail_number_of_items,
				orders_detail.cart_content			AS	orders_detail_cart_content,
				
				orders_detail.v_order_sub_total,
				orders_detail.v_shipping_and_handling_fee,
				orders_detail.v_discount_total,
				orders_detail.v_subtotal,
				orders_detail.v_optional_custom_fees,
				orders_detail.v_grand_total,
				
				orders_detail.is_taken,
				orders_detail.is_customer_charged,
				orders_detail.is_placed,
				orders_detail.is_arrived_to_warehouse,
				orders_detail.is_packed,
				orders_detail.is_shipped,
				orders_detail.is_customs_cleared,
				orders_detail.is_arrived_to_office,
				orders_detail.is_relabled,
				orders_detail.is_delivered,
				orders_detail.tracking_num,

				addresses.id AS addresses_id,
				addresses.coutry AS addresses_coutry,
				addresses.line_1 AS addresses_line_1,
				addresses.line_2 AS addresses_line_2,
				addresses.line_3 AS addresses_line_3,
				addresses.city AS addresses_city,
				addresses.country_province AS addresses_country_province,
				addresses.zip_code AS addresses_zip_code,
				addresses.other_details AS addresses_other_details,
				addresses.is_deleted AS addresses_is_deleted,
				addresses.is_active AS addresses_is_active
				
				FROM
				orders
				LEFT  JOIN orders_detail ON orders_detail.order_id_fk = orders.id
				LEFT JOIN addresses ON orders.address_delivery_id_fk = addresses.id AND orders.address_delivery_id_fk = addresses.id
				WHERE
				orders.id = '. $order_id;
				
				$q = $this->db->query($qry_str);
        		return $q->result();
		} 
		
		public function get_number_customer_orders($cust_id)
		{
		$qry_str='SELECT
					Count(orders.id) AS num
					FROM
					orders
					WHERE
					orders.customer_id_fk = '.$cust_id;
		$q = $this->db->query($qry_str);
		$r = $q->result();
        return $r[0]->num;			
		}
		
		public function get_address_details($address_id)
		{
			//$oo = 55 ;
			$qry_str='
			SELECT
			addresses.id,
			addresses.line_1,
			addresses.line_2,
			addresses.line_3,
			addresses.city,
			addresses.id,
			addresses.country_province,
			addresses.zip_code,
			addresses.coutry,
			addresses.other_details,
			addresses.is_deleted,
			addresses.is_active
			FROM `addresses`
			WHERE
			addresses.id = '.$address_id.'
			';
			$q = $this->db->query($qry_str);
        	return $q->result();
		}
		public function update_customer_password($user_id,$crypted_new_pwd)
		{
			$qry_str='
					UPDATE `customers` SET
					`password`="'.$crypted_new_pwd.'" 
					WHERE (`id`="'.$user_id.'");

			';
			$q = $this->db->query($qry_str);
			// return true if ok
			return $q;
		}
		
			public function update_customer($customer)
		{
			$qry_str=
				'
					UPDATE `customers` SET
					`email`="'.				$customer["email"].'" ,
					`first_name`="'.		$customer["firstname"].'" ,
					`last_name`="'.			$customer["lastname"].'" ,
					`phone`="'.				$customer["phone"].'" ,
					`alt_phone`="'.			$customer["alt_phone"].'" ,
					`gender_id_fk`="'.		$customer["gender_id"].'" ,
					`birthdate`="'.			$customer["birthdate"].'" ,
					`date_upd`= NOW() ,
					`language_id_fk`="'.	$customer["prim_lang_id"].'" ,
					`newsletter`="'.		$customer["newsletter"].'" 
					WHERE (`id`='.			$customer["id"].');
				';
				
			$q = $this->db->query($qry_str);
			// return true if ok
			return $q;
		}
		
		public function update_customer_details($customer)  //  added september 2016
		{
			$firstname      		=  $customer["firstname"];
        	$lasname        		=  $customer["lastname"];
        	$email          		=  $customer["email"];
        	$gender          		=  $customer["gender"];
        	$password				=  md5(sha1($customer['password']));
        	$newsletter				=  $customer['newsletter'];
        	
        	$birthdate	          	=  $customer['year_select'].'-'.$customer['month_select'].'-'.$customer['date_select'].' 00:00:00' ;
        	
        	$phone          		=  $customer["phone"];
        	
        	$primary_lang_id        =  $customer["primary_lang"];
        	
        	
			
			if(empty($customer['password']))
			{
				//password was not changed
				$qry_str=
				'
					UPDATE `customers` SET
					`email`="'.				$customer["email"].'" ,
					`first_name`="'.		$customer["firstname"].'" ,
					`last_name`="'.			$customer["lastname"].'" ,
					`phone`="'.				$customer["phone"].'" ,
					`gender_id_fk`="'.		$customer["gender"].'" ,
					`birthdate`="'.			$birthdate.'" ,
					`date_upd`= NOW() ,
					`language_id_fk`="'.	$customer["primary_lang"].'" ,
					`newsletter`="'.		$customer["newsletter"].'" 
					WHERE (`id`='.			$customer["id"].');
				';
				
			}
			else
			{
				//password was changed
				$qry_str=
				'
					UPDATE `customers` SET
					`email`="'.				$customer["email"].'" ,
					`first_name`="'.		$customer["firstname"].'" ,
					`last_name`="'.			$customer["lastname"].'" ,
					`phone`="'.				$customer["phone"].'" ,
					`password`="'.			$password.'" ,
					`gender_id_fk`="'.		$customer["gender"].'" ,
					`birthdate`="'.			$birthdate.'" ,
					`date_upd`= NOW() ,
					`language_id_fk`="'.	$customer["primary_lang"].'" ,
					`newsletter`="'.		$customer["newsletter"].'" 
					WHERE (`id`='.			$customer["id"].');
				';
				
			}
			$q = $this->db->query($qry_str);
			// return true if ok
			return $q;
		}
		
		
		public function update_customer_email_phone($customer_id,$phone)
		{
			//password was changed
			$qry_str=
			'
				UPDATE `customers` SET
				`phone`="'.				$phone.'" ,
				`date_upd`= NOW() 
				WHERE (`id`='.			$customer_id.');
			';
			$q = $this->db->query($qry_str);
			// return true if ok
			return $q;
		}
		
		public function set_as_billing_address($address_id)
		{
			$qry_str =
			'UPDATE `customer_addresses` 
			SET 
				`is_for_invoice`= 1
			WHERE
			  (`address_id_fk`="'.$address_id.'")' ;	
			
			$q = $this->db->query($qry_str);
			
        	return $q;
		}
		
		public function disable_address($address_id)
		{
			$qry_str =
			'UPDATE `addresses` 
			SET 
				`is_active`= 0,
				`deactivation_date`= NOW()
			WHERE
			  (`id`="'.$address_id.'")' ;	
			
			$q = $this->db->query($qry_str);
			
        	return $q;
		}
		
		public function customer_update_address($address_details)
		{
			$qry_str=
				'
					UPDATE `addresses` SET
					`line_1`="'.			$address_details["address1"].'" ,
					`line_2`="'.			$address_details["address2"].'" ,
					`line_3`="'.			$address_details["address3"].'" ,
					`city`="'.				$address_details["city"].'" ,
					`country_province`="'.	$address_details["region"].'" ,
					`zip_code`="'.			$address_details["zipcode"].'" ,
					`coutry`="'.			$address_details["country"].'" ,
					`date_upd`= NOW() 
					WHERE (`id`="'.			$address_details["id"].'");
				';
				
			$q = $this->db->query($qry_str);
			// return true if ok
			return $q;
		}
		
		public function get_countries()
		{
			$qry_str=
				'SELECT
				countries.`Name`
				FROM
				countries
				ORDER BY
				countries.`Name` ASC
				';
			$q = $this->db->query($qry_str);
        	return $q->result();
		}
		
		public function get_customer_and_billing_address_details($customer_id)
		{
			$qry_str=
			'SELECT
			customers.id,
			customers.email,
			customers.first_name,
			customers.last_name,
			customers.phone,
			customers.alt_phone,
			customers.username,
			customers.`password`,
			customers.last_passwors_gen,
			customers.birthdate,
			customers.newsletter,
			customers.newsletter_date_add,
			customers.deleted,
			customers.gender_id_fk,
			customers.language_id_fk,
			
			customer_addresses.is_for_delivery,
			customer_addresses.is_for_invoice,
			
			addresses.id,
			addresses.line_1,
			addresses.line_2,
			addresses.line_3,
			addresses.city,
			addresses.country_province,
			addresses.zip_code,
			addresses.coutry,
			addresses.other_details,
			addresses.is_default
			FROM
			customers
			LEFT JOIN customer_addresses ON customer_addresses.customer_id_fk = customers.id
			LEFT JOIN addresses ON customer_addresses.address_id_fk = addresses.id
			WHERE
			customers.id = '.$customer_id.' AND
			customer_addresses.is_for_invoice = 1';
			
			$q = $this->db->query($qry_str);
        	return $q->result()[0];
			
		}
		
		
		public function get_shipping_address_details($customer_id)
		{
			$qry_str=
			'SELECT
			customer_addresses.is_for_delivery,
			customer_addresses.is_for_invoice,
			addresses.id AS address_id,
			addresses.line_1,
			addresses.line_2,
			addresses.line_3,
			addresses.city,
			addresses.country_province,
			addresses.zip_code,
			addresses.coutry,
			addresses.other_details,
			addresses.attention,
			addresses.first_name AS address_f_name,
			addresses.last_name AS address_l_name,
			addresses.tel AS tel,
			addresses.is_default,
			counties_tr.`name` AS county_name,
			cities_tr.`name` AS city_name
			FROM
				customers
				LEFT JOIN customer_addresses ON customer_addresses.customer_id_fk = customers.id
				LEFT JOIN addresses ON customer_addresses.address_id_fk = addresses.id
				LEFT JOIN counties_tr ON addresses.country_province = counties_tr.id 
				LEFT JOIN cities_tr ON addresses.city = cities_tr.id
			WHERE
				customer_addresses.customer_id_fk = '.$customer_id.' AND
				customer_addresses.is_for_delivery  = 1
			ORDER BY
						addresses.is_default DESC
			';
			
			$q = $this->db->query($qry_str);
        	return $q->result();
			
		}
		
		public function add_shipping_address($address)
		{
			
			$qry_str=
			'INSERT into `addresses` SET
			line_1 = "'.$address['address1'].'",
			line_2 = "'.$address['address2'].'",
			line_3 = "'.$address['address3'].'",
			city = "'.$address['city'].'",
			country_province = "'.$address['region'].'",
			zip_code = "'.$address['zipcode'].'",
			adding_date = NOW(),
			is_active = "1",
			attention = "'.$address['attention'].'",
			first_name = "'.$address['firstname'].'",
			last_name = "'.$address['lastname'].'",
			tel = "'.$address['phone'].'",
			coutry = "'.$address['country'].'"
			';
			
			$q = $this->db->query($qry_str);
        	//return $q->result();
		}
		
		public function update_shipping_address($address)
		{
			$qry_str=
			'UPDATE `addresses` SET
			line_1 = "'.$address['address1'].'",
			line_2 = "'.$address['address2'].'",
			line_3 = "'.$address['address3'].'",
			city = "'.$address['city'].'",
			country_province = "'.$address['region'].'",
			zip_code = "'.$address['zipcode'].'",
			adding_date = NOW(),
			is_active = "1",
			attention = "'.$address['attention'].'",
			first_name = "'.$address['firstname'].'",
			last_name = "'.$address['lastname'].'",
			tel = "'.$address['phone'].'",
			coutry = "'.$address['country'].'"
			WHERE 
			id='.$address['id'];
			
			$q = $this->db->query($qry_str);
		}
		
		public function get_billing_address_id($customer_id)
		{
			$qry_str=
			'SELECT
				addresses.id
				FROM
				addresses
				INNER JOIN customer_addresses ON customer_addresses.address_id_fk = addresses.id
				WHERE
				customer_addresses.customer_id_fk = '.$customer_id.' AND
				customer_addresses.is_for_invoice = 1			';
			
			$q = $this->db->query($qry_str);
        	return $q->result();
		}
		
		public function update_billing_address($billing_address_id,$address)
		{
			
			$qry_str=
			'UPDATE `addresses` SET
			line_1 = "'.$address['address1'].'",
			line_2 = "'.$address['address2'].'",
			line_3 = "'.$address['address3'].'",
			city = "'.$address['city'].'",
			country_province = "'.$address['region'].'",
			zip_code = "'.$address['zipcode'].'",
			adding_date = NOW(),
			is_active = "1",
			coutry = "'.$address['country'].'"
			WHERE 
			id='.$billing_address_id;
			
			$q = $this->db->query($qry_str);
		}
		
		
	
}


?>