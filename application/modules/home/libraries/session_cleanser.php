<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class session_cleanser
 {
 	
 
 	
    function __construct() 
    {
     	 
   	}
   	//Note: The Session class has built-in garbage collection which clears out expired sessions so you do not need to write your own routine to do it.
    // but i still prefer my home-made garbage collection 
    public function clean_session()
    {
			$CI =& get_instance();
			//get the id of the active session 
			$session_id = $CI->session->userdata('session_id'); 
			$user_agent = $CI->session->userdata('user_agent');
			$ip_address = $CI->session->userdata('ip_address');
			
			$CI->load->model("session_mdl");
			$is_clean = $CI->session_mdl->clean($session_id,$user_agent,$ip_address);
			
			// $is_clean is a boolean and will be = 1 if cleaning went alright
			return	$is_clean;		
    }
    

    
}

/* End of file Language.php */