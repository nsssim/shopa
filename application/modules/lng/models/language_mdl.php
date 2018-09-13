<?php
class language_mdl extends CI_Model
{
       
        public function get_languages()
        {
	        $qry_str = "SELECT * FROM `languages`;";
	        $q = $this->db->query($qry_str);
	        return $q->result();            
        }
        
        public function get_language_details($lang_id)
        {
			$qry_str = 'SELECT
						*
						FROM `languages`
						WHERE
						languages.id = '.$lang_id.'
						';
	        $q = $this->db->query($qry_str);
	        return $q->result();      
		}
}


?>


