<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bitacora extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');

	}
	//index del controlador
	public function index()
	{
		$this->load->view('template/encabezado');
		$this->load->view('bitacora/indexView');
		$this->load->view('template/piepagina');
	}

	//método para devolver tabla de usuarios
	public function getBitacora()
	{
		if($this->input->is_ajax_request()){
			$this->load->model('bitacoraModel');
			$usuarios = $this->bitacoraModel->getDetalles();
			$view     = $this->load->view('bitacora/getBitacoraView',compact('usuarios'),TRUE);
			echo json_encode(array('success' => true, 'html' => $view));
		}else{
			show_404();
		}
	}


}

/* End of file bitacora.php */
/* Location: ./application/controllers/bitacora.php */