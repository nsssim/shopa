<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends MX_Controller {

 function __construct()
    {
        parent::__construct();
		$this->load->model('home_mdl'); // needed for the template info (template path)
		
		//$this->load->helper('cookie');
		$this->load->helper('url');
		
		//load the tamplate manager module
		$this->load->module('templateman');
		
		$this->load->module('msg');
		
		$this->load->module('seo');
    }

	public function index()
	{
		$ssl_port_num    = ":".SSL_PORT;  // :443 is the default
		$base_url_str    = base_url();
		$sbu             = str_replace("http","https",$base_url_str );
		$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
	
    	redirect( $secure_base_url."customer/my_account" ) ;
	}
	public function index0()
	{
		// load recaptcha library
        $this->load->library('recaptcha');
        // prepare recaptcha widget widget and script to be passed to the view
        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
        );
		
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details 
		$template_path_info = $data['template_info']['path'];  
		
		
		// prepare the metadata information for the view page
		$data['meta_description'] =   "login";
		$data['meta_keywords']    =   "login";
		$data['page_title'] 	   =   "login";
		
	
		$data['words'] = $this->msg->get_words("login");
		$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
		 
        $this->load->view($template_path_info.'/common/css',$data);  
	    $this->load->view($template_path_info.'/common/header',$header_data);  
	    //$this->load->view($data['template_info']['path'].'/common/slider');  
	    
        $this->load->view($template_path_info.'/login_vew',$data);
	    
	    $this->load->view($template_path_info.'/common/footer',$footer_data);  
	    $this->load->view($template_path_info.'/common/script'); 
       
       
       
       // $this->load->view($A['template_info']['path'].'/login_vew',$A);  // send the result from the model to the view */

	}
	
	//this is called from the checkout in case a customer did not log in already 
	public function userlogin()
	{
		// load recaptcha library
        $this->load->library('recaptcha');
        // prepare recaptcha widget widget and script to be passed to the view
        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
        );
        
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details 
		$template_path_info = $data['template_info']['path'];  
		
		
		// prepare the metadata information for the view page
		$data['meta_description'] =   "login";
		$data['meta_keywords']    =   "login";
		$data['page_title'] 	   =   "login";
		 
        //$data["error_msg"] = "this account already exists";
        $data["error_msg"] = $this->msg->get_translated_message(134); //"this account already exists";
        
       
        $this->load->view($template_path_info.'/common/css',$data);  
	    $this->load->view($template_path_info.'/common/header');  
	    //$this->load->view($data['template_info']['path'].'/common/slider');  
	    
        $this->load->view($template_path_info.'/login_vew',$data);
	    
	    $this->load->view($template_path_info.'/common/footer');  
	    $this->load->view($template_path_info.'/common/script'); 
       
       
       
       // $this->load->view($A['template_info']['path'].'/login_vew',$A);  // send the result from the model to the view */

	}
	
	
	
	public function user($admin=NULL)
	{
		$ssl_port_num = ":".SSL_PORT;  // :443 is the default
		$base_url_str = base_url(); 
		$sbu = str_replace("http","https",$base_url_str );
		$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
		
		
		$is_admin = FALSE;
		//if the request came from admin login view
		if(!empty($admin))
		{
			$is_admin = TRUE;
		}
		
		$remember_me = FALSE;
		// if the remember me checkbox was checked 
		if ($this->input->post("remember_me"))
		{
			$remember_me = TRUE;
		}
		
		//read cookies if exist 
		//$this->input->cookie('email', "empty" , 86400*30*12*2);
		
		//echo("hello");
		
		$this->load->model("login_mdl"); // needed to get the user information

		// if the name is not empty
		if ($this->input->post("email"))
			{
				$email  = $this->input->post("email");
				if($remember_me) $this->input->set_cookie('email', $email, 86400*30*12*2); 
		    }
		// else (the email is empty) go back to login_view
		else     						    
			{ 	
				//$this->input->set_cookie('empty_email', "1" , 86400*30*12*2);
				
				redirect($secure_base_url."customer/my_account?empty_email=1");
	    	}
		
		// if the password is not empty
		if ($this->input->post("password"))
			{   
				$password = $this->input->post("password");
			} 
		// else (password is empty) 
		else					
			{
			   //$this->input->set_cookie('empty_password', "1" , 86400*30*12*2);
			   redirect($secure_base_url."customer/my_account?empty_password=1");
			}
	
		
		// if the email and password  are not empty
		if  ($this->input->post("email") and $this->input->post("password"))
		{
			//clear unecessarucookies if any 
			$this->input->set_cookie('empty_password', NULL , 1);
			$this->input->set_cookie('empty_email'   , NULL , 1);
			
			
			//get user infromation from database  he must be active ! or we will get false result
			$customer_info = $this->login_mdl->get_user_info($email);
			
			if(!empty($customer_info))
			{
					
				//get user password fron db
				$db_password =  $customer_info[0]->password;
				//echo $db_password;
				//echo "<br>";
				
				//encrypt form password for comparing
				$input_password_crypted_md5_sha1 = md5(sha1($password));
				//echo "$input_password_crypted_md5_sha1";
				//echo "<br>";
				
				// compare db_password vs input password-----------------------------------------------------
				if($db_password == $input_password_crypted_md5_sha1)
				{
					//delete wrong_email or cookie 
					
					$this->input->set_cookie("error_email_password"   , NULL		, 1);
					//delete_cookie("error_email_password");
					//delete_cookie("error_email_password");
					
					$user_id =  $customer_info[0]->id;
					$first_name =  $customer_info[0]->first_name;
					
					$this->session->set_userdata('user_id', $user_id);
					$this->session->set_userdata('first_name', $first_name);
					
					if($remember_me) $this->input->set_cookie('email', $email, 86400*30*12*2);
					
					//get his cart back if exists 
					$this->load->module("carta");
					$this->carta->restore_user_cart_from_file($user_id);
					//ok user is logged in send him / her to main page
					// redirect to main page
					if($is_admin)
					{
						redirect(base_url().'admin');
					}
					else
					{
						redirect($secure_base_url."customer/my_account");
						//redirect(base_url());
					}
				}
				//else send to login vew bcz email or password is wrong
				else
				{
				   if($remember_me) $this->input->set_cookie('email', $email, 86400*30*6); // save cookie for 6 months
				   $this->input->set_cookie('error_email_password', 1, 86400*30*12*2); // 
				   
				   
				   redirect($secure_base_url."customer/my_account?wrong");
				}
				
				
				/*
				
				echo "<pre>";
				var_dump ($customer_info) ;
				echo "</pre>";
				
				echo "----------------------- session ---------------------------";
				
				echo "<pre>";
				print_r($this->session->all_userdata());
				echo "</pre>";
				
				*/
			}
			// the user was not verified (user status = 2)
			else
			{
			   redirect($secure_base_url."customer/my_account?wronge");
			   // Your account is not activated yet, please check your email to activate your account	
			   //$this->msg->show(167);
			   //redirect(base_url()."login/index/unverified");
			   // todo resend verification mail 
			}
			
		}
	}
	
	public function user_checkout($admin=NULL)
	{
		$ssl_port_num = ":".SSL_PORT;  // :443 is the default
		$base_url_str = base_url(); 
		$sbu = str_replace("http","https",$base_url_str );
		$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
		
		
		$is_admin = FALSE;
		//if the request came from admin login view
		if(!empty($admin))
		{
			$is_admin = TRUE;
		}
		
		$remember_me = FALSE;
		// if the remember me checkbox was checked 
		if ($this->input->post("remember_me"))
		{
			$remember_me = TRUE;
		}
		
		//read cookies if exist 
		//$this->input->cookie('email', "empty" , 86400*30*12*2);
		
		//echo("hello");
		
		$this->load->model("login_mdl"); // needed to get the user information

		// if the name is not empty
		if ($this->input->post("email"))
			{
				$email  = $this->input->post("email");
				if($remember_me) $this->input->set_cookie('email', $email, 86400*30*12*2); 
		    }
		// else (the email is empty) go back to login_view
		else     						    
			{ 	
				//$this->input->set_cookie('empty_email', "1" , 86400*30*12*2);
				
				redirect($secure_base_url."checkout/check?empty_email=1");
	    	}
		
		// if the password is not empty
		if ($this->input->post("password"))
			{   
				$password = $this->input->post("password");
			} 
		// else (password is empty) 
		else					
			{
			   //$this->input->set_cookie('empty_password', "1" , 86400*30*12*2);
			   redirect($secure_base_url."checkout/check?empty_password=1");
			}
	
		
		// if the email and password  are not empty
		if  ($this->input->post("email") and $this->input->post("password"))
		{
			//clear unecessarucookies if any 
			$this->input->set_cookie('empty_password', NULL , 1);
			$this->input->set_cookie('empty_email'   , NULL , 1);
			
			
			//get user infromation from database  he must be active ! or we will get false result
			$customer_info = $this->login_mdl->get_user_info($email);
			
			if(!empty($customer_info))
			{
					
				//get user password fron db
				$db_password =  $customer_info[0]->password;
				//echo $db_password;
				//echo "<br>";
				
				//encrypt form password for comparing
				$input_password_crypted_md5_sha1 = md5(sha1($password));
				//echo "$input_password_crypted_md5_sha1";
				//echo "<br>";
				
				// compare db_password vs input password-----------------------------------------------------
				if($db_password == $input_password_crypted_md5_sha1)
				{
					//delete wrong_email or cookie 
					
					$this->input->set_cookie("error_email_password"   , NULL		, 1);
					//delete_cookie("error_email_password");
					//delete_cookie("error_email_password");
					
					$user_id =  $customer_info[0]->id;
					$first_name =  $customer_info[0]->first_name;
					$this->session->set_userdata('user_id', $user_id);
					$this->session->set_userdata('first_name', $first_name);
					
					if($remember_me) $this->input->set_cookie('email', $email, 86400*30*12*2);
					
					//get his cart back if exists 
					$this->load->module("carta");
					$this->carta->restore_user_cart_from_file($user_id);
					//ok user is logged in send him / her to main page
					
					// redirect to main page
					redirect($secure_base_url."checkout/customer_checkout");
					//redirect(base_url());
					
				}
				//else send to login vew bcz email or password is wrong
				else
				{
				   if($remember_me) $this->input->set_cookie('email', $email, 86400*30*6); // save cookie for 6 months
				   $this->input->set_cookie('error_email_password', 1, 86400*30*12*2); // 
				   
				   
				   redirect($secure_base_url."checkout/check?wrong=1");
				}
				
				
				/*
				
				echo "<pre>";
				var_dump ($customer_info) ;
				echo "</pre>";
				
				echo "----------------------- session ---------------------------";
				
				echo "<pre>";
				print_r($this->session->all_userdata());
				echo "</pre>";
				
				*/
			}
			// the user was not verified (user status = 2)
			else
			{
			   redirect($secure_base_url."checkout/check?wronge=1");
			   // Your account is not activated yet, please check your email to activate your account	
			   //$this->msg->show(167);
			   //redirect(base_url()."login/index/unverified");
			   // todo resend verification mail 
			}
			
		}
	}
	
	public function admin()
	{
		$ssl_port_num = ":".SSL_PORT;  // :443 is the default
		$base_url_str = base_url(); 
		$sbu = str_replace("http","https",$base_url_str );
		$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
		
		redirect($secure_base_url."customer/my_account/?admin=1");
		
		/*
		// load recaptcha library
        $this->load->library('recaptcha');
        // prepare recaptcha widget widget and script to be passed to the view
        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
        );
		
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details 
		$template_path_info = $data['template_info']['path'];  
		
		
		// prepare the metadata information for the view page
		$data['meta_description'] =   "login";
		$data['meta_keywords']    =   "login";
		$data['page_title'] 	   =   "login";
		
		$data['words'] = $this->msg->get_words("login");
		$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");	
		 
        $this->load->view($template_path_info.'/common/css',$data);  
	    $this->load->view($template_path_info.'/common/header',$header_data);  
	    //$this->load->view($data['template_info']['path'].'/common/slider');  
	    
        $this->load->view($template_path_info.'/admin_login_vew',$data);
	    
	    $this->load->view($template_path_info.'/common/footer',$footer_data);  
	    $this->load->view($template_path_info.'/common/script'); 
		
		*/
	}
	
	// logout
	public function logout()
	{
		
		//get the template info from the session
		//$template_info = $this->session->userdata('template_info');
		
		// remove the user_id from the session 
		//$this->session->unset_userdata('user_id');
		$this->session->destroy(); // changed due to new session library
		//$this->session->sess_destroy();
		
		//session cleanup
		$this->load->module("sessman");
		$this->sessman->clean_up_session_table();
		
			/*	echo "----------------------- session ---------------------------";
			
			echo "<pre>";
			print_r($this->session->all_userdata());
			echo "</pre>";*/
		
		
		redirect(base_url());
	}
	
	public function forgot_password()
	{
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details 
		$template_path_info = $data['template_info']['path'];  
		
		
		// prepare the metadata information for the view page
		$data['meta_description'] =   "forgot_password";
		$data['meta_keywords']    =   "forgot_password";
		$data['page_title'] 	   =   "forgot_password";
		
		$data['words'] = $this->msg->get_words("forgot_password");
		$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
		 
		 
        $this->load->view($template_path_info.'/common/css',$data);  
	    $this->load->view($template_path_info.'/common/header',$header_data);  
	    //$this->load->view($data['template_info']['path'].'/common/slider');  
	    
        $this->load->view($template_path_info.'/forgot_password_vew',$data);
	    
	    $this->load->view($template_path_info.'/common/footer',$footer_data);  
	    $this->load->view($template_path_info.'/common/script'); 
	}
	
	public function frgt_pwd($email_sent_flag = FALSE)
	{
		if(!empty($email_sent_flag))
		{
        	$data["email_sent"] = TRUE;
		}
		
		$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
		
		
		// prepare recapcha 
        $this->load->library('recaptcha');
        $data["widget"] = $this->recaptcha->getWidget();
        $data["script"] = $this->recaptcha->getScriptTag();
		
		$data['wrong_email'] = $this->input->get('wronge');
		$data['wrong_email_or_password'] = $this->input->get('wrong');
		
		$data['words'] = $this->msg->get_words("forgot_password");
		
		
		//SEO
		$lang_id	= $this->lng->get_n_set_language_id();	
		$data['meta_info']  =  $this->seo_mdl->get_meta_info("forgot_pass",$lang_id);// get the meta info from database  
			
		//call the view
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details   
	
		$this->load->view($data['template_info']['path'].'/common/css_https',$data);  
        $this->load->view($data['template_info']['path'].'/common/header_https',$header_data);  
         
        $this->load->view($data['template_info']['path'].'/forgot_pass_vew', $data);
        
        $this->load->view($data['template_info']['path'].'/common/footer_https',$footer_data);  
        $this->load->view($data['template_info']['path'].'/common/script_forgot_password_https'); 	
	}
	
	public function forgot_password_ctrl()
	{
		$ssl_port_num = ":".SSL_PORT;  // :443 is the default
		$base_url_str = base_url(); 
		$sbu = str_replace("http","https",$base_url_str );
		$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
		
		//check the recaptcha
		// load recaptcha library
        $this->load->library('recaptcha');
		$recaptcha = $this->input->post('g-recaptcha-response');
		
        $recaptcha = 1 ; // for debugging 
        
        if(!empty($recaptcha))
        {
			//check email
			$regex_errors = 0 ; 
			$email = $this->input->post('email');
			$re = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/"; 
	        preg_match($re, $email, $m);
	        if(empty($m[0])) $regex_errors = 1 ;
			if($regex_errors == 0 )
			{
				//send email with reset link
				$session_token = $this->security->get_csrf_hash();
				//echo "sending email to $email with session token $session_token ";
				$this->load->model('login_mdl');
				$user_id = $this->login_mdl->get_user_info($email)[0]->id;
				if(!empty($user_id))
				{
					$this->load->module('emaily');
					$email_sent_flag = $this->emaily->send_password_reset_link($user_id);
					//$email_sent_flag = TRUE; // for debugging
				
					if($email_sent_flag == TRUE)
					{
						//yes email sent
						$this->frgt_pwd($email_sent_flag);
					}
					else
					{
						//email error
						$this->frgt_pwd();
						
					}	
				}
				else
				{
					//email not found in db or not active 
					redirect( $secure_base_url."login/frgt_pwd/email_nf" ) ;
					
						
				}
				
				
			}
			else
			{
				echo("email error. plz enable javascript");
			}
		}
		else
		{
			redirect( $secure_base_url."login/frgt_pwd" ) ;
		}
	}
	
	public function reset_password($token_str=NULL)
	{
		if(!empty($token_str))
		{
        	$data["email_token_str"] = $token_str;
		}
		
		
		
		$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
		$data['words'] 		  = $this->msg->get_words("change_pass");
		
		
		
		// prepare recapcha 
        $this->load->library('recaptcha');
        $data["widget"] = $this->recaptcha->getWidget();
        $data["script"] = $this->recaptcha->getScriptTag();
		
		$data['wrong_email'] = $this->input->get('wronge');
		$data['wrong_email_or_password'] = $this->input->get('wrong');
		
			
		//call the view
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details   
	
		$this->load->view($data['template_info']['path'].'/common/css_https',$data);  
        $this->load->view($data['template_info']['path'].'/common/header_https',$header_data);  
         
        $this->load->view($data['template_info']['path'].'/change_pass_vew', $data);
        
        $this->load->view($data['template_info']['path'].'/common/footer_https',$footer_data);  
        $this->load->view($data['template_info']['path'].'/common/script_change_pass_https'); 	
	}
	
	public function change_pass()
	{
		$session_token 	= $this->security->get_csrf_hash();   // actual session token
		$email_token_str 		= $this->input->post('email_token_str');  // token from emaily
		
		//split the sting into token and user_id
		$re = '/(.+)_([0-9]+)/';
		preg_match_all($re, $email_token_str, $m);
		
		$email_token = $m[1][0];
		$user_id = $m[2][0];

		
		if($email_token == $session_token)
		{
			$new_password = $this->input->post('na_login_password');
			$confirm_new_password = $this->input->post('na_confirm_password');
			
			//filter 
			 $regex_errors = 0; 
			//password
			$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\-)|(.*\\|)|(.*\\/)|(.* )|(.*%)/"; 
	        preg_match($re, $new_password, $matches8);
	        if(!empty($matches8[0])) $regex_errors = 1 ;
	        
	        // confirm password
			$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\-)|(.*\\|)|(.*\\/)|(.* )|(.*%)/"; 
	        preg_match($re, $confirm_new_password, $matches9);
	        if(!empty($matches9[0])) $regex_errors = 1 ;
	        
	        if($regex_errors == 0)
	        {
				$crypted_new_pwd = md5(sha1($new_password));

				//update user password 
				$this->load->model('login_mdl');
				$this->login_mdl->update_customer_password($user_id,$crypted_new_pwd);
				
				// send email to inform user that his password was changed 
				$this->load->module('emaily');
				$this->emaily->send_password_changed_notification($user_id);
				
				//send user to login page
				$ssl_port_num = ":".SSL_PORT;  // :443 is the default
				$base_url_str = base_url(); 
				$sbu = str_replace("http","https",$base_url_str );
				$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
				redirect( $secure_base_url."customer/my_account" ) ;
				
			}
			else
			{
				header('Location: ' . $_SERVER["HTTP_REFERER"] );
				exit;	
			}
		}
		else
		{
			echo "expired!";
		}
        
	}
	
	

	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */