<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
		$this->load->library('session');
	}
	public function index()
	{
		$this->load->model('orm/clientes_model');
		$data['clientes'] = $this->clientes_model->all();
		$this->load->view('template/encabezado');
		$this->load->view('clientes/index',$data);
		$this->load->view('template/piepagina');
	}

}

/* End of file clientes.php */
/* Location: ./application/controllers/clientes.php */