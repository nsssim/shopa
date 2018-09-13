<?php
class sitemapman_mdl extends CI_Model
{
   public function get_categories_localizedid($lang_id = 2)
   {
   		$qry_str =  'SELECT
					category_lang.localizedId,
					category_lang.id_category
					FROM `category_lang`
					WHERE
					category_lang.id_lang = '.$lang_id;
	  		
		$q = $this->db->query($qry_str);
    	return $q->result();
    	
   }
   
    public function get_categories_link_rewrite($lang_id = 1)
   {
   		$qry_str =  'SELECT
					category_lang.id_category,
					category_lang.link_rewrite
					FROM `category_lang`
					WHERE
					category_lang.id_lang = '.$lang_id;
	  		
		$q = $this->db->query($qry_str);
    	return $q->result();
    	
   }
   
   
   
}
?>