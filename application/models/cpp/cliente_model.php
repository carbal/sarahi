<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();		
	}

	public function cliente($idCliente,$apartir)
	{
		$this->db->select('
		ventas.id_venta,
		ventas.total_venta AS total,
		ventas.iva_venta AS iva,
		ventas.importe,
		CONCAT(usuario.nombres," ",usuario.apellidos) AS vendedor',FALSE);
		$this->db->from('ventas');
		$this->db->join('usuario','ventas.id_usuario = usuario.id_usuario','inner');
		$this->db->where('ventas.rfc',$idCliente);
		$this->db->where('ventas.estado',0);
		$this->db->where('ventas.tipo_venta',0);
		$this->db->order_by('ventas.id_venta','DESC');
		$this->db->limit(10,$apartir);
		$query = $this->db->get();
		return $query;
	}

	public function rowscliente($idCliente)
	{
		$this->db->select('ventas.id_venta AS id_venta,
		ventas.total_venta AS total,
		ventas.iva_venta AS iva,
		ventas.importe AS importe,
		CONCAT(usuario.nombres," ",usuario.apellidos) AS vendedor',FALSE);
		$this->db->from('ventas');
		$this->db->join('usuario','ventas.id_usuario = usuario.id_usuario','inner');
		$this->db->where('ventas.rfc',$idCliente);
		$this->db->where('ventas.estado',0);
		$this->db->where('ventas.tipo_venta',0);
		$this->db->order_by('ventas.id_venta','DESC');
		$query=$this->db->get();
		return $query;
	}

	

}

/* End of file cliente_model.php */
/* Location: ./application/models/cpp/cliente_model.php */
?>