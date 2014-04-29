<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* este modelo contiene consultas especiales como llamadas a procedimientos almacendados(call) y
* y uniones de dos o mas tablas
* 
*/
class Vendedor_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	//obtener el numero de filas de una venta en funcion del vendedor
	public function rows_vendedor($id_vendedor)
	{
		$this->db->select('*');						
		$this->db->join('clientes','ventas.rfc=clientes.rfc','inner');		
		$this->db->where('id_usuario',$id_vendedor);
		$query=$this->db->get('ventas');
		return $query->num_rows();
	}

	//obtener los datos de la venta en funcion del vendedor
	public function query_vendedor($id_vendedor,$apartir,$rows_page)
	{
		$this->db->limit($rows_page, $apartir);
		$this->db->select('ventas.id_venta,clientes.nombre,ventas.total_venta,ventas.iva_venta,ventas.importe,ventas.fecha,ventas.tipo_venta,ventas.estado');						
		$this->db->join('clientes','ventas.rfc=clientes.rfc','inner');	
		$this->db->from('ventas');
		$this->db->where('ventas.id_usuario', $id_vendedor);
		$this->db->order_by('ventas.id_venta', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}	
	//obtener detalle_venta en funcion del id_venta
	public function query_detallecliente($id_venta){		
		$this->db->select('*');
		$this->db->from('ventas');		
		$this->db->join('clientes','ventas.rfc=clientes.rfc','inner');		
		$this->db->where('ventas.id_venta',$id_venta);
		$query=$this->db->get();
		return $query->row_array();
	}

	//optenemos los pagos hechos por el cliente sobre una venta es especial
	public function query_detalleventa($id_venta){
		$this->db->select('*');
		$this->db->from('detalle_venta');
		$this->db->where('detalle_venta.id_venta',$id_venta);
		$this->db->join('producto','detalle_venta.sku=producto.sku','inner');
		$query=$this->db->get();
		return $query->result_array();

	}		
	
	//OBTENEMOS EL NUMERO DE FILAS DE LAS VENTAS POR CLIENTE y VENDEDOR
	public function rows_ventascliente($rfc_cliente,$id_vendedor){
		$where=array(
			'ventas.rfc'=>$rfc_cliente,
			'ventas.id_usuario'=>$id_vendedor
			);
		$this->db->where($where);
		$this->db->join('clientes','ventas.rfc=clientes.rfc','inner');		
		$query=$this->db->get('ventas');
		return $query->num_rows();
	}


	//PAGINAR LAS VENTAS POR CLIENTE Y VENDEDOR
	public function query_ventascliente($rfc_cliente,$id_vendedor,$apartir,$rows_page){
		$this->db->select('ventas.id_venta,clientes.nombre,ventas.total_venta,ventas.iva_venta,ventas.importe,ventas.fecha,ventas.tipo_venta,ventas.estado');						
		$where=array(
			'ventas.rfc'=>$rfc_cliente,
			'ventas.id_usuario'=>$id_vendedor
			);
		$this->db->limit($rows_page,$apartir);
		$this->db->where($where);
		$this->db->join('clientes','ventas.rfc=clientes.rfc','inner');		
		$this->db->order_by('id_venta','desc');
		$query=$this->db->get('ventas');
		return $query->result_array();

	}

}

/* End of file vendedor_model.php */
/* Location: ./application/models/vendedor_model.php */