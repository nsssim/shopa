<?php
class shop_mdl extends CI_Model
{
       
        public function get_template_info()
        {
        $qry_tpl = "SELECT DISTINCT
					templates.id_template,
					templates.`name`,
					templates.path,
					templates.css_path,
					templates.js_path,
					templates.fonts_path,
					templates.misc_path
					FROM
					templates
					INNER JOIN shops ON shops.template_id_fk = templates.id_template
					WHERE
					shops.active = 1 ";
					
         $r_tpl = $this->db->query($qry_tpl);
        // return $q->result();  
        
        // extract template  paths  from  $r_tpl I used array_map to do that
		$t = array_map(create_function('$tmp', 'return $tmp->path;'), $r_tpl->result());  unset($tmp) ;
		$tmplt['path'] = $t[0]; unset($t) ;

		$t = array_map(create_function('$tmp', 'return $tmp->css_path;'), $r_tpl->result());  unset($tmp) ;
		$tmplt['css_path'] = $t[0]; unset($t) ;
		
		$t = array_map(create_function('$tmp', 'return $tmp->js_path;'), $r_tpl->result());  unset($tmp) ;
		$tmplt['js_path'] = $t[0]; unset($t) ;
		
		$t = array_map(create_function('$tmp', 'return $tmp->fonts_path;'), $r_tpl->result());  unset($tmp) ;
		$tmplt['fonts_path'] = $t[0]; unset($t) ;
		
		// return a simple array with the template fields name (path  css, js , fonts and other stuff)
		return  $tmplt;
        }


		 public function get_meta_info($lang_id)
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
						meta.page = "index" AND
						meta_lang.id_lang = '.$lang_id.' AND
						shops.id = 1
						';
		 $r_meta = $this->db->query($qry_meta);
		 return $r_meta->result();
		 }


}


?>


