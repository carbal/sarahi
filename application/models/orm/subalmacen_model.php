<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subalmacen_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	

	public function allWhere($value)
	{	
		$this->db->where('id_usuario',$value);
		$query=$this->db->get('subalmacen');
		return $query->result_array();
	}

	public function insert($insert)
	{
		$this->db->insert('subalmacen', $insert);
	}

	public function whereUsuario($id_usuario)
	{	
		$this->db->select('producto.descripcion,
		producto.sku,
		producto.categoria,
		subalmacen.existencia');
		$this->db->from('subalmacen');
		$this->db->join('producto','producto.sku = subalmacen.sku','inner');
		$this->db->where('id_usuario',$id_usuario);		
		$query=$this->db->get();
		return $query->result_array();
	}
}

/* End of file subalmacen_model.php */
/* Location: ./application/models/subalmacen_model.php */