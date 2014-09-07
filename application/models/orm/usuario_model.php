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
		$query = $this->db->get('usuario');
		return $query->result_array();
	} 

	public function whereUsuario($idUsuario)
	{
		$this->db->where('id_usuario',$idUsuario);
		$query=$this->db->get('usuario');
		return $query->row_array();
	}

	public function all()
	{
		$query = $this->db->get('usuario');
		return $query->result_array();
	}
	//metodo para insertar un nuevo registro en la tabla
	public function insert()
	{
		$data=array(
			'nombres'   => $this->input->post('nombres'),
			'apellidos' => $this->input->post('apellidos'),
			'usuario'   => $this->input->post('usuario'),
			'domicilio' => $this->input->post('domicilio'),
			'password'  => $this->encrypt->encode($this->input->post('password')),
			'id_zona'   => $this->input->post('id_zona'),
			'tipo'      => $this->input->post('tipo') 
		);
		$this->db->insert('usuario',$data);	
	}

	//actualizar registro
	public function update()
	{
		$update=array(
			'nombres'   => $this->input->post('nombres'),
			'apellidos' => $this->input->post('apellidos'),
			'usuario'   => $this->input->post('usuario'),
			'domicilio' => $this->input->post('domicilio'),
			'password'  => $this->encrypt->encode($this->input->post('password')),
			'id_zona'   => $this->input->post('id_zona'),
			'tipo'      => $this->input->post('tipo') 
		);

		$this->db->update('usuario',$update,array('id_usuario' => $_POST['id_usuario']));
	}

	//metodo para comprobar si un usuario es valido o existe
	public function val_usuario()
	{
		$query=$this->db->get_where('usuario',array('usuario' => $this->input->post('user')));
		return $query->row_array();
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