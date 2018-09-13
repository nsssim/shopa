<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class templateman extends MX_Controller {


	function __construct()
    {
        parent::__construct();
        
    }

	public function get_template_info($template_id)
	{
		$this->load->model("templateman_mdl");
		$template_info = $this->templateman_mdl->get_template_info($template_id);
		return $template_info;
	}
	
	
	
	
	
}

/* End of file templateman.php */
/* Location: .application/modules/templateman/controllers/templateman.php */