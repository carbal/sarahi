<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*	 mapeo ralaciona de objetos, el modelo corresponde a la tabla: productos_enalmacen
*	la tabla nos permite almacenar productos en un almacen por zona: yucatan, quintana roo, campeche, etc	
* 	NOTA: las operaciones loginas de if fueron implementadas en el modelo, pero esto es incorrecto porque
*	viola el paradigma MVC , pero para no ensuciar los mas el código del controlador decidi ponerlos aqui
*/

class Productos_enalmacen_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	//insertar un nuevo registro a la tabla
	public function insertProductoAlmacen($producto,$zona,$cantidad)
	{
		$data=array(
			'id_zona'=>$zona,
			'id_almacen'=>$zona,
			'sku'=>$producto,			
			'existencia'=>$cantidad,
			'stock_min'=>25,
			'stock_max'=>100
			);
		$this->db->insert('productos_enalmacen',$data);
	}

	//obtener un producto pro id
	public function getProducto($idProducto){	
		$producto = $this->db->get_where('productos_enalmacen',array('id_proalmacen'=>$idProducto));
		return $producto->row_array();
	}

	//actualizar producto
	public function updateProducto($id,$data){
		$this->db->where('id_proalmacen',$id);
		$this->db->update('productos_enalmacen',$data);		
	}


	//actualizar el campo existencia, de la tabla 
	public function sumarProductoAlmacen($producto,$zona,$cantidad)
	{
		$data=array(
				'sku'=>$producto,
				'id_zona'=>$zona
			);
		$this->db->select('existencia');
		$query=$this->db->get('productos_enalmacen',$data);
		if($query->num_rows()==1){			
			$nueva_cantidad=$query->row()->existencia+$cantidad;

			$this->db->where($data);
			$update=array(
				'existencia'=>$nueva_cantidad
				);

			$this->db->update('productos_enalmacen',$update);
		}else{
			return FALSE;
		}

	}


	//comprobar si existen un producto en el almacen,para evitar agregar 2 veces un producto
	//en el mismo almacen
	public function existeProductoAlmacen($producto,$zona)
	{
		$data=array(
			'sku'=>$producto,
			'id_zona'=>$zona);
		$query=$this->db->get_where('productos_enalmacen',$data);

		if($query->num_rows()==0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	//metodo para actualizar la existencias en almacen
	public function updateExistencia($idZona,$sku,$cantidad)
	{
		$where=array(
			'id_zona'=>$idZona,
			'sku'=>$sku
			);
		$this->db->select('existencia');
		$this->db->where($where);
		//OBTENEMOS LA EXISTENCIA DEL PRODUCTO EN LA ZONA ESPECIFICADA
		$existencia=$this->db->get('productos_enalmacen')->row_array();
		//LA EXISTENCIA SE LE DEBE RESTAR LA CANTIDAD QUE ACABA DE SER VENDIDA
		$nuevaExistencia=$existencia['existencia']-$cantidad;
		//AHORA DEBEMOS AGREGAR LA NUEVA EXISTENCIA A LA BASE DE DATOS
		$this->db->where($where);
		$this->db->update('productos_enalmacen',array('existencia'=>$nuevaExistencia));

	}

	public function obtenerExistenciaProducto($idZona,$sku){
		$where=array(
			'id_zona'=>$idZona,
			'sku'=>$sku
			);
		$this->db->select('existencia')->where($where);
		$query=$this->db->get('productos_enalmacen');
		return $query->row_array();
	}
	

}

/* End of file productos_enalmacen_model.php */
/* Location: ./application/models/orm/productos_enalmacen_model.php */
?>