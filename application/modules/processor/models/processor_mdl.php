<?php
/**
* session manager model
*/

class processor_mdl extends CI_Model
{
       

        
        public function get_account_info()
        {
	        $qry_str = '
	        SELECT * FROM `processor` WHERE processor.`status` = 1   
	        ';
	        $q = $this->db->query($qry_str);
	        return $q->result();
        }
        
        public function get_all_accounts()
        {
	        $qry_str = '
	        SELECT * FROM `processor`  
	        ';
	        $q = $this->db->query($qry_str);
	        return $q->result();
        }
        
        public function activate_account($id)
        {
			//set all accounts to inactive
			$qry_str = 'UPDATE processor set `status` = 0 WHERE id > 0';
			$flag1 = $this->db->query($qry_str);
	        
	        $qry_str = 'UPDATE processor set `status` = 1 WHERE id = '.$id;
			$flag2 = $this->db->query($qry_str);
		}
        
}


?>