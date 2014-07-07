<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Devoluciones_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get()
	{
		$this->db->select('
		d.id_devolucion,
		u.nombres as vendedor,
		c.nombre as cliente,
		z.zona as zona,
		p.sku as sku,
		p.descripcion as descripcion,
		d.cantidad as cantidad,
		d.fecha as fecha');
		$this->db->from('devoluciones d');
		$this->db->join('producto p','d.sku = p.sku','inner');
		$this->db->join('clientes c','d.rfc_cliente = c.rfc','inner');
		$this->db->join('usuario u','d.id_usuario = u.id_usuario','inner');
		$this->db->join('zona z','u.id_zona = z.id_zona','inner');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result_array();

	}

	public function getFecha($inicio,$fin)
	{
		$this->db->select('
		d.id_devolucion,
		u.nombres as vendedor,
		c.nombre as cliente,
		z.zona as zona,
		p.sku as sku,
		p.descripcion as descripcion,
		d.cantidad as cantidad,
		d.fecha as fecha');
		$this->db->from('devoluciones d');
		$this->db->join('producto p','d.sku = p.sku','inner');
		$this->db->join('clientes c','d.rfc_cliente = c.rfc','inner');
		$this->db->join('usuario u','d.id_usuario = u.id_usuario','inner');
		$this->db->join('zona z','u.id_zona = z.id_zona','inner');
		$this->db->where('d.fecha >=',$inicio);
		$this->db->where('d.fecha <=',$fin);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function describe()
	{
		$this->db->select("
		d.id_devolucion,
		CONCAT(u.nombres,' ',u.apellidos) as vendedor,
		c.nombre as cliente,
		ca.cadena as cadena,
		z.zona as zona,
		p.sku as sku,
		p.descripcion as descripcion,
		d.cantidad as cantidad,
		d.fecha as fecha",FALSE);
		$this->db->from('devoluciones d');
		$this->db->join('producto p','d.sku = p.sku','inner');
		$this->db->join('clientes c','d.rfc_cliente = c.rfc','inner');
		$this->db->join('cadena ca', 'ca.id_cadena = c.id_cadena', 'inner');
		$this->db->join('usuario u','d.id_usuario = u.id_usuario','inner');
		$this->db->join('zona z','u.id_zona = z.id_zona','inner');
		$this->db->where('d.id_devolucion',$this->input->post('id'));
		$query = $this->db->get();
		return $query->row_array();
	}
}

/* End of file devoluciones_model.php */
/* Location: ./application/models/devoluciones_model.php */