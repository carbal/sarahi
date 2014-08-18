<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buscarventa extends CI_Controller {

	public function __construct()
	{	
		parent::__construct();
		$this->load->database();
		$this->load->model('orm/clientes_model');
		$this->load->model('orm/usuario_model');
		$this->load->model('orm/zona_model');
		$this->load->model('orm/cadena_model');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('Jquery_pagination');
		if(!$this->session->userdata('usuario')){
			redirect(base_url().'index.php/main');
		}		
	}
	//metodo para cargar el formulario ventas general
	public function general()
	{		
		$this->load->view('template/encabezado');
		$this->load->view('buscarventa/generalesView');
		$this->load->view('template/piepagina');
	}
	//cargar formulario ventadetallada
	public function detallada()
	{
		$this->load->view('template/encabezado');
		$this->load->view('buscarventa/detalladasView');
		$this->load->view('template/piepagina');
	}
	//metodo para autocompletar, ajax jquery
	public function autocompletarVenta()
	{

		if($this->input->is_ajax_request()){

			$string     = $this->input->post('cadena');
			$clientes   = $this->clientes_model->likeNombre($string);
			$vendedores = $this->usuario_model->likeUsuario($string);
			$zonas      = $this->zona_model->likeZona($string);
			$cadenas    = $this->cadena_model->likeCadenas($string);
			
			if(count($clientes) == 0 && count($vendedores) == 0 && count($zonas)==0 && count($cadenas)==0){

				echo "<strong>No existe coincidencia</strong>";

			}else{
				
				$this->load->view('buscarventa/autocompletarVentaView', compact('cadenas','clientes','zonas','vendedores'));				
			}				
		}else{
			show_404();
		}
	}

	//metodo para obtener las ventas generales
	// peticion AJAX->JQUERY
	public function generales()
	{
		$this->form_validation->set_rules('parametro', 'busqueda', 'trim|required|xss_clean');
		$this->form_validation->set_rules('id', 'busqueda', 'trim|required|xss_clean');
		$this->form_validation->set_rules('fecha', 'fecha', 'trim|required|xss_clean|callback_isdate');
		$this->form_validation->set_rules('intervalo', 'segunda fecha', 'trim|xss_clean|callback_intervalo');
		$this->form_validation->set_rules('tipo', 'tipo de venta', 'trim|required|xss_clean');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		$this->form_validation->set_message('isdate','la %s es incorrecta');
		$this->form_validation->set_message('intervalo','la %s es incorrecta');
		$this->form_validation->set_error_delimiters('<div>','</div>');
		if($this->form_validation->run()==TRUE){
			
			//tipo de tabla para saber que ventas se va a buscar
			$tipo = $this->input->post('tipo');

			switch ($tipo) {
				case 'g':
					$html = $this->ventaGeneral();						
					break;				
				case 1:
					$html = $this->ventaEfectivo();
					break;
				case 0:
					$html = $this->ventaCredito();
					break;
				default:
					$html="Su busqueda no produjo ningun resultado.";
					break;
			}
			
			echo json_encode(array('exito' => TRUE, 'html' => $html));
		}else{

			echo json_encode(array('exito' => FALSE, 'html' => validation_errors())); 
		}
	}	

	public function ventaGeneral()
	{
		$this->load->model('general/generalModel');
		$tabla = $this->input->post('tabla');
		switch ($tabla) {
			case 'vendedor':
				$ventas = $this->generalModel->vendedor();
				break;
			case 'zona':
				$ventas = $this->generalModel->zona();
				break;
			case 'clientes':
				$ventas = $this->generalModel->cliente();
				break;
			case 'cadena':
				$ventas = $this->generalModel->cadena();
				break;
			
		}
		return $this->load->view('buscarventa/busquedaView',compact('ventas'), TRUE);
	}


	public function ventaEfectivo()
	{
		$this->load->model('general/efectivoModel');
		$tabla = $this->input->post('tabla');

		switch ($tabla) {
			case 'zona':
				$ventas = $this->efectivoModel->zona();
				break;
			case 'clientes':
				$ventas = $this->efectivoModel->cliente();
				break;
			case 'vendedor':
				$ventas = $this->efectivoModel->vendedor();
				break;
			case 'cadena':
				$ventas = $this->efectivoModel->cadena();
				break;
		}

		return $this->load->view('buscarventa/busquedaView',compact('ventas'), TRUE);
	}

	public function ventaCredito()
	{
		$this->load->model('general/creditoModel');
		$tabla = $this->input->post('tabla');

		switch ($tabla) {
			case 'zona':
				$ventas = $this->creditoModel->zona();
				break;
			case 'clientes':
				$ventas = $this->creditoModel->cliente();
				break;
			case 'vendedor':
				$ventas = $this->creditoModel->vendedor();
				break;
			case 'cadena':
				$ventas = $this->creditoModel->cadena();
				break;
		}

		return $this->load->view('buscarventa/busquedaView',compact('ventas'), TRUE);
	}

	public function detallados()
	{
		

		if($this->input->is_ajax_request()){

			$this->form_validation->set_rules('parametro', 'Parametro', 'trim|required|xss_clean');
			$this->form_validation->set_rules('fecha', 'Fecha', 'trim|required|xss_clean|callback_isdate');
			$this->form_validation->set_rules('intervalo', 'Intervalo', 'trim|xss_clean|callback_intervalo');			
			$this->form_validation->set_error_delimiters('<div>','</div>');

			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('isdata','El campo %s es incorrecto');
			$this->form_validation->set_message('intervalo','El segundo campo de fecha es incorrecto');

			if($this->form_validation->run() == TRUE){				
				$tabla = $this->input->post('tabla');
				
				switch ($tabla){
					case 'zona':
						$html = $this->getZona();
						break;
					case 'clientes':
						$html = $this->getCliente();
						break;			
					case 'vendedor':
						$html = $this->getVendedor();
						break;
					default:
						$html = "<h3>Los datos no producieron ningún resultado.</h3>";
						break;
				}		
				
				//die(var_dump($this->db->last_query()));
				echo json_encode(array('success' => TRUE, 'html' => $html));
				
			}else{

				echo json_encode(array('success' => FALSE ,'html' => validation_errors()));
			}

		}else{
			show_404();
		}
	}

	public function getZona($apartir = 0)
	{		
		try{

			$this->load->model('detallado/zonaModel');
			$_POST['apartir'] = $apartir; //enviamos la variable al modelo xd
			$zonas = $this->zonaModel->zona();
	        
	        $config['base_url']   = base_url()."index.php/buscarventa/getZona/";
	        $config['div']        = '#resultados';
	        $config['show_count'] = true;
	        $config['total_rows'] = $this->zonaModel->getRows();
	        $config['per_page']   = 10;
	        $config['num_links']  = 4;
	        $config['first_link'] = 'Primero';
	        $config['next_link']  = 'Siguiente';
	        $config['prev_link']  = 'Anterior';
	        $config['last_link']  = 'Último';
	        $config['additional_param'] = '{id:$(\'#clave\').prop(\'value\'),fecha:$(\'#fecha\').prop(\'value\'),intervalo:$(\'#fecha2\').prop(\'value\'),paginate:true}';
	         
	        $this->jquery_pagination->initialize($config);
	         
	        //obtemos los valores
	        $data['ventas']    = $zonas->result_array();
	        $data['paginate']  = $this->jquery_pagination->create_links();  

	        if(isset($_POST['paginate']))
	        	echo $this->load->view('buscarventa/zonaView',$data); //peticion paginacion jquery
	        else
	       		return $this->load->view('buscarventa/zonaView',$data,TRUE); 

		}catch(Exception $e){
			echo 'Su busqueda no produjo ningun resultado.';
		}
	}

	public function getCliente($apartir=0)
	{

		try{
			$this->load->model('detallado/clienteModel');
			$_POST['apartir'] = $apartir; //enviamos la variable al modelo.
			$clientes = $this->clienteModel->cliente();

	        $config['base_url']   = base_url()."index.php/buscarventa/getCliente/";
	        $config['div']        = '#resultados';
	        $config['show_count'] = true;
	        $config['total_rows'] = $this->clienteModel->getRows();
	        $config['per_page']   = 10;
	        $config['num_links']  = 4;
	        $config['first_link'] = 'Primero';
	        $config['next_link']  = 'Siguiente';
	        $config['prev_link']  = 'Anterior';
	        $config['last_link']  = 'Último';
	        $config['additional_param'] = '{id:$(\'#clave\').prop(\'value\'),fecha:$(\'#fecha\').prop(\'value\'),intervalo:$(\'#fecha2\').prop(\'value\'),paginate:true}';

	        $this->jquery_pagination->initialize($config);
	       
	        $data['ventas']    = $clientes->result_array();
	        $data['paginate']  = $this->jquery_pagination->create_links(); 

	        if(isset($_POST['paginate']))
	        	echo  $this->load->view('buscarventa/clienteView',$data);
	        else
	       		return $this->load->view('buscarventa/clienteView',$data,TRUE);

		}catch(Exception $e){
			echo 'Su busqueda no produjo ningun resultado.';
		}

	}

	public function getVendedor($apartir = 0)
	{
		try{

			$this->load->model('detallado/vendedorModel');
			$_POST['apartir'] = $apartir; //enviaamos la variable al modelo;
			$vendedor = $this->vendedorModel->vendedor();

	        $config['base_url']   = base_url()."index.php/buscarventa/getVendedor/";
	        $config['div']        = '#resultados';
	        $config['show_count'] = true;
	        $config['total_rows'] = $vendedor->num_rows();
	        $config['per_page']   = 10;
	        $config['num_links']  = 4;
	        $config['first_link'] = 'Primero';
	        $config['next_link']  = 'Siguiente';
	        $config['prev_link']  = 'Anterior';
	        $config['last_link']  = 'Último';
	        $config['additional_param'] = '{id:$(\'#clave\').prop(\'value\'),fecha:$(\'#fecha\').prop(\'value\'),intervalo:$(\'#fecha2\').prop(\'value\'),paginate:true}';

	        //cargamos la librería con nuestra configuracion
	        $this->jquery_pagination->initialize($config);
	         
	        $data['ventas']    = $vendedor->result_array();
	        $data['paginate']  = $this->jquery_pagination->create_links();  

	        if(isset($_POST['paginate']))
	        	echo $this->load->view('buscarventa/vendedorView',$data);
	        else
	       		return $this->load->view('buscarventa/vendedorView',$data,TRUE);

		}catch(Exception $e){
			echo 'Su busqueda no produjo ningun resultado.';
		}
    }

	//informacion general de la venta
	public function info_venta($id)
	{	

		if($this->input->is_ajax_request()){
			//cargamos modelos necesarios
			$this->load->model('orm/ventas_model');
			$this->load->model('vendedor_model');
			$this->load->model('orm/clientes_model');
			$this->load->model('orm/usuario_model');		
			$idventa       = $id;
			//obtenemos los detalles de la venta
			$venta         = $this->ventas_model->getVenta($idventa);
			$data['venta'] = $venta;
			//obtenemos los detalles del vendedor
			$data['cliente']   = $this->clientes_model->whereCliente($venta['rfc']);
			$data['productos'] = $this->vendedor_model->query_detalleventa($idventa);
			$data['vendedor']  = $this->usuario_model->whereUsuario($venta['id_usuario']);
			//$data['zona']=$this->zona_model->get_zona($data['vendedor']['id_zona']);
			$this->load->view('buscarventa/infoventaView', $data);

		}else{
			show_404();
		}
	}
	
	/*
	*	SECCIÓN DE MÉTODOS CALLBACK FORM_VALIDATION
	*/

	//comprobar si la fecha es correcta
	public function isdate()
	{
		if(preg_match("/^[0-9]{4}[\/](([0]?[1-9]{1})|([1]{1}[0-2]{1}))[\/](([0]?[1-9]{1})|([1]{1}[0-9]{1})|([2]{1}[0-9]{1})|([3]{1}[0-1]{1}))$/",$this->input->post('fecha'))){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	//comprobar si la segunda fecha existe y es correcta
	public function intervalo()
	{
		if($this->input->post('intervalo')==NULL){
			return TRUE;
		}
		else{
		if(preg_match("/^[0-9]{4}[\/](([0]?[1-9]{1})|([1]{1}[0-2]{1}))[\/](([0]?[1-9]{1})|([1]{1}[0-9]{1})|([2]{1}[0-9]{1})|([3]{1}[0-1]{1}))$/",$this->input->post('intervalo'))){
			return TRUE;
		}else{
			return FALSE;
		}		
	}
	}
	
}

/* End of file buscar_venta.php */
/* Location: ./application/controllers/buscar_venta.php */
