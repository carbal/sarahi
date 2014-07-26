<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web extends CI_Controller {

	public function index()
	{
		$this->load->view('web/principalView');
	}

}

/* End of file web.php */
/* Location: ./application/controllers/web.php */