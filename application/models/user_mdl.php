<?php
class user_mdl extends CI_Model
{

		 public function get_user_lang_info($user_id)
		 {
		 	$qry_cust_lang = 'SELECT
			customers.language_id_fk,
			languages.`name`,
			languages.iso_code,
			languages.id as lang_id
			FROM
			customers
			INNER JOIN languages ON customers.language_id_fk = languages.id
			WHERE
			customers.id  = '.$user_id.'
			';
			 $client_language_info = $this->db->query($qry_cust_lang);
		 	return $client_language_info->result();
		 }

}

?>


