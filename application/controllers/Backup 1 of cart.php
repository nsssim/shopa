<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cart extends CI_Controller {

 function __construct()
    {
        parent::__construct();
        
        $this->load->model('home_mdl'); // needed for the template info (template path)
        
        $lng = $this->session->userdata("language_id");
        
        $this->load->model("product_mdl"); 
	 
    }


	// add product to the cart 
	public function add()
	{
		$product_id =  $this->input->post('product_id');
		$quantity =  $this->input->post('quantity');
		
	
		//$product_details =  $this->product_mdl->get_product_details($product_id,$lng);// i am here 
		 
		 
		// prepare the array for the cart
		$data = array(
               'id'      => $product_id,
               'qty'     => $quantity,
               'price'   => 39.95,
               'name'    => 'T-Shirt',
               'options' => array('Size' => 'L', 'Color' => 'Red')
            );
 
		// insert the array in the cart 
		$this->cart->insert($data);

		
		// prepare the array for the ajax callback function
		$cart = array(
		'num_of_items' => $this->cart->total_items(),
		'total_price' => $this->cart->total()
		);
		
		echo json_encode($cart);
		//echo $product_id. " is now in your basket... so far you are going to spend \$ ".$this->cart->total(). " today, and you have ".$this->cart->total_items()." item(0)";
		 
	}
	
	public function remove()
	{
		$debug = "hello bugs";
		
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
	
//call the cart view
	public function details()
	{
		$A['template_info'] = $this->home_mdl->get_template_info();// get the template for the active shop 
		// prepare the metadata information for the view page
		$A['meta_description'] =   "cart details";
		$A['meta_keywords']    =   "cart details";
		$A['page_title'] 	   =   "cart details";
		
		$this->load->view($A['template_info']['path'].'/cart_vew',$A);
	}



//this function is just for debugging 
	public function foo()
	{
		$tt = 88;
		$r = $this->input->post("a");
		$str = "R is = to ".$r;
		echo($str);
	}
	
	
	

	
	
}

/* End of file cart.php */
/* Location: ./application/controllers/cart.php */