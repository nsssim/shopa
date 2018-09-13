<?php
class filter_mdl extends CI_Model
{
    public function find_product_by_price($lang_id,$product_name_like,$min_price,$max_price,$price_sorting,$offset,$num_of_items)
		{
			
			$oo = 55 ;
			
			if($product_name_like) $match_string_subquery = 'product_lang.`name` LIKE "%'.$product_name_like.'%"';
			else $match_string_subquery = '';
			
			if($min_price) $min_price_subquery = '(GREATEST((ISNULL(salePrice > 0)*price), COALESCE(salePrice,0)  ) >= '.$min_price.')';
			else $min_price_subquery = '(GREATEST((ISNULL(salePrice > 0)*price), COALESCE(salePrice,0)  ) > 0)';
			
			if($max_price) $max_price_subquery = '(GREATEST((ISNULL(salePrice > 0)*price), COALESCE(salePrice,0)  ) <= '.$max_price.')';
			else $max_price_subquery = '';
			
			if($price_sorting)	$sorting_subquery = 'ORDER BY GREATEST((ISNULL(salePrice > 0)*price), COALESCE(salePrice,0)  ) '.$price_sorting;
			else $sorting_subquery ='';
			
			if (($offset >=0) and $num_of_items ) $limit_subquery = 'LIMIT '.$offset.', '.$num_of_items;
			else $limit_subquery ='';
			
			$qry_str = '
			SELECT
			products.id
			#GREATEST((ISNULL(salePrice > 0)*price), COALESCE(salePrice,0)  ) AS bestprice
			FROM
			products
			INNER JOIN product_lang ON product_lang.id_product = products.id
			WHERE
			'.$min_price_subquery.' AND
			'.$max_price_subquery.' AND
			'.$match_string_subquery.' AND
			product_lang.id_lang = '.$lang_id.'
			'.$sorting_subquery.'
			'.$limit_subquery.'
			';
			$qry = $this->db->query($qry_str);
			return $qry->result();

		}
		
		public function find_product_by_categoy($product_input_ids,$category_range_id)
		{
			$qry_str = '
			SELECT
			products.id
			FROM
			products
			INNER JOIN categories_products ON categories_products.product_id_fk = products.id
			WHERE
			products.id in ('.$product_input_ids.') AND
			categories_products.category_id_fk in '.$category_range_id.'
			';
			$qry = $this->db->query($qry_str);
			return $qry->result();
		}
		
		public function find_product_by_brand($product_input_ids,$brand_range_id)
		{
			$qry_str = '
			SELECT
			products.id
			FROM
			products
			INNER JOIN brands_products ON brands_products.product_id_fk = products.id
			WHERE
			products.id in ('.$product_input_ids.') AND
			brands_products.brand_id_fk in ('.$brand_range_id.')
			';
			$qry = $this->db->query($qry_str);
			return $qry->result();
		}
		
		
		public function find_product_by_size($product_input_ids,$size_range_idd)
		{
			$qry_str = '
			SELECT
			sizes.product_id_fk AS id
			FROM
			cannonicalsizes
			INNER JOIN sizes ON cannonicalsizes.size_id_fk = sizes.id
			WHERE
			sizes.product_id_fk IN ('.$product_input_ids.') AND
			cannonicalsizes.idd IN ('.$size_range_idd.')
			';
			$qry = $this->db->query($qry_str);
			return $qry->result();
		}
		
		
		public function find_product_by_color($product_input_ids,$color_range_id)
		{
			$qry_str = '
			SELECT
			colors.product_id_fk AS id
			FROM
			colors
			INNER JOIN cannonicalcolors ON cannonicalcolors.color_id_fk = colors.id
			WHERE
			colors.product_id_fk IN ('.$product_input_ids.') AND
			cannonicalcolors.idd IN ('.$color_range_id.')

			';
			$qry = $this->db->query($qry_str);
			return $qry->result();
		}
		
		
		public function find_product_by_sale($product_input_ids)
		{
			$qry_str = '
			SELECT
			products.id,
			products.salePrice
			FROM `products`
			WHERE
			products.id IN ('.$product_input_ids.') AND
			products.salePrice IS NOT NULL
			';
			$qry = $this->db->query($qry_str);
			return $qry->result();
		}
		
		public function find_product($product_input_ids,$lang_id)
		{
			$qry_str = '
			SELECT
			products.id,
			products.inStock,
			products.price,
			products.salePrice,
			product_lang.`name`,
			product_lang.brandedName,
			product_lang.unbrandedName,
			product_lang.description
			FROM
			products
			INNER JOIN product_lang ON product_lang.id_product = products.id
			WHERE
			products.id in ('.$product_input_ids.') AND
			product_lang.id_lang = '.$lang_id.'
			';
			$qry = $this->db->query($qry_str);
			return $qry->result();
		}
		
		public function get_product_by_filters($cat_id_range,$lang_id,$offset,$num_of_items,$min_price,$max_price,$brand_id,$size_id,$color_id,$price_order,$on_sale)
		{
			// place for the cache here 
			//$this->db->cache_on();
			
			// prepare the brand qry filter
			if (!empty($brand_id)) $brand_id_qry = 'AND brands_products.brand_id_fk = '.$brand_id;
			else        		   $brand_id_qry = '';
			
			// prepare the size qry filter
			if (!empty($size_id)) $size_id_qry = 'AND cannonicalsizes.idd = '.$size_id;
			else        		  $size_id_qry = '';
			
			
			// prepare the color qry filter
			if (!empty($color_id)) $color_id_qry = 'AND cannonicalcolors.idd = '.$color_id;
			else        		   $color_id_qry = '';
			
			// prepare the sale qry filter
			if ($on_sale == "TRUE")
			{
				$sale_qry = 'AND	products.salePrice IS NOT NULL ';
			}
			else 
			{
			    $sale_qry = '';
			}
			
			// prepare the price qry sorting
			if (!empty($price_order))
			{
				if($price_order == "up") $price_qry = 'ORDER BY products.price DESC';	
				elseif($price_order == "down") $price_qry = 'ORDER BY products.price ASC';	
				else $price_qry = '';	
			} 
			
			$qry_str =
						'
						SELECT 
						products.id
						FROM
						categories
						INNER JOIN categories_products ON categories_products.category_id_fk = categories.id
						INNER JOIN products ON categories_products.product_id_fk = products.id
						INNER JOIN product_lang ON product_lang.id_product = products.id
						LEFT JOIN brands_products ON brands_products.product_id_fk = products.id
						LEFT JOIN sizes ON sizes.product_id_fk = products.id
						LEFT JOIN colors ON colors.product_id_fk = products.id
						LEFT JOIN cannonicalcolors ON cannonicalcolors.color_id_fk = colors.id
						#canonical size
						LEFT JOIN cannonicalsizes ON cannonicalsizes.size_id_fk = sizes.id
						WHERE
						categories.id IN '.$cat_id_range.' AND
						product_lang.id_lang = '.$lang_id.' 
						#price filter
							AND (products.price >= '.$min_price.' OR products.salePrice >= '.$min_price.') 
							AND (products.price <= '.$max_price.' OR products.salePrice <= '.$max_price.')
						#brand filter
						'.$brand_id_qry.' #AND brands_products.brand_id_fk = 5 
						#size filter
						'.$size_id_qry.'  #AND cannonicalsizes.idd = 4545 
						#color filter
						'.$color_id_qry.' #AND colors.id = 25914
						#sale filter
						'.$sale_qry.'	  #AND products.salePrice IS NOT NULL
						#price filter
						'.$price_qry.'    #ORDER BY products.price ASC
						LIMIT '.$offset.', '.$num_of_items.'
						';
			$qry = $this->db->query($qry_str);
			return $qry->result();

		}
      

	//////////// hybrid method //////////////////////
	
	public function get_count_filtred_products($term,$cat_id_range,$lang_id,$min_price,
											$max_price,$brand_id_range,$size_id_range,$color_id_range,$on_sale)
		{
		
			if($term != "any") $term_filter = 'products.brandedName LIKE "%'.$term.'%" AND';
			else $term_filter ='';
			
			if($cat_id_range) $category_filter = 'categories.id IN ('.$cat_id_range.')';
			else $category_filter = '';
			
			if($min_price >= 0)  $min_price_filter = 'AND GREATEST((ISNULL(products.salePrice > 0)*products.price), COALESCE(products.salePrice,0)  ) >= '.$min_price;
			else $min_price_filter =  'AND GREATEST((ISNULL(products.salePrice > 0)*products.price), COALESCE(products.salePrice,0)  ) >= 0';
			
			if($max_price > 0) $max_price_filter = 'AND GREATEST((ISNULL(products.salePrice > 0)*products.price), COALESCE(products.salePrice,0)  ) <= '.$max_price;
			else $max_price_filter = '';
			
			if($brand_id_range) $brand_filter = 'AND brands_products.brand_id_fk in ('.$brand_id_range.') ';
			else $brand_filter = '';
			
			if($size_id_range) $size_filter = 'AND cannonicalsizes.idd in ('.$size_id_range.')';
			else $size_filter ='';
			
			if($color_id_range) $color_filter = ' AND cannonicalcolors.idd IN ('.$color_id_range.')';
			else $color_filter = '';
			
			if($on_sale != "FALSE") $sale_filter ='AND products.salePrice IS NOT NULL';
			else $sale_filter = '';
			if(!$on_sale) $sale_filter = '';
			
			
			$qry_str = '
			SELECT DISTINCT
						products.id,
						product_lang.`name`,
						product_lang.brandedName,
						product_lang.unbrandedName,
						product_lang.description,
						products.inStock,
						products.price,
						products.salePrice
						FROM
						categories
						INNER JOIN categories_products ON categories_products.category_id_fk = categories.id
						INNER JOIN products ON categories_products.product_id_fk = products.id
						INNER JOIN product_lang ON product_lang.id_product = products.id
						LEFT JOIN brands_products ON brands_products.product_id_fk = products.id
						LEFT JOIN sizes ON sizes.product_id_fk = products.id
						LEFT JOIN colors ON colors.product_id_fk = products.id
						LEFT JOIN cannonicalcolors ON cannonicalcolors.color_id_fk = colors.id
						LEFT JOIN cannonicalsizes ON cannonicalsizes.size_id_fk = sizes.id
						WHERE
						
						product_lang.id_lang = '.$lang_id.' AND
						products.inStock = 1 AND
					    
					    #search term
					    	'.$term_filter.'
						
						#category filter
							'.$category_filter.'
						
						#price filter
							'.$min_price_filter.'
							'.$max_price_filter.'
						
						#brand filter
						 	'.$brand_filter.' 
						
						#size filter
						  	'.$size_filter.' 
						
						#color filter
						 	'.$color_filter.'
						
						#sale filter
						 	'.$sale_filter.'
						';
			
		/*	echo "<pre>";
			echo $qry_str;
			echo "</pre>";*/
			
			$qry_count = $this->db->query($qry_str);
			return $qry_count->num_rows();
		}
	
	
	
	
	
	public function get_filtred_product_id_range($term,$cat_id_range,$lang_id,$offset,$per_page,$min_price,
											$max_price,$brand_id_range,$size_id_range,$color_id_range,$price_order_str,$on_sale)
		{
		
			if($term != "any") $term_filter = 'products.brandedName LIKE "%'.$term.'%" AND';
			else $term_filter ='';
			
			if($cat_id_range) $category_filter = 'categories.id IN ('.$cat_id_range.')';
			else $category_filter = '';
			
			if($min_price >= 0)  $min_price_filter = 'AND GREATEST((ISNULL(products.salePrice > 0)*products.price), COALESCE(products.salePrice,0)  ) >= '.$min_price;
			else $min_price_filter =  'AND GREATEST((ISNULL(products.salePrice > 0)*products.price), COALESCE(products.salePrice,0)  ) >= 0';
			
			if($max_price > 0) $max_price_filter = 'AND GREATEST((ISNULL(products.salePrice > 0)*products.price), COALESCE(products.salePrice,0)  ) <= '.$max_price;
			else $max_price_filter = '';
			
			if($brand_id_range) $brand_filter = 'AND brands_products.brand_id_fk in ('.$brand_id_range.') ';
			else $brand_filter = '';
			
			if($size_id_range) $size_filter = 'AND cannonicalsizes.idd in ('.$size_id_range.')';
			else $size_filter ='';
			
			if($color_id_range) $color_filter = ' AND cannonicalcolors.idd IN ('.$color_id_range.')';
			else $color_filter = '';
			
			if($on_sale != "FALSE") $sale_filter ='AND products.salePrice IS NOT NULL';
			else $sale_filter = '';
			if(!$on_sale) $sale_filter = '';
			
			if($price_order_str == "down")  $order_by_price = 'ORDER BY GREATEST((ISNULL(products.salePrice > 0)*products.price), COALESCE(products.salePrice,0)  ) ASC';
			elseif($price_order_str == "up")  $order_by_price = 'ORDER BY GREATEST((ISNULL(products.salePrice > 0)*products.price), COALESCE(products.salePrice,0)  ) DESC';
			else $order_by_price='';
			
			$qry_str = '
			SELECT DISTINCT
						products.id,
						product_lang.`name`,
						product_lang.brandedName,
						product_lang.unbrandedName,
						product_lang.description,
						products.inStock,
						products.price,
						products.salePrice
						FROM
						categories
						INNER JOIN categories_products ON categories_products.category_id_fk = categories.id
						INNER JOIN products ON categories_products.product_id_fk = products.id
						INNER JOIN product_lang ON product_lang.id_product = products.id
						LEFT JOIN brands_products ON brands_products.product_id_fk = products.id
						LEFT JOIN sizes ON sizes.product_id_fk = products.id
						LEFT JOIN colors ON colors.product_id_fk = products.id
						LEFT JOIN cannonicalcolors ON cannonicalcolors.color_id_fk = colors.id
						LEFT JOIN cannonicalsizes ON cannonicalsizes.size_id_fk = sizes.id
						WHERE
						
						product_lang.id_lang = '.$lang_id.' AND
						products.inStock = 1 AND
					    
					    #search term
					    	'.$term_filter.'
						
						#category filter
							'.$category_filter.'
						
						#price filter
							'.$min_price_filter.'
							'.$max_price_filter.'
						
						#brand filter
						 	'.$brand_filter.' 
						
						#size filter
						  	'.$size_filter.' 
						
						#color filter
						 	'.$color_filter.'
						
						#sale filter
						 	'.$sale_filter.'
						
						#price order
						    '.$order_by_price.'
						LIMIT '.$offset.', '.$per_page.'
			';
			
			/*echo "<pre>";
			echo $qry_str;
			echo "</pre>";*/
			
			$qry_filter = $this->db->query($qry_str);
			return $qry_filter->result();
		}
		
		public function get_filtred_product_list($product_id_range,$price_order_str)
		{
			if($price_order_str == "down")  $order_by_price = 'ORDER BY GREATEST((ISNULL(products.salePrice > 0)*products.price), COALESCE(products.salePrice,0)  ) ASC';
			elseif($price_order_str == "up")  $order_by_price = 'ORDER BY GREATEST((ISNULL(products.salePrice > 0)*products.price), COALESCE(products.salePrice,0)  ) DESC';
			else $order_by_price='';
			
			$qry_str = 'SELECT
						products.id,
						product_lang.`name`,
						product_lang.brandedName,
						product_lang.unbrandedName,
						product_lang.description,
						products.inStock,
						products.price,
						products.salePrice
						FROM
						products
						INNER JOIN product_lang ON product_lang.id_product = products.id
						WHERE products.id in 
						('.$product_id_range.')'.$order_by_price.'';
			
			$qry = $this->db->query($qry_str);
			
			return $qry->result();
		}

}


?>