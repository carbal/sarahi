<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Devoluciones_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get()
	{
		$this->db->select('usuario.nombres as vendedor,
		clientes.nombre as cliente,
		zona.zona as zona,
		producto.sku as sku,
		producto.descripcion as descripcion,
		devoluciones.cantidad as cantidad,
		devoluciones.fecha as fecha');
		$this->db->from('devoluciones');
		$this->db->join('producto','devoluciones.sku = producto.sku','inner');
		$this->db->join('clientes','devoluciones.rfc_cliente = clientes.rfc','inner');
		$this->db->join('usuario','devoluciones.id_usuario = usuario.id_usuario','inner');
		$this->db->join('zona','usuario.id_zona = zona.id_zona','inner');
		$query=$this->db->get();
		return $query->result_array();

	}
}

/* End of file devoluciones_model.php */
/* Location: ./application/models/devoluciones_model.php */