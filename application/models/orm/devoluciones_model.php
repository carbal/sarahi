<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Devoluciones_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();		
	}
	

	public function insert($insert)
	{
		$this->db->insert('devoluciones',$insert);
	}

}

/* End of file devoluciones_model.php */
/* Location: ./application/models/orm/devoluciones_model.php */