<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* 
*
*
*/

class Ventageneral_model extends CI_Model {
 
	 public function __construct()
	 {
	 	parent::__construct();
	 	
	 }	 
	
	 //metodo para buscar venta por zona en una fecha especifica
	 public function zonaFecha($idZona,$fecha)
	 {
	 	//$query=$this->db->query("call vgzona(".$idZona.",'".$fecha."','".$fecha."')");
	 	//return $query->result_array();
	 	$this->db->select('producto.descripcion AS DESCRIPCION,
		producto.sku AS SKU,
		Sum(detalle_venta.cantidad) AS UNIDADES,
		Sum(ventas.total_venta) AS TOTAL,
		Sum(ventas.iva_venta) AS IVA,
		Sum(ventas.importe) AS IMPORTE');
	 	$this->db->from('detalle_venta');
	 	$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
	 	$this->db->join('ventas','detalle_venta.id_venta = ventas.id_venta','inner');
	 	$this->db->join('usuario','ventas.id_usuario = usuario.id_usuario','inner');
	 	$this->db->where('usuario.id_zona',$idZona);
	 	$this->db->where('ventas.fecha >=',$fecha);
	 	$this->db->where('ventas.fecha <=',$fecha);	 	
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	 	
	 	
	 }
	  //metodo para buscar venta por zona en un intervalo de 2 fechas
	 public function zonaIntervalo($idZona,$fecha,$intervalo)
	 {
	 	/*$query=$this->db->query("call vgzona(".$idZona.",'".$fecha."','".$intervalo."')");
	 	return $query->result_array();
	 	*/
	 	
	 	$this->db->select('producto.descripcion AS DESCRIPCION,
		producto.sku AS SKU,
		Sum(detalle_venta.cantidad) AS UNIDADES,
		Sum(ventas.total_venta) AS TOTAL,
		Sum(ventas.iva_venta) AS IVA,
		Sum(ventas.importe) AS IMPORTE');
	 	$this->db->from('detalle_venta');
	 	$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
	 	$this->db->join('ventas','detalle_venta.id_venta = ventas.id_venta','inner');
	 	$this->db->join('usuario','ventas.id_usuario = usuario.id_usuario','inner');
	 	$this->db->where('usuario.id_zona',$idZona);
	 	$this->db->where('ventas.fecha >=',$fecha);
	 	$this->db->where('ventas.fecha <=',$intervalo);
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	 	
	 	

	 }
	  //metodo para buscar venta por cliente en una fecha especifica
	 public function clienteFecha($idCliente,$fecha)
	 {	 
	 	//PROCEDIMIENTOS ALMACENADOS	
	 	//$query=$this->db->query("call vgcliente('".$idCliente."','".$fecha."','".$fecha."')",FALSE);
	 	//return $query->result_array();

	 	$this->db->select('producto.descripcion AS DESCRIPCION,
		producto.sku AS SKU,
		Sum(detalle_venta.cantidad) AS UNIDADES,
		Sum(ventas.total_venta) AS TOTAL,
		Sum(ventas.iva_venta) AS IVA,
		Sum(ventas.importe) AS IMPORTE');
	 	$this->db->from('detalle_venta');
	 	$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
	 	$this->db->join('ventas','detalle_venta.id_venta = ventas.id_venta','inner');	 	
	 	$this->db->where('ventas.rfc',$idCliente);
	 	$this->db->where('ventas.fecha >=',$fecha);
	 	$this->db->where('ventas.fecha <=',$fecha);
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;


	 	
	 }
	 ////metodo para buscar venta por cliente en un intervalo de 2 fechas
	 public function clienteIntervalo($idCliente,$fecha,$intervalo)
	 {	/*
	 	$query=$this->db->query("call vgcliente('".$idCliente."','".$fecha."','".$intervalo."')",FALSE);
	 	return $query->result_array();
	 	*/
	 	$this->db->select('producto.descripcion AS DESCRIPCION,
		producto.sku AS SKU,
		Sum(detalle_venta.cantidad) AS UNIDADES,
		Sum(ventas.total_venta) AS TOTAL,
		Sum(ventas.iva_venta) AS IVA,
		Sum(ventas.importe) AS IMPORTE');
	 	$this->db->from('detalle_venta');
	 	$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
	 	$this->db->join('ventas','detalle_venta.id_venta = ventas.id_venta','inner');	 	
	 	$this->db->where('ventas.rfc',$idCliente);
	 	$this->db->where('ventas.fecha >=',$fecha);
	 	$this->db->where('ventas.fecha <=',$intervalo);
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	 	
	 }
	  //metodo para buscar venta por vendedor en una fecha especifica
	 public function vendedorFecha($idVendedor,$fecha)
	 {	

	 	/*PROCEDIMIENTO ALMACENADO
	 	$query=$this->db->query("call vgvendedor(".$idVendedor.",'".$fecha."','".$fecha."')");
	 	return $query->result_array();
	 	*/


	 	$this->db->select('producto.descripcion AS DESCRIPCION,
		producto.sku AS SKU,
		Sum(detalle_venta.cantidad) AS UNIDADES,
		Sum(ventas.total_venta) AS TOTAL,
		Sum(ventas.iva_venta) AS IVA,
		Sum(ventas.importe) AS IMPORTE');
	 	$this->db->from('detalle_venta');
	 	$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
	 	$this->db->join('ventas','detalle_venta.id_venta = ventas.id_venta','inner');	 	
	 	$this->db->where('ventas.id_usuario',$idVendedor);
	 	$this->db->where('ventas.fecha >=',$fecha);
	 	$this->db->where('ventas.fecha <=',$fecha);
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	 	
	 }

	 //metodo para buscar venta por vendedor en un intervalo de 2 fechas
	public function vendedorIntervalo($idVendedor,$fecha,$intervalo)
	{	
		/*	PROCEDIMIENTO ALMACENADO
		$query=$this->db->query("call vgvendedor(".$idVendedor.",'".$fecha."','".$intervalo."')");
	 	return $query->result_array();
	 	*/
	 	$this->db->select('producto.descripcion AS DESCRIPCION,
		producto.sku AS SKU,
		Sum(detalle_venta.cantidad) AS UNIDADES,
		Sum(ventas.total_venta) AS TOTAL,
		Sum(ventas.iva_venta) AS IVA,
		Sum(ventas.importe) AS IMPORTE');
	 	$this->db->from('detalle_venta');
	 	$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
	 	$this->db->join('ventas','detalle_venta.id_venta = ventas.id_venta','inner');	 	
	 	$this->db->where('ventas.id_usuario',$idVendedor);
	 	$this->db->where('ventas.fecha >=',$fecha);
	 	$this->db->where('ventas.fecha <=',$intervalo);
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}
	 //metodo para buscar ventas por cadena en una fecha especifica
	 public function cadenaFecha($idCadena,$fecha)
	 {	/*	PROCEDIMIENTO ALMACENADO
	 	$query=$this->db->query("call vgcadena(".$idCadena.",'".$fecha."','".$fecha."')");
	 	return $query->result_array();
	 	*/

	 	$this->db->select('producto.descripcion AS DESCRIPCION,
		producto.sku AS SKU,
		Sum(detalle_venta.cantidad) AS UNIDADES,
		Sum(ventas.total_venta) AS TOTAL,
		Sum(ventas.iva_venta) AS IVA,
		Sum(ventas.importe) AS IMPORTE');
	 	$this->db->from('detalle_venta');
	 	$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
	 	$this->db->join('ventas','detalle_venta.id_venta = ventas.id_venta','inner');
	 	$this->db->join('clientes','ventas.rfc = clientes.rfc','inner');	
	 	$this->db->where('usuario.id_zona',$idZona);
	 	$this->db->where('ventas.fecha >=',$fecha);
	 	$this->db->where('ventas.fecha <=',$fecha);	 	
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;

	 }


	public function cadenaIntervalo($idCadena,$fecha,$intervalo)
	{
		$this->db->select('producto.descripcion AS DESCRIPCION,
		producto.sku AS SKU,
		Sum(detalle_venta.cantidad) AS UNIDADES,
		Sum(ventas.total_venta) AS TOTAL,
		Sum(ventas.iva_venta) AS IVA,
		Sum(ventas.importe) AS IMPORTE');
	 	$this->db->from('detalle_venta');
	 	$this->db->join('producto','detalle_venta.sku = producto.sku','inner');
	 	$this->db->join('ventas','detalle_venta.id_venta = ventas.id_venta','inner');
	 	$this->db->join('clientes','ventas.rfc = clientes.rfc','inner');	
	 	$this->db->where('usuario.id_zona',$idZona);
	 	$this->db->where('ventas.fecha >=',$fecha);
	 	$this->db->where('ventas.fecha <=',$intervalo);	 	
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}

}

/* End of file buscador_model.php */
/* Location: ./application/models/buscador_model.php */
?>