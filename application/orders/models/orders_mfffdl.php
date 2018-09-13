<?php
class orders_mdl extends CI_Model
{
       
        public function add_new_order($customer_id_fk,$cart_id_fk,$address_delivery_id_fk,$address_invoice_id_fk)
        {
        	$shop_id_fk = 1;
        	$lang_id_fk = 2;
        	
        	$qry_str = '
         	INSERT INTO orders SET
         	shop_id_fk = "'.$shop_id_fk.'",
         	lang_id_fk = "'.$lang_id_fk.'",
         	customer_id_fk="'.$customer_id_fk.'",
         	cart_id_fk="'.$cart_id_fk.'",
         	address_delivery_id_fk="'.$address_delivery_id_fk.'",
        	invoice_date=NOW(),
         	address_invoice_id_fk="'.$address_invoice_id_fk;
        	$q = $this->db->query($qry_str);
        	return $q;           
        }
        
       
}


?>


