<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {
	/*
	* Mapeo relacional de objetos(ORM)
	* modelo correspondiente a la tabla: usuario
	*
	*/
	public function __construct()
	{
		parent::__construct();
		
	}

	//metodo para obtener todos los registros de la tabla
	public function select()
	{
		$query=$this->db->get('usuario');
		return $query->result_array();
	} 

	public function whereUsuario($idUsuario)
	{
		$this->db->where('id_usuario',$idUsuario);
		$query=$this->db->get('usuario');
		return $query->row_array();
	}
	//metodo para insertar un nuevo registro en la tabla
	public function insert()
	{
		$data=array(
			'nombres'=>$this->input->post('nombre'),
			'apellidos'=>$this->input->post('apellido'),
			'domicilio'=>$this->input->post('domicilio'),
			'password'=>$this->input->post('pass'),
			'id_zona'=>$this->input->post('zonas'),
			'tipo'=>0
			);
		$this->db->insert('usuario',$data);	
	}

	//metodo para comprobar si un usuario es valido o existe
	public function val_usuario()
	{
		$data=array(
				'nombres'=>$this->input->post('user',TRUE),
				'password'=>$this->input->post('pass',TRUE)
			);
		$query=$this->db->get_where('usuario',$data);
		if($query->num_rows()==1){		
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	//obtener datos de usuario especifico
	public function get_usuario(){
		$data=array(
				'nombres'=>$this->input->post('user',TRUE),
				'password'=>$this->input->post('pass',TRUE)
			);
		$query=$this->db->get_where('usuario',$data);
		return $query->row_array();
	}

	//metodo para buscar en el campo nombres y apellidos de la tabla
	public function likeUsuario($cadena)
	{
		$this->db->select('id_usuario,nombres,apellidos');
	 	$this->db->like('nombres',$cadena);
	 	$this->db->or_like('apellidos',$cadena);
	 	$query=$this->db->get('usuario');
	 	return $query->result_array();
	}

	//obtenemos los usuarios por zona
	public function whereZona($idZona)
	{

		$this->db->where('id_zona', $idZona);
		$query=$this->db->get('usuario');
		return $query->result_array();

	}

}

/* End of file usuario_model.php */
/* Location: ./application/models/orm/usuario_model.php */

?>