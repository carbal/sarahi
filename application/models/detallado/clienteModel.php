<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class clienteModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function cliente()
	{
		$id        = $this->input->post('id'); 
		$fecha     = $this->input->post('fecha'); 
		$intervalo = $this->input->post('intervalo'); 
		$apartir   = $this->input->post('apartir'); 

		$this->db->select('v.id_venta AS id_venta,
		v.importe AS importe,
		u.nombres AS vendedor,
		v.fecha AS fecha,
		v.tipo_venta AS tipo,
		v.estado AS estado');
		$this->db->from('ventas v');
		$this->db->join('detalle_venta dv','v.id_venta = dv.id_venta','inner');
		$this->db->join('producto p','dv.sku = p.sku','inner');
		$this->db->join('usuario u','v.id_usuario = u.id_usuario','inner');
		$this->db->where('v.rfc',$id);
		$this->db->where('v.fecha >=',$fecha);

		if($intervalo == '')
			$this->db->where('v.fecha <=',$fecha);
		else
			$this->db->where('v.fecha <=',$intervalo);

		$this->db->order_by('v.id_venta','DESC');
		$this->db->limit(10,$apartir);
	 	return  $this->db->get();
	}

	public function getRows()
	{
		$id        = $this->input->post('id'); 
		$fecha     = $this->input->post('fecha'); 
		$intervalo = $this->input->post('intervalo'); 
		$apartir   = $this->input->post('apartir'); 

		$this->db->select('v.id_venta AS id_venta,
		v.importe AS importe,
		u.nombres AS vendedor,
		v.fecha AS fecha,
		v.tipo_venta AS tipo,
		v.estado AS estado');
		$this->db->from('ventas v');
		$this->db->join('detalle_venta dv','v.id_venta = dv.id_venta','inner');
		$this->db->join('producto p','dv.sku = p.sku','inner');
		$this->db->join('usuario u','v.id_usuario = u.id_usuario','inner');
		$this->db->where('v.rfc',$id);
		$this->db->where('v.fecha >=',$fecha);

		if($intervalo == '')
			$this->db->where('v.fecha <=',$fecha);
		else
			$this->db->where('v.fecha <=',$intervalo);

		$this->db->order_by('v.id_venta','DESC');
		$query = $this->db->get();
	 	return  $query->num_rows();
	}

}

/* End of file clientes_model.php */
/* Location: ./application/models/detallado/clientes_model.php */
?>