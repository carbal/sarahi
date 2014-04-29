<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ventasce_model extends CI_Model {
	/*
	* el modelo corresponde a  los procedimientos almacenados para obtener
	* las ventas por zona en efectivo o credito, entre una fecha o un intervalo de 2 fechas
	*/

	public function __construct()
	{
		parent::__construct();
		
	}
	/*
	* 	VENTAS POR ZONA
	*/


	//metodo para obtener las ventas por zona en una fecha especifica
	public function efectivoZonaFecha($idZona,$fecha)
	{
		/* representa ventas en efectivo
		$query=$this->db->query("call cezona(".$idZona.",1,'".$fecha."','".$fecha."')");
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
	 	$this->db->where('ventas.fecha <=',$fecha);
	 	$this->db->where('ventas.tipo_venta',1);	 	
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}

	//metodo para obtener las ventas en efectivo por zona en un intervalo de 2 fechas
	public function efectivoZonaIntervalo($idZona,$fecha,$intervalo)
	{

		/*las ventas en efectivo se representa mediante true o 1
		$query=$this->db->query("call cezona(".$idZona.",1,'".$fecha."','".$intervalo."')");
		return $query->result_array();*/
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
	 	$this->db->where('ventas.tipo_venta',1);	 	
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}

	//metodo para obtener las ventas a credito por zona en una fecha especifica
	public function creditoZonaFecha($idZona,$fecha)	
	{
		/*las ventas en credito se representa mediante false o 0
		$query=$this->db->query("call cezona(".$idZona.",0,'".$fecha."','".$fecha."')");
		return $query->result_array();*/
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
	 	$this->db->where('ventas.tipo_venta',0);	 	
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}

	//metodo para obtener las ventas a credito por zona en un intervalo de 2 fechas
	public function creditoZonaIntervalo($idZona,$fecha,$intervalo)
	{

		/*$query=$this->db->query("call cezona(".$idZona.",0,'".$fecha."','".$intervalo."')");
		return $query->result_array();*/
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
	 	$this->db->where('ventas.tipo_venta',0);	 	
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}


	/*
	* VENTAS POR CLIENTE
	*/
 

 	//metodo para obtener las ventas por cliente en efectivo en una fecha especifica
	public function efectivoClienteFecha($idCliente,$fecha)
	{
		/*$query=$this->db->query("call cecliente('".$idCliente."',1,'".$fecha."','".$fecha."')");
		return $query->result_array();*/

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
	 	$this->db->where('ventas.tipo_venta',1);
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}


	//metodo para obtener las ventas por cliente en efectivo en un intervalo de 2 fecha
	public function efectivoClienteIntervalo($idCliente,$fecha,$intervalo)
	{
		/*$query=$this->db->query("call cecliente('".$idCliente."',1,'".$fecha."','".$intervalo."')");
		return $query->result_array();*/
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
	 	$this->db->where('ventas.tipo_venta',1);
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}


	//metodo para obtener las ventas a credito por cliente en una fecha espeficica
	public function creditoClienteFecha($idCliente,$fecha)
	{

		/*$query=$this->db->query("call cecliente('".$idCliente."',0,'".$fecha."','".$fecha."')");
		return $query->result_array();*/
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
	 	$this->db->where('ventas.tipo_venta',0);
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}


	//metodo para obtener las ventas a credito por cliente en un intervalo de 2 fecha
	public function creditoClienteIntervalo($idCliente,$fecha,$intervalo)
	{
		/*$query=$this->db->query("call cecliente('".$idCliente."',0,'".$fecha."','".$intervalo."')");
		return $query->result_array();*/
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
	 	$this->db->where('ventas.tipo_venta',0);
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}


	/*
	*	VENTAS POR VENDEDOR(USUARIO)
	*
	*/


	//	metodo para obtener las ventas en efectivo por vendedor en una fecha especifica
	public function efectivoVendedorFecha($idVendedor,$fecha)
	{
		/*$query=$this->db->query("call ceusuario(".$idVendedor.",1,'".$fecha."','".$fecha."')");
		return $query->result_array();*/
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
	 	$this->db->where('ventas.tipo_venta',1);
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}


	//metodo para obtener las ventas en efectivo en un intervalo de 2 fecha
	public function efectivoVendedorIntervalo($idVendedor,$fecha,$intervalo)
	{	
		/*$query=$this->db->query("call ceusuario(".$idVendedor.",1,'".$fecha."','".$intervalo."')");
		return $query->result_array();*/

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
	 	$this->db->where('ventas.tipo_venta',1);
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}


	//metodo para obtener las ventas a credito en una fecha especifica
	public function creditoVendedorFecha($idVendedor,$fecha)
	{
		/*$query=$this->db->query("call ceusuario(".$idVendedor.",0,'".$fecha."','".$fecha."')");
		return $query->result_array();*/
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
	 	$this->db->where('ventas.tipo_venta',0);
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}


	//metodo para obtener las ventas a credito entre 2 fechas
	public function creditoVendedorIntervalo($idVendedor,$fecha,$intervalo)
	{
		/*$query=$this->db->query("call ceusuario(".$idVendedor.",0,'".$fecha."','".$intervalo."')");
		return $query->result_array();		*/
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
	 	$this->db->where('ventas.tipo_venta',0);
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}


	/*
	*	VENTAS POR CADENA
	*
	*/

	public function efectivoCadenaFecha($idCadena,$fecha)
	{
		/*$query=$this->db->query("call cecadena(".$idCadena.",1,'".$fecha."','".$fecha."')");
		return $query->result_array();*/
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
	 	$this->db->where('ventas.tipo_venta',1);	 	
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}
	public function efectivoCadenaIntervalo($idCadena,$fecha,$intervalo)
	{
		/*$query=$this->db->query("call cecadena(".$idCadena.",1,'".$fecha."','".$intervalo."')");
		return $query->result_array();*/

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
	 	$this->db->where('ventas.tipo_venta',1);	 	
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}

	public function creditoCadenaFecha($idCadena,$fecha)
	{
		/*$query=$this->db->query("call cecadena(".$idCadena.",0,'".$fecha."','".$fecha."')");
		return $query->result_array();*/

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
	 	$this->db->where('ventas.tipo_venta',0);	 	
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}

	public function creditoCadenaIntervalo($idCadena,$fecha,$intervalo)
	{
		/*$query=$this->db->query("call cecadena(".$idCadena.",0,'".$fecha."','".$intervalo."')");
		return $query->result_array();*/

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
	 	$this->db->where('ventas.tipo_venta',0);	 	
	 	$this->db->group_by('detalle_venta.sku');
	 	$query=$this->db->get()->result_array();
	 	return $query;
	}
}

/* End of file ventasce_model.php */
/* Location: ./application/models/ventasce_model.php */

?>
