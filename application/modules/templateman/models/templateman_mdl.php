<?php
class templateman_mdl extends CI_Model
{
       
   
   /**
   * gets the template details 
   * 
   * @return return a simple array with the template fields name (path  css, js , fonts and other stuff)
   */
    public function get_template_info($template_id)
	    {
	        $qry_tpl = 'SELECT DISTINCT
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
						templates.id_template = '.$template_id;
						
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
			
			return  $tmplt;
        }

}
?>