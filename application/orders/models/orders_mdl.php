<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class orders_mdl extends CI_Model
{
      function __construct()
    {
         parent::__construct();
    }
    
        public function add_new_order($customer_id_fk,$cart_id_fk,$address_delivery_id_fk,$address_invoice_id_fk)
        {
        	$shop_id_fk = 1;
        	$lang_id_fk = 2;
        	
        	$qry_str = '
         	INSERT INTO orders SET
         	shop_id_fk = '.$shop_id_fk.',
         	lang_id_fk = '.$lang_id_fk.',
         	customer_id_fk='.$customer_id_fk.',
         	cart_id_fk='.$cart_id_fk.',
         	address_delivery_id_fk='.$address_delivery_id_fk.',
        	invoice_date=NOW(),
         	address_invoice_id_fk='.$address_invoice_id_fk;
        	$q = $this->db->query($qry_str);
        	return $q;           
        }
        
        public function get_order_details($ordr_id)
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
		
		
        
       
}


?>


