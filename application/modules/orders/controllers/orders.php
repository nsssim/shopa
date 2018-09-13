<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class orders extends MX_Controller 
{

	public function add_new_order($customer_id_fk,$cart_id_fk,$address_delivery_id_fk,$address_invoice_id_fk,$currency_id)
	{
		//$oo= 55 ;
		$this->load->model("orders_mdl");
		$flag = $this->orders_mdl->add_new_order($customer_id_fk,$cart_id_fk,$address_delivery_id_fk,$address_invoice_id_fk,$currency_id);
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
	
		public function get_order_details0($ordr_id)
	{
		$this->load->model("orders_mdl");
		$order_details = $this->orders_mdl->get_order_details($ordr_id);
		
		//echo "<pre>";
		//print_r($order_details);
		//echo "</pre>";
		
		return $order_details;
	}
	
	public function add_order_details($last_order_id,$total_custom_fee,$order_sub_total,$shipping_fee_total,$service_fee,$grand_total,$total_tax,$total_credit_card_fee,$number_of_items,$cart_content_file,$shipping_factor_money_value,$start_up_shipping_value,$customs_rate,$v_order_sub_total,$v_shipping_and_handling_fee,$v_discount_total,$v_subtotal,$v_optional_custom_fees,$v_grand_total)
	{
		$this->load->model("orders_mdl");
		$flag = $this->orders_mdl->add_order_details($last_order_id,$total_custom_fee,$order_sub_total,$shipping_fee_total,$service_fee,$grand_total,$total_tax,$total_credit_card_fee,$number_of_items,$cart_content_file,$shipping_factor_money_value,$start_up_shipping_value,$customs_rate,$v_order_sub_total,$v_shipping_and_handling_fee,$v_discount_total,$v_subtotal,$v_optional_custom_fees,$v_grand_total);
		
		return $flag;
	}
	
	public function get_last_order_id()
	{
		$this->load->model("orders_mdl");
		$get_last_order_id = $this->orders_mdl->get_last_order_id();
		
		/*echo "<pre>";
		print_r($get_last_order_id[0]->last_id);
		echo "</pre>";*/
		
		return $get_last_order_id[0]->last_id;
	}
	
	public function get_last_orders($num_of_orders)
	{
		$this->load->model("orders_mdl");
		$get_last_orders = $this->orders_mdl->get_last_orders($num_of_orders);
		
		/*echo "<pre>";
		print_r($get_last_orders);
		echo "</pre>";*/
		
		return $get_last_orders;
	}
	
	public function get_order_details($order_id)
	{
		$oo = 55 ; 
		if(!empty($order_id))
		{
			$this->load->model("orders_mdl");
			$order_details = $this->orders_mdl->get_order_details($order_id);
			$oo = 55;
			
			//Handle the Adress country
			if($order_details[0]->coutry == 1)	$order_details[0]->coutry = "Turkey";
			if($order_details[0]->coutry == 2)	$order_details[0]->coutry = "USA";
			
			//Handle the Adress province
			if(!empty($order_details[0]->country_province))
			{
			 	$country_province_name =  $this->orders_mdl->get_country_province_name($order_details[0]->country_province);
			}
			if(!empty($country_province_name)) 
			{
				$order_details[0]->country_province = $country_province_name ; 
			}
				
			//Handle the Adress city
			if(!empty($order_details[0]->city))
			{
			 	$city_name =  $this->orders_mdl->get_city_name($order_details[0]->city);
			}
			if(!empty($city_name)) 
			{
				$order_details[0]->city = $city_name ; 
			}
			
			/*echo "<pre>";
			print_r($order_details);
			echo "</pre>";*/
			
			//$cart_resurected = json_decode($order_details[0]->cart_content); 
			
			/*echo "<pre>";
			print_r($cart_resurected);
			echo "</pre>";*/

			return $order_details;
		}
		else
		{
			return "wrong order number";
		}
	}
	
	public function get_number_of_orders()
	{
		$this->load->model("orders_mdl");
		$get_number_of_orders_arr = $this->orders_mdl->get_number_of_orders();
		$get_number_of_orders = $get_number_of_orders_arr[0]->num_orders;
		
		//echo $get_number_of_orders;
		
		return $get_number_of_orders;
		
	}
	
	public function get_orders_paginated($offset,$limit,$order_by_str)
	{
		$this->load->model('orders_mdl');
		$orders_page = $this->orders_mdl->get_orders_paginated($offset,$limit,$order_by_str);
		return $orders_page;
	}
	
	public function update_order_options($order_options)
	{
		$this->load->model('orders_mdl');
		$flag = $this->orders_mdl->update_order_options($order_options);
		return $flag ; 
	}
	
	public function set_order_details_journal($user_id,$order_id,$o_option_name,$o_option_value)
	{
		$this->load->model('orders_mdl');
		$flag = $this->orders_mdl->set_order_details_journal($user_id,$order_id,$o_option_name,$o_option_value);
		return $flag ; 
	}
	
	public function save_last_time_chaned($order_id,$o_option_name_last_time_changed)
	{
		$this->load->model('orders_mdl');
		$flag = $this->orders_mdl->save_last_time_chaned($order_id,$o_option_name_last_time_changed);
		return $flag ; 
	}
	 
	
}
/* End of file orders.php */
/* Location: ./application/controllers/cart.php */