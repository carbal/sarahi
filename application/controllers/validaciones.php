<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validaciones extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->removeCache();
		$this->load->library('form_validation');		
		$this->load->model('orm/usuario_model');
		$this->load->model('orm/producto_model');
		$this->load->model('orm/cadena_model');
		$this->load->library('session');
		$this->load->model('orm/productos_enalmacen_model');
		$this->load->library('encrypt');
		$this->load->database();

		if(!$this->session->userdata('usuario')){		
			redirect(base_url(),'refresh');
		}		
	}

	public function removeCache()
	{
		$this->output->set_header('Last-Modified:gmdate("D, d MYH: i: s"..)GMT');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, post-check = 0, pre-check = 0 ");
		$this->output->set_header("Pragma: no-cache");
		$this->output->set_header("Expires: Mon, 26 de julio 1997 05:00:00 GMT");
	}


	//validar agregar existencia
	public function agregarExistencia()
	{
		if($this->input->is_ajax_request()){
		$this->form_validation->set_rules('zona', 'Zona', 'trim|required|integer|xss_clean|integer');
		$this->form_validation->set_rules('producto', 'Producto', 'trim|required|integer|xss_clean|integer');
		$this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required|integer|xss_clean');
			
		$this->form_validation->set_message('integer','El campo %s es obligatorio');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		$this->form_validation->set_error_delimiters('<div>','</div>');

		if($this->form_validation->run() == TRUE){

			$producto = $this->input->post('producto');
			$zona     = $this->input->post('zona');
			$cantidad = $this->input->post('cantidad');

			if($this->productos_enalmacen_model->existeProductoAlmacen($producto,$zona) == TRUE){
				$this->productos_enalmacen_model->insertProductoAlmacen($producto,$zona,$cantidad);
				
				echo json_encode(array('exito' => TRUE));
			}else{
				$this->productos_enalmacen_model->sumarProductoAlmacen($producto,$zona,$cantidad);
				
				echo json_encode(array('exito' => TRUE));
			}


		}else{

			echo json_encode( array('exito' => FALSE ,'html' => validation_errors()));
		}
		}else{
			show_404();
		}
	}

	
	/*
	* SECCION DE MÉTODOS CALLBACK DE LA LIBRERIA FORM_VALIDATION	
	*/
	//método para comprobar si una RFC es válido
	public function is_rfc()
	{
			if (preg_match("/^([A-Za-z]{3,4})[0-9]{2}((0{1}[0-9]{1})|(1{1}[0-2]{1}))((0{1}[1-9]{1})|([1-2]{1}[0-9]{1})|(3{1}[0-1]{1}))([A-Za-z0-9]{3}|[A-Za-z0-9]{3})$/", $this->input->post('rfc'))){
		    return TRUE;
		  } else {
		    return FALSE;
		  }
	}
	//metodo para comprobar que el rfc no se repita en la bd
	public function val_rfc()
	{
		$this->load->model('orm/clientes_model');
		if(count($this->clientes_model->whereCliente($this->input->post('rfc'))) > 0){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	//método para comprobar su una cadena existe, para evitar repetir cadenas
	public function val_cadena()
	{
		if($this->cadena_model->existeCadena() == 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	

	//metodo para comprobar si un SKU del producto existe, para evitar repetir productos
	public function val_sku($sku)
	{
		if($this->producto_model->existeProducto() == 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

}

/* End of file validaciones.php */
/* Location: ./application/controllers/validaciones.php */