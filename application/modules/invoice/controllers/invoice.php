<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class invoice extends MX_Controller {

 function __construct()
    {
        parent::__construct();
        

	 
    }
    
    public function print_order($tkn,$id,$for_admin = TRUE)
	{
		if ($this->check_token($tkn,$id))
		{
			$this->load->module("customer");
			$this->load->module("orders");
			
			$order_details = $this->orders->get_order_details($id)[0];
			$cart_content_file_path = $order_details->cart_content; // order content (but technically cart content)
			
			$cart_content = NULL;
			if(file_exists($cart_content_file_path))
			{
				$cart_content_file_gz = file_get_contents($cart_content_file_path); // read file
				$cart_file_json = gzdecode($cart_content_file_gz); // uncompress the file
				$cart_content = json_decode($cart_file_json); // decode from json to object
			}
			
			$data["cart_content"] = $cart_content;
			$data["order_details"] = $order_details;
			
			
	        if($for_admin)
	        {
	        	$output = $this->load->view("templates/eshopper/admin_invoice_print_vew",$data,TRUE); 
			}
			else
			{
	        	$output = $this->load->view("templates/eshopper/customer_invoice_print_vew",$data,TRUE); 
			}
	        
			
			echo $output;
			
			
		}
		else
		{
			echo("token mismatch , you must be logged in to do this operation");
		}
		
		
	}
	
	
	public function ph($tkn,$id,$for_admin = TRUE)
	{
		$this->load->helper("url");
		if($for_admin)
		{
			$cmd = 'phantomjs /opt/phantomjs/examples/rasterize.js "'.base_url().'invoice/print_order/'.$tkn.'/'.$id.'/'."1".'" '.PATH_ORDERS_PRINT_TMP.$id.'.pdf';
		}
		else
		{
			$cmd = 'phantomjs /opt/phantomjs/examples/rasterize.js "'.base_url().'invoice/print_order/'.$tkn.'/'.$id.'/'."0".'" '.PATH_ORDERS_PRINT_TMP.$id.'.pdf';
		}
		//echo $cmd;
		exec($cmd, $output, $return);

		// Return will return non-zero upon an error
		if (!$return) 
		{
		    //echo "PDF Created Successfully";
		    
		    
		    //redirect($file);
		    $file = PATH_ORDERS_PRINT_TMP.$id.'.pdf';

			if (file_exists($file)) {
			    $file_name = 'order_'.$id.'.pdf';
		    	$file_url = base_url().'data/orders/printed/'.$id.'.pdf';
				header('Content-Type: application/octet-stream');
				header("Content-Transfer-Encoding: Binary"); 
				header("Content-disposition: attachment; filename=\"".$file_name."\""); 
				readfile($file);
				unlink($file);
				exit;
			}
			else
			{
				echo " $file file not found!";
			}
		    
		}
		else
		{
		    echo "Unable to generate PDF file make sure ".PATH_ORDERS_PRINT_TMP." is writable and phantomjs is installed , contact your system administrator.<br>
		     	  For more information on how to install phantomjs, read this :
		     	  <a href=".base_url().'data/orders/temp/PhantomJS.html> link </a>';
		}
	}
	
	public function check_token($tkn,$id)
	{
		$t = "!@#FDS654*!!48aPKjhUgbdg".$id;
		$t = sha1($t);
		//echo($t."<br>");
		
		if($tkn == $t)
		{
			//echo "yes";
			return TRUE;
			
		}
		else
		{
			//echo "no";
			return FALSE;
		}
	}


	
	

	
	
}

/* End of file invoice.php */
/* Location: ./application/modules/invoice/controllers/invoice.php */