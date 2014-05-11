<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
* modelo perteneciente al usuario administrador, este modelo contiene consultas especiales a
*la base de datos pertenecientes a llamadas(call)a procedimientos almacenados y uniones(join) de tablas
*
*/
class Crud_model extends CI_Model {

   	public function __construct()
	 {
	 	parent::__construct();	 
	 		 	
	 }
	
		
	public function almacenZona($id_almacen){
		/*$query=$this->db->query('call almacenzona('.$id_almacen.')');
		return $query;	*/

		$this->db->select('
		productos_enalmacen.id_proalmacen AS id,
		producto.descripcion AS descripcion,
		producto.sku AS sku,
		producto.categoria AS categoria,
		producto.precio_costo AS costo,
		producto.precio_venta AS venta,		
		Sum(productos_enalmacen.existencia) AS existencia');
		$this->db->from('producto');
		$this->db->join('productos_enalmacen','producto.sku = productos_enalmacen.sku','inner');
		$this->db->where('productos_enalmacen.id_zona',$id_almacen);
		$this->db->group_by('producto.sku');
		$query=$this->db->get();
		return $query->result_array();

	}
	//METODO PARA OBTENER EL NUMERO DE FILAS EN FUNCION DEL ALMACEN EN INTERVALOS LIMIT 0,10;
	//LLAMA A PROCEDIMIENTO ALMACENADO
	public function limitAlmacen($id,$apartir,$porpagina){
		/*$query=$this->db->query('call almacen_zona('.$id.','.$apartir.','.$porpagina.')');*/
		$this->select('
		productos_enalmacen.id_proalmacen AS id,
		producto.descripcion AS descripcion,
		producto.sku AS sku,
		producto.categoria AS categoria,
		producto.precio_costo AS costo,
		producto.precio_venta AS venta,
		productos_enalmacen.existencia AS existencia');
		$this->from('productos,productos_enalmacen');
		$this->where('producto.sku','productos_enalmacen.sku');
		$this->where('productos_enalmacen.id_zona',"");

		return $query;		
	}
		
	/*
	* SECCION DE METODOS SELECT 
	*SELECT ACTIVE RECORD
	*/
	public function selectPrecioProductosCadena($idCadena){
		$this->db->join('producto','producto.sku=precio_cadena.sku','inner');
		$query=$this->db->get_where('precio_cadena',array('precio_cadena.id_cadena'=>$idCadena));
		return $query->result_array();

	}
	
	
}

?>
