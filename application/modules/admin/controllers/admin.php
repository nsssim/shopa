<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends MX_Controller 
{
	 function __construct()
    {
        parent::__construct();
        
        $this->load->module('customer');
        
       $this->check_user();
    }
    
    //check if user is an admin - this is called in constructor 
    private function check_user()
    {
		$this->load->module('templateman');
		
		$this->load->helper('url');
		// if user is not an admin send him to login view
        $user_id = $this->session->userdata('user_id');
        // if not logged in plz log in 
        if(!empty($user_id))
        {
        	$user_details = $this->customer->get_customer_details($user_id)[0];
        	$is_admin = (bool)$user_details->is_admin ;
        	
        	//if not an admin user then go to admin login page 
        	if(!$is_admin)
        	{
				//redirect(base_url()."login");
				redirect(base_url()."login/admin");
				//$this->goto_admin_login();
			}
		}
		else
		{
			redirect(base_url()."login/admin");
			//$this->goto_admin_login();
		}
	}
	
	public function index()
	{
		$this->load->module("orders");
		$data['num_total_orders'] =  (int)$this->orders->get_number_of_orders(); 
		
		$data['number_of_customers'] = $this->customer->get_number_of_customers();
		
		$fb_url = 'https://graph.facebook.com/1428932180656351?access_token=102430190342910|cb5196110c4d1bf76e1761692d28fd49&fields=fan_count'; 
		$this->load->library('PHPRequests');
		$response = Requests::get($fb_url);
		$fb_data = json_decode($response->body);
		
		$data['fb_num_of_likes'] = $fb_data->fan_count;
  
		
		$user_id = $this->session->userdata('user_id');
		$left_data['user_details'] = $this->customer->get_customer_details($user_id)[0];
		
		//$data['featured_items'] = $this->home_mdl->get_combo("featured",2,1);// get the featured products for the main shop  2 is english and 1 is the id of the main shop  
		$left_data['menu_flag'] = 'index';
		
		$current_admin_privileges = $this->get_current_admin_privileges();
		$left_data['current_admin_privileges'] = $current_admin_privileges ;
		$data['current_admin_privileges'] = $current_admin_privileges ;
		
		
		$this->load->view("templates/startbootstrap/common/css");
        $this->load->view("templates/startbootstrap/common/left_menu",$left_data);
        
        $this->load->view("templates/startbootstrap/dashboard_vew",$data);  
        
        $this->load->view("templates/startbootstrap/common/footer");
        $this->load->view("templates/startbootstrap/common/script_dashboard");
		
	}
	
	/// orders
	public function orders()
	{
		$user_id = $this->session->userdata('user_id');
		$left_data['user_details'] = $this->customer->get_customer_details($user_id)[0];
		
		//$data['featured_items'] = $this->home_mdl->get_combo("featured",2,1);// get the featured products for the main shop  2 is english and 1 is the id of the main shop  
		$left_data['menu_flag'] = 'orders';
		
		$current_admin_privileges = $this->get_current_admin_privileges();
		$left_data['current_admin_privileges'] = $current_admin_privileges ;
		$data['current_admin_privileges'] = $current_admin_privileges ;
		
		$this->load->module("orders");
		
		//$data['orders'] = $this->orders->get_last_orders(100); 
		
		
		// pagination  start
		$this->load->library('pagination');
		
		$item_per_page = 50;
		// get the total number 
		$total_rows =  (int)$this->orders->get_number_of_orders(); 
		$data['num_total_orders'] = $total_rows;
		
		// thanks to Aurel for the trick see http://stackoverflow.com/questions/5384644/codeigniter-pagination-url-with-get-parameters
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		
		$config['base_url']  = base_url().'/admin/orders/';
		$config['first_url'] = $config['base_url'].'0?'.http_build_query($_GET);
		
		$config['per_page']  = $item_per_page;
		$config['total_rows'] = $total_rows;
			
		$this->pagination->initialize($config);
		$data['pagination'] =  $this->pagination->create_links();
		
		$offset = $this->uri->segment(3);
		if(!$offset) $offset = 0;
		// query with offset and limit ($item_per_page)
			
		$query_string = $current_url= $_SERVER["REQUEST_URI"];
		
		$re = "/-ob-([a-z_]+)%3A(.)/"; 
        preg_match_all($re, $query_string, $matches);
		$order_by_str = ""; 
		if(!empty($matches[0]))
		{
			$num_matches = sizeof($matches[0]);
			$i = 0;
			while($i < $num_matches)
			{
				$direction = "";
				if($matches[2][$i] == "a") $direction = "asc";
				if($matches[2][$i] == "d") $direction = "desc";
				
				if(!empty($direction))
				{
					// 1st element
					/*if($i == 0)
					{
						$order_by_str .= "order by ". $matches[1][$i]." ".$direction.",";	
					}*/
					//last elemtn
					if($i == $num_matches-1)
					{
						$order_by_str .= $matches[1][$i]." ".$direction;	
					}
					//not 1st not last
					else
					{
						$order_by_str .= $matches[1][$i]." ".$direction.",";	
						
					}
				}
				
				$i++;
			}
			
			
		}
		
		$data['orders'] = $this->orders->get_orders_paginated($offset,$item_per_page,$order_by_str); 
		
		// end pagination 
		
        
		//$data['navigation'] = $this->load->view("templates/startbootstrap/common/menu_vew",TRUE);
        $this->load->view("templates/startbootstrap/common/css");
        $this->load->view("templates/startbootstrap/common/left_menu",$left_data);
        
        $this->load->view("templates/startbootstrap/orders_vew",$data);
		
        $this->load->view("templates/startbootstrap/common/footer");
        $this->load->view("templates/startbootstrap/common/script_orders");
	}
	
	/**
	* shows the order details  
	* 
	* @param order $id
	* 
	* @return null
	*/
	public function order_details($id)
	{
		$user_id = $this->session->userdata('user_id');
		$left_data['user_details'] = $this->customer->get_customer_details($user_id)[0];
		
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
		
		$left_data['menu_flag'] = 'order_details';
		
		$current_admin_privileges = $this->get_current_admin_privileges();
		$left_data['current_admin_privileges'] = $current_admin_privileges ;
		$data['current_admin_privileges'] = $current_admin_privileges ;
		
		$data["cart_content"] = $cart_content;
		$data["order_details"] = $order_details;
		
		$t = "!@#FDS654*!!48aPKjhUgbdg".$id;
		$token = sha1($t);
		
		$data["print_for_admin_link"] 	 = base_url()."invoice/ph/".$token."/".$id."/1";
		$data["print_for_customer_link"] = base_url()."invoice/ph/".$token."/".$id."/0";
		
		//$data["order_id"] = $id;
		
		
        
        $this->load->view("templates/startbootstrap/common/css");
        $this->load->view("templates/startbootstrap/common/left_menu",$left_data);
        
        $this->load->view("templates/startbootstrap/order_details_vew",$data); 
		
        $this->load->view("templates/startbootstrap/common/footer");
        $this->load->view("templates/startbootstrap/common/script");
	}
	
	/// products
	public function products()
	{
		$user_id = $this->session->userdata('user_id');
		$left_data['user_details'] = $this->customer->get_customer_details($user_id)[0];
		
		$left_data['menu_flag'] = 'products';
		
		$current_admin_privileges = $this->get_current_admin_privileges();
		$left_data['current_admin_privileges'] = $current_admin_privileges ;
		$data['current_admin_privileges'] = $current_admin_privileges ;	
		
        
        $this->load->view("templates/startbootstrap/common/css");
        $this->load->view("templates/startbootstrap/common/left_menu",$left_data);
        
        $this->load->view("templates/startbootstrap/products_vew",$data);  
		
        $this->load->view("templates/startbootstrap/common/footer");
        $this->load->view("templates/startbootstrap/common/script");
	}
	
	public function product_details()
	{
		$user_id = $this->session->userdata('user_id');
		$left_data['user_details'] = $this->customer->get_customer_details($user_id)[0];
		
		$left_data['menu_flag'] = 'product_details';
		
		$current_admin_privileges = $this->get_current_admin_privileges();
		$left_data['current_admin_privileges'] = $current_admin_privileges ;
		$data['current_admin_privileges'] = $current_admin_privileges ;		
		
        
        $this->load->view("templates/startbootstrap/common/css");
        $this->load->view("templates/startbootstrap/common/left_menu",$left_data);
        
        $this->load->view("templates/startbootstrap/product_details_vew",$data);  
		
        $this->load->view("templates/startbootstrap/common/footer");
        $this->load->view("templates/startbootstrap/common/script");
	}
	
	// customers
	public function customers()
	{
		$user_id = $this->session->userdata('user_id');
		$left_data['user_details'] = $this->customer->get_customer_details($user_id)[0];
		
		$left_data['menu_flag'] = 'customers';
		
		$current_admin_privileges = $this->get_current_admin_privileges();
		$left_data['current_admin_privileges'] = $current_admin_privileges ;
		$data['current_admin_privileges'] = $current_admin_privileges ;
		
		
        
        $this->load->view("templates/startbootstrap/common/css");
        $this->load->view("templates/startbootstrap/common/left_menu",$left_data);
        
        $this->load->view("templates/startbootstrap/customers_vew",$data);  
		
        $this->load->view("templates/startbootstrap/common/footer");
        $this->load->view("templates/startbootstrap/common/script");
	}
	
	public function customer_details()
	{
		$user_id = $this->session->userdata('user_id');
		$left_data['user_details'] = $this->customer->get_customer_details($user_id)[0];
		
		$left_data['menu_flag'] = 'customer_details';
		
		$current_admin_privileges = $this->get_current_admin_privileges();
		$left_data['current_admin_privileges'] = $current_admin_privileges ;
		$data['current_admin_privileges'] = $current_admin_privileges ;
        
        $this->load->view("templates/startbootstrap/common/css");
        $this->load->view("templates/startbootstrap/common/left_menu",$left_data);
        
        $this->load->view("templates/startbootstrap/customer_details_vew",$data);  
		
        $this->load->view("templates/startbootstrap/common/footer");
        $this->load->view("templates/startbootstrap/common/script");
	}
	
	public function eprocessor()
	{
		$user_id = $this->session->userdata('user_id');
		$left_data['user_details'] = $this->customer->get_customer_details($user_id)[0];
		
		$this->load->module('processor');
        
        $left_data['menu_flag'] = 'eprocessor';
        
        $current_admin_privileges = $this->get_current_admin_privileges();
		$left_data['current_admin_privileges'] = $current_admin_privileges ;
		$data['current_admin_privileges'] = $current_admin_privileges ;
        
		$data['accounts_data'] = $this->processor->get_all_accounts();
        
        $this->load->view("templates/startbootstrap/common/css_eprocessor");
        $this->load->view("templates/startbootstrap/common/left_menu",$left_data);
        
        $this->load->view("templates/startbootstrap/eprocessor_vew",$data);  
		
        $this->load->view("templates/startbootstrap/common/footer");
        $this->load->view("templates/startbootstrap/common/script_eprocessor");
	}
	
	public function admins()
	{
		$user_id = $this->session->userdata('user_id');
		$left_data['user_details'] = $this->customer->get_customer_details($user_id)[0];
		
		$left_data['menu_flag'] = 'admins';
		
		$current_admin_privileges = $this->get_current_admin_privileges();
		$left_data['current_admin_privileges'] = $current_admin_privileges ;
		$data['current_admin_privileges'] = $current_admin_privileges ;
		
		$data['admin_groups'] = $this->get_admin_groups();
		$data['admins_list'] = $this->get_admins_list();
        
        $this->load->view("templates/startbootstrap/common/css_admins");
        $this->load->view("templates/startbootstrap/common/left_menu",$left_data);
        
        $this->load->view("templates/startbootstrap/admins_vew",$data);  
		
        $this->load->view("templates/startbootstrap/common/footer");
        $this->load->view("templates/startbootstrap/common/script_admins");
	}
	
	public function misc()
	{
		$user_id = $this->session->userdata('user_id');
		$left_data['user_details'] = $this->customer->get_customer_details($user_id)[0];
		
		$left_data['menu_flag'] = 'misc';
		
		$current_admin_privileges = $this->get_current_admin_privileges();
		$left_data['current_admin_privileges'] = $current_admin_privileges ;
		$data['current_admin_privileges'] = $current_admin_privileges ;
		
		$data['admin_groups'] = $this->get_admin_groups();
		$data['admins_list'] = $this->get_admins_list();
        
        $this->load->view("templates/startbootstrap/common/css_admins");
        $this->load->view("templates/startbootstrap/common/left_menu",$left_data);
        
        $this->load->view("templates/startbootstrap/misc_vew",$data);  
		
        $this->load->view("templates/startbootstrap/common/footer");
        $this->load->view("templates/startbootstrap/common/script_admins");
	}
	
	public function categories()
	{
        $user_id = $this->session->userdata('user_id');
		$left_data['user_details'] = $this->customer->get_customer_details($user_id)[0];
		
        $this->load->module('categories');
		
		
        $left_data['menu_flag'] = 'categories';
        
        $current_admin_privileges = $this->get_current_admin_privileges();
		$left_data['current_admin_privileges'] = $current_admin_privileges ;
		$data['current_admin_privileges'] = $current_admin_privileges ;
        
		$data['categories'] = $this->categories->get_subcategories_plus(1); //get the 4 main categories 
		
		
		//$cata['categories'] = $this->categories->get_subcategories_plus(1); //get the 4 main categories 
		//$categories_html  = $this->load->view('templates/startbootstrap/categories_html',$cata,true);
		//$data['categories_html'] = $categories_html;
		
        
        $this->load->view("templates/startbootstrap/common/css");
        $this->load->view("templates/startbootstrap/common/left_menu",$left_data);
        
        $this->load->view("templates/startbootstrap/categories_vew",$data);  
		
        $this->load->view("templates/startbootstrap/common/footer");
        $this->load->view("templates/startbootstrap/common/script_categories");
	}
	
	// logout
	public function logout()
	{
		
		$data = "nothing";
		$test = "test for a hook on git..9 this should work now ...hopefully after using :set fileformat=unix in vi ";
        
        $this->load->view("templates/startbootstrap/common/css");
        $this->load->view("templates/startbootstrap/common/left_menu");
        
        $this->load->view("templates/startbootstrap/logout_vew",$data);  
		
        $this->load->view("templates/startbootstrap/common/footer");
        $this->load->view("templates/startbootstrap/common/script");
	}
	
	//get facebook likes number
	public function get_fb_like_count()
	{
		// Facebook page url
		$fb_page_url = 'http://www.facebook.com/green%22';

		// facebook api
		$fb_api_qry = 'http://graph.facebook.com/fql?q=select%20like_count%20from%20link_stat%20where%20url=%22'.$fb_page_url;
		
		//using Request instead of curl
		$this->load->library('PHPRequests');
	    $response_str = Requests::get($fb_api_qry);
	    
		// convert the body of the response to json object
		$json_data = json_decode($response_str->body);
		$fb_like_count = $json_data->data[0]->like_count;
		
		//echo $fb_like_count;
		
		return  $fb_like_count;
		
	}
	
	private function get_current_admin_privileges()
	{
		$this->load->model('admin_mdl');
		
		$admin_id = $this->session->userdata("user_id");
		$admin_privileges = $this->admin_mdl->get_admin_privileges($admin_id);
		//var_dump($admin_privileges);
		return $admin_privileges;
	}
	
	private function get_admin_groups()
	{
		$this->load->model('admin_mdl');
		
		$admin_groups = $this->admin_mdl->get_admin_groups();
		//var_dump($admin_privileges);
		return $admin_groups;
	}
	
	public function get_admins_list()
	{
		$this->load->model('admin_mdl');
		$admins_list = $this->admin_mdl->get_admins_list();
		return $admins_list;
	}
	
	public function listing($table)
	{
		$left_menu_highlight_flag = "";
		
		date_default_timezone_set('Europe/Istanbul');
		$this->load->library('grocery_CRUD');
		
		$gcrud = $this->grocery_crud;
		
		//switch languages for grocery crud
		if(!empty($this->session->userdata("language_id")))
		{
			$lang_id = $this->session->userdata("language_id");
			if($lang_id == 1) $gcrud->set_language("turkish");
			if($lang_id == 2) $gcrud->set_language("english");
		}
		
		switch($table)
		{
			case "customers":
				$left_menu_highlight_flag = "customers";
				$data["title_text"] = "Customers";
				
				$gcrud->unset_delete();
				$gcrud->unset_add();
				$gcrud->unset_edit();
				$gcrud->set_subject("users");
				$columns = array("id","email");
				$gcrud->columns($columns);
				$gcrud->unset_export();
			break;
			
			case "products":
				$left_menu_highlight_flag = "products";
				$data["title_text"] = "Products";
				
				$gcrud->unset_delete();
				$gcrud->unset_add();
				$gcrud->set_subject("users");
				$columns = array("id","brandedName");
				$gcrud->columns($columns);
				$gcrud->unset_export();
			break;
			
			case "price_rules":
				$left_menu_highlight_flag = "price_rules";
				$data["title_text"] = "Price Rules";
				
				$this->load->module('price_rules'); 
				$data["price_rules"] = $this->price_rules_mdl->get_price_id_value();
				
				
				$gcrud->set_subject("price_rules");
				$columns = array("id","value","description","code");
				$gcrud->columns($columns);
				
				$gcrud->edit_fields("value","description");
				$gcrud->unset_delete();
				$gcrud->unset_add();
				//$gcrud->set_theme('datatables');
				//$gcrud->add_action('Smileys', 'http://www.grocerycrud.com/assets/uploads/general/smiley.png', 'home/index');
				$gcrud->unset_export();			
			break;
			
			case "lists":
				$left_menu_highlight_flag = "lists";
				$data["title_text"] = "Lists";
				
				$gcrud->set_subject("lists");
				//$columns = array("id","value","description","code");
				//$gcrud->columns($columns);
				
				//$gcrud->edit_fields("value","description");
				$gcrud->unset_delete();
				$gcrud->unset_add();
				$gcrud->unset_export();
				//$gcrud->set_theme('datatables');
				//$gcrud->add_action('Smileys', 'http://www.grocerycrud.com/assets/uploads/general/smiley.png', 'home/index');
				
				$left_menu_highlight_flag = "lists";
			break;
			
			case "languages" : 
				$gcrud->set_subject("dsfsdf");
				$columns = array("id","iso_code");
				$gcrud->columns($columns);
				//$gcrud->unset_add();
				$gcrud->unset_add_fields("id","iso_code");
				$gcrud->set_theme('datatables');
				$gcrud->unset_export();
			break;
			
			case "who_what_when" :
				
				$gcrud->set_primary_key('id');
				$left_menu_highlight_flag = "who_what_when";
				$data["title_text"] = "Who What When";
				$this->load->helper('url');
				$data['link_order_emails_log'] =  base_url().'data/logs/orders_emails.html'; 
				
				$gcrud->set_subject("who_what_when");
				//$columns = array("id","value","description","code");
				//$gcrud->columns($columns);
				
				//$gcrud->edit_fields("value","description");
				$gcrud->unset_delete();
				$gcrud->unset_add();
				$gcrud->unset_edit();
				$gcrud->unset_export();
				//$gcrud->set_theme('datatables');
				//$gcrud->add_action('Smileys', 'http://www.grocerycrud.com/assets/uploads/general/smiley.png', 'home/index');
					
				$left_menu_highlight_flag = "who_what_when";
			break;
			
			case "emails" :
				
				$gcrud->set_primary_key('id');
				$columns = array("email","date_add");
				$gcrud->columns($columns);
				
				$left_menu_highlight_flag = "emails";
				$data["title_text"] = "Emails";
				$this->load->helper('url');
				
				$gcrud->set_subject("Emails");
				//$columns = array("id","value","description","code");
				//$gcrud->columns($columns);
				
				//$gcrud->edit_fields("value","description");
				//$gcrud->unset_delete();
				$gcrud->unset_add();
				//$gcrud->unset_read();
				$gcrud->unset_edit();
				$gcrud->unset_edit_fields();
				$gcrud->unset_export();
				//$gcrud->set_theme('datatables');
				//$gcrud->add_action('Smileys', 'http://www.grocerycrud.com/assets/uploads/general/smiley.png', 'home/index');
					
				$left_menu_highlight_flag = "emails";
			break;
			
			
		}
		
		$gcrud->set_table($table);
		$crud_data = $gcrud->render();
		
		$data["crud_data"] = $crud_data;
		
		$left_data['menu_flag'] = $left_menu_highlight_flag;
		
		$current_admin_privileges = $this->get_current_admin_privileges();
		$left_data['current_admin_privileges'] = $current_admin_privileges ;
		$data['current_admin_privileges'] = $current_admin_privileges ;
		
		$user_id = $this->session->userdata('user_id');
		$left_data['user_details'] = $this->customer->get_customer_details($user_id)[0];
		
		$this->load->view("templates/startbootstrap/common/css_grocerycrud",$data);
        $this->load->view("templates/startbootstrap/common/left_menu",$left_data);
        
        $this->load->view("templates/startbootstrap/listing_vew",$data);  
		
        $this->load->view("templates/startbootstrap/common/footer");
        $this->load->view("templates/startbootstrap/common/script_grocerycrud");
		
		
	}
	
	public function update_admin_group_privileges()
	{
		$admin_group_id = (int)$this->input->get('admin_group_id');
		$privilege_name = $this->input->get('privilege_name');
		$state = $this->input->get('state');
		
		$this->load->model("admin_mdl");
		$this->admin_mdl->update_admin_group_privileges($admin_group_id,$privilege_name,$state);
		
	}

	public function delete_admin_group()
	{
		$admin_group_id = (int)$this->input->get('admin_group_id');
		
		$this->load->model("admin_mdl");
		$this->admin_mdl->delete_admin_group($admin_group_id);
	}
	
	
	public function add_administrator()
	{
		$admin_group_id = (int)$this->input->get('admin_group_id');
		$email = $this->input->get('email');
		
		$this->load->module('customer');
		$customer_id = $this->customer->get_user_id($email);
		$flag = 0;
		
		//check if user in database 
		if(!empty($customer_id) && !empty($admin_group_id) )
		{
			$this->load->model("admin_mdl");
			$this->admin_mdl->add_administrator($admin_group_id,$customer_id);
			$flag = 1;
		}
		
		if(empty($admin_group_id))
		{
			$flag = 2;
		}
		
		echo($flag);
	}
	
	public function demote_administrator()
	{
		$admin_id = (int)$this->input->get('admin_id');
		
		$this->load->model("admin_mdl");
		$this->admin_mdl->demote_administrator($admin_id);
	}
	
	public function add_admin_group()
	{
		$group_name = $this->input->get('group_name');
		
		$this->load->model("admin_mdl");
		$this->admin_mdl->add_admin_group($group_name);
	}
	
	public function update_order_details()
	{
		$user_id = $this->session->userdata('user_id');
		if(!empty($user_id))
		{
			$this->load->module('orders');
			
			$order_id = $this->input->get('o_id');
			$o_option_name = $this->input->get('o_option_name');
			$o_option_value = $this->input->get('value');
			
			$order_options['order_id'] =$order_id;
			$order_options['row_name'] = $o_option_name;
			$order_options['row_value'] = $o_option_value;
			
			$flag = $this->orders->update_order_options($order_options);
			
			if($flag)
			{
				//save whatever was clicked/typed to order_details_journal 
				$flag2 = $this->set_order_details_journal($user_id,$order_id,$o_option_name,$o_option_value);
				
				//if user clicked on "is_arrived_to_warehouse" save this click time in is_arrived_to_warehouse_last_time_changed 
				if(($o_option_name == "is_arrived_to_warehouse") or ($o_option_name == "is_shipped") or ($o_option_name == "is_delivered"))
				{
					$o_option_name_last_time_changed = $o_option_name."_last_time_changed";
					$this->orders->save_last_time_chaned($order_id,$o_option_name_last_time_changed);
				}
				
			}
			
			echo $flag; // true or false
		}
		
	}
	
	public function set_order_details_journal($user_id,$order_id,$o_option_name,$o_option_value)
	{
		//$oo = 55;
		$this->orders->set_order_details_journal($user_id,$order_id,$o_option_name,$o_option_value);
	}
	
	public function reset_redis_via_ssh()
	{
		echo("connecting ...<br>");
		$connection = ssh2_connect('shopamerika.com', 22);
		if($connection)
		{
			echo("connected successfuly<br>");
			ssh2_auth_password($connection, 'root', '!s115599');
			$stream = ssh2_exec($connection, '/usr/local/bin/php -i');
			stream_set_blocking($stream, true);
			$stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
			echo stream_get_contents($stream_out);

			
			
		}
		else
		{
			echo("error, make sure SSHLIB is installed and root priviledges are correct. for more info contact your system administrator<br>");
			
		}


	}
	
	

	
	
	public function info(){
		phpinfo();
	}
	
	

	public function print_order($id)
	{
		// same oreder details ()
		$user_id = $this->session->userdata('user_id');
		$left_data['user_details'] = $this->customer->get_customer_details($user_id)[0];
		
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
		
		$left_data['menu_flag'] = 'order_details';
		
		$current_admin_privileges = $this->get_current_admin_privileges();
		$left_data['current_admin_privileges'] = $current_admin_privileges ;
		$data['current_admin_privileges'] = $current_admin_privileges ;
		
		$data["cart_content"] = $cart_content;
		$data["order_details"] = $order_details;
		
		
	 	$data["head"] = $this->load->view("templates/startbootstrap/common/css_order_details_pdf",TRUE);
        $output = $this->load->view("templates/startbootstrap/order_details_vew_pdf",$data,TRUE); 
        
		
		echo $output;
		/*
		// now print
		date_default_timezone_set('Europe/Istanbul');//or change to whatever timezone you want
		
		// load Tcpdf lib
		$this->load->library('Pdf');

		//$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		// create new PDF document
		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		$pdf->SetTitle('My Title');
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');
		
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		// set font
		$pdf->SetFont('helvetica', '', 10);

		$pdf->AddPage();

//		$pdf->Write(5, $order_html);
		$pdf->writeHTML($output, true, false, true, false, '');

		$file_name = 'order_'.$id.'.pdf';
		$pdf->Output($file_name, 'I');
		*/
		
	}
	
}

/* End of file admin.php */
/* Location: ./application/controllers/Home.php */