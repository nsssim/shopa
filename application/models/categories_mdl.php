<?php
class categories_mdl extends CI_Model
{
        public function get_subcategories($main_category)
        {
        	$qry_subcategories = '
			SELECT
				main.id AS main_id,
				main.idd AS main_idd,
				level1.id AS level1_id,
				level1.idd AS level1_idd,
				level2.id AS level2_id,
				level2.idd AS level2_idd,
				level3.id AS level3_id,
				level3.idd AS level3_idd
			FROM
				categories AS main
			LEFT OUTER JOIN categories AS level1 ON level1.parent_idd = main.idd
			LEFT OUTER JOIN categories AS level2 ON level2.parent_idd = level1.idd
			LEFT OUTER JOIN categories AS level3 ON level3.parent_idd = level2.idd
			WHERE
				main.parent_idd = "'.$main_category.'"
			ORDER BY
				main_id,
				level1_id,
				level2_id,
				level3_id 
				';
        	$q = $this->db->query($qry_subcategories);
        	return $q->result();            
        }

}


?>


