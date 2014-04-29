<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detalle_venta_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	//metodo para insertar un nuevo registro a la base de datos
	// parametro 1: id de la venta, parametro 2: arreglo el cual tiene los campos faltantes para insertar
	public function insert($id_venta,$producto){
		
		$insert=array(
			'id_venta'=>$id_venta,
			'sku'=>$producto['sku'],
			'precio_unitario'=>$producto['precio'],
			'cantidad'=>$producto['cantidad']			
			);
		$this->db->insert('detalle_venta',$insert);
	}
	
	

}

/* End of file detalle_venta_model.php */
/* Location: ./application/models/orm/detalle_venta_model.php */
?>