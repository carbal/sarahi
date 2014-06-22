<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ExistenciasModel extends CI_Model {


	public function getUrgentes()
	{

		$this->db->where('total <=','stock_min');	
		$query = $this->db->get('existencias');	
		return $query->result_array();
		/*$this->db->select('
		pa.id_proalmacen,
		pa.od_almacen,
		pa.id_zona,
		pa.sku,
		pa.stock_min,
		pa.stock_max,
		pa.existencia AS ealmacen,
		IFNULL(sub.existencia,0) AS esubalmacen,
		(pa.existencia+IFNULL(sub.existencia)) AS total');
		$this->db->from('productos_enalmacen pa');
		$this->db->join('subalmacen sub','pa.id_almacen = sub.id_almacen AND pa.sku = sub.sku','LEFT');
		$this->db->order_by('pa.id_zona');
		$query =  $this->db->get();
		return $query->result_array();*/
	}

	public function getPrecauciones()
	{
		$this->db->where('total <=','(stock_min + 50)');
		$query = $this->db->get('existencias');
		return $query->result_array();
	}
	

}

/* End of file existenciasModel.php */
/* Location: ./application/models/existenciasModel.php */