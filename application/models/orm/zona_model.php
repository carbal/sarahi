<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*mapeo ralacional de objetos(ORM)
*modelo correspondiente a la tabla:zona
*/

class Zona_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
		
	}
	//metodo para obtener todos los registros de la tabla
	public function select()
	{
		$query=$this->db->get('zona');
		return $query->result_array();
	}

	//metodo para para buscar en el campo zona mediante like
	public function likeZona($cadena)
	{
		$this->db->select('id_zona,zona');
	 	$this->db->like('zona',$cadena);
	 	$query=$this->db->get('zona');
	 	return $query->result_array();
	}
	//metodo para obtener la fila correspondiente a la id_zona
	public function get_zona($id_zona)
	{
		$query=$this->db->get_where('zona',array('id_zona'=>$id_zona));
		return $query->row_array();
	}



}

/* End of file zona_model.php */
/* Location: ./application/models/orm/zona_model.php */
