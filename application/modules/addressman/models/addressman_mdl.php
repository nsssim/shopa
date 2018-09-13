<?php
class addressman_mdl extends CI_Model
{
       

        public function get_cities_tr()
        {
			$qry_str = "SELECT * FROM `cities_tr` " ;
			$q = $this->db->query($qry_str);
        	return $q->result();  
		}
		
		public function get_all_counties_tr()
        {
			$qry_str = "SELECT * FROM `counties_tr`" ;
			$q = $this->db->query($qry_str);
        	return $q->result();  
		}
		
		
		public function get_counties_tr($city_id)
        {
			$qry_str = 'SELECT
			*
			FROM
			counties_tr
			WHERE
			counties_tr.city_id = '.$city_id.' ORDER BY `name` ' ;
			$q = $this->db->query($qry_str);
        	return $q->result();  
		}
		
		public function get_address_details($address_id)
		{
			$qry_str= 'SELECT	*	FROM addresses where id='.$address_id;
			$q = $this->db->query($qry_str);
        	return $q->result();  
		}
		
		public function get_user_shipping_addresses($user_id)
		{
			$qry_str= 'SELECT
						addresses.id
						FROM
						addresses
						INNER JOIN customer_addresses ON customer_addresses.address_id_fk = addresses.id
						WHERE
						customer_addresses.customer_id_fk = '.$user_id.' AND
						customer_addresses.is_for_delivery = 1
						ORDER BY
						addresses.adding_date ASC';
			$q = $this->db->query($qry_str);
        	return $q->result();  
		}
		
		public function set_address_as_primary($address_id)
		{
			$qry_str= 'UPDATE `addresses` SET is_default=1 WHERE id ='.$address_id;
			$q = $this->db->query($qry_str);
		}
		
		public function del_shipping_address($address_id)
		{
			$qry_str= 'DELETE FROM `addresses` WHERE id='.$address_id;
			$q = $this->db->query($qry_str);
        	return $q;
		}
		
		public function set_all_user_shipping_address_as_non_primary($user_id)
		{
			$qry_str=
			'UPDATE 
				addresses
				INNER JOIN customer_addresses ON addresses.id = customer_addresses.address_id_fk
				SET addresses.is_default = NULL
				WHERE
				customer_addresses.customer_id_fk = '.$user_id.'
				AND
				customer_addresses.is_for_delivery = 1';
			
			$q = $this->db->query($qry_str);
			return $q;
		}
		
		public function set_shipping_address_as_primary($address_id)
		{
			$qry_str=
			'UPDATE 
			addresses			
			SET addresses.is_default = 1
			WHERE
			addresses.id = '.$address_id ;
			
			$q = $this->db->query($qry_str);
			return $q;
		}
		
        
     
      
}


?>