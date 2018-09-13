<?php
class home_mdl extends CI_Model
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
		 
		  public function get_combo($combo_name,$id_lang,$id_shop)
		 {
		 $qry_combo0 = 	'SELECT
						images_sizes_iphone.url,
						product_combo_product.product_id_fk,
						product_lang.`name`
						FROM
						product_combo
						INNER JOIN product_combo_product ON product_combo_product.product_combo_id_fk = product_combo.product_combo_id
						INNER JOIN products ON product_combo_product.product_id_fk = products.id
						INNER JOIN images ON images.product_id_fk = products.id
						INNER JOIN images_sizes ON images_sizes.image_id_fk = images.id
						INNER JOIN images_sizes_iphone ON images_sizes_iphone.image_size_id_fk = images_sizes.id
						INNER JOIN product_lang ON product_lang.id_product = products.id
						WHERE
						product_combo.combo_name LIKE "'.$combo_name.'"
						and 
						product_lang.id_lang = '.$id_lang.'
						and 
						product_lang.id_shop = '.$id_shop.'
						';
						
						
		$qry_combo = 'SELECT
						products.id,
						products.idd,
						products.price,
						images_sizes_iphone.url,
						product_lang.`name`,
						product_lang.description
						FROM
						products
						INNER JOIN product_combo_product ON product_combo_product.product_id_fk = products.id
						INNER JOIN product_lang ON product_lang.id_product = products.id
						INNER JOIN images ON images.product_id_fk = products.id
						INNER JOIN images_sizes ON images_sizes.image_id_fk = images.id
						INNER JOIN images_sizes_iphone ON images_sizes_iphone.image_size_id_fk = images_sizes.id
						INNER JOIN product_combo ON product_combo_product.product_combo_id_fk = product_combo.product_combo_id
						WHERE
						product_lang.id_shop = '.$id_shop.' AND
						product_lang.id_lang = '.$id_lang.' AND
						product_combo.combo_name = "'.$combo_name.'"
						';
						
		$qry_combo_alt = 	'SELECT
							products.id,
							product_lang.`name`,
							product_lang.description,
							images_sizes_iphone_alt.id
							FROM
							products
							INNER JOIN product_lang ON product_lang.id_product = products.id
							INNER JOIN products_images_alt ON products_images_alt.product_id_fk = products.id
							LEFT JOIN images_alt ON products_images_alt.image_alt_id_fk = images_alt.id
							INNER JOIN images_sizes_alt ON images_sizes_alt.image_alt_id_fk = images_alt.id
							INNER JOIN images_sizes_iphone_alt ON images_sizes_iphone_alt.image_size_alt_id_fk = images_sizes_alt.id
							WHERE
							product_lang.id_shop = 1 AND
							product_lang.id_lang = 2'
							;		
		
		 $r_combo = $this->db->query($qry_combo);
		 return $r_combo->result();
		 }
}


?>