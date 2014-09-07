<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BitacoraModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	//método que retorna lo que vendio y cobro un vendedor en un dia especifico
	public function getDetalles()
	{
		$fecha = $this->input->post('fecha');
		$this->db->select('
		u.id_usuario,CONCAT(u.nombres," ",u.apellidos) vendedor,
		SUM(v.total_venta) venta,
		(SELECT IFNULL(SUM(cc.abono),0) from usuario uu
		INNER JOIN ventas vv on uu.id_usuario = vv.id_usuario
		INNER JOIN cuentasporpagar cc on cc.id_venta = vv.id_venta
		WHERE cc.fecha ="'.$fecha.'" and uu.id_usuario = u.id_usuario) abono
		',FALSE);
		$this->db->from('usuario u');
		$this->db->join('ventas v', 'v.id_usuario = u.id_usuario', 'inner');
		$this->db->where('v.fecha', $fecha);
		$this->db->group_by('u.id_usuario');
		$this->db->order_by('u.id_usuario');
		$query = $this->db->get();
		return $query->result_array();
	}

}

/* End of file bitacoraModel.php */
/* Location: ./application/models/bitacoraModel.php */