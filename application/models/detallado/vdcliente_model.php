<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vdcliente_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function cliente($idCliente,$fecha,$apartir)
	{
		/*$query=$this->db->query("call vdcliente('".$idCliente."','".$fecha."','".$fecha."',".$apartir.")");
		return $query;*/

		$this->db->select('ventas.id_venta AS id_venta,
		ventas.importe AS importe,
		usuario.nombres AS vendedor,
		ventas.fecha AS fecha,
		ventas.tipo_venta AS tipo,
		ventas.estado AS estado');
		$this->db->from('ventas');
		$this->db->join('detalle_venta','ventas.id_venta = detalle_venta.id_venta','inner');
		$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
		$this->db->join('usuario','ventas.id_usuario = usuario.id_usuario','inner');
		$this->db->where('ventas.rfc',$idCliente);
		$this->db->where('ventas.fecha >=',$fecha);
		$this->db->where('ventas.fecha <=',$fecha);
		$this->db->order_by('ventas.id_venta','DESC');
		$this->db->limit(10,$apartir);
		$query=$this->db->get();
		return $query;
	}


	public function rowsCliente($idCliente,$fecha)
	{
		/*$query=$this->db->query("call rowscliente('".$idCliente."','".$fecha."','".$fecha."')");
		return $query;*/
		$this->db->select('ventas.id_venta AS id_venta,
		ventas.importe AS importe,
		usuario.nombres AS vendedor,
		ventas.fecha AS fecha,
		ventas.tipo_venta AS tipo,
		ventas.estado AS estado');
		$this->db->from('ventas');
		$this->db->join('detalle_venta','ventas.id_venta = detalle_venta.id_venta','inner');
		$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
		$this->db->join('usuario','ventas.id_usuario = usuario.id_usuario','inner');
		$this->db->where('ventas.rfc',$idCliente);
		$this->db->where('ventas.fecha >=',$fecha);
		$this->db->where('ventas.fecha <=',$fecha);
		$this->db->order_by('ventas.id_venta','DESC');		
		$query=$this->db->get();
		return $query;
	}

	public function clienteIntervalo($idCliente,$fecha,$intervalo,$apartir)
	{
		/*$query=$this->db->query("call vdcliente('".$idCliente."','".$fecha."','".$intervalo."',".$apartir.")");
		return $query;*/
		$this->db->select('ventas.id_venta AS id_venta,
		ventas.importe AS importe,
		usuario.nombres AS vendedor,
		ventas.fecha AS fecha,
		ventas.tipo_venta AS tipo,
		ventas.estado AS estado');
		$this->db->from('ventas');
		$this->db->join('detalle_venta','ventas.id_venta = detalle_venta.id_venta','inner');
		$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
		$this->db->join('usuario','ventas.id_usuario = usuario.id_usuario','inner');
		$this->db->where('ventas.rfc',$idCliente);
		$this->db->where('ventas.fecha >=',$fecha);
		$this->db->where('ventas.fecha <=',$intervalo);
		$this->db->order_by('ventas.id_venta','DESC');
		$this->db->limit(10,$apartir);
		$query=$this->db->get();
		return $query;
	}

	public function rowsClienteIntervalo($idCliente,$fecha,$intervalo)
	{
		/*$query=$this->db->query("call dvcliente('".$idCliente."','".$fecha."','".$intervalo."')");
		return $query;*/
		$this->db->select('ventas.id_venta AS id_venta,
		ventas.importe AS importe,
		usuario.nombres AS vendedor,
		ventas.fecha AS fecha,
		ventas.tipo_venta AS tipo,
		ventas.estado AS estado');
		$this->db->from('ventas');
		$this->db->join('detalle_venta','ventas.id_venta = detalle_venta.id_venta','inner');
		$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
		$this->db->join('usuario','ventas.id_usuario = usuario.id_usuario','inner');
		$this->db->where('ventas.rfc',$idCliente);
		$this->db->where('ventas.fecha >=',$fecha);
		$this->db->where('ventas.fecha <=',$intervalo);	
		$this->db->order_by('ventas.id_venta','DESC');		
		$query=$this->db->get();
		return $query;
	}

}

/* End of file clientes_model.php */
/* Location: ./application/models/detallado/clientes_model.php */
?>