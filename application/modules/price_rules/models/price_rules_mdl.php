<?php
class price_rules_mdl extends CI_Model
{
       
    public function get_price_rule_value($rule_code)
    {
		$qry_str='
		SELECT
		price_rules.`value`
		FROM `price_rules`
		WHERE
		price_rules.code = "'.$rule_code.'"
		';
	    
	    $q = $this->db->query($qry_str);
	    return $q->result();            
    }
    
        public function get_shipping_fee($num_of_items)
    {
		$qry_str=
		'
		SELECT
		price_rules.`value`
		FROM `price_rules`
		WHERE
		price_rules.num_of_items = '.$num_of_items.'
		';
	    $q = $this->db->query($qry_str);
	    return $q->result();            
    }
    
        public function get_service_fee($num_of_items)
    {
		$qry_str=
		'
		SELECT
		price_rules.`value`
		FROM `price_rules`
		WHERE
		price_rules.min_product <= '.$num_of_items.' AND
		price_rules.max_product >= '.$num_of_items.'
		';
	    
	    $q = $this->db->query($qry_str);
	    return $q->result();            
    }
    
    public function get_price_id_value(){
    	$qry_str=
		'
		SELECT * FROM `price_id_value`;';
	    
	    $q = $this->db->query($qry_str);
	    return $q->result();    
		
	}
	
	public function reset_max_price()
	{
		$qry_str=
		'UPDATE `price_id_value` SET is_max = NULL ;';
	    $q = $this->db->query($qry_str);
	    return $q;  
	}
	
	public function set_max_price($max_price_id)
	{
		$qry_str =	'UPDATE `price_id_value` SET is_max = 1 WHERE id ='.$max_price_id;
	    $q = $this->db->query($qry_str);
	    return $q;    
	}
	
	public function get_max_price_admin_value()
	{
		$qry_str=	'SELECT * FROM `price_id_value` WHERE is_max = 1';
	    
	    $q = $this->db->query($qry_str);
	    return $q->result();  
	}
    

}
?>