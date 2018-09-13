<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class orders_mdl extends CI_Model
{
      function __construct()
    {
         parent::__construct();
    }
    
        public function add_new_order($customer_id_fk,$cart_id_fk,$address_delivery_id_fk,$address_invoice_id_fk,$currency_id)
        {
        	$shop_id_fk = 1;
        	$lang_id_fk = 2;

        	$qry_str = '
         	INSERT INTO orders SET
         	shop_id_fk = '.$shop_id_fk.',
         	lang_id_fk = '.$lang_id_fk.',
         	currency_id_fk = '.$currency_id.',
         	customer_id_fk='.$customer_id_fk.',
         	cart_id_fk='.$cart_id_fk.',
         	address_delivery_id_fk='.$address_delivery_id_fk.',
        	date_add= NOW(),
         	address_invoice_id_fk='.$address_invoice_id_fk;
        	$q = $this->db->query($qry_str);
        	return $q;           
        }
        
        public function get_last_order_id()
        {
			$qry_str = "SELECT MAX(id) AS last_id FROM orders";
			$q = $this->db->query($qry_str);
        	return $q->result();  
		}
        
        public function get_order_details0($ordr_id)
        {
			$qry_str = '
			SELECT
			customers.id,
			customers.email,
			customers.first_name,
			customers.last_name,
			customers.phone,
			cart_product.quantity,
			product_lang.`name`,
			products.id AS product_id,
			products.price
			FROM
			orders
			INNER JOIN carts ON orders.cart_id_fk = carts.id_cart
			INNER JOIN cart_product ON cart_product.id_cart = carts.id_cart
			INNER JOIN products ON cart_product.id_product = products.id
			INNER JOIN customers ON orders.customer_id_fk = customers.id AND carts.id_customer = customers.id
			INNER JOIN product_lang ON product_lang.id_product = products.id
			WHERE
			orders.id = '.$ordr_id.'
			';
			$q = $this->db->query($qry_str);
        	return $q->result();   
		}
		
		 public function get_orders($offset,$range)
        {
			$qry_str = 'SELECT
						*
						FROM `orders`
						LIMIT '.$offset.', '.$range;
						
			$q = $this->db->query($qry_str);
        	return $q->result();   
		}
		
		public function add_order_details($last_order_id,$total_custom_fee,$order_sub_total,$shipping_fee_total,$service_fee,$grand_total,$total_tax,$total_credit_card_fee,$number_of_items,
		$cart_content_file,$shipping_factor_money_value,$start_up_shipping_value,$customs_rate,$v_order_sub_total,$v_shipping_and_handling_fee,$v_discount_total,$v_subtotal,$v_optional_custom_fees,$v_grand_total)
		{
			$qry_str = '
         	INSERT INTO orders_detail SET
         	order_id_fk = '.$last_order_id.',
         	total_custom_fee = '.$total_custom_fee.',
         	order_sub_total = '.$order_sub_total.',
         	shipping_fee_total = '.$shipping_fee_total.',
         	service_fee = '.$service_fee.',
         	grand_total = '.$grand_total.',
         	total_tax = '.$total_tax.',
         	total_credit_card_fee = '.$total_credit_card_fee.',
         	number_of_items = '.$number_of_items.',
         	shipping_factor_money_value = '.$shipping_factor_money_value.',
         	start_up_shipping_value = '.$start_up_shipping_value.',
         	customs_rate = '.$customs_rate.',
         	v_order_sub_total = '.$v_order_sub_total.',
         	v_shipping_and_handling_fee = '.$v_shipping_and_handling_fee.',
         	v_discount_total ='.$v_discount_total.',
         	v_subtotal = '.$v_subtotal.',
         	v_optional_custom_fees ='.$v_optional_custom_fees.',
         	v_grand_total ='.$v_grand_total.',
         	is_taken = 1,
         	cart_content = '.$this->db->escape($cart_content_file);
         	
        	$q = $this->db->query($qry_str);
        	return $q;
		}
		
		public function get_last_orders($num_of_orders)
		{
			$qry_str = '
			SELECT
			orders.id,
			orders.date_add,
			orders_detail.grand_total,
			orders_detail.number_of_items,
			customers.first_name,
			customers.last_name,
			customers.email,
			currencies.iso_code AS currency_code,
			currencies.sign currency,
			addresses.coutry,
			addresses.city
			FROM
			orders
			INNER JOIN orders_detail ON orders_detail.order_id_fk = orders.id
			INNER JOIN customers ON orders.customer_id_fk = customers.id
			INNER JOIN currencies ON orders.currency_id_fk = currencies.id
			INNER JOIN addresses ON orders.address_delivery_id_fk = addresses.id AND orders.address_delivery_id_fk = addresses.id
			ORDER BY
			orders.date_add ASC
			LIMIT 0, '.$num_of_orders.'
			';
			$q = $this->db->query($qry_str);
        	return $q->result();
		}
		
		public function get_order_details($order_id)
		{
			$qry_str= '
			SELECT
			orders.id,
			orders.date_add,
			orders_detail.grand_total,
			orders_detail.number_of_items,
			customers.id AS customer_id,
			customers.first_name,
			customers.last_name,
			customers.email,
			currencies.iso_code,
			currencies.sign,
			addresses.coutry,
			addresses.city,
			orders_detail.total_tax,
			orders_detail.total_credit_card_fee,
			orders_detail.shipping_factor_money_value,
			orders_detail.start_up_shipping_value,
			orders_detail.service_fee,
			orders_detail.shipping_fee_total,
			orders_detail.order_sub_total,
			orders_detail.total_custom_fee,
			orders_detail.cart_content,
			orders_detail.v_order_sub_total,
			orders_detail.v_shipping_and_handling_fee,
			orders_detail.v_discount_total,
			orders_detail.v_subtotal,
			orders_detail.v_optional_custom_fees,
			orders_detail.v_grand_total,
			addresses.line_1,
			addresses.line_2,
			addresses.line_3,
			addresses.country_province,
			addresses.zip_code,
			customers.phone,
			customers.alt_phone
			FROM
						orders
						INNER JOIN orders_detail ON orders_detail.order_id_fk = orders.id
						INNER JOIN customers ON orders.customer_id_fk = customers.id
						INNER JOIN currencies ON orders.currency_id_fk = currencies.id
						INNER JOIN addresses ON orders.address_delivery_id_fk = addresses.id AND orders.address_delivery_id_fk = addresses.id
			WHERE
						orders.id = '.$order_id;
			
			$q = $this->db->query($qry_str);
        	$order_details = $q->result();
        	
        	/*	
        	echo "<pre>";
        	var_dump($order_details);
        	echo "</pre>";
        	*/
        	//$oo = 55 ;
        	
        	return $order_details;
        	
		}
		
		public function get_number_of_orders(){
			$qry_str= '
			SELECT
			Count(orders.id) AS num_orders
			FROM
			orders
			';
			$q = $this->db->query($qry_str);
        	return $q->result();
		}
		
		public function get_customer_orders_count($customer_id)
		{
			$qry_str='
			SELECT
			Count(orders.id) AS number_of_orders
			FROM `orders`
			WHERE
			orders.customer_id_fk = '.$customer_id.'
			';
			$q = $this->db->query($qry_str);
        	return $q->result();
		}	
		
		public function get_customer_order($customer_id,$offset =0,$per_page=500)
		{
			$qry_str='
			SELECT
			*
			FROM `orders`
			WHERE
			orders.customer_id_fk = 13
			LIMIT
			'.$offset.','.$per_page.'
			';
			$q = $this->db->query($qry_str);
        	return $q->result();
		}
		
		public function count_orders()
		{
			$qry_str= 'SELECT
			Count(orders.id)
			FROM
			orders
			';
			$q = $this->db->query($qry_str);
			$total_orders = $q->result();
        	return $total_orders[0];
		}
        
        public function get_orders_paginated($offset,$limit,$order_by_str)
        {
			if(empty($order_by_str)) $order_by_str ="id asc"; 
			
			$qry_str='
			SELECT
			orders.id,
			orders.date_add,
			orders_detail.grand_total,
			orders_detail.number_of_items,
			
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
			
			customers.first_name,
			customers.last_name,
			customers.email,
			currencies.iso_code AS currency_code,
			currencies.sign currency,
			addresses.coutry,
			addresses.city
			FROM
			orders
			INNER JOIN orders_detail ON orders_detail.order_id_fk = orders.id
			INNER JOIN customers ON orders.customer_id_fk = customers.id
			INNER JOIN currencies ON orders.currency_id_fk = currencies.id
			INNER JOIN addresses ON orders.address_delivery_id_fk = addresses.id AND orders.address_delivery_id_fk = addresses.id
			ORDER BY
			'.$order_by_str.'
			LIMIT '.$offset.','.$limit;
			
			$q = $this->db->query($qry_str);
        	return $q->result();
			
		}
		
		public function update_order_options($order_options)
		{
			if($order_options['row_name'] == "tracking_num")
			{
				$order_options['row_value'] = '"'.$order_options['row_value'].'"';
			}
			
			$qry_str='UPDATE `orders_detail` SET '.$order_options['row_name'].' = '.$order_options['row_value'].' WHERE order_id_fk ='.$order_options['order_id'];
			$q = $this->db->query($qry_str);
			return $q;
		}
		
		public function set_order_details_journal($user_id,$order_id,$o_option_name,$o_option_value)
		{
			$qry_str='INSERT INTO  `order_details_journal` 
									SET 
										`order_id_fk` = '.$order_id.',
										`user_id_fk`  = '.$user_id.',
										`field_name`  = "'.$o_option_name.'",
										`field_value` = "'.$o_option_value.'",
										`date_time`   = NOW()';
			
			$q = $this->db->query($qry_str);
			return $q;

		}
		
		public function save_last_time_chaned($order_id,$o_option_name_last_time_changed)
		{
			$qry_str='UPDATE `orders_detail` SET `'.$o_option_name_last_time_changed.'` = NOW() WHERE `order_id_fk` = '.$order_id;
			
			$q = $this->db->query($qry_str);
			return $q;
		}
		
		public function get_country_province_name($id)
		{
			$qry_str='SELECT counties_tr.`name` FROM `counties_tr` WHERE counties_tr.id = '.$id;
			$q = $this->db->query($qry_str);
        	return $q->result()[0]->name;
		}
		
		public function get_city_name($id)
		{
			$qry_str='SELECT cities_tr.`name` FROM `cities_tr` WHERE cities_tr.id ='.$id;
			$q = $this->db->query($qry_str);
        	return $q->result()[0]->name;
		}
       
}
?>