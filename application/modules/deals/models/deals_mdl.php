<?php
class deals_mdl extends CI_Model
{
       
        public function get_product_deal($id)
        {
        $qry_str = "SELECT
					promotional_deal.id,
					promotional_deal.idd,
					promotional_deal.type,
					promotional_deal.typeLabel,
					promotional_deal.title,
					promotional_deal.shortTitle,
					promotional_deal.checkoutCode,
					promo_start_date.date AS start_date,
					promo_start_date.`timestamp` AS timestamp_start,
					promo_end_date.date AS end_date,
					promo_end_date.`timestamp` AS timestamp_end
					FROM
					promo_start_date
					INNER JOIN promotional_deal ON promo_start_date.promotional_deal_id_fk = promotional_deal.id
					INNER JOIN promo_end_date ON promo_end_date.promotional_deal_id_fk = promotional_deal.id
					WHERE
					promotional_deal.product_id_fk = ".$id;
        $q = $this->db->query($qry_str);
        return $q->result();            
        }
        
        public function get_cart_promotion_deal($deal_name,$cart_total_trigger,$today_date)
        {
        $qry_str = '
        SELECT
		promotions.id,
		promotions.reduction_rate,
		promotions.description,
		promotions.`name`
		FROM `promotions`
		WHERE
		promotions.`name` = "'.$deal_name.'" AND
		promotions.cart_total_trigger <= '.$cart_total_trigger.' AND
		#date must be in y-m-d format
		promotions.date_from <= "'.$today_date.'" AND
		#date must be in y-m-d format
		promotions.date_to >= "'.$today_date.'"
        ';
        $q = $this->db->query($qry_str);
        return $q->result();            
        }
        
}


?>


