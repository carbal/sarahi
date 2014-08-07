<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Abonar_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();		
	}



//obtenemos los pagos hechos sobre una venta en especial

	public function pagosporVenta($id_venta)
	{
		$this->db->where('id_venta',$id_venta);
		$this->db->order_by('id_cpp','desc');
		$query=$this->db->get('cuentasporpagar');
		return $query->result_array();

	}

	public function ultimopago($id_venta)
	{
		$this->db->where('id_venta',$id_venta);
		$this->db->order_by('id_cpp','desc');
		$this->db->limit(1,0);
		$query=$this->db->get('cuentasporpagar');
		return $query->row_array();
	}

	public function primerpago($id_venta)
	{	
		$this->db->where('id_venta',$id_venta);
		$this->db->order_by('id_cpp','asc');
		$query=$this->db->get('cuentasporpagar');
		$this->db->limit(1,0);
		return $query->row_array();
	}


	

}

/* End of file abonar_model.php */
/* Location: ./application/models/orm/abonar_model.php */

?>