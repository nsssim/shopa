<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class msg extends MX_Controller 
{
 	function __construct()
    {
        parent::__construct();
       
        //$this->load->helper('url');

		// call cache module
		//$this->load->module("cachy");
		
		//load the language module
		$this->load->module("lng");
		
		//session cleanup
		$this->load->module("sessman");
		$this->sessman->clean_up_session_table();
		
		//loadfilter module
		//$this->load->module("filter");
		
		$this->load->helper('url');


    }
 
 
	// general purpose message function 
	public function show($msg_id,$xtra_data = NULL)
	{
	 	if(!empty($msg_id))
	 	{
			/*	
				old		new
				10  	110
				11		20
				500		30
				501		40	
				502		90
				503		50
				504		60
				505		41
				600		70	
				900		80	
			
			*/
			
			if($msg_id == 50)
			{
				$ssl_port_num = ":".SSL_PORT;  // :443 is the default
				$base_url_str = base_url(); 
				$sbu = str_replace("http","https",$base_url_str );
				$secure_base_url = str_replace(".com",".com$ssl_port_num",$sbu );
				
				redirect( $secure_base_url."customer/my_account" ) ; 
				
			}
			else
			{
				if(!empty($xtra_data)) 
				$data['xtra_data'] = $xtra_data;
				
				$data['lang_id'] = $this->lng->get_n_set_language_id();		
		 		
				//$data['msg_code'] = $msg_code;
				$data['msg_txt'] = $this->get_translated_message($msg_id);
				
				//
				$header_data['words'] = $this->get_words("header");
				$footer_data['words'] = $this->get_words("footer");
					
		 		// for template_info
				$this->load->model('home_mdl');
				
				$data['template_info']   = $this->home_mdl->get_template_info();
			    $this->load->view($data['template_info']['path'].'/common/css',$data);  
			    $this->load->view($data['template_info']['path'].'/common/header',$header_data);  
			     
			    $this->load->view($data['template_info']['path'].'/msg_vew', $data);
			    
			    $this->load->view($data['template_info']['path'].'/common/footer',$footer_data);  
			    $this->load->view($data['template_info']['path'].'/common/script'); 
			}
		}
		else
		{
			echo "no message!";
		}
	}
	
	public function get_translated_message($msg_id)
	{
		$lang_id = $this->lng->get_n_set_language_id();	
		
		//$lang_id = 1; //for testing
		
		$this->load->model('msg_mdl');
		$msg_txt = $this->msg_mdl->get_translated_message($msg_id,$lang_id);
		
		//echo $msg_txt[0]->text;
		return $msg_txt[0]->text;
	}
	
	public function get_words($page_name)
	{
		$lang_id = $this->lng->get_n_set_language_id();	
		
		//$lang_id = 1; //for testing
		
		$this->load->model('msg_mdl');
		$page_words = $this->msg_mdl->get_words($page_name,$lang_id);
		
		$words = array();
		foreach ($page_words as $row)
		{
			$words[$row->key] = $row->value;
		}
		
		/*echo("<pre>");
		var_dump($words);
		echo("</pre>");*/
		
		return $words;
	}

}

/* End of file msg.php */
/* Location: ./application/controllers/modules/msg.php */