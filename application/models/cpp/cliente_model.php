<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();		
	}

	public function cliente($idCliente,$apartir)
	{
		$query=$this->db->query("call cppadmoncliente('".$idCliente."',".$apartir.")");
		return $query;
	}

	public function rowscliente($idCliente)
	{
		$query=$this->db->query("call rowscppcliente('".$idCliente."')");
		return $query;
	}

	

}

/* End of file cliente_model.php */
/* Location: ./application/models/cpp/cliente_model.php */
?>