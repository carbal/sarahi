<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* MODELO CORRESPONDIENTE PARA OBTENER LOS PRECIOS DE LOS PRODUCTOS EN FUNCION DE LA CADENA
*/
class Preciocadena_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}


	//obtener los productos permitidos en funcion de una cadena
	public function productoCadena($idCadena)
	{
		$this->db->select('*');		
		$this->db->join('precio_cadena','producto.sku=precio_cadena.sku','inner');
		$this->db->where('precio_cadena.id_cadena',$idCadena);
		$query=$this->db->get('producto');
		return $query->result_array();
	}

}

/* End of file preciocadena_model.php */
/* Location: ./application/models/preciocadena_model.php */