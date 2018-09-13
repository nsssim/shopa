<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cart extends MX_Controller {

 function __construct()
    {
        parent::__construct();
        
        $this->load->model('home_mdl'); // needed for the template info (template path)
        
        $lng = $this->session->userdata("language_id");
        
        $this->load->helper("url");
        if (!$lng) 
			redirect(base_url().'home/error/lng');
        
        $this->load->model("product_mdl"); 
	 
    }


	// add product to the cart via ajax call
	public function add()
	{
		$this->load->helper("url");
		$product_id =  $this->input->post('product_id');
		
		$lng = $this->session->userdata("language_id");
		if (!$lng) 
			//echo "language not set";
			redirect(base_url().'home/error/lng');
			
		$produc_details = $this->product_mdl->get_product_details($product_id,$lng);
		$produc_images = $this->product_mdl->get_product_images($product_id);
		
		$thumbnail = $produc_images[0]->small_image;
		
		$name = $produc_details[0]->name;
		$price = $produc_details[0]->price;
		$sale_price = $produc_details[0]->salePrice;
		$web_id = $produc_details[0]->idd;
		
		$cart_price = 9999999; // init cart_price with unacceptable amount 
		if($sale_price) $cart_price = $sale_price ; 
		else $cart_price = $price ; 
		
		$quantity =  $this->input->post('quantity');
		$color_id =  $this->input->post('color_id');
		
		//$name =   $this->input->post('product_name') ;
	
		//$product_details =  $this->product_mdl->get_product_details($product_id,$lng);// i am here 
		 
		// to allow special characters into cart (if name has any)
		$this->cart->product_name_rules = '[:print:]';
		 
		// prepare the array for the cart
		$data = array(
               'thumbnail' => $thumbnail,
               'id'        => (int)$product_id,
               'web_id'    => (int)$web_id,
               'color_id'  => (int)$color_id,
               'qty'       => (int)$quantity,
               'price'     => (int)$cart_price,
               'name'      => $name,
               'options'   => array('Size' => 'L', 'Color' => 'Red')
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
		
		// prepare the array for the ajax callback function
		$cart_info = array(
		'num_of_items' => $this->cart->total_items(),
		'total_price' => $this->cart->total()
		);
		
		//send the num_of_items and total_price to the ajax call back function 
		echo json_encode($cart_info);
		
	}
	
	//remove a product from the cart via URI
	public function remove_item($row_id) 
	{
		//$debug = "hello bugs";
		
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
		$data['template_info'] = $this->home_mdl->get_template_info();// get the template for the active shop 
		// prepare the metadata information for the view page
		$data['meta_description'] =   "cart details";
		$data['meta_keywords']    =   "cart details";
		$data['page_title'] 	   =   "cart details";
		
		$this->load->module("price_rules");
		
		$sale_tax = $this->price_rules->get_price_rule_value(2);
		$credit_card_expanses = $this->price_rules->get_price_rule_value(5);
		$custom_fees = $this->price_rules->get_price_rule_value(6);
		
		$number_of_items = $this->cart->total_items();
		//$number_of_items = 1;
		
		if ($number_of_items > 0)
		{
		$data['is_empty'] = false;	
		
		$total_price = $this->cart->total();
		
		$shipping_fee = $this->price_rules->get_shipping_fee($number_of_items);
		
		$service_fee  = $this->price_rules->get_service_fee($number_of_items);
		
		$data["total_items"] = $total_price;
		$data["shipping_fees"] = $shipping_fee;
		$data["service_fees"] = $service_fee;
		$data["custom_fees"] = $custom_fees;
		
		$data["grand_total"] = (($total_price*(1+$sale_tax))+$service_fee+$shipping_fee) * (1+$credit_card_expanses) * (1+$custom_fees) ;
		
		/*echo " ---------- <br>";
		
		foreach ($this->cart->contents() as $item)
		{
			echo("id = ".$item['id']) ;	
			echo " <br>";
			echo("idd = ".$item['web_id']."<br>") ;	
			echo("price = ".$item['price']."<br>") ;	
		} */
		
		
		$this->load->view($data['template_info']['path'].'/cart_vew',$data);
		}
		else
		{
			$data['is_empty'] = true;
			
			//echo $data['is_empty'];
			$this->load->view($data['template_info']['path'].'/cart_vew',$data);
		}
	}



//this function is just for debugging 
	public function foo()
	{
		$tt = 88;
		$r = $this->input->post("a");
		$str = "R is = to ".$r;
		echo($str);
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

	
	

	
	
}

/* End of file cart.php */
/* Location: ./application/controllers/cart.php */