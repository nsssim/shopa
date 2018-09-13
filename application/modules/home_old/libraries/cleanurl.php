<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cleanurl
 {
 	
    function __construct() 
    {
     	 
   	}
   	
   	public function  slug($z)
   	{
    $z = strtolower($z);
    $z = preg_replace('/[^a-z0-9 -]+/', '', $z);
    $z = str_replace(' ', '-', $z);
    $z = str_replace(',', '-', $z);
    $z = str_replace('%', '-', $z);
    //return trim($z, '-');
	return $z;
	}
    
}

/* End of file cleanurl.php */