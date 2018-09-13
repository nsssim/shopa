<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class currency extends MX_Controller 
{
 
/**
* will set the currency details in the session
* 
* @param int $currency_id
* 
* @return int returns 0 if everything was alright
*/

 public function set_session_currency($currency_id)
 {
 	//get the rate from database and save it in the session
 	
 	$this->load->model("currency_mdl");
 	$currency_details = $this->currency_mdl->get_currency_details($currency_id);
 	
 	$this->session->set_userdata("CUR_RATE",$currency_details[0]->conversion_rate);
 	$this->session->set_userdata("CUR_SIGN",$currency_details[0]->sign);
 	$this->session->set_userdata("CUR_CODE",$currency_details[0]->iso_code);
 	
 	/*echo "<pre>"; 
 	var_dump($this->session->userdata); 
 	echo "</pre>";*/
 	
 	return 0;
 }
 
 /**
 * get the actual currency rate from yahoo api and update the currency table in the database 
 * 
 * @return int 0 if success or 1 if error
 */
 
 public function update_db_currency_rate()
 {
 	
 	$rates = $this->get_currencies_rate();
 	if(!empty($rates))
 	{
 		$this->load->model("currency_mdl");
 		$this->currency_mdl->update_db_currency_rate($rates);
 		return 0;
	}
	else return 1;
 }
 
 /**
 * gets and parse the currency rate from yahoo finance api (json file) , this method is using the 3rd party library Request instead of curl
 * 
 * @return array array("TRY" =>$TRY,"EUR"=>$EUR,"RUB"=>$RUB)
 */
 
 public function get_currencies_rate()
	{
		// currency list the order is important !!
		$currencies_list = 'TRY=X,EUR=X,RUB=X';
		
		// yahoo finance api
		$yf_api_qry = 'http://finance.yahoo.com/webservice/v1/symbols/'.$currencies_list.'/quote?format=json';
		
		//using Request instead of curl
		$this->load->library('PHPRequests');
	    $response_str = Requests::get($yf_api_qry);
	    
		// convert the body of the response to json object
		if(!empty($response_str->body))
		{
			$json_data = json_decode($response_str->body);
		}
		else
		{
			$json_data = FALSE;
			
		}
		
		if(!empty($json_data))
		{
			
			$TRY = $json_data->list->resources[0]->resource->fields->price;
			$EUR = $json_data->list->resources[1]->resource->fields->price;
			$RUB = $json_data->list->resources[2]->resource->fields->price;
			
			$rates = array("TRY" =>$TRY,"EUR"=>$EUR,"RUB"=>$RUB);
		}
		else
		{
			$rates = NULL;
		}
		
		/*echo "<pre>";
		print_r($rates);
		echo "</pre>";*/
		
		return  $rates;
		
	}
	
	/**
	* gets the time of the last currency update from database and compare it to now
	* 
	* @return array returns the number of hours, minutes and seconds and the last update date time 
	*/
	public function get_currency_last_update()
	{
		
		date_default_timezone_set("UTC");
		
		$this->load->model("currency_mdl");
		$currency_details = $this->currency_mdl->get_currency_details(978);
		
		//get the time shift between now and UTC [SELECT TIMEDIFF(NOW(), UTC_TIMESTAMP) AS timediff;]
		$timediff_db = $this->currency_mdl->get_timediff();
    	
    	// splice the time difference into sign + or - Hours Minutes Seconds
    	$re = "/(-)?([0-9]+):([0-9]+):([0-9]+)/"; 
    	preg_match($re, $timediff_db->timediff, $time_matches);
    	
    			
		/*echo("timediff_db = ".$timediff_db->timediff);
		echo("<br>");*/
		
		// check if the time is negative -03:00:00 for example , no need to check for positive since it is the default
		$timediff_is_negative = FALSE;
		if(!empty($time_matches['1']))
		$timediff_is_negative = TRUE;
		
		$timediff_hours = $time_matches['2'];
		
		/*echo("timediff_hours = ".$timediff_hours);
		echo("<br>");*/
		
		$timediff_minutes  = $time_matches['3'];
		
		/*echo("timediff_minutes = ".$timediff_minutes);
		echo("<br>");*/
		
		$timediff_seconds  = $time_matches['4'];
		
		/*echo("timediff_seconds = ".$timediff_seconds);
		echo("<br>");*/
		
		// convert the time difference from (-)H:M:S to seconds
		$total_time_diff = $timediff_seconds + $timediff_minutes *60 + $timediff_hours*60*60;
		
		// get the last currency update time from db
		$last_update_db = $currency_details[0]->last_update;
		
		// add or substract time difference to adjust the actual time
		if ($timediff_is_negative)
		$time_now = time() - $total_time_diff ;
		else
		$time_now = time() + $total_time_diff ;
		
		$time_now_str = date('Y-m-d H:i:s', $time_now);
		
		
		/*echo("last_update_db = ".$last_update_db);
		echo("<br>");
		
		echo("time_now_str = ".$time_now_str);
		echo("<br>");
		
		echo("---------------------<br>");*/
		
		// convert db_time to ...........
		$last_update = strtotime($last_update_db) ;
		
		/*echo("time_now = ".$time_now);
		echo("<br>");
		
		echo("last_update = ".$last_update);
		echo("<br>");
		
		echo("---------------------<br>");*/
			
		$delta_time = $time_now -  $last_update;
		
		/*echo("delta_time = ".$delta_time);
		echo("<br>");
		
		echo("delta_time(hours) = ".$delta_time/60/60);
		echo("<br>");*/
		$dtime_h = $delta_time/60/60;
		
		$whole = floor($dtime_h);      // 1 hour
		$fraction = $dtime_h - $whole; // .25 min
		
		$dtime_min = $fraction * 60 ; 
		
		$whole_min = floor($dtime_min);      // 1 min
		$fraction_min = $dtime_min - $whole_min; // .25 sec
		
		$dtime_sec = $fraction_min * 60 ;
		
		/*echo("---------------------<br>");
		
		echo("delta_time(sec) = ".$dtime_sec);
		echo("<br>");
		
		echo("delta_time(min) = ".$whole_min);
		echo("<br>");
		
		echo("delta_time(hours) = ".$whole);
		echo("<br>");*/
		
		$data = array("last_update_t"=>$last_update_db,"delta_h"=>$whole,"delta_m"=>$whole_min,"delta_s"=>$dtime_sec);
		
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
		
		return $data;
		
	}
	
	/**
	* update the currency if the currency table in the database was updated 1 hour or more ago and set the 
	* currency details in the session, the defaut currency id is 840 whch is the dollar
	* 
	* @param int $currency_id
	* 
	* @return void  data will be saved in the session : session->userdata("CUR_RATE","CUR_SIGN","CUR_CODE")
	*/
	public function set_currency($currency_id = 840)
	{
		$currency_last_update = $this->get_currency_last_update();
		
		if ($currency_last_update ["delta_h"] >= 1)
		{
			$this->update_db_currency_rate();
		}
		
		//uncomment this block to have the rate exchange update if the last exchange rate was longer than 1 minute 
		/*if ($currency_last_update ["delta_m"] >= 1)
		{
			$this->update_db_currency_rate();
		}*/
		
		$this->set_session_currency($currency_id);
		
		return 0 ; // ok
	}
	
	/**
	 * force the currency table to update and save the currency details in the session 
	 * 
	 * @param int $currency_id
	 * 
	 * @return int 
	 */
	
	public function change_currency($currency_id)
	{
		// update the currency table from the currency api
		$this->update_db_currency_rate();
		
		//save  into session
		$this->set_session_currency($currency_id);
		
		return 0 ; // ok
	}
	
	
    
}

/* End of file currency.php */
/* Location: ./application/modules/currency/controllers/currency.php */