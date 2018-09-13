<?php
class emaily_mdl extends CI_Model
{
    public function get_order_details($order_id)
	{
		$qry_str = '
		SELECT
		orders.id AS order_id,
		orders.date_add,
		orders.date_upd,
		delivery_address.id AS delivery_address_id,
		delivery_address.line_1 AS delivery_address_line_1,
		delivery_address.line_2 AS delivery_address_line_2,
		delivery_address.line_3 AS delivery_address_line_3,
		delivery_address.city AS delivery_address_city,
		delivery_address.country_province AS delivery_address_country_province,
		delivery_address.zip_code AS delivery_address_zip_code,
		delivery_address.coutry AS delivery_address_coutry,
		delivery_address.other_details AS delivery_address_other_details,
		delivery_address.is_deleted AS delivery_address_is_deleted,
		delivery_address.is_active AS delivery_address_is_active,
		delivery_address.adding_date AS delivery_address_adding_date,
		delivery_address.deactivation_date AS delivery_address_deactivation_date,
		delivery_address.date_upd AS delivery_address_date_upd,
		invoice_address.id AS invoice_address_id,
		invoice_address.line_1 AS invoice_address_line_1,
		invoice_address.line_2 AS invoice_address_line_2,
		invoice_address.line_3 AS invoice_address_line_3,
		invoice_address.city AS invoice_address_city,
		invoice_address.country_province AS invoice_address_country_province,
		invoice_address.zip_code AS invoice_address_zip_code,
		invoice_address.coutry AS invoice_address_coutry,
		invoice_address.other_details AS invoice_address_other_details,
		invoice_address.is_deleted AS invoice_address_is_deleted,
		invoice_address.is_active AS invoice_address_is_active,
		invoice_address.adding_date AS invoice_address_adding_date,
		invoice_address.deactivation_date AS invoice_address_deactivation_date,
		invoice_address.date_upd AS invoice_address_date_upd,
		customers.id AS customer_id,
		customers.email AS customer_email,
		customers.first_name AS customer_first_name,
		customers.last_name AS customer_last_name,
		customers.phone AS customer_phone,
		customers.alt_phone AS customer_alt_phone,
		customers.username AS customer_username,
		customers.`password` AS customer_password,
		customers.last_passwors_gen AS customer_last_passwors_gen,
		customers.birthdate AS customer_birthdate,
		customers.newsletter AS customer_newsletter,
		customers.newsletter_date_add AS customer_newsletter_date_add,
		customers.deleted AS customer_deleted,
		customers.date_add AS customer_date_add,
		customers.date_upd AS customer_date_upd,
		customers.note AS customer_note,
		customers.max_payment_days AS customer_max_payment_days,
		customers.gender_id_fk AS customer_gender_id_fk,
		customers.language_id_fk AS customer_language_id_fk,
		customers.status_id_fk AS customer_status_id_fk,
		customers.is_admin AS customer_is_admin,
		customers.permission_id_fk AS customer_permission_id_fk,
		orders_detail.id AS order_detail_id,
		orders_detail.order_id_fk,
		orders_detail.order_invoice_id_fk,
		orders_detail.shop_id_fk,
		orders_detail.product_id_fk,
		orders_detail.product_name,
		orders_detail.product_quantity,
		orders_detail.product_quantity_in_stock,
		orders_detail.product_quantity_refunded,
		orders_detail.product_quantity_return,
		orders_detail.product_quantity_reinjected,
		orders_detail.product_price,
		orders_detail.reduction_percent,
		orders_detail.reduction_amount,
		orders_detail.reduction_amount_tax_incl,
		orders_detail.reduction_amount_tax_excl,
		orders_detail.group_reduction,
		orders_detail.product_quantity_discount,
		orders_detail.product_ean13,
		orders_detail.product_upc,
		orders_detail.product_reference,
		orders_detail.product_supplier_reference,
		orders_detail.product_weight,
		orders_detail.tax_computation_method,
		orders_detail.tax_name,
		orders_detail.tax_rate,
		orders_detail.ecotax,
		orders_detail.ecotax_tax_rate,
		orders_detail.discount_quantity_applied,
		orders_detail.download_hash,
		orders_detail.download_nb,
		orders_detail.download_deadline,
		orders_detail.total_price_tax_incl,
		orders_detail.total_price_tax_excl,
		orders_detail.unit_price_tax_incl,
		orders_detail.unit_price_tax_excl,
		orders_detail.total_shipping_price_tax_incl,
		orders_detail.total_shipping_price_tax_excl,
		orders_detail.purchase_supplier_price,
		orders_detail.original_product_price,
		orders_detail.custom_fees,
		orders_detail.total_price,
		orders_detail.shipping_fee,
		orders_detail.service_fee,
		orders_detail.grand_total,
		orders_detail.sale_tax,
		orders_detail.credit_card_expanses,
		orders_detail.number_of_items,
		orders_detail.cart_content,
		orders_detail.is_taken,
		orders_detail.is_customer_charged,
		orders_detail.is_placed,
		orders_detail.is_arrived_to_warehouse,
		orders_detail.is_packed,
		orders_detail.is_shipped,
		orders_detail.is_customs_cleared,
		orders_detail.is_arrived_to_office,
		orders_detail.is_relabled,
		orders_detail.is_delivered,
		orders_detail.tracking_num,
		orders_detail.is_arrived_to_warehouse_last_time_changed,
		orders_detail.is_shipped_last_time_changed,
		orders_detail.is_delivered_last_time_changed,
		orders_detail.is_arrived_to_warehouse_email_sent_flag,
		orders_detail.is_shipped_email_sent_flag,
		orders_detail.is_delivered_email_sent_flag,
		orders_detail.shipping_factor_money_value,
		orders_detail.start_up_shipping_value,
		orders_detail.customs_rate,
		orders_detail.order_sub_total,
		orders_detail.shipping_fee_total,
		orders_detail.total_custom_fee,
		orders_detail.total_tax,
		orders_detail.total_credit_card_fee,
		orders_detail.v_order_sub_total,
		orders_detail.v_shipping_and_handling_fee,
		orders_detail.v_discount_total,
		orders_detail.v_subtotal,
		orders_detail.v_optional_custom_fees,
		orders_detail.v_grand_total
		FROM
		orders
		LEFT JOIN addresses AS delivery_address ON orders.address_delivery_id_fk = delivery_address.id
		LEFT JOIN addresses AS invoice_address ON orders.address_invoice_id_fk = invoice_address.id
		LEFT JOIN customers ON orders.customer_id_fk = customers.id
		LEFT JOIN orders_detail ON orders_detail.order_id_fk = orders.id
		WHERE
		orders.id = '.$order_id;
		
		$q = $this->db->query($qry_str);
    	return $q->result();
	}
	
	public function get_tr_city_county_name($county_id,$city_id)
	{
		$qry_str = 'SELECT
		cities_tr.id,
		cities_tr.`name` AS city_name,
		counties_tr.id,
		counties_tr.city_id ,
		counties_tr.`name` AS county_name
		FROM
		cities_tr
		INNER JOIN counties_tr ON counties_tr.city_id = cities_tr.id
		WHERE
		cities_tr.id = '.$city_id.' AND
		counties_tr.id = '.$county_id;
		$q = $this->db->query($qry_str);
    	return $q->result();
	}
	
	public function get_user_details($user_id)
	{
		$qry_str = "SELECT * FROM customers WHERE customers.id = ".$user_id;
		$q = $this->db->query($qry_str);
    	return $q->result();
	}
	
	public function get_address($email)
	{
		$qry_str = 'SELECT * FROM emails WHERE emails.email = "'.$email.'"';
		$q = $this->db->query($qry_str);
    	return $q->result();
	}
	
	public function add_email($email)
	{
		$qry_str = 'INSERT INTO emails SET `email` = "'.$email.'" , `date_add` = NOW(); ';

		$q = $this->db->query($qry_str);
    	return $q;
	}
	
}
?>