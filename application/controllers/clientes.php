<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
		$this->load->library('session');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->model('orm/clientes_model');
		$data['clientes'] = $this->clientes_model->all();
		$this->load->view('template/encabezado');
		$this->load->view('clientes/index',$data);
		$this->load->view('template/piepagina');
	}

	//mostrar vista para insertar o actualizar cliente
	public function formCliente($rfc = null){
		//cargamos los modelos necesarios
		$this->load->model('orm/cadena_model');
		$this->load->model('orm/zona_model');
		if(!empty($rfc)){
			$this->load->model('orm/clientes_model');
			$js['cliente'] = $this->clientes_model->whereCliente($rfc);
			$data['js'] = $this->load->view('clientes/jsClientes',$js,TRUE);
		}
		//identificamos 
		$data['cadenas']=$this->cadena_model->select();
		$data['zonas']=$this->zona_model->select();
		$this->load->view('template/encabezado');
		$this->load->view('clientes/formCliente', $data);
		$this->load->view('template/piepagina');
	}

	//validar los datos del cliente 
	public function validar()
	{
		if($this->input->is_ajax_request()){
			
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rfc', 'RFC', 'trim|required|xss_clean|callback_is_rfc|callback_val_rfc');		
		$this->form_validation->set_rules('id_cadena', 'Cadena', 'trim|required|xss_clean');
		$this->form_validation->set_rules('calle', 'Calle', 'trim|required|xss_clean');
		$this->form_validation->set_rules('no_interior', 'No. Interior', 'trim|required|xss_clean');
		$this->form_validation->set_rules('no_exterior', 'No. Exterior', 'trim|required|xss_clean');
		$this->form_validation->set_rules('colonia', 'Colonia', 'trim|required|xss_clean');
		$this->form_validation->set_rules('municipio', 'Municipio', 'trim|required|xss_clean');
		$this->form_validation->set_rules('correo', 'Correo', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('referencia', 'Referencia', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cp', 'Codigo Postal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('regimen', 'Regimen', 'trim|required|xss_clean');
		$this->form_validation->set_rules('representante', 'Representante', 'trim|required|xss_clean');
		$this->form_validation->set_rules('estado','Estado', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<div>','</div>');

		$this->form_validation->set_message('required','El campo %s es obligatorio');
		$this->form_validation->set_message('valid_email','El correo %s no parece ser uno válido');
		$this->form_validation->set_message('is_rfc','<strong>El campo %s es incorrecto</strong>');
		$this->form_validation->set_message('val_rfc','<strong>El %s ya existe</strong>');
		$this->form_validation->set_message('val_nombre','<strong>El %s ya esta siendo utilizado</strong>');

		if($this->form_validation->run()==TRUE){

			$this->load->model('orm/clientes_model');
			$this->clientes_model->insert();

			$json['success']=TRUE;
			$json['html']='<p><strong>AVISO : </strong>Se ha creado un nuevo cliente con exito</p>';
			echo json_encode($json);
		}else{
			$json['success']=FALSE;
			$json['html']=validation_errors();
			echo json_encode($json);
		}
		}else{
			show_404();
		}
	}

	public function update(){
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean');
			$this->form_validation->set_rules('id_cadena', 'Cadena', 'trim|required|xss_clean');
			$this->form_validation->set_rules('calle', 'Calle', 'trim|required|xss_clean');
			$this->form_validation->set_rules('no_interior', 'No. Interior', 'trim|required|xss_clean');
			$this->form_validation->set_rules('no_exterior', 'No. Exterior', 'trim|required|xss_clean');
			$this->form_validation->set_rules('colonia', 'Colonia', 'trim|required|xss_clean');
			$this->form_validation->set_rules('municipio', 'Municipio', 'trim|required|xss_clean');
			$this->form_validation->set_rules('correo', 'Correo', 'trim|required|xss_clean|valid_email');
			$this->form_validation->set_rules('referencia', 'Referencia', 'trim|required|xss_clean');
			$this->form_validation->set_rules('cp', 'Codigo Postal', 'trim|required|xss_clean');
			$this->form_validation->set_rules('regimen', 'Regimen', 'trim|required|xss_clean');
			$this->form_validation->set_rules('representante', 'Representante', 'trim|required|xss_clean');
			$this->form_validation->set_rules('estado','Estado', 'trim|required|xss_clean');
			$this->form_validation->set_error_delimiters('<div>','</div>');

			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('valid_email','El correo %s no parece ser uno válido');
			$this->form_validation->set_message('val_nombre','<strong>El %s ya esta siendo utilizado</strong>');

		if($this->form_validation->run()==TRUE){

			$this->load->model('orm/clientes_model');
			$this->clientes_model->update();

			$json['success']=TRUE;
			$json['html']='<p><strong>AVISO : </strong>Se ha actualizado el nuevo cliente con éxito</p>';
			echo json_encode($json);
		}else{
			$json['success']=FALSE;
			$json['html']=validation_errors();
			echo json_encode($json);
		}


		}else{
			show_404();
		}
	}


	//bloque de funciones callback de form_validation

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
		if(count($this->clientes_model->whereCliente($this->input->post('rfc')))>0){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	//método para comprobar que el nombre del cliente no se repita
	/*public function val_nombre()
	{
		$this->load->model('orm/clientes_model');
		if(count($this->clientes_model->whereNombre($this->input->post('nombre')))==0){
			return TRUE;
		}else{
			return FALSE;
		}
	}*/
}

/* End of file clientes.php */
/* Location: ./application/controllers/clientes.php */