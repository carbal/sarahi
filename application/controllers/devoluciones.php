<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Devoluciones extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->removeCache();
		$this->load->library('session');
		$this->load->database();
		$this->load->library('form_validation');
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
		$devoluciones = $this->devoluciones_model->get();
		$js           = $this->load->view('devoluciones/jsDevoluciones','',TRUE);
		$this->load->view('template/encabezado');
		$this->load->view('devoluciones/indexView',compact('devoluciones','js'));
		$this->load->view('template/piepagina');
	}

	public function getFecha()
	{
		$this->form_validation->set_rules('fechaini', 'Fecha inicio', 'trim|required|xss_clean');
		$this->form_validation->set_rules('fechafin', 'Fecha fin', 'trim|xss_clean|callback_fin');

		$this->form_validation->set_message('required','El campo %s es requerido.');
		$this->form_validation->set_message('fin','Debe de llenar cuando menos un campo.');
		$this->form_validation->set_error_delimiters('<div>','</div>');

		if($this->form_validation->run() == TRUE){
			$this->load->model('devoluciones_model');
			if(!empty($_POST['fechafin']))
				$devoluciones = $this->devoluciones_model->getFecha($_POST['fechaini'],$_POST['fechafin']);
			else
				$devoluciones = $this->devoluciones_model->getFecha($_POST['fechaini'],$_POST['fechaini']);

			$html = $this->load->view('devoluciones/getFechaView',compact('devoluciones'),TRUE);

			echo json_encode(array('success' => TRUE ,'html' => $html));
		}else{
			echo json_encode(array('success' => FALSE ,'html' => validation_errors()));
		}
	}

	public function getDescribe()
	{
		$this->load->model('devoluciones_model');
		$describe = $this->devoluciones_model->describe();
		$html     = $this->load->view('devoluciones/describeView',compact('describe'),TRUE);

		echo json_encode(array('success' => TRUE ,'html' => $html));
	}


	//métodos callback para form_validation
	public function fin()
	{
		if(!empty($_POST['fechaini'])){
			return TRUE;
		}else{
			return FALSE;
		}
	}

}

/* End of file devoluciones.php */
/* Location: ./application/controllers/devoluciones.php */