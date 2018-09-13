<?php
class product_mdl extends CI_Model
{
       
        public function get_product_alt_images($id)
        {
        	$qry_str_alt_img = "
        	SELECT
			products.id,
			products.`name`,
			images_sizes_medium_alt.url AS alt_image_medium,
			images_sizes_medium_alt.width AS alt_image_medium_width,
			images_sizes_medium_alt.height AS alt_image_medium_height,
			images_sizes_medium_alt.actualWidth AS alt_image_medium_actualwidth,
			images_sizes_medium_alt.actualHeight AS alt_image_medium_actualheight,
			images_sizes_original_alt.url AS alt_image_original,
			images_sizes_original_alt.actualWidth AS alt_image_original_actualheight,
			images_sizes_original_alt.actualHeight AS alt_image_original_actualheight,
			images_sizes_best_alt.url AS alt_image_best,
			images_sizes_best_alt.width AS alt_image_best_width,
			images_sizes_best_alt.height AS alt_image_best_height,
			images_sizes_best_alt.actualWidth AS alt_image_best_actualwidth,
			images_sizes_best_alt.actualHeight AS alt_image_best_actualheight
			FROM
			products
			INNER JOIN products_images_alt ON products_images_alt.product_id_fk = products.id
			INNER JOIN images_alt ON products_images_alt.image_alt_id_fk = images_alt.id
			INNER JOIN images_sizes_alt ON images_sizes_alt.image_alt_id_fk = images_alt.id
			INNER JOIN images_sizes_medium_alt ON images_sizes_medium_alt.image_size_alt_id_fk = images_sizes_alt.id
			INNER JOIN images_sizes_original_alt ON images_sizes_original_alt.image_size_alt_id_fk = images_sizes_alt.id
			INNER JOIN images_sizes_best_alt ON images_sizes_best_alt.image_size_alt_id_fk = images_sizes_alt.id
			INNER JOIN images_sizes_xl_alt ON images_sizes_xl_alt.image_size_alt_id_fk = images_sizes_alt.id
			WHERE
			products.id =".$id;
        	
        	
        	
        	//old query to delete later 
        	$qry_str_alt_img0 = "
        	SELECT
				products.id,
				products.`name`,
				images_sizes_best.url AS image,
				images_sizes_medium_alt.url AS alt_image
			FROM
				products
				INNER JOIN images ON images.product_id_fk = products.id
				INNER JOIN images_sizes ON images_sizes.image_id_fk = images.id
				INNER JOIN products_images_alt ON products_images_alt.product_id_fk = products.id
				INNER JOIN images_alt ON products_images_alt.image_alt_id_fk = images_alt.id
				INNER JOIN images_sizes_alt ON images_sizes_alt.image_alt_id_fk = images_alt.id
				INNER JOIN images_sizes_medium_alt ON images_sizes_medium_alt.image_size_alt_id_fk = images_sizes_alt.id
				INNER JOIN images_sizes_best ON images_sizes_best.image_size_id_fk = images_sizes.id
			WHERE
				products.id = ".$id;
 
        	$q = $this->db->query($qry_str_alt_img);
        	return $q->result();            
        }
        
        public function get_product_details($id,$lng)
        {
			$qry_product_details_str = "
			SELECT
				products.id,
				products.idd,
				products.priceLabel,
				products.price,
				products.salePriceLabel,
				products.salePrice,
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
		
		 public function get_product_sizes($id)
        {
			$qry_product_sizes_str = "
			SELECT
			sizes.`name` AS size_name,
			cannonicalsizes.`name` AS cannonical_size_name
			FROM
			products
			INNER JOIN sizes ON sizes.product_id_fk = products.id
			INNER JOIN cannonicalsizes ON cannonicalsizes.size_id_fk = sizes.id
			WHERE
			products.id =".$id;

			$qry_product_sizes = $this->db->query($qry_product_sizes_str);
        	return $qry_product_sizes->result();  
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
		
		public function get_product_colors_images_original_size($id)
		{
			$qry_product_colors_images_original_str= '
			SELECT
			images.id AS image_id,
			images.idd AS image_idd,
			images.product_id_fk AS product_id,
			images.color_id_fk AS image_color_id,
			colors.`name` AS color_name,
			colors.swatchUrl AS swatch,
			images_sizes_original.url AS image_url,
			cannonicalcolors.`name` AS canonical_name,
			images_sizes_original.actualWidth AS image_width,
			images_sizes_original.actualHeight AS image_height,
			colors.id AS color_id,
			cannonicalcolors.id AS cannonical_color_id
			FROM
				images
				INNER JOIN products ON images.product_id_fk = products.id
				INNER JOIN colors ON colors.product_id_fk = products.id AND images.color_id_fk = colors.id
				INNER JOIN images_sizes ON images_sizes.image_id_fk = images.id
				INNER JOIN images_sizes_original ON images_sizes_original.image_size_id_fk = images_sizes.id
				INNER JOIN cannonicalcolors ON cannonicalcolors.color_id_fk = colors.id
			WHERE
				products.id ='.$id;
			$qry_product_colors_images_original = $this->db->query($qry_product_colors_images_original_str);
        	return $qry_product_colors_images_original->result();
		}
		
		public function get_product_images($id)
		{
			$qry_product_images_str= '
			SELECT
			products.id,
			images_sizes_best.url AS image,
			images_sizes_best.width AS width,
			images_sizes_best.height AS height,
			images_sizes_best.actualWidth AS actualWidth,
			images_sizes_best.actualHeight AS actualHeight,
			images_sizes_iphone_small.url AS small_image,
			images_sizes_iphone_small.width AS small_width,
			images_sizes_iphone_small.height AS small_height,
			images_sizes_iphone_small.actualWidth AS small_actualWidth,
			images_sizes_iphone_small.actualHeight AS small_actualHeight
			FROM
			products
			INNER JOIN images ON images.product_id_fk = products.id
			INNER JOIN images_sizes ON images_sizes.image_id_fk = images.id
			INNER JOIN images_sizes_best ON images_sizes_best.image_size_id_fk = images_sizes.id
			INNER JOIN images_sizes_iphone_small ON images_sizes_iphone_small.image_size_id_fk = images_sizes.id
			WHERE
			products.id = '.$id;
			
			$qry_product_images = $this->db->query($qry_product_images_str);
        	return $qry_product_images->result();
		}
		
		public function get_product_brand($id)
		{
			$qry_product_brand_str = 
			'
			SELECT
			brands.`name` AS brand_name,
			brands_logos_sizes.`default` AS brand_logo_default,
			brands_logos_sizes.mobile AS brand_logo_mobile
			FROM
			products
			LEFT JOIN brands_products ON brands_products.product_id_fk = products.id
			LEFT JOIN brands ON brands_products.brand_id_fk = brands.id
			LEFT JOIN brands_logos ON brands_logos.brand_id_fk = brands.id
			LEFT JOIN brands_logos_sizes ON brands_logos_sizes.brand_logo_id_fk = brands_logos.id
			WHERE
			products.id = '.$id;
			
			$qry_product_brands = $this->db->query($qry_product_brand_str);
        	return $qry_product_brands->result();	
		}
		
		// for autocomplete
		public function search_product($term)
		{
			$qry_search_product_str = '
			SELECT
			products.brandedName,
			products.id
			FROM
			products
			WHERE
			products.brandedName LIKE "%'.$term.'%"
			LIMIT 0, 5';
			
			$qry_search_product = $this->db->query($qry_search_product_str);
			
			if($qry_search_product->num_rows > 0)
			{
		      foreach ($qry_search_product->result_array() as $row)
		      {
		        $new_row['label']=htmlentities(stripslashes($row['brandedName']));
		        $new_row['label']=str_replace('&amp;', '&', $new_row['label']); // Replaces all &amp with & .
		        
        		$new_row['id']=htmlentities(stripslashes($row['id']));
        		$row_set[] = $new_row; //build an array
		        
		        //$row_set[] = htmlentities(stripslashes($row['brandedName'])); //build an array
		      }
		      echo json_encode($row_set); //format the array into json data
		    }
		  
        	//return $qry_search_product->result_array();
		}
		
		public function get_product_id($branded_name){
			$qry_str= 'SELECT
						products.id as product_id
						FROM `products`
						WHERE
						products.brandedName LIKE "'.$branded_name.'"';
						
			$qry = $this->db->query($qry_str);
			return $qry->result();
			
		}
		
		
		public function get_product_count($term){
			$qry_str= 'SELECT
						Count(products.id) as occurrence
						FROM `products`
						WHERE
						products.brandedName LIKE "%'.$term.'%"
						';
						$qry = $this->db->query($qry_str);
						$row =  $qry->first_row();
						return $row->occurrence;
						
		}
		
		
		public function get_product_count_per_price($term,$min_price,$max_price)
		{
			if($max_price == 0) 
			{
						$qry_str = 'SELECT
						Count(products.id) as occurrence
						FROM `products`
						WHERE
						products.brandedName LIKE "%'.$term.'%"
						AND
						products.price > '.$min_price.'
						';	
			}
			else
			{
						$qry_str = 'SELECT
						Count(products.id) as occurrence
						FROM `products`
						WHERE
						products.brandedName LIKE "%'.$term.'%"
						AND
						products.price > '.$min_price.'
						AND
						products.price < '.$max_price.'
						';
			}
			
			$qry = $this->db->query($qry_str);
			$row =  $qry->first_row();
			return $row->occurrence;
						
		}
		
		public function get_product($term,$sub_cat_id_list,$per_page,$offset){
			/*$qry_str= 'SELECT
						products.id as product_id
						FROM `products` 
						WHERE
						products.brandedName LIKE "%'.$term.'%" LIMIT '.$per_page.' OFFSET '.$offset;*/
			
			$qry_str = '
					SELECT
						products.id AS product_id
					FROM
						products
					INNER JOIN categories_products ON categories_products.product_id_fk = products.id
					WHERE
						products.brandedName LIKE "%'.$term.'%"
					AND categories_products.category_id_fk IN ('.$sub_cat_id_list.')
					LIMIT '.$per_page.' OFFSET '.$offset;

			$qry = $this->db->query($qry_str);
			return $qry->result();
			
		}
		
		
		public function get_product_price_filter($term,$min_price,$max_price,$item_num,$offset){
			if($max_price == 0) {
			$qry_str = 'SELECT
						products.id as product_id
						FROM `products` 
						WHERE
						products.brandedName LIKE "%'.$term.'%"
						AND
						products.price > '.$min_price.'
						LIMIT '.$item_num.' OFFSET '.$offset.'
						';
			}
			else{
				$qry_str= 'SELECT
						products.id as product_id
						FROM `products` 
						WHERE
						products.brandedName LIKE "%'.$term.'%"
						AND
						products.price > '.$min_price.'
						AND
						products.price < '.$max_price.'
						LIMIT '.$item_num.' OFFSET '.$offset.'
						';
			}
						
			$qry = $this->db->query($qry_str);
			return $qry->result();
		}
		
		//fet all products under a certain categoty
		public function get_cat_products($cat_id)
		{
			$qry_str=  'SELECT
						products.id,
						product_lang.`name`,
						products.brandedName,
						#products.description,
						products.price,
						products.salePrice,
						images_sizes_iphone.url
						FROM
						products
						INNER JOIN categories_products ON categories_products.product_id_fk = products.id
						INNER JOIN categories ON categories_products.category_id_fk = categories.id
						INNER JOIN product_lang ON product_lang.id_product = products.id
						INNER JOIN images ON images.product_id_fk = products.id
						INNER JOIN images_sizes ON images_sizes.image_id_fk = images.id
						INNER JOIN images_sizes_iphone ON images_sizes_iphone.image_size_id_fk = images_sizes.id
						WHERE
						categories.id = '.$cat_id;
						
			$qry = $this->db->query($qry_str);
			return $qry->result();
		}
		
		
		public function get_category_decendents_products($id_range,$lang_id)
		{
			$qry_str =
				'SELECT
				products.id,
				product_lang.`name`,
				images_sizes_iphone.url AS image,
				products.price,
				products.salePrice,
				main.id,
				images_sizes_iphone.width,
				images_sizes_iphone.height,
				images_sizes_iphone.actualWidth,
				images_sizes_iphone.actualHeight,
				images_sizes_original.url AS image_original_url,
				images_sizes_original.actualWidth AS image_original_actualWidth,
				images_sizes_original.actualHeight AS image_original_actualHeight,
				images_sizes_original_alt.url AS alt_image_url,
				images_sizes_original_alt.actualWidth AS alt_image_actualWidth,
				images_sizes_original_alt.actualHeight AS alt_image_actualHeight,
				colors.swatchUrl,
				cannonicalcolors.`name` AS color_name,
				product_lang.description,
				product_lang.description_short
				FROM
				categories AS main
				INNER JOIN categories_products ON categories_products.category_id_fk = main.id
				INNER JOIN products ON categories_products.product_id_fk = products.id
				INNER JOIN product_lang ON product_lang.id_product = products.id
				INNER JOIN images ON images.product_id_fk = products.id
				INNER JOIN images_sizes ON images_sizes.image_id_fk = images.id
				INNER JOIN images_sizes_iphone ON images_sizes_iphone.image_size_id_fk = images_sizes.id
				INNER JOIN images_sizes_original ON images_sizes_original.image_size_id_fk = images_sizes.id
				INNER JOIN products_images_alt ON products_images_alt.product_id_fk = products.id
				INNER JOIN images_alt ON products_images_alt.image_alt_id_fk = images_alt.id
				INNER JOIN images_sizes_alt ON images_sizes_alt.image_alt_id_fk = images_alt.id
				INNER JOIN images_sizes_original_alt ON images_sizes_original_alt.image_size_alt_id_fk = images_sizes_alt.id
				INNER JOIN colors ON colors.product_id_fk = products.id AND images.color_id_fk = colors.id
				INNER JOIN cannonicalcolors ON cannonicalcolors.color_id_fk = colors.id
				WHERE
				main.active = 1
				AND main.id IN '.$id_range.'
				AND product_lang.id_lang = '.$lang_id.'
				ORDER BY products.id
			';
			$qry = $this->db->query($qry_str);
			return $qry->result();
		}
		
		public function get_number_of_products_in_category_range($id_range)
		{
			$qry_str = 'SELECT
					Count(categories_products.product_id_fk) AS num_of_items
					FROM
					categories
					INNER JOIN categories_products ON categories_products.category_id_fk = categories.id
					WHERE
					categories.id IN '.$id_range.' 
					';
			$qry = $this->db->query($qry_str);
			return $qry->result();
			
		}
		
		public function get_category_decendents_products0000($id_range,$lang_id,$offset,$num_of_items)
		{
			$qry_str = '
						SELECT
						products.id,
						product_lang.`name`,
						product_lang.brandedName,
						product_lang.unbrandedName,
						product_lang.description,
						products.price,
						products.salePrice
						FROM
						categories
						INNER JOIN categories_products ON categories_products.category_id_fk = categories.id
						INNER JOIN products ON categories_products.product_id_fk = products.id
						INNER JOIN product_lang ON product_lang.id_product = products.id
						WHERE
						categories.id IN '.$id_range.' AND
						product_lang.id_lang = '.$lang_id.'
						LIMIT '.$offset.', '.$num_of_items.'
						';
			$qry = $this->db->query($qry_str);
			return $qry->result();
		}
		
		public function get_category_decendents_products_sale($id_range,$lang_id)
		{
			$qry_str =
				'SELECT
				products.id,
				product_lang.`name`,
				images_sizes_iphone.url AS image,
				products.price,
				products.salePrice,
				main.id,
				images_sizes_iphone.width,
				images_sizes_iphone.height,
				images_sizes_iphone.actualWidth,
				images_sizes_iphone.actualHeight,
				images_sizes_original.url AS image_original_url,
				images_sizes_original.actualWidth AS image_original_actualWidth,
				images_sizes_original.actualHeight AS image_original_actualHeight,
				images_sizes_original_alt.url AS alt_image_url,
				images_sizes_original_alt.actualWidth AS alt_image_actualWidth,
				images_sizes_original_alt.actualHeight AS alt_image_actualHeight,
				colors.swatchUrl,
				cannonicalcolors.`name` AS color_name,
				product_lang.description,
				product_lang.description_short
				FROM
				categories AS main
				INNER JOIN categories_products ON categories_products.category_id_fk = main.id
				INNER JOIN products ON categories_products.product_id_fk = products.id
				INNER JOIN product_lang ON product_lang.id_product = products.id
				INNER JOIN images ON images.product_id_fk = products.id
				INNER JOIN images_sizes ON images_sizes.image_id_fk = images.id
				INNER JOIN images_sizes_iphone ON images_sizes_iphone.image_size_id_fk = images_sizes.id
				INNER JOIN images_sizes_original ON images_sizes_original.image_size_id_fk = images_sizes.id
				INNER JOIN products_images_alt ON products_images_alt.product_id_fk = products.id
				INNER JOIN images_alt ON products_images_alt.image_alt_id_fk = images_alt.id
				INNER JOIN images_sizes_alt ON images_sizes_alt.image_alt_id_fk = images_alt.id
				INNER JOIN images_sizes_original_alt ON images_sizes_original_alt.image_size_alt_id_fk = images_sizes_alt.id
				INNER JOIN colors ON colors.product_id_fk = products.id AND images.color_id_fk = colors.id
				INNER JOIN cannonicalcolors ON cannonicalcolors.color_id_fk = colors.id
				WHERE
				main.active = 1
				AND main.id IN '.$id_range.'
				AND product_lang.id_lang = '.$lang_id.'
				AND	products.salePrice IS NOT NULL
			';
			$qry = $this->db->query($qry_str);
			return $qry->result();
		}
		
		public function get_related_products($id)
		{
			// todo
			return TRUE;
		}
		

		

}


?>


