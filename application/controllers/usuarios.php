<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->load->helper('getZona');
		//Do your magic here

		if(!$this->session->userdata('usuario')){		
			redirect(base_url().'index.php');
		}elseif ($this->session->userdata('usuario') && $this->session->userdata('tipo')==0) {
			redirect(base_url().'index.php/vendedor/');
		}
	}

	public function index()
	{
		//obtenemos los datos
		$this->load->model('orm/usuario_model');
		$data['usuarios'] = $this->usuario_model->all();

		//vistas
		$this->load->view('template/encabezado');
		$this->load->view('usuarios/indexView.php',$data);
		$this->load->view('template/piepagina');
		
	}

	public function formUsuario($id = null)
	{
		$this->load->model('orm/zona_model');
		$data['zonas']=$this->zona_model->select();
		if(!empty($id)){
			$this->load->model('orm/usuario_model');
			//necesario descencriptar password antes de enviar a la vista
			$usuario             = $this->usuario_model->whereUsuario($id);
			$usuario['password'] = $this->encrypt->decode($usuario['password']);
			$js['usuario'] = $usuario;
			$data['js']    = $this->load->view('usuarios/jsUsuario',$js, TRUE);
		}else{
			$data['js']    = $this->load->view('usuarios/jsUsuario','', TRUE);
		}

		$this->load->view('template/encabezado');
		$this->load->view('usuarios/formUsuarioView',$data);
		$this->load->view('template/piepagina');
	}

	public function validar()
	{
		$this->form_validation->set_rules('nombres', 'Nombre', 'trim|required');		
		$this->form_validation->set_rules('apellidos', "Apellido", 'trim|required|xss_clean');
		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|xss_clean');
		$this->form_validation->set_rules('domicilio', 'Domicilio', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tipo', 'Tipo', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id_zona', 'Zonas', 'trim|required|integer');
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|min_length[8]|required|xss_clean');
		$this->form_validation->set_rules('pass2', 'Confirmar', 'trim|matches[password]|required|xss_clean');		
		$this->form_validation->set_message('required',"El campo %s es obligatorio");
		$this->form_validation->set_message('min_length','La %s de ser 8 caracteres minímo');
		$this->form_validation->set_message('matches',"El campo %s y %s no son iguales");
		$this->form_validation->set_message('integer','El campo zona es obligatorio');
		$this->form_validation->set_error_delimiters('<div>','</div>');
		if($this->form_validation->run()==TRUE){
			$this->load->model('orm/usuario_model');

			if(isset($_POST['id_usuario']))
				$this->usuario_model->update();
			else
				$this->usuario_model->insert();
			
			echo json_encode(array('success' => TRUE));		
		}else{		
			echo json_encode(array('success' => FALSE,'html' => validation_errors()));
		}

	}

}

/* End of file usuario.php */
/* Location: ./application/controllers/usuario.php */