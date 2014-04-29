<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Devoluciones extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->removeCache();
		$this->load->library('session');
		$this->load->database();
		if(!$this->session->userdata('usuario')){
			redirect(base_url());
		}
	}

	public function removeCache()
	{
		$this->output->set_header('Last-Modified:gmdate("D, d MYH: i: s"..)GMT');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, post-check = 0, pre-check = 0 ");
		$this->output->set_header("Pragma: no-cache");
		$this->output->set_header("Expires: Mon, 26 de julio 1997 05:00:00 GMT");
	}

	public function index()
	{	
		$this->load->model('devoluciones_model');
		$devoluciones=$this->devoluciones_model->get();
		$this->load->view('template/encabezado');
		$this->load->view('devoluciones/index_view',compact('devoluciones'));
		$this->load->view('template/piepagina');
	}



}

/* End of file devoluciones.php */
/* Location: ./application/controllers/devoluciones.php */