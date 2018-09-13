<?php
class session_mdl extends CI_Model
{

		 public function clean($session_id,$user_agent,$ip_address)
		 {
		 	$qry_clean_session = '
		 	DELETE  
			FROM
			ci_sessions
			WHERE
			ci_sessions.session_id <> "'.$session_id.'" AND
			ci_sessions.ip_address = "'.$ip_address.'" AND
			ci_sessions.user_agent = "'.$user_agent.'"
			';
			$clean_session_result = $this->db->query($qry_clean_session);
		 	return $clean_session_result;
		 }

}

?>


