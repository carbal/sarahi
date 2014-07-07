<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->removeCache();
		$this->load->database();
		$this->load->library('session');
		$this->load->library('form_validation');

		if(!$this->session->userdata('usuario')){		
			redirect(base_url());
		}elseif ($this->session->userdata('usuario') && $this->session->userdata('tipo')==0) {
			redirect(base_url().'index.php/vendedor/');
		}
	}

	public function removeCache()
	{
		$this->output->set_header('Last-Modified:gmdate("D, d MYH: i: s"..)GMT');
  		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, post-check = 0, pre-check = 0 ");
  		$this->output->set_header("Pragma: no-cache");
  		$this->output->set_header("Expires: Mon, 26 de julio 1997 05:00:00 GMT");
	}


	public function index()
	{
		$this->load->view('template/encabezado');
		$this->load->view('productos/indexView');
		$this->load->view('template/piepagina');
	}

	public function formProducto($sku = NULL)
	{

		if(!empty($sku)){
			$this->load->model('orm/producto_model');
			$js['producto'] = $this->producto_model->getProducto($sku);
			$data['js']     = $this->load->view('productos/jsProducto',$js,TRUE);
		}else{
			$data['js'] = $this->load->view('productos/jsProducto','',TRUE);
		}
		$this->load->view('template/encabezado');
		$this->load->view('productos/formProductoView',$data);
		$this->load->view('template/piepagina');
	}


	//insertar un nuevo producto
	public function insert()
	{
		//llamamos al modelo necesario
		$this->load->model('orm/producto_model');
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('referencia', 'Referencia', 'required|xss_clean');
			$this->form_validation->set_rules('sku', 'SKU', 'trim|required|xss_clean|callback_val_sku');
			$this->form_validation->set_rules('descripcion', 'Descripcion', 'required|xss_clean');
			$this->form_validation->set_rules('unidad_medida', 'Unidad de Medida', 'trim|required|xss_clean');
			$this->form_validation->set_rules('categoria', 'Categoria', 'trim|required|xss_clean');
			$this->form_validation->set_rules('precio_costo', 'Precio Costo', 'trim|required|is_natural_no_zero|xss_clean');
			$this->form_validation->set_rules('precio_venta', 'Precio Venta', 'trim|required|is_natural_no_zero|xss_clean');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('is_natural_no_zero','debe ser un entero y mayor a 0');	
			$this->form_validation->set_message('val_sku','El producto ya existe');
			$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

			if($this->form_validation->run() == TRUE){
				$this->producto_model->insert();				
				echo json_encode(array('success' => TRUE));
			}else{
				echo json_encode(array('success' => FALSE,'html' => validation_errors()));
			}

		}else{

			show_404();
		}

	}

	//actualizar un producto
	public function update()
	{
		//llamamos al modelo necesario
		$this->load->model('orm/producto_model');

		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('referencia', 'Referencia', 'required|xss_clean');
			$this->form_validation->set_rules('descripcion', 'Descripcion', 'required|xss_clean');
			$this->form_validation->set_rules('unidad_medida', 'Unidad de Medida', 'trim|required|xss_clean');
			$this->form_validation->set_rules('categoria', 'Categoria', 'trim|required|xss_clean');
			$this->form_validation->set_rules('precio_costo', 'Precio Costo', 'trim|required|is_natural_no_zero|xss_clean');
			$this->form_validation->set_rules('precio_venta', 'Precio Venta', 'trim|required|is_natural_no_zero|xss_clean');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('is_natural_no_zero','debe ser un entero y mayor a 0');	
			$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

			if($this->form_validation->run() == TRUE){
				$this->producto_model->update();				
				echo json_encode(array('success' => TRUE));
			}else{
				echo json_encode(array('success' => FALSE,'html' => validation_errors()));
			}

		}else{

			show_404();
		}
	}



}

/* End of file productos.php */
/* Location: ./application/controllers/productos.php */