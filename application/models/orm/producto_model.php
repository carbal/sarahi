<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*mapeo relacional de objetos
*modelo correspondiente a la tabla:producto
*/

class Producto_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	//metodo para seleccionar todos los registros de la tabla
	public function select()
	{
		$query=$this->db->get('producto');
		return $query->result_array();
	}

	//metodo para insertar un nuevo registro en la tabla
	public function insert()
	{
		$insert=array(
			'referencia'=>$this->input->post('referencia'),
			'sku'=>$this->input->post('sku'),
			'descripcion'=>$this->input->post('descripcion'),
			'unidad_medida'=>$this->input->post('um'),
			'categoria'=>$this->input->post('categoria'),
			'precio_costo'=>$this->input->post('precioc'),
			'precio_venta'=>$this->input->post('preciov')
			);
		$this->db->insert('producto',$insert);
	}

	//metodo para saber si el sku existen en la base de datos
	//para evitar sku, folios, codigo de barras repetidos
	//buscamos mediante PK "SKU"
	public function existeProducto()
	{
		$query=$this->db->get_where('producto',array('sku'=>$this->input->post('sku')));
		return $query->num_rows();
	}

	

}

/* End of file producto_model.php */
/* Location: ./application/models/orm/producto_model.php */
?>