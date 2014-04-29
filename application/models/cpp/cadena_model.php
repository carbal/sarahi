<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadena_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}


	//metodo para obtener las ventas no termindas pertinentes al administrador
	public function cadena($idCadena,$apartir)
	{
		$query=$this->db->query("call cppadmoncadena(".$idCadena.",".$apartir.")");
		return $query;
	}
/*
	public function cadena($idCadena,$apartir)
	{
		$this->db->select('ventas.id_venta AS id_venta,ventas.total_venta AS total,
						ventas.iva_venta AS iva,ventas.importe AS importe,clientes.nombre AS cliente,
						usuario.nombres AS vendedor');
		$this->db->from('ventas');
		$this->db->join('clientes','ventas.rfc = clientes.rfc','inner');
		$this->db->join('usuario','ventas.id_usuario = usuario.id_usuario','inner');
		$this->db->where('clientes.id_cadena',$idCadena);
		$this->db->where('ventas.estado',0);
		$this->db->where('ventas.tipo_venta',0);
		$this->db->order_by('ventas.id_venta','DESC');
		$this->db->limit(10,$apartir);
		return $query=$this->db->get();
	}*/
	

	//obtener las filas  de las ventas no terminadas pertinentes al administrador
	public function  rowscadena($idCadena)
	{
		$query=$this->db->query("call rowscppcadena(".$idCadena.")");
		return $query;
	}

	

}

/* End of file cadena_model.php */
/* Location: ./application/models/cpp/cadena_model.php */
?>