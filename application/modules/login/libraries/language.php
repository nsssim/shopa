<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language 
 {
 	
 	public  $DEFAULT_LNG_ID = 2; // change this to the ID of your favorite language in the language table in the database
 	
    function __construct() 
    {
     	 
   	}
    
    /**
	* this function is a technique to make php accept polymorphism / overloading a function with multiple parameters
	* it will get the argument of the function and return the language id
	* 
	* description here 
	* 
	* @param $arguments 1 is Turkish.
	* @param $arguments 2 is english.
	* @param $arguments 3 is russian.
	* @param $arguments 4 is french.
	*  
	* 
	* @return  int $Lng_id int
	*/
    public function get_lang_id($arguments)
    {
			foreach ($arguments as $argmnt) 
			{
				switch ($argmnt) 
				{
					case "tr" : {$Lng_id = 1; break;} 
					case "en" : {$Lng_id = 2; break;}
					case "ru" : {$Lng_id = 3; break;}
					case "fr" : {$Lng_id = 4; break;}
					
					default   : {$Lng_id = $this->DEFAULT_LNG_ID; break;} 
				}
			}
		return $Lng_id;
    }
    
    public function set_user_language($arguments)
    {
    	// we must use the function get_instance() to access all the  of code igniter 
    	// i called it to use session
    	// @see http://stackoverflow.com/questions/4740430/explain-ci-get-instance
    	$CI =& get_instance();
    	
    	$user_name = $CI->session->userdata('usrname');
		switch ($user_name) 
		{
			case "" : //the user is a guest visiting for the 1st time 
			{
				
				$CI->session->set_userdata('usrname', 'guest');
				/* if the guest did not change the language 
				   set the language session to the default language ( DEFAULT_LNG_ID is defined inside the Language class)  */
				if(empty($arguments))
				{
					$CI->session->set_userdata('language_id', $this->DEFAULT_LNG_ID); 
				}
				// if the guest changes the language for this session
				else
				{
					// return the language ID of the string passed to switch_language()	
					$lang_id = $this->get_lang_id($arguments);
					$CI->session->set_userdata('language_id', $lang_id);
				}
		
			 break;
			 } 
			case "guest" : // the user is a coming back visitor
			{
				echo "welcome back visitor "."<br/>";
				/* if the guest did not change the language 
				   set the language session to the default language ( DEFAULT_LNG_ID is defined inside the Language class)  */
				if(empty($arguments))
				{
					$CI->session->set_userdata('language_id', $this->DEFAULT_LNG_ID); 
				}
				// if the guest changes the language for this session
				else
				{
					// return the language ID of the string passed to switch_language()	
					$lang_id = $this->get_lang_id($arguments);
					$CI->session->set_userdata('language_id', $lang_id);
				}
			break;
			}
		
			default   : // the user is a customer
		   {
				/* if the customer did not change the language 
				   get the language from his record and update the session */
				if(empty($arguments))
				{
					$user_id = $CI->session->userdata("user_id");
					
					$CI->load->model("user_mdl");
					$user_lang_id = $CI->user_mdl->get_user_lang_info($user_id);
					if(isset($user_lang_id[0]->lang_id))
						{
						$CI->session->set_userdata('language_id', $user_lang_id[0]->lang_id);
						}  
					else 
						{
						// if there is no langauge in the database (in the user table) set it to the default language //see consturtor above 
						$CI->session->set_userdata('language_id', $this->DEFAULT_LNG_ID);
						}
				}
				// if the customer changes the language for this session
				else
				{
					// return the language ID of the string passed to switch_language()	
					$lang_id = $this->get_lang_id($arguments);
					$CI->session->set_userdata('language_id', $lang_id); 
				}
			break;
			} 
		}

	}
    
}

/* End of file Language.php */