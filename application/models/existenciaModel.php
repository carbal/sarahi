<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ExistenciaModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getExistencias($id)
	{
		//llamos a la vista correspondiente
		//$id -> corresponde a la zona
		$query = $this->db->get_where('existencias',array('id_zona' => $id));
		return $query->result_array();
			
	}

}

/* End of file existenciaZonaModel.php */
/* Location: ./application/models/existenciaZonaModel.php */