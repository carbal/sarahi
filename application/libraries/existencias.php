<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Existencias
{
  	protected 	$CI;
  	protected   $existencias;
  	private 	$urgencias;
  	private 	$precauciones;


	public function __construct()
	{
        $this->CI =& get_instance();
        $this->CI->load->model('existenciasModel');
	}


	/*
	* @return boolena true,false
	*/
	public function existExistencias()
	{
		$this->queryUrgentes();
		$this->queryPrecauciones();
		if((count($this->urgencias))>0 ||(count($this->precauciones)>0))
			return true;
		else
			return false;

	}
	private function queryUrgentes()
	{
		//llamamos a los modelos necesarios
		$this->urgentes = $this->CI->existenciasModel->getUrgentes();
	}

	private function queryPrecauciones()
	{
		$this->precauciones = $this->CI->existenciasModel->getPrecauciones();

	}

	public function getUrgentes()
	{
		return $this->urgentes;
	}

	public function getPrecauciones()
	{
		return $this->precauciones;
	}


}

/* End of file existencias.php */
/* Location: ./application/libraries/existencias.php */
