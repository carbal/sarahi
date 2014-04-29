<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vdvendedor_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	

	public function vendedor($idVendedor,$fecha,$apartir)
	{
		/*$query=$this->db->query("call vdvendedor(".$idVendedor.",'".$fecha."','".$fecha."',".$apartir.")");
		return $query;*/

		$this->db->select('ventas.id_venta AS id_venta,
		ventas.importe AS importe,
		ventas.fecha AS fecha,
		clientes.nombre AS cliente,
		ventas.tipo_venta AS tipo,
		ventas.estado AS estado');
		$this->db->from('ventas');
		$this->db->join('detalle_venta','ventas.id_venta = detalle_venta.id_venta','inner');
		$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
		$this->db->join('clientes','ventas.rfc = clientes.rfc','inner');
		$this->db->where('ventas.id_usuario',$idVendedor);
		$this->db->where('ventas.fecha >=',$fecha);
		$this->db->where('ventas.fecha <=',$fecha);
		$this->db->order_by('ventas.id_venta','DESC');
		$this->db->limit(10,$apartir);
		$query=$this->db->get();
		return $query;

	}

	public function rowsVendedor($idVendedor,$fecha)
	{
		/*$query=$this->db->query("call rowsvendedor(".$idVendedor.",'".$fecha."','".$fecha."')");
		return $query;*/

		$this->db->select('ventas.id_venta AS id_venta,
		ventas.importe AS importe,
		ventas.fecha AS fecha,
		clientes.nombre AS cliente,
		ventas.tipo_venta AS tipo,
		ventas.estado AS estado');
		$this->db->from('ventas');
		$this->db->join('detalle_venta','ventas.id_venta = detalle_venta.id_venta','inner');
		$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
		$this->db->join('clientes','ventas.rfc = clientes.rfc','inner');
		$this->db->where('ventas.id_usuario',$idVendedor);
		$this->db->where('ventas.fecha >=',$fecha);
		$this->db->where('ventas.fecha <=',$fecha);
		$this->db->order_by('ventas.id_venta','DESC');		
		$query=$this->db->get();
		return $query;

	}


	public function vendedorIntervalo($idVendedor,$fecha,$intervalo,$apartir)
	{
		/*$query=$this->db->query("call vdvendedor(".$idVendedor.",'".$fecha."','".$intervalo."',".$apartir.")");
		return $query;*/

		$this->db->select('ventas.id_venta AS id_venta,
		ventas.importe AS importe,
		ventas.fecha AS fecha,
		clientes.nombre AS cliente,
		ventas.tipo_venta AS tipo,
		ventas.estado AS estado');
		$this->db->from('ventas');
		$this->db->join('detalle_venta','ventas.id_venta = detalle_venta.id_venta','inner');
		$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
		$this->db->join('clientes','ventas.rfc = clientes.rfc','inner');
		$this->db->where('ventas.id_usuario',$idVendedor);
		$this->db->where('ventas.fecha >=',$fecha);
		$this->db->where('ventas.fecha <=',$intervalo);
		$this->db->order_by('ventas.id_venta','DESC');
		$this->db->limit(10,$apartir);
		$query=$this->db->get();
		return $query;

	}

	public function rowsVendedorIntervalo($idVendedor,$fecha,$intervalo)
	{
		/*$query=$this->db->query("call rowsvendedor(".$idVendedor.",'".$fecha."','".$intervalo."')");
		return $query;*/

		$this->db->select('ventas.id_venta AS id_venta,
		ventas.importe AS importe,
		ventas.fecha AS fecha,
		clientes.nombre AS cliente,
		ventas.tipo_venta AS tipo,
		ventas.estado AS estado');
		$this->db->from('ventas');
		$this->db->join('detalle_venta','ventas.id_venta = detalle_venta.id_venta','inner');
		$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
		$this->db->join('clientes','ventas.rfc = clientes.rfc','inner');
		$this->db->where('ventas.id_usuario',$idVendedor);
		$this->db->where('ventas.fecha >=',$fecha);
		$this->db->where('ventas.fecha <=',$intervalo);
		$this->db->order_by('ventas.id_venta','DESC');		
		$query=$this->db->get();
		return $query;


	}
}

/* End of file vendedor_model.php */
/* Location: ./application/models/detallado/vendedor_model.php */

?>