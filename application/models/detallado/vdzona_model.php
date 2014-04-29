<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vdzona_model extends CI_Model {

	/*
	* modelo para obtener las ventas detalladas por zona, por estado
	*/


	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}


	//paginar las ventas terminadas hechas por zona
	public function zona($idZona,$fecha,$apartir)
	{
		/*$query=$this->db->query("call vdzona(".$idZona.",'".$fecha."','".$fecha."',".$apartir.")");
		return $query;*/

		$this->db->select('ventas.id_venta AS id_venta,
		ventas.importe AS importe,
		clientes.nombre AS cliente,
		usuario.nombres AS vendedor,
		ventas.fecha AS fecha,
		ventas.tipo_venta AS tipo,
		ventas.estado AS estado');
		$this->db->from('ventas');
		$this->db->join('clientes','ventas.rfc = clientes.rfc','inner');
		$this->db->join('usuario','ventas.id_usuario = usuario.id_usuario','inner');
		$this->db->where('usuario.id_zona',$idZona);
		$this->db->where('ventas.fecha >=',$fecha);
		$this->db->where('ventas.fecha <=',$fecha);
		$this->db->order_by('ventas.id_venta','DESC');
		$this->db->limit(10,$apartir);
		$query=$this->db->get();
		return $query;


	}
	
	//obtener numero de filas
	public function rowsZona($idZona,$fecha)
	{
		/*$query=$this->db->query("call rowszona(".$idZona.",'".$fecha."','".$fecha."')");
		return $query;*/
		$this->db->select('ventas.id_venta AS id_venta,
		ventas.importe AS importe,
		clientes.nombre AS cliente,
		usuario.nombres AS vendedor,
		ventas.fecha AS fecha,
		ventas.tipo_venta AS tipo,
		ventas.estado AS estado');
		$this->db->from('ventas');
		$this->db->join('clientes','ventas.rfc = clientes.rfc','inner');
		$this->db->join('usuario','ventas.id_usuario = usuario.id_usuario','inner');
		$this->db->where('usuario.id_zona',$idZona);
		$this->db->where('ventas.fecha >=',$fecha);
		$this->db->where('ventas.fecha <=',$fecha);
		$this->db->order_by('ventas.id_venta','DESC');		
		$query=$this->db->get();
		return $query;
	}

	public function zonaIntervalo($idZona,$fecha,$intervalo,$apartir){
		/*$query=$this->db->query("call vdzona(".$idZona.",'".$fecha."','".$intervalo."',".$apartir.")");
		return $query;*/

		$this->db->select('ventas.id_venta AS id_venta,
		ventas.importe AS importe,
		clientes.nombre AS cliente,
		usuario.nombres AS vendedor,
		ventas.fecha AS fecha,
		ventas.tipo_venta AS tipo,
		ventas.estado AS estado');
		$this->db->from('ventas');
		$this->db->join('clientes','ventas.rfc = clientes.rfc','inner');
		$this->db->join('usuario','ventas.id_usuario = usuario.id_usuario','inner');
		$this->db->where('usuario.id_zona',$idZona);
		$this->db->where('ventas.fecha >=',$fecha);
		$this->db->where('ventas.fecha <=',$intervalo);
		$this->db->order_by('ventas.id_venta','DESC');
		$this->db->limit(10,$apartir);
		$query=$this->db->get();
		return $query;

	}

	public function rowsZonaIntervalo($idZona,$fecha,$intervalo)
	{
		/*$query=$this->db->query("call rowszona(".$idZona.",'".$fecha."','".$intervalo."')");
		return $query;*/

		$this->db->select('ventas.id_venta AS id_venta,
		ventas.importe AS importe,
		clientes.nombre AS cliente,
		usuario.nombres AS vendedor,
		ventas.fecha AS fecha,
		ventas.tipo_venta AS tipo,
		ventas.estado AS estado');
		$this->db->from('ventas');
		$this->db->join('clientes','ventas.rfc = clientes.rfc','inner');
		$this->db->join('usuario','ventas.id_usuario = usuario.id_usuario','inner');
		$this->db->where('usuario.id_zona',$idZona);
		$this->db->where('ventas.fecha >=',$fecha);
		$this->db->where('ventas.fecha <=',$intervalo);
		$this->db->order_by('ventas.id_venta','DESC');		
		$query=$this->db->get();
		return $query;

	}

	

}

/* End of file zona_model.php */
/* Location: ./application/models/detallado/zona_model.php */
?>