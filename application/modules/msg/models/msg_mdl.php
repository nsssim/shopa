<?php
class msg_mdl extends CI_Model
{
       
       /* public function get_languages()
        {
	        $qry_str = "SELECT * FROM `languages`;";
	        $q = $this->db->query($qry_str);
	        return $q->result();            
        }*/
        
        public function get_translated_message($msg_id,$lang_id)
        {
			$qry_str =
			'SELECT
			messages.text
			FROM `messages`
			WHERE
			messages.id = '.$msg_id.' AND
			messages.lang_id = '.$lang_id;
			
			$q = $this->db->query($qry_str);
	        return $q->result(); 
		}
		
		public function get_words($page_name,$lang_id)
		{
			$qry_str =
			'SELECT
			words.`key`,
			words.`value`
			FROM `words`
			WHERE
			words.page = "'.$page_name.'" AND
			words.language_id =  '.$lang_id;
			
			$q = $this->db->query($qry_str);
	        return $q->result();
		}
}
?>