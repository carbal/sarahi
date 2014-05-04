<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prueba extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();

	}

	public function data(){
		$this->load->model('ventageneral_model');
		$fecha="2013/11/01";
		$intervalo="2013/12/12";
		$datos=$this->ventageneral_model->zonaIntervalo(2,$fecha,$intervalo);
		echo var_dump($datos);
	}

	public function prueba()
	{
		echo "Esto es una pruenba desde codeigniter";
	}
}

/* End of file prueba */
/* Location: ./application/controllers/prueba */