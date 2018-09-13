<?php
class categories_mdl extends CI_Model
{
       
    public function get_cat_meta_info($id,$lang_id)
    {
		$qrt_str='
		SELECT
		category_lang.`name`
		FROM
		categories
		INNER JOIN category_lang ON category_lang.id_category = categories.id
		WHERE
		categories.id = '.$id.' AND
		category_lang.id_lang = '.$lang_id.'
		';
	}
    
    
    
    public function get_cat_tree($cat_id)
    {
		$oo = 55 ;
		//$this->db->cache_on();
		$qry_str='
		SELECT
		c1.id AS lev1_id,
		c2.id AS lev2_id,
		c3.id AS lev3_id,
		c4.id AS lev4_id,
		c5.id AS lev5_id,
		c6.id AS lev6_id
		FROM
		categories AS c1
		LEFT JOIN categories AS c2 ON c2.parent_id = c1.id
		LEFT JOIN categories AS c3 ON c3.parent_id = c2.id
		LEFT JOIN categories AS c4 ON c4.parent_id = c3.id
		LEFT JOIN categories AS c5 ON c5.parent_id = c4.id
		LEFT JOIN categories AS c6 ON c6.parent_id = c5.id

		WHERE c1.id = '.$cat_id.'
		';
	    
	    $q = $this->db->query($qry_str);
	    return $q->result();            
    }



	// will return a result like this 
	/*
	+---------+---------+---------+---------+---------+---------+
	| lev1_id | lev2_id | lev3_id | lev4_id | lev5_id | lev6_id |
	+---------+---------+---------+---------+---------+---------+
	|       2 |      31 |      12 | NULL    | NULL    | NULL    |
	|       2 |      31 |      33 | NULL    | NULL    | NULL    |
	|       2 |      31 |      34 | NULL    | NULL    | NULL    |
	|       2 |      31 |      35 | NULL    | NULL    | NULL    |
	|       2 |      31 |      36 | NULL    | NULL    | NULL    |
	|       2 |      31 |      38 | NULL    | NULL    | NULL    |
	|       2 |      31 |      39 | NULL    | NULL    | NULL    |
	|       2 |      31 |      40 | NULL    | NULL    | NULL    |
	|       2 |     109 |     110 | NULL    | NULL    | NULL    |
	|       2 |     109 |     111 | NULL    | NULL    | NULL    |
	|       2 |     109 |     112 | NULL    | NULL    | NULL    |
	|       2 |     109 |     113 | NULL    | NULL    | NULL    |
	|       2 |     109 |     114 | NULL    | NULL    | NULL    |
	|       2 |     109 |     115 | NULL    | NULL    | NULL    |
	|       2 |     109 |     116 | NULL    | NULL    | NULL    |
	|       2 |     109 |     117 | NULL    | NULL    | NULL    |
	|       2 |     109 |     118 | NULL    | NULL    | NULL    |
	|       2 |     109 |    1724 | NULL    | NULL    | NULL    |
	|       2 |     413 |       8 | NULL    | NULL    | NULL    |
	|       2 |     413 |     414 | NULL    | NULL    | NULL    |
	|       2 |     413 |     416 |     545 |     894 | NULL    |
	|       2 |     413 |     416 |     545 |     895 | NULL    |
	|       2 |     413 |     416 |     545 |     896 | NULL    |
	|       2 |     413 |     416 |     545 |     897 | NULL    |
	|       . |     ... |     ... |     ... |     ... | ....    |
	*/

	public function get_cat_name($cat_id,$lang_id)
	{
		$qry_str = 
		'SELECT
		category_lang.id_category,
		category_lang.`name`,
		category_lang.`shortName`,
		category_lang.`localizedId`
		FROM
		categories
		INNER JOIN category_lang ON category_lang.id_category = categories.id
		WHERE
		categories.id = "'.$cat_id.'" AND
		category_lang.id_lang = '.$lang_id.'';
		
		$q = $this->db->query($qry_str);
		return $q->result();
		
	}
	
	public function get_cat_options($cat_id,$lang_id)
	{
		$qry_str = 
		'SELECT
		category_lang.id_category,
		category_lang.`name`,
		category_lang.shortName,
		category_lang.localizedId,
		categories.active,
		categories.service_fee,
		categories.shipping_factor,
		categories.promotion_code,
		categories.discount_money,
		categories.discount_percentage
		FROM
			categories
			INNER JOIN category_lang ON category_lang.id_category = categories.id
		WHERE
			categories.id = '.$cat_id.' AND
			category_lang.id_lang = '.$lang_id;
		
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	public function get_subcat($idd,$lang_id)
	{
		$qry_str = '   SELECT
				categories.id,
				categories.active,
				categories.idd,
				categories.has_color_filter,
				categories.has_heel_height_filter,
				categories.has_size_filter,
				category_lang.`name`,
				category_lang.description,
				category_lang.meta_title,
				category_lang.meta_keywords,
				category_lang.meta_description
				FROM
				categories
				INNER JOIN category_lang ON category_lang.id_category = categories.id
				WHERE
				categories.parent_idd = "'.$idd.'" AND
				category_lang.id_lang = '.$lang_id;
				
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	
	public function get_categories(){
		$qry_str = " SELECT * from categories ";
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	public function get_parent_category($id,$lang_id){
		if(empty($id)) $id = 1;
		$qry_str = 'SELECT
					category_lang.`name`,
					category_lang.`shortName`,
					category_lang.`localizedId`,
					category_lang.id_category
					FROM
					category_lang
					WHERE
					category_lang.id_category = 
					(
					SELECT
					categories.parent_id
					FROM
					categories
					WHERE
					categories.id = '.$id.'
					)
					AND
					category_lang.id_lang = '.$lang_id;
				
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	public function get_first_subcat_children($id,$lang_id)
	{
		//$this->db->cache_on();
		$qry_str = 'SELECT
					main.id AS main_id,
					#level1.id AS level1_id,
					catlang_main.`name` AS `name`
					#catlang_level1.`name` AS child_name
					FROM
					categories AS main
					#LEFT  JOIN categories AS level1 ON level1.parent_id = main.id
					LEFT JOIN category_lang AS catlang_main ON catlang_main.id_category = main.id
					#LEFT JOIN category_lang AS catlang_level1 ON catlang_level1.id_category = level1.id
					WHERE
					main.parent_id = '.$id.'
					AND
					main.active = 1 
					AND
					catlang_main.id_lang = '.$lang_id.'
					#AND
					#catlang_level1.id_lang = '.$lang_id.'
					ORDER BY
					name ASC
					#level1_id ASC
					';
		$q = $this->db->query($qry_str);
	/*	if((int)$id == 109)
				{
					//debug women shoes category
					$oo = 55;
				}*/
		return $q->result();
	}
	
	public function get_first_subcat_children_all($id,$lang_id)
	{
		//$this->db->cache_on();
		$qry_str = 'SELECT
					main.id AS main_id,
					#level1.id AS level1_id,
					catlang_main.`name` AS `name`
					#catlang_level1.`name` AS child_name
					FROM
					categories AS main
					#LEFT  JOIN categories AS level1 ON level1.parent_id = main.id
					LEFT JOIN category_lang AS catlang_main ON catlang_main.id_category = main.id
					#LEFT JOIN category_lang AS catlang_level1 ON catlang_level1.id_category = level1.id
					WHERE
					main.parent_id = '.$id.'
					AND
					catlang_main.id_lang = '.$lang_id.'
					#AND
					#catlang_level1.id_lang = '.$lang_id.'
					ORDER BY
					name ASC
					#level1_id ASC
					';
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	public function get_first_subcat_children_all_only_active($id,$lang_id)
	{
		//$this->db->cache_on();
		$qry_str = 'SELECT
					main.id AS main_id,
					#level1.id AS level1_id,
					catlang_main.`name` AS `name`
					#catlang_level1.`name` AS child_name
					FROM
					categories AS main
					#LEFT  JOIN categories AS level1 ON level1.parent_id = main.id
					LEFT JOIN category_lang AS catlang_main ON catlang_main.id_category = main.id
					#LEFT JOIN category_lang AS catlang_level1 ON catlang_level1.id_category = level1.id
					WHERE
					main.parent_id = '.$id.' AND
					catlang_main.id_lang = '.$lang_id.' AND
					main.active = 1
					ORDER BY
					name ASC
					';
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	// fetch children categorie ids (depth = 5 subcategories)
	public function get_all_children_id($id)
	{
		//$this->db->cache_on();
		$qry_str = ' SELECT
		main.id AS main_id,
		#main.idd AS main_idd,
		level1.id AS level1_id,
		#level1.idd AS level1_idd,
		level2.id AS level2_id,
		level3.id AS level3_id,
		level4.id AS level4_id
		FROM
		categories AS main
		LEFT OUTER JOIN categories AS level1 ON level1.parent_id = main.id
		LEFT OUTER JOIN categories AS level2 ON level2.parent_id = level1.id
		LEFT OUTER JOIN categories AS level3 ON level3.parent_id = level2.id
		LEFT OUTER JOIN categories AS level4 ON level4.parent_id = level3.id
		WHERE
			main.parent_id = '.$id.' AND
			main.active = 1
		ORDER BY
			main_id,
			level1_id,
			level2_id,
			level3_id,
			level4_id ';
			
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	public function get_cat_id($idd)
	{
		$qry_str = ' SELECT id from categories where idd = "'.$idd.'" ';
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	///after new menu august 20/08 
	
	public function get_subcategories($id,$lang_id)
	{
		//$this->db->cache_on();
		$qry_str='SELECT
					category_lang.`name`,
					categories.has_size_filter,
					categories.has_heel_height_filter,
					categories.has_color_filter
					FROM
					categories
					INNER JOIN category_lang ON category_lang.id_category = categories.id
					WHERE
					categories.parent_id = '.$id.' AND
					category_lang.id_lang = '.$lang_id;
		$q = $this->db->query($qry_str);
		return $q->result();
			
	}
	
	public function get_product_category($id)
	{
		$qry_str = '
		SELECT
		categories_products.category_id_fk AS category_id
		FROM
		categories_products
		WHERE
		categories_products.product_id_fk  = '.$id.'
		';
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	public function get_avlbl_colors_in_cat($subcat_range_id,$q_str)
	{
		if(empty($q_str)) $q_str ='%';
		
		$qry_str = '
		SELECT
		colors.swatchUrl,
		cannonicalcolors.idd AS id,
		cannonicalcolors.`name` AS cannonical_name
		FROM
		categories
		INNER JOIN categories_products ON categories_products.category_id_fk = categories.id
		INNER JOIN products ON categories_products.product_id_fk = products.id
		INNER JOIN colors ON colors.product_id_fk = products.id
		INNER JOIN cannonicalcolors ON cannonicalcolors.color_id_fk = colors.id
		WHERE
		categories.id in ('.$subcat_range_id.')
		AND products.brandedName LIKE "%'.$q_str.'%"
		GROUP BY
		cannonicalcolors.`name`
		';
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	public function get_avlbl_brands_in_cat($subcat_range_id,$q_str)
	{
		if(empty($q_str)) $q_str ='%';
		
		$qry_str = '
		SELECT
		brands.`name`,
		brands.id AS brand_id,
		brands_logos_sizes.mobile AS brand_logo_mob
		FROM
		categories
		INNER JOIN categories_products ON categories_products.category_id_fk = categories.id
		INNER JOIN products ON categories_products.product_id_fk = products.id
		INNER JOIN brands_products ON brands_products.product_id_fk = products.id
		INNER JOIN brands ON brands_products.brand_id_fk = brands.id
		LEFT JOIN brands_logos ON brands_logos.brand_id_fk = brands.id
		LEFT JOIN brands_logos_sizes ON brands_logos_sizes.brand_logo_id_fk = brands_logos.id
		WHERE
		categories.id in ('.$subcat_range_id.')
		AND products.brandedName LIKE "%'.$q_str.'%"
		GROUP BY
		brands.id
		';
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	
	public function get_avlbl_sizes_in_cat($subcat_range_id,$q_str)
	{
		if(empty($q_str)) $q_str ='%';
		
		$qry_str = 'SELECT
					cannonicalsizes.`name`,
					cannonicalsizes.idd as id
					FROM
					categories
					INNER JOIN categories_products ON categories_products.category_id_fk = categories.id
					INNER JOIN products ON categories_products.product_id_fk = products.id
					INNER JOIN sizes ON sizes.product_id_fk = products.id
					INNER JOIN cannonicalsizes ON cannonicalsizes.size_id_fk = sizes.id
					WHERE
					categories.id in ('.$subcat_range_id.')
					AND products.brandedName LIKE "%'.$q_str.'%"
					GROUP BY
					cannonicalsizes.`name`';
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	public function get_avlbl_categories_for_srch($q_str,$lang_id)
	{
		$qry_str = '
					SELECT
					categories.id AS cat_id,
					category_lang.`name` AS cat_name,
					Count(categories.id) AS num_of_items_in_cat
					FROM
					categories
					INNER JOIN categories_products ON categories_products.category_id_fk = categories.id
					INNER JOIN products ON categories_products.product_id_fk = products.id
					INNER JOIN category_lang ON category_lang.id_category = categories.id
					WHERE
					products.brandedName LIKE "%'.$q_str.'%"
					AND
					category_lang.id_lang = '.$lang_id.'
					GROUP BY
					category_lang.`name`';
					
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	//welcome 2016
	
	public function get_localized_id($cat_id,$lang_id)
	{
		$qry_str = 
			'
			SELECT
			category_lang.localizedId
			FROM
			categories
			INNER JOIN category_lang ON category_lang.id_category = categories.id
			WHERE
			categories.id = '.$cat_id.' AND
			category_lang.id_lang = '.$lang_id.'
			';
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	public function set_category_tree_status($subcat_ids_csv,$status)
	{
		$qry_str = 
			'
			UPDATE categories SET active = '.$status.' 
			WHERE
			categories.id in ('.$subcat_ids_csv.')
			';
		$q = $this->db->query($qry_str);
		return $q;
	}
	
	public function set_category_tree_service_fee($subcat_ids_csv,$status)
	{
		$qry_str = 
			'
			UPDATE categories SET service_fee = '.$status.' 
			WHERE
			categories.id in ('.$subcat_ids_csv.')
			';
		$q = $this->db->query($qry_str);
		return $q;
	}
	
	public function set_category_tree_shipping_factor($subcat_ids_csv,$shipping_factor)
	{
		$qry_str = 
			'
			UPDATE categories SET shipping_factor = '.$shipping_factor.' 
			WHERE
			categories.id in ('.$subcat_ids_csv.')
			';
		$q = $this->db->query($qry_str);
		return $q;
	}
	
	public function set_category_tree_promotion_code($subcat_ids_csv,$promotion_code)
	{
		if(empty($promotion_code))
		{
			$qry_str = 	'UPDATE categories SET promotion_code = NULL WHERE	categories.id in ('.$subcat_ids_csv.')';
		}
		else
		{
			$qry_str = 	'UPDATE categories SET promotion_code = "'.$promotion_code.'" 	WHERE	categories.id in ('.$subcat_ids_csv.')';
		} 
		$q = $this->db->query($qry_str);
		return $q;
	}
	
	public function set_category_tree_discount_money($subcat_ids_csv,$discount_money)
	{
		$qry_str = 
		'UPDATE categories SET discount_money = '.$discount_money.', discount_percentage = NULL WHERE categories.id in ('.$subcat_ids_csv.');';
		$q = $this->db->query($qry_str);
		return $q;
	}
	
	public function set_category_tree_discount_percentage($subcat_ids_csv,$discount_percentage)
	{
		$qry_str = 
		'UPDATE categories SET discount_percentage = '.$discount_percentage.', discount_money = NULL WHERE categories.id in ('.$subcat_ids_csv.');';
		$q = $this->db->query($qry_str);
		return $q;
	}
	
	public function get_categories_for_menu($lang_id)
	{
		$qry_str = 
		'SELECT
		categories.parent_id,
		categories.id,
		category_lang.`name`,
		category_lang.description,
		category_lang.meta_description,
		category_lang.meta_keywords,
		category_lang.meta_title
		FROM
		categories
		LEFT JOIN category_lang ON category_lang.id_category = categories.id
		WHERE
		category_lang.id_lang = '.$lang_id.' AND
		categories.active = 1
		ORDER BY
		categories.parent_id ASC,
		category_lang.`name` ASC
		';
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	public function get_category_options($cat_id)
	{
		$qry_str = 
		'SELECT
		categories.active,
		categories.service_fee,
		categories.shipping_factor,
		categories.promotion_code,
		categories.discount_money,
		categories.discount_percentage,
		categories.idd
		FROM `categories`
		WHERE
		categories.id = '.$cat_id;
		
		$q = $this->db->query($qry_str);
		return $q->result();
		
	}
	
	
	
	
	

}
?>