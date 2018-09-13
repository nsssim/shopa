<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* session manager controller
*/

class sessman extends MX_Controller 
{
 
 function __construct()
    {
        parent::__construct();
        
        $this->load->model('sessman_mdl'); 
	 
    }
 
	/**
	* gets the session fingerprint from database 
	* 
	* @param string $session_id
	* 
	* @return string string  the active_session_fingerprint
	*/ 
	 
	
	public function clean_up_session_table()
	{
		$session_id = $this->session->userdata('session_id');
		if(!empty($session_id))
		{
			$active_session_fingerprint = $this->sessman_mdl->get_active_session_fingerprint($session_id);
			if (!empty($active_session_fingerprint)) $this->sessman_mdl->clean_up_session_table($session_id,$active_session_fingerprint);
		}
		
		//delete empty sessions 
		$this->sessman_mdl->delete_empty_sessions();
	}

 
 
 

	
    
}

/* End of file sessman.php */
/* Location: ./application/modules/sessman/controllers/sessman.php */