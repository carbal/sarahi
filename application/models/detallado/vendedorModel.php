<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vendedorModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function vendedor()
	{
		$id        = $this->input->post('id');
		$fecha     = $this->input->post('fecha'); 
		$intervalo = $this->input->post('intervalo');
		$apartir   = $this->input->post('apartir'); 
		$this->db->select('
		v.id_venta AS id_venta,
		v.importe AS importe,
		v.fecha AS fecha,
		c.nombre AS cliente,
		v.tipo_venta AS tipo,
		v.estado AS estado');
		$this->db->from('ventas v');
		$this->db->join('detalle_venta dv','v.id_venta = dv.id_venta','inner');
		$this->db->join('producto p','dv.sku = p.sku','inner');
		$this->db->join('clientes c','v.rfc = c.rfc','inner');
		$this->db->where('v.id_usuario',$id);
		$this->db->where('v.fecha >=',$fecha);

		if($intervalo == '')
			$this->db->where('v.fecha <=',$fecha);
		else
			$this->db->where('v.fecha <=',$intervalo);

		$this->db->order_by('v.id_venta','DESC');
		$this->db->limit(10,$apartir);
		return $this->db->get();
		
	}

	public function gerRows()
	{
		$id        = $this->input->post('id');
		$fecha     = $this->input->post('fecha'); 
		$intervalo = $this->input->post('intervalo');
		$apartir   = $this->input->post('apartir'); 
		$this->db->select('
		v.id_venta AS id_venta,
		v.importe AS importe,
		v.fecha AS fecha,
		c.nombre AS cliente,
		v.tipo_venta AS tipo,
		v.estado AS estado');
		$this->db->from('ventas v');
		$this->db->join('detalle_venta dv','v.id_venta = dv.id_venta','inner');
		$this->db->join('producto p','dv.sku = p.sku','inner');
		$this->db->join('clientes c','v.rfc = c.rfc','inner');
		$this->db->where('v.id_usuario',$id);
		$this->db->where('v.fecha >=',$fecha);

		if($intervalo == '')
			$this->db->where('v.fecha <=',$fecha);
		else
			$this->db->where('v.fecha <=',$intervalo);

		$this->db->order_by('v.id_venta','DESC');
		$query = $this->db->get();
		return $this->db->num_rows();
	}

}

/* End of file vendedor_model.php */
/* Location: ./application/models/detallado/vendedor_model.php */
?>