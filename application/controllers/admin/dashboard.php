<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller 
{
	
	public function index()
	{
					
		//$this->load->library('language'); // call the custom class Language 
		//$args = func_get_args(); // get the argument from index() ... "tr", "en", "ru" ...etc
		//$this->language->set_user_language($args); 
		
		/*//$cart_flag = $this->session->userdata('cart');
		if(!( $this->session->userdata('cart')))
		{
			$cart = array(55, 1999,888);
			$this->session->set_userdata('cart', $cart);
		}*/
		
		// to do check if userdata languageid is set 
		//$lang_id = $this->session->userdata('language_id');
		
		// needed for cleanin the session 
		//$this->load->library('session_cleanser'); 
		// clean old non-active sessions in the database (I use my own garbage-collection)
		//$this->session_cleanser->clean_session();
		 
		//$this->load->library('categories'); // call the custom class categories 
		//$A['women_clothes_subcategories']  =$this->categories->get_categories("womens-clothes");
		
		//$this->load->model('home_mdl');
		//$A['meta_info']  =  $this->home_mdl->get_meta_info($lang_id);// get the meta info from database 
		//$A['template_info'] = $this->home_mdl->get_template_info();// get the template for the active shop   
		
		// save the template information in the Session for further use in other views
		//$this->session->set_userdata('template_info', $A['template_info']); 
		//$template_info = $this->session->userdata('template_info');
		
		//$A['featured_items'] = $this->home_mdl->get_combo("featured",2,1);// get the featured products for the main shop  2 is english and 1 is the id of the main shop  
		$A = "nothing";
        $this->load->view("templates/startbootstrap/index",$A);  // send the result from the model to the view
		
		//$this->load->view('index');
	}
	
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */