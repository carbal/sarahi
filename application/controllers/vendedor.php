<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendedor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->removeCache();
		$this->load->library('session');
		$this->load->model('vendedor_model');
		$this->load->model('orm/clientes_model');
		$this->load->model('orm/cuentasporpagar_model');
		$this->load->library('form_validation');		
		$this->load->database();		
		
		if(!$this->session->userdata('usuario')){		
			redirect(base_url(),'refresh');
		}elseif ($this->session->userdata('usuario') && $this->session->userdata('tipo')==1){
			redirect(base_url().'index.php/panel/');
		}
	}

	//evitar que el navegador almacene en la memoria cache las paginas
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
		$this->load->view('vendedor/indexView');
		$this->load->view('template/piepagina');
	}
	//método para  salir de sessión
	public function salir()
	{
		
		$this->session->unset_userdata('usuario');
		$this->session->unset_userdata('activo');		
		$this->session->sess_destroy();
		redirect(base_url());		
	}
	//formularion de cuentas por cobrar
	public function formularioAbono()
	{
		$this->load->view('template/encabezado');
		$this->load->view('abono/abonar_view');
		$this->load->view('template/piepagina');
	}
	//método para formulario de devolver
	public function formularioDevolver()
	{
		$this->session->set_userdata('rfc_cliente',NULL);
		$this->load->view('template/encabezado');
		$this->load->view('vendedor/formularioDevolver_view');
		$this->load->view('template/piepagina');
	}
	//método para formulario de visita
	public function formularioVisitar()
	{
		$this->session->set_userdata('rfc_cliente',NULL);
		$this->load->view('template/encabezado');
		$this->load->view('vendedor/formularioVisitar_view');
		$this->load->view('template/piepagina');
	}

	public function miAlmacen($pagina=0)
	{
		
			$this->load->model('orm/zona_model');
			$this->load->model('crud_model');
		    $id_almacen=$this->session->userdata('idzona');
			$nombrezona=$this->zona_model->get_zona($id_almacen);
			$query=$this->crud_model->almacenZona($id_almacen);			
           
            $data=array(
            	'cuerpo'=>$query,            	
            	'nombre'=>$nombrezona['zona']
            	);           
           $this->load->view('template/encabezado');
           $this->load->view('vendedor/almacenGeneral_view',$data);
           $this->load->view('template/piepagina');
	}

	public function miSubAlmacen()
	{
		$this->load->model('subalmacen_model');
		$id = $this->session->userdata('idusuario');
		$data['productos'] = $this->subalmacen_model->getWhereUser($id);
		$this->load->view('template/encabezado');
		$this->load->view('vendedor/miSubAlmacen_view',$data);
		$this->load->view('template/piepagina');
	}

	//agregar nuevos productos al subalmacen
	public function formularioSubAlmacen()
	{	
		$this->load->model('crud_model');
		//obtenemos la zona del vendedor con las sessiones
		$idzona=$this->session->userdata('idzona');
		$this->load->view('template/encabezado');
		$data['productos']=$this->crud_model->almacenZona($idzona);
		$this->load->view('vendedor/formularioSubAlmacen_view',$data);
		$this->load->view('template/piepagina');		
	}

	//tabla de clientes

	public function clientes()
	{
		//cargamos base de datos
		$zona=$this->session->userdata('idzona');
		$data['clientes']=$this->clientes_model->WhereZona($zona);		
		$this->load->view('template/encabezado');
		$this->load->view('vendedor/clientes_view',$data);
		$this->load->view('template/piepagina');
	}
	public function validarSubAlmacen()
	{
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('sku', 'Producto', 'trim|required|xss_clean|val_almacen');
			$this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required|xss_clean|val_almacen');			
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			if($this->form_validation->run()==TRUE){
				$json['exito']=TRUE;

				//cargamos el modelo necesario
				$this->load->model('orm/subalmacen_model');
				//obtenemos el id del vendedor
				$id=$this->session->userdata('idusuario');
				//importante : el id de zona es = al id de almacen
				$id_almacen=$this->session->userdata('idzona');
				$insert= array(
					'id_almacen'=>$id_almacen,
					'id_usuario'=>$id,
					'sku'=>$this->input->post('sku'),
					'cantidad'=>$this->input->post('cantidad')
				);
				//debemos restar los producto del almacen correspondientes y  agregados al subalmacen

				//insertamos en la base de datos
				$this->subalmacen_model->insert($insert);
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

	//obtener los productos para una tienda en funcion de su cadena
	public function productosCadena()
	{
		if($this->input->is_ajax_request()){

			if($this->session->userdata('rfc_cliente')!=NULL && $this->session->userdata('rfc_cliente')!=""){
				$this->load->model('preciocadena_model');
				$rfc=$this->session->userdata('rfc_cliente');
				$cliente=$this->clientes_model->whereCliente($rfc);			
				$data['productos']=$this->preciocadena_model->productoCadena($cliente['id_cadena']);
				$json['exito']=TRUE;
				$json['html']=$this->load->view('vendedor/productosCadena_view', $data,TRUE);	
				echo json_encode($json);

			}else{
				$json['exito']=FALSE;
				$json['html']="debe elegir una opción de las sugerencias.";
				echo json_encode($json);

			}
			
		}else{
			show_404();
		}
	}
	//método para validar los datos de la devolución
	public function validarDevolver()
	{
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('cliente', 'Cliente', 'trim|required|xss_clean|callback_rfc');
			$this->form_validation->set_rules('producto', 'Producto', 'trim|required|xss_clean');			
			$this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required|xss_clean');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			if($this->form_validation->run()==TRUE){
				$hora = new DateTime();
				$hora->setTimezone(new DateTimeZone('America/Mexico_City'));
				$insert=array(
					'id_usuario'=>$this->session->userdata('idusuario'),
					'rfc_cliente'=>$this->session->userdata('rfc_cliente'),
					'sku'=>$this->input->post('producto'),
					'cantidad'=>$this->input->post('cantidad'),
					'fecha'=>$hora->format("Y-m-d")
				);
				//cargamos el modelo para insertar
				$this->load->model('orm/devoluciones_model');
				$this->devoluciones_model->insert($insert);				
				$json['exito']=TRUE;
				$json['html']="<p><strong>AVISO :</strong>Se ha devuelto el producto con exito</p>";
				echo json_encode($json);
			}else{
				$json['exito']=TRUE;
				$json['html']=validation_errors();
				echo json_encode($json);
			}
		}else{
			show_404();
		}
	}

	//método para validar los datos de visita
	public function validarVisitar()
	{
		if($this->input->is_ajax_request()){

			$this->form_validation->set_rules('rfc', 'Cliente', 'trim|required|xss_clean|callback_rfc');
			$this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required|xss_clean');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('rfc','Debe elegir una de las opciones');
			$this->form_validation->set_error_delimiters('<div>','</div>');

			if($this->form_validation->run()==TRUE){
				$json['exito']=TRUE;
				$hora = new DateTime();
				$hora->setTimezone(new DateTimeZone('America/Mexico_City'));
				$insert=array(
					'id_usuario'=>$this->session->userdata('idusuario'),
					'rfc_cliente'=>$this->session->userdata('rfc_cliente'),
					'descripcion'=>$this->input->post('descripcion'),
					'fecha'=>$hora->format("Y-m-d")
					);

				$this->load->model('orm/visitas_model');
				$this->visitas_model->insert($insert);
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

	
	
	//guardar rfc_cliente en session
	public function idCliente()
	{
		if($this->input->is_ajax_request()){						
			$rfc=$this->input->post('rfc');
			$this->session->set_userdata('rfc_cliente',$rfc);
		}else{
			show_404();
		}
	}
	//EVENTO PARA PAGINAR LAS VENTAS EN FUNCION DEL VENDEDOR
	public function misventas($pagina=0)
	{
		$this->load->library('pagination');
		//datos del vendedor para obtener sus ventas
		$id=$this->session->userdata('idusuario');
		//obtenemos los datos de la DB
		$config['base_url']=base_url()."index.php/vendedor/misventas/";
		//obtener el numero de filas correspondiente al vendedor
		$config['total_rows']=$this->vendedor_model->rows_vendedor($id);
		//datos de configuracion
		$config['per_page']=8;
		$config['num_links']=5;
		$config['prev_link']="anterior";
		$config['next_link']="siguiente";
		$config['uri_segment'] = "3";  //segmentos que va a tener nuestra URL
		$config['first_link'] = "<<";  //texto del enlace que nos lleva a la primer página
		$config['last_link'] = ">>";   //texto del enlace que nos lleva a la última página

		 // inicializamos       

		$this->pagination->initialize($config);
		$data['query']=$this->vendedor_model->query_vendedor($id,$pagina,$config['per_page']);
		$data['paginacion']=$this->pagination->create_links();
		
		//cargamos la plantilla

		$this->load->view('template/encabezado');
		$this->load->view('vendedor/misventas_view',$data);
		$this->load->view('template/piepagina');
	}
	//formulario visita

	//método para obtener los clientes por zona pertenecientes a un cliente
	public function autocompletarClientes()
	{
		if($this->input->is_ajax_request()){

		$cadena=$this->input->post('cadena',TRUE);
		$zona=$this->session->userdata('idzona');
		$data['clientes']=$this->clientes_model->likeNombreZona($cadena,$zona);		
		$this->load->view('vendedor/autocompletarClientes_view', $data);			
		}else{
			show_404();
		}
	}


	public function autocompletarVenta()
	{
		if($this->input->is_ajax_request()){
			$cadena=$this->input->post('cadena');
			$zona=$this->session->userdata('idzona');
			$data['clientes']=$this->clientes_model->likeNombreZona($cadena,$zona);
			$this->load->view('vendedor/autocompletarVenta_view', $data);
		}else{
			show_404();
		}
	}

	public function busquedaCliente($rfc_cliente,$pagina=0)
	{
		$id_vendedor=$this->session->userdata('idusuario');
		$this->load->library('pagination');
		
		$config['base_url'] = base_url()."index.php/vendedor/busquedaCliente/";
		$config['total_rows'] =$this->vendedor_model->rows_ventascliente($rfc_cliente,$id_vendedor);
		$config['per_page'] = 8;
		$config['uri_segment'] = 4;
		$config['num_links'] = 5;		
		$this->pagination->initialize($config);
		
		$data['paginacion']=$this->pagination->create_links();		
		$data['query']=$this->vendedor_model->query_ventascliente($rfc_cliente,$id_vendedor,$this->uri->segment(4),$config['per_page']);
		$this->load->view('template/encabezado');		
		$this->load->view('vendedor/misventas_view', $data);
		$this->load->view('template/piepagina');		
	}


/*
* SECCION DE MÉTODOS CALLBACK FORM_VALIDATION
*
*/



	public function rfc()
	{
		if($this->session->userdata('rfc_cliente')!="" && $this->session->userdata('rfc_cliente')!=NULL){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	

	//metodo para validar los productos en el almacen y subalmacen
	// el usuario no podrá arregar productos a su subalmacen si en el almacen no hay suficientes
	public function val_almacen()
	{
		$validar= ($cantidad <= $this->input->post('cantidad')) ? TRUE:FALSE;
		return $validar;
	}
}

/* End of file vendedor.php */
/* Location: ./application/controllers/vendedor.php */