<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class checkout extends MX_Controller {

 function __construct()
    {
        parent::__construct();
        
         //load the language module
		$this->load->module("lng");
		
		//load the tamplate manager module
		$this->load->module('templateman');
		
		 //load the message module
		$this->load->module("msg");
		
		//load customer module
		$this->load->module("customer");
		
		$this->load->helper("url");
		
		$this->load->module("processor");
		
		$this->load->module("seo");
       
        
        //$this->load->model('checkout_mdl'); // needed for the template info (template path)
    }
    /////////////////////////// new checkout with ajax calls and call back ///////////////////////////
    public function check_regex_customer_data($card_num,$ccard_exp_month,$ccard_exp_year,$ccard_cvc,$shipping_address_id)
	{
		$regex_errors = 0;
		
		//lets regex /////////////////////
			
		// credit card number
		$re = '/\D+/';
		preg_match($re, $card_num, $matches200);
        if(!empty($matches200[0])) $regex_errors = 1 ;
        
        // credit card exp month
		$re = '/\D+/';
		preg_match($re, $ccard_exp_month, $matches201);
        if(!empty($matches201[0])) $regex_errors = 1 ;
        
        // credit card exp year
		$re = '/\D+/';
		preg_match($re, $ccard_exp_year, $matches202);
        if(!empty($matches202[0])) $regex_errors = 1 ;
        
        // credit card cvv
		$re = '/\D+/';
		preg_match($re, $ccard_cvc, $matches203);
        if(!empty($matches203[0])) $regex_errors = 1 ;
        
         // credit card cvv
		$re = '/\D+/';
		preg_match($re, $shipping_address_id, $matches204);
        if(!empty($matches204[0])) $regex_errors = 1 ;
	      
		return !$regex_errors ;	
		
	}
	
	public function check_regex_guest_data($sha_attention=NULL,$sha_firstname,$sha_lastname,$sha_sha_line1,
		$sha_sha_line2,$sha_country_select,	$sha_city_select,$sha_county_select,$sha_zip,$sha_phone,
		$ba_firstname,$ba_lastname,$ba_sha_line1,$ba_sha_line2,$ba_country_select,$ba_city_select,$ba_county_select,
		$ba_zip,$ba_phone,$ba_email,$pwd,$pwd2,$card_num,$ccard_exp_month,$ccard_exp_year,$ccard_cvc)
	{
		$regex_errors = 0	;
		
		//lets regex /////////////////////
			
		//attention
		if(!empty($sha_attention))
		{
		$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\()|(.*\\))|(.*\\=)|(.*\\:)|(.*\\;)/"; 
        preg_match($re, $sha_attention, $matches0);
        if(!empty($matches0[0])) $regex_errors = 1 ;
		}
		
		//firstname
		
		$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\()|(.*\\))|(.*\\=)|(.*\\:)|(.*\\;)/"; 
        preg_match($re, $sha_firstname, $matches1);
        if(!empty($matches1[0])) $regex_errors = 1 ;
		
		//lastname
		
		$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\()|(.*\\))|(.*\\=)|(.*\\:)|(.*\\;)/"; 
        preg_match($re, $sha_lastname, $matches2);
        if(!empty($matches2[0])) $regex_errors = 1 ;
		
		//shipping address line 1
		
		$re = "/(.*\\+)|(.*\\=)|(.*%)|(.*\\$)|(.*\\~)|(.*\\{)|(.*\\})|(.*\\^)|(.*\\*)|(.*\\;)|(.*\\\\)/"; 
        preg_match($re, $sha_sha_line1, $matches3);
        if(!empty($matches3[0])) $regex_errors = 1 ;
        
        //shipping address line 2
        $re = "/(.*\\+)|(.*\\=)|(.*%)|(.*\\$)|(.*\\~)|(.*\\{)|(.*\\})|(.*\\^)|(.*\\*)|(.*\\;)|(.*\\\\)/"; 
        preg_match($re, $sha_sha_line2, $matches4);
        if(!empty($matches4[0])) $regex_errors = 1 ;
        
        //country
		if (empty($sha_country_select)) $regex_errors = 1 ;
		
		//city
		if (empty($sha_city_select)) $regex_errors = 1 ;
		
		//county
		if (empty($sha_county_select)) $regex_errors = 1 ;
        
        //zip code
        
		$re = "/^\d{5}(?:[-\s]\d{4})?$/"; 
        preg_match($re, $sha_zip, $matches5);
        if(empty($matches5[0])) $regex_errors = 1 ;
        
        //phone
        $re = "/(.*\\=)|(.*,)|(.*\\\\)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\=)|(.*\\:)|(.*\\;)|[a-w]|[y-z]|[A-W]|[Y-Z]/"; 
        preg_match($re, $sha_phone, $matches10);
        if(!empty($matches10[0])) $regex_errors = 1 ;
        
        //////////////////////
        // 2nd address below 
        //////////////////////
        
        //firstname
		
		$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\()|(.*\\))|(.*\\=)|(.*\\:)|(.*\\;)/"; 
        preg_match($re, $ba_firstname, $matches100);
        if(!empty($matches100[0])) $regex_errors = 1 ;
		
		//lastname
		
		$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\()|(.*\\))|(.*\\=)|(.*\\:)|(.*\\;)/"; 
        preg_match($re, $ba_lastname, $matches101);
        if(!empty($matches101[0])) $regex_errors = 1 ;
		
		//shipping address line 1
		
		$re = "/(.*\\+)|(.*\\=)|(.*%)|(.*\\$)|(.*\\~)|(.*\\{)|(.*\\})|(.*\\^)|(.*\\*)|(.*\\;)|(.*\\\\)/"; 
        preg_match($re, $ba_sha_line1, $matches103);
        if(!empty($matches103[0])) $regex_errors = 1 ;
        
        //shipping address line 2
        $re = "/(.*\\+)|(.*\\=)|(.*%)|(.*\\$)|(.*\\~)|(.*\\{)|(.*\\})|(.*\\^)|(.*\\*)|(.*\\;)|(.*\\\\)/"; 
        preg_match($re, $ba_sha_line2, $matches104);
        if(!empty($matches104[0])) $regex_errors = 1 ;
        
        //country
		if (empty($ba_country_select)) $regex_errors = 1 ;
		
		//city
		if (empty($ba_city_select)) $regex_errors = 1 ;
		
		//county
		if (empty($ba_county_select)) $regex_errors = 1 ;
        
        //zip code
        
		$re = "/^\d{5}(?:[-\s]\d{4})?$/"; 
        preg_match($re, $ba_zip, $matches105);
        if(empty($matches105[0])) $regex_errors = 1 ;
        
        //phone
        $re = "/(.*\\=)|(.*,)|(.*\\\\)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\=)|(.*\\:)|(.*\\;)|[a-w]|[y-z]|[A-W]|[Y-Z]/"; 
        preg_match($re, $ba_phone, $matches111);
        if(!empty($matches111[0])) $regex_errors = 1 ;
        
        //////////////////////
        // 2nd address end
        //////////////////////
        
        
        // email
		$re = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/"; 
        preg_match($re, $ba_email, $matches6);
        if(empty($matches6[0])) $regex_errors = 1 ;
        
        //if email already exists (if javascripst did not stop user prior backend)  send him to login page
        $email_in_db = $this->customer->check_customer($ba_email);
        if($email_in_db) $regex_errors = 1 ;
        
        //password
		$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\-)|(.*\\|)|(.*\\/)|(.* )|(.*%)/"; 
        preg_match($re, $pwd, $matches8);
        if(!empty($matches8[0])) $regex_errors = 1 ;
        
        // confirm password
		$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\-)|(.*\\|)|(.*\\/)|(.* )|(.*%)/"; 
        preg_match($re, $pwd2, $matches9);
        if(!empty($matches9[0])) $regex_errors = 1 ;
       
		// credit card number
		$re = '/\D+/';
		preg_match($re, $card_num, $matches200);
        if(!empty($matches200[0])) $regex_errors = 1 ;
        
        // credit card exp month
		$re = '/\D+/';
		preg_match($re, $ccard_exp_month, $matches201);
        if(!empty($matches201[0])) $regex_errors = 1 ;
        
        // credit card exp year
		$re = '/\D+/';
		preg_match($re, $ccard_exp_year, $matches202);
        if(!empty($matches202[0])) $regex_errors = 1 ;
        
        // credit card cvv
		$re = '/\D+/';
		preg_match($re, $ccard_cvc, $matches203);
        if(!empty($matches203[0])) $regex_errors = 1 ;
	      
		return !$regex_errors ;
		//return 0 ; // for debugging
	}
	

	
    public function xcheckout_as_guest()
    {
		
		$this->load->model('customer_mdl');
		$lang_id = $this->lng->get_n_set_language_id();	
		
		//shipping address info
		$sha_attention 		= $this->input->get('na_attention',TRUE);
		$sha_firstname 		= $this->input->get('na_firstname',TRUE);
		$sha_lastname  		= $this->input->get('na_lastname',TRUE);
		$sha_sha_line1 		= $this->input->get('na_sha_line1',TRUE);
		$sha_sha_line2 		= $this->input->get('na_sha_line2',TRUE);
		$sha_country_select = $this->input->get('na_country_select',TRUE);
		$sha_city_select 	= $this->input->get('na_city_select',TRUE);
		$sha_county_select	= $this->input->get('na_county_select',TRUE);
		$sha_zip 			= $this->input->get('na_zip',TRUE);
		$sha_phone 			= $this->input->get('na_phone',TRUE);
		
		//same as shipping
		$same_as_shipping 	= $this->input->get('same_as_shipping',TRUE);
		
		// billing address info 
		$ba_firstname 			= $this->input->get('ba_firstname',TRUE);
		$ba_lastname 			= $this->input->get('ba_lastname',TRUE);
		$ba_sha_line1 			= $this->input->get('ba_sha_line1',TRUE);
		$ba_sha_line2 			= $this->input->get('ba_sha_line2',TRUE);
		$ba_country_select 		= $this->input->get('ba_country_select',TRUE);
		$ba_city_select 		= $this->input->get('ba_city_select',TRUE);
		$ba_county_select 		= $this->input->get('ba_county_select',TRUE);
		$ba_zip 				= $this->input->get('ba_zip',TRUE);
		$ba_phone 				= $this->input->get('ba_phone',TRUE);
		$ba_email 				= $this->input->get('ba_email',TRUE);
		
		//password
		$pwd  					= $this->input->get('na_login_password',TRUE);
		$pwd2 					= $this->input->get('na_confirm_password',TRUE);
		
		
		//credit card data
		$card_num 				= $this->input->get('na_card_num',TRUE);
		$ccard_exp_month 		= $this->input->get('na_ccard_month_select',TRUE);
		$ccard_exp_year 		= $this->input->get('na_ccard_year_select',TRUE);
		$ccard_cvc 				= $this->input->get('na_sec_code',TRUE);
		
		$chek_flag = $this->check_regex_guest_data($sha_attention=NULL,$sha_firstname,$sha_lastname,$sha_sha_line1,
		$sha_sha_line2,$sha_country_select,	$sha_city_select,$sha_county_select,$sha_zip,$sha_phone,
		$ba_firstname,$ba_lastname,$ba_sha_line1,$ba_sha_line2,$ba_country_select,$ba_city_select,$ba_county_select,
		$ba_zip,$ba_phone,$ba_email,$pwd,$pwd2,$card_num,$ccard_exp_month,$ccard_exp_year,$ccard_cvc);
		
		if($chek_flag)
		{
			// money money
			/*----------- SANITIZE BEGIN ------------------*/
			$card_data['CardNo'] 	= filter_var($card_num, FILTER_SANITIZE_NUMBER_INT);   
			$card_data['ExpMonth']	= filter_var($ccard_exp_month, FILTER_SANITIZE_NUMBER_INT);   
			$card_data['ExpYear']   = filter_var($ccard_exp_year, FILTER_SANITIZE_NUMBER_INT);   
			$card_data['CVV2'] 		= filter_var($ccard_cvc, FILTER_SANITIZE_NUMBER_INT); 
			/*----------- SANITIZE END ------------------*/
			
			
			//add customer and billing address
			
			$customer['firstname']			=	$ba_firstname ;
			$customer['lastname']			=	$ba_lastname ;
			$customer['month_select']		=	"" ;
			$customer['date_select']		=	"" ;
			$customer['year_select']		=	"" ;
			$customer['gender']				=	"2" ;
			$customer['email']				=	$ba_email ;
			$customer['password']			=	$pwd ;
			$customer['primary_lang']		=	$lang_id ;
			$customer['newsletter']			=	1;
			$customer['phone']				=	$ba_phone;
			$customer["status_id"]			=   1 ; // active
	
			$this->customer_mdl->save_customer($customer);
			
			//add shipping address
			
			$sha_address['attention']	=	$sha_attention ;
			$sha_address['firstname']	=	$sha_firstname ;
			$sha_address['lastname']	=	$sha_lastname ;
			$sha_address["address1"] 	= 	$sha_sha_line1;
        	$sha_address["address2"]	= 	$sha_sha_line2;
        	$sha_address["address3"] 	= 	"";
        	$sha_address["country"] 	= 	$sha_country_select ;
        	$sha_address["city"] 		= 	$sha_city_select;
        	$sha_address["region"] 		= 	$sha_county_select;
        	$sha_address["zipcode"] 	= 	$sha_zip;
			$sha_address['phone']		=	$sha_phone;
			
        	$this->customer_mdl->add_shipping_address($sha_address);
        	
        	// link customer to shipping address get the last customer id from customers and the last address id from addresses and link them, the 2nd parameter is the type of the address (SHIPPING / BILLING / BOTH)
			$this->customer->link_customer_address(NULL,"SHIPPING");
			
			//add billing address
        	$ba_address['firstname']	=	$ba_firstname ;
			$ba_address['lastname']		=	$ba_lastname ;
			$ba_address["address1"] 	=	$ba_sha_line1;
        	$ba_address["address2"]		=	$ba_sha_line2;
        	$ba_address["address3"] 	=	"";
        	$ba_address["country"] 		=	$ba_country_select;
        	$ba_address["city"] 		=	$ba_city_select;
        	$ba_address["region"] 		=	$ba_county_select;
        	$ba_address["zipcode"] 		=	$ba_zip;
        	
			$this->customer_mdl->add_address($ba_address);
			
        	// link customer to billing address get the last customer id from customers and the last address id from addresses and link them, the 2nd parameter is the type of the address (SHIPPING / BILLING / BOTH)
			$this->customer->link_customer_address(NULL,"BILLING");
			
			//get the user id 
			$user_id = $this->customer->get_user_id($customer['email']);
			
			//we should have his id now since we added him with save_customer()
			if(empty($user_id))
			{
				$xdata["user_not_found_flag"] = "1" ;
				$data_json = json_encode($xdata);
				echo $data_json;
			}
			else
			{
				//log user in 
				$this->load->model('checkout_mdl');
				$customer_info = $this->checkout_mdl->get_user_info($customer['email']);
				$user_id =  $customer_info[0]->id;
				$first_name =  $customer_info[0]->first_name;
				$this->session->set_userdata('user_id', $user_id);
				$this->session->set_userdata('first_name', $first_name);
				
				// send welcome email
				{
					$this->load->module('emaily');
					$email_flag = $this->emaily->send_welcome($user_id);
		            
					if ( $email_flag == "email_error")
					{
					    // email problem
					    
					    $xdata["welcome_email_flag"] = "0";
						$data_json = json_encode($xdata);
						//echo $data_json;
						//todo pass this flag to the next method  process_cart_order and the next next method process_payment() 
					}
					else
					{
						// ok email sent!
						$xdata["welcome_email_flag"] =  "1";
						$data_json = json_encode($xdata);
						//echo $data_json;
						//todo pass this flag to the next method  process_cart_order and the next next method process_payment() 
					    
					}
					
				}
				
				
				$customer_address_delivery_id = $this->customer->get_customer_address_delivery_id($user_id);
				
				$is_guest=TRUE;
				$this->process_cart_order($user_id,$customer_address_delivery_id,$card_data,$is_guest);
				
				
				
			}

		}
		else
		{
			//data not passing regex filters (maybe javascript is not activated on browser ? )
			
			$xdata["regex_error"] =  "1";
			$data_json = json_encode($xdata);
			echo $data_json;
		}

	}
	
	public function xcheckout_as_customer()
    {
		$card_num 				= $this->input->get('ccard_num',TRUE);
		$ccard_exp_month 		= $this->input->get('ccard_exp_month',TRUE);
		$ccard_exp_year 		= $this->input->get('ccard_exp_year',TRUE);
		$ccard_cvc 				= $this->input->get('ccard_cvc',TRUE);
		$shipping_address_id	= $this->input->get('shipping_address_id',TRUE);

		$chek_flag = $this->check_regex_customer_data($card_num,$ccard_exp_month,$ccard_exp_year,$ccard_cvc,$shipping_address_id);
		
		if($chek_flag)
		{
			$user_id = $this->session->userdata("user_id");
			if(!empty($user_id))
			{
				
				/*----------- SANITIZE BEGIN ------------------*/
				$card_data['CardNo'] 	= filter_var($card_num, FILTER_SANITIZE_NUMBER_INT);   
				$card_data['ExpMonth']	= filter_var($ccard_exp_month, FILTER_SANITIZE_NUMBER_INT);   
				$card_data['ExpYear']   = filter_var($ccard_exp_year, FILTER_SANITIZE_NUMBER_INT);   
				$card_data['CVV2'] 		= filter_var($ccard_cvc, FILTER_SANITIZE_NUMBER_INT); 
				$shipping_address_id = filter_var($shipping_address_id, FILTER_SANITIZE_NUMBER_INT);   
				/*----------- SANITIZE END ------------------*/
				
				$customer_address_delivery_id = $shipping_address_id;   
				
				$is_guest=FALSE;
				$this->process_cart_order($user_id,$customer_address_delivery_id,$card_data,$is_guest);
				
			}
			else
			{
				//session expired
				$xdata["sessionexpired_flag"] =  "1";
				$data_json = json_encode($xdata);
				echo $data_json;
			}
		}
		else
		{
			//data not passing regex filters (maybe javascript is not activated on browser ? )
			$xdata["regex_error"] =  "1";
			$data_json = json_encode($xdata);
			echo $data_json;
			
		}
	}
	
	
	// save cart to disk and order to db
	public function process_cart_order($user_id,$customer_address_delivery_id,$card_data,$is_guest)
	{
		$customer_take_care_of_customs = 0;
		$customer_take_care_of_customs = (bool)$this->input->cookie('bool_customer_take_care_of_customs', TRUE);
		if($customer_take_care_of_customs) $customer_take_care_of_customs =1; else $customer_take_care_of_customs = 0;
				
		$prices = $this->calc($customer_take_care_of_customs);
		
		$customer_address_invoice_id  = $this->customer->get_customer_address_invoice_id($user_id);
		
		
		$shop_id = 1;
		$lang_id = $this->lng->get_n_set_language_id();	
		
		$this->load->module("carta");
		// flag for adding new cart 
		$flag_cart = $this->carta->add_new_cart($shop_id,$lang_id,$customer_address_delivery_id,$customer_address_invoice_id,$user_id);
		
		// get last cart id 
		$last_cart_id = $this->carta->get_last_cart_id();
		
		//create a new order
		$this->load->module("orders");
		$currency_id = 840; // for dollar
		$flag_order = $this->orders->add_new_order($user_id,$last_cart_id,$customer_address_delivery_id,$customer_address_invoice_id,$currency_id);
		if($flag_order)
		{
			
			//get last order id
			$last_order_id =  $this->orders->get_last_order_id();
			
			//save cart content to a file on the server 
			$flag =$this->save_cart($last_order_id);
			$cart_content_file = ($flag > 0)? './data/orders/'.$last_order_id.'.gzip':'';
			
			$this->load->module('price_rules');
			$number_of_items 				= $this->cart->total_items(); 
			$shipping_factor_money_value 	= $this->price_rules->get_price_rule_value('ship_factor_monney');
			$start_up_shipping_value 		= $this->price_rules->get_price_rule_value('ship_start_value');
			$customs_rate 					= $this->price_rules->get_price_rule_value('6');
			
			//order details for admin
			$order_sub_total 		= $prices["order_sub_total"]; 
			$grand_total 			= $prices["grand_total"] ;
			$service_fee 			= $prices["service_fee"];
			$shipping_fee_total 	= $prices["shipping_fee_total"];
			$total_custom_fee 		= $prices["total_custom_fee"];
			$total_tax 				= $prices["total_tax"];
			$total_credit_card_fee 	= $prices["total_credit_card_fee"];
			//order details for customer
			$v_order_sub_total 				= $prices['order_sub_total'] 			;
			$v_shipping_and_handling_fee 	= $prices['shipping_and_handling_fee'] ;
			$v_discount_total 			    = $prices['discount_total'] 			;
			$v_subtotal						= $prices['subtotal'] 				;
			$v_optional_custom_fees 		= $prices['optional_custom_fees'] 	;
			$v_grand_total 					= $prices['grand_total'] 				;
			
			//~~~~save order details~~~~~//
			$flag_order_details = $this->orders->add_order_details(
			$last_order_id,$total_custom_fee,$order_sub_total,$shipping_fee_total,$service_fee,$grand_total,
			$total_tax,$total_credit_card_fee,$number_of_items,$cart_content_file,$shipping_factor_money_value,
			$start_up_shipping_value,$customs_rate,$v_order_sub_total,$v_shipping_and_handling_fee,
			$v_discount_total,$v_subtotal,$v_optional_custom_fees,$v_grand_total);
		
			if($flag_order_details)
				$this->process_payment($user_id,$customer_address_invoice_id,$card_data,$grand_total,$last_order_id,$is_guest);
			else
			{
				$xdata["orderdetailserror_flag"] =  "1";
				$data_json = json_encode($xdata);
				echo $data_json;			
			}
		}
		else
		{
			$xdata["ordererror_flag"] =  "1";
			$data_json = json_encode($xdata);
			echo $data_json;
			
			//delete user if is a guest 
			//if is a guest delete user 
				if($is_guest)	
				{
					$this->checkout_mdl->delete_user($user_id);
					$this->session->set_userdata('user_id', NULL); // kick him out of session  
					$this->session->set_userdata('first_name', NULL); // kick him out of session  
					
				}
		}
	}
	
	private function process_payment($user_id,$customer_address_invoice_id,$card_data,$grand_total,$last_order_id,$is_guest)
	{
		
		$db_billing_address_details = $this->customer->get_address_details_no_ajax($customer_address_invoice_id );
		//we need those two variables for the eprocessing 
		$db_billing_address_line1= $db_billing_address_details->line_1;
		$db_billing_address_zipcode= $db_billing_address_details->zip_code;
		
		//processing credit card
		$this->load->library('PHPRequests');
        
        //get the card processing account from database
        $account_info 	= $this->processor->get_account_info();
        $ePNAccount 	= $account_info->epn_account;
        $RestrictKey 	= $account_info->restrict_key;
        $TranType 		= $account_info->tran_type;
        $CVV2Type 		= $account_info->cvv2type;
        $HTML 			= $account_info->html;
        
        $this->load->model("checkout_mdl");
        $customer_email = $this->checkout_mdl->get_customer_email($user_id);
        
        $grand_total = 2.00; //  for debugging 
        
        //use this array for production 
        
        /*
        $payment_data = array(
         'ePNAccount' 	=> $ePNAccount,
         'CardNo' 		=> $card_data['CardNo'] ,
         'ExpMonth' 	=> $card_data['ExpMonth'],
         'ExpYear' 		=> $card_data['ExpYear'],
         'Total' 		=> $grand_total,
         'Address' 		=> $db_billing_address_line1,
         'Zip' 			=> $db_billing_address_zipcode,
         'EMail' 		=> $customer_email,
         'CVV2Type' 	=> $CVV2Type,
         'CVV2' 		=> $card_data['CVV2'],
         'HTML' 		=> $HTML,
         'RestrictKey' 	=> $RestrictKey,
         'TranType' 	=> $TranType
         );
         */
        
         
         //use this array for devlopment and testing a virtual credit card
         
     
        $oo = 55 ;
         
        
         $payment_data = array(
         'ePNAccount' => '080880',
         'CardNo' => '4111111111111111',
         'ExpMonth' => '12',
         'ExpYear' => '09',
         'Total' => $grand_total,
         //'Address' => '123  Fake  St.',
         'Address' => '123  sesame street',
         'Zip' => '12345',
         'EMail' => 'email@address.com',
         'CVV2Type' => '1',
         'CVV2' => '123',
         'HTML' => 'No',
         'RestrictKey' => 'yFqqXJh9Pqnugfr',
         'TranType' => 'Sale'
         );
         

		// for more info about the response , see https://www.epnreseller.com/docs/tdbe/TDBE.pdf (page 8-9)
		$response = @Requests::post('https://www.eprocessingnetwork.com/cgi-bin/tdbe/transact.pl', array(), $payment_data);
		
		//check if payement server is ok 
		if(!empty($response) )
		{
			//if response yes got to ok menu 
			//else decline the purchase 
			
			$response_body = $response->body; // get the body of the response
			//$response_body_csv = strip_tags($response_body_html); // remove html tags if HTML was not se to NO  in the request
			$response_body_csv = str_replace('"', '', $response_body); // remove double quotes
			$response_body_arr = explode(',',$response_body_csv);
			
			if (!empty($response_body_arr[0])) 
			{
				$response_body_data['transaction_response'] = $response_body_arr[0];
				$first_character = $response_body_arr[0][0];
			}
			if (!empty($response_body_arr[1])) $response_body_data['avs_response'] 		= $response_body_arr[1];
			if (!empty($response_body_arr[2])) $response_body_data['cvv2_response'] 	= $response_body_arr[2];
			if (!empty($response_body_arr[3])) $response_body_data['invoice_number'] 	= $response_body_arr[3];
			if (!empty($response_body_arr[4])) $response_body_data['transaction_id'] 	= $response_body_arr[4];
			
			$data['response'] 			= $response_body_data ;
			$data['first_character'] 	= $first_character ;
			
			//if approved empty cart 
			if($first_character == "Y" )
			{
				// ok approved
				
				//empty the cart 
				$this->load->module('carta');
				$this->carta->clean_up();
				//$this->cart->destroy();
				
				//delete user temporary cart from disk 
				$file_full_name = './data/carts_temp/users/'.$user_id.'.gzip';
				if (file_exists($file_full_name)) 
				{
					unlink($file_full_name);
				}
				
				// send email
				{
					$this->load->module('emaily');
					$result = $this->emaily->send_order_is_taken($last_order_id);
					if ( !$result)
					{
					    //$data["message_status"] = 'well that\'s embarassing ...we have a technical problem during emailing your verification email';
					    //$data["message_status"] = $this->msg->get_translated_message(41);
					    
					    $xdata["order_id"] = $last_order_id ;
						$xdata["user_f_name"] = $this->session->userdata('first_name');
					    
					    //$xdata["msg"] =  "order_1-payement_1-email_0";
					    $xdata["order_flag"] =  "1";
					    $xdata["payement_flag"] =  "1";
					    $xdata["email_flag"] =  "0";
						
						$data_json = json_encode($xdata);
			
					    echo $data_json;
					    
					}
					else
					{
						// ok email sent!
						//$data['order_email_was_sent'] = TRUE ;
						
						$xdata["order_id"] = $last_order_id ;
						$xdata["user_f_name"] = $this->session->userdata('first_name');
						
						//$xdata["msg"] =  "order_1-payement_1-email_1";
						$xdata["order_flag"] =  "1";
					    $xdata["payement_flag"] =  "1";
					    $xdata["email_flag"] =  "1";
						
						$data_json = json_encode($xdata);
					    
					    echo $data_json;
					}
					
				}
				//end send email
				
			}
			else
			{
				//declined
				$this->checkout_mdl->delete_order($last_order_id);
				
				//if is a guest delete user 
				if($is_guest)	
				{
					$this->checkout_mdl->delete_user($user_id);
					$this->session->set_userdata('user_id', NULL); // kick him out of session  
					$this->session->set_userdata('first_name', NULL); // kick him out of session  
					
				}
				
				$xdata["declined_flag"] =  "1";
						
				$data_json = json_encode($xdata);
					    
				echo $data_json;
				
				//delete last order 
			}
		}
		else
		{
			//error during connecting to payment server
			//we had a problem with payement, then the order should be deleted from db 
			//delete last order 
			$this->checkout_mdl->delete_order($last_order_id);
			
			//if is a guest delete user 
			if($is_guest)	
				{
					$this->checkout_mdl->delete_user($user_id);
					$this->session->set_userdata('user_id', NULL); // kick him out of session  
					$this->session->set_userdata('first_name', NULL); // kick him out of session  
					
				}
			
			//$data["response"] = "error during connecting to payment server... plz try again";
			//$data["response"] = $this->msg->get_translated_message(120);
			$xdata["conn_error_flag"] =  "1";
						
			$data_json = json_encode($xdata);
					    
			echo $data_json;
				
			
			
			
			
		}
	}
	
    //save cart content to a file on the server 
	public function save_cart($last_order_id)
	{
		$cart_content = $this->cart->contents(); // get cart contents
		$cart_content_j_encoded = json_encode($cart_content); // encode it to json string
		$compressed = gzencode($cart_content_j_encoded, 9); // compress the json string 
		$cart_content_file = './data/orders/'.$last_order_id.'.gzip';
		$flag = file_put_contents($cart_content_file,$compressed); // save cart to file on server
		return $flag ; // if > 0 it is success False if fail
	}
    
    public function check()
    {
		$lang_id = $this->lng->get_n_set_language_id();	
		
		$user_id_from_session 			= $this->session->userdata('user_id');
		if(empty($user_id_from_session))
		// call the checkout for a customer or guest view 
		{
			$data['words'] 		  = $this->msg->get_words("precheckout");
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			$data['wrong_email'] = $this->input->get('wronge');
			$data['wrong_email_or_password'] = $this->input->get('wrong');
			
			//SEO
			$data['meta_info']  =  $this->seo_mdl->get_meta_info("pre_checkout",$lang_id);// get the meta info from database 
			
			//call the view
			$data['template_info'] = $this->templateman->get_template_info(1); // get the template details   
		
			$this->load->view($data['template_info']['path'].'/common/css_https',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header_https',$header_data);  
	         
	        $this->load->view($data['template_info']['path'].'/pre_checkout_vew', $data);
	        
	        $this->load->view($data['template_info']['path'].'/common/footer_https',$footer_data);  
	        $this->load->view($data['template_info']['path'].'/common/script_pre_checkout_https'); 
		}
		else
		{
			//trigger customer checkout
			$this->customer_checkout();
		}
	}
	
	public function guest_checkout()
    {
    	$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
		
		
		//get turkey cities
		$this->load->module('addressman');
		$data['cities_tr'] = $this->addressman->get_cities_tr();
		$data['counties_tr'] = $this->addressman->get_all_counties_tr();
		
		//get the applied promotion codes
		$cart_contents = $this->cart->contents();
		$applied_promotions = array();
		foreach($cart_contents as $cc)
		{
			if(!empty($cc['promo_code']))
			{
				$applied_promotions[] = $cc['promo_code'] ;
				array_unique($applied_promotions) ;
			}
		}
		$data['applied_promotions'] = $applied_promotions;
		
		
		// customer take care of customs
		$customer_take_care_of_customs = 0;
		$customer_take_care_of_customs = (bool)$this->input->cookie('bool_customer_take_care_of_customs', TRUE);
		if($customer_take_care_of_customs) $customer_take_care_of_customs =1; else $customer_take_care_of_customs = 0;
				
		//prepare prices 
		$prices = $this->calc($customer_take_care_of_customs);
		
		$data["order_sub_total"] 			= 		$prices["order_sub_total"];
		$data["shipping_and_handling_fee"] 	= 		$prices["shipping_and_handling_fee"];
		$data["discount_total"] 			= 		$prices["discount_total"];
		$data["subtotal"] 					= 		$prices["subtotal"];
		$data["optional_custom_fees"] 		= 		$prices["optional_custom_fees"];
		$data["grand_total"] 				= 		$prices["grand_total"];
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
		
		$script_data['currency'] = $CURRENCY;
		$script_data['rate'] = $RATE;		
		$script_data['customer_take_care_of_customs_cookie'] = $customer_take_care_of_customs;
		
		$this->load->module("msg");
		$data['words'] 	=	$this->msg->get_words("checkout_guest");
		
		//SEO
		$lang_id = $this->lng->get_n_set_language_id();		
		$data['meta_info']  =  $this->seo_mdl->get_meta_info("guest_checkout",$lang_id);// get the meta info from database
		
		//call the view
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details   
	
		$this->load->view($data['template_info']['path'].'/common/css_https',$data);  
        $this->load->view($data['template_info']['path'].'/common/header_https',$header_data);  
         
        $this->load->view($data['template_info']['path'].'/checkout_guest_vew', $data);
        
        $this->load->view($data['template_info']['path'].'/common/footer_https',$footer_data);  
        $this->load->view($data['template_info']['path'].'/common/script_guest_checkout_https',$script_data);
    	
    }
    public function customer_checkout()
    {
		
		//get the user_id from the session 
		$user_id =  $this->session->userdata("user_id");
		
		$cart_contents = $this->cart->contents();
		
		// if the session did not expire
		if(!empty($user_id) and !empty($cart_contents))
		{
			//get customer details
			$shipping_address_details = $this->customer_mdl->get_shipping_address_details($user_id);
			$data['shipping_address_details'] = $shipping_address_details;
			
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			
			//get turkey cities
			$this->load->module('addressman');
			$data['cities_tr'] = $this->addressman->get_cities_tr();
			$data['counties_tr'] = $this->addressman->get_all_counties_tr();
			
			//get the applied promotion codes
			
			$applied_promotions = array();
			foreach($cart_contents as $cc)
			{
				if(!empty($cc['promo_code']))
				{
					$applied_promotions[] = $cc['promo_code'] ;
					array_unique($applied_promotions) ;
				}
			}
			$data['applied_promotions'] = $applied_promotions;
			
			
			// customer take care of customs
			$customer_take_care_of_customs = 0;
			$customer_take_care_of_customs = (bool)$this->input->cookie('bool_customer_take_care_of_customs', TRUE);
			if($customer_take_care_of_customs) $customer_take_care_of_customs =1; else $customer_take_care_of_customs = 0;
					
			//prepare prices 
			$prices = $this->calc($customer_take_care_of_customs);
			
			$data["order_sub_total"] 			= 		$prices["order_sub_total"];
			$data["shipping_and_handling_fee"] 	= 		$prices["shipping_and_handling_fee"];
			$data["discount_total"] 			= 		$prices["discount_total"];
			$data["subtotal"] 					= 		$prices["subtotal"];
			$data["optional_custom_fees"] 		= 		$prices["optional_custom_fees"];
			$data["grand_total"] 				= 		$prices["grand_total"];
			
			// currency
			$this->load->module('currency');
			$this->currency->set_currency(); // no parameter ==> usd will be the default
			$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
			$RATE = $this->session->userdata("CUR_RATE");
			
			$data['currency'] = $CURRENCY;
			$data['rate'] = $RATE;
			
			$script_data['currency'] = $CURRENCY;
			$script_data['rate'] = $RATE;		
			$script_data['customer_take_care_of_customs_cookie'] = $customer_take_care_of_customs;
			
			//words and languages
			$this->load->module("msg");
			$data['words'] 		  =	$this->msg->get_words("customer_checkout");
			//$script_data['words'] =	$this->msg->get_words("cart");
			
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			//get customer details
			$customer_and_billing_address_details = $this->customer_mdl->get_customer_and_billing_address_details($user_id);
			$data['customer'] = $customer_and_billing_address_details;
			
			//SEO
			$lang_id = $this->lng->get_n_set_language_id();		
			$data['meta_info']  =  $this->seo_mdl->get_meta_info("customer_checkout",$lang_id);// get the meta info from database
			
			//call the view
			$data['template_info'] = $this->templateman->get_template_info(1); // get the template details   
		
			$this->load->view($data['template_info']['path'].'/common/css_https',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header_https',$header_data);  
	         
	        $this->load->view($data['template_info']['path'].'/checkout_customer_vew', $data);
	        
	        $this->load->view($data['template_info']['path'].'/common/footer_https',$footer_data);  
	        $this->load->view($data['template_info']['path'].'/common/script_customer_checkout_https',$script_data);
    	}
		else
		{
			$this->load->module('customer');
			$this->customer->my_account();
			
		}
	}
	
    
	public function info()
	{
		$customer_take_care_of_customs = 0;
		$customer_take_care_of_customs = (bool)$this->input->cookie('bool_customer_take_care_of_customs', TRUE);
		
		if($customer_take_care_of_customs) $customer_take_care_of_customs =1; else $customer_take_care_of_customs = 0;
		
		$prices = $this->calc($customer_take_care_of_customs);
			
		$data["order_sub_total"] 			= 		$prices["order_sub_total"];
		$data["shipping_and_handling_fee"] 	= 		$prices["shipping_and_handling_fee"];
		$data["discount_total"] 			= 		$prices["discount_total"];
		$data["subtotal"] 					= 		$prices["subtotal"];
		$data["optional_custom_fees"] 		= 		$prices["optional_custom_fees"];
		$data["grand_total"] 				= 		$prices["grand_total"];
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
			
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
		
		
		$script_data['customer_take_care_of_customs_cookie'] = $customer_take_care_of_customs;
		
		
		$cc = $this->cart->contents(); //todo /////---->delete this if not needed 
		
		$oo = 55 ; 
		
		//check products availability before checkout
		$cart_items_in_stock = $this->check_cart_items_availability();
		
		if( $cart_items_in_stock == "cart_empty")
		{
			//session expired
			redirect(base_url()."login");	
		}
		
		
		//get user details if logged in 
		$user_id_from_session 			= $this->session->userdata('user_id');
		
		// Note : if $customer_details is false then the user is a guest
		$customer_details 				= $this->customer->get_customer_details($user_id_from_session);
		
		if($customer_details) 
		{
			$customer_delivery_addresses 	= $this->customer->get_customer_delivery_addresses($user_id_from_session);
			$customer_billing_addresses 	= $this->customer->get_customer_invoice_addresses($user_id_from_session);
		}
		
		$data["customer_details"] 				= $customer_details;
		if(isset($customer_delivery_addresses))
		$data["customer_delivery_addresses"] 	= $customer_delivery_addresses;
		
		if(isset($customer_billing_addresses)) 
		$data["customer_billing_addresses"] 	= $customer_billing_addresses;
		
		$this->load->helper("url");
		
		// get the language from the session 
		$lang_id = $this->lng->get_n_set_language_id();	
		
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details   
		$template_path_info = $data['template_info']['path'];
		
		$this->load->model('home_mdl');
		
		// prepare the metadata information for the view page
		$data['meta_description'] =   "checkout";
		$data['meta_keywords']    =   "checkout";
		$data['page_title'] 	   =   "checkout";
		$data['meta_info']  =  $this->home_mdl->get_meta_info($lang_id);// get the meta info from database 
		
		//// form controller + validation
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('firstname', 'the first name ', 'required');
		$this->form_validation->set_rules('lasname', 'Last name', 'required');
		$this->form_validation->set_rules('address1', 'Address Line 1', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('zipcode', 'postal code (zip code)', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		$this->form_validation->set_rules('lasname', 'Last name', 'required');
		//$this->form_validation->set_rules('phone', 'Phone number', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('email_confirm', 'Email', 'required|matches[email]');
		
		// validating the billing address
		$this->form_validation->set_rules('billing_address1', 'Address Line 1', 'required');
		$this->form_validation->set_rules('billing_city', 'City', 'required');
		$this->form_validation->set_rules('billing_zipcode', 'postal code (zip code)', 'required');
		$this->form_validation->set_rules('billing_country', 'Country', 'required');
		
		// validating the payment card
		$this->form_validation->set_rules('billing_address1', 'Address Line 1', 'required');
		
		//if the form validation fails 
		if (($this->form_validation->run() == FALSE) or ($cart_items_in_stock != "ok"))
		{
			
			if($cart_items_in_stock != "ok")
			{
				//list of product ids that are no longer in stock 
				$data["product_ids_not_in_stock"] =   $cart_items_in_stock;
			}
			
			//get wording for the page 
	   		$data['words'] = $this->msg->get_words("checkout");
	   		$this->load->model('checkout_mdl');
			$data['countries']  = $this->checkout_mdl->get_countries();

			
			//call the view
			$this->load->view($template_path_info.'/common/css_checkout',$data);  
		    $this->load->view($template_path_info.'/common/header_checkout');  
		    //$this->load->view($template_path_info.'/common/slider');  
		    
			$this->load->view($template_path_info.'/checkout_vew',$data); 
		    
		    $this->load->view($template_path_info.'/common/footer_checkout');  
		    $this->load->view($template_path_info.'/common/script_checkout',$script_data); 
			
		}
		// if the form is ok 
		else
		{
			//$this->load->view($template_path_info.'/checkout_ok_vew',$data); 
			
			$this->step2();
		}
			

	}
	
	// the form was filled properly now save customer informations and process the order
	//depricated need to be deleted after few tests
	public function step22222()
	{
		$customer_take_care_of_customs = 0;
		$customer_take_care_of_customs = (bool)$this->input->cookie('bool_customer_take_care_of_customs', TRUE);
		
		if($customer_take_care_of_customs) $customer_take_care_of_customs =1; else $customer_take_care_of_customs = 0;
		
		
		$prices = $this->calc($customer_take_care_of_customs);
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
			
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
		
		$script_data['customer_take_care_of_customs_cookie'] = $customer_take_care_of_customs;
		
		//get wording for the page 
	   	$data['words'] = $this->msg->get_words("checkout");
		
		$oo = 55 ;
		$this->load->helper("url");
		
		// get the language from the session 
		$lang_id = $this->lng->get_n_set_language_id();	
		
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details   
		$template_path_info = $data['template_info']['path'];
		
		
		$this->load->model('home_mdl');
	
		$data['template_info'] = $this->home_mdl->get_template_info();// get the template for the active shop 
		// prepare the metadata information for the view page
		$data['meta_description'] =   "checkout";
		$data['meta_keywords']    =   "checkout";
		$data['page_title'] 	   =   "checkout";
		$data['meta_info']  =  $this->home_mdl->get_meta_info($lang_id);// get the meta info from database 
		
		//echo "processing ...." ;
		
		//card information
		$CardNo 	= $this->input->post('card_no',TRUE);
		$ExpMonth 	= $this->input->post('exp_month',TRUE);
		$ExpYear 	= $this->input->post('exp_year',TRUE);
		$CVV2 		= $this->input->post('cvv2',TRUE);
		
		// -------------    sending data to database 
		$firstname 	= $this->input->post('firstname',TRUE);
		$lasname 	= $this->input->post('lasname',TRUE);
		$email 		= $this->input->post('email',TRUE);
		//$phone 		= $this->input->post('phone',TRUE);
		$phone 		= "123 123 123"; ////////---------------------------------------------------------------------- //todo       to channnnge 
		$alt_phone 	= $this->input->post('alt_phone',TRUE);

		//shipping address data
		$delivery_address_id = $this->input->post('shipping_address_id',TRUE);
		$delivery_address1 	= $this->input->post('address1',TRUE);
		$delivery_address2 	= $this->input->post('address2',TRUE);
		$delivery_address3 	= $this->input->post('address3',TRUE);
		$delivery_city 		= $this->input->post('city',TRUE);
		$delivery_region 	= $this->input->post('region',TRUE);
		$delivery_zipcode 	= $this->input->post('zipcode',TRUE);
		$delivery_country 	= $this->input->post('country',TRUE);
		
		//if same as billing address was not checked 
		$billing_address_is_delivery_address = $this->input->post('same_as_shipping',TRUE);
		if($billing_address_is_delivery_address == FALSE)
		{
			//billing address data
			$billing_address_id = $this->input->post('billing_address_id',TRUE);
			$billing_address1 	= $this->input->post('billing_address1',TRUE);
			$billing_address2 	= $this->input->post('billing_address2',TRUE);
			$billing_address3 	= $this->input->post('billing_address3',TRUE);
			$billing_city 		= $this->input->post('billing_city',TRUE);
			$billing_region 	= $this->input->post('billing_region',TRUE);
			$billing_zipcode 	= $this->input->post('billing_zipcode',TRUE);
			$billing_country 	= $this->input->post('billing_country',TRUE);
		}
		else // the checkbox (same_as_shipping) was checked
		{
			//billing address data
			$billing_address_id = $delivery_address_id	;
			$billing_address1 	= $delivery_address1 	;
			$billing_address2 	= $delivery_address2 	;
			$billing_address3 	= $delivery_address3 	;
			$billing_city 		= $delivery_city 		;
			$billing_region 	= $delivery_region 		;
			$billing_zipcode 	= $delivery_zipcode 	;
			$billing_country 	= $delivery_country 	;
		}
		
		
		
		$satus_id = 1 ; // active
		
		//get the primary customer language id from the current session ==> can be updated from customer details page
		$prim_lang_id = $this->lng->get_n_set_language_id();	
		
		$delivery_address = array("id"=>$delivery_address_id ,"address1"=>$delivery_address1 , "address2"=>$delivery_address2, "address3"=>$delivery_address3, "city"=>$delivery_city, "region"=>$delivery_region, "zipcode"=>$delivery_zipcode, "country"=>$delivery_country);
		$billing_address  = array("id"=>$billing_address_id  ,"address1"=>$billing_address1 ,  "address2"=>$billing_address2,  "address3"=>$billing_address3,  "city"=>$billing_city,  "region"=>$billing_region,  "zipcode"=>$billing_zipcode,  "country"=>$billing_country);
		
		$this->load->module("customer");
		
		//check if customer is already in database 
		$is_customer = $this->customer->check_customer($email); 
		
		$user_id = $this->session->userdata("user_id");
		$not_loged_in = empty($user_id);
		
		if($is_customer and $not_loged_in) 
		{
			//goto login screen
			 redirect(base_url()."login/userlogin");	
		}
		else
		{
			// if he is not a customer then add his details info + address
			if(!$is_customer)
			{
				// path B
				// if not a customer, generate a random temporary password to be sent via email so he can login
				
				//this is the temporary password for the customer to be sent via email
				$password_random = $this->randomPassword();
				//this is the crypted password for the customer to be stored in database
				$password = md5(sha1($password_random));
				
				$customer_data = array("firstname"=>$firstname , "lasname"=>$lasname, "phone"=>$phone, "alt_phone"=>$alt_phone, "email"=>$email, "prim_lang_id"=>$prim_lang_id,"status_id"=>$satus_id,"password"=>$password );
				
				//create a delivery address for the  customer
				$this->customer->add_address($delivery_address);
				
				// create a customer
				$this->customer->add_customer($customer_data);
				
				// link customer to shipping address get the last customer id from customers and the last address id from addresses and link them, the 2nd parameter is the type of the address (SHIPPING / BILLING / BOTH)
				$this->customer->link_customer_address(NULL,"SHIPPING");
				
				//if shipping address != billing address
				if
				(
					($delivery_address1 != $billing_address1) 	or
					($delivery_address2 != $billing_address2) 	or 
					($delivery_address3 != $billing_address3) 	or 
					($delivery_city 	!= $billing_city) 		or 
					($delivery_region 	!= $billing_region)		or		 
					($delivery_zipcode 	!= $billing_zipcode) 	or 
					($delivery_country 	!= $billing_country) 
				) 
				{
					//create a billing address for the customer
					$this->customer->add_address($billing_address);
					
					$this->customer->link_customer_address(NULL,"BILLING");
				}
				else
				{
					//mark the shipping address as a billing address as well
					$last_address_id_arr = $this->customer->get_last_table_id("addresses");
					$last_address_id = $last_address_id_arr[0]->last_id;
					$flag = $this->customer->set_as_billing_address($last_address_id);
					
					
				}
				
				
				//send email  send user temporary password 
				{
					date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
					$this->load->library('email');
				
					// config the email library PHPMailer @link https://github.com/ivantcholakov/codeigniter-phpmailer
					
					$subject = 'Shop Amerika - '.$this->msg->get_translated_message(164).' !'; // welcome !
					//165 = Your account has been created ,  your temporary password is: 
					//166 = make sure you change your password once logged it.
			        $message = '<p>'.$this->msg->get_translated_message(165).' <strong>'.$password_random.'</strong>  '.$this->msg->get_translated_message(166).'</p>';
			        //$order_link = '<a href="'.base_url().'customer/myorders/"> '.$this->msg->get_translated_message(132).'</a>';
			        //echo $verifiy_link; // for debugging
			        
			     /*   $body =
						'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html xmlns="http://www.w3.org/1999/xhtml">
						<head>
						    <meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
						    <title>'.html_escape($subject).'</title>
						    <style type="text/css">
						        body {
						            font-family: Arial, Verdana, Helvetica, sans-serif;
						            font-size: 16px;
						        }
						    </style>
						</head>
						<body>
							<img src="http://www.shopamerika.com/v2/assets/templates/eshopper/images/home/logo.png" alt="Shop Amerika">
							'.$message.'
							<br>
						
						
						</body>
						</html>';*/
					
					//-------------new body now using templates 
					$body =
					'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
						<head>
						    <meta name="viewport" content="width=device-width" />
						    <title>'.html_escape($subject).'</title>
						    <link rel="stylesheet" type="text/css" href="'.base_url().'/assets/templates/eshopper/css/email.css" />
						</head>
						
						<body bgcolor="#FFFFFF">

						<!-- HEADER -->
						<table class="head-wrap" bgcolor="#F6F6F6">
							<tr>
								<td></td>
								<td class="header container">
									
										<div class="content">
											<table bgcolor="#F6F6F6">
											<tr>
												<td><img src="http://www.shopamerika.com/v2/assets/templates/eshopper/images/home/logo.png" alt="Shop Amerika" width="200px"></td>
												<td align="right"><h8 class="collapse" style="font-size:9px;" >WE BRING THE FASHION TO YOUR DOOR FROM AMERICA</h8></td>
											</tr>
										</table>
										</div>
										
								</td>
								<td></td>
							</tr>
						</table><!-- /HEADER -->


						<!-- BODY -->
						<table class="body-wrap">
							<tr>
								<td></td>
								<td class="container" bgcolor="#FFFFFF">

									<div class="content">
									<table>
										<tr>
											<td>
												
												<h3>Account Information</h3>
												
												
												'.$message.' <br>
												
												<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
												
												<!-- A Real Hero (and a real human being) -->
												<p><img src="https://subiz.com/blog/wp-content/uploads/2015/11/loveourcustomers-e1448505386948.png" width="600px" /></p><!-- 600 x 300 -->
												
												<!-- Callout Panel -->
												<p class="callout">
													Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt. <a href="#">Do it Now! &raquo;</a>
												</p><!-- /Callout Panel -->
												
												<h3>Title Ipsum <small>This is a note.</small></h3>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
												<a class="btn">Click Me!</a>
																		
												<br/>
												<br/>							
																		
												<!-- social & contact -->
												<table class="social" width="100%">
													<tr>
														<td>
															
															<!--- column 1 -->
															<table align="left" class="column">
																<tr>
																	<td>				
																		
																		<h5 class="">Connect with Us:</h5>
																		<p class="">
																			<a href="#" class="soc-btn fb">Facebook</a>
																			<a href="#" class="soc-btn tw">Twitter</a>
																			<a href="#" class="soc-btn gp">Google+</a>
																		</p>
																	</td>
																</tr>
															</table><!-- /column 1 -->	
															
															<!--- column 2 -->
															<table align="left" class="column">
																<tr>
																	<td>				
																									
																		<h5 class="">Contact Info:</h5>												
																		<p>Phone: <strong>408.341.0600</strong><br/>
						                								Email: <strong><a href="emailto:admin@shopamerika.com">admin@shopamerika.com</a></strong></p>
						                
																	</td>
																</tr>
															</table><!-- /column 2 -->
															
															<span class="clear"></span>	
															
														</td>
													</tr>
												</table><!-- /social & contact -->
											
											</td>
										</tr>
									</table>
									</div>
															
								</td>
								<td></td>
							</tr>
						</table><!-- /BODY -->

						<!-- FOOTER -->
						<table class="footer-wrap">
							<tr>
								<td></td>
								<td class="container">
									
										<!-- content -->
										<div class="content">
										<table>
										<tr>
											<td align="center">
												<p>
													<a href="#">Terms</a> |
													<a href="#">Privacy</a> |
													/*<a href="#"><unsubscribe>Unsubscribe</unsubscribe></a>*/
												</p>
											</td>
										</tr>
									</table>
										</div><!-- /content -->
										
								</td>
								<td></td>
							</tr>
						</table><!-- /FOOTER -->

						</body>
					
					</html>';
					//end new body 
					 
					$this->email->from('no-reply@shopamerika.com','Shop Amerika');
					$this->email->to($email);
					$this->email->subject($subject);
					$this->email->message($body);
					
					$result = $this->email->send();
			        
					if ( !$result)
					{
					    //$data["message_status"] = 'well that\'s embarassing ...we have a technical problem during emailing your verification email';
					    $data["message_status"] = $this->msg->get_translated_message(41);
					}
					else
					{
						// ok email sent!
						$data['order_email_was_sent'] = TRUE ; 
						
						//for debugging
						//$email_dbg = $this->email->print_debugger();
						
						//$this->msg->show(10);
						//echo("confirmation email, message sent!<br> Please check your email.<br>");
					}
					
			        /*var_dump($result);
			        echo '<br />';
			        echo $this->email->print_debugger();*/
					
				}
				//end send email
				
			}
			// if he is already in the database then get his id and update his data and address
			else 
			{
				// path A ~ he is a customer 
				//email already in database
				
				// try to get customer address from database
				//$customer_address_delivery_id = $this->customer->get_customer_address_delivery_id($user_id);
				//since he is a customer we get his delivery address id from the form from the hidden field, and test it if it is really a valid address 
				$customer_address_delivery_id = $delivery_address['id'];
				
				//try to get customer billing address
				$customer_address_billing_id = $this->customer->get_customer_address_invoice_id($user_id);
				
				if(empty($customer_address_billing_id))
				{
					//add billing address
					$this->customer->add_address($billing_address);
					
					// link billing address to customer
					$this->customer->link_customer_address($user_id,"BILLING");
					
				}
				else
				{
					//get the billing address from datanase and compare it to theform billing address
					$billing_address_details_from_db = $this->customer->get_address_details_no_ajax($customer_address_billing_id);
					
					// if it is different from the one from the form, override the billing address 
					if
					(
						($billing_address_details_from_db->line_1  			!= $billing_address1) 	or
						($billing_address_details_from_db->line_2  			!= $billing_address2) 	or 
						($billing_address_details_from_db->line_3  			!= $billing_address3) 	or 
						($billing_address_details_from_db->city 			!= $billing_city	) 	or 
						($billing_address_details_from_db->country_province	!= $billing_region	)	or		 
						($billing_address_details_from_db->zip_code 		!= $billing_zipcode	) 	or 
						($billing_address_details_from_db->coutry 			!= $billing_country	) 
					) 
					{
						//override the billing address 
						$flag = $this->customer->update_address($customer_address_billing_id,$billing_address);
						
					}
					
				}
				
				
				
				//if his address exists in database
				if(!empty($customer_address_delivery_id))
				{
					//todo
					//ok we got his delivery address no problem 
					// get his delivery
				}
				//he is a customer but we don't have all the details
				// so we add his details from the form 
				else
				{
					
					//create an address for the  customer
					$this->customer->add_address($delivery_address);
					
					// link customer to address get the lasd customer id from customers and the last address id from addresses and link them
					$this->customer->link_customer_address($user_id,'SHIPPING');
				}
				
				$customer_details_from_form = array("firstname"=>$firstname , "lasname"=>$lasname, "phone"=>$phone, "alt_phone"=>$alt_phone, "email"=>$email, "prim_lang_id"=>$prim_lang_id );
				
				$customer_details_from_db = $this->customer->get_customer_details($user_id);
				
				//compare customer details from db to form data , if anything is different override the database details with the form details
				if
					(
						($customer_details_from_db[0]->first_name  		!= $customer_details_from_form['firstname']) 	or
						($customer_details_from_db[0]->last_name  		!= $customer_details_from_form['lasname']) 		or 
						($customer_details_from_db[0]->phone  			!= $customer_details_from_form['phone']) 		or 
						($customer_details_from_db[0]->alt_phone 		!= $customer_details_from_form['alt_phone']	) 	or 
						($customer_details_from_db[0]->email			!= $customer_details_from_form['email']	)		or		 
						($customer_details_from_db[0]->language_id_fk 	!= $customer_details_from_form['prim_lang_id']	) 
					) 											  
					{
						//update personal user information 
						$flag_update_customer = $this->customer->update_customer_from_checkout($user_id,$customer_details_from_form);
						
					}
			}
			
			
			// ~~ A and B merged ~~
			// save cart
			
			//get the user id 
			$user_id = $this->customer->get_user_id($email);
			
			//get the user addresses
			
			if ($user_id)
			{
				//if(!$is_customer)
				//{
				$customer_address_delivery_id = $this->customer->get_customer_address_delivery_id($user_id);
				$customer_address_invoice_id  = $this->customer->get_customer_address_invoice_id($user_id);
				//}
				
				$db_billing_address_details = $this->customer->get_address_details_no_ajax($customer_address_invoice_id );
				$db_billing_address_line1= $db_billing_address_details->line_1;
				$db_billing_address_zipcode= $db_billing_address_details->zip_code;
				
				$shop_id = 1;
				$this->load->module("carta");
				
				// flag for adding new cart 
				$flag_cart = $this->carta->add_new_cart($shop_id,$lang_id,$customer_address_delivery_id,$customer_address_invoice_id,$user_id);
				
				// get last cart id 
				$last_cart_id = $this->carta->get_last_cart_id();
				
				// link cart to products 
				
				/*echo "<pre>";
				print_r($this->cart);
				echo "<pre>";*/
				
				//Products no longer in products table ( products are from API)
				/*
				$cart_items = $this->cart->contents();
				foreach( $cart_items as $item )
				{
					$product_id = $item['id'];
					$quantity =  $item['qty'];
					if(!empty($item['color_id'])) $color_id =  $item['color_id'];
					else $color_id = NULL; 
					if(!empty($item['size_id']))  $size_id  =  $item['size_id']; 
					else $size_id = NULL;
					$promotional_deal_id = NULL;
					
					$flag_cart_product = $this->carta->link_cart_product($last_cart_id,$product_id,$quantity,$color_id,$size_id,$promotional_deal_id,$customer_address_delivery_id);
				}
				*/
				
				//create a new order
				$this->load->module("orders");
				$currency_id = 840; // for dollar
				$flag_order = $this->orders->add_new_order($user_id,$last_cart_id,$customer_address_delivery_id,$customer_address_invoice_id,$currency_id);
				
				//get last order id
				$last_order_id =  $this->orders->get_last_order_id();
				
				//
				$this->load->module('price_rules');
				
				$sale_tax = $this->price_rules->get_price_rule_value(2);
				
				$credit_card_expenses  = $this->price_rules->get_price_rule_value(5); // 5 is the id of credit card expenses
				
				//$custom_fees = $this->calculate_customs_fees(); todo delete  bcz its old formula
				//$custom_fees = 0; //todo delete  bcz its old formula xxx
							
				$total_price = $this->cart->total();
				$number_of_items = $this->cart->total_items(); 
				
				//$shipping_fee = $this->price_rules->get_shipping_fee($number_of_items);
				
				//$service_fee  = $this->price_rules->get_service_fee($number_of_items);
				
				//calculating service fee 
				/*$service_fee  = 0 ;
				$this->load->module('categories');
				
				$number_of_items_with_service_fee = 0;
				$cart_contents = $this->cart->contents();
				foreach($cart_contents as $item)
				{
					$item_cat_id =  $item["cat_id"];
					$item_qty =  $item["qty"];
					
					$category_options = $this->categories->get_category_options($item_cat_id);
					$has_service_fee = $category_options[0]->service_fee;
					
					$has_service_fee = $category_options[0]->service_fee;
					if(empty($has_service_fee)) $has_service_fee = 0;
					
					$number_of_items_with_service_fee += $has_service_fee * $item_qty ;
					$service_fee  = $this->price_rules->get_service_fee($number_of_items_with_service_fee);
				}*/
				// end calculating service fee 
				
				
				//$grand_total = $total_price*(1+$credit_card_expenses + $custom_fees + $sale_tax) + $shipping_fee + $service_fee ;
				
				
				//$no_customs = FALSE;
				//$no_customs = (bool)$this->input->cookie('no_customs', TRUE);
			
				/*$grand_total = $this->calculate_price($no_customs,$total_price,$sale_tax,$service_fee,$shipping_fee,$credit_card_expenses,$custom_fees);
				//check for promotion code if any
				$promotion_cart_id = $this->session->userdata("promotion_cart_id");
				if(!empty($promotion_cart_id))
				{
					$this->load->module("carta");
					$promotion_data = $this->carta->get_promotion_data($promotion_cart_id);
					$reduction_rate = $promotion_data[0]->reduction_rate;
					
					$promotional_grand_total = $grand_total - ($reduction_rate*$grand_total);
					$saving = $grand_total - $promotional_grand_total;
					
					//update grand_total 
					$grand_total = $promotional_grand_total; // discount
				}
				*/
				
				//save the carts content for historical and reports
				$cart_content_json = json_encode($this->cart->contents());
				
				if($number_of_items > 0) 
				{
					
					//save cart content to a file on the server 
					{
						//$user_id = $this->session->userdata("user_id");
						//update cart
						//$this->load->model('carta_mdl');
						$cart_content = $this->cart->contents(); // get cart contents
						$cart_content_j_encoded = json_encode($cart_content); // encode it to json string
						$compressed = gzencode($cart_content_j_encoded, 9); // compress the json string 
						$cart_content_file = './data/orders/'.$last_order_id.'.gzip';
						$flag = file_put_contents($cart_content_file,$compressed); // save cart to file on server
					}
					
					
					$shipping_factor_money_value = $this->price_rules->get_price_rule_value('ship_factor_monney');
					$start_up_shipping_value = $this->price_rules->get_price_rule_value('ship_start_value');
					$customs_rate = $this->price_rules->get_price_rule_value('6');
					
					
					//new prices new formula august 2016
					/*
					// visible price
					$prices['order_sub_total'] 			= $total_no_discount ; 
					$prices['shipping_and_handling_fee'] = $shipping_fee_total + $total_tax + $service_fee + $total_credit_card_fee ;
					$prices['discount_total'] 			= $total_discount;
					$prices['subtotal'] 					= $c['order_sub_total'] + $c['shipping_and_handling_fee']  - $c['discount_total'];
					$prices['optional_custom_fees'] 		= $total_custom_fee;
					$prices['grand_total'] 				=  $c['subtotal'] + $c['optional_custom_fees'];
					//end visible price 
					
					//admin prices
					$prices['shipping_fee_total'] 				= $shipping_fee_total ; 
					$prices['total_tax'] 						= $total_tax ; 
					$prices['service_fee'] 						= $service_fee ; 
					$prices['total_credit_card_fee'] 			= $total_credit_card_fee ; 
					$prices['total_custom_fee'] 					= $total_custom_fee ; 
					$prices['number_of_items_with_service_fee']	= $number_of_items_with_service_fee ; 
					//end admin prices 
					*/
					
					//for admin
					$order_sub_total 		= $prices["order_sub_total"]; 
					$grand_total 			= $prices["grand_total"] ;
					$service_fee 			= $prices["service_fee"];
					$shipping_fee_total 	= $prices["shipping_fee_total"];
					$total_custom_fee 		= $prices["total_custom_fee"];
					$total_tax 				= $prices["total_tax"];
					$total_credit_card_fee 	= $prices["total_credit_card_fee"];
					//for customer
					$v_order_sub_total 			= $prices['order_sub_total'] 			;
					$v_shipping_and_handling_fee 	= $prices['shipping_and_handling_fee'] ;
					$v_discount_total 			    = $prices['discount_total'] 			;
					$v_subtotal					= $prices['subtotal'] 				;
					$v_optional_custom_fees 		= $prices['optional_custom_fees'] 	;
					$v_grand_total 				= $prices['grand_total'] 				;
					
					//~~~~save order details~~~~~//
					$flag_order_details = $this->orders->add_order_details(
					$last_order_id,$total_custom_fee,$order_sub_total,$shipping_fee_total,$service_fee,$grand_total,
					$total_tax,$total_credit_card_fee,$number_of_items,$cart_content_file,$shipping_factor_money_value,$start_up_shipping_value,$customs_rate,$v_order_sub_total,$v_shipping_and_handling_fee,$v_discount_total,$v_subtotal,$v_optional_custom_fees,$v_grand_total);
				}
				else
				{
				    
				    //get wording for the page 
	   				$data['words'] = $this->msg->get_words("checkout");
	   		
				    $this->load->view($template_path_info.'/common/css_checkout',$data);  
				    $this->load->view($template_path_info.'/common/header_checkout');  
				    //$this->load->view($template_path_info.'/common/slider');  
				    
					$this->load->view($template_path_info.'/checkout_vew',$data); 
				    
				    $this->load->view($template_path_info.'/common/footer_checkout');  
				    $this->load->view($template_path_info.'/common/script_checkout',$script_data); 
					
				}
				
				
				
				//create an invoice 
				//todo
				
				
				
			}
			else
			{
				/// user not found 
			}
			
			// create an order (must add price rule to table for auditrail)
			//$this->load->module("order");
			
			//create an invoice (must add price rule to table for auditrail)
			//$this->load->module("invoice");
			
			
			//processing credit card
			$this->load->library('PHPRequests');
	        
	        //get the card processing account from database
	        $account_info 	= $this->processor->get_account_info();
	        $ePNAccount 	= $account_info->epn_account;
	        $RestrictKey 	= $account_info->restrict_key;
	        $TranType 		= $account_info->tran_type;
	        $CVV2Type 		= $account_info->cvv2type;
	        $HTML 			= $account_info->html;
	        
	        $oo = 55 ;
	        
	        //use this array for production 
	        
	        $payment_data = array(
	         'ePNAccount' 	=> $ePNAccount,
	         'CardNo' 		=> $CardNo,
	         'ExpMonth' 	=> $ExpMonth,
	         'ExpYear' 		=> $ExpYear,
	         'Total' 		=> $grand_total,
	         'Address' 		=> $db_billing_address_line1,
	         'Zip' 			=> $db_billing_address_zipcode,
	         'EMail' 		=> $email,
	         'CVV2Type' 	=> $CVV2Type,
	         'CVV2' 		=> $CVV2,
	         'HTML' 		=> $HTML,
	         'RestrictKey' 	=> $RestrictKey,
	         'TranType' 	=> $TranType
	         );
	         
	        
	         
	         //use this array for devlopment and testing a virtual credit card
	         
	         /*
	         $payment_data = array(
	         'ePNAccount' => '080880',
	         'CardNo' => '4111111111111111',
	         'ExpMonth' => '12',
	         'ExpYear' => '09',
	         'Total' => '12.01',
	         //'Address' => '123  Fake  St.',
	         'Address' => '123  sesame street',
	         'Zip' => '12345',
	         'EMail' => 'email@address.com',
	         'CVV2Type' => '1',
	         'CVV2' => '123',
	         'HTML' => 'No',
	         'RestrictKey' => 'yFqqXJh9Pqnugfr',
	         'TranType' => 'Sale'
	         );
	         */

			// for more info about the response , see https://www.epnreseller.com/docs/tdbe/TDBE.pdf (page 8-9)
			$response = Requests::post('https://www.eprocessingnetwork.com/cgi-bin/tdbe/transact.pl', array(), $payment_data);
			
			//check if payement server is ok 
			if(!empty($response) )
			{
				//if response yes got to ok menu 
				//else decline the purchase 
				
				$response_body = $response->body; // get the body of the response
				//$response_body_csv = strip_tags($response_body_html); // remove html tags if HTML was not se to NO  in the request
				$response_body_csv = str_replace('"', '', $response_body); // remove double quotes
				$response_body_arr = explode(',',$response_body_csv);
				
				if (!empty($response_body_arr[0])) 
				{
					$response_body_data['transaction_response'] = $response_body_arr[0];
					$first_character = $response_body_arr[0][0];
				}
				if (!empty($response_body_arr[1])) $response_body_data['avs_response'] 		= $response_body_arr[1];
				if (!empty($response_body_arr[2])) $response_body_data['cvv2_response'] 	= $response_body_arr[2];
				if (!empty($response_body_arr[3])) $response_body_data['invoice_number'] 	= $response_body_arr[3];
				if (!empty($response_body_arr[4])) $response_body_data['transaction_id'] 	= $response_body_arr[4];
				
				$data['response'] 			= $response_body_data ;
				$data['first_character'] 	= $first_character ;
				
				//if approved empty cart 
				if($first_character == "Y" )
				{
					// ok approved
					
					//empty the cart 
					$this->load->module('carta');
					$this->carta->clean_up();
					//$this->cart->destroy();
					
					//delete user temporary cart from disk 
					$user_id = $this->session->userdata("user_id");
					$file_full_name = './data/carts_temp/users/'.$user_id.'.gzip';
					if (file_exists($file_full_name)) 
					{
						unlink($file_full_name);
					}
					
					//clean up session prices ------------------------------------------<to look at 
					//$this->session->set_userdata("total_price","");
					//$this->session->set_userdata("grand_total","");
					
					// send email
					{
						$this->load->module('emaily');
						$result = $this->emaily->send_order_is_taken($last_order_id);
			            
						if ( !$result)
						{
						    //$data["message_status"] = 'well that\'s embarassing ...we have a technical problem during emailing your verification email';
						    $data["message_status"] = $this->msg->get_translated_message(41);
						}
						else
						{
							// ok email sent!
							$data['order_email_was_sent'] = TRUE ; 
							
						}
						
					}
					//end send email
				}
					
				// call response view ok or declined or unknown
					
				$this->load->helper("url");
				
				// get the language from the session 
				$lang_id = $this->lng->get_n_set_language_id();	
				
				$data['template_info'] = $this->templateman->get_template_info(1); // get the template details   
				$template_path_info = $data['template_info']['path'];
				
				//view
				$this->load->view($template_path_info.'/common/css_checkout',$data);  
			    $this->load->view($template_path_info.'/common/header_checkout');  
			    //$this->load->view($template_path_info.'/common/slider');  
			    
				$this->load->view($template_path_info.'/checkout_response_vew',$data); 
			    
			    $this->load->view($template_path_info.'/common/footer_checkout');  
			    $this->load->view($template_path_info.'/common/script_checkout',$script_data); 
				    
			}
			else
			{
				//error during connecting to payment server
				//$data["response"] = "error during connecting to payment server... plz try again";
				$data["response"] = $this->msg->get_translated_message(120);
				
				$this->load->helper("url");
				
				// get the language from the session 
				$lang_id = $this->lng->get_n_set_language_id();	
				
				$data['template_info'] = $this->templateman->get_template_info(1); // get the template details   
				$template_path_info = $data['template_info']['path'];
				
				//view
				$this->load->view($template_path_info.'/common/css_checkout',$data);  
			    $this->load->view($template_path_info.'/common/header_checkout');  
			    //$this->load->view($template_path_info.'/common/slider');  
			    
				$this->load->view($template_path_info.'/checkout_response_vew',$data); 
			    
			    $this->load->view($template_path_info.'/common/footer_checkout');  
			    $this->load->view($template_path_info.'/common/script_checkout',$script_data); 
				
				 
				
			}
		}
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

	// this method is to be deleted
	public function card()
	{
		$this->load->helper("url");
		
		// get the language from the session 
		$lang_id = $this->lng->get_n_set_language_id();	
		
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details   
		$template_path_info = $data['template_info']['path'];
		
		//view
		$this->load->view($template_path_info.'/common/css',$data);  
	    
	    //header
	    //echo('<img src="http://www.usa.com/usa/assets/templates/eshopper/images/home/logo.png" />');
	    $this->load->view($template_path_info.'/common/header');  
	    //$this->load->view($template_path_info.'/common/slider');  
	    
		$this->load->view($template_path_info.'/checkout_card',$data); 
	    
	    $this->load->view($template_path_info.'/common/footer');  
	    $this->load->view($template_path_info.'/common/script'); 
	}
	
	/**
	* 
	*	this method will check for products availability from the api and will return a string "ok" if everything is in stock , "cart_empty"
	*   if the cart is empty, an array of product ids that are no longer in stock 
	* 
	* @return mixed "ok" , "cart_empty", array	`
	*/
	public function check_cart_items_availability()
	{
		$cart_items = $this->cart->contents();
		
		if(!empty($cart_items))
		{
			/*echo "<pre>";
			var_dump($cart_items);
			echo "/<pre>";*/
			
			// if all items are in stock this flag will remain true
			$flag_ok = TRUE;
			$items_not_in_stock = array();
			
			foreach( $cart_items as $item )
			{
				$product_id = $item['id'];
				//$product_web_id = $item['web_id'];
			
				$product_stream = file_get_contents("http://api.shopstyle.com/api/v2/products/".$product_id."?pid=sugar");
				$jproduct = json_decode($product_stream);
				
				$Stock_status = $jproduct->inStock;
				if(!$Stock_status)
				{
					$flag_ok = FALSE;
					// save the id of the elements that is no longer in stock 
					$items_not_in_stock[] = $product_id;
				}
				
			}
			
			//if one or more products are no longer available in stock
			if(!$flag_ok)
			{
				/*echo "<pre>";
				var_dump($items_not_in_stock);
				echo "/<pre>";*/
			 	return $items_not_in_stock;
			}
			// all items are available 
			else
			{
				$flag_ok = "ok";
				//echo $flag_ok;
				return $flag_ok;
			}
			
		}
		else
		{
			$cart_empty = "cart_empty";	
			//echo $cart_empty;
			return $cart_empty;
		}
		
	}
	
	
	//to be called via ajax 
	public function check_session()
	{
		$flag = $this->check_cart_items_availability();
		
		if( $flag == "cart_empty")
		{
			//session expired
			echo base_url()."login";
		}	
	}
	
	// by default customs are not selected ( we pay the customs )
	private function calculate_price($no_customs = FALSE,$total_price,$sale_tax,$service_fee,$shipping_fee,$credit_card_expenses,$custom_fees)
	{
			$subt1 = $total_price * (1+$sale_tax); // 107
			$subt2 = $subt1 + $service_fee; // 112
			$subt3 = $subt2 + $shipping_fee; // 144
			$credit_card_total = $subt3 * $credit_card_expenses; //4.32
			$subt5 = $subt3 + $credit_card_total; // 148.32
			
			//grand total with No Customs
			if($no_customs)
			{
				$grand_total = $subt5;
			}
			//grand total with Customs 
			else
			{
				$customs_total = $subt5 * $custom_fees;
				$grand_total = $subt5 + $customs_total;
			}
			
			return $grand_total;
	}
	
	private function calculate_customs_fees()
	{
		$no_customs = FALSE;
		$no_customs = (bool)$this->input->cookie('no_customs', TRUE);
		if(!$no_customs)
		{
			$custom_fees = $this->price_rules->get_price_rule_value(6);
		}
		else
		{
			$custom_fees = 0;
		}
		
		return $custom_fees;
	}
	
	private function calculate_customs_total($no_customs = FALSE,$total_price,$sale_tax,$service_fee,$shipping_fee,$credit_card_expenses,$custom_fees)
	{
			$subt1 = $total_price * (1+$sale_tax); // 107
			$subt2 = $subt1 + $service_fee; // 112
			$subt3 = $subt2 + $shipping_fee; // 144
			$credit_card_total = $subt3 * $credit_card_expenses; //4.32
			$subt5 = $subt3 + $credit_card_total; // 148.32
			
			//grand total with No Customs
			if($no_customs)
			{
				$customs_total = 0 ; 
			}
			//grand total with No Customs 
			else
			{
				$customs_total = $subt5 * $custom_fees;
			}
			
			return $customs_total;
	}


	public function okv($char ="Y")
	{
				$data['response'] 	= "" ;
				$data['first_character'] 	= $char ;
				
				$this->load->helper("url");
				
				// get the language from the session 
				$lang_id = $this->lng->get_n_set_language_id();	
				
				$data['template_info'] = $this->templateman->get_template_info(1); // get the template details   
				$template_path_info = $data['template_info']['path'];
				
				//view
				$this->load->view($template_path_info.'/common/css_checkout',$data);  
			    $this->load->view($template_path_info.'/common/header_checkout');  
			    //$this->load->view($template_path_info.'/common/slider');  
			    
				$this->load->view($template_path_info.'/checkout_response_vew',$data); 
			    
			    $this->load->view($template_path_info.'/common/footer_checkout');  
			    $this->load->view($template_path_info.'/common/script_checkout');
	}
	
	public function calc($customer_take_care_of_customs = 0)
	{
		//$customer_take_care_of_customs = 1; 1 if customer clicks on "I will handle the customs myself"
		
		$c = array(); // wll hold all the fees for the customer
		//$a = array(); // wll hold all the fees for the admin
		
		
		//for testing without promotion code --------------------------------------------delete line below !!!!!!!!!!!!!!!
		//$this->session->unset_userdata('promo_codes');
		
		//$this->load->library('firebug');  echo('Firebug woking behind the scene........ok <br>');
		$this->load->module("price_rules");
		
		//init globals
		$total_with_discount = 0;
		$shipping_fee_total = 0;
		$start_up_shipping_value_flag = 0;// use it for once in the loop below
		$number_of_items_with_service_fee = 0;
		$total_discount = 0;
		$total_no_discount = 0;
		$items_row_id_with_promotion_code = array();
		
		
		//factors and other values from db
		$shipping_factor_money_value = $this->price_rules->get_price_rule_value('ship_factor_monney');
		$start_up_shipping_value = $this->price_rules->get_price_rule_value('ship_start_value');
		$tax = $this->price_rules->get_price_rule_value('2');
		$credit_card_fee = $this->price_rules->get_price_rule_value('5');
		$custom_fee = $this->price_rules->get_price_rule_value('6');
		
		
		$applied_promotions_csv = $this->session->userdata('promo_codes');
		
		// if there is promotional codes in the session 
		if(!empty($applied_promotions_csv))
		{
			$applied_promotions = explode(',',$applied_promotions_csv);
				
			//$applied_promotions2 = array("BLABLA123","KEMER159","LG2016","HOLYDAY2016");
			$this->load->module('categories');
			
			$cart_contents = $this->cart->contents();
			
			//$this->firebug->info($cart_contents,"cart_contents");
			
			// loop cart items with promotional codes
			foreach($cart_contents as $item)
			{
				$item_cat_id =  $item["cat_id"];
				$item_row_id =  $item["rowid"];
				$item_price =   $item["price"];
				$item_qty =     $item["qty"];
				
				$category_options = $this->categories->get_category_options($item_cat_id);
				
				//$category_shipping_factor  = 3 ; // from db
				$category_shipping_factor = $category_options[0]->shipping_factor;
				
				//$has_service_fee = 1;//------------>from db 
				$has_service_fee = $category_options[0]->service_fee;
				if(empty($has_service_fee)) $has_service_fee = 0;
				
				$cat_discount_money      = $category_options[0]->discount_money;
				$cat_discount_percentage = $category_options[0]->discount_percentage;
				$db_cat_promo_code = $category_options[0]->promotion_code;
				
				//check if $applied_promotions do apply for the items in the cart
				foreach ($applied_promotions as $promo_code)
				{
					if($promo_code == $db_cat_promo_code)
					{
						$items_row_id_with_promotion_code[] =  $item_row_id;
						
						$subtotal_no_discount = $item_price * $item_qty;
						$total_no_discount += $subtotal_no_discount; // we need this for the visible price aka Order Sub Total
						
						$subtotal_discount_money = 0;
						$subtotal_discount_percentage = 0;
						
						if(!empty($cat_discount_money))
						{
							$subtotal_discount_money = $cat_discount_money * $item_qty;
							$subtotal_with_discount =  ($item_price-$cat_discount_money)*$item_qty;
						}
						else
						{
							$subtotal_discount_percentage = $cat_discount_percentage * $item_price * $item_qty;
							$subtotal_with_discount =  $item_price*(1-$cat_discount_percentage)*$item_qty;
						}
						
						$discount_per_item = $subtotal_discount_money + $subtotal_discount_percentage ;
						$total_discount += $discount_per_item;
						
						$total_with_discount += $subtotal_with_discount;
						
						$shipping_fee_per_item = $category_shipping_factor * $item_qty * $shipping_factor_money_value;
						
						$shipping_fee_total += $shipping_fee_per_item; 
						
						if($start_up_shipping_value_flag == 0 )
							$shipping_fee_total += $start_up_shipping_value;
						
						$start_up_shipping_value_flag = 1;
						
						$number_of_items_with_service_fee += $has_service_fee * $item_qty ;
						
							
						//echo "ok promo code: $promo_code is right for row_id : $item_row_id <br>";
						//update cart row subtotal
						
						//$this->reset_cart_row_qty($item_row_id,$item_qty); //needed before update to vibrate the qty
						$data = array(
	               		'rowid'    					=> $item_row_id,
	               		'price'    					=> $item_price,
	               		'promo_code'   			 	=> $promo_code,
	               		'subtotal_promo' 			=> $subtotal_with_discount,
	               		'qty'      					=> $item_qty,
			            'cat_id'					=> $item_cat_id,
			            'promo_code'				=> $promo_code,
			            'has_service_fee'			=> $has_service_fee,
			            'cat_shipping_factor'		=> $category_shipping_factor,
			            'discount_money'     		=> $subtotal_discount_money,
			            'discount_percentage'		=> $subtotal_discount_percentage,
				        );
						
						$flag = $this->cart->update_all($data);
						
						$oo = 55;
					}
				}	
				
			}//end foreach cart contents with promotional code
			
			// loop cart items with NO promotional codes
			foreach($cart_contents as $item)
			{
				$item_row_id =  $item["rowid"];
				
				if (!in_array($item_row_id, $items_row_id_with_promotion_code)) 
				{
				    //echo "<br> the item : $item_row_id, has no promotional code <br>";
				    $oo = 55;
				
					$item_cat_id =  $item["cat_id"];
					$item_price =  $item["price"];
					$item_qty =  $item["qty"];
					
					$category_options = $this->categories->get_category_options($item_cat_id);
					
					//$category_shipping_factor  = 3 ; // from db
					$category_shipping_factor = $category_options[0]->shipping_factor;
					
					//$has_service_fee = 1;//------------>from db 
					$has_service_fee = $category_options[0]->service_fee;
					if(empty($has_service_fee)) $has_service_fee = 0;
					
					$cat_discount_money      = $category_options[0]->discount_money;
					$cat_discount_percentage = $category_options[0]->discount_percentage;
					$db_cat_promo_code = $category_options[0]->promotion_code;
					
					//check if $applied_promotions do apply for the items in the cart
					
					$subtotal_no_discount =  $item_price * $item_qty;
					$total_no_discount += $subtotal_no_discount; // we need this for the visible price aka Order Sub Total
					
					$total_with_discount += $subtotal_no_discount;
					
					$shipping_fee_per_item = $category_shipping_factor * $item_qty * $shipping_factor_money_value;
					
					$shipping_fee_total += $shipping_fee_per_item;
					
					if($start_up_shipping_value_flag == 0 )
						$shipping_fee_total += $start_up_shipping_value;
					
					$start_up_shipping_value_flag = 1;
					
					$number_of_items_with_service_fee += $has_service_fee * $item_qty ;
					
					$data = array(
		            'rowid'    					=> $item_row_id,
		            'price'    					=> $item_price,
		            'subtotal_promo' 			=> $subtotal_no_discount,
		            'qty'      					=> $item_qty,
		            'cat_id'					=> $item_cat_id,
			        'has_service_fee'			=> $has_service_fee,
			        'cat_shipping_factor'		=> $category_shipping_factor
					);
					
					$flag = $this->cart->update_all($data);
					
					$oo = 55;
				}
				
			}//end foreach cart contents with NO promotional code
			
			$total_with_shipping_fee = $shipping_fee_total + $total_with_discount;
			
			$total_tax = $total_with_shipping_fee * $tax;
			
			$total_with_tax =  $total_with_shipping_fee + $total_tax;
			
			//$service_fee = 20; // depending on $number_of_items_with_service_fee from db
			$service_fee  = $this->price_rules->get_service_fee($number_of_items_with_service_fee);
			
			$total_with_service_fee = $total_with_tax + $service_fee;
			
			$total_credit_card_fee = $total_with_service_fee * $credit_card_fee;
			$total_with_credit_card_fee = $total_with_service_fee + $total_credit_card_fee;
			
			if($customer_take_care_of_customs == 1) 
				$total_custom_fee = 0;
			else 
				$total_custom_fee = $total_with_credit_card_fee * $custom_fee;
				
			$grand_total = $total_with_credit_card_fee + $total_custom_fee;
			
			//echo "<br> customs are taken care by customer state : $customer_take_care_of_customs <br>";
			
			// visible price
			$c['order_sub_total'] 			= $total_no_discount ; 
			$c['shipping_and_handling_fee'] = $shipping_fee_total + $total_tax + $service_fee + $total_credit_card_fee ;
			$c['discount_total'] 			= $total_discount;
			$c['subtotal'] 					= $c['order_sub_total'] + $c['shipping_and_handling_fee']  - $c['discount_total'];
			$c['optional_custom_fees'] 		= $total_custom_fee;
			$c['grand_total'] 				=  $c['subtotal'] + $c['optional_custom_fees'];
			//end visible price 
			
			//admin prices
			$c['shipping_fee_total'] 				= $shipping_fee_total ; 
			$c['total_tax'] 						= $total_tax ; 
			$c['service_fee'] 						= $service_fee ; 
			$c['total_credit_card_fee'] 			= $total_credit_card_fee ; 
			$c['total_custom_fee'] 					= $total_custom_fee ; 
			$c['number_of_items_with_service_fee']	= $number_of_items_with_service_fee ; 
			//end admin prices
			
			/*echo "<br> Order Sub Total 			 : ".$c['order_sub_total'] 	." <br>";
			echo "<br> Shipping and Handling Fee : ".$c['shipping_and_handling_fee'] 	." <br>";
			echo "<br> Discount Total  			 : ".$c['discount_total'] 	." <br>";
			echo "<br> Sub-Total 			 	 : ".$c['subtotal'] 	." <br>";
			echo "<br> Optional Custom Fees  	 : ".$c['optional_custom_fees'] 	." <br>";
			echo "<br> Grand Total			  	 : ".$c['grand_total'] 	." <br>";*/
			
			//echo "back-end grand total $grand_total <br>";
			
		}
		//if no promotional code was found in the session at all 
		else
		{
			//echo "<br>no promotional code in the session<br>";
			
			$this->load->module('categories');
			
			$cart_contents = $this->cart->contents();
			
			// loop cart items with NO promotional codes of course
			foreach($cart_contents as $item)
			{
				if(empty($item["cat_id"])) $item["cat_id"] = 2;
				$item_row_id =  $item["rowid"];
				$item_cat_id =  $item["cat_id"];
				$item_price =  $item["price"];
				$item_qty =  $item["qty"];
				
				$category_options = $this->categories->get_category_options($item_cat_id);
				
				//$category_shipping_factor  = 3 ; // from db
				$category_shipping_factor = $category_options[0]->shipping_factor;
				
				//$has_service_fee = 1;//------------>from db 
				$has_service_fee = $category_options[0]->service_fee;
				if(empty($has_service_fee)) $has_service_fee = 0;
				
				$cat_discount_money      = $category_options[0]->discount_money;
				$cat_discount_percentage = $category_options[0]->discount_percentage;
				$db_cat_promo_code = $category_options[0]->promotion_code;
				
				//check if $applied_promotions do apply for the items in the cart
				
				$subtotal_no_discount =  $item_price * $item_qty;
				$total_no_discount += $subtotal_no_discount; // we need this for the visible price aka Order Sub Total
				
				$total_with_discount += $subtotal_no_discount;
				
				$shipping_fee_per_item = $category_shipping_factor * $item_qty * $shipping_factor_money_value;
				
				$shipping_fee_total += $shipping_fee_per_item;
				
				if($start_up_shipping_value_flag == 0 )
					$shipping_fee_total += $start_up_shipping_value;
				
				$start_up_shipping_value_flag = 1;
				
				$number_of_items_with_service_fee += $has_service_fee * $item_qty ;
				
				$data = array(
		            'rowid'    					=> $item_row_id,
		            'price'    					=> $item_price,
		            'subtotal_promo' 			=> $subtotal_no_discount,
		            'qty'      					=> $item_qty,
		            'cat_id'					=> $item_cat_id,
			        'has_service_fee'			=> $has_service_fee,
			        'cat_shipping_factor'		=> $category_shipping_factor
					);
				
				$flag = $this->cart->update_all($data);
				
				$oo = 55;
				
			}//end foreach cart contents with NO promotional code of course
			
			$total_with_shipping_fee = $shipping_fee_total + $total_with_discount;
			
			$total_tax = $total_with_shipping_fee * $tax;
			
			$total_with_tax =  $total_with_shipping_fee + $total_tax;
			
			//$service_fee = 20; // depending on $number_of_items_with_service_fee from db
			$service_fee  = $this->price_rules->get_service_fee($number_of_items_with_service_fee);
			
			$total_with_service_fee = $total_with_tax + $service_fee;
			
			$total_credit_card_fee = $total_with_service_fee * $credit_card_fee;
			$total_with_credit_card_fee = $total_with_service_fee + $total_credit_card_fee;
			
			if($customer_take_care_of_customs == 1) 
				$total_custom_fee = 0;
			else 
				$total_custom_fee = $total_with_credit_card_fee * $custom_fee;
				
			$grand_total = $total_with_credit_card_fee + $total_custom_fee;
				
			//echo "<br> customs are taken care by customer state : $customer_take_care_of_customs <br>";
			
			// visible price
			$c['order_sub_total'] 			= $total_no_discount ; 
			$c['shipping_and_handling_fee'] = $shipping_fee_total + $total_tax + $service_fee + $total_credit_card_fee ;
			$c['discount_total'] 			= $total_discount;
			$c['subtotal'] 					= $c['order_sub_total'] + $c['shipping_and_handling_fee']  - $c['discount_total'];
			$c['optional_custom_fees'] 		= $total_custom_fee;
			$c['grand_total'] 				=  $c['subtotal'] + $c['optional_custom_fees'];
			//end visible price 
			
			//admin prices
			$c['shipping_fee_total'] 				= $shipping_fee_total ; 
			$c['total_tax'] 						= $total_tax ; 
			$c['service_fee'] 						= $service_fee ; 
			$c['total_credit_card_fee'] 			= $total_credit_card_fee ; 
			$c['total_custom_fee'] 					= $total_custom_fee ; 
			$c['number_of_items_with_service_fee']	= $number_of_items_with_service_fee ; 
			//end admin prices
			
			/*echo "<br> Order Sub Total 			 : ".$c['order_sub_total'] 				." <br>";
			echo "<br> Shipping and Handling Fee : ".$c['shipping_and_handling_fee'] 	." <br>";
			echo "<br> Discount Total  			 : ".$c['discount_total'] 				." <br>";
			echo "<br> Sub-Total 			 	 : ".$c['subtotal'] 					." <br>";
			echo "<br> Optional Custom Fees  	 : ".$c['optional_custom_fees'] 		." <br>";
			echo "<br> Grand Total			  	 : ".$c['grand_total'] 					." <br>";*/
			
			//echo "back-end grand total $grand_total <br>";
		}
		
		return $c;
	}
	
	public function ajax_calc()
	{
		$customer_take_care_of_customs = $this->input->get("bool_customer_take_care_of_customs",TRUE);
		$visible_price = $this->calc($customer_take_care_of_customs);
		$visible_price_json = json_encode($visible_price);
		echo $visible_price_json;
		
	}
	
	public function apply_promo_code($promo_code="")
	{
		$promo_code = $this->input->get('promotion_code_value',TRUE);
		$promo_code = strtoupper($promo_code); // uppercase
		$promo_code = str_replace(' ', '', $promo_code); //remove spaces
		
		$flag = "0";
		$this->load->model("checkout_mdl"); 
		$categories_with_promo_code = $this->checkout_mdl->get_categories_with_promo_code($promo_code);
		if(!empty($categories_with_promo_code))
		{
			// code exists get the 
			//var_dump($categories_with_promo_code);
			$session_promo_codes = $this->session->userdata('promo_codes');
			if(!$session_promo_codes)
			{
				$this->session->set_userdata('promo_codes',$promo_code);
			}
			else
			{
				//$this->session->set_userdata('promo_codes',NULL);
				
				$promo_code_list = $this->session->userdata('promo_codes').",".$promo_code;
				$promo_code_list_array = explode(',',$promo_code_list);
				
				$promo_code_list_array = array_unique($promo_code_list_array); //delete duplicates if any 
				
				$promo_codes_csv = implode(",", $promo_code_list_array);
				
				$this->session->set_userdata('promo_codes',$promo_codes_csv);
				
				if($this->session->userdata('promo_codes') == $promo_codes_csv) $flag = "1"; 
				
			}
			
		}
		
		
		//echo $this->session->userdata('promo_codes');		echo '---------->';		echo $flag;
		
		echo json_encode($flag);
	}
	
	public function remove_promo_code($promocode_to_delete)
	{
		$promocode_to_delete = strtoupper($promocode_to_delete);
		
		//1.remove from session 
		$loaded_promo_codes = $this->session->userdata('promo_codes');
		echo $loaded_promo_codes;
		$list_promo_codes = $this->removeFromString($loaded_promo_codes,$promocode_to_delete);
		echo $list_promo_codes;
		$this->session->set_userdata('promo_codes',$list_promo_codes);
		
		//2.remove from cart 
		$cart_contents = $this->cart->contents();
		
		echo "<pre>";
		var_dump($cart_contents);
		echo "</pre>";
		
		foreach($cart_contents as $item)
			{
				$item_row_id =  $item["rowid"];
				$item_price =   $item["price"];
				$item_qty =     $item["qty"];
				$item_promo_code =$item["promo_code"];
				
				if($item_promo_code == $promocode_to_delete)
				{
					$data = array(
	               		'rowid'    					=> $item_row_id,
	               		'price'    					=> $item_price,
	               		'promo_code'   			 	=> "",
	               		'qty'      					=> $item_qty
			            );
						
					$flag = $this->cart->update_all($data);
				}
			}
			
		$cart_contents_after = $this->cart->contents();
		echo "<pre>";
		var_dump($cart_contents_after);
		echo "</pre>";
	}
	
	public function removeFromString($str, $item_to_del) {
    
    $promo_list_arr = explode(',', $str);

    foreach($promo_list_arr as $k=>$promo_itm)
    {
		if($promo_itm == $item_to_del)
		{
			unset($promo_list_arr[$k]);
		}
		$oo=55;
	}

    return implode(',', $promo_list_arr);
}	

	
	

	
	
}

/* End of file checkout.php */
/* Location: ./application/controllers/modules/checkout/controllers/checkout.php */