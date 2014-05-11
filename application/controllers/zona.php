<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zona extends CI_Controller {

	public function index()
	{
		$this->load->model('orm/zona_model');
	}

	public function getZonaWhere(){

		if($this->input->is_ajax_request()){

		}else{
			show_404();
		}
	}

}

/* End of file zona.php */
/* Location: ./application/controllers/zona.php */