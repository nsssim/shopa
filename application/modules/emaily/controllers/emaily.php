<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Class responsible for sending and collecting emails 
* info :  config the email library PHPMailer @link https://github.com/PHPMailer/PHPMailer
*/
class emaily extends MX_Controller 
{
	 function __construct()
    {
        parent::__construct();
        
		$this->load->module('msg');

    }
 
 	// info :  config the email library PHPMailer @link https://github.com/ivantcholakov/codeigniter-phpmailer
 	   
	//is welcome to shopamerika 
	/**
	* this function send a welcome email upon account creation
	* 
	* @param int $user_id
	* 
	* @return true if success
	*/
	public function send_welcome($user_id)
	{
		$this->load->model('emaily_mdl');
		$user_data = $this->emaily_mdl->get_user_details($user_id)[0];
		$data['user'] = $user_data;
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
		
		$this->load->module("lists");
		$data['featured_items'] = $this->lists->get_featured_items_4_emails();
		
		$words = $this->msg->get_words("email_welcome");
		$data['words'] = $words;
			
		//load view
		$email_html = $this->load->view('welcome_email_vew', $data,TRUE);
		
		//echo $email_html;
		
		//++++++++++++++++++++ send email++++++++++++++++++++//
	 	$email = $user_data->email;
	 	
	 	$email_flag = 0;
		{
			date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
		
			$subject = $words['subject']; //'Welcome to Shop Amerika!
		    
			$result = $this->smtp_sendmail($email,$subject,$email_html); 
		    
			// if ok email sent!
			if ( $result)
			{
				$email_flag = "ok";
			}
			else
			{
				$email_flag = "email_error";
				
			}
			
			//echo $email_flag;
			
			
		}
		//~~~~~~~~~~~~~~~~~~end send email~~~~~~~~~~~~~~~~~~//
	 	
	 	//return true if email was successfully sent 
	 	return $email_flag;
	}
   
	// is taken 
	
	/**
	*	this function will send email when an order is taken 
	* 
	* @param int $order_id
	* 
	* @return true if success
	*/
	public function send_order_is_taken($order_id)
	{
		$this->load->model('emaily_mdl');
		$order_data = $this->emaily_mdl->get_order_details($order_id)[0];
		$data['order_data'] = $order_data;
		
		//get address names from ids
		$r = $this->translate_address_id_to_name($order_data);
		$data['invoice_country_name']  			= 	$r['invoice_country_name'];
		$data['delivery_country_name'] 			= 	$r['delivery_country_name'];
		$data['tr_city_county_name_delivery']  	= 	$r['tr_city_county_name_delivery'];
		$data['tr_city_county_name_invoice']  	= 	$r['tr_city_county_name_invoice'];
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
		
		$this->load->module("lists");
		$data['featured_items'] = $this->lists->get_featured_items_4_emails();
		
		$words = $this->msg->get_words("order_taken_email");
		$data['words'] = $words;
		
		//load view
		$email_html = $this->load->view('order_taken_email_vew', $data,TRUE);
		
		//echo $email_html;
		
		//++++++++++++++++++++ send email++++++++++++++++++++//
		$this->load->module('msg');
	 	$email = $order_data->customer_email;
	 	$order_id = $order_data->order_id ;
	 	
	 	$email_flag = 0;
		{
			date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
		
			//Shop Amerika - your order #123456 has been confirmed! 
			$subject = $words['email_subject_part1'].$order_id.$words['email_subject_part2'] ;
		    
			
			$result = $this->smtp_sendmail($email,$subject,$email_html); 
		    
			// if ok email sent!
			if ( $result)
			{
				$email_flag = TRUE;
			}
			
			
		}
		//~~~~~~~~~~~~~~~~~~end send email~~~~~~~~~~~~~~~~~~//
	 	
	 	//return true if email was successfully sent 
	 	return $email_flag;
	}
	
	
	// is shipped email
	public function send_order_shipped($order_id)
	{
		$this->load->model('emaily_mdl');
		$order_data = $this->emaily_mdl->get_order_details($order_id)[0];
		$data['order_data'] = $order_data;
		
		//get address names from ids
		$r = $this->translate_address_id_to_name($order_data);
		$data['invoice_country_name']  			= 	$r['invoice_country_name'];
		$data['delivery_country_name'] 			= 	$r['delivery_country_name'];
		$data['tr_city_county_name_delivery']  	= 	$r['tr_city_county_name_delivery'];
		$data['tr_city_county_name_invoice']  	= 	$r['tr_city_county_name_invoice'];
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
		
		$this->load->module("lists");
		$data['featured_items'] = $this->lists->get_featured_items_4_emails();
		
		$words = $this->msg->get_words("order_shipped_email");
		$data['words'] = $words;
		
		//load view
		$email_html = $this->load->view('order_shipped_email_vew', $data,TRUE);
		
		//echo $email_html;
		
		//++++++++++++++++++++ send email ++++++++++++++++++++//
		$this->load->module('msg');
	 	$email = $order_data->customer_email;
	 	$order_id = $order_data->order_id ;
	 	
	 	$email_flag = 0;
		{
			date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
		
		    //Shop Amerika - your order #123456 has been shipped! 
			$subject = $words['email_subject_part1'].$order_id.$words['email_subject_part2'] ;

			$result = $this->smtp_sendmail($email,$subject,$email_html);
			 
			// if ok email sent!
			if ( $result)
			{
				$email_flag = TRUE;
			}
		}
		//~~~~~~~~~~~~~~~~~~end send email~~~~~~~~~~~~~~~~~~//
	 	
	 	//return true if email was successfully sent 
	 	return $email_flag;
	}
	
	
	
	//is is delivered email 
	public function send_order_delivered($order_id)
	{
		$this->load->model('emaily_mdl');
		$order_data = $this->emaily_mdl->get_order_details($order_id)[0];
		$data['order_data'] = $order_data;
		
		//get address names from ids
		$r = $this->translate_address_id_to_name($order_data);
		$data['invoice_country_name']  			= 	$r['invoice_country_name'];
		$data['delivery_country_name'] 			= 	$r['delivery_country_name'];
		$data['tr_city_county_name_delivery']  	= 	$r['tr_city_county_name_delivery'];
		$data['tr_city_county_name_invoice']  	= 	$r['tr_city_county_name_invoice'];
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
		
		$this->load->module("lists");
		$data['featured_items'] = $this->lists->get_featured_items_4_emails();
		
		$words = $this->msg->get_words("order_delivered_email");
		$data['words'] = $words;
		
		//load view
		$email_html = $this->load->view('order_delivered_email_vew', $data,TRUE);
		
		//echo $email_html;
		
		//++++++++++++++++++++ send email ++++++++++++++++++++//
		$this->load->module('msg');
	 	$email = $order_data->customer_email;
	 	$order_id = $order_data->order_id ;
	 	
	 	$email_flag = 0;
		{
			date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
		
			//Your Order # 123456 was delivered!
			$subject = $words['email_subject_part1'].$order_id.$words['email_subject_part2'] ;
		    
		   $result = $this->smtp_sendmail($email,$subject,$email_html);
		    
			// if ok email sent!
			if ( $result)
			{
				$email_flag = TRUE;
			}
		}
		//~~~~~~~~~~~~~~~~~~end send email~~~~~~~~~~~~~~~~~~//
	 	
	 	//return true if email was successfully sent 
	 	return $email_flag;
	}
	
	
	//is arrived to warehouse email 
	public function send_order_arrived_to_warehouse($order_id)
	{
		$this->load->model('emaily_mdl');
		$order_data = $this->emaily_mdl->get_order_details($order_id)[0];
		$data['order_data'] = $order_data;
		
		//get address names from ids
		$r = $this->translate_address_id_to_name($order_data);
		$data['invoice_country_name']  			= 	$r['invoice_country_name'];
		$data['delivery_country_name'] 			= 	$r['delivery_country_name'];
		$data['tr_city_county_name_delivery']  	= 	$r['tr_city_county_name_delivery'];
		$data['tr_city_county_name_invoice']  	= 	$r['tr_city_county_name_invoice'];
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
		
		$this->load->module("lists");
		$data['featured_items'] = $this->lists->get_featured_items_4_emails();
		
		$words = $this->msg->get_words("order_arrived_to_warehouse_email");
		$data['words'] = $words;
		
		//load view
		$email_html = $this->load->view('order_arrived_to_warehouse_email_vew', $data,TRUE);
		
		//echo $email_html;
		
		//++++++++++++++++++++ send email ++++++++++++++++++++//
		$this->load->module('msg');
	 	$email = $order_data->customer_email;
	 	$order_id = $order_data->order_id ;
	 	
	 	$email_flag = 0;
		{
			date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
		
			//Your Order # 123456 arrived to our warehouse
			$subject = $words['email_subject_part1'].$order_id.$words['email_subject_part2'] ;
		    
			$result = $this->smtp_sendmail($email,$subject,$email_html); 
		    
			// if ok email sent!
			if ( $result)
			{
				$email_flag = TRUE;
			}
		}
		//~~~~~~~~~~~~~~~~~~end send email~~~~~~~~~~~~~~~~~~//
	 	
	 	//return true if email was successfully sent 
	 	return $email_flag;
	}
	
	
	public function send_password_reset_link($user_id)
	{
		$csrf_hash = $this->security->get_csrf_hash();
		//echo $csrf_hash;
		if(!empty($csrf_hash))
		{
			$data['email_token'] = $csrf_hash.'_'.$user_id;
			
			$this->load->model('emaily_mdl');
			$user_data = $this->emaily_mdl->get_user_details($user_id)[0];
			$data['user'] = $user_data;
			
			// currency
			$this->load->module('currency');
			$this->currency->set_currency(); // no parameter ==> usd will be the default
			$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
			$RATE = $this->session->userdata("CUR_RATE");
			
			$data['currency'] = $CURRENCY;
			$data['rate'] = $RATE;
			
			$this->load->module("lists");
			$data['featured_items'] = $this->lists->get_featured_items_4_emails();
			
			$words = $this->msg->get_words("reset_password_link");
			$data['words'] = $words;
			
			//load view
			$email_html = $this->load->view('reset_password_link_vew', $data,TRUE);
			
			//echo $email_html; // for debugging
			
			//++++++++++++++++++++ send email++++++++++++++++++++//
			
			$this->load->module('msg');
		 	$email = $user_data->email;
		 	
		 	$email_flag = 0;
			{
				date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
			
				// reset your password 
				$subject = $words['subject_email'];
			    
				$result = $this->smtp_sendmail($email,$subject,$email_html);
				 
				// if ok email sent!
				if ( $result)
				{
					$email_flag = TRUE;
				}
			}
			
			//~~~~~~~~~~~~~~~~~~end send email~~~~~~~~~~~~~~~~~~//
		 	
		 	//return true if email was successfully sent 
		 	return $email_flag;
		}
		else
		{
			//return FALSE
			return 0;
		}
	}
	

	
	public function send_password_changed_notification($user_id)
	{
		
		$this->load->model('emaily_mdl');
		$user_data = $this->emaily_mdl->get_user_details($user_id)[0];
		$data['user'] = $user_data;
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
		
		$this->load->module("lists");
		$data['featured_items'] = $this->lists->get_featured_items_4_emails();
		
		$words = $this->msg->get_words("password_updated");
		$data['words'] = $words;
		
		//load view
		$email_html = $this->load->view('password_updated_vew', $data,TRUE);
		
		//echo $email_html; for debugging
		
		//++++++++++++++++++++ send email++++++++++++++++++++//
		
		$this->load->module('msg');
	 	$email = $user_data->email;
	 	
	 	$email_flag = 0;
		{
			date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
		
			$subject = $words['your_pwd_is_reset'] ; //'Your Password Has Been Reset! ;
		    
			 
			$result = $this->smtp_sendmail($email,$subject,$email_html);
			
			// if ok email sent!
			if ( $result)
			{
				$email_flag = TRUE;
			}
		}
		
		//~~~~~~~~~~~~~~~~~~end send email~~~~~~~~~~~~~~~~~~//
	 	
	 	//return true if email was successfully sent 
	 	return $email_flag;
	}
	
	
	//is xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx template method
	public function send_email_template($order_id)
	{
		$this->load->model('emaily_mdl');
		$order_data = $this->emaily_mdl->get_order_details($order_id)[0];
		$data['order_data'] = $order_data;
		
		//get address names from ids
		$r = $this->translate_address_id_to_name($order_data);
		$data['invoice_country_name']  			= 	$r['invoice_country_name'];
		$data['delivery_country_name'] 			= 	$r['delivery_country_name'];
		$data['tr_city_county_name_delivery']  	= 	$r['tr_city_county_name_delivery'];
		$data['tr_city_county_name_invoice']  	= 	$r['tr_city_county_name_invoice'];
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		
		$data['currency'] = $CURRENCY;
		$data['rate'] = $RATE;
		
		$this->load->module("lists");
		$data['featured_items'] = $this->lists->get_featured_items_4_emails();
		
		$words = $this->msg->get_words("xxxxxx");
		$data['words'] = $words;
		
		//load view
		$email_html = $this->load->view('order_shipped_email_vew', $data,TRUE);
		
		//echo $email_html;
		
		//++++++++++++++++++++ send email ++++++++++++++++++++//
		$this->load->module('msg');
	 	$email = $order_data->customer_email;
	 	$order_id = $order_data->order_id ;
	 	
	 	$email_flag = 0;
		{
			date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
		
			$subject = 'Shop Amerika - '.' your order #'.$order_id.' is xxxxxx '/*.$this->msg->get_translated_message(133)*/.' !';
		    
			 
			$result = $this->smtp_sendmail($email,$subject,$email_html);
			/*$this->email->from('no-reply@shopamerika.com','SHOPAMERIKA.COM');
			$this->load->library('email');
		    $body = $email_html ;
			$this->email->to($email);
			$this->email->subject($subject);
			$this->email->message($body);
			$result = $this->email->send();*/
		    
			// if ok email sent!
			if ( $result)
			{
				$email_flag = TRUE;
			}
		}
		//~~~~~~~~~~~~~~~~~~end send email~~~~~~~~~~~~~~~~~~//
	 	
	 	//return true if email was successfully sent 
	 	return $email_flag;
	}
	
	private function translate_address_id_to_name($order_data)
	{
		$tr_delivery_county_id 	= $order_data->delivery_address_country_province;
		$tr_delivery_city_id 	= $order_data->delivery_address_city;
		
		$tr_invoice_county_id 	= $order_data->invoice_address_country_province;
		$tr_invoice_city_id 	= $order_data->invoice_address_city;
		
		$tr_city_county_name_delivery  = $this->emaily_mdl->get_tr_city_county_name($tr_delivery_county_id,$tr_delivery_city_id);
		$data["tr_city_county_name_delivery"] = $tr_city_county_name_delivery ;
		
		$tr_city_county_name_invoice  = $this->emaily_mdl->get_tr_city_county_name($tr_invoice_county_id,$tr_invoice_city_id);
		$data["tr_city_county_name_invoice"] = $tr_city_county_name_invoice ;
		
		if($order_data->delivery_address_coutry)
		{
			$delivery_country_name 	= "Turkey";
		}
		else
		{
			$delivery_country_name 	= "USA";
			
		}
		
		if($order_data->invoice_address_coutry)
		{
			$invoice_country_name = "Turkey";
		}
		else
		{
			$invoice_country_name = "USA";
			
		}
		
		$data['invoice_country_name'] = $invoice_country_name;
		$data['delivery_country_name'] = $delivery_country_name;
		
		return $data;
	}
	
	/**
	* this is a test email method just to test the email settings
	* 
	* @return
	*/
	public function hello0()
	{
		//date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
	
		require_once(APPPATH."libraries/phpmailer/PHPMailerAutoload.php");
		
		$mail = new phpmailer();
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		$mail->CharSet = 'UTF-8';
		$mail->SMTPSecure = 'tls'; // or ssl
		$mail->SMTPAuth = true;
		$mail->SMTPDebug = 3;
		$mail->Debugoutput = 'html';
		$mail->Host = "smtp.zoho.com";
		$mail->Port = 587;// 25, 465 for ssl or 587 for tls
		$mail->Username = 'no_reply@shopamerika.com';
		$mail->Password = '!s115599';
		$mail->setFrom('no_reply@shopamerika.com','shopamerika.com');
		$mail->addReplyTo('no_reply@shopamerika.com', 'shopamerika.com');
		$mail->addAddress('nsssim@gmail.com',"Nassim B");
		$mail->Subject = 'PHPMailer SMTP test from Hello';
		$mail->isHTML(true);
		$body_html = '<html>
					  <head>
						<title> Hello from  SHOPAMERIKA.COM </title>
						<meta name="viewport" content="width=device-width" />
					  </head>
					  <body>
					    Email is working fine ! <br/>
					    <p>Lorem ipsum dolor sit amet, nulla id magna. Auctor dui luctus incididunt, urna sed ornare, orci curae quisque, congue et a odio lectus ut. Augue id dolor consequat, eu eu mauris tellus tellus nec, in erat magna volutpat aliquam risus sit, mauris id mauris vestibulum. Donec egestas, nunc vel id. Auctor nulla vehicula turpis vel, faucibus gravida felis vestibulum, officia duis varius scelerisque vivamus, eleifend sed ipsum lacinia leo, augue semper a ipsum platea. Varius vivamus sed sit dis pede odio. Ante suscipit neque, justo at erat wisi fringilla, impedit malesuada pellentesque vitae nisl, eget nonummy dolor in et.</p>
					  </body>
					</html>';
		$mail->Body = $body_html;
		//$mail->AltBody = 'This is a plain-text message body';
		
		//send the message, check for errors
		if (!$mail->send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		    echo "Message sent!";
		}

	}
	
	
	public function info()
	{
		phpinfo();
	}
	
	/**
	* this function is responsible for collection emails from the footer input
	* 
	* @return string "ok" or "error_email_exists"
	*/
	public function add_email_news()
	{
		$email = $this->input->post('email',TRUE);
		$email = strtolower($email);
		
		// email
		$re = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/"; 
        preg_match($re, $email, $matches6);
        if(empty($matches6[0])) 
        {
        	echo('error_email');
        }
        else
        {
			$this->load->model('emaily_mdl');
			//check if email already exists
			$email_from_db = $this->emaily_mdl->get_address($email);
			if(empty($email_from_db[0]->email))
			{
				//email does not exixts add it to the database 
				$this->emaily_mdl->add_email($email);
				echo("ok");
			}
			else{
				echo("error_email_exists");
			}
			
		}
	}
	
	/**
	* same as add_email_news but uses get instead of post 
	* 
	* @return string "ok" or "error_email_exists"
	*/
	public function add_email_news_get()
	{
		$email = $this->input->get('email',TRUE);
		$email = strtolower($email);
		
		// email
		$re = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/"; 
        preg_match($re, $email, $matches6);
        if(empty($matches6[0])) 
        {
        	echo('error_email');
        }
        else
        {
			$this->load->model('emaily_mdl');
			//check if email already exists
			$email_from_db = $this->emaily_mdl->get_address($email);
			if(empty($email_from_db[0]->email))
			{
				//email does not exixts add it to the database 
				$this->emaily_mdl->add_email($email);
				echo("ok");
			}
			else
			{
				echo("error_email_exists");
			}
			
		}
	}
	
	public function hello()
	{
		$email_flag = $this->smtp_sendmail("nassim@null.net","Howdy",'<h1>JUST A TEST from Hello !</h1>');
		echo $email_flag;
		
	}
	
	
	
	public function send_reminder($email_to)
	{
		$this->load->helper('url');
		date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
		
		$subject = 'Shop Amerika - Server payment reminder !';
		$body =
		'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			    <meta name="viewport" content="width=device-width" />
			    <title>payment reminder</title>
			    <link rel="stylesheet" type="text/css" href="'.base_url().'/assets/templates/eshopper/css/email.css" />
			</head>
			
			<body bgcolor="#FFFFFF">
		
			<p> Hello Mr Atilla, <br>
			This is an automated email from shopamerika.com to remind you of the server payment. today is the 8th of the month.<br>
			Have a nice day ! <br>
			
		
			</body>
		
		</html>';
		
		$this->smtp_sendmail($email_to,$subject,$body);
		
	}
	
	/**
	* my small PHPMailer wrapper function, can be configured from email_config.php
	* 
	* @param string $to to the person you want to send email to 
	* @param string $subject the subject of the email
	* @param string $msg_html the the content of the message in HTML or plain text
	* 
	* @return
	*/
	private function smtp_sendmail($to,$subject,$msg_html)
	{
		require_once(APPPATH."libraries/phpmailer/PHPMailerAutoload.php");
		
		$mail=new phpmailer;
		
		$this->config->load('email_config');
		
		$smtp_host 			 = $this->config->item('smtp_host');
		$security 			 = $this->config->item('security');
		$port 				 = $this->config->item('port');
		$shop_email 		 = $this->config->item('shop_email');
		$shop_email_password = $this->config->item('shop_email_password');
		$sent_from_email 	 = $this->config->item('sent_from_email');
		$sent_from_name 	 = $this->config->item('sent_from_name');
		$debug_level 		 = $this->config->item('debug_level');
		
		$mail->IsSMTP();
		$mail->Host=$smtp_host;
		// Enable this option to see deep debug info
		$mail->SMTPDebug = $debug_level; // set to 0 1 2 3 4  
		
		$mail->SMTPSecure = $security; // or ssl
		$mail->Port=$port; // 465 for ssl
		$mail->SMTPAuth=true;

		$mail->Username=$shop_email;
		$mail->Password=$shop_email_password;
		$mail->Debugoutput = 'html';
		$mail->isHTML(true);
		$mail->SetFrom($sent_from_email,$sent_from_name);
		$mail->Subject=$subject;
		//$mail->AltBody='To view the message, please use an HTML compatible email viewer!';
		$mail->MsgHTML($msg_html);
		$mail->AddAddress($to);
		$mail->CharSet = 'UTF-8';
		//$mail->AddAddress('nassim@koyuncubtm.com','Nassim B.');

		$email_flag = FALSE ; 
		if(!$mail->send()) 
		{
		    //echo 'Message could not be sent.';
		    //echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		else 
		{
		    //echo 'Message has been sent';
			$email_flag = TRUE ; 
		}
		
		return $email_flag;
		
	}
	
	
}

/* End of file admin.php */
/* Location: ./application/modules/controllers/emaily.php */