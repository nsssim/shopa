<?php
class categories_mdl extends CI_Model
{
       
    public function get_cat_tree($cat_id)
    {
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
		categories.`id`,
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
	
	public function get_first_subcat_children($id,$lang_id)
	{
		$qry_str = 'SELECT
main.id AS main_id,
#level1.id AS level1_id,
catlang_main.`name` AS `name`
#catlang_level1.`name` AS child_name
FROM
                    categories AS main
#                    LEFT  JOIN categories AS level1 ON level1.parent_id = main.id
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
                    main_id ASC
#                    level1_id ASC
					 ';
		$q = $this->db->query($qry_str);
		return $q->result();
	}
	
	// fetch children categorie ids (depth = 5 subcategories)
	public function get_all_children_id($id)
	{
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

}
?>


