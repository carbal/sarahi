<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subalmacen_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	

	public function allWhere($value)
	{	
		$this->db->where('id_usuario',$value);
		$query=$this->db->get('subalmacen');
		return $query->result_array();
	}

	public function insert($insert)
	{
		$data = $this->existeProducto($insert['id_usuario'],$insert['sku']);
		if(sizeof($data) > 0){
			$update = array(
				'id_usuario' => $data['id_usuario'],
				'sku'        => $data['sku'],
				'existencia' => $data['existencia'] + $insert['existencia']
			);
			$this->update($update);
		}else{
			$this->db->insert('subalmacen', $insert);
		}
	}

	public function update($data)
	{
		$where = array(
			'sku' => $data['sku'],
			'id_usuario' => $data['id_usuario']
		);
		$this->db->where($where);
		$this->db->update('subalmacen',array('existencia' =>$data['existencia']));
	}

	public function whereUsuario($id_usuario)
	{	
		$this->db->select('producto.descripcion,
		producto.sku,
		producto.categoria,
		subalmacen.existencia');
		$this->db->from('subalmacen');
		$this->db->join('producto','producto.sku = subalmacen.sku','inner');
		$this->db->where('id_usuario',$id_usuario);		
		$query=$this->db->get();
		return $query->result_array();
	}

	public function getWhereUser($idUsuario){
		$this->db->select('
		p.descripcion,
		p.categoria,
		p.sku,
		s.existencia');
		$this->db->from('subalmacen s');
		$this->db->join('producto p','p.sku = s.sku','inner');
		$this->db->where('s.id_usuario',$idUsuario);
		$query = $this->db->get();
		return $query->result_array();
	}

	//comprobar si un producto existe en el subalmacen de un vendedor
	public function existeProducto($id,$sku)
	{
		$where = array(
			'id_usuario'=> $id, //id del vendedor
			'sku' => $sku // sku del producto
		);

		$query = $this->db->get_where('subalmacen',$where);
		return $query->row_array();
	}

	public function updateExistencia($iduser,$sku,$cantidad)
	{
		$where = array('id_usuario'=>$iduser,'sku'=>$sku);
		$this->db->select('existencia');
		$this->db->where($where);
		//OBTENEMOS LA EXISTENCIA DEL PRODUCTO EN LA ZONA ESPECIFICADA
		$existencia=$this->db->get('subalmacen')->row_array();
		//LA EXISTENCIA SE LE DEBE RESTAR LA CANTIDAD QUE ACABA DE SER VENDIDA
		$nuevaExistencia=$existencia['existencia']-$cantidad;
		//AHORA DEBEMOS AGREGAR LA NUEVA EXISTENCIA A LA BASE DE DATOS
		$this->db->where($where);
		$this->db->update('subalmacen',array('existencia'=>$nuevaExistencia));

	}
}

/* End of file subalmacen_model.php */
/* Location: ./application/models/subalmacen_model.php */