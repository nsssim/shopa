<?php
class admin_mdl extends CI_Model
{
    public function get_admin_privileges($id)
	{
		$qry_str = 'SELECT
		admins_permissions.id,
		admins_permissions.`name`,
		admins_permissions.dashboard,
		admins_permissions.order,
		admins_permissions.customers,
		admins_permissions.price_rules,
		admins_permissions.eprocessors,
		admins_permissions.lists,
		admins_permissions.categories,
		admins_permissions.whowhatwhen,
		admins_permissions.emails,
		admins_permissions.misc,
		admins_permissions.Admins
		FROM
		customers
		INNER JOIN admins_permissions ON customers.permission_id_fk = admins_permissions.id
		WHERE
		customers.id = '.$id;
		$q = $this->db->query($qry_str);
    	return $q->result();
	}
	
	public function get_admins_list()
	{
		$qry_str = 'SELECT
		customers.id,
		customers.email,
		customers.first_name,
		customers.last_name,
		customers.`password`,
		admins_permissions.id AS admin_id,
		admins_permissions.`name` AS admin_group,
		admins_permissions.dashboard,
		admins_permissions.order,
		admins_permissions.customers,
		admins_permissions.price_rules,
		admins_permissions.eprocessors,
		admins_permissions.lists,
		admins_permissions.categories,
		admins_permissions.Admins
		FROM
		customers
		LEFT JOIN admins_permissions ON customers.permission_id_fk = admins_permissions.id
		WHERE
		customers.is_admin = 1
		';
		$q = $this->db->query($qry_str);
    	return $q->result();	
	} 
	
	
	public function get_admin_groups()
	{
		$qry_str = 'SELECT * FROM admins_permissions';
		$q = $this->db->query($qry_str);
    	return $q->result();
	}
	
	public function update_admin_group_privileges($admin_group_id,$privilege_name,$state_str)
	{
		$state = ($state_str === 'true')? 1: 0;
		
		$qry_str = 'UPDATE
		 `admins_permissions` SET
		 `'.$privilege_name.'`='.$state.'
		 WHERE 
		 (`id`='.$admin_group_id.'); ';
		 
		$q = $this->db->query($qry_str);
		
		
	}  
	
	public function delete_admin_group($admin_group_id)
	{
		$qry_str = 'DELETE FROM admins_permissions WHERE id = '.$admin_group_id;
		$q = $this->db->query($qry_str);
		
	}
	
	public function add_administrator($admin_group_id,$user_id)
	{
		$qry_str = 'UPDATE `customers` SET is_admin= 1 , permission_id_fk='.$admin_group_id.' WHERE id = '.$user_id;
		$q = $this->db->query($qry_str);
		
	}
	
	public function demote_administrator($user_id)
	{
		$qry_str = 'UPDATE `customers` SET is_admin= 0 , permission_id_fk= NULL WHERE id = '.$user_id;
		$q = $this->db->query($qry_str);
	}
	
	public function add_admin_group($name)
	{
		$qry_str = 'INSERT INTO `admins_permissions` (`name`) VALUES ("'.$name.'")';
		$q = $this->db->query($qry_str);
	}
	
	public function get_categories()
	{
		$qry_str ='SELECT
		categories.parent_id,
		categories.id,
		category_lang.`name`,
		categories.active,
		categories.service_fee,
		categories.shipping_factor,
		categories.promotion_code,
		categories.discount_money,
		categories.discount_percentage
		FROM
		categories
		LEFT JOIN category_lang ON category_lang.id_category = categories.id
		WHERE
		category_lang.id_lang = 2
		ORDER BY
		categories.parent_id ASC,
		category_lang.`name` ASC'	;
		
		$q = $this->db->query($qry_str);
    	return $q->result();
	}
	
	
	
	
     
}
?>