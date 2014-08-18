<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Panel extends CI_Controller {
	
	/*
	*controllador correspondiente al usuario administrador
	*/
	public function __construct()
	{
		parent:: __construct();	
		$this->load->library('session');
		$this->load->database();
		$this->load->model('orm/zona_model');
		$this->load->model('orm/producto_model');
		$this->load->model('orm/cadena_model');
		$this->load->model('orm/precio_cadena_model');
		$this->load->model('crud_model');						
		$this->load->library('form_validation');
			
		if(!$this->session->userdata('usuario')){		
			redirect(base_url().'index.php/main');
		}elseif ($this->session->userdata('usuario') && $this->session->userdata('tipo')==0) {
			redirect(base_url().'index.php/vendedor/');
		}
	}

	//cargamos la plantilla principal
	public function index()
	{
		//cargamos la plantilla principal
		$this->load->view('template/encabezado');
		$this->load->view('template/cuerpo');			
		$this->load->view('template/piepagina');
	}
	//cerrar sesion de usuario
	public function salir()
	{
		$this->session->unset_userdata('usuario');
		$this->session->unset_userdata('activo');		
		$this->session->sess_destroy();
		redirect(base_url());			
	}
	
	
	//mostrar formulario existencias
	public function agregarProductos()
	{
		$data['productos'] = $this->producto_model->select();
		$data['zonas']     = $this->zona_model->select();
		$this->load->view('template/encabezado');
		$this->load->view('panel/agregarProductosView',$data);
		$this->load->view('template/piepagina');
	}

	//mostrar formulario precio del producto por cadena
	public function precioProducto()
	{
		$data['productos']=$this->producto_model->select();
		$this->load->view('template/encabezado');
		$this->load->view('panel/precioProductoView',$data);
		$this->load->view('template/piepagina');
	}



/*
* 	bloque de metodo ajax, los siguientes métodos funcionan con peticiones
*	ajax
*/


	//METODO PARA AUTOCOMPLETAR VISTA:panel/precioproductocadena_view	
	public function autocompletarCadena()
	{
		if($this->input->is_ajax_request()){
			$data['cadenas'] = $this->cadena_model->likeCadenas($this->input->post('cadena'));
			if(count($data['cadenas'])>0){
			$this->load->view('panel/autocadenasView', $data);				
			}else{
				echo "No existen coincidencias.";
			}

		}else{
			show_404();
		}
	}


	//metodo para mostrar informacion de la venta realizada
	public function infoVenta($id)
	{	
		//cargamos modelos necesarios
		$this->load->model('orm/ventas_model');
		$this->load->model('vendedor_model');
		$this->load->model('orm/clientes_model');
		$this->load->model('orm/usuario_model');		

		if($this->input->is_ajax_request()){
			$idventa = $id;
			//obtenemos los detalles de la venta
			$venta         = $this->ventas_model->getVenta($idventa);
			$data['venta'] = $venta;
			//obtenemos los detalles del vendedor
			$data['cliente']   = $this->clientes_model->whereCliente($venta['rfc']);
			$data['productos'] = $this->vendedor_model->query_detalleventa($idventa);
			$data['vendedor']  = $this->usuario_model->whereUsuario($venta['id_usuario']);
			//$data['zona']=$this->zona_model->get_zona($data['vendedor']['id_zona']);
			$this->load->view('panel/infoVentaView', $data);

		}else{
			show_404();
		}
	}


	//metodo para eliminar registro de la tabla precio_cadena	
	public function delPrecioProducto()
	{
		if($this->input->is_ajax_request()){
			//eliminamos el registro correspondiente a id_precio de la tabla:"precio_cadena"
			$this->precio_cadena_model->delete($this->session->userdata('idPrecio'));
			//volvemos a cargar los precios correspondientes a la cadena
			//cargamos la variable se sesion 
			$data['productosCadena'] = $this->crud_model->selectPrecioProductosCadena($this->session->userdata('idCadena'));
			$this->load->view('panel/productosCadenaView', $data);
		}else{
			show_404();
		}
	}


	//metodo para agregar un nuevo registro a la tabla:precio_cadena
	public function insertPrecioCadena()
	{
		if ($this->input->is_ajax_request()) {	
			//obtenemos los datos que queremos insertar 
			$idCadena=$this->session->userdata('idCadena');
			$sku=$this->input->post('producto');
			$this->form_validation->set_rules('cadena', 'Cadena', 'trim|required|xss_clean|callback_existeCadena');
			$this->form_validation->set_rules('producto', 'Producto', 'trim|required|xss_clean|integer|callback_existePrecioProducto');
			$this->form_validation->set_rules('precio', 'Precio', 'trim|required||xss_clean');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('integer','El campo %s es obligatorio');
			$this->form_validation->set_message('existeCadena','Eliga una opcion válida en el campo Cadena');
			$this->form_validation->set_message('existePrecioProducto','Este producto ya ha sido agregado para esta cadena');
			$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');			

		if($this->form_validation->run()==TRUE){
			$insert=array(
				'id_cadena' => $idCadena,
				'sku'       => $sku,
				'precio'    => $this->input->post('precio')
				);		
			                         
 		//insertamos con el metodo correspondiente
			$this->precio_cadena_model->insert($insert);
		//obtenemos la tabla de precios por cadena
			$data['productosCadena'] = $this->crud_model->selectPrecioProductosCadena($idCadena);
			$json['exito']=TRUE;
			$json['html']=$this->load->view('panel/productosCadenaView', $data,TRUE);
			echo json_encode($json);

						
		}else{
			$json['exito']=FALSE;
			$json['html']=validation_errors();
			echo json_encode($json);

		}


		}
	}

	//guardar id_cadena, y mostrar los precios de los productos para dicha cadena	
	public function saveIdCadena()
	{
		if($this->input->is_ajax_request()){	
		//guardamos el id cadena	
				
			$this->session->set_userdata('idCadena', $this->input->post('idCadena'));
		//obtenemo si es que existen los productos asignados a esta cadena
			$data['productosCadena'] = $this->crud_model->selectPrecioProductosCadena($this->session->userdata('idCadena'));
			$this->load->view('panel/productosCadenaView', $data);

		}else{
			show_404();
		}
	}


	//metodo para guardar el id del precio del producto por cadena	
	public function saveIdPrecioProducto()
	{
		if($this->input->is_ajax_request()){
		//salvamos el id_Precio de la tabla precio_cadena
		//para poder eliminar y actualizar de forma mas facil		
			$this->session->set_userdata('idPrecio',$this->input->post('idPrecio'));

		}else{
			show_404();
		}
	}

	
	//update precio producto por cadena tabla: precio_cadena	
	public function updatePrecioProducto()
	{
		if($this->input->is_ajax_request()){

		$this->form_validation->set_rules('nuevo', 'Nuevo', 'trim|required|xss_clean|callback_mayor');
		$this->form_validation->set_message('required','El campo es obligarotio');
		$this->form_validation->set_message('mayor','Debe ser un numero mayor a cero');

		if($this->form_validation->run() == TRUE){
		$precioNuevo = $this->input->post('nuevo');
		$where=array(
			'id_cadena' => $this->session->userdata('idCadena'),
			'id_precio' => $this->session->userdata('idPrecio')
		);
		//actualizamos el precio del producto
		$this->precio_cadena_model->updatePrecioProducto($where,$precioNuevo);
		//cargamos de nuevo la tabla precio_cadena
		$data['productosCadena'] = $this->crud_model->selectPrecioProductosCadena($this->session->userdata('idCadena'));
		$json['exito']           = TRUE;
		$json['html']            = $this->load->view('panel/productosCadenaView', $data,TRUE);
		echo json_encode($json);

		}else{
			$json['exito'] = FALSE;
			$json['html']  = validation_errors();
			echo json_encode($json);
		}

		}else{
			show_404();
		}
	}

	/*
	*	BLOQUE DE MÉTODOS CALLBACK LIBRERIA FORM_VALIDATION	
	*/

	//metodo para comprobar si el valor nuevo es mayor a 0
	public function mayor()
	{
		if($this->input->post('nuevo') > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//metodo para saber si ya se ha difino la varible de session idCadena
	//esta se define si el usuario ya eligio una opcion del autocompletado
	public function existeCadena()
	{
		if($this->session->userdata('idCadena') != NULL){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//metodo para saber si el producto que elegimos ya existe para la cadena correspondiente
	public function existePrecioProducto()
	{
		if($this->precio_cadena_model->existePrecioProducto($this->session->userdata('idCadena'),$this->input->post('producto'))<=0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
}

