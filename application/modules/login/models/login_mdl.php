<?php
class login_mdl extends CI_Model
{


	public function get_user_info($email) 
	{
		$oo=55;
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
	
	public function update_customer_password($user_id,$crypted_new_pwd)
		{
			$qry_str='
					UPDATE `customers` SET
					`password`="'.$crypted_new_pwd.'" 
					WHERE (`id`="'.$user_id.'");

			';
			$q = $this->db->query($qry_str);
			// return true if ok
			return $q;
		}

}

?>