<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends CI_Controller {

 function __construct()
    {
        parent::__construct();
		$this->load->model('home_mdl'); // needed for the template info (template path)
		$this->load->model('product_mdl');  // needed for the product details and images 
    }

	public function details($id)
	{
		// get the language from the session 
		$lng = $this->session->userdata("language_id");
		
		$A['template_info']   = $this->home_mdl->get_template_info();// get the template for the active shop 
		
		$A['product_alt_img'] = $this->product_mdl->get_product_alt_images($id);
		$A['product_details'] = $this->product_mdl->get_product_details($id,$lng);
		$A['product_reviews'] = $this->product_mdl->get_product_reviews($id);
		
		// prepare the metadata information for the view page
		if ($A['product_details'][0]->meta_description) $A['meta_description'] =   $A['product_details'][0]->meta_description; else $A['meta_description'] = "";
		if ($A['product_details'][0]->meta_keywords) 	$A['meta_keywords']    =   $A['product_details'][0]->meta_keywords; else $A['meta_keywords'] = "";
		if ($A['product_details'][0]->name)				$A['page_title'] 	   =   $A['product_details'][0]->name ; else $A['name'] = "";
		
		//$tmp = $A['product_details'][0]->name ;
		 
        $this->load->view($A['template_info']['path'].'/product_vew',$A);  // send the result from the model to the view */
		
		/*$this->load->model('product_mdl'); // load the model that will get the alternative pictures
		$A['product_alt_img'] = $this->product_mdl->get_product_alt_images($id); // call the method get_product_alt_images inside the class test_mdl
        $page_path =  'templates\\'.$this->template.'\product_details_vew' ;
        $this->load->view($page_path,$A);  // send the result from the model to the view */
	}
	
	public function GetUserAgent()
	{
		$this->load->library('user_agent');
		$data['agent'] = $agent ;
		$useragent=$_SERVER['HTTP_USER_AGENT'];
	}
	
	public function language ($lang)
	{
		$this->load->library('user_agent');	
	}
	

	
	public function index__old()
	{
		
		//this->load->model
		
		// detect the vistor browser and os and other information 
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
		//header('Location: http://detectmobilebrowser.com/mobile');
		$this->load->view('mobile/test_v',$data);
		else
		$this->load->view('test_v',$data);
		
		
/*		$this->load->library('user_agent');

		if ($this->agent->is_browser())
		{
		    
		    $agent = $this->agent->browser().' '.$this->agent->version();
		    $data['agent'] = $agent ;
		}
		elseif ($this->agent->is_robot())
		{
		    $agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
		    $agent = $this->agent->mobile();
			$data['agent'] = $agent ;
			//$this->load->view('mobile//test_v',$data);
			echo(111);
		}
		else
		{
		    $agent = 'Unidentified User Agent';
		}*/

		//echo $agent;

		//echo $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.) 
	
		

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */