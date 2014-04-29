<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visitas_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();		
	}

	public function insert($insert){
		$this->db->insert('visitas',$insert);
	}

}

/* End of file visitas_model.php */
/* Location: ./application/models/orm/visitas_model.php */