<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class carta extends MX_Controller {

 function __construct()
    {
        parent::__construct();
        
        $this->load->model('home_mdl'); // needed for the template info (template path)
        
         //load the language module
		$this->load->module("lng");
        
        $this->load->model("product_mdl");
        
        $this->load->module("seo");
    }
    public function cart_qview($data=NULL)
    {
    	// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
		
		$this->load->module("msg");
		$data['words'] 	=	$this->msg->get_words("cart_quick_view");
				
    	$template_info = $this->home_mdl->get_template_info();// get the template for the active shop
		$html = $this->load->view($template_info['path'].'/carta_qvew',$data,TRUE);
		
		//echo $html;
		return $html;
	}


	// add product to the cart via ajax call
	/**
	* To be called via ajax,
	* this method gets the product data and insert it into the cart.
	*  
	* @return json string
	*/
	public function add()
	{
		//$this->load->model("carta_mdl"); 
		
		//$oo= 55 ;
		//$this->load->helper("url");
		$product_id    =  $this->input->get('product_id');
		$quantity      =  $this->input->get('quantity');
		$color_name    =  $this->input->get('color_name');
		$size_name     =  $this->input->get('size_name');
		$color_image   =  $this->input->get('color_image');
		$category_id   =  $this->input->get('cat_id');
		
		$customer_take_care_of_customs = 0;
		$customer_take_care_of_customs = (bool)$this->input->cookie('bool_customer_take_care_of_customs', TRUE);
		if($customer_take_care_of_customs) $customer_take_care_of_customs = 1; else $customer_take_care_of_customs = 0;
	
		
		if(empty($color_name)){$color_name      = NULL;}
		if(empty($size_name)) {$size_name      = NULL;}
		
		$API_KEY = API_KEY;
		$q_url_product_details = "http://api.shopstyle.com/api/v2/products/$product_id?pid=$API_KEY";
		$product_details = json_decode(file_get_contents($q_url_product_details)) ;
		
		
		//set swach url to NULL to avoid ajax error 
		$color_swatchurl = NULL;
		
		if(!empty($color_name))
		{
			foreach($product_details->colors as $product_color)
			{
				if(!empty($product_color->name) and  $product_color->name == $color_name )
				{
					if(!empty($product_color->swatchUrl))
					$color_swatchurl = $product_color->swatchUrl;
				}
			}
		}	
		// to delete 
		//$produc_details0 = $this->product_mdl->get_product_details($product_id,$lang_id);
		//$produc_images0 = $this->product_mdl->get_product_color_images($product_id,$color_id);
		
		if (!empty($color_image)) $thumbnail = $color_image ; 
		else $thumbnail = $product_details->image->sizes->Best->url;
		
		$name = $product_details->brandedName;
		$price = $product_details->price;
		if(!empty($product_details->salePrice))	
		$sale_price = $product_details->salePrice;
		
		$cart_price = 9999999; // init cart_price with unacceptable amount 
		if(!empty($sale_price)) $cart_price = $sale_price ; 
		else $cart_price = $price ; 
		
		// to allow special characters into cart (if name has any) see http://stackoverflow.com/questions/3801750
		//$this->cart->product_name_rules = '[:print:]';
		$this->cart->product_name_rules = '\d\D';
		
		//needed if same product with different attribues to increment quantity if user add same product with same attributes
		$product_color_size_id = sha1($product_id."_".$color_name."_".$size_name); 
		
		// check if item is already in the cart
		 $cart_contents = $this->cart->contents();
		 foreach($cart_contents as $cart_content)
		 {
		 	$product_color_size_id_in_cart = $cart_content["options"]["product_color_size_id"];
		 	//echo $product_color_size_id_in_cart ;
		 	// compare unique item ids
		 	if($product_color_size_id == $product_color_size_id_in_cart)
		 	{
				//if already in cart get the quantity from the cart and add the qty from the form
				$quantity += $cart_content["qty"];
			}
		 }
		
		
		// prepare the array for the cart 
		$data = array(
               'thumbnail' 				=> $thumbnail,
               'id'        				=> (int)$product_id,
               'size_name'   			=> $size_name,
               'color_name'  			=> $color_name,
               'color_swatchurl'  		=> $color_swatchurl,
               'cat_id'  				=> $category_id,
               'qty'       				=> (int)$quantity,
               'price'     				=> $cart_price,
               'name'      				=> $name,
               'subtotal_promo'			=> 0,
               'promo_code'				=> '',
               'has_service_fee'		=> 0,
               'cat_shipping_factor'	=> 0,
               'discount_money'     	=> 0,
               'discount_percentage'	=> 0,
               'options' 				=> array('product_color_size_id' => $product_color_size_id)
            );
 
		// insert the array in the cart 
		$cart_flag = $this->cart->insert($data);
		$cart_fees = $this->calc($customer_take_care_of_customs = 0);
		
		//todo if a guest need to save cart content in a cookie or anchor cookie + database
		
		//generate the cart quick view
		$cart_qview = $this->cart_qview();
		// prepare the array for the ajax callback function
		$cart = array(
		'num_of_items' => $this->cart->total_items(),
		'total_price' => $this->cart->total(),
		'fees' => $cart_fees,
		'cart_qview' => $cart_qview
		);
		
		//save cart to server as a gzip file if he is a customer 
		$flag = $this->save_cart_to_disk();
		
		echo json_encode($cart);
		
	}
	
	/**
	* to be calledvia ajax, this function is the same as add() except it decreases the quantity of a unique (same product_id , size and color) item
	* if the the quantity is less or equal to the quantity in the cart  
	* 
	* @return json string , 
	*/
	public function sub()
	{
		
		$this->load->model("carta_mdl"); 
		
		$this->load->helper("url");
		$product_id =  $this->input->post('product_id');
		$quantity   =  $this->input->post('quantity');
		$color_id   =  $this->input->post('color_id');
		$size_id    =  $this->input->post('size_id');
		
		// get the color details
		if(!empty($color_id))
		{
		 	$color_details_arr = $this->carta_mdl->get_color_details($color_id);
			$color_name      = $color_details_arr[0]->cannonical_name;
			$color_swatchurl = $color_details_arr[0]->swatchurl;	
		}
		else
		{
			$color_name      = NULL;
		    $color_swatchurl = NULL;
		} 
		
		//get the size details
		if(!empty($size_id))
		{
		  $size_details_arr = $this->carta_mdl->get_size_details($size_id);
		  $size_name       = $size_details_arr[0]->cannonical_name;
		}
		else
		{
		  $size_name      = NULL;
		}
		
		$lang_id    = $this->lng->get_n_set_language_id();	
			
		$produc_details = $this->product_mdl->get_product_details($product_id,$lang_id);
		//$produc_images = $this->product_mdl->get_product_images($product_id);
		$produc_images = $this->product_mdl->get_product_color_images($product_id,$color_id);
		
		$thumbnail = $produc_images[0]->small_image;
		
		$name = $produc_details[0]->name;
		$price = $produc_details[0]->price;
		$sale_price = $produc_details[0]->salePrice;
		$web_id = $produc_details[0]->idd;
		
		$cart_price = 9999999; // init cart_price with unacceptable amount 
		if($sale_price) $cart_price = $sale_price ; 
		else $cart_price = $price ; 
		
		
		
		//$name =   $this->input->post('product_name') ;
	
		//$product_details =  $this->product_mdl->get_product_details($product_id,$lng);// i am here 
		 
		// to allow special characters into cart (if name has any) see http://stackoverflow.com/questions/3801750
		//$this->cart->product_name_rules = '[:print:]';
		$this->cart->product_name_rules = '\d\D';
		 
		$product_color_size_id = $product_id."_".$color_id."_".$size_id; //needed if same product with different options
		
		// check if item is already in the cart
		 $cart_contents = $this->cart->contents();
		 foreach($cart_contents as $cart_content)
		 {
		 	$product_color_size_id_in_cart = $cart_content["options"]["product_color_size_id"];
		 	echo $product_color_size_id_in_cart ;
		 	// compare unique item ids
		 	if($product_color_size_id == $product_color_size_id_in_cart)
		 	{
				//if already in cart get the quantity from the cart and add the qty from the form
				if($quantity <=  $cart_content["qty"] )	$quantity -= $cart_content["qty"];
			}
		 }
		
		
		// prepare the array for the cart
		$data = array(
               'thumbnail' => $thumbnail,
               'id'        => (int)$product_id,
               'web_id'    => (int)$web_id,
               'size_id'   => (int)$size_id,
               'size_name'   => $size_name,
               'color_id'  => (int)$color_id,
               'color_name'  => $color_name,
               'color_swatchurl'  => $color_swatchurl,
               'qty'       => (int)$quantity,
               'price'     => $cart_price,
               //'promo_id'      => '0',
               'name'      => $name,
               'options' => array('product_color_size_id' => $product_color_size_id)
            );
 
		// insert the array in the cart 
		$cart_flag = $this->cart->insert($data);

		
		// prepare the array for the ajax callback function
		$cart = array(
		'num_of_items' => $this->cart->total_items(),
		'total_price' => $this->cart->total()
		);
		
		echo json_encode($cart);
		//echo $product_id. " is now in your basket... so far you are going to spend \$ ".$this->cart->total(). " today, and you have ".$this->cart->total_items()." item(0)";
		
	}
	
	//remove a product from the cart via ajax call 
	public function remove() 
	{
		//$debug = "hello bugs";
		
		$row_id =  $this->input->post('r_id');
		// when the quantity is = 0 the item is removed
		
		$data = array(
               'rowid'   => $row_id,
               'qty'     => 0
            );
		
		$this->cart->update($data);
		
		///////////////
		//recalculate new prices and fees 
		$customer_take_care_of_customs = 0;
		$customer_take_care_of_customs = (bool)$this->input->cookie('bool_customer_take_care_of_customs', TRUE);
		if($customer_take_care_of_customs) $customer_take_care_of_customs = 1; else $customer_take_care_of_customs = 0;
		$new_prices_and_fees = $this->calc($customer_take_care_of_customs);
		
		//generate the cart quick view
		$cart_qview = $this->cart_qview();
		
		// prepare the array for the ajax callback function
		$cart_info = array(
					'prices' => $new_prices_and_fees,
					'num_of_items' => $this->cart->total_items(),
					'total_price' => $this->cart->total(),
					'cart_qview' => $cart_qview
					);
		
		//save cart to server as a gzip file if he is a customer (delete file if cart is empty)
		$flag = $this->save_cart_to_disk();
		
		//send the num_of_items and total_price to the ajax call back function 
		echo json_encode($cart_info);
		
	}
	
	//remove a product from the cart via URI
	public function remove_item($row_id) 
	{
		$debug = "hello bugs";
		
		if($row_id)
		{
			// when the quantity is = 0 the item is removed
			
			$data = array(
	               'rowid'   => $row_id,
	               'qty'     => 0
	            );
			
			$this->cart->update($data);
			
			// prepare the array for the ajax callback function
			$cart_info = array(
			'num_of_items' => $this->cart->total_items(),
			'total_price' => $this->cart->total()
			);
			
			$this->load->helper('url');
			redirect(base_url().'home/');
			//call the home controller
			//$this->load->module("home");
			//$this->home->index();
		}
		
	}
	
//call the cart view
	public function details()
	{
		
		$no_customs = FALSE;
		$no_customs_from_qstr = (bool)$this->input->get("no_customs");
		if($no_customs_from_qstr) $no_customs = TRUE;
		
		$lang_id = $this->lng->get_n_set_language_id();	
		
		$data['template_info'] = $this->home_mdl->get_template_info();// get the template for the active shop 
		$data['meta_info']  =  $this->home_mdl->get_meta_info($lang_id);// get the meta info from database 
		// prepare the metadata information for the view page
		
		//SEO
		$data['meta_info']  =  $this->seo_mdl->get_meta_info("cart",$lang_id);// get the meta info from database 
		
		//$data['meta_description'] =   "cart details";
		//$data['meta_keywords']    =   "cart details";
		//$data['page_title'] 	   =   "cart details";
		
		
		$this->load->module("price_rules");
		
		$sale_tax = (float)$this->price_rules->get_price_rule_value(2);
		
		$credit_card_expanses = (float)$this->price_rules->get_price_rule_value(5);
		
		//$custom_fees = $this->price_rules->get_price_rule_value(6);
		
		$custom_fees = $this->calculate_customs_fees();
		
		$number_of_items = $this->cart->total_items(); 
		//$number_of_items = 1;
		
		if ($number_of_items > 0)
		{
			
			$customer_take_care_of_customs = 0;
			$customer_take_care_of_customs = (bool)$this->input->cookie('bool_customer_take_care_of_customs', TRUE);
					
			$prices = $this->calc($customer_take_care_of_customs);
			
			$data["order_sub_total"] 			= 		$prices["order_sub_total"];
			$data["shipping_and_handling_fee"] 	= 		$prices["shipping_and_handling_fee"];
			$data["discount_total"] 			= 		$prices["discount_total"];
			$data["subtotal"] 					= 		$prices["subtotal"];
			$data["optional_custom_fees"] 		= 		$prices["optional_custom_fees"];
			$data["grand_total"] 				= 		$prices["grand_total"];
				
			
			
			 //old stuff
			 /*
			$shipping_fee = (float)$this->price_rules->get_shipping_fee($number_of_items);
			$service_fee  = (float)$this->price_rules->get_service_fee($number_of_items);
			
			{
				// needed to calculate $cumul_credit_card and $shipping_n_handling
				$total_tax = $total_price * $sale_tax  ;
				$cumul_tax = $total_price + $total_tax; 
				$cumul_service = $cumul_tax + $service_fee;	
				$cumul_shipping = $cumul_service + $shipping_fee;
				
				$cumul_credit_card = $cumul_shipping * $credit_card_expanses;
			
			$shipping_n_handling = $shipping_fee + $service_fee + $total_tax + $cumul_credit_card;
			
			$grand_total = $this->calculate_price($no_customs,$total_price,$sale_tax,$service_fee,$shipping_fee,$credit_card_expanses,$custom_fees);
			}
			
			$data["total_items"] = $total_price;
			$data["shipping_fees"] = $shipping_n_handling;
			// we include the $credit_card_expanses and the $sale_tax in the service fee for the front end 
			//$data["service_fees"] = $service_fee + $total_price*($credit_card_expanses + $sale_tax);
			$data["service_fees"] = 0;
			$data["custom_fees"] = $this->calculate_customs_total($no_customs,$total_price,$sale_tax,$service_fee,$shipping_fee,$credit_card_expanses,$custom_fees);
			$data["grand_total"] = $grand_total;
			*/
			
			/*echo " ---------- <br>";
			
			foreach ($this->cart->contents() as $item)
			{
				echo("id = ".$item['id']) ;	
				echo " <br>";
				echo("idd = ".$item['web_id']."<br>") ;	
				echo("price = ".$item['price']."<br>") ;	
			} */
			
			
			$data['is_empty'] = false;
			
			$this->load->module("msg");
			$data['words'] 		  =	$this->msg->get_words("cart");
			$script_data['words'] =	$this->msg->get_words("cart");
			
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			if($customer_take_care_of_customs) $customer_take_care_of_customs =1; else $customer_take_care_of_customs = 0;
			$script_data['customer_take_care_of_customs_cookie'] = $customer_take_care_of_customs;
			
			// currency
			$this->load->module('currency');
			$this->currency->set_currency(); // no parameter ==> usd will be the default
			$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
			$RATE = $this->session->userdata("CUR_RATE");
			
			$data['currency'] = $CURRENCY;
			$data['rate'] = $RATE;
			
			$script_data['currency'] = $CURRENCY;
			$script_data['rate'] = $RATE;
			
			//related products
			$this->load->module("lists");
			$data['lists']['featured_single_right'] = $this->lists->get_featured_cart_right();
			
			$this->load->view($data['template_info']['path'].'/common/css',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
	        //$this->load->view($data['template_info']['path'].'/common/slider');  
	        
			$this->load->view($data['template_info']['path'].'/carta_vew',$data);
	        
	        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
	        $this->load->view($data['template_info']['path'].'/common/script_carta',$script_data);  
		
		}
		else
		{
			$data['is_empty'] = true;
			
			//echo $data['is_empty'];
			$this->load->view($data['template_info']['path'].'/common/css',$data);  
        	$this->load->view($data['template_info']['path'].'/common/header');  
        	//$this->load->view($data['template_info']['path'].'/common/slider');  
        
			$this->load->view($data['template_info']['path'].'/carta_vew',$data);
			
			$this->load->view($data['template_info']['path'].'/common/footer');  
        	$this->load->view($data['template_info']['path'].'/common/script');
		}
	}
	
	/**
	* price_rules table as 26-08-2015
	+----+-------+------------------------------+------+-------------+-------------+--------------+
	| id | value | description                  | code | min_product | max_product | num_of_items |
	+----+-------+------------------------------+------+-------------+-------------+--------------+
	|  1 | 0.03  | Credit Card Expenses         | 5    | NULL        | NULL        | NULL         |
	|  2 | 0.1   | Customs Fee                  | 6    | NULL        | NULL        | NULL         |
	|  3 | 32    | shipping 1 Products          | 4A   | NULL        | NULL        |            1 |
	|  4 | 43    | shipping 2 Products          | 4B   | NULL        | NULL        |            2 |
	|  5 | 55    | shipping 3 Products          | 4C   | NULL        | NULL        |            3 |
	|  6 | 66    | shipping 4 Products          | 4D   | NULL        | NULL        |            4 |
	|  7 | 78    | shipping 5 Products          | 4E   | NULL        | NULL        |            5 |
	|  8 | 88    | shipping 6 Products          | 4F   | NULL        | NULL        |            6 |
	|  9 | 99    | shipping 7 Products          | 4G   | NULL        | NULL        |            7 |
	| 10 | 109   | shipping 8 Products          | 4H   | NULL        | NULL        |            8 |
	| 11 | 119   | shipping 9 Products          | 4I   | NULL        | NULL        |            9 |
	| 12 | 130   | shipping 10 Products or more | 4J   | NULL        | NULL        |           10 |
	| 13 | 25    | Service Fee 10 Products +    | 3D   |          10 |       99999 | NULL         |
	| 14 | 5     | Service Fee 1-3 Products     | 3A   |           1 |           3 | NULL         |
	| 15 | 10    | Service Fee 4-6 Products     | 3B   |           4 |           6 | NULL         |
	| 16 | 20    | Service Fee 7-9 Products     | 3C   |           7 |           9 | NULL         |
	| 17 | 0.07  | Sales Tax (KDV)              | 2    | NULL        | NULL        | NULL         |
	+----+-------+------------------------------+------+-------------+-------------+--------------+		
	*/
	
	// called by other methods
	private function update_price()
	{
		$this->load->module("price_rules");
		
		$sale_tax = $this->price_rules->get_price_rule_value(2); // code 2 see table above 
		$credit_card_expanses = $this->price_rules->get_price_rule_value(5); //code 5 see table above 
		//$custom_fees = $this->price_rules->get_price_rule_value(6); // code 6 see table above 
		$custom_fees = $this->calculate_customs_fees();
		
		$number_of_items = $this->cart->total_items();
		//$number_of_items = 1;
		
		if ($number_of_items > 0)
		{
			
			$total_price = $this->cart->total();
			
			$shipping_fee = $this->price_rules->get_shipping_fee($number_of_items);
			
			$service_fee  = $this->price_rules->get_service_fee($number_of_items);
			
			// $custom_fees must return 
			
			$no_customs = (bool)$this->input->cookie('no_customs', TRUE);
			
			$grand_total = $this->calculate_price($no_customs,$total_price,$sale_tax,$service_fee,$shipping_fee,$credit_card_expanses,$custom_fees);
			
			$customs_total = $this->calculate_customs_total($no_customs,$total_price,$sale_tax,$service_fee,$shipping_fee,$credit_card_expanses,$custom_fees);
			// prepare the array for the ajax callback function
			$cart_prices = array(
			'total_price'  => $total_price,
			'shipping_fee' => $shipping_fee,
			// we include the $credit_card_expanses and the $sale_tax in the service fee for the front end 
			'service_fee'  => $service_fee + $total_price*($credit_card_expanses + $sale_tax),
			'custom_fees'  => $customs_total,
			'grand_total'  => $grand_total
			);
			
			//send the num_of_items and total_price to the ajax call back function 
			//echo json_encode($cart_prices);
			return $cart_prices;
		}
		else
		{
			//echo "no product";
			return NULL;
		}
		
	}
	
	//apply promotion code via ajax 
	public function apply_code()
	{
		$return_data = NULL;
		
		$this->load->model("carta_mdl");
		//get the code from the view
		$promo_code = $this->input->post("promotion_code_value",TRUE);
		
		if(!empty($promo_code))
		{
			// get promotion code details if it exists
			$promotion_data = $this->carta_mdl->get_promotion_code($promo_code);
			
			if(!empty($promotion_data))	
			{
				//promotion code exists
				//now check for promotion code if not expired 
				date_default_timezone_set('Europe/Istanbul');
				$promotion_php_date_from = strtotime( $promotion_data[0]->date_from );
				$promotion_php_date_to = strtotime( $promotion_data[0]->date_to );
				$php_time_now = time();
				if( ($php_time_now > $promotion_php_date_from) and ($php_time_now < $promotion_php_date_to) )
				{
					//PimPom
					//promotion code exists and valid = not expired 
					$reduction_rate = $promotion_data[0]->reduction_rate;
					
					
	 
				//!!------------------- update_price ---------------------------!!
					$this->load->module("price_rules");
		
					$sale_tax = $this->price_rules->get_price_rule_value(2); // code 2 see table above 
					$credit_card_expanses = $this->price_rules->get_price_rule_value(5); //code 5 see table above 
					//$custom_fees = $this->price_rules->get_price_rule_value(6); // code 6 see table above 
					
					
					
					$custom_fees = $this->calculate_customs_fees();
					
					$number_of_items = $this->cart->total_items();
					//$number_of_items = 1;
					
					if ($number_of_items > 0)
					{
						
						$total_price = $this->cart->total();
						
						if($total_price >= $promotion_data[0]->cart_total_trigger)
						{
							// insert the promotion code id in the session 
							$promotion_cart_id = $promotion_data[0]->id;
							$this->session->set_userdata("promotion_cart_id",$promotion_cart_id);
							
							$shipping_fee = $this->price_rules->get_shipping_fee($number_of_items);
							
							$service_fee  = $this->price_rules->get_service_fee($number_of_items);
							
							// $custom_fees must return 
							
							$no_customs = FALSE;
							$no_customs = (bool)$this->input->cookie('no_customs', TRUE);
							
							$grand_total = $this->calculate_price($no_customs,$total_price,$sale_tax,$service_fee,$shipping_fee,$credit_card_expanses,$custom_fees);	
							
							$promotional_grand_total = $grand_total - ($reduction_rate*$grand_total);
							$saving = $grand_total - $promotional_grand_total;
							
							$customs_total = $this->calculate_customs_total($no_customs,$total_price,$sale_tax,$service_fee,$shipping_fee,$credit_card_expanses,$custom_fees);
							
							// prepare the array for the ajax callback function
							$cart_prices = array(
							'total_price' => $total_price,
							'shipping_fee' => $shipping_fee,
							// we include the $credit_card_expanses and the $sale_tax in the service fee for the front end 
							'service_fee' => $service_fee + $total_price*($credit_card_expanses + $sale_tax),
							'custom_fees' => $customs_total,
							'grand_total' => $promotional_grand_total,
							'saving' => $saving
							);
							
							//send the num_of_items and total_price to the ajax call back function 
							//echo json_encode($cart_prices);
							//return $cart_prices;
							$return_data = json_encode($cart_prices);
						}
						else
						{
							//return "trigger_not_reached";
							$return_data = "price_trigger_not_reached";
							$return_data = json_encode($return_data);
						}
						
						
					}
					else
					{
						//echo "no product";
						//return NULL;
						$return_data =  "empty_cart";
						$return_data = json_encode($return_data);
					}
				//!!------------------- end update_price ---------------------------!!
				}
				else
				{
					//return "expired";
					$return_data = "expired";
					$return_data = json_encode($return_data);
				}
				
			}
			else
			{
				//return "not_valid";
				$return_data = "not_valid";
				$return_data = json_encode($return_data);
			}
		}
		else
		{
			//return "empty";
			$return_data = "empty";
			$return_data = json_encode($return_data);
		}
		$oo = 55 ;
		//compare it to the promotion table in db and get the reduction percentage
		//add promotion code to the cart
		//update price 
		//return $return_data;	
		echo($return_data);
	}


//save the cart in database
public function add_new_cart($shop_id,$lang_id,$address_delivery_id,$address_invoice_id,$customer_id)
{
	$this->load->model("carta_mdl");
	$flag = $this->carta_mdl->add_new_cart($shop_id,$lang_id,$address_delivery_id,$address_invoice_id,$customer_id);
	return $flag;
}


public function get_last_cart_id()
{
	$this->load->model("carta_mdl");
	$last_cart_id = $this->carta_mdl->get_last_id("carts");
      
	return $last_cart_id[0]->last_id;
}

public function link_cart_product($last_cart_id,$product_id,$quantity,$color_id,$size_id,$promotional_deal_id,$address_delivery_id)
{
	$this->load->model("carta_mdl");
	$flag = $this->carta_mdl->link_cart_product($last_cart_id,$product_id,$quantity,$color_id,$size_id,$promotional_deal_id,$address_delivery_id);
      
	return $flag;
	
	
}
public function empty_cart() 
	{
		$this->cart->destroy();
		//goto view 
		$this->details();
	}


	
	//called via ajax to update the number in the car icon 
	public function info()
	{
		$cart_content = $this->cart->contents();
		
		$data["cart_content"] = $this->cart->contents();
		$jdata = json_encode($data);
		echo $jdata;
		
		/*$cart = array
			(
			'num_of_items' => $this->cart->total_items(),
			);
			
			$jsoncart = json_encode($cart);
			echo $jsoncart;*/
	}

	public function get_color_details ($color_id)
	{
		//get the color name and other details
		$color_details = $this->product_mdl->get_color_details($color_id);
		
		/*echo "<pre>";
		print_r($color_details[0]);
		echo "</pre>";*/
		
		return $color_details[0];
	}
	
	public function get_size_details($size_id)
	{
		//get the color name and other details
		$size_details = $this->product_mdl->get_size_details($size_id);
		/*echo "<pre>";
		print_r($size_details[0]);
		echo "</pre>";*/
		
		return $size_details[0];
	}
	
	//call by ajax when user clicks on [+] and [-] buttons
	public function change_qty()
	{
		
		$rowid = $this->input->post('row_id',TRUE);
		$qty = $this->input->post('quantity',TRUE);
		$data = array(
               'rowid' => $rowid,
               'qty'   => $qty
           		 );

		$this->cart->update($data);
		
		//recalculate new prices and fees 
		$customer_take_care_of_customs = 0;
		$customer_take_care_of_customs = (bool)$this->input->cookie('bool_customer_take_care_of_customs', TRUE);
		if($customer_take_care_of_customs) $customer_take_care_of_customs = 1; else $customer_take_care_of_customs = 0;
		$new_prices_and_fees = $this->calc($customer_take_care_of_customs);
		
		$oo=55;
		// prepare the array for the ajax callback function
		$cart = array(
					'prices' => $new_prices_and_fees,
					'num_of_items' => $this->cart->total_items()
					);
		
		//save cart to server (file + database)
		if(!empty($this->session->userdata("user_id"))) $is_logged_in = TRUE; else $is_logged_in = FALSE;
		if($is_logged_in)
		{
			$user_id = $this->session->userdata("user_id");
			//update cart
			//$this->load->model('carta_mdl');
			$cart_content = $this->cart->contents(); // get cart contents
			$cart_content_j_encoded = json_encode($cart_content); // encode it to json string
			$compressed = gzencode($cart_content_j_encoded, 9); // compress the json string 
			$file_full_name = './data/carts_temp/users/'.$user_id.'.gzip';
			$flag = file_put_contents($file_full_name,$compressed); // save cart to file on server
				
			//save user cart 
			//$this->carta_mdl->save_user_cart($user_id,$file_full_name);
		}
		
		
		echo json_encode($cart);
	}
	
	
	public function get_promotion_data($promotion_id)
	{
		$this->load->model("carta_mdl");  
		$promotion_data = $this->carta_mdl->get_promotion_data($promotion_id);
		return $promotion_data;
	}
	
	// by default customs are not selected ( we pay the customs )
	private function calculate_price($no_customs = FALSE,$total_price,$sale_tax,$service_fee,$shipping_fee,$credit_card_expanses,$custom_fees)
	{
			$subt1 = $total_price * (1+$sale_tax); // 107
			$subt2 = $subt1 + $service_fee; // 112
			$subt3 = $subt2 + $shipping_fee; // 144
			$credit_card_total = $subt3 * $credit_card_expanses; //4.32
			$subt5 = $subt3 + $credit_card_total; // 148.32
			
			//grand total with No Customs
			if($no_customs)
			{
				$grand_total = $subt5;
			}
			//grand total with No Customs 
			else
			{
				$customs_total = $subt5 * $custom_fees;
				$grand_total = $subt5 + $customs_total;
			}
			
			return $grand_total;
	}
	
	
	public function apply_promo_code($promo_code="")
	{
		$promo_code = $this->input->get('promotion_code_value',TRUE);
		
		//security check
		$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\()|(.*\\))|(.*\\=)|(.*\\:)|(.*\\;)/"; 
	    preg_match($re, $promo_code, $matches1);
	    if(!empty($matches1[0]))
	    {
	    	$promo_code = '';
	    }
		
		$promo_code = strtoupper($promo_code); // uppercase
		$promo_code = str_replace(' ', '', $promo_code); //remove spaces
		
		$flag = "0"; // return value
		$this->load->model("carta_mdl"); 
		$categories_with_promo_code = $this->carta_mdl->get_categories_with_promo_code($promo_code);
		if(!empty($categories_with_promo_code))
		{
			// code exists get the 
			//var_dump($categories_with_promo_code);
			$session_promo_codes = $this->session->userdata('promo_codes');
			//if no promotion codes in the session yet
			if(!$session_promo_codes)
			{
				$this->session->set_userdata('promo_codes',$promo_code);
				$flag = "1";
				
				//todo loop through cart items and check 
				//if category accepts only 1 discounted item
				//check if 2 items belong to the same category and return it 
				$cart_contents = $this->cart->contents();
			
				$d = array(); // we need it to check for category duplication
				$cart_multi_cat_id = array(); // contains duplicated categories
				
				// loop cart items with promotional codes
				foreach($cart_contents as $item)
				{
					$item_cat_id =  $item["cat_id"];
					
					//for testing but should come from db
					${"category_".$item_cat_id."_has_unique_discount"} = 1; 
					
					if(${"category_".$item_cat_id."_has_unique_discount"} == 1)
					{
						/*
						$item_cat = 
						if its category accepts the typed promotion code
						{
							save product_id to array_promotion_candidates_item[cat_id=>product_id];
						}
						else
						{
							do nothing 
						}
						*/
						
					}
					
					$item_row_id =  $item["rowid"];
					$item_price =   $item["price"];
					$item_qty =     $item["qty"];
				}
				
				//end todo loop through cart items and check if category accepts only 1 discounted item check if 2 items belong to the same category and return it 
				
				
			}
			else // append to the prvious codes
			{
				//$this->session->set_userdata('promo_codes',NULL);
				
				$promo_code_list = $this->session->userdata('promo_codes').",".$promo_code;
				$promo_code_list_array = explode(',',$promo_code_list);
				
				$promo_code_list_array = array_unique($promo_code_list_array); //delete duplicates if any 
				
				$promo_codes_csv = implode(",", $promo_code_list_array);
				
				$this->session->set_userdata('promo_codes',$promo_codes_csv);
				
				if($this->session->userdata('promo_codes') == $promo_codes_csv) $flag = "1"; 
				
				//todo loop through cart items and check if category accepts only 1 discounted item check if 2 items belong to the same category and return it 
				
			}
			
		}
		
		
		//echo $this->session->userdata('promo_codes');		echo '---------->';		echo $flag;
		
		echo json_encode($flag);
	}
	
	/**
	* will calculate all the fees  
	* 
	* @param int $customer_take_care_of_customs
	* 
	* @return array of values
	*/
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
			
			$total_tax = $total_with_shipping_fee * $tax; //!!!!! this should be $total_with_discount * $tax maybe !!!!!!!!!!!!!!!!!
			
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
	
	/**
	* this is a hack to change the quantity of a row to zero before updating it to make sure we update other
	*  values, otherwize the internal CI cart will not update unless qty has changed
	* 
	* @param undefined $item_row_id
	* @param undefined $old_qty
	* 
	* @return old quantity
	*/
	private function reset_cart_row_qty($item_row_id,$old_qty)
	{
		$data = array('rowid' => $item_row_id,'qty' => $old_qty+1  );
		$flag = $this->cart->update($data);
		return $old_qty;
	}

	//populate the cart from the previously saved file for the current user
	public function restore_user_cart_from_file($user_id)
	{
	//get his cart back if exists 
		//$user_id = $this->session->userdata("user_id");
		$file_full_name = './data/carts_temp/users/'.$user_id.'.gzip';
		if(file_exists($file_full_name))
		{
			$cart_file_gz = file_get_contents($file_full_name); // read file
			$cart_file_json = gzdecode($cart_file_gz); // uncompress the file
			$cart_content = json_decode($cart_file_json); // decode from json to object
			/*echo "<pre>";
			var_dump($cart_content);
			echo "</pre>";*/
			$this->cart->product_name_rules = '\d\D';
			foreach($cart_content as $item)
			{
				// prepare the array for the cart 
				$data = array(
               'thumbnail' 				=> $item->thumbnail,
               'id'        				=> (int)$item->id,
               'size_name'   			=> $item->size_name,
               'color_name'  			=> $item->color_name,
               'color_swatchurl'  		=> $item->color_swatchurl,
		       'cat_id'					=> $item->cat_id,
               'qty'       				=> (int)$item->qty,
               'price'     				=> $item->price,
               'name'      				=> $item->name,
		       'subtotal_promo' 		=> $item->subtotal_promo,
		       'promo_code'				=> $item->promo_code,
			   'has_service_fee'		=> $item->has_service_fee,
			   'cat_shipping_factor'	=> $item->cat_shipping_factor,
			   'discount_money'     	=> $item->discount_money,
               'discount_percentage'	=> $item->discount_percentage,
               'options' 				=> array('product_color_size_id' => $item->options->product_color_size_id )
            	);
            	
 
				// insert the array in the cart 
				$cart_flag = $this->cart->insert($data);
				/*echo "---------------------<br>";
				echo "<pre>";
				var_dump($data);
				echo "</pre>";*/
			}
		}
	}
	
	private function calculate_customs_fees()
	{
		$no_customs = FALSE;
		$no_customs = (bool)$this->input->cookie('no_customs', TRUE);
		if(!$no_customs)
		{
			$custom_fees = (double)$this->price_rules->get_price_rule_value(6);
		}
		else
		{
			$custom_fees = 0;
		}
		
		return $custom_fees;
	}
	
	private function calculate_customs_total($no_customs = FALSE,$total_price,$sale_tax,$service_fee,$shipping_fee,$credit_card_expanses,$custom_fees)
	{
			$subt1 = $total_price * (1+$sale_tax); // 107
			$subt2 = $subt1 + $service_fee; // 112
			$subt3 = $subt2 + $shipping_fee; // 144
			$credit_card_total = $subt3 * $credit_card_expanses; //4.32
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
	
	public function clean_up()
	{
		$cart_content = $this->cart->contents(); // get cart contents
		if(!empty($cart_content))
		{
			
			foreach($cart_content as $item)
			{
				$rowid = $item['rowid'];
				// prepare the array for the cart 
				$data = array(
               'rowid' => $rowid,
				'qty'       => 0
	        	);
				
				$cart_flag = $this->cart->update($data);
			}
			
		}
	}
	
	//save cart to file if user is logged in 
	private function save_cart_to_disk()
	{
		$flag = 0;
		
		if(!empty($this->session->userdata("user_id"))) $is_logged_in = TRUE; else $is_logged_in = FALSE;
		
		if($is_logged_in)
		{
			$user_id = $this->session->userdata("user_id");
			$file_full_name = './data/carts_temp/users/'.$user_id.'.gzip';
			$num_of_items = $this->cart->total_items();
			if($num_of_items > 0) // in case of delete
			{
				//update cart
				$cart_content = $this->cart->contents(); // get cart contents
				$cart_content_j_encoded = json_encode($cart_content); // encode it to json string
				$compressed = gzencode($cart_content_j_encoded, 9); // compress the json string 
				$flag = file_put_contents($file_full_name,$compressed); // save cart to file on server
					
			}
			else
			{
				//remove cart file from server
				if(file_exists($file_full_name))
				{
					unlink($file_full_name);
				}
				
			}
		}
		
		return $flag;
		
	}
	

	
	
}

/* End of file cart.php */
/* Location: ./application/controllers/cart.php */