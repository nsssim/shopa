<?php
class brands_mdl extends CI_Model
{
       
        public function get_all_brand_name()
        {
        	$qry_all_brand_names = '
        	SELECT DISTINCT
        	brands.id,
			brands.`name`
			FROM
			brands
			WHERE
			brands.`name` <> " "
			ORDER BY
			brands.`name` ASC
			';
        	$q = $this->db->query($qry_all_brand_names);
        	return $q->result();            
        }
        // to dooo
        
        public function get_product_details($id,$lng)
        {
			$qry_product_details_str = "
			SELECT
				products.idd,
				product_lang.`name`,
				product_lang.brandedName,
				product_lang.unbrandedName,
				product_lang.description,
				product_lang.description_short,
				product_lang.meta_description,
				product_lang.meta_keywords,
				product_lang.meta_title
			FROM
				products
				INNER JOIN product_lang ON product_lang.id_product = products.id
			WHERE
				products.id = ".$id." AND product_lang.id_lang = ". $lng   ;

			$qry_product_details = $this->db->query($qry_product_details_str);
        	return $qry_product_details->result();  
		}

		public function get_product_reviews($id)
		{
			$qry_product_reviews_str = 
			"
			SELECT
				reviews.datetime,
				customers.username,
				reviews_languages.review_title,
				reviews_languages.review_text,
				reviews.overall_stars,
				reviews.durability_stars,
				reviews.value_stars,
				reviews.usability_stars,
				reviews.features_stars,
				reviews.design_stars,
				reviews.num_likes_yes,
				reviews.num_likes_no
			FROM
				reviews
				INNER JOIN reviews_languages ON reviews_languages.review_id_fk = reviews.id
				INNER JOIN customers ON reviews.customer_id_fk = customers.id
				INNER JOIN customers_statuses ON customers.status_id_fk = customers_statuses.id
			WHERE
				reviews.product_id_fk = ".$id." AND
				reviews.`status` = 1 AND
				customers_statuses.id = 1
			ORDER BY
				reviews.overall_stars DESC
			"
		;
				// reviews.status : 1 = enabled; 0 = desabled; 2 = pending ; 3 = deleted
			   // customers_statuses.id : 1 = active 

			$qry_product_reviews = $this->db->query($qry_product_reviews_str);
        	return $qry_product_reviews->result();
		}
		
		public function get_related_products($id)
		{
			// todo
			return TRUE;
		}
		

		

}


?>


