<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('encrypt');

		if(!$this->session->userdata('usuario')){		
			redirect(base_url().'index.php');
		}elseif ($this->session->userdata('usuario') && $this->session->userdata('tipo')==0) {
			redirect(base_url().'index.php/vendedor/');
		}
	}

	public function index()
	{
		$this->load->model('orm/producto_model');
		$data['productos'] = $this->producto_model->select();
		$this->load->view('template/encabezado');
		$this->load->view('productos/indexView',$data);
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
			$this->form_validation->set_rules('precio_costo', 'Precio Costo', 'trim|required|numeric|greater_than[0]|xss_clean');
			$this->form_validation->set_rules('precio_venta', 'Precio Venta', 'trim|required|numeric|greater_than[0]|xss_clean');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('numeric','El %s bebe ser numérico. Ej 10.25.');
			$this->form_validation->set_message('greater_than','El campo %s debe ser mayor a cero.');	
			$this->form_validation->set_message('val_sku','El %s producto ya existe.');
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
			$this->form_validation->set_rules('precio_costo', 'Precio Costo', 'trim|required|numeric|greater_than[0]|xss_clean');
			$this->form_validation->set_rules('precio_venta', 'Precio Venta', 'trim|required|numeric|greater_than[0]|xss_clean');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('greater_than','El campo %s debe ser mayor a cero.');
			$this->form_validation->set_message('numeric','El %s bebe ser numérico. Ej 10.25.');	
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