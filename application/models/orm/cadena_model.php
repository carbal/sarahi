<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*mapeo ralacional de objetos
*modelo correspondiente a la tabla:cadena
* la funcion de esta tabla es almacenar las cadenas 
*por ejemplo cadena: oxxo cancun, oxxo merida, super willys merida,etc
*/

class Cadena_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	//obtener todos los registros de la tabla cadena
	public function select(){
		$query=$this->db->get('cadena');
		return $query->result_array();
	}

	//busqueda en el campo cadena mediante like
	public function likeCadenas($cadena)
	{
		$this->db->like('cadena',$cadena);
		$query=$this->db->get('cadena');
		return $query->result_array();
	}

	//obtener cadenas pertinentes al administrador proceso de abonar cuentas por pagar
	public function likeAdmon($cadena){
		$this->db->where('id_cadena !=',1);
		$this->db->where('id_cadena !=',2);
		$this->db->where('id_cadena !=',3);
		$this->db->like('cadena',$cadena);
		$query=$this->db->get('cadena');
		return $query->result_array();
	}

	

	//comprobar si una cadena ya existe en la tabla, para evitar que se repita
	public function existeCadena(){

		$data=array(
			'cadena'=>$this->input->post('cadena')
			);
		$query=$this->db->get_where('cadena',$data);
		return $query->num_rows();

	}

	//metodo para insertar un nuevo registro
	public function insert(){
		$insertar=array(
			'cadena'=>$this->input->post('cadena'),
			'id_zona'=>$this->input->post('zona'),
			'representante'=>$this->input->post('representante'),
			'telefono'=>$this->input->post('telefono')
			);
		$this->db->insert('cadena',$insertar);
		//IMPORTANTE se  retorna el PK generado al insertar el registro en la tabla
		return $this->db->insert_id();
	}

	

}

/* End of file cadena_model.php */
/* Location: ./application/models/orm/cadena_model.php */
?>