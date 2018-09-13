<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

 function __construct()
    {
        parent::__construct();
		$this->load->model('home_mdl'); // needed for the template info (template path)
    }

	public function index()
	{
		$A['template_info'] = $this->home_mdl->get_template_info();// get the template for the active shop 
		
		// prepare the metadata information for the view page
		$A['meta_description'] =   "login";
		$A['meta_keywords']    =   "login";
		$A['page_title'] 	   =   "login";
		 
        $this->load->view($A['template_info']['path'].'/login_vew',$A);  // send the result from the model to the view */

	}
	
	public function user()
	{
		$this->load->model("login_mdl"); // needed to get the user information

		
		// if the name is not empty
		if ($this->input->post("name"))
			{
				$user_name  = $this->input->post("name");
				//prepare array $K[] to be stored into a cookie
				$K["user_name"] 	   =   $user_name;
		    }
		// else (the name is empty) go back to login_view
		else     						    
			{ 	
				$this->load->helper('url');
				redirect(base_url()."login");
	    	}
		
		// if the email is not empty
		if ($this->input->post("email"))
			{   
				$user_email = $this->input->post("email");
				//prepare array $K[] to be stored into a cookie
				$K["user_email"] 	   =   $user_email;
			} 
		// else (email is empty) 
		else					
			{
			   $this->load->helper('url');
			   redirect(base_url()."login");
			}
	
		
		//get user infromation from database
		$customer_info = $this->login_mdl->get_user_info($user_name,$user_email);
		
		//prepare array $K[] to be stored into a cookie
		if ($customer_info)
		{
			$K["customer_id"] 	   =   $customer_info[0]->id;
		}
		
		
		
		//----------------------------------------------------------------
		$this->input->set_cookie('user_info', json_encode($K), 86400*30*12*20); // set the cookie for 10 years
		// check if name and email exist in database
		
		if ($customer_info)
		{
			//take him to the password screen
			$A['template_info'] = $this->home_mdl->get_template_info();// get the template for the active shop 
			
			echo("you will be redirected to the password verification page soon ....");
			
			// prepare the metadata information for the view page
			$A['meta_description'] =   "login";
			$A['meta_keywords']    =   "login";
			$A['page_title'] 	   =   "login";
			$A['customer_id'] 	   =   $customer_info[0]->id;
			
			$this->load->view($A['template_info']['path'].'/password_vew',$A);  // send the result from the model to the view
		}
		else
		{
			//take him back to the login screen
			$A['template_info'] = $this->home_mdl->get_template_info();// get the template for the active shop 
			
			$A["try_again"] = 1;
			// prepare the metadata information for the view page
			$A['meta_description'] =   "login";
			$A['meta_keywords']    =   "login";
			$A['page_title'] 	   =   "login";
			
			$this->load->view($A['template_info']['path'].'/login_vew',$A);  // send the result from the model to the view
			
		}

	}
	
	public function psw()
	{
		// get info from template
		$A['template_info'] = $this->home_mdl->get_template_info();// get the template for the active shop 
			
		// prepare the metadata information for the view page
		$A['meta_description'] =   "login";
		$A['meta_keywords']    =   "login";
		$A['page_title'] 	   =   "login";
			
		//echo "------------------------";
		//echo $this->input->cookie('user_info');
		
		$user_id = $this->input->post("user_id");
		
		$this->load->model("login_mdl");
		// fetch the customer password from the database
		$customer_db_info = $this->login_mdl->get_user_info($user_id);
		// get the password from the form
		if($this->input->post("password"))
				$password = $this->input->post("password");
		else
				$password = "error";
		//encrypting the password for comparing with the database 
		$password_51 = md5(sha1($password));
		//echo("password_51:".$password_51."<br/>");
		
		// compare the passwords
		if (isset( $customer_db_info[0]->password) )
		 {
		 	$db_password = $customer_db_info[0]->password ; 
		 }
		   else
		 {
		 	$db_password = "error2";
		 }
		
		if($password_51 == $db_password )
		{
			echo("password matching.....updating session ");
		
		// set user_id to the session
			if (isset( $customer_db_info[0]->id) )
		 {
		 	$user_id = $customer_db_info[0]->id ; 
		 }
			$this->session->set_userdata('user_id', $user_id);
		
		// set the user_name to the session
			if (isset( $customer_db_info[0]->first_name) )
		 {
		 	$user_f_name = $customer_db_info[0]->first_name ; 
		 }
			$this->session->set_userdata('usrname', $user_f_name);
			
			?>
			<img src="http://png-4.findicons.com/files/icons/1726/jini_icon_theme/192/button_ok.png" />
			<?php
			$this->load->helper('url');
			redirect(base_url());
		}
		else // wrong password
		{
			$A["wrong_password"] = 1;
			$this->load->view($A['template_info']['path'].'/password_vew',$A);
		} 
		
	}
	
	// logout
	public function logout()
	{
		
		//get the template info from the session
		$template_info = $this->session->userdata('template_info');
		//change the username to guest in the session
		$this->session->set_userdata('usrname', "guest");
		// remove the user_id from the session 
		$this->session->unset_userdata('user_id');
		
		$this->session->sess_destroy();
		
		$this->load->helper('url');
		redirect(base_url());
	}
	
	public function newusr()
	{
		
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */