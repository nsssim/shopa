<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class customer extends MX_Controller {

 function __construct()
    {
        parent::__construct();
        $this->load->model("customer_mdl");
        
        //load the language module
		$this->load->module("lng");
		
		 //load the message module
		$this->load->module("msg");
		
		 //load the seo module
		$this->load->module("seo");
		
		$this->load->helper('url');
		
		
    }

	// add product to the cart via ajax call
	public function add_address($address)
	{
		
		$flag = $this->customer_mdl->add_address($address);
		return $flag;
	}
	
	public function add_customer($customer)
	{
		
		$flag = $this->customer_mdl->add_customer($customer);
		return $flag;
	}
	
	
	//add customer from registration form 
	public function signup()
	{
		//check the recaptcha
		// load recaptcha library
        $this->load->library('recaptcha');
		$recaptcha = $this->input->post('g-recaptcha-response');
		
        $recaptcha = 1 ; // for debugging 
        
        if (!empty($recaptcha)) 
        {
            //$response = $this->recaptcha->verifyResponse($recaptcha);
            
			
            //if recaptcha response is successfull
            
            //if (isset($response['success']) and $response['success'] === true) 
			
            if(1) // for local debugging only must be commented in production 
            {
                //echo "You got it!";
				
				$this->load->helper('url');
				
				$name 			=  $this->input->post('name',TRUE); 
				$email 			=  $this->input->post('email',TRUE); 
				$password_clr 	=  $this->input->post('password',TRUE); 
				$password 		=  md5(sha1($password_clr)); 
				
				// check email if not already assigned in db 
				if($this->check_customer($email))
				{ 
					//todo 
					echo("this email is already registred!<br>"); 
					$email__ = str_replace("@","__",$email ); 
					echo('<a href="'.base_url().'customer/reset_pwd/'.$email__.'"> Reset Email </a><br>'); 
					echo('<a href="'.base_url().'login"> <-Back </a>'); 
				}
				else
				{
					// add new customer with unverified status  (satus_id = 2)
					$firstname 		= $name;
					$lasname 		= "";
					$phone 			= "";
					$alt_phone 		= "";
					$prim_lang_id	= $this->lng->get_n_set_language_id();	
					$satus_id 		= 2 ; // id = 2 <=> unverified
					
					$customer = array("firstname"=>$firstname , "lasname"=>$lasname, "phone"=>$phone, "alt_phone"=>$alt_phone, "email"=>$email, "prim_lang_id"=>$prim_lang_id,"status_id"=>$satus_id,"password"=>$password );
					
					
					
					//prepare code
					$emlpass = $email.$password;
					$verification_code = sha1($emlpass);
					
					//verifiy form fields
					if(!empty($firstname) and !empty($email) and !empty($password_clr) )
					{
						// send email
						date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
						$this->load->library('email');

						// config the email library PHPMailer @link https://github.com/ivantcholakov/codeigniter-phpmailer
						
						// suconf = Sign up confirmation!
						$suconf = $this->msg->get_translated_message(140);
						//$ur_almost_done= <p>You are almost done , click the link below or paste into your browser to verify your Email Address:</p>
						$ur_almost_done= $this->msg->get_translated_message(141);
						
						$subject = 'Shop Amerika - '.$suconf;
			            $message = $ur_almost_done;
			            
			            $verifiy_link = '<a href="'.base_url().'customer/verify/'.$verification_code.'"> '.base_url().'customer/verify/'.$verification_code.'</a>';
			            //echo $verifiy_link; // for debugging
			            
			            $body =
							'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
							<html xmlns="http://www.w3.org/1999/xhtml">
							<head>
							    <meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
							    <title>'.html_escape($subject).'</title>
							    <style type="text/css">
							        body {
							            font-family: Arial, Verdana, Helvetica, sans-serif;
							            font-size: 16px;
							        }
							    </style>
							</head>
							<body>
							<img src="http://www.shopamerika.com/v2/assets/templates/eshopper/images/home/logo.png" alt="Shop Amerika">
							'.$message.'
							'.$verifiy_link.'<br>
							
							
							</body>
							</html>';
						 
						$this->email->from('no-reply@shopamerika.com','Shop Amerika');
						$this->email->to($email);
						$this->email->subject($subject);
						$this->email->message($body);
						
						$result = $this->email->send();
			            
						if ( !$result)
						{
						    $this->msg->show(40);
						    
						    //echo("well that's embarassing ...we had a technical problem during emailing your verification email<br>");
						    //for debugging
							$email_dbg = $this->email->print_debugger();
						}
						else
						{
							//email sent ok 
							if(!empty($customer))
							{
								$flag_customer_added = $this->customer_mdl->add_customer($customer);
							}
								
							//for debugging
							//$email_dbg = $this->email->print_debugger();
							//$oo = 55;
							
							$this->msg->show(110);
							//echo("confirmation email, message sent!<br> Please check your email.<br>");
						}
						
			            /*var_dump($result);
			            echo '<br />';
			            echo $this->email->print_debugger();*/
						
						//end send email		
					}
					else
					{
						$this->msg->show(60);
						//echo "all fields must be filled";
					}
				}
				
            }
		}
		else
		{
			// recaptcha error / mistake 
			$this->msg->show(60);
			//echo "all fields must be filled";
		}
	}
	
	public function verify($verification_code)
	{
		$this->load->helper('url');
		//check unverified customers for verification_code if exist it will return the customer id and more else it will be false
		$verification_result = $this->customer_mdl->verify($verification_code);
		if (!empty($verification_result))
		{
			$user_data = $verification_result ;
			//change user status from unverified to active (status id from 2 to 1)
			$user_id = $user_data->id;
			$first_name = $user_data->first_name;
			$this->customer_mdl->change_user_status($user_id,1); 
			
			//log user into session 
			$this->session->set_userdata('user_id', $user_id);
			$this->session->set_userdata('first_name', $first_name);
				
			//call view to confirm that the user is verified
			
			$this->msg->show(20);
			//echo("Welcome to AmerikaShop, your account has been activated ");
			//$link = '<a href="'.base_url().'">Enjoy shopping now!</a>';
			//echo($link);
			
		}
		//verification failed
		else
		{
			//todo
			// user with verification code was not found
			$this->msg->show(90);
			//echo("customer not to be found ! ");
		}
	}
	
	// to finish add customer via registration form
	public function registration()
	{
		
		$address1 	= $this->input->post('address1',TRUE);
		$address2 	= $this->input->post('address2',TRUE);
		$address3 	= $this->input->post('address3',TRUE);
		$city 		= $this->input->post('city',TRUE);
		$region 	= $this->input->post('region',TRUE);
		$zipcode 	= $this->input->post('zipcode',TRUE);
		$country 	= $this->input->post('country',TRUE);
		
		$address = array("address1"=>$address1 , "address2"=>$address2, "address3"=>$address3, "city"=>$city, "region"=>$region, "zipcode"=>$zipcode, "country"=>$country);
		
		$firstname 		= $this->input->post('firstname',TRUE);
		$lasname 		= $this->input->post('lasname',TRUE);
		$phone 			= $this->input->post('phone',TRUE);
		$alt_phone 		= $this->input->post('alt_phone',TRUE);
		$email 			= $this->input->post('email',TRUE);
		
		$prim_lang_id	= $this->input->post('lang_id',TRUE);
		
		$customer = array("firstname"=>$firstname , "lasname"=>$lasname, "phone"=>$phone, "alt_phone"=>$alt_phone, "email"=>$email, "prim_lang_id"=>$prim_lang_id );
		
		$lang_id = $this->lng->get_n_set_language_id();	
		
		$flag = $this->customer_mdl->add_customer($customer,$lang_id);
		return $flag;
	}
	
	// todo update customer details via ajax (call from customer account)
	public function update()
	{
		//$oo =55 ;
		
		$id 			= $this->input->post('id',TRUE);
		$firstname 		= $this->input->post('firstname',TRUE);
		$lastname 		= $this->input->post('lastname',TRUE);
		$phone 			= $this->input->post('phone',TRUE);
		$alt_phone 		= $this->input->post('alt_phone',TRUE);
		$email 			= $this->input->post('email',TRUE);
		$prim_lang_id 	= $this->input->post('lang_id',TRUE);
		$birthdate 		= $this->input->post('birthdate',TRUE);
		$gender_id 		= $this->input->post('gender',TRUE);
		$newsletter 	= $this->input->post('newsletter ',TRUE);
		
		
		/*	
		for testing
		$id 			= 30;
		$firstname 		= "hello";
		$lasname 		= "bbb";
		$phone 			= "32232";
		$alt_phone 		= "32232";
		$email 			= "asdasd@sdsad.com";
		$prim_lang_id 	= "2";
		$birthdate 		= "12/15/1958";
		$gender_id 		= "1";
		$newsletter 	= "1";
		*/
		
		
		$customer = array("id"=>$id ,"firstname"=>$firstname , "lastname"=>$lastname, "phone"=>$phone, "alt_phone"=>$alt_phone, "email"=>$email, "prim_lang_id"=>$prim_lang_id , "birthdate"=> $birthdate,"gender_id"=> $gender_id,"newsletter"=> $newsletter);
		
		$flag = $this->customer_mdl->update_customer($customer);
		
		$json_flag = json_encode($flag);
		echo($json_flag);
	}
	
	//update the customer details during checkout (will be called from checkout module)
	public function update_customer_from_checkout($customer_id,$customer_data)
	{
		
		$flag = $this->customer_mdl->update_customer_from_checkout($customer_id,$customer_data);
		return $flag;
	}
	
	//todo change password via ajax
	public function change_pwd()
	{
		$pwd = $this->input->post('password',TRUE);
		$flag = $this->customer_mdl->update_password($pwd);
		return $flag;
		
	}
	
	//called from I forgot my password view
	public function confirm_reset_password()
	{
		$this->load->helper("url"); 	
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required');
		
		$email = $this->input->post("email",TRUE);
		if(empty($email))	 
		{
		 	redirect(base_url()."login/forgot_password");
		}
		 
		 	//email is ok
		else
		{
			// get customer id from db 
			$customer_id_arr = $this->customer_mdl->get_user_id($email);
			
			//if email exists in db 
			if(!empty($customer_id_arr))
			{
				$customer_id = $customer_id_arr[0]->customer_id;
				$token = md5(sha1($email));
				
				// send email
				{
					date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
					$this->load->library('email');

					// config the email library PHPMailer @link https://github.com/ivantcholakov/codeigniter-phpmailer
					
					// $reset_password_str = 'Reset Password Request!'
					$reset_password_str = $this->msg->get_translated_message(150);
					//$there_was_activity= '<p>there was some activity on your behalf on your account, if you requested a password reset, please click on the link below to reset your password, if this email was not requested from you, just ignore it</p>';
					$there_was_activity = $this->msg->get_translated_message(151);
					//$Reset_my_passord_str = 'Reset my passord';
					$reset_my_passord_str = $this->msg->get_translated_message(152);
					
					$subject = 'Shop Amerika - '.$reset_password_str;
		            $message = $there_was_activity ;
		            $change_password_link = '<a href="'.base_url().'customer/changepass/'.$token.'/'.$customer_id.'"> '.$reset_my_passord_str.'</a>';
		            //echo $verifiy_link; // for debugging
		            
		            $body =
						'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html xmlns="http://www.w3.org/1999/xhtml">
						<head>
						    <meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
						    <title>'.html_escape($subject).'</title>
						    <style type="text/css">
						        body {
						            font-family: Arial, Verdana, Helvetica, sans-serif;
						            font-size: 16px;
						        }
						    </style>
						</head>
						<body>
						<img src="http://www.shopamerika.com/v2/assets/templates/eshopper/images/home/logo.png" alt="Shop Amerika">
						'.$message.'
						'.$change_password_link.'<br>
						
						
						</body>
						</html>';
					 
					$this->email->from('no-reply@shopamerika.com','Shop Amerika');
					$this->email->to($email);
					$this->email->subject($subject);
					$this->email->message($body);
					
					$result = $this->email->send();
		            
					if ( !$result)
					{
						// email not sent
					    $data["error_embarassing"] = 1;
						
						//load view
						$this->load->model('home_mdl');
						
						$data['template_info']   = $this->home_mdl->get_template_info();
						
						$header_data['words'] = $this->msg->get_words("header");
						$footer_data['words'] = $this->msg->get_words("footer");
						
				        $this->load->view($data['template_info']['path'].'/common/css',$data);  
				        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
		 
				        $this->load->view($data['template_info']['path'].'/customer_reset_password_vew', $data);
				        
				        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
				        $this->load->view($data['template_info']['path'].'/common/script');
					}
					else
					{
						// ok email sent!
						$data['email_ok_change_password_link'] = 1;
						//for debugging
						//$email_dbg = $this->email->print_debugger();
						
						// take user to the view
						// for template_info
						$this->load->model('home_mdl');
						
						$data['template_info']   = $this->home_mdl->get_template_info();
				        $this->load->view($data['template_info']['path'].'/common/css',$data);  
				        $this->load->view($data['template_info']['path'].'/common/header');  
				         
				        $this->load->view($data['template_info']['path'].'/customer_reset_password_vew', $data);
				        
				        $this->load->view($data['template_info']['path'].'/common/footer');  
				        $this->load->view($data['template_info']['path'].'/common/script');
						
					}
					
		            /*var_dump($result);
		            echo '<br />';
		            echo $this->email->print_debugger();*/
					
				}
				//end send email
				//*	 
				
			}
			else
			{
				// email is not in database <=> not a customer
				redirect(base_url()."login/forgot_password");
			}	
		 	
		}
	}
	
	//this functiion is called only if the email was found in the database during sign up
	public function reset_pwd($email)
	{
		$this->load->helper('url');
		
		$email = str_replace("__","@",$email );
		//echo($email);
		
		$data['email'] = $email;
		
		// get customer id from db 
		$customer_id_arr = $this->customer_mdl->get_user_id($email);
		$customer_id = $customer_id_arr[0]->customer_id;
		
		$token = md5(sha1($email));
		
		
		// send email
		{
			date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
			$this->load->library('email');

			// config the email library PHPMailer @link https://github.com/ivantcholakov/codeigniter-phpmailer
			
			// $reset_password_str = 'Reset Password Request!'
			$reset_password_str = $this->msg->get_translated_message(150);
			//$there_was_activity= '<p>there was some activity on your behalf on your account, if you requested a password reset, please click on the link below to reset your password, if this email was not requested from you, just ignore it</p>';
			$there_was_activity = $this->msg->get_translated_message(151);
			//$Reset_my_passord_str = 'Reset my passord';
			$reset_my_passord_str = $this->msg->get_translated_message(152);
			
			$subject = 'Shop Amerika - '.$reset_password_str;
		    $message = $there_was_activity ;
		    $change_password_link = '<a href="'.base_url().'customer/changepass/'.$token.'/'.$customer_id.'"> '.$reset_my_passord_str.'</a>';
		    //echo $verifiy_link; // for debugging
			
			
            //echo $verifiy_link; // for debugging
            
            $body =
				'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				    <meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
				    <title>'.html_escape($subject).'</title>
				    <style type="text/css">
				        body {
				            font-family: Arial, Verdana, Helvetica, sans-serif;
				            font-size: 16px;
				        }
				    </style>
				</head>
				<body>
				<img src="http://www.shopamerika.com/v2/assets/templates/eshopper/images/home/logo.png" alt="Shop Amerika">
				'.$message.'
				'.$change_password_link.'<br>
				
				
				</body>
				</html>';
			 
			$this->email->from('no-reply@shopamerika.com','Shop Amerika');
			$this->email->to($email);
			$this->email->subject($subject);
			$this->email->message($body);
			
			$result = $this->email->send();
            
			if ( !$result)
			{
				// email not sent
			    $data["error_embarassing"] = 1;
				
				$header_data['words'] = $this->msg->get_words("header");
				$footer_data['words'] = $this->msg->get_words("footer");
				
				//load view
				$this->load->model('home_mdl');
				
				$data['template_info']   = $this->home_mdl->get_template_info();
		        $this->load->view($data['template_info']['path'].'/common/css',$data);  
		        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
		         
		        $this->load->view($data['template_info']['path'].'/customer_reset_password_vew', $data);
		        
		        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
		        $this->load->view($data['template_info']['path'].'/common/script');
			}
			else
			{
				// ok email sent!
				$data['email_ok_change_password_link'] = 1;
				//for debugging
				//$email_dbg = $this->email->print_debugger();
				
				
				$header_data['words'] = $this->msg->get_words("header");
				$footer_data['words'] = $this->msg->get_words("footer");
				
				// take user to the view
				// for template_info
				$this->load->model('home_mdl');
				
				$data['template_info']   = $this->home_mdl->get_template_info();
		        $this->load->view($data['template_info']['path'].'/common/css',$data);  
		        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
		         
		        $this->load->view($data['template_info']['path'].'/customer_reset_password_vew', $data);
		        
		        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
		        $this->load->view($data['template_info']['path'].'/common/script');
				
			}
			
            /*var_dump($result);
            echo '<br />';
            echo $this->email->print_debugger();*/
			
		}
		//end send email
		
	}
	
	public function changepass($token_from_link,$user_id)
	{
		$this->load->helper('url');
		
		// get user email
		$customer_email_array = $this->customer_mdl->get_customer_details($user_id);
		$email = $customer_email_array[0]->email;
		//echo($customer_email);
		//
		
		// check $token
		$token_from_db = md5(sha1($email));
		if($token_from_link == $token_from_db)
		{
			// generate password and update customer password with  the generated password
			$new_password = $this->randomPassword();
			$encrypted_new_pwd = md5(sha1($new_password));
			
			$this->customer_mdl->update_customer_password($user_id,$encrypted_new_pwd);
			
			//send email to customer to login with his new password and ask him to change it
			// send email
			{
				date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
				$this->load->library('email');

				// config the email library PHPMailer @link https://github.com/ivantcholakov/codeigniter-phpmailer
				
				// $reset_password_str = 'New Password!'
				$new_password_str = $this->msg->get_translated_message(160);
				//Your new temporary password is:
				$your_new_temp_pass_is = $this->msg->get_translated_message(161);
				//you can login to your account with this password and change it
				$you_can_login_to_your_account = $this->msg->get_translated_message(162);
				//login to my account
				$login_to_my_account = $this->msg->get_translated_message(163);
				
				
				
					
				$subject = 'Shop Amerika -'.$new_password_str;
	            $message = '<p>'.$your_new_temp_pass_is.' '.$new_password.' , '.$you_can_login_to_your_account.' </p>';
	            $login_link = '<a href="'.base_url().'login"> '.$login_to_my_account.'</a>';
	            //echo $verifiy_link; // for debugging
	            
	            $body =
					'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					    <meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
					    <title>'.html_escape($subject).'</title>
					    <style type="text/css">
					        body {
					            font-family: Arial, Verdana, Helvetica, sans-serif;
					            font-size: 16px;
					        }
					    </style>
					</head>
					<body>
					<img src="http://www.shopamerika.com/v2/assets/templates/eshopper/images/home/logo.png" alt="Shop Amerika">
					'.$message.'
					'.$login_link.'<br>
					
					
					</body>
					</html>';
				 
				$this->email->from('no-reply@shopamerika.com','Shop Amerika');
				$this->email->to($email);
				$this->email->subject($subject);
				$this->email->message($body);
				
				$result = $this->email->send();
	            
				if ( !$result)
				{
					// email not sent
				    $data["error_embarassing"] = 1;
					
					$header_data['words'] = $this->msg->get_words("header");
					$footer_data['words'] = $this->msg->get_words("footer");
				
					//load view
					$this->load->model('home_mdl');
					
					$data['template_info']   = $this->home_mdl->get_template_info();
			        $this->load->view($data['template_info']['path'].'/common/css',$data);  
			        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
			         
			        $this->load->view($data['template_info']['path'].'/customer_reset_password_vew', $data);
			        
			        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
			        $this->load->view($data['template_info']['path'].'/common/script');
				}
				else
				{
					// ok email sent!
				    $data["email_ok_password_reset"] = 1;
					//for debugging
					//$email_dbg = $this->email->print_debugger();
					
					$header_data['words'] = $this->msg->get_words("header");
					$footer_data['words'] = $this->msg->get_words("footer");
					
					// take user to the view
					// for template_info
					$this->load->model('home_mdl');
					
					$data['template_info']   = $this->home_mdl->get_template_info();
			        $this->load->view($data['template_info']['path'].'/common/css',$data);  
			        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
			         
			        $this->load->view($data['template_info']['path'].'/customer_reset_password_vew', $data);
			        
			        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
			        $this->load->view($data['template_info']['path'].'/common/script');
					
				}
				
	            /*var_dump($result);
	            echo '<br />';
	            echo $this->email->print_debugger();*/
				
			}
			//end send email
		
			
		}
		
		
		
	}
	
	public function  randomPassword() 
    {
    	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    	$pass = array(); //remember to declare $pass as an array
    	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    	for ($i = 0; $i < 8; $i++) 
    	{
        	$n = rand(0, $alphaLength);
        	$pass[] = $alphabet[$n];
    	}
    	return implode($pass); //turn the array into a string
	}
	
	
	public function get_last_table_id($table_name)
	{
		
		$last_record_id = $this->customer_mdl->get_last_id($table_name);
		return $last_record_id;
	}
	
	//$address_type = "SHIPPING" or "BILLING" or "BOTH"
	public function link_customer_address($user_id = NULL,$address_type = "both_billing_and_shipping")
	{
		if(empty($user_id))
		{
			$last_customer_id = $this->get_last_table_id("customers");
			$last_address_id = $this->get_last_table_id("addresses");
			
			/*echo "<pre>";
			print_r($last_customer_id);
			echo "</pre>";*/
			$flag = $this->customer_mdl->link_customers_to_addresses($last_customer_id[0]->last_id, $last_address_id[0]->last_id,$address_type);
		}
		else
		{
			$last_address_id = $this->get_last_table_id("addresses");
			$flag = $this->customer_mdl->link_customers_to_addresses($user_id, $last_address_id[0]->last_id,$address_type);
		} 
		return $flag;
		
	}
	
	public function set_as_billing_address($address_id)
	{
		$flag = $this->customer_mdl->set_as_billing_address($address_id);
		return $flag;
	}
	
	public function check_customer($email)
	{
		
		$flag = $this->customer_mdl->check_customer($email);
		if($flag) 
		{
		//echo "customer already in database";
		return TRUE;
		}
		else
		{
		 //echo " new customer ";
		return FALSE;
			
		}
	}
	
	//same as above but this ine is for ajax
	public function xcheck_customer()
	{
		$email = $this->input->get('email');
		
		$flag = $this->customer_mdl->check_customer($email);
		if($flag) 
		{
		echo 1;
		//echo "customer already in database";
		//return TRUE;
		}
		else
		{
		echo 0;
		//echo "not found in db";
		//return FALSE;
			
		}
	}
	
	public function get_user_id($email)
	{
		
		$user_id = $this->customer_mdl->get_user_id($email);
		if(!empty($user_id))
		{
			return ($user_id[0]->customer_id) ;
		}
		else
		{
			return 0;
		}
	}
	
	public function get_customer_address_delivery_id($user_id)
	{
		$address_id = $this->customer_mdl->get_customer_address_delivery_id($user_id);
		if(!empty($address_id))
			return ($address_id[0]->address_delivery_id) ;
		else
			return NULL;
		
	}
	
	public function get_customer_address_invoice_id($user_id)
	{
		
		$address_id = $this->customer_mdl->get_customer_address_invoice_id($user_id);
		if(!empty($address_id))
			return ($address_id[0]->address_invoice_id) ;
		else
			return NULL;
	}
	
	// get the last 300 customers 
	public function get_customers()
	{
		
		$customers = $this->customer_mdl->get_customers();
		
		/*echo "<pre>";
		print_r($customers);
		echo "</pre>";*/
		
		return $customers ;
	}
	
	public function get_customer_orders($customer_id)
	{
		
		$customer_orders = $this->customer_mdl->get_customer_orders($customer_id);
		
		/*echo "<pre>";
		print_r($customer_orders);
		echo "</pre>";*/
		
		
		return $customer_orders ;
	}
	
	public function get_number_of_customers()
	{
		
		$get_number_of_customers_arr = $this->customer_mdl->get_number_of_customers();
		$get_number_of_customers = $get_number_of_customers_arr[0]->num_customers;
		
		//echo $get_number_of_customers;
		
		return $get_number_of_customers;
		
	}
	
	
	
	//user pages below
	public function myaccount()
	{
		$this->load->helper('url');
			
		$ssl_port_num = ":".SSL_PORT;  // :443 is the default
		$base_url_str = base_url(); 
		$sbu = str_replace("http","https",$base_url_str );
		$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
	
		redirect($secure_base_url."customer/my_account");
		/*
		
		//get the user_id from the session 
		$user_id =  $this->session->userdata("user_id");
		
		// if the session did not expire
		if(!empty($user_id))
		{
			//get customer details
			$customer_details = $this->customer_mdl->get_customer_details($user_id);
			
			$data['customer_details'] = $customer_details;
			
			// flag for the left menu to change the css of the active element
			$data['is_account_page']  = 1;
			
			//get available languages
			$data['languages'] = $this->lng->get_avlbl_languages();
			
			$data['words'] = $this->msg->get_words("customer_account");
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			// for template_info
			$this->load->model('home_mdl');
			
			$data['template_info']   = $this->home_mdl->get_template_info();
	        $this->load->view($data['template_info']['path'].'/common/css',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
	         
	        $this->load->view($data['template_info']['path'].'/customer_account_vew', $data);
	        
	        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
	        $this->load->view($data['template_info']['path'].'/common/script'); 
		}
		// session expired send mwssage to inform customer
		else
		{
			
			$this->load->helper('url');
			redirect(base_url()."login");
			
		}
		*/
	}
	
	public function member()
	{
		//get the user_id from the session 
		$user_id =  $this->session->userdata("user_id");
		
		// if the session did not expire
		if(!empty($user_id))
		{
			//get customer details
			$customer_details = $this->customer_mdl->get_customer_details($user_id);
			$customer_orders =  $this->customer_mdl->get_customer_orders($user_id);
			
			$data['customer_details'] = $customer_details;
			$data['customer_orders']  = $customer_orders;
			
			// flag for the left menu to change the css of the active element
			$data['is_account_page']  = 1;
			
			//get available languages
			$data['languages'] = $this->lng->get_avlbl_languages();
			
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			// for template_info
			$this->load->model('home_mdl');
			
			$data['template_info']   = $this->home_mdl->get_template_info();
	        $this->load->view($data['template_info']['path'].'/common/css',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
	         
	        $this->load->view($data['template_info']['path'].'/member_vew', $data);
	        
	        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
	        $this->load->view($data['template_info']['path'].'/common/script'); 
		}
		// session expired send mwssage to inform customer
		else
		{
			
			$this->load->helper('url');
			redirect(base_url()."login");
			
		}
	}
	
	//page
	public function myorders()
	{
		//get the user_id from the session 
		$user_id =  $this->session->userdata("user_id");
		
		// if the session did not expire
		if(!empty($user_id))
		{
			//get customer details
			$customer_details = $this->customer_mdl->get_customer_details($user_id);
			$data['customer_details'] = $customer_details;
			
			// pagination  start///////////////////////
			$this->load->library('pagination');
					
			$item_per_page = 50;
			// get the total number 
			$total_rows =  (int)$this->customer_mdl->get_number_customer_orders($user_id);
			$data['total_rows'] = $total_rows;
			// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
			if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
			
			$config['base_url']  = base_url().'/customer/myorders/';
			$config['first_url'] = $config['base_url'].'0?'.http_build_query($_GET);
			
			$config['per_page']  = $item_per_page;
			$config['total_rows'] = $total_rows;
				
			$this->pagination->initialize($config);
			$data['pagination'] =  $this->pagination->create_links();
			
			$offset = $this->uri->segment(3);
			if(!$offset) $offset = 0;
			// query with offset and limit ($item_per_page)
			
			$order_by_str = "orders_date_add DESC";
			$data['customer_orders'] = $this->customer_mdl->get_customer_orders_paginated($user_id,$offset,$item_per_page,$order_by_str); 
			
			// end pagination //////////////////////////////
			
			
			
			// flag for the left menu to change the css of the active element
			$data['is_order_page']  = 1;
			
			$data['words'] 		  = $this->msg->get_words("customer_orders");
			$data['lwords'] 	  = $this->msg->get_words("customer_left_menu");
			
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			// currency
			$this->load->module('currency');
			$this->currency->set_currency(); // no parameter ==> usd will be the default
			$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
			$RATE = $this->session->userdata("CUR_RATE");
			$header_data['currency'] = $CURRENCY;
			$header_data['rate'] = $RATE;
			
			$script_data['currency'] = $CURRENCY;
			$script_data['rate'] = $RATE;
			
			//SEO
			$lang_id	= $this->lng->get_n_set_language_id();	
			$data['meta_info']  =  $this->seo_mdl->get_meta_info("customer_orders",$lang_id);// get the meta info from database  
		
			// for template_info
			$this->load->model('home_mdl');
			
			$data['template_info']   = $this->home_mdl->get_template_info();
	        $this->load->view($data['template_info']['path'].'/common/css',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
	         
	        $this->load->view($data['template_info']['path'].'/customer_orders_vew', $data);
	        
	        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
	        $this->load->view($data['template_info']['path'].'/common/script_customer_orders',$script_data); 
		}
		// session expired send mwssage to inform customer
		else
		{
			
			$this->load->helper('url');
			
			$ssl_port_num = ":".SSL_PORT;  // :443 is the default
			$base_url_str = base_url(); 
			$sbu = str_replace("http","https",$base_url_str );
			$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
		
			redirect($secure_base_url."customer/my_account");
			
		}
	}
	
	public function order_details($order_id)
	{
		
		
		$order_details = $this->customer_mdl->get_order_details($order_id);
		$data['order_details']  = $order_details[0];
		// flag for the left menu to change the css of the active element
		//$data['is_address_page']  = 1;
		
		
		$data['words'] 	  = $this->msg->get_words("customer_order_details");
		
		$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
		
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		$header_data['currency'] = $CURRENCY;
		$header_data['rate'] = $RATE;
		
		$script_data['currency'] = $CURRENCY;
		$script_data['rate'] = $RATE;


		
		
		// for template_info
		$this->load->model('home_mdl');
		
		$data['template_info']   = $this->home_mdl->get_template_info();
	    $this->load->view($data['template_info']['path'].'/common/css_customer_addresses',$data);  
	    $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
	     
	    $this->load->view($data['template_info']['path'].'/customer_order_details_vew', $data);
	    
	    $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
	    $this->load->view($data['template_info']['path'].'/common/script_customer_addresses',$script_data); 
	
	}
	
	
	//page
	public function myaddresses()
	{
		//get the user_id from the session 
		$user_id =  $this->session->userdata("user_id");
		
		// if the session did not expire
		if(!empty($user_id))
		{
			//get customer details
			$customer_details = $this->customer_mdl->get_customer_details($user_id);
			$customer_delivery_addresses = $this->get_customer_delivery_addresses($user_id) ;
			$customer_billing_addresses = $this->get_customer_invoice_addresses($user_id) ;
			
			$data['customer_details'] = $customer_details;
			$data['customer_delivery_addresses']  = $customer_delivery_addresses;
			$data['customer_billing_addresses']  = $customer_billing_addresses;
			
			$data['countries']  = $this->customer_mdl->get_countries();
			
			
			// flag for the left menu to change the css of the active element
			$data['is_address_page']  = 1;
			
			$data['words'] 		  = $this->msg->get_words("customer_addresses");
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			// for template_info
			$this->load->model('home_mdl');
			
			$data['template_info']   = $this->home_mdl->get_template_info();
	        $this->load->view($data['template_info']['path'].'/common/css_customer_addresses',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
	         
	        $this->load->view($data['template_info']['path'].'/customer_addresses_vew', $data);
	        
	        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
	        $this->load->view($data['template_info']['path'].'/common/script_customer_addresses'); 
		}
		// session expired send mwssage to inform customer
		else
		{
			
			$this->load->helper('url');
			redirect(base_url()."login");
			
		}
	}
	
	//page
	public function mypassword()
	{
		//get the user_id from the session 
		$user_id =  $this->session->userdata("user_id");
		
		// if the session did not expire
		if(!empty($user_id))
		{
			//get customer details
			$customer_details = $this->customer_mdl->get_customer_details($user_id);
			
			$data['customer_details'] = $customer_details;
			
			// flag for the left menu to change the css of the active element
			$data['is_password_page']  = 1;
			
			$data['words'] 		  = $this->msg->get_words("customer_password");
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			// for template_info
			$this->load->model('home_mdl');
			
			$data['template_info']   = $this->home_mdl->get_template_info();
	        $this->load->view($data['template_info']['path'].'/common/css',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
	         
	        $this->load->view($data['template_info']['path'].'/customer_password_vew', $data);
	        
	        $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
	        $this->load->view($data['template_info']['path'].'/common/script'); 
		}
		// session expired send message to inform customer
		else
		{
			//redirect to login screen 
			$this->load->helper('url');
			redirect(base_url()."login");
			
		}
	}
	
	//page login 
	public function my_account()
	{
		//get the user_id from the session 
		$user_id =  $this->session->userdata("user_id");
		
		//AS A CUSTOMER
		// if the session did not expire
		if(!empty($user_id))
		{
			//get customer details
			$customer_details = $this->customer_mdl->get_customer_details($user_id);
			$data['customer_details'] = $customer_details;
			
			// flag for the left menu to change the css of the active element
			$data['is_account_page']  = 1;
			
			$data['words'] 		  = $this->msg->get_words("customer_my_account_logged_in");
			$data['lwords'] 	  = $this->msg->get_words("customer_left_menu");
			
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			//SEO
			$lang_id	= $this->lng->get_n_set_language_id();	
			$data['meta_info']  =  $this->seo_mdl->get_meta_info("customer_my_account_logged_in",$lang_id);// get the meta info from database 
			
			
			// for template_info
			$this->load->model('home_mdl');
			
			$data['template_info']   = $this->home_mdl->get_template_info();
	        $this->load->view($data['template_info']['path'].'/common/css_https',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header_https',$header_data);  
	         
	        $this->load->view($data['template_info']['path'].'/customer_my_account_logged_in_vew', $data);
	        
	        $this->load->view($data['template_info']['path'].'/common/footer_https',$footer_data);  
	        $this->load->view($data['template_info']['path'].'/common/script_my_account_https'); 
		}
		// session expired send message to inform customer
		//AS A GUEST
		else
		{
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			$this->load->module('addressman');
			$data['cities_tr'] = $this->addressman->get_cities_tr();
			
			// for template_info
			$this->load->model('home_mdl');
			
			$data['template_info']   = $this->home_mdl->get_template_info();
			
			$data['words'] 		  = $this->msg->get_words("sign_in");
			$data['lwords'] 	  = $this->msg->get_words("customer_left_menu");
	        
	        $data['is_account_page']  = 1;
	        
	        //SEO
			$lang_id	= $this->lng->get_n_set_language_id();	
			$data['meta_info']  =  $this->seo_mdl->get_meta_info("customer_my_account_guest",$lang_id);// get the meta info from database 

	        
	        $this->load->view($data['template_info']['path'].'/common/css_https',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header_https',$header_data);  
	         
	        $this->load->view($data['template_info']['path'].'/customer_my_account_guest_vew', $data);
	        
	        $this->load->view($data['template_info']['path'].'/common/footer_https',$footer_data);  
	        $this->load->view($data['template_info']['path'].'/common/script_my_account_https'); 
			
		}
	}
	
	public function new_account()
	{
		//get customer details
		
		
		$data['words'] 		  = $this->msg->get_words("customer_new_profile");
		$data['lwords'] 	  = $this->msg->get_words("customer_left_menu");
		
		$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
		
		//get turkey cities
		$this->load->module('addressman');
		$data['cities_tr'] = $this->addressman->get_cities_tr();
		
		// for template_info
		$this->load->model('home_mdl');
		
		$data['is_profile_page'] = 1 ;
		
		//SEO
		$lang_id	= $this->lng->get_n_set_language_id();	
		$data['meta_info']  =  $this->seo_mdl->get_meta_info("customer_new_account",$lang_id);// get the meta info from database  
		
		$data['template_info']   = $this->home_mdl->get_template_info();
        $this->load->view($data['template_info']['path'].'/common/css_https',$data);  
        $this->load->view($data['template_info']['path'].'/common/header_https',$header_data);  
         
        $this->load->view($data['template_info']['path'].'/customer_new_account_vew', $data);
        
        $this->load->view($data['template_info']['path'].'/common/footer_https',$footer_data);  
        $this->load->view($data['template_info']['path'].'/common/script_new_account_https'); 
			
	}
	
	public function my_profile()
	{
		//get the user_id from the session 
		$user_id =  $this->session->userdata("user_id");
		
		// if the session did not expire
		if(!empty($user_id))
		{
			//for the admin panel link / logo
			$customer_details = $this->customer_mdl->get_customer_details($user_id);
			$data['customer_details'] = $customer_details;
			
			
			$lang_id = $this->lng->get_n_set_language_id();
			$data['lang_id'] = $lang_id ;
			
			//get customer details
			$customer_and_billing_address_details = $this->customer_mdl->get_customer_and_billing_address_details($user_id);
			$data['customer'] = $customer_and_billing_address_details;
			
			// flag for the left menu to change the css of the active element
			$data['is_profile_page']  = 1;
			
			//get turkey cities
			$this->load->module('addressman');
			$data['cities_tr'] = $this->addressman->get_cities_tr();
			
			//get turkey counties
			$city_id = $customer_and_billing_address_details->city;
			$data['counties_tr'] = $this->addressman->get_counties_for_tr_city($city_id);
			
			$data['words'] 		  = $this->msg->get_words("customer_my_profile");
			$data['lwords'] 	  = $this->msg->get_words("customer_left_menu");
			
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			// for template_info
			$this->load->model('home_mdl');
			
			//SEO
			$lang_id	= $this->lng->get_n_set_language_id();	
			$data['meta_info']  =  $this->seo_mdl->get_meta_info("customer_my_profile",$lang_id);// get the meta info from database 
			
			$data['template_info']   = $this->home_mdl->get_template_info();
	        $this->load->view($data['template_info']['path'].'/common/css_https',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header_https',$header_data);  
	         
	        $this->load->view($data['template_info']['path'].'/customer_my_profile_vew', $data);
	        
	        $this->load->view($data['template_info']['path'].'/common/footer_https',$footer_data);  
	        $this->load->view($data['template_info']['path'].'/common/script_my_profile_https'); 
		}
		// session expired send mwssage to inform customer
		else
		{
			$this->new_account();
			
		}
		
	}
	
	public function my_address_book()
	{
		//get the user_id from the session 
		$user_id =  $this->session->userdata("user_id");
		
		// if the session did not expire
		if(!empty($user_id))
		{
			$lang_id = $this->lng->get_n_set_language_id();
			$data['lang_id'] = $lang_id ;
			
			//for the admin panel link / logo
			$customer_details = $this->customer_mdl->get_customer_details($user_id);
			$data['customer_details'] = $customer_details;
			
			//get customer details
			$shipping_address_details = $this->customer_mdl->get_shipping_address_details($user_id);
			$data['shipping_address_details'] = $shipping_address_details;
			
			// flag for the left menu to change the css of the active element
			$data['is_address_book_page']  = 1;
			
			//get turkey cities
			$this->load->module('addressman');
			$data['cities_tr'] = $this->addressman->get_cities_tr();
			$data['counties_tr'] = $this->addressman->get_all_counties_tr();
			
			$data['words'] 		  = $this->msg->get_words("customer_my_address_book");
			$data['lwords'] 	  = $this->msg->get_words("customer_left_menu");
			
			$header_data['words'] = $this->msg->get_words("header");
			$footer_data['words'] = $this->msg->get_words("footer");
			
			// for template_info
			$this->load->model('home_mdl');
			
			$data['template_info']   = $this->home_mdl->get_template_info();
	        $this->load->view($data['template_info']['path'].'/common/css_https',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header_https',$header_data);  
	         
	        $this->load->view($data['template_info']['path'].'/customer_my_address_book_vew', $data);
	        
	        $this->load->view($data['template_info']['path'].'/common/footer_https',$footer_data);  
	        $this->load->view($data['template_info']['path'].'/common/script_my_address_book_https'); 
		}
		// session expired send mwssage to inform customer
		else
		{
			$this->my_account();
			
		}
		
	}
	
	public function get_customer_details($id)
	{
		//check session from expiration 
		$session_flag = $this->session->userdata("user_id");
		
		if(!empty($session_flag))
		{
			$customer_details = $this->customer_mdl->get_customer_details($id);
			return $customer_details;
		}
		else
		{
			//redirect to login screen 
			return FALSE;
		}
	}
	
	public function get_customer_delivery_addresses($customer_id)
	{
		$delivery_addresses_ids =  $this->customer_mdl->get_customer_address_delivery_id($customer_id);
		$customer_delivery_addresses = array();
		foreach($delivery_addresses_ids as $delivery_addresse_id)
		{
			$customer_delivery_address_arr = $this->customer_mdl->get_address_details($delivery_addresse_id->address_delivery_id);
			$customer_delivery_addresses[] = $customer_delivery_address_arr[0] ;	
		}
		
		if(!empty($customer_delivery_addresses))
		{
			return $customer_delivery_addresses;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_customer_invoice_addresses($customer_id)
	{
		$customer_invoice_address_id_arr = $this->customer_mdl->get_customer_address_invoice_id($customer_id);
		//$oo = 55 ;
		if(!empty($customer_invoice_address_id_arr))
		{
			$customer_invoice_address =   $this->customer_mdl->get_address_details($customer_invoice_address_id_arr[0]->address_invoice_id);
		}
		if(isset($customer_invoice_address))
		{
			return $customer_invoice_address;
		}
		else
		{
			return NULL;	
		}
	}
	
	//to be called via ajax 
	public function get_address_details($address_id)
	{
		$customer_delivery_address_arr = $this->customer_mdl->get_address_details($address_id);
		$customer_delivery_address = $customer_delivery_address_arr[0] ;
		$json_customer_delivery_address = json_encode($customer_delivery_address);
		echo $json_customer_delivery_address;
	}
	
	public function get_address_details_no_ajax($address_id)
	{
		$address_details_arr = $this->customer_mdl->get_address_details($address_id);
		if(!empty($address_details_arr[0]))
		{
			return $address_details_arr[0];
		}
		else
			return NULL;
	}
	
	public function update_address($customer_address_billing_id,$billing_address)
	{
		
		$flag = $this->customer_mdl->update_address($customer_address_billing_id,$billing_address);
		return $flag;
	}
	
	public function update_password()
	{
		
		//get the user_id from the session 
		$user_id =  $this->session->userdata("user_id");
		
		// if the session did not expire
		if(!empty($user_id))
		{
			$old_pwd = $this->input->post("old_pass");
			$new_pwd = $this->input->post("new_pass");
			$new_pwd_cc = $this->input->post("new_pass_cc");
			
			if($new_pwd == $new_pwd_cc)
			{
				//get customer details
				$customer_details = $this->customer_mdl->get_customer_details($user_id);
				
				$crypted_old_pwd = md5(sha1($old_pwd));
				$db_pwd = $customer_details[0]->password;
				
				//check if old password typed in the form matches the one from the database
				if($crypted_old_pwd == $db_pwd)
					{
						//update password 
						$crypted_new_pwd = md5(sha1($new_pwd));
						$update_flag = $this->customer_mdl->update_customer_password($user_id,$crypted_new_pwd);
						if($update_flag)
							echo("password updated");
						else
							echo("failed to update password");
						
						/*echo "<pre>";
						print_r($update_flag);
						echo "</pre>";*/
					}
				else
				{
					//password mismatch			
					echo "did you forget your password ? if so you can always reset it to get a new password sent to your email, read our <a href='faq'>FAQ</a> for more information about reseting your email";
				}
			}
			else
			{
				echo("password mismatch, make sure the new password and the confirmed password fields are identical ");
			}
			
			/*
			
			// for template_info
			$this->load->model('home_mdl');
			
			$data['template_info']   = $this->home_mdl->get_template_info();
	        $this->load->view($data['template_info']['path'].'/common/css',$data);  
	        $this->load->view($data['template_info']['path'].'/common/header');  
	         
	        $this->load->view($data['template_info']['path'].'/customer_password_vew', $data);
	        
	        $this->load->view($data['template_info']['path'].'/common/footer');  
	        $this->load->view($data['template_info']['path'].'/common/script'); */
		}
		// session expired send message to inform customer
		else
		{
			//redirect to login screen 
			$this->load->helper('url');
			redirect(base_url()."login");
			
		}
	} 

	// called via ajax from customer admin panel -> my addresses 
	public function add_new_shipping_address()
	{
		$user_id 	= $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			//shipping address data
			$delivery_address1 	= $this->input->get('address1',TRUE);
			$delivery_address2 	= $this->input->get('address2',TRUE);
			$delivery_address3 	= $this->input->get('address3',TRUE);
			$delivery_city 		= $this->input->get('city',TRUE);
			$delivery_region 	= $this->input->get('region',TRUE);
			$delivery_zipcode 	= $this->input->get('zipcode',TRUE);
			$delivery_country 	= $this->input->get('country',TRUE);
			
			
			$delivery_address = array("address1"=>$delivery_address1 , "address2"=>$delivery_address2, "address3"=>$delivery_address3, "city"=>$delivery_city, "region"=>$delivery_region, "zipcode"=>$delivery_zipcode, "country"=>$delivery_country);
			$oo = 55;
			
			if(!empty($delivery_address1) and !empty($delivery_address2) and !empty($delivery_city) and !empty($delivery_zipcode) and !empty($delivery_country) )
			{
				$oo = 55;
				//success
				echo(1);
			
				//create an address for the  customer
				$this->add_address($delivery_address);
						
				// link customer to address get the lasd customer id from customers and the last address id from addresses and link them
				$this->link_customer_address($user_id,'SHIPPING');	
			}
			else
			{
				//fail
				echo(0);
			}
		}
	}
	
	public function delete_address()
	{
		$user_id 	= $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			
			$address_id = (int)$this->input->get('address_id',TRUE);
			// desactivate the address
			$flag = $this->customer_mdl->disable_address($address_id);
			
			$oo = 55 ; 
			echo 1;
		}
	}
	
	//called via ajax
	public function customer_update_address()
	{
		//shipping address data
			$address_id = (int)$this->input->get('address_id',TRUE);
			$address1 	= $this->input->get('address1',TRUE);
			$address2 	= $this->input->get('address2',TRUE);
			$address3 	= $this->input->get('address3',TRUE);
			$city 		= $this->input->get('city',TRUE);
			$region 	= $this->input->get('region',TRUE);
			$zipcode 	= $this->input->get('zipcode',TRUE);
			$country 	= $this->input->get('country',TRUE);
			
			if(!empty($address_id) and !empty($address1) and !empty($address2) and !empty($city) and !empty($zipcode) and !empty($country) )
			{
				$oo = 55 ; 
				$address_details = array("id"=>$address_id ,"address1"=>$address1 , "address2"=>$address2, "address3"=>$address3, "city"=>$city, "region"=>$region, "zipcode"=>$zipcode, "country"=>$country);
				
				$flag = $this->customer_mdl->customer_update_address($address_details);
				
				$oo = 55 ; 
				if($flag)
				echo 1;
			}
			else
			{
				//fail all * fields must be filled
				echo 0;
				
			}
	}
	
	// new add form 
	public function add_new()
	{
		$token_value_from_form 			= $this->input->post('lastvisit_stmp2',TRUE);
		$token_session					= $this->security->get_csrf_hash();
		
		//check token 1st 
		if($token_value_from_form == $token_session)
		{
			
			$form_data = $this->input->post();
			
			/*echo "<pre>";
			var_dump($form_data);
			echo "</pre>";*/
			
			$na_firstname 			= $this->input->post('na_firstname',TRUE);
			$na_lastname 			= $this->input->post('na_lastname',TRUE);
			$na_sha_line1 			= $this->input->post('na_sha_line1',TRUE);
			$na_sha_line2 			= $this->input->post('na_sha_line2',TRUE);
			$na_country_select 		= $this->input->post('na_country_select',TRUE);
			$na_city_select 		= $this->input->post('na_city_select',TRUE);
			$na_county_select 		= $this->input->post('na_county_select',TRUE);
			$na_zip 				= $this->input->post('na_zip',TRUE);
			$na_month_select 		= $this->input->post('na_month_select',TRUE);
			$na_date_select 		= $this->input->post('na_date_select',TRUE);
			$na_year_select 		= $this->input->post('na_year_select',TRUE);
			$na_gender 				= $this->input->post('na_gender',TRUE);
			$na_email 				= $this->input->post('na_email',TRUE);
			$na_confirm_email 		= $this->input->post('na_confirm_email',TRUE);
			$na_login_password 		= $this->input->post('na_login_password',TRUE);
			$na_confirm_password 	= $this->input->post('na_confirm_password',TRUE);
			$na_primary_lang 		= $this->input->post('na_primary_lang',TRUE);
			$na_newsletter			= $this->input->post('na_newsletter',TRUE);
			$na_phone				= $this->input->post('na_phone',TRUE);
			
			$ssl_port_num    = ":".SSL_PORT;  // :443 is the default
			$base_url_str    = base_url();
			$sbu             = str_replace("http","https",$base_url_str );
			$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
			//lets regex /////////////////////
			
			//firstname
			
			$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\()|(.*\\))|(.*\\=)|(.*\\:)|(.*\\;)/"; 
	        preg_match($re, $na_firstname, $matches1);
	        if(!empty($matches1[0])) redirect( $secure_base_url."customer/my_profile" ) ;
			
			//lastname
			
			$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\()|(.*\\))|(.*\\=)|(.*\\:)|(.*\\;)/"; 
	        preg_match($re, $na_lastname, $matches2);
	        if(!empty($matches2[0])) redirect( $secure_base_url."customer/my_profile" ) ;
			
			//shipping address line 1
			
			$re = "/(.*\\+)|(.*\\=)|(.*%)|(.*\\$)|(.*\\~)|(.*\\{)|(.*\\})|(.*\\^)|(.*\\*)|(.*\\;)|(.*\\\\)/"; 
	        preg_match($re, $na_sha_line1, $matches3);
	        if(!empty($matches3[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        //shipping address line 2
	        $re = "/(.*\\+)|(.*\\=)|(.*%)|(.*\\$)|(.*\\~)|(.*\\{)|(.*\\})|(.*\\^)|(.*\\*)|(.*\\;)|(.*\\\\)/"; 
	        preg_match($re, $na_sha_line2, $matches4);
	        if(!empty($matches4[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        //zip code
	        
			$re = "/^\d{5}(?:[-\s]\d{4})?$/"; 
	        preg_match($re, $na_zip, $matches5);
	        if(empty($matches5[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        // email
			$re = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/"; 
	        preg_match($re, $na_email, $matches6);
	        if(empty($matches6[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        //if email already exists (if javascripst did not stop user prior backend)  send him to login page
	        $email_in_db = $this->check_customer($na_email);
	        if($email_in_db) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        //confirm email
	        
			$re = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/"; 
	        preg_match($re, $na_confirm_email, $matches7);
	        if(empty($matches7[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        //password
			$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\-)|(.*\\|)|(.*\\/)|(.* )|(.*%)/"; 
	        preg_match($re, $na_login_password, $matches8);
	        if(!empty($matches8[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        // confirm password
			$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\-)|(.*\\|)|(.*\\/)|(.* )|(.*%)/"; 
	        preg_match($re, $na_confirm_password, $matches9);
	        if(!empty($matches9[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        //phone
	        $re = "/(.*\\=)|(.*,)|(.*\\\\)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\=)|(.*\\:)|(.*\\;)|[a-w]|[y-z]|[A-W]|[Y-Z]/"; 
	        preg_match($re, $na_phone, $matches10);
	        if(!empty($matches10[0])) $na_phone = "" ;
			
			//country
			if (empty($na_country_select)) $na_country_select = "1"; // 1 for turkey 2 for usa
			
			//city
			if (empty($na_city_select)) $na_city_select = "1"; // 1 Adanna
			
			//county
			if (empty($na_city_select)) $na_city_select = "1"; // 1 Seyhan
			
			//month
			$na_month_select = str_replace(' ', '', $na_month_select);
			if (empty($na_month_select)) $na_month_select = "1"; // 1 for jan
			
			//date
			$na_date_select = str_replace(' ', '', $na_date_select);
			if (empty($na_date_select)) $na_date_select = "1"; // 1st of the month
			
			//year
			$na_year_select = str_replace(' ', '', $na_year_select);
			if (empty($na_year_select)) $na_year_select = "1920"; // year 1920
			
			//gender		
			if (empty($na_gender)) $na_gender = "2"; // 2 for woman
			
			//primary language 
			if (empty($na_primary_lang)) $na_primary_lang = "2"; // 2 for english
			
			//newsletter
			if(!empty($na_newsletter)) $na_newsletter = 1 ; else $na_newsletter = 0;
			
			
			$customer['firstname']			=	$na_firstname ;
			$customer['lastname']			=	$na_lastname ;
			$customer['month_select']		=	$na_month_select ;
			$customer['date_select']		=	$na_date_select ;
			$customer['year_select']		=	$na_year_select ;
			$customer['gender']				=	$na_gender ;
			$customer['email']				=	$na_email ;
			$customer['confirm_email']		=	$na_confirm_email ;
			$customer['password']			=	$na_login_password ;
			$customer['confirm_password']	=	$na_confirm_password;
			$customer['primary_lang']		=	$na_primary_lang ;
			$customer['newsletter']			=	$na_newsletter;
			$customer['phone']				=	$na_phone;
			$customer["status_id"]			=   1 ; // active
			
			$address["address1"] 	= $na_sha_line1;
        	$address["address2"]	= $na_sha_line2;
        	$address["address3"] 	= "";
        	$address["city"] 		= $na_city_select;
        	$address["region"] 		= $na_county_select;
        	$address["zipcode"] 	= $na_zip;
        	$address["country"] 	= $na_country_select;
        	$address['firstname']	=	$na_firstname ;
			$address['lastname']	=	$na_lastname ;
			
			// ok everything is ok//
			//now add the customer and shipping + billing address to db 
			
			$this->load->model('customer_mdl');
			$this->customer_mdl->save_customer($customer);
	
			//add address and link it as shipping address
			$this->customer_mdl->add_address($address);
			$this->link_customer_address(NULL,"SHIPPING");
			
			//add address and link it as billing address
			$this->customer_mdl->add_address($address);
			$this->link_customer_address(NULL,"BILLING");
			
			//send welcome to shopamerika email
			$user_id = $this->get_last_table_id('customers')[0]->last_id;
			
			//log user in 
			$this->session->set_userdata('user_id', $user_id);
			$this->session->set_userdata('first_name', $na_firstname);
				
			$this->load->module('emaily');
			$welcome_email_flag = $this->emaily->send_welcome($user_id);
			if($welcome_email_flag)
			{
				$ssl_port_num    = ":".SSL_PORT;  // :443 is the default
				$base_url_str    = base_url();
				$sbu             = str_replace("http","https",$base_url_str );
				$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
				 
				redirect( $secure_base_url."customer/my_account" ) ;	
			}
			else
			{
				echo('email failed!');
			}
			
			$oo = 55 ; 
			
			
		}
		else
		{
			//session expired or bot attack 
			redirect( base_url()."fdgdf/dfgfdg" ) ;
		}
		
	}
	
	public function update_profile()
	{
		$token_value_from_form 			= $this->input->post('lastvisit_stmp2',TRUE);
		$token_session					= $this->security->get_csrf_hash();
		
		//check token 1st 
		if($token_value_from_form == $token_session)
		{
			
			$na_firstname 			= $this->input->post('na_firstname',TRUE);
			$na_lastname 			= $this->input->post('na_lastname',TRUE);
			$na_sha_line1 			= $this->input->post('na_sha_line1',TRUE);
			$na_sha_line2 			= $this->input->post('na_sha_line2',TRUE);
			$na_country_select 		= $this->input->post('na_country_select',TRUE);
			$na_city_select 		= $this->input->post('na_city_select',TRUE);
			$na_county_select 		= $this->input->post('na_county_select',TRUE);
			$na_zip 				= $this->input->post('na_zip',TRUE);
			$na_month_select 		= $this->input->post('na_month_select',TRUE);
			$na_date_select 		= $this->input->post('na_date_select',TRUE);
			$na_year_select 		= $this->input->post('na_year_select',TRUE);
			$na_gender 				= $this->input->post('na_gender',TRUE);
			$na_email 				= $this->input->post('na_email',TRUE);
			$na_confirm_email 		= $this->input->post('na_confirm_email',TRUE);
			$na_login_password 		= $this->input->post('na_login_password',TRUE);
			$na_confirm_password 	= $this->input->post('na_confirm_password',TRUE);
			$na_primary_lang 		= $this->input->post('na_primary_lang',TRUE);
			$na_newsletter			= $this->input->post('na_newsletter',TRUE);
			$na_phone				= $this->input->post('na_phone',TRUE);
			
			$ssl_port_num    = ":".SSL_PORT;  // :443 is the default
			$base_url_str    = base_url();
			$sbu             = str_replace("http","https",$base_url_str );
			$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
			
			//lets regex /////////////////////
			
			//firstname
			
			$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\()|(.*\\))|(.*\\=)|(.*\\:)|(.*\\;)/"; 
	        preg_match($re, $na_firstname, $matches1);
	        if(!empty($matches1[0])) redirect( $secure_base_url."customer/my_profile" ) ;
			
			//lastname
			
			$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\()|(.*\\))|(.*\\=)|(.*\\:)|(.*\\;)/"; 
	        preg_match($re, $na_lastname, $matches2);
	        if(!empty($matches2[0])) redirect( $secure_base_url."customer/my_profile" ) ;
			
			//shipping address line 1
			
			$re = "/(.*\\+)|(.*\\=)|(.*%)|(.*\\$)|(.*\\~)|(.*\\{)|(.*\\})|(.*\\^)|(.*\\*)|(.*\\;)|(.*\\\\)/"; 
	        preg_match($re, $na_sha_line1, $matches3);
	        if(!empty($matches3[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        //shipping address line 2
	        $re = "/(.*\\+)|(.*\\=)|(.*%)|(.*\\$)|(.*\\~)|(.*\\{)|(.*\\})|(.*\\^)|(.*\\*)|(.*\\;)|(.*\\\\)/"; 
	        preg_match($re, $na_sha_line2, $matches4);
	        if(!empty($matches4[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        //zip code
	        
			$re = "/^\d{5}(?:[-\s]\d{4})?$/"; 
	        preg_match($re, $na_zip, $matches5);
	        if(empty($matches5[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        // email
			$re = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/"; 
	        preg_match($re, $na_email, $matches6);
	        if(empty($matches6[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        //confirm email
	        
			$re = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/"; 
	        preg_match($re, $na_confirm_email, $matches7);
	        if(empty($matches7[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        //password
			$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\-)|(.*\\|)|(.*\\/)|(.* )|(.*%)/"; 
	        preg_match($re, $na_login_password, $matches8);
	        if(!empty($matches8[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        // confirm password
			$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\-)|(.*\\|)|(.*\\/)|(.* )|(.*%)/"; 
	        preg_match($re, $na_confirm_password, $matches9);
	        if(!empty($matches9[0])) redirect( $secure_base_url."customer/my_profile" ) ;
	        
	        //phone
	        $re = "/(.*\\=)|(.*,)|(.*\\\\)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\=)|(.*\\:)|(.*\\;)|[a-w]|[y-z]|[A-W]|[Y-Z]/"; 
	        preg_match($re, $na_phone, $matches10);
	        if(!empty($matches10[0])) $na_phone = "" ;
			
			//country
			if (empty($na_country_select)) $na_country_select = "1"; // 1 for turkey 2 for usa
			
			//city
			if (empty($na_city_select)) $na_city_select = "1"; // 1 Adanna
			
			//county
			if (empty($na_city_select)) $na_city_select = "1"; // 1 Seyhan
			
			//month
			$na_month_select = str_replace(' ', '', $na_month_select);
			if (empty($na_month_select)) $na_month_select = "1"; // 1 for jan
			
			//date
			$na_date_select = str_replace(' ', '', $na_date_select);
			if (empty($na_date_select)) $na_date_select = "1"; // 1st of the month
			
			//year
			$na_year_select = str_replace(' ', '', $na_year_select);
			if (empty($na_year_select)) $na_year_select = "1920"; // year 1920
			
			//gender		
			if (empty($na_gender)) $na_gender = "2"; // 2 for woman
			
			//primary language 
			if (empty($na_primary_lang)) $na_primary_lang = "2"; // 2 for english
			
			//newsletter
			if(!empty($na_newsletter)) $na_newsletter = 1 ; else $na_newsletter = 0;
			
			
			$customer['firstname']			=	$na_firstname ;
			$customer['lastname']			=	$na_lastname ;
			$customer['month_select']		=	$na_month_select ;
			$customer['date_select']		=	$na_date_select ;
			$customer['year_select']		=	$na_year_select ;
			$customer['gender']				=	$na_gender ;
			$customer['email']				=	$na_email ;
			$customer['confirm_email']		=	$na_confirm_email ;
			$customer['password']			=	$na_login_password ;
			$customer['confirm_password']	=	$na_confirm_password;
			$customer['primary_lang']		=	$na_primary_lang ;
			$customer['newsletter']			=	$na_newsletter;
			$customer['phone']				=	$na_phone;
			$customer["status_id"]			=   1 ; // active
			$customer["id"] = $this->session->userdata('user_id');
			
			$address["address1"] 	= $na_sha_line1;
        	$address["address2"]	= $na_sha_line2;
        	$address["address3"] 	= "";
        	$address["city"] 		= $na_city_select;
        	$address["region"] 		= $na_county_select;
        	$address["zipcode"] 	= $na_zip;
        	$address["country"] 	= $na_country_select;
			
			if( $na_login_password == 'stUZaW000M3W7')
			{
				//password was not changed
				$new_password = "";
			}
			else
			{
				$new_password = $na_login_password;
			}
			
			$customer['password']			=	$new_password ;
			
			// ok everything is ok//
			//now add the customer and shipping + billing address to db 
			
			$this->load->model('customer_mdl');
			$this->customer_mdl->update_customer_details($customer);
			
			$customer_id = $this->session->userdata('user_id');
			$billing_address_id = $this->customer_mdl->get_billing_address_id($customer_id)[0];
			$this->customer_mdl->update_billing_address($billing_address_id->id,$address);
			
			//echo "profile updated";
			$ssl_port_num = ":".SSL_PORT;  // :443 is the default
			$base_url_str = base_url(); 
			$sbu = str_replace("http","https",$base_url_str );
			$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
			
			
			redirect( $secure_base_url."customer/my_profile?profile_updated=1" ) ;
			
			$oo = 55 ; 
			
			
		}
		else
		{
			//session expired or bot attack 
			redirect( $secure_base_url."fdgdf/dfgfdg" ) ;
		}
	}
	
	public function xupdate_email_and_phone()
	{
		
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
				
			$phone = $this->input->post('phone',TRUE);
			
			$errors = 0;
		        
		    //phone
		    $re = "/(.*\\=)|(.*,)|(.*\\\\)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\=)|(.*\\:)|(.*\\;)|[a-w]|[y-z]|[A-W]|[Y-Z]/"; 
		    preg_match($re, $phone, $matches10);
		    if(!empty($matches10[0])) $errors = 1 ;
		        
			if($errors == 0)
			{
				//no problem proceed to update 
				$update_flag = $this->customer_mdl->update_customer_email_phone($user_id,$phone);
				if($update_flag) 
				{
					echo "updated";
				}
				else
				{
					echo "update_failed";
				}
			}
			else
			{
				echo "error_phone";
			}
		}
		else
		{
			echo "session_expired"	;
		}
		
	}
	
	public function add_update_shipping_address()
	{
		/////////////////////////////////backend filter /////////////////////////////////////////
		$token_value_from_form 			= $this->input->post('lastvisit_stmp2',TRUE);
		$token_session					= $this->security->get_csrf_hash();
		
		//check token 1st 
		if($token_value_from_form == $token_session)
		{
			
			$na_attention			= $this->input->post('na_attention',TRUE);
			$na_firstname 			= $this->input->post('na_firstname',TRUE);
			$na_lastname 			= $this->input->post('na_lastname',TRUE);
			$na_sha_line1 			= $this->input->post('na_sha_line1',TRUE);
			$na_sha_line2 			= $this->input->post('na_sha_line2',TRUE);
			$na_country_select 		= $this->input->post('na_country_select',TRUE);
			$na_city_select 		= $this->input->post('na_city_select',TRUE);
			$na_county_select 		= $this->input->post('na_county_select',TRUE);
			$na_zip 				= $this->input->post('na_zip',TRUE);
			$na_phone				= $this->input->post('na_phone',TRUE);
			
			$ssl_port_num    = ":".SSL_PORT;  // :443 is the default
			$base_url_str    = base_url();
			$sbu             = str_replace("http","https",$base_url_str );
			$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
			
			//lets regex /////////////////////
			
			//attention
			if(!empty($na_attention))
			{
				$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\()|(.*\\))|(.*\\=)|(.*\\:)|(.*\\;)/"; 
		        preg_match($re, $na_firstname, $matches_attention);
	   		    if(!empty($matches_attention[0])) redirect( $secure_base_url."customer/my_address_book" ) ;
			}
			
			//firstname
			
			$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\()|(.*\\))|(.*\\=)|(.*\\:)|(.*\\;)/"; 
	        preg_match($re, $na_firstname, $matches1);
	        if(!empty($matches1[0])) redirect( $secure_base_url."customer/my_address_book" ) ;
			
			//lastname
			
			$re = "/(.*\\+)|(.*\\=)|(.*,)|(.*\\\\)|(.*\\+)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\()|(.*\\))|(.*\\=)|(.*\\:)|(.*\\;)/"; 
	        preg_match($re, $na_lastname, $matches2);
	        if(!empty($matches2[0])) redirect( $secure_base_url."customer/my_address_book" ) ;
			
			//shipping address line 1
			
			$re = "/(.*\\+)|(.*\\=)|(.*%)|(.*\\$)|(.*\\~)|(.*\\{)|(.*\\})|(.*\\^)|(.*\\*)|(.*\\;)|(.*\\\\)/"; 
	        preg_match($re, $na_sha_line1, $matches3);
	        if(!empty($matches3[0])) redirect( $secure_base_url."customer/my_address_book" ) ;
	        
	        //shipping address line 2
	        $re = "/(.*\\+)|(.*\\=)|(.*%)|(.*\\$)|(.*\\~)|(.*\\{)|(.*\\})|(.*\\^)|(.*\\*)|(.*\\;)|(.*\\\\)/"; 
	        preg_match($re, $na_sha_line2, $matches4);
	        if(!empty($matches4[0])) redirect( $secure_base_url."customer/my_address_book" ) ;
	        
	        //zip code
	        
			$re = "/^\d{5}(?:[-\s]\d{4})?$/"; 
	        preg_match($re, $na_zip, $matches5);
	        if(empty($matches5[0])) redirect( $secure_base_url."customer/my_address_book" ) ;
	        
	     
	        
	        //phone
	        $re = "/(.*\\=)|(.*,)|(.*\\\\)|(.*\\|)|(.*\\/)|(.*%)|(.*#)|(.*\\$)|(.*\\@)|(.*\\~)|(.*\\?)|(.*\\>)|(.*\\<)|(.*\\!)|(.*\\[)|(.*\\])|(.*\\{)|(.*\\})|(.*\\^)|(.*\\&)|(.*\\*)|(.*\\=)|(.*\\:)|(.*\\;)|[a-w]|[y-z]|[A-W]|[Y-Z]/"; 
	        preg_match($re, $na_phone, $matches10);
	        if(!empty($matches10[0])) $na_phone = "" ;
			
			//country
			if (empty($na_country_select)) $na_country_select = "1"; // 1 for turkey 2 for usa
			
			//city
			if (empty($na_city_select)) $na_city_select = "1"; // 1 Adanna
			
			//county
			if (empty($na_city_select)) $na_city_select = "1"; // 1 Seyhan
			
			
			
			$user_id = $this->session->userdata('user_id');
			
			$address['attention']			=	$na_attention ;
			$address['firstname']			=	$na_firstname ;
			$address['lastname']			=	$na_lastname ;
			$address['phone']				=	$na_phone;
			$address["address1"] 	= $na_sha_line1;
        	$address["address2"]	= $na_sha_line2;
        	$address["address3"] 	= "";
        	$address["city"] 		= $na_city_select;
        	$address["region"] 		= $na_county_select;
        	$address["zipcode"] 	= $na_zip;
        	$address["country"] 	= $na_country_select;
			
			
				
			
			//////////////////////////////////////////////////// add or update ////////////////////////////
			$data = $this->input->post();	
			
			echo "<pre>";
			var_dump($data);
			echo "</pre>";
        	
        	$address["id"] 	= $data['address_id'];
			
			$this->load->model('customer_mdl');
			
			if($data['address_id'] == 'new' )
			{
				echo 'add address ' 	;
				$this->customer_mdl->add_shipping_address($address);
				$this->link_customer_address($user_id,"SHIPPING");
				redirect( $secure_base_url."customer/my_address_book?address_added=1" );
			}
			else
			{
				echo 'update address ' 	;
				$this->customer_mdl->update_shipping_address($address);
				redirect( $secure_base_url."customer/my_address_book?address_updated=1" );
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			$oo = 55 ; 
			
			
		}
		else
		{
			//session expired or bot attack 
			redirect( $secure_base_url."customer/my_address_book" ) ;
		}
		
		
		
	}
	



}

/* End of file customer.php */
/* Location: ./application/controllers/customer.php */