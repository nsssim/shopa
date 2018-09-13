<?php
class brands_mdl extends CI_Model
{
       
        public function get_all_brands()
        {
	        $qry_str = "SELECT * from brands";
	        $q = $this->db->query($qry_str);
	        return $q->result();            
        }
        
        public function get_cat_brands($cat_id_range,$first_letter)
        {
	        $qry_str = 'SELECT DISTINCT
			brands.`name`,
			brands.id,
			brands.idd,
			brands_logos_sizes.featured,
			brands_logos_sizes.`default@2x`,
			brands_logos_sizes.`default`,
			brands_logos_sizes.`mobile@2x`,
			brands_logos_sizes.`featured@2x`,
			brands_logos_sizes.mobile
			FROM
			products
			LEFT JOIN brands_products ON brands_products.product_id_fk = products.id
			LEFT JOIN brands ON brands_products.brand_id_fk = brands.id
			LEFT JOIN categories_products ON categories_products.product_id_fk = products.id
			LEFT JOIN categories ON categories_products.category_id_fk = categories.id
			INNER JOIN brands_logos ON brands_logos.brand_id_fk = brands.id
			INNER JOIN brands_logos_sizes ON brands_logos_sizes.brand_logo_id_fk = brands_logos.id
			WHERE
			brands.name LIKE "'.$first_letter.'%" AND
			categories.id in '.$cat_id_range.'
			ORDER BY
			brands.`name` ASC';
	        $q = $this->db->query($qry_str);
	        return $q->result();            
        }
        
        public function get_brands_ids_starting_by($letter,$cat_range_id)
        {
			if ($letter == "#")
			{
				$qry_str = '
				SELECT
					brands.id AS brand_id
					#brands.`name`
				FROM
				brands
					INNER JOIN brands_products ON brands_products.brand_id_fk = brands.id
					INNER JOIN products ON brands_products.product_id_fk = products.id
					INNER JOIN categories_products ON categories_products.product_id_fk = products.id
					INNER JOIN categories ON categories_products.category_id_fk = categories.id
				WHERE
				brands.`name` NOT REGEXP "^[[:alpha:]]" 
				AND categories.id in('.$cat_range_id.') 
				GROUP BY
					brands.`name`
				ORDER BY 
					brands.`name`
				';
			}
			else
			{
				$qry_str = '
				SELECT
					brands.id AS brand_id
					#brands.`name`
				FROM
					brands
					INNER JOIN brands_products ON brands_products.brand_id_fk = brands.id
					INNER JOIN products ON brands_products.product_id_fk = products.id
					INNER JOIN categories_products ON categories_products.product_id_fk = products.id
					INNER JOIN categories ON categories_products.category_id_fk = categories.id
				WHERE
					brands.`name` LIKE "'.$letter.'%" 
				AND
					categories.id in('.$cat_range_id.') 
				GROUP BY
					brands.`name`
				ORDER BY 
					brands.`name`
				';
			}
		    
			$q = $this->db->query($qry_str);
		    return $q->result();     
		}
		
		public function get_brand_name($brand_id)
		{
			$qry_str='
			SELECT
			brands.`name`
			FROM
			brands
			WHERE
			brands.id = '.$brand_id.'
			';
			
			$q = $this->db->query($qry_str);
		    return $q->result(); 
		}
		
		public function get_cat_icon($cat_id)
		{
			$qry_str='SELECT categories.icon FROM `categories` WHERE categories.id = '.$cat_id;
			$q = $this->db->query($qry_str);
		    return $q->result(); 
		}
		
        
}


?>


