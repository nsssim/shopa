<?php
class seo_mdl extends CI_Model
{
 	public function get_meta_info($page_name,$lang_id)
	{
	 	
	 $qry_meta = 	'SELECT
					meta_lang.title,
					meta_lang.description,
					meta_lang.viewport,
					meta_lang.keywords
					FROM
					meta
					INNER JOIN meta_lang ON meta_lang.id_meta = meta.id_meta
					INNER JOIN shops ON meta_lang.id_shop = shops.id
					WHERE
					meta.page = "'.$page_name.'" AND
					meta_lang.id_lang = '.$lang_id.' AND
					shops.id = 1
					';
	 	$q = $this->db->query($qry_meta);
	 	return $q->result();
	}
	
	public function get_cat_meta_info($cat_id,$lang_id)
	{
		$qry_meta = 'SELECT
					category_lang.shortName,
					category_lang.meta_title AS `title`,
					category_lang.meta_keywords AS `keywords`,
					category_lang.meta_description AS `description`,
					category_lang.link_rewrite,
					category_lang.`name`
					FROM
					category_lang
					WHERE
					category_lang.id_category = '.$cat_id.' AND
					category_lang.id_lang = '.$lang_id;
	 	$q = $this->db->query($qry_meta);
	 	return $q->result();
		
	}   
       
        
      
}


?>