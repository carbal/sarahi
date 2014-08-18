<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class zonaModel extends CI_Model {

	/*
	* modelo para obtener las ventas detalladas por zona, por estado
	*/
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}


	//paginar las ventas terminadas hechas por zona
	public function zona()
	{
		//die(var_dump($_POST));
		$id        = $this->input->post('id');
		$fecha     = $this->input->post('fecha'); 
		$intervalo = $this->input->post('intervalo'); 
		$apartir   = $this->input->post('apartir');
		$this->db->select('
		v.id_venta   AS id_venta,
		v.importe    AS importe,
		c.nombre     AS cliente,
		u.nombres    AS vendedor,
		v.fecha      AS fecha,
		v.tipo_venta AS tipo,
		v.estado     AS estado');
		$this->db->from('ventas v');
		$this->db->join('clientes c','v.rfc = c.rfc','inner');
		$this->db->join('usuario u','v.id_usuario = u.id_usuario','inner');
		$this->db->where('u.id_zona',$id);
		$this->db->where('v.fecha >=',$fecha);

		if($intervalo == '') //esto no se debe de hacer en el modelo!!!
			$this->db->where('v.fecha <=',$fecha);
		else
			$this->db->where('v.fecha <=',$intervalo);

		$this->db->order_by('v.id_venta','DESC');
		$this->db->limit(1,$apartir);
		return $this->db->get();
		//die(var_dump($this->db->get()));
	}

	public function getRows()
	{

		$id        = $this->input->post('id');
		$fecha     = $this->input->post('fecha'); 
		$intervalo = $this->input->post('intervalo'); 
		$apartir   = $this->input->post('apartir');
		//die(var_dump($_POST));
		$this->db->select('
		v.id_venta   AS id_venta,
		v.importe    AS importe,
		c.nombre     AS cliente,
		u.nombres    AS vendedor,
		v.fecha      AS fecha,
		v.tipo_venta AS tipo,
		v.estado     AS estado');
		$this->db->from('ventas v');
		$this->db->join('clientes c','v.rfc = c.rfc','inner');
		$this->db->join('usuario u','v.id_usuario = u.id_usuario','inner');
		$this->db->where('u.id_zona',$id);
		$this->db->where('v.fecha >=',$fecha);
		if($intervalo == '') //esto no se debe de hacer en el modelo!!!
			$this->db->where('v.fecha <=',$fecha);
		else
			$this->db->where('v.fecha <=',$intervalo);

		$this->db->order_by('v.id_venta','DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
}

/* End of file zona_model.php */
/* Location: ./application/models/detallado/zona_model.php */
?>