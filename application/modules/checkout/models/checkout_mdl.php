<?php
class checkout_mdl extends CI_Model
{
       
    public function get_countries()
		{
			$qry_str=
				'SELECT
				countries.`Name`
				FROM
				countries
				ORDER BY
				countries.`Name` ASC
				';
			$q = $this->db->query($qry_str);
        	return $q->result();
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
		
		public function get_customer_email($user_id)
		{
			$qry_str ='SELECT
					customers.email
					FROM
					customers
					WHERE
					customers.id = '.$user_id;
						
			$q = $this->db->query($qry_str);
			//$n = $q->num_rows();	
			$r = $q->result();	
			return $r[0]->email;
		}
		
		public function delete_order($order_id)
		{
			$qry_str = 'DELETE FROM orders WHERE orders.id = '. $order_id;
			$q = $this->db->query($qry_str);
        	return $q;
				
		}
		public function delete_user($user_id)
		{
			$qry_str = 'DELETE from customers WHERE customers.id = '. $user_id;
			$q = $this->db->query($qry_str);
        	return $q;
				
		}
		
		public function get_user_info($email) 
	{
		$qry_cust_info =' SELECT
		customers.id,
		customers.first_name,
		customers.last_name,
		customers.email,
		customers.username,
		customers.`password`,
		customers_statuses.type
		FROM
		customers
		INNER JOIN customers_statuses ON customers.status_id_fk = customers_statuses.id
		WHERE
		#----------------- the customer must be active (id = 1) ------------------#
		customers_statuses.id = "1" AND
		customers.email ="'. $email.'"';
		
		$cust_info = $this->db->query($qry_cust_info);
		return $cust_info->result();
	}
	
	

}
?>