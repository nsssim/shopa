<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* NOTE crontab is located in /etc/crontab  (centos 7 64bit)
*/

/*
CRONTAB CODE

SHELL=/bin/bash
PATH=/sbin:/bin:/usr/sbin:/usr/bin
MAILTO=root

# For details see man 4 crontabs

# Example of job definition:
# .---------------- minute (0 - 59)
# |  .------------- hour (0 - 23)
# |  |  .---------- day of month (1 - 31)
# |  |  |  .------- month (1 - 12) OR jan,feb,mar,apr ...
# |  |  |  |  .---- day of week (0 - 6) (Sunday=0 or 7) OR sun,mon,tue,wed,thu,fri,sat
# |  |  |  |  |
# *  *  *  *  * user-name  command to be executed
#every hour
# 00 * * * * root lynx -dump http://www.shopamerika.com/beta/autorun/test

#send emails at every 1st minute past every hour (example 1:01, 2:01 ...etc) 
#output location : /home/shopamerika/public_html/beta/data/logs/orders_emails.html 
1 * * * * root /usr/bin/lynx -dump http://www.shopamerika.com/beta/autorun/send_emails_for_pending_orders

#send email to remind payment every 8th of the month
0 1 8 * * root /usr/bin/lynx -dump http://www.shopamerika.com/beta/autorun/reminder

#synch categories table at 1 AM 
#output location : /home/shopamerika/public_html/beta/data/logs/category_synch_log.html
00 1 * * * root /usr/bin/lynx -dump http://www.shopamerika.com/beta/autorun/category_synch

*/

class autorun extends MX_Controller 
{
	function __construct()
    {
        parent::__construct();

		$this->load->helper('url');
		
		
    }
	
 
 //number of minutes that should be reached to send the emails
 //private $NUMBER_OF_MINUTES = 2 ;  //for debugging
 private $NUMBER_OF_MINUTES = 60 ;  // grace period before deadline (email will be sent and flagged as sent and no further emails will resent again unless unflagged from db manually)
 
 
 // this function will write the time each time it's called by cron job
 public function test()
 {
 	$this->load->model("autorun_mdl");
 	$this->autorun_mdl->test();
 }
 
 
/**
* will be called from cron every 1 hour, it will run 3 methods and write to file and create a new file if size id bigger than 1 MB
* 
* @return
*/ 
 public function send_emails_for_pending_orders()
 {
	$this->load->model("autorun_mdl");
 	$mysql_time_now = $this->autorun_mdl->get_mysql_time_now(); 	
 
 	$buffer = "";
	$buffer .= "<div style='border: solid 1px black; margin-top:5px;'>";
	 	$buffer .= 'date & time: '.$mysql_time_now->now."<br>";
	 	$buffer .= $this->send_orders_in_warehouse_pending_emails();
	 	$buffer .= $this->send_orders_is_shipped_pending_emails();
	 	$buffer .= $this->send_orders_is_delivered_pending_emails();
 	$buffer .= "</div>";
 	
 	
 	$file_full_name = './data/logs/orders_emails.html';
 	$filesize = @filesize($file_full_name);
 	//if file is bigger than 1MB backup in file appending the date now
 	if($filesize > 1000000)
 	{
 		$tmp_file = file_get_contents($file_full_name);
 		file_put_contents("./data/logs/orders_emails_".$mysql_time_now->now.".html",$tmp_file);
 		//delete file content
		file_put_contents($file_full_name, "");
	}
 	
	$flag = file_put_contents($file_full_name,$buffer,FILE_APPEND);
 	
 }
 
 
 //---------------------------------------------------is arrived to warehouse
 //check if time now - last_update flag  is longer than 1 hour, if true, send email 
 public function send_orders_in_warehouse_pending_emails()
 {
 	$buffer = "";
 	$this->load->model("autorun_mdl");
 	$mysql_time_now = $this->autorun_mdl->get_mysql_time_now();
 	
 	//get all the orders arrived to ware house with no email sent yet
 	$orders_in_warehouse_no_email = $this->autorun_mdl->get_orders_column_no_email('is_arrived_to_warehouse');
	
	if(!empty($orders_in_warehouse_no_email))
	{
		foreach($orders_in_warehouse_no_email as $order_in_warehouse_no_email)
		{
			$last_time_checked =  $order_in_warehouse_no_email->is_arrived_to_warehouse_last_time_changed;
 			
 			if(!empty($last_time_checked))
 			{
 				date_default_timezone_set('Europe/Istanbul');
 				$time_diff =(strtotime($mysql_time_now->now) - strtotime($last_time_checked))/60 ;
 				
 				//if the checkbox is checked for longer than 1 hour
 				if($time_diff > $this->NUMBER_OF_MINUTES)
 				{
					$o_id_in_warehouse_no_email =  $order_in_warehouse_no_email->order_id_fk;
					//get customer email
					$cusomer = $this->autorun_mdl->get_order_cusomer_info($o_id_in_warehouse_no_email)[0];
					if(!empty($cusomer->email))
					{
						//send email
						$this->load->module('emaily');
						$email_sent_flag = $this->emaily->send_order_arrived_to_warehouse($o_id_in_warehouse_no_email);
						//$email_sent_flag = $this->send_arrived_warehouse_email($order_in_warehouse_no_email,$cusomer);
						
						//set email sent in database (is_arrived_to_warehouse_email_sent_flag to 1)
						if($email_sent_flag)
						{
							$this->autorun_mdl->set_column_email_sent_flag('is_arrived_to_warehouse_email_sent_flag',$o_id_in_warehouse_no_email,1);
						}
						
					}
				}
				//echo "order id:". $o_id_in_warehouse_no_email.",in_warehouse click time: ".$last_time_checked.", NOW: '$mysql_time_now->now', NOW - Click time: ".$time_diff."<br>";
				$buffer .= "<div>";
				$img_url = base_url().'assets/system/warehouse.png' ;
				$buffer .= "<img style='width: 26px; height: auto;' src='".$img_url."'>";
				$buffer .= "order id:". $o_id_in_warehouse_no_email.",in_warehouse click time: ".$last_time_checked.", NOW - Click time: ".$time_diff." minutes";
				$buffer .= "</div>";
			}
			
		}
	}
	
	return $buffer;
	//$file_full_name = './data/logs/orders_emails.html';
	//$flag = file_put_contents($file_full_name,$buffer,FILE_APPEND);
 	
 }

 
 //---------------------------------------------------is shipped
 public function send_orders_is_shipped_pending_emails()
 {
 	$buffer = "";
 	$this->load->model("autorun_mdl");
 	$this->load->module("msg");
 	$mysql_time_now = $this->autorun_mdl->get_mysql_time_now();
 	
 	//get all the orders that was shipped with no email sent yet
 	$orders_shipped_no_email = $this->autorun_mdl->get_orders_column_no_email('is_shipped');
	
	if(!empty($orders_shipped_no_email))
	{
		foreach($orders_shipped_no_email as $order_shipped_no_email)
		{
			$last_time_checked =  $order_shipped_no_email->is_shipped_last_time_changed;
 			
 			if(!empty($last_time_checked))
 			{
 				date_default_timezone_set('Europe/Istanbul');
 				$time_diff =(strtotime($mysql_time_now->now) - strtotime($last_time_checked))/60 ;
 				
 				//if the checkbox is checked for longer than 1 hour
 				if($time_diff > $this->NUMBER_OF_MINUTES)
 				{
					$o_id_shipped_no_email =  $order_shipped_no_email->order_id_fk;
					//get customer email
					$cusomer = $this->autorun_mdl->get_order_cusomer_info($o_id_shipped_no_email)[0];
					if(!empty($cusomer->email))
					{
						//send email
						$this->load->module('emaily');
						$email_sent_flag = $this->emaily->send_order_shipped($o_id_shipped_no_email);
						//$email_sent_flag = $this->send_is_shipped_email($order_shipped_no_email,$cusomer);
						
						//set email sent in database (is_arrived_to_warehouse_email_sent_flag to 1)
						if($email_sent_flag)
						{
							$this->autorun_mdl->set_column_email_sent_flag('is_shipped_email_sent_flag',$o_id_shipped_no_email,1);
						}
					}
					//echo "order id:". $o_id_shipped_no_email.",is_shipped click time: ".$last_time_checked.", NOW: '$mysql_time_now->now', NOW - Click time: ".$time_diff."<br>";
					$buffer .= "<div>";
					$img_url = base_url().'assets/system/shipped.png' ;
					$buffer .= "<img style='width: 26px; height: auto;' src='".$img_url."'>";
					$buffer .= "order id:". $o_id_shipped_no_email.",is_shipped click time: ".$last_time_checked.", NOW - Click time: ".$time_diff." minutes";
					$buffer .= "</div>";
				}
			}
			
		}
	}
	
	//$file_full_name = './data/logs/orders_emails.html';
	//$flag = file_put_contents($file_full_name,$buffer,FILE_APPEND);
	return $buffer;
 	
 }

 //---------------------------------------------------is delivered
 public function send_orders_is_delivered_pending_emails()
 {
 	$buffer = "";
 	$this->load->model("autorun_mdl");
 	$mysql_time_now = $this->autorun_mdl->get_mysql_time_now();
 	
 	//get all the orders that was delivered with no email sent yet
 	$orders_delivered_no_email = $this->autorun_mdl->get_orders_column_no_email('is_delivered');
	
	if(!empty($orders_delivered_no_email))
	{
		foreach($orders_delivered_no_email as $order_delivered_no_email)
		{
			$last_time_checked =  $order_delivered_no_email->is_shipped_last_time_changed;
 			
 			if(!empty($last_time_checked))
 			{
 				date_default_timezone_set('Europe/Istanbul');
 				$time_diff =(strtotime($mysql_time_now->now) - strtotime($last_time_checked))/60 ;
 				
 				//if the checkbox is checked for longer than 1 hour
 				if($time_diff > $this->NUMBER_OF_MINUTES)
 				{
					$o_id_delivered_no_email =  $order_delivered_no_email->order_id_fk;
					//get customer email
					$cusomer = $this->autorun_mdl->get_order_cusomer_info($o_id_delivered_no_email)[0];
					if(!empty($cusomer->email))
					{
						//send email
						$this->load->module('emaily');
						$email_sent_flag = $this->emaily->send_order_delivered($o_id_delivered_no_email);
						//$email_sent_flag = $this->send_is_delivered_email($order_delivered_no_email,$cusomer);
						
						//set email sent in database (is_arrived_to_warehouse_email_sent_flag to 1)
						if($email_sent_flag)
						{
							$this->autorun_mdl->set_column_email_sent_flag('is_delivered_email_sent_flag',$o_id_delivered_no_email,1);
						}
					}
				
				//echo "order id:". $o_id_delivered_no_email.",is_delivered click time: ".$last_time_checked.", NOW: '$mysql_time_now->now', NOW - Click time: ".$time_diff."<br>";
				$buffer .= "<div>";
				$img_url = base_url().'assets/system/delivered.jpg' ;
				$buffer .= "<img style='width: 26px; height: auto;' src='".$img_url."'>";
				$buffer .= "order id:". $o_id_delivered_no_email.",is_delivered click time: ".$last_time_checked.", NOW - Click time: ".$time_diff." minutes";
				$buffer .= "</div>";
				
				//echo $email_sent_flag;
				
				/*$buffer .= "<div>";
				$buffer .= "email_sent_flag:".$email_sent_flag;
				$buffer .= "</div>";*/
				}
			}
			
		}
	}
	//$file_full_name = './data/logs/orders_emails.html';
	//$flag = file_put_contents($file_full_name,$buffer,FILE_APPEND);
	return $buffer;
 	
 }
 
 public function go()
	{
		
	    $this->load->helper('url');
	    $this->load->view('autorun_vew'); 
	    
	    $this->load->view('templates/eshopper/common/script_check_cart'); 
	}
	
public function check_cart()
	{
		$cart_item_count = $this->cart->total_items();
		if(empty($cart_item_count))
		{
			//session expired
			echo 0;
		}
		else
		{
			echo 1;	
		}
	}
	
	/********************************************
	 *Synch categories from API
	 *******************************************/
	public function category_synch()
	{
		$buffer = "";
		date_default_timezone_set("Europe/Istanbul"); 
		//echo '-------------------------------------------------<br>';
		$buffer .= '-------------------------------------------------<br>';
		//echo "date: ". date('d-m-Y') .', ' .date("h:ia").'<br>';
		$buffer .= "date: ". date('d-m-Y') .', ' .date("h:ia").'<br>';
		
		//step 1 
		//echo "start checking for deleted categories in API and remove them from db:";
		$buffer .= "start checking for deleted categories in API and remove them from db:";
		$buffer .= $this->check_n_delete_cat();
		
		//step2
		//echo "start checking for new categories in API and add them to db:";
		$buffer .= "start checking for new categories in API and add them to db:";
		$buffer .= $this->check_n_add_new_categories();
		
		$file_full_name = './data/logs/category_synch_log.html';
		$flag = file_put_contents($file_full_name,$buffer,FILE_APPEND); // save cart to file on server
		
	}
	
	/********************************************
	 * add categories to database from api 
	 *******************************************/
	private function check_n_add_new_categories()
	{
		$buffer ="";
		//$jsonFilename = file_get_contents(base_url()."application/modules/categories/controllers/categories.json");
		$jsonFilename = @file_get_contents("http://api.shopstyle.com/api/v2/categories?pid=sugar");
		
		if(!empty($jsonFilename))
		{
		
			$this->load->helper('url');
			$this->load->model('autorun_mdl');
		
			//$root_cat = $jsonCats->metadata->main;//~~~~~~~~~~~~~~~~~~O|o
		
				
			$jsonCats = json_decode($jsonFilename);
			
			//check for the root category clothes-shoes-and-jewelry
			$record_exists = $this->autorun_mdl->record_exists("categories","idd","clothes-shoes-and-jewelry");
			
			if(!$record_exists)
			{
				$root_cat = $jsonCats->metadata->root;
				
				$cat_idd = addslashes($root_cat->id);
				$cat_id = addslashes($root_cat->numId);
				
				$this->autorun_mdl->add_root_category($cat_id,$cat_idd);
				
				$LastCategoryID = $cat_id;
				
				//now let's populate the category language
				
				//for english
				$lang_id = 2 ;
				$name 			=  addslashes($root_cat->localizedNames->{'en-US'});
				$short_name 	=  addslashes($root_cat->shortName);
				$localizedId 	=  addslashes($root_cat->localizedId);
				$this->autorun_mdl->add_category_lang($LastCategoryID,$lang_id,$name,$short_name,$localizedId);
				
				//for turkish
				$lang_id = 1 ;
				$name 			=  "ttttttt_".addslashes($root_cat->localizedNames->{'en-US'});
				$short_name 	=  "ttttttt_".addslashes($root_cat->shortName);
				$localizedId 	=  addslashes($root_cat->localizedId);
				$this->autorun_mdl->add_category_lang($LastCategoryID,$lang_id,$name,$short_name,$localizedId);
				
				// for German
				$lang_id = 5 ;
				if(!empty($root_cat->localizedNames->{'de-DE'})) $name =  addslashes($root_cat->localizedNames->{'de-DE'});	else $name	=  "ggggggg_".addslashes($root_cat->name);
				if(!empty($root_cat->localizedIds->{'de-DE'}))	$localizedId    =  addslashes($root_cat->localizedIds->{'de-DE'}) ; else $localizedId    =  "ggggggg_".addslashes($root_cat->localizedId) ;
				$this->autorun_mdl->add_category_lang($LastCategoryID,$lang_id,$name,"",$localizedId);
					
				// for French
				$lang_id = 4 ;
				if(!empty($root_cat->localizedNames->{'fr-FR'})) $name =  addslashes($root_cat->localizedNames->{'fr-FR'});	else $name	=  "fffffff_".addslashes($root_cat->name);
				if(!empty($root_cat->localizedIds->{'fr-FR'}))	$localizedId    =  addslashes($root_cat->localizedIds->{'fr-FR'}) ; else $localizedId    =  "fffffff_".addslashes($root_cat->localizedId) ;
				$this->autorun_mdl->add_category_lang($LastCategoryID,$lang_id,$name,"",$localizedId);

				// for Japaneese
				$lang_id = 6 ;
				if(!empty($root_cat->localizedNames->{'ja-JP'})) $name =  addslashes($root_cat->localizedNames->{'ja-JP'});	else $name	=  "jjjjjjj_".addslashes($root_cat->name);
				if(!empty($root_cat->localizedIds->{'ja-JP'}))	$localizedId    =  addslashes($root_cat->localizedIds->{'ja-JP'}) ; else $localizedId    =  "jjjjjjj_".addslashes($root_cat->localizedId) ;
				$this->autorun_mdl->add_category_lang($LastCategoryID,$lang_id,$name,"",$localizedId);
				
			}
			
			foreach($jsonCats->categories as $C)
			{
				
				// if category does not exist in database 
				$flag_record_exists = $this->autorun_mdl->record_exists("categories","idd",$C->id);
				if(!$flag_record_exists)
				{
					//echo '<div style="background-color:#e6ffee">';
					//	echo "Adding new category, id: ".$C->numId."--->".addslashes($C->localizedNames->{'en-US'}) ."<br>";
					// echo "</div>";
					
					$buffer .=  '<div style="background-color:#e6ffee">';
					$buffer .= "Adding new category, id: ".$C->numId."--->".addslashes($C->localizedNames->{'en-US'}) ;
					$buffer .='</div>';
					
					
					$parent_id = $this->autorun_mdl->get_cat_id($C->parentId) ;
					
					$cat_idd 				 = addslashes($C->id);
					$cat_id  				 = addslashes($C->numId);
					$parent_idd  			 = addslashes($C->parentId);
					$has_size_filter  		 = addslashes($C->hasSizeFilter);
					$has_color_filter  		 = addslashes($C->hasColorFilter);
					$has_heel_height_filter  = addslashes($C->hasHeelHeightFilter);
					
					$this->autorun_mdl->add_category($cat_id,$cat_idd,$parent_id,$parent_idd,$has_color_filter,$has_heel_height_filter,$has_size_filter);

					$LastCategoryID = $cat_id;
					
						
					//now let's populate the category language
					
					//for turkish
					$lang_id = 1 ;
					$name 			=  "ttttttt_".addslashes($C->localizedNames->{'en-US'});
					$short_name 	=  "ttttttt_".addslashes($C->shortName);
					$localizedId 	=  addslashes($C->localizedId);
					$this->autorun_mdl->add_category_lang($LastCategoryID,$lang_id,$name,$short_name,$localizedId);
				
					//for english
					$lang_id = 2 ;
					$name 			=  addslashes($C->localizedNames->{'en-US'});
					$short_name 	=  addslashes($C->shortName);
					$localizedId 	=  addslashes($C->localizedId);
					$this->autorun_mdl->add_category_lang($LastCategoryID,$lang_id,$name,$short_name,$localizedId);
						
					// for German
					$lang_id = 5 ;
					if(!empty($C->localizedNames->{'de-DE'})) $name =  addslashes($C->localizedNames->{'de-DE'});	else $name	=  "ggggggg_".addslashes($C->name);
					if(!empty($C->localizedIds->{'de-DE'}))	$localizedId    =  addslashes($C->localizedIds->{'de-DE'}) ; else $localizedId    =  "ggggggg_".addslashes($C->localizedId) ;
					$this->autorun_mdl->add_category_lang($LastCategoryID,$lang_id,$name,"",$localizedId);
						
					// for French
					$lang_id = 4 ;
					if(!empty($C->localizedNames->{'fr-FR'})) $name =  addslashes($C->localizedNames->{'fr-FR'});	else $name	=  "fffffff_".addslashes($C->name);
					if(!empty($C->localizedIds->{'fr-FR'}))	$localizedId    =  addslashes($C->localizedIds->{'fr-FR'}) ; else $localizedId    =  "fffffff_".addslashes($C->localizedId) ;
					$this->autorun_mdl->add_category_lang($LastCategoryID,$lang_id,$name,"",$localizedId);

					// for Japaneese
					$lang_id = 6 ;
					if(!empty($C->localizedNames->{'ja-JP'})) $name =  addslashes($C->localizedNames->{'ja-JP'});	else $name	=  "jjjjjjj_".addslashes($C->name);
					if(!empty($C->localizedIds->{'ja-JP'}))	$localizedId    =  addslashes($C->localizedIds->{'ja-JP'}) ; else $localizedId    =  "jjjjjjj_".addslashes($C->localizedId) ;
					
					$this->autorun_mdl->add_category_lang($LastCategoryID,$lang_id,$name,"",$localizedId);
					
					
					
				}
					
			}
			
			//echo "finished checking for new categories in API. <br>";
			$buffer .= '<div>';
			$buffer .= "finished checking for new categories in API.";
			$buffer .='</div>';
			
		}
		else
		{
			//echo "<br> Error getting file from api <br>";
			$buffer .= '<div>';
			$buffer .= "Error getting file from api.";
			$buffer .='</div>';
			
			
		}
		
		return $buffer;
	}
	
	
	/********************************************
	 * delete categories from db if deleted from api 
	 *******************************************/
	private function check_n_delete_cat()
	{
		$buffer ="";
		//$jsonFilename = file_get_contents(base_url()."application/modules/categories/controllers/categories.json");
		$jsonFilename = @file_get_contents("http://api.shopstyle.com/api/v2/categories?pid=sugar");
		
		if(!empty($jsonFilename))
		{
			
			$this->load->helper('url');
			$this->load->model('autorun_mdl');
		
				
			$jsonCats = json_decode($jsonFilename);
			
			$json_cat_ids = array();
			
			// fill the stack with category ids from api
			foreach($jsonCats->categories as $C)
			{
				$json_cat_ids[] = $C->numId;
			}
			
			//get category ids from database	
			$db_cat_ids = $this->autorun_mdl->get_categories_id();
			
			
			foreach($db_cat_ids as $db_cat_id)
			{
				$current_cat_id = $db_cat_id->id;
				$current_cat_idd = $db_cat_id->idd;
				
				if($current_cat_id !=0 && $current_cat_id !=1) // avoid special ids 
				{
					
					//search category id from db in api, if not found : 
					if (!in_array($current_cat_id, $json_cat_ids)) 
					{
					    //echo "category with id: ".$current_cat_id." was deleted from api  <br>";
					    $qry_result = $this->autorun_mdl->delete_category($current_cat_id);
					    if($qry_result)
					    {
					    	$buffer .= '<div style="background-color:#ffebe6">';
							$buffer .= "category : $current_cat_id ($current_cat_idd) was deleted from db successfully .";
							$buffer .='</div>';
					    	
					    	/*echo '<div style="background-color:#ffebe6">';
					    	echo "category : ".$current_cat_id." was deleted from db successfully  <br>";
					    	echo '</div>';*/
							
						}
					}
				}
			
			}
			
		
			//echo "finished checking for deleted categories. <br>";	
			$buffer .= "<div>";
			$buffer .= "finished checking for deleted categories.";
			$buffer .= "</div>";
		}
		else
		{
			echo "<br>Error getting file from api<br>";
		}
 
 		return $buffer;
	}
	
	public function fw()
	{
		$file_full_name = './data/logs/test_log.html';
		
		$buffer = "<div>";
		$buffer .= time();
		$buffer .= "</div>";
		$flag = file_put_contents($file_full_name,$buffer,FILE_APPEND); // save cart to file on server
	}
	
	public function reminder()
	{
		$this->load->module('emaily');
		$this->emaily->send_reminder('atilla@shopamerika.com');
		$this->emaily->send_reminder('nassim@null.net');
		
	}
}

/* End of file autorun.php */
/* Location: ./application/modules/autorun/controllers/autorun.php */