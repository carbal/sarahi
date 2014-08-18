<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class generalModel extends CI_Model {
 
	 public function __construct()
	 {
	 	parent::__construct();
	 	
	 }	 
	
	 //metodo para buscar venta por zona en una fecha especifica
	 public function zona()
	 {
	 	$zona      = $this->input->post('id'); 
	 	$fecha     = $this->input->post('fecha'); 
	 	$intervalo = $this->input->post('intervalo'); 
	 	$apartir   = $this->input->post('apartir'); 
	 	
	 	$this->db->select('
	 	p.descripcion      AS DESCRIPCION,
		p.sku              AS SKU,
		SUM(dv.cantidad)   AS UNIDADES,
		SUM(v.total_venta) AS TOTAL,
		SUM(v.iva_venta)   AS IVA,
		SUM(v.importe)     AS IMPORTE');
	 	$this->db->from('detalle_venta dv');
	 	$this->db->join('producto p','dv.sku = p.sku','inner');
	 	$this->db->join('ventas v','dv.id_venta = v.id_venta','inner');
	 	$this->db->join('usuario u','v.id_usuario = u.id_usuario','inner');
	 	$this->db->where('u.id_zona',$zona);
	 	$this->db->where('v.fecha >=',$fecha);

	 	if($intervalo == '')
	 		$this->db->where('v.fecha <=',$fecha);
	 	else
	 		$this->db->where('v.fecha <=',$intervalo);	

	 	$this->db->group_by('dv.sku');
	 	$query = $this->db->get();
	 	return $query->result_array();
	 	
	 	
	 }
	  //metodo para buscar venta por cliente en una fecha especifica
	 public function cliente()
	 {	 
	 	$cliente   = $this->input->post('id'); 
	 	$fecha     = $this->input->post('fecha'); 
	 	$intervalo = $this->input->post('intervalo'); 
	 	$apartir   = $this->input->post('apartir'); 
	 	
	 	$this->db->select('
	 	p.descripcion      AS DESCRIPCION,
		p.sku              AS SKU,
		SUM(dv.cantidad)   AS UNIDADES,
		SUM(v.total_venta) AS TOTAL,
		SUM(v.iva_venta)   AS IVA,
		SUM(v.importe)     AS IMPORTE');
	 	$this->db->from('detalle_venta dv');
	 	$this->db->join('producto p','dv.sku = p.sku','inner');
	 	$this->db->join('ventas v','dv.id_venta = v.id_venta','inner');	 	
	 	$this->db->where('v.rfc',$cliente);
	 	$this->db->where('v.fecha >=',$fecha);

	 	if($intervalo == '')
	 		$this->db->where('v.fecha <=',$fecha);
	 	else
	 		$this->db->where('v.fecha <=',$intervalo);

	 	$this->db->group_by('dv.sku');
	 	$query = $this->db->get();
	 	return $query->result_array();


	 	
	 }
	
	  //metodo para buscar venta por vendedor en una fecha especifica
	 public function vendedor()
	 {	
	 	$vendedor  = $this->input->post('id'); 
	 	$fecha     = $this->input->post('fecha'); 
	 	$intervalo = $this->input->post('intervalo'); 
	 	$apartir   = $this->input->post('apartir');

	 	$this->db->select('
	 	p.descripcion      AS DESCRIPCION,
		p.sku              AS SKU,
		SUM(dv.cantidad)   AS UNIDADES,
		SUM(v.total_venta) AS TOTAL,
		SUM(v.iva_venta)   AS IVA,
		SUM(v.importe)     AS IMPORTE');
	 	$this->db->from('detalle_venta dv');
	 	$this->db->join('producto p','dv.sku = p.sku','inner');
	 	$this->db->join('ventas v','dv.id_venta = v.id_venta','inner');	 	
	 	$this->db->where('v.id_usuario',$vendedor);
	 	$this->db->where('v.fecha >=',$fecha);

	 	if($intervalo == '')
	 		$this->db->where('v.fecha <=',$fecha);
	 	else
	 		$this->db->where('v.fecha <=',$intervalo);

	 	$this->db->group_by('dv.sku');
	 	$query = $this->db->get();
	 	return $query->result_array();
	 	
	 }

	
	 //metodo para buscar ventas por cadena en una fecha especifica
	 public function cadena()
	 {	
	 	$cadena    = $this->input->post('id'); 
	 	$fecha     = $this->input->post('fecha'); 
	 	$intervalo = $this->input->post('intervalo'); 
	 	$apartir   = $this->input->post('apartir');

	 	$this->db->select('
	 	p.descripcion      AS DESCRIPCION,
		p.sku              AS SKU,
		SUM(dv.cantidad)   AS UNIDADES,
		SUM(v.total_venta) AS TOTAL,
		SUM(v.iva_venta)   AS IVA,
		SUM(v.importe)     AS IMPORTE');
	 	$this->db->from('detalle_venta dv');
	 	$this->db->join('producto p','dv.sku = p.sku','inner');
	 	$this->db->join('ventas v','dv.id_venta = v.id_venta','inner');
	 	$this->db->join('clientes c','v.rfc = c.rfc','inner');	
	 	$this->db->where('c.id_cadena',$cadena);
	 	$this->db->where('v.fecha >=',$fecha);

	 	if($intervalo == '')
	 		$this->db->where('v.fecha <=',$fecha);
	 	else
	 		$this->db->where('v.fecha <=',$intervalo);
	 	
	 	$this->db->group_by('dv.sku');
	 	$query = $this->db->get();
	 	return $query->result_array();
	 }

}