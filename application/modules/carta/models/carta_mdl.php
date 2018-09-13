<?php
class carta_mdl extends CI_Model
{
       
        public function add_new_cart($shop_id,$lang_id,$address_delivery_id,$address_invoice_id,$customer_id)
        {

        	$qry_str = '
        				 INSERT INTO carts SET
        				 id_shop = "'.$shop_id.'",
        				 id_lang = "'.$lang_id.'",
        				 id_address_delivery="'.$address_delivery_id.'",
        				 id_address_invoice="'.$address_invoice_id.'",
        				 id_customer="'.$customer_id.'",
        				 date_add=NOW()';
        	$q = $this->db->query($qry_str);
        	return $q;
        }
        
        
        public function get_last_id($table_name)
        {
			$qry_str = "SELECT MAX(id_cart) AS last_id FROM " . $table_name ;
			$q = $this->db->query($qry_str);
        	return $q->result();  
		}
        
        
        public function link_cart_product($last_cart_id,$product_id,$quantity,$color_id,$size_id,$promotional_deal_id,$address_delivery_id)
        {
        	//for products without colors set the id to 0 (other color)
        	if(empty($color_id)) $color_id = 0;
        	//for products without sizes set the id to 0 (other size)
			if(empty($size_id))  $size_id = 0;
			
			$qry_str = 
			'
        	INSERT INTO cart_product SET
        	id_cart = '.$last_cart_id.',
        	id_product = '.$product_id.',
        	id_size = '.$size_id.',
        	id_color = '.$color_id.',
        	quantity='.$quantity.',
        	id_address_delivery='.$address_delivery_id.',
        	date_add=NOW()
        	' ;
        	$q = $this->db->query($qry_str);
        	return $q;
		}
		
		public function get_color_details($color_id)
		{
			$qry_str = '
			SELECT
			colors.`name`,
			colors.swatchUrl AS swatchurl,
			cannonicalcolors.`name` AS cannonical_name
			FROM
			colors
			INNER JOIN cannonicalcolors ON cannonicalcolors.color_id_fk = colors.id
			WHERE
			colors.id = '.$color_id.'
			' ;
			$q = $this->db->query($qry_str);
        	return $q->result(); 
		}
		
		public function get_size_details($size_id)
		{
			$qry_str = '
			SELECT
			sizes.`name`,
			cannonicalsizes.`name` AS cannonical_name
			FROM
			sizes
			INNER JOIN cannonicalsizes ON cannonicalsizes.size_id_fk = sizes.id
			WHERE
			sizes.id = '.$size_id.'
			' ;
			$q = $this->db->query($qry_str);
        	return $q->result(); 
		}
		
		public function get_promotion_code($code)
		{
			$qry_str = '
			SELECT
			*
			FROM `promotions`
			WHERE
			promotions.`name` = "'.$code.'"
			' ;
			$q = $this->db->query($qry_str);
        	return $q->result(); 
		}
		
		public function get_promotion_data($promotion_id)
		{
			$qry_str = '
			SELECT
			*
			FROM `promotions`
			WHERE
			promotions.`id` = "'.$promotion_id.'"
			' ;
			$q = $this->db->query($qry_str);
        	return $q->result(); 
		}
		
		/**
		*	will update or insert user cart informations such as location on the server  
		* 
		* @param undefined $user_id
		* @param undefined $file_name
		* 
		* @return null
		*/
		
		public function save_user_cart($user_id,$file_name)
		{
			$qry_str =' SELECT * from  cart_temp where customer_id_fk ='.$user_id ;
			$q = $this->db->query($qry_str);
			$n = $q->num_rows();
			if($n > 0)
			//update row
			{
				$qry_str ='UPDATE cart_temp
							SET file_path="'.$file_name.'"
							WHERE customer_id_fk = '.$user_id;
			
				$this->db->query($qry_str);		
			}
			else
			//insert row
			{
				$qry_str ='INSERT INTO cart_temp
							SET file_path="'.$file_name.'",
							customer_id_fk = '.$user_id;
			
				$this->db->query($qry_str);		
			}
		}
		
		public function get_categories_with_promo_code($promo_code)
		{
			$qry_str ='SELECT
					   categories.id
					   FROM `categories`
					   WHERE
					   categories.promotion_code = "'.$promo_code.'" ';
						
			$q = $this->db->query($qry_str);
			//$n = $q->num_rows();	
			$r = $q->result();	
			return $r;
			
		}
        
      
}


?>