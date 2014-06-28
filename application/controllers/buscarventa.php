<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buscarventa extends CI_Controller {

	public function __construct()
	{	
		parent::__construct();
		$this->removeCache();
		$this->load->database();
		$this->load->model('ventageneral_model');
		$this->load->model('orm/clientes_model');
		$this->load->model('orm/usuario_model');
		$this->load->model('orm/zona_model');
		$this->load->model('orm/cadena_model');
		$this->load->model('ventasce_model');
		$this->load->model('detallado/zona_model');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('Jquery_pagination');
		if(!$this->session->userdata('usuario')){
			redirect(base_url());
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
	//remover chaché
	public function removeCache()
	{
		$this->output->set_header('Last-Modified:gmdate("D, d MYH: i: s"..)GMT');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, post-check = 0, pre-check = 0 ");
		$this->output->set_header("Pragma: no-cache");
		$this->output->set_header("Expires: Mon, 26 de julio 1997 05:00:00 GMT");
	}
	//metodo para autocompletar, ajax jquery
	public function autocompletarVenta()
	{

		if($this->input->is_ajax_request()){

			$cadena=$this->input->post('cadena');
					
			$clientes=$this->clientes_model->likeNombre($cadena);
			$vendedores=$this->usuario_model->likeUsuario($cadena);
			$zona=$this->zona_model->likeZona($cadena);
			$cadenas=$this->cadena_model->likeCadenas($cadena);
			
			if(count($clientes)==0 && count($vendedores)==0 && count($zona)==0 && count($cadenas)==0){

				echo "<strong>No existe coincidencia</strong>";

			}else{
				$data['clientes']=$clientes;
				$data['vendedores']=$vendedores;
				$data['zonas']=$zona;
				$data['cadenas']=$cadenas;

				$this->load->view('buscarventa/autocompletarVentaView', $data);				
			}				
		}else{
			show_404();
		}
	}
	//metodo guarda los datos al hacer clic sobre la opcion de autocompletado
	public function idBusqueda()
	{
		if($this->input->is_ajax_request()){
			$array = array(
				'id' => $this->input->post('id'),
				'tabla'=>$this->input->post('tabla')
			);
			$this->session->set_userdata( $array );

			

		}else{
			show_404();
		}
	}

	//metodo para obtener las ventas generales
	// peticion AJAX->JQUERY
	public function generales()
	{
		$this->form_validation->set_rules('parametro', 'busqueda', 'trim|required|xss_clean');
		$this->form_validation->set_rules('fecha', 'fecha', 'trim|required|xss_clean|callback_isdate');
		$this->form_validation->set_rules('intervalo', 'segunda fecha', 'trim|xss_clean|callback_intervalo');
		$this->form_validation->set_rules('tipo', 'tipo de venta', 'trim|required|xss_clean');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		$this->form_validation->set_message('isdate','la %s es incorrecta');
		$this->form_validation->set_message('intervalo','la %s es incorrecta');
		$this->form_validation->set_message('selectAutocompletado','debe elegir una opcion del autocompletado');
		$this->form_validation->set_error_delimiters('<div>','</div>');
		if($this->form_validation->run()==TRUE){
			//tipo de tabla para saber que ventas se va a buscar
			$tipo=$this->input->post('tipo');
			$fecha=$this->input->post('fecha');
			$intervalo=$this->input->post('intervalo');
			//obtenemos las sessiones previamente guardadas con el metodo idBusqueda
			$id=$this->session->userdata('id');
			$tabla=$this->session->userdata('tabla');
			//creamos la variable para almacenar los registros y enviar a la vista
			$html="";


			switch ($tipo) {
				case 'g':{
					//si intervalo no existe , la busqueda se realiza con una fecha
					if($intervalo==NULL){
						$html=$this->ventasGeneralesPorFecha($tabla,$id,$fecha);						

					}else{
						$html=$this->ventasGeneralesPorIntervalo($tabla,$id,$fecha,$intervalo);								
					}
					break;					
				}
					
				
				case 1:{

					if($intervalo==NULL){
						$html=$this->efectivoPorFecha($tabla,$id,$fecha);
					}else{
						$html=$this->efectivoPorIntervalo($tabla,$id,$fecha,$intervalo);

					}
					break;

				}
					
				
				case 0:{
					if($intervalo==NULL){
						$html=$this->creditoPorFecha($tabla,$id,$fecha);
					}else{
						$html=$this->creditoPorIntervalo($tabla,$id,$fecha,$intervalo);
					}

					break;
				}
					
					
				default:{
					$html="parametros incorrectos";
					break;
					
				}
				
					
			}
			
			$json['exito']=TRUE;
			$json['html']=$html;
			echo json_encode($json);
		}else{
			$json['exito']=FALSE;
			$json['html']=str_replace("\n",'', validation_errors());
			echo json_encode($json); 
		}
	}	

	public function ventasGeneralesPorFecha($tabla,$id,$fecha)
	{
		
		switch ($tabla) {
			case 'usuario':{
				$data['query']=$this->ventageneral_model->vendedorFecha($id,$fecha);
				break;
			}
			case 'zona':{
				$data['query']=$this->ventageneral_model->zonaFecha($id,$fecha);
				break;
			}
			case 'clientes':{
				$data['query']=$this->ventageneral_model->clienteFecha($id,$fecha);
				break;
			}
			case 'cadena':{
				$data['query']=$this->ventageneral_model->cadenaFecha($id,$fecha);
				break;
			}
			
		}
		return $this->load->view('buscarventa/busquedaView', $data, TRUE);
	}


	public function ventasGeneralesPorIntervalo($tabla,$id,$fecha,$intervalo)
	{
		
		switch ($tabla) {
			case 'usuario':{
				$data['query']=$this->ventageneral_model->vendedorIntervalo($id,$fecha,$intervalo);
				break;
			}
			case 'zona':{
				$data['query']=$this->ventageneral_model->zonaIntervalo($id,$fecha,$intervalo);
				break;
			}
			case 'clientes':{
				$data['query']=$this->ventageneral_model->clienteIntervalo($id,$fecha,$intervalo);
				break;
			}	
			case 'cadena':{
				$data['query']=$this->ventageneral_model->cadenaIntervalo($id,$fecha,$intervalo);
				break;
			}	
			
				
		}
			return $this->load->view('buscarventa/busquedaView', $data, TRUE);
	}


	public function efectivoPorFecha($tabla,$id,$fecha)
	{
		switch ($tabla) {
			case 'zona':{
				$data['query']=$this->ventasce_model->efectivoZonaFecha($id,$fecha);
				break;
			}
			case 'clientes':{
				$data['query']=$this->ventasce_model->efectivoClienteFecha($id,$fecha);
				break;
			}
			case 'usuario':{
				$data['query']=$this->ventasce_model->efectivoVendedorFecha($id,$fecha);
				break;
			}
			case 'cadena':{
				$data['query']=$this->ventasce_model->efectivoCadenaFecha($id,$fecha);
				break;
			}
			
				
		}

			return $this->load->view('buscarventa/busquedaView', $data, TRUE);
	}


	public function efectivoPorIntervalo($tabla,$id,$fecha,$intervalo)
	{

		switch ($tabla) {
			case 'zona':{
				$data['query']=$this->ventasce_model->efectivoZonaIntervalo($id,$fecha,$intervalo);
				break;
			}
			case 'clientes':{
				$data['query']=$this->ventasce_model->efectivoClienteIntervalo($id,$fecha,$intervalo);
				break;
			}
			case 'usuario':{
				$data['query']=$this->ventasce_model->efectivoVendedorIntervalo($id,$fecha,$intervalo);
				break;
			}
			case 'cadena':{
				$data['query']=$this->ventasce_model->efectivoCadenaIntervalo($id,$fecha,$intervalo);
				break;
			}						
			
				
		}

			return $this->load->view('buscarventa/busquedaView', $data, TRUE);
	}


	public function creditoPorFecha($tabla,$id,$fecha)
	{
		switch ($tabla) {
			case 'zona':{
				$data['query']=$this->ventasce_model->creditoZonaFecha($id,$fecha);
				break;
			}
			case 'clientes':{
				$data['query']=$this->ventasce_model->creditoClienteFecha($id,$fecha);
				break;
			}
			case 'usuario':{
				$data['query']=$this->ventasce_model->creditoVendedorFecha($id,$fecha);
				break;
			}
			case 'cadena':{
				$data['query']=$this->ventasce_model->creditoCadenaFecha($id,$fecha);
				break;
			}
			
		}

			return $this->load->view('buscarventa/busquedaView', $data, TRUE);
	}


	public function creditoPorIntervalo($tabla,$id,$fecha,$intervalo)
	{
		switch ($tabla) {
			case 'zona':{
				$data['query']=$this->ventasce_model->creditoZonaIntervalo($id,$fecha,$intervalo);
				break;
			}
			case 'clientes':{
				$data['query']=$this->ventasce_model->creditoClienteIntervalo($id,$fecha,$intervalo);
				break;
			}
			case 'usuario':{
				$data['query']=$this->ventasce_model->creditoVendedorIntervalo($id,$fecha,$intervalo);
				break;
			}
			case 'cadena':{
				$data['query']=$this->ventasce_model->creditoCadenaIntervalo($id,$fecha,$intervalo);
				break;
			}
			
		}

			return $this->load->view('buscarventa/busquedaView', $data, TRUE);
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

			if($this->form_validation->run()==TRUE){				
				$fecha=$this->input->post('fecha');
				$intervalo=$this->input->post('intervalo');
				$tipo=$this->input->post('tipo');

				//definimos las sessiones para poder paginar								
				$this->session->set_userdata('type',$tipo);				
				$this->session->set_userdata('fecha',$fecha);				
				$this->session->set_userdata('intervalo',$intervalo);

				$json['exito']=TRUE;			
				echo json_encode($json);
			}else{
				$json['exito']=FALSE;
				$json['html']=validation_errors();
				echo json_encode($json);
				
			}

		}else{
			show_404();
		}
	}

	//metodo para 
	public function edoGeneral()	
	{
		$tabla=$this->session->userdata('tabla');
		$intervalo=$this->session->userdata('intervalo');

		
		switch ($tabla){
			case 'zona':{
				if($this->session->userdata('intervalo')==NULL){
					$this->zonaFecha();
				}else{
					$this->zonaIntervalo();
				}
				break;
			}
			case 'clientes':{
				if($this->session->userdata('intervalo')==NULL){
					$this->clienteFecha();
				}else{
					$this->clienteIntervalo();
				}
				break;
			}
			case 'usuario':{
				if($this->session->userdata('intervalo')==NULL){
					$this->vendedorFecha();			
				}else{
					$this->vendedorIntervalo();
				}
				break;
			}
			default:{
				echo "<h3>Error, comuniquese con el administrador</h3>";
			}		

		}		
	}

	public function zonaFecha($apartir=0)
	{		//cargamos los modelos

		$this->load->model('detallado/vdzona_model');

			$id=$this->session->userdata('id');
			$fecha=$this->session->userdata('fecha');		

			//configuramos la url de la paginacion
            $config['base_url'] =base_url()."index.php/buscarventa/zonaFecha/";
            //configuramos el DIV html
            $config['div'] = '#resultados';
            //en true queremos ver Viendo 1 a 10 de 52
            $config['show_count'] = true;
            //le decimos cuantas filas en total tiene nuestra tabla noticias
            $rows=$this->vdzona_model->rowsZona($id,$fecha);
            $config['total_rows'] = $rows->num_rows();
            
            //el numero de filas por pagina
            $config['per_page'] = 10;
            //el numero de links visibles
            $config['num_links'] = 4;
             
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Último';
             
            //cargamos la librería con nuestra configuracion
            $this->jquery_pagination->initialize($config);
             
            //obtemos los valores
            $query=$this->vdzona_model->zona($id,$fecha,$apartir);
            $data['query'] = $query->result_array();
            
            $data['page'] = $this->jquery_pagination->create_links();  
            
           	$this->load->view('buscarventa/zonaView',$data);      
	}

	public function zonaIntervalo($apartir=0)
	{
		//cargamos modelos correspondientes
		$this->load->model('detallado/vdzona_model');
			$id=$this->session->userdata('id');
			$fecha=$this->session->userdata('fecha');
			$intervalo=$this->session->userdata('intervalo');
			//configuramos la url de la paginacion
            $config['base_url'] =base_url()."index.php/buscarventa/zonaIntervalo/";
            //configuramos el DIV html
            $config['div'] = '#resultados';
            //en true queremos ver Viendo 1 a 10 de 52
            $config['show_count'] = true;
            //le decimos cuantas filas en total tiene nuestra tabla noticias
            $rows=$this->vdzona_model->rowsZonaIntervalo($id,$fecha,$intervalo);
            $config['total_rows'] = $rows->num_rows();
            $rows->next_result();
            $rows->free_result();
            //el numero de filas por pagina
            $config['per_page'] =10;
            //el numero de links visibles
            $config['num_links'] = 4;
             
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Último';
             
            //cargamos la librería con nuestra configuracion
            $this->jquery_pagination->initialize($config);
             
            //obtemos los valores
            $query=$this->vdzona_model->zonaIntervalo($id,$fecha,$intervalo,$apartir);
            $data['query'] = $query->result_array();            
            $data['page'] = $this->jquery_pagination->create_links();  
                      	
           	$this->load->view('buscarventa/zonaView',$data);	
	}
	public function clienteFecha($apartir=0)
	{

		$this->load->model('detallado/vdcliente_model');

			$id=$this->session->userdata('id');
			$fecha=$this->session->userdata('fecha');		

			//configuramos la url de la paginacion
            $config['base_url'] =base_url()."index.php/buscarventa/clienteFecha/";
            //configuramos el DIV html
            $config['div'] = '#resultados';
            //en true queremos ver Viendo 1 a 10 de 52
            $config['show_count'] = true;
            //le decimos cuantas filas en total tiene nuestra tabla noticias
            $rows=$this->vdcliente_model->rowsCliente($id,$fecha);
            $config['total_rows'] = $rows->num_rows();
            $rows->next_result();
            $rows->free_result();
            //el numero de filas por pagina
            $config['per_page'] = 10;
            //el numero de links visibles
            $config['num_links'] = 4;
             
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Último';
             
            //cargamos la librería con nuestra configuracion
            $this->jquery_pagination->initialize($config);
             
            //obtemos los valores
            $query=$this->vdcliente_model->cliente($id,$fecha,$apartir);
            $data['query'] = $query->result_array();
            $query->next_result();
            $query->free_result();
            $data['page'] = $this->jquery_pagination->create_links();  
            
           	$this->load->view('buscarventa/clienteView',$data);
	}

	public function clienteIntervalo($apartir=0)
	{
		$this->load->model('detallado/vdcliente_model');

			$id=$this->session->userdata('id');
			$fecha=$this->session->userdata('fecha');
			$intervalo=$this->session->userdata('intervalo');		

			//configuramos la url de la paginacion
            $config['base_url'] =base_url()."index.php/buscarventa/clienteIntervalo/";
            //configuramos el DIV html
            $config['div'] = '#resultados';
            //en true queremos ver Viendo 1 a 10 de 52
            $config['show_count'] = true;
            //le decimos cuantas filas en total tiene nuestra tabla noticias
            $rows=$this->vdcliente_model->rowsClienteIntervalo($id,$fecha,$intervalo);
            $config['total_rows'] = $rows->num_rows();
            $rows->next_result();
            $rows->free_result();
            //el numero de filas por pagina
            $config['per_page'] = 10;
            //el numero de links visibles
            $config['num_links'] = 4;
             
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Último';
             
            //cargamos la librería con nuestra configuracion
            $this->jquery_pagination->initialize($config);
             
            //obtemos los valores
            $query=$this->vdcliente_model->clienteIntervalo($id,$fecha,$intervalo,$apartir);
            $data['query'] = $query->result_array();
            $query->next_result();
            $query->free_result();
            $data['page'] = $this->jquery_pagination->create_links();  
            
           	$this->load->view('buscarventa/clienteView',$data);
	}

	public function vendedorFecha($apartir=0)
	{
		$this->load->model('detallado/vdvendedor_model');

			$id=$this->session->userdata('id');
			$fecha=$this->session->userdata('fecha');		

			//configuramos la url de la paginacion
            $config['base_url'] =base_url()."index.php/buscarventa/vendedorFecha/";
            //configuramos el DIV html
            $config['div'] = '#resultados';
            //en true queremos ver Viendo 1 a 10 de 52
            $config['show_count'] = true;
            //le decimos cuantas filas en total tiene nuestra tabla noticias
            $rows=$this->vdvendedor_model->rowsVendedor($id,$fecha);
            $config['total_rows'] = $rows->num_rows();
            $rows->next_result();
            $rows->free_result();
            //el numero de filas por pagina
            $config['per_page'] = 10;
            //el numero de links visibles
            $config['num_links'] = 4;
             
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Último';
             
            //cargamos la librería con nuestra configuracion
            $this->jquery_pagination->initialize($config);
             
            //obtemos los valores
            $query=$this->vdvendedor_model->vendedor($id,$fecha,$apartir);
            $data['query'] = $query->result_array();
            $query->next_result();
            $query->free_result();
            $data['page'] = $this->jquery_pagination->create_links();  
            
           	$this->load->view('buscarventa/vendedorView',$data);
    }


	public function vendedorIntervalo($apartir=0)
	{
		$this->load->model('detallado/vdvendedor_model');

			$id=$this->session->userdata('id');
			$fecha=$this->session->userdata('fecha');	
			$intervalo=$this->session->userdata('intervalo');	

			//configuramos la url de la paginacion
            $config['base_url'] =base_url()."index.php/buscarventa/vendedorIntervalo/";
            //configuramos el DIV html
            $config['div'] = '#resultados';
            //en true queremos ver Viendo 1 a 10 de 52
            $config['show_count'] = true;
            //le decimos cuantas filas en total tiene nuestra tabla noticias
            $rows=$this->vdvendedor_model->rowsVendedorIntervalo($id,$fecha,$intervalo);
            $config['total_rows'] = $rows->num_rows();
            $rows->next_result();
            $rows->free_result();
            //el numero de filas por pagina
            $config['per_page'] = 10;
            //el numero de links visibles
            $config['num_links'] = 4;
             
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Último';
             
            //cargamos la librería con nuestra configuracion
            $this->jquery_pagination->initialize($config);
             
            //obtemos los valores
            $query=$this->vdvendedor_model->vendedorIntervalo($id,$fecha,$intervalo,$apartir);
            $data['query'] = $query->result_array();
            $query->next_result();
            $query->free_result();
            $data['page'] = $this->jquery_pagination->create_links();  
            
           	$this->load->view('buscarventa/vendedorView',$data);
	}	


	//informacion general de la venta
	public function info_venta($id)
	{	
		//cargamos modelos necesarios
		$this->load->model('orm/ventas_model');
		$this->load->model('vendedor_model');
		$this->load->model('orm/clientes_model');
		$this->load->model('orm/usuario_model');		

		if($this->input->is_ajax_request()){

			$idventa=$id;
			//obtenemos los detalles de la venta
			$venta=$this->ventas_model->getVenta($idventa);
			$data['venta']=$venta;
			//obtenemos los detalles del vendedor
			$data['cliente']=$this->clientes_model->whereCliente($venta['rfc']);
			$data['productos']=$this->vendedor_model->query_detalleventa($idventa);
			$data['vendedor']=$this->usuario_model->whereUsuario($venta['id_usuario']);
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

	//comprobar si se seleccionó una opcion del autocompletado
	public function selectAutocompletado()
	{

		if($this->session->userdata('id')!="" && $this->session->userdata('id')!=NULL ){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	

	
}

/* End of file buscar_venta.php */
/* Location: ./application/controllers/buscar_venta.php */
