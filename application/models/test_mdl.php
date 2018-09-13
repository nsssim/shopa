<?php
class test_mdl extends CI_Model
{
       
        public function get_product_alt_images($id)
        {
        $qry_str = "SELECT
				products.id,
				products.`name`,
				images_sizes_medium.url AS image,
				images_sizes_medium_alt.url AS alt_image
				FROM
				products
				INNER JOIN images ON images.product_id_fk = products.id
				INNER JOIN images_sizes ON images_sizes.image_id_fk = images.id
				INNER JOIN products_images_alt ON products_images_alt.product_id_fk = products.id
				INNER JOIN images_alt ON products_images_alt.image_alt_id_fk = images_alt.id
				INNER JOIN images_sizes_alt ON images_sizes_alt.image_alt_id_fk = images_alt.id
				INNER JOIN images_sizes_medium_alt ON images_sizes_medium_alt.image_size_alt_id_fk = images_sizes_alt.id
				INNER JOIN images_sizes_medium ON images_sizes_medium.image_size_id_fk = images_sizes.id
				WHERE
				products.id = ".$id;
        $q = $this->db->query($qry_str);
        return $q->result();            
        }

}


?>


