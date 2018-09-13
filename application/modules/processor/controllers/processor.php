<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class processor extends MX_Controller {

 function __construct()
    {
        parent::__construct();
        
    }

	public function get_account_info()
	{
		$this->load->model('processor_mdl');
		$account_info_arr = $this->processor_mdl->get_account_info();
		
		if(!empty($account_info_arr))
		{
			$account_info = $account_info_arr[0];
		}
		else
		{
			$account_info = NULL;
		}
		
		return $account_info;
	}
	
	public function get_all_accounts()
	{
		$this->load->model('processor_mdl');
		$accounts_info_arr = $this->processor_mdl->get_all_accounts();
		
		return $accounts_info_arr;
	}
	
	public function activate_account($account_id)
	{
		$this->load->model('processor_mdl');
		$this->processor_mdl->activate_account($account_id);
	}
	
	
	
}

/* End of file processor.php */
/* Location: ./application/modules/processor/controllers/processor.php */