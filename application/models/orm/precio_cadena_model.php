<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*mapeo relacional de objetos
*modelo correspondiente a la tabla: precio_cadena
* La funcion principal de esta tabla es almacenar los precios de los productos
* que corresponde a cada cadena, por  ejemplo un producto puede tener diferente 
*precio para cada cadena
*/

class Precio_cadena_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	//eliminar precio_cadena mediante su PK id_precio
	public function delete($id_precio)
	{
		$this->db->delete('precio_cadena',array('id_precio'=>$id_precio));
	}
	//insertar registros a la tabla
	public function insert($registros)
	{
		$this->db->insert('precio_cadena',$registros);

	}
	//metodo para comprobar si el precio del producto ya ha sido agregado para esta cadena
	public function existePrecioProducto($idCadena,$sku)
	{
		$where=array(
			'id_cadena'=>$idCadena,
			'sku'=>$sku
			);
		$this->db->where($where);
		$query=$this->db->get('precio_cadena');
		return $query->num_rows();
	}

	//actualizar precio del producto 

	public function updatePrecioProducto($where,$precioNuevo){
		$this->db->where($where);
		$this->db->update('precio_cadena',array('precio'=>$precioNuevo));
	}


	

}

/* End of file precio_cadena_model.php */
/* Location: ./application/models/orm/precio_cadena_model.php */
?>