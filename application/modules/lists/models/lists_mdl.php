<?php
/**
* lists_mdl manager model
*/

class lists_mdl extends CI_Model
{
       
        public function get_featured_list_details($featured_list_name)
        {
	        $qry_str = 'SELECT
			*
			FROM
			lists
			WHERE
			lists.`name` = "'.$featured_list_name.'"';
			$q = $this->db->query($qry_str);
	    	return $q->result();
        }
}


?>