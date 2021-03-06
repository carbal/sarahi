<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*mapeo relacional de objetos, el modelo corresponde a la tabla: clientes
*
*/

class Clientes_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}


	//obtener todos los clientes
	public function all()
	{
		$query = $this->db->get('clientes');
		return $query->result_array();
	}

	//metodo para buscar el nombre del cliente ::autocompletar->jquery
	public function likeNombre($cadena)
	{
		$this->db->select('*');
	 	$this->db->like('nombre',$cadena);	
	 	$query=$this->db->get('clientes'); 	
	 	return $query->result_array();
	}
	//metodo para obtener los clientes pertinentes al admnistrador en el proceso de abonar una cuenta
	//por pagar
	public function likeAdmon($cadena)
	{
		$this->db->like('nombre',$cadena);
		$this->db->where('id_cadena !=',1);
		$this->db->where('id_cadena !=',2);
		$this->db->where('id_cadena !=',3);
		$query=$this->db->get('clientes');		
		return $query->result_array();

	}

	public function likeVendedor($cadena,$zona)
	{
		$this->db->like('nombre',$cadena);
		$this->db->where('estado',$zona);
		$this->db->where('id_cadena',$zona);		
		$query=$this->db->get('clientes');
		return $query->result_array();
	}

	//metodo para buscar el nombre del cliente en su correspondiente zona
	//autocompletar->jquery
	public function likeNombreZona($cadena,$zona_cliente)
	{
		$this->db->select('*');
		$this->db->like('nombre',$cadena);
		$this->db->where('estado',$zona_cliente);
		$query=$this->db->get('clientes');
		return $query->result_array();
	}
	
	//obtener cliente que le pertenece tal rfc
	public function whereCliente($rfc){
		$query=$this->db->get_where('clientes',array('rfc'=>$rfc));
		return $query->row_array();
	}

	//obtener nombre de un cliente especifico
	public function whereNombre($nombre)
	{
		$query=$this->db->get_where('clientes',array('nombre'=>$nombre));
		return $query->result_array();
	}

	//obtener los clientes por zona
	public function whereZona($zona)
	{
		$this->db->where('estado',$zona);
		return $this->db->get('clientes')->result_array();
	}

	//insertamos un nuevo registro a la tabla
	public function insert()
	{
		$insert=array(
		'rfc'=>$this->input->post('rfc'),
		'id_cadena'=>$this->input->post('id_cadena'),
		'nombre'=>$this->input->post('nombre'),
		'calle'=>$this->input->post('calle'),
		'no_exterior'=>$this->input->post('no_exterior'),
		'no_interior'=>$this->input->post('no_interior'),
		'colonia'=>$this->input->post('colonia'),
		'municipio'=>$this->input->post('municipio'),
		'estado'=>$this->input->post('estado'),
		'pais'=>'MÉXICO',
		'correo'=>$this->input->post('correo'),
		'referencia'=>$this->input->post('referencia'),
		'cp'=>$this->input->post('cp'),
		'regimen'=>$this->input->post('regimen'),
		'representante'=>$this->input->post('representante')
		);
		$this->db->insert('clientes',$insert);
	}

	public function update()
	{
		$update=array(
		'id_cadena'=>$this->input->post('id_cadena'),
		'nombre'=>$this->input->post('nombre'),
		'calle'=>$this->input->post('calle'),
		'no_exterior'=>$this->input->post('no_exterior'),
		'no_interior'=>$this->input->post('no_interior'),
		'colonia'=>$this->input->post('colonia'),
		'municipio'=>$this->input->post('municipio'),
		'estado'=>$this->input->post('estado'),
		'pais'=>'MÉXICO',
		'correo'=>$this->input->post('correo'),
		'referencia'=>$this->input->post('referencia'),
		'cp'=>$this->input->post('cp'),
		'regimen'=>$this->input->post('regimen'),
		'representante'=>$this->input->post('representante')
		);
		$this->db->update('clientes',$update,array('rfc'=>$this->input->post('rfc')));
	}

}

/* End of file clientes_model.php */
/* Location: ./application/models/orm/clientes_model.php */
?>