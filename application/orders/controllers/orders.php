<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class orders extends MX_Controller 
{

	public function add_new_order($customer_id_fk,$cart_id_fk,$address_delivery_id_fk,$address_invoice_id_fk)
	{
		//$oo= 55 ;
		$this->load->model("orders_mdl");
		$flag = $this->orders_mdl->add_new_order($customer_id_fk,$cart_id_fk,$address_delivery_id_fk,$address_invoice_id_fk);
		return $flag ; 
	}
	
	public function get_orders($offset,$range)
	{
		$this->load->model("orders_mdl");
		$orders = $this->orders_mdl->get_orders($offset,$range);
		
		//echo "<pre>";
		//print_r($orders);
		//echo "</pre>";
		
		return $orders;
	}
	
		public function get_order_details($ordr_id)
	{
		$this->load->model("orders_mdl");
		$order_details = $this->orders_mdl->get_order_details($ordr_id);
		
		//echo "<pre>";
		//print_r($order_details);
		//echo "</pre>";
		
		return $order_details;
	}
	
}
/* End of file orders.php */
/* Location: ./application/controllers/cart.php */