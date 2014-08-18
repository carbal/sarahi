<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadenas extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->library('form_validation');

		if(!$this->session->userdata('usuario')){		
			redirect(base_url().'index.php/main');
		}elseif ($this->session->userdata('usuario') && $this->session->userdata('tipo')==0) {
			redirect(base_url().'index.php/vendedor/');
		}
	}

	//método index del controlador
	public function index()
	{
		$this->load->model('orm/cadena_model');
		$data['cadenas'] = $this->cadena_model->select();
		$this->load->view('template/encabezado');
		$this->load->view('cadenas/indexView', $data);
		$this->load->view('template/piepagina');
	}

	//método para mostrar la el formulario de cadenas
	public function formCadena($id = NULL)
	{
		$this->load->model('orm/zona_model');

		if(!empty($id)){
			$this->load->model('orm/cadena_model');
			$js['cadena'] = $this->cadena_model->getCadena($id);
			$data['js']   = $this->load->view('cadenas/jsCadena', $js, TRUE);
		}else{
			$data['js']   = $this->load->view('cadenas/jsCadena','',TRUE);
		}
		$data['zonas']     = $this->zona_model->select();
		$this->load->view('template/encabezado');
		$this->load->view('cadenas/formCadenaView',$data);
		$this->load->view('template/piepagina');
	}


	//método para insertar o actuliazar cadena
	public function insert()
	{
		//cargamos el modelo
		$this->load->model('orm/cadena_model');

		$this->form_validation->set_rules('cadena', 'Nombre Cadena', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id_zona', 'Zona', 'trim|required|xss_clean|integer');
		$this->form_validation->set_rules('representante', 'Representante', 'trim|required|xss_clean');
		$this->form_validation->set_rules('telefono', 'Telefono', 'trim|required|min_length[10]|max_length[13]|xss_clean');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		$this->form_validation->set_message('min_length','El %s no es un telefono valido');
		$this->form_validation->set_message('integer','El campo Zona es obligatorio');
		$this->form_validation->set_message('max_length','El %s no es un telefono valido');		
		$this->form_validation->set_error_delimiters('<div>','</div>');
		if($this->form_validation->run() == TRUE){
			//insertamos la cadena nueva
			if(isset($_POST['id_cadena']))
				$this->cadena_model->update();
			else
				$this->cadena_model->insert();

			echo json_encode(array('success' => TRUE));
		}else{
			echo json_encode(array('success' => FALSE, 'html' => validation_errors()));
		}

	}

}

/* End of file cadenas.php */
/* Location: ./application/controllers/cadenas.php */