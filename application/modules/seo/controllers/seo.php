<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class seo extends MX_Controller {

 function __construct()
    {
        parent::__construct();
        
        $this->load->model('seo_mdl'); 
        
       
    }
    
    public function fbtest()
    {
		//$this->config->load('config2');
		//$fb_config = $this->config->item('fb_config');
		
		/*$fb = new Facebook\Facebook($fb_config);
		
		$at =  $fb->getuser*/
		
		//$fb = $this->load->library("facebook",$fb_config);
		
		/*$fb_config = array(
            'appId'  => '102430190342910',
            'secret' => 'cb5196110c4d1bf76e1761692d28fd49'
            );
        $this->load->library('facebook', $fb_config);
        
        $access_token = $this->facebook->getAccessToken();
    	
    	$url = 'https://graph.facebook.com/v2.7/?id=1428932180656351&access_token=' . $access_token ;
    	
    	//https://graph.facebook.com/1428932180656351?access_token=102430190342910|cb5196110c4d1bf76e1761692d28fd49&fields=fan_count
		echo $url;*/

        
        //$id = 1428932180656351
        
        
        //var_dump( $at);
		
		//var_dump($this->facebook->getUser());
		
		
	}
	
   

	
	
}

/* End of file seo.php */
/* Location: ./application/modules/seo/controllers/seo.php */