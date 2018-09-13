<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lng extends MX_Controller 
{
 
 //function to be called via ajax
 public function change_language($lang_id)
 {
 	$this->session->set_userdata('language_id', $lang_id); 
 	$this->input->set_cookie("language_id", $lang_id, 86400*30*12*10); // set the cookie for 10 years
	echo "ok"; 	
 }

/**
* this function search for the language in the session if not in a cookie if not
* set it to the default language (2 is the id for english language) and set it to the session and a cookie
* 
* @return language_id int  the language id 
*/

 public function get_n_set_language_id()
 {
 	//get lang_id from session
 	$lang_id = $this->session->userdata("language_id");
	//if no lang_idon session get it from cookies
	if (empty($lang_id))	$lang_id= $this->input->cookie("language_id");
	// if no lang_id on cookie then ...set it to default language (2 is the id for english language)
	// and save it to session and in a cookie
	if (empty($lang_id))
	    { 
	   		// 2 is the id for english language
	   		$lang_id = 2;
			// set / update language in session and cookie
			$this->input->set_cookie("language_id", 2, 86400*30*12*10); // set the cookie for 10 years
			$this->session->set_userdata("language_id",2);
		}
	//echo $lang_id;
	return $lang_id;
 }
 
 /**
 * will set the language id in the session and in a cookie , if no argument is sent, English id (id = 2) will be set by default  this function is called via ajax and returns a string (see return type)
 * 
 * @param int $lang_id
 * 
 * @return string language name
 */
 public function set_language_id($lang_id=2)
 {
	$flag_session = $this->session->set_userdata("language_id",$lang_id);
	$flag_cookie = $this->input->set_cookie("language_id", $lang_id, 86400*30*12*10); // set the cookie for 10 years
	
	$language_details = $this->get_language_details($lang_id);
	$language_name = ucfirst($language_details[0]->name) ;
	
	echo($language_name);
	//return $language_name;
 }
 
 public function get_avlbl_languages()
 {
 	$this->load->model("language_mdl");
 	$languages = $this->language_mdl->get_languages();
 	return $languages ;
 }
 
 
 

 public function get_language_details($lang_id)
 {
 	$this->load->model("language_mdl");
 	$language_details = $this->language_mdl->get_language_details($lang_id);
 	return $language_details ;
 }
 
 
}

/* End of file language.php */
/* Location: ./application/controllers/modules/language.php */