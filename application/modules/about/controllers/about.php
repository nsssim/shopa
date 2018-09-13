<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class about extends MX_Controller 
{
	
	function __construct()
    {
        $jproduct = NULL;
        parent::__construct();

		$this->load->module("lng");
		$this->load->module("msg");
		$this->load->module("seo");
    }
	
	public function index()
	{
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		$header_data['currency'] = $CURRENCY;
		$header_data['rate'] = $RATE;
		
		//session cleanup
		$this->load->module("sessman");
		$this->sessman->clean_up_session_table();
		
		
		$lang_id = $this->lng->get_n_set_language_id();			
		
		//SEO
		$data['meta_info']  =  $this->seo_mdl->get_meta_info("about_us",$lang_id);// get the meta info from database 
				
		// load the template manager
		$this->load->module('templateman');
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details 
		$template_path_info = $data['template_info']['path'];  
		
		//get wording for the page 
	   	$data['words'] = $this->msg->get_words("about");
	   	$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
		
        $this->load->view($template_path_info.'/common/css',$data);  
        $this->load->view($template_path_info.'/common/header',$header_data);  
       // $this->load->view($template_path_info.'/common/slider');  
        $this->load->view($template_path_info.'/about_vew',$data);  
        $this->load->view($template_path_info.'/common/footer',$footer_data);  
        $this->load->view($template_path_info.'/common/script');  
		
		//$this->load->view('index');
	}
	public function shipping()
	{
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		$header_data['currency'] = $CURRENCY;
		$header_data['rate'] = $RATE;
		
		//session cleanup
		$this->load->module("sessman");
		$this->sessman->clean_up_session_table();
		
		
		$lang_id = $this->lng->get_n_set_language_id();			
		
		//SEO
		$data['meta_info']  =  $this->seo_mdl->get_meta_info("shipping_info",$lang_id);// get the meta info from database 
				
		// load the template manager
		$this->load->module('templateman');
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details 
		$template_path_info = $data['template_info']['path'];  
		
		
		//get wording for the page 
	   	$data['words'] = $this->msg->get_words("shipping");
	   	$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
    
				
        $this->load->view($template_path_info.'/common/css',$data);  
        $this->load->view($template_path_info.'/common/header',$header_data);  
       // $this->load->view($template_path_info.'/common/slider');  
        $this->load->view($template_path_info.'/shipping_vew',$data);  
        $this->load->view($template_path_info.'/common/footer',$footer_data);  
        $this->load->view($template_path_info.'/common/script');  
		
		//$this->load->view('index');
	}
	
	public function returns()
	{
		//session cleanup
		$this->load->module("sessman");
		$this->sessman->clean_up_session_table();
		
		
		$lang_id = $this->lng->get_n_set_language_id();			
				
		// load the template manager
		$this->load->module('templateman');
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details 
		$template_path_info = $data['template_info']['path'];  
		
		//SEO
		$data['meta_info']  =  $this->seo_mdl->get_meta_info("returns",$lang_id);// get the meta info from database 
		
		//get wording for the page 
	   	$data['words'] = $this->msg->get_words("returns");
	   	$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
    
				
        $this->load->view($template_path_info.'/common/css',$data);  
        $this->load->view($template_path_info.'/common/header',$header_data);  
       // $this->load->view($template_path_info.'/common/slider');  
        $this->load->view($template_path_info.'/return_vew',$data);  
        $this->load->view($template_path_info.'/common/footer',$footer_data);  
        $this->load->view($template_path_info.'/common/script');  
		
		//$this->load->view('index');
	}
	
	public function contact($data = NULL )
	{
		
		// currency
		$this->load->module('currency');
		$this->currency->set_currency(); // no parameter ==> usd will be the default
		$CURRENCY = $this->session->userdata("CUR_SIGN"); //$CURRENCY= '$';
		$RATE = $this->session->userdata("CUR_RATE");
		$header_data['currency'] = $CURRENCY;
		$header_data['rate'] = $RATE;
		
		$data['email_was_sent'] = $data['email_was_sent'];
		//session cleanup
		$this->load->module("sessman");
		$this->sessman->clean_up_session_table();
		
		$lang_id = $this->lng->get_n_set_language_id();			
		
		// load the template manager
		$this->load->module('templateman');
		$data['template_info'] = $this->templateman->get_template_info(1); // get the template details 
		$template_path_info = $data['template_info']['path'];  
		
		//SEO
		$data['meta_info']  =  $this->seo_mdl->get_meta_info("contact_us",$lang_id);// get the meta info from database 
		
		//for the formula
		$data['var1']  =  mt_rand(1, 4);
		$data['var2']  =  mt_rand(1, 4);
		
		//get wording for the page 
	   	$data['words'] = $this->msg->get_words("contact_us");
	   	$header_data['words'] = $this->msg->get_words("header");
		$footer_data['words'] = $this->msg->get_words("footer");
	
        $this->load->view($template_path_info.'/common/css',$data);  
        $this->load->view($template_path_info.'/common/header',$header_data);  
        // $this->load->view($template_path_info.'/common/slider');  
        $this->load->view($template_path_info.'/contact_vew',$data);  
        $this->load->view($template_path_info.'/common/footer',$footer_data);  
        $this->load->view($template_path_info.'/common/script_contactus');  
		
		//$this->load->view('index');
	}
	
	public function contact_us() // form controller
	{
		
		$this->load->helper('url');
		$var1= $this->input->post('var1');
		$var2= $this->input->post('var2');
		$var3= $this->input->post('var3');
		if($var1 + $var2 == $var3)
		{
			//not a robot
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$subject = $this->input->post('subject');
			$message = $this->input->post('message');
			
			////////////////////////////////////////////////////////////////////////////
			// send email
			{
				date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
				$this->load->library('email');
			
				// config the email library PHPMailer @link https://github.com/ivantcholakov/codeigniter-phpmailer
				 
				$subject = 'Shop Amerika - Contact Form !';
			    //echo $verifiy_link; // for debugging
			    
				//-------------new body now using templates 
				$body =
				'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					    <meta name="viewport" content="width=device-width" />
					    <title>'.html_escape($subject).'</title>
					    <link rel="stylesheet" type="text/css" href="'.base_url().'/assets/templates/eshopper/css/email.css" />
					</head>
					
					<body bgcolor="#FFFFFF">
			
					<!-- BODY -->
					<table class="body-wrap">
						<tr>
							<td></td>
							<td class="container" bgcolor="#FFFFFF">
			
								<div class="content">
								<table>
									<tr>
										<td>
											
											<h3>From</h3>
											'.$email.'
											
											<h3>Message Content</h3>
											<p>'. $message .'</p>
										</td>
									</tr>
								</table>
								</div>
														
							</td>
							<td></td>
						</tr>
					</table><!-- /BODY -->
					
					</body>
				
				</html>';
				//end new body 
				 
				$this->email->from('no-reply@shopamerika.com','Shop Amerika');
				$this->email->to('customer_service@shopamerika.com');
				//$this->email->to('nassim@shopamerika.com');
				$this->email->subject($subject);
				$this->email->message($body);
				
				$result = $this->email->send();
			    
				if ( !$result)
				{
				    //$data["message_status"] = 'well that\'s embarassing ...we have a technical problem during emailing your verification email';
				    $data["message_status"] = $this->msg->get_translated_message(41);
				}
				else
				{
					// ok email sent!
					$data['email_was_sent'] = "ok" ; 
					$this->contact($data);
					//for debugging
					//$email_dbg = $this->email->print_debugger();
					
					//$this->msg->show(10);
					//echo("confirmation email, message sent!<br> Please check your email.<br>");
				}
				
			    /*var_dump($result);
			    echo '<br />';
			    echo $this->email->print_debugger();*/
				
			}
			//end send email
			////////////////////////////////////////////////////////////////////////////
			
			
			$oo = 55;
		}
		else
		{
			//probably a robot or a very young kid ... 
			$data['email_was_sent'] = "math_error" ; 
			$this->contact($data);
			
		}
	}
		
	
	public function error($param)
	{
		$this->load->helper('url');
		if($param == "lng") 
		{
			echo "you've been away for a long time your session expired .... " ;
			echo '<a href="'.base_url().'" >click here to go back</a>'	;	
		}
		$this->session->sess_destroy();
	}
	
	public function test()
	{
		$this->load->library('cleanurl');
		$z = "hi there what's up buddy ";
		$this->cleanurl->slug($z);
	}
	
	
	
	
	
}

/* End of file about.php */
/* Location: ./application/modules/about/controllers/about.php */