<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*this class is my wrapper class for caching engines like Redis and Memcache 
*/

class cachy extends MX_Controller 
{
 
/**
* test if memcache is set ,not used in this project but left for further development....maybe
* 
* @return mixed returns some dummy data from cache
*/

 public function test()
 {
 	// memcache test - make sure you have memcache extension installed and the deamon is up and running
	$memcache = new Memcache;
	$memcache->connect('localhost', 11211) or die ("Could not connect");
	
	$version = $memcache->getVersion();
	echo "Server's version: ".$version."<br/>\n";
	
	$tmp_object = new stdClass;
	$tmp_object->str_attr = 'test';
	$tmp_object->int_attr = 123;
	
	$memcache->set('key', $tmp_object, false, 10) or die ("Failed to save data at the server");
	echo "Store data in the cache (data will expire in 10 seconds)<br/>\n";
	
	$get_result = $memcache->get('key');
	echo "Data from the cache:<br/>\n";
	
	var_dump($get_result);
 }

  
  /**
  * very interesting function, this will create a Redis object for you and gives you 
  * an instance of it, so you can call Redis anywhere in the whole project as a
  * module  
  * 
  * @return object an instance of Redis
  */
  
  public function new_redis_instance()
  {
  	$redis_obj = new redis;
	$redis_obj->connect('127.0.0.1', 6379) or die ("Could not connect to Redis server");
	return $redis_obj;
  }
  
  
  /**
  * very interesting function, this will create a Memcache object for you and gives you 
  * an instance of it, so you can call Memcache anywhere in the whole project as a
  * module  
  * 
  * @return object an instance of Memcache
  */
  
  public function new_memcache_instance()
  {
  	$memcache_obj = new Memcache;
	$memcache_obj->connect('localhost', 11211) or die ("Could not connect");
	return $memcache_obj;
  }
  
  /**
  * find all the keys starting with  $key_pattern and delete the keys
  * 
  * @param string $key_pattern
  * 
  * @return mixed mixed an array of matching_keys if succes, or zero if mo match were found
  */
  
  public function del_k_like($key_pattern = NULL)
  {
  	
  	$rcache = $this->new_redis_instance();
  	$matching_keys = $rcache->keys($key_pattern.'*');
  	
  	foreach($matching_keys as $matching_key)
  	{
		//echo "deleting:  ".$matching_key."<br>";
		$rcache->delete($matching_key);
	}
	if($matching_keys)
	{
		//print_r($matching_keys);
  		return $matching_keys;
	}
	else 
  	{
  		//echo "no matching keys";
  		return 0;
	}
  }
  
  /**
  *	Will get the last time the cache_id was generated 
  * 
  * @param string $cache_id
  * 
  * @return mixed object
  */	
  public function get_time_stamp_cache_id($cache_id)
  {
  	 $this->load->model("cachy_mdl");
  	 $result = $this->cachy_mdl->get_time_stamp_cache_id($cache_id);
  	 if($result)
  	 {
  	 	//echo($result[0]->last_time_updated);
  	 	return $result[0]->last_time_updated;
	 }
	 else
	 {
	 	//echo 0;
	 	return 0;
	 }
  }
  
  /**
  * Will Set a timedate record in the database if not exist and Update it if exists 
  * 
  * @param sting $cache_id
  * 
  * @return boolean
  */
  public function set_time_stamp_cache_id($cache_id)
  {
  	$this->load->model("cachy_mdl");
  	$flag = $this->cachy_mdl->set_time_stamp_cache_id($cache_id);
  	//var_dump($flag);
  	return $flag;
  }
  
  /**
  * will just fetch the time from MySQl
  * 
  * @return string datetime
  */
  public function get_mysql_time_now()
  {
  	$this->load->model("cachy_mdl");
  	$result = $this->cachy_mdl->get_mysql_time_now();
  	
  	//echo $result[0]->now;
  	return $result[0]->now;
  }
  
 
  /**
  *	Will return the difference in time since last time the cache_id was generated or updated
  *  
  * 
  * @param string $cache_id
  * @param string $time_unit can be H for hours , M for minutes, Null or Other for seconds 
  * 
  * @return string number of minutes or hours depending on time_format parameter
  */
  public function get_delta_time_stamp_cache($cache_id,$time_unit = "s")
  {
  	$time_unit = strtolower($time_unit);
  	date_default_timezone_set('Europe/Istanbul');
  	$time_stamp_cache_id = $this->get_time_stamp_cache_id($cache_id);
  	$get_mysql_time_now = $this->get_mysql_time_now();
  	
  	
  	
  	$delta_time_cache =   strtotime($get_mysql_time_now) - strtotime($time_stamp_cache_id)  ;
  	
  	$result = 0;
  	if($time_unit == "h")
  	{
  		$result = $delta_time_cache/3600;
		
	}
	elseif($time_unit == "m") // default format is in minutes
  	{
  		//convert it to minutes 
  		$result = (int)$delta_time_cache/60;
	}
	else
	{
		//leave it as it is (seconds)
  		$result = $delta_time_cache;
	}
	
  	if($time_stamp_cache_id == 0) $result = 0;
  	
  	//echo("delta_time_cache~~~~~~~~>".$result." $time_unit<br>");
  	return $result;
  }
  
  /**
  * if Cash is on it will cache a result for  certain amount of time  (by default in minutes)
  * 
  * @param string $cache_id the unique cache key 
  * @param string $qurl the query url needed to pass to the api
  * 
  * @return json a json object from the cache or api depending on elapsed time since last cache creation/update on this key 
  */
  public function smart_cache($cache_id, $qurl)
  {
  		//init vars
  		$time_amount = 3; // can be read from db
  		$time_unit_option = "h" ; // H or M or S upper/lower case is not important
  		
	  	//get last time the cache was created 
	  	$last_time_stamp = $this->get_time_stamp_cache_id($cache_id);
		
		//calculate the time difference between MySQL now and last time the cache was created 
		$delta_time_stamp_cache = $this->get_delta_time_stamp_cache($cache_id,$time_unit_option);
	  	
	  	// new redis cache object
		$rcache = $this->new_redis_instance();
				
	  	$oo = 55 ;
		  	
		if(CACHE_IS_ON  )
			{
				if($delta_time_stamp_cache < $time_amount)
				{
					
					//// cache this result : $output
					
					$cache_content = json_decode($rcache->get($cache_id)) ;
					//if already in cache 
					if (!empty($cache_content))
					{
						if (VERBOSE_DEBUG) echo "<br>getting data from cache ... (from $cache_id)<br>";
						$output = $cache_content;
					}
					else 
					{
						// long work here
						$output = @file_get_contents($qurl);
						
						//save long work output to cache 
						if (VERBOSE_DEBUG) echo "<br>saving to cache ... (from $cache_id)<br>";
						
						//save into cache
						$flag = $rcache->set($cache_id, json_encode($output))or die ("Failed to save data to cash server");
						if($flag)
						{
							//save timestamp to database
							$this->set_time_stamp_cache_id($cache_id);
						}
					}
				}
				else 
				{
					// long work here
					$output = @file_get_contents($qurl);
					
					//save long work output to cache 
					if (VERBOSE_DEBUG) echo "<br>saving to cache ... (from $cache_id)<br>";
					
					//save into cache
					$flag = $rcache->set($cache_id, json_encode($output))or die ("Failed to save data to cash server");
					if($flag)
					{
						//save timestamp to database
						$this->set_time_stamp_cache_id($cache_id);
					}
				}
			}
			// if cache is disabled
			else
			{
				// long work here
				//echo "<br>~~~~~~~~~~~~~~fetching from API";
				$output = @file_get_contents($qurl);
			}
			
		if(empty($output))
		{
			$output = FALSE;
		}

		return $output; 
	
  }
  
  
  // dummy function just to save the caching steps as a prototype for code reusability 
  public function do_cache($output)
  {
  	////////caching start//////////
		if(CACHE_IS_ON)
		{
			// new redis cache object
			$rcache = $this->cachy->new_redis_instance();
			
			//// cache this result : $var_name
			$id = sha1($param1."-".$param2."-".$param3);
			$cache_id ="class:method:".$id;
			$cache_content = json_decode($rcache->get($cache_id)) ;
			//if already in cache 
			if (!empty($cache_content))
			{
				if (VERBOSE_DEBUG) echo "getting data from cache ... (from class->method)<br>";
				$var_name = $cache_content;
			}
			else 
			{
				// long work here
				
				//save long work output to cache 
				if (VERBOSE_DEBUG) echo "saving to cache ... (from class->method)<br>";
				$rcache->set($cache_id, json_encode($var_name))or die ("Failed to save data to cash server");
			}
		}
		// if cache is disabled
		else
		{
			// long work here
		}
		////////caching finish//////////
  }
  
  

	
    
}

/* End of file cachy.php */
/* Location: ./application/modules/cachy/controllers/cachy.php */