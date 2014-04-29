<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuentasporpagar_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	//metodo para comprobar si cliente ha abonado ha esta venta
	public function filasCuentaporPagar($id_venta)
	{
		$this->db->where('id_venta',$id_venta);
		$query=$this->db->get('cuentasporpagar');
		return $query->num_rows();
	}
	
	//metodo para obtener una cuenta por pagar en funcion de su id_venta
	public function get_CuentaporPagar($id_venta)
	{
		$this->db->where('id_venta',$id_venta);
		$this->db->order_by('id_cpp','desc');
		$query=$this->db->get('cuentasporpagar');
		return $query->result_array();
	}

	//insertar nuevo registro a la tabla
	public function insert($id_venta,$abono,$porpagar){
		$hora = new DateTime();
		$hora->setTimezone(new DateTimeZone('America/Mexico_City'));

		$insert=array(
			'id_venta'=>$id_venta,
			'abono'=>$abono,
			'porpagar'=>$porpagar,
			'fecha'=>$hora->format("Y-m-d")
			);
		$this->db->insert('cuentasporpagar',$insert);

	}
	
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
		$query=$this->db->get('cuentasporpagar');
		$this->db->limit(1,0);
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

/* End of file cuentasporpagar_model.php */
/* Location: ./application/models/orm/cuentasporpagar_model.php */
?>