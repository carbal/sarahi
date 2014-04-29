<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* 	mapeo relacional de objetos, modelo correspondiente a la tabla: ventas de la base datos
*	
*/

class Ventas_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}


	//obtenemos informacion de una venta especifica 
	public function getVenta($idVenta){
		$this->db->where('id_venta',$idVenta);
		$query=$this->db->get('ventas');
		return $query->row_array();
	}

	//metodo para insertar un nuevo registro a la tabla
	// devuelve el ultimo id->PK insertado en la base de datos
	public function insert($insert){

		$this->db->insert('ventas',$insert);
		return $this->db->insert_id();

	}

	public function updateImporte($id_venta,$update)
	{					
		$this->db->where('id_venta',$id_venta);
		$this->db->update('ventas',$update);
	}

	public function updateEstado($id_venta,$update)
	{
		$update['estado']=1;
		$this->db->where('id_venta',$id_venta);
		$this->db->update('ventas',$update);
	}

	public function clienteCuenta($rfc){
		$this->db->where('estado',1);
		$this->db->where('rfc',$rfc);
		$query=$this->db->get('ventas');
		return $query->result_array();
	}

}

/* End of file ventas_model.php */
/* Location: ./application/models/orm/ventas_model.php */
?>