<?php
/**
* session manager model
*/

class sessman_mdl extends CI_Model
{
       
        public function get_active_session_fingerprint($session_id)
        {
	        $qry_str = '
	        SELECT
			ci_sessions.fingerprint
			FROM `ci_sessions`
			WHERE
			ci_sessions.session_id = "'.$session_id.'"
	        ';
	        $q = $this->db->query($qry_str);
	        
			if($q->num_rows() > 0)
			{
				$row = $q->row();
				$active_session_fingerprint =  $row->fingerprint;
	        	return $active_session_fingerprint;            
			}
			else return NULL;
        }
        
        
        public function clean_up_session_table($session_id,$session_fingerprint)
        {
	        $qry_str = '
	        DELETE FROM `ci_sessions`
			WHERE (
			ci_sessions.session_id != "'.$session_id.'"
			AND
			ci_sessions.fingerprint = "'.$session_fingerprint.'")  
	        ';
	        $q = $this->db->query($qry_str);
        }
        
        public function delete_empty_sessions()
        {
			$qry_str = '
	        DELETE FROM `ci_sessions`
			WHERE 
			ci_sessions.session_data = ""';
	        $q = $this->db->query($qry_str);
		}
        
        
        
        
        
}


?>