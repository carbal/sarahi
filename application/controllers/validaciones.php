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

	//validar usuario nuevo
	public function  usuarioNuevo()
	{
		
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');		
		$this->form_validation->set_rules('apellido', "Apellido", 'trim|required|xss_clean');
		$this->form_validation->set_rules('domicilio', 'Domicilio', 'trim|required|xss_clean');
		$this->form_validation->set_rules('zonas', 'Zonas', 'trim|required|integer');
		$this->form_validation->set_rules('pass', 'Contraseña', 'trim|min_length[8]|required|xss_clean');
		$this->form_validation->set_rules('pass2', 'Confirmar', 'trim|matches[pass]|required|xss_clean');		
		$this->form_validation->set_message('required',"El campo %s es obligatorio");
		$this->form_validation->set_message('min_length','Deben de ser 8 caracteres minimo');
		$this->form_validation->set_message('matches',"El campo %s y %s no son iguales");
		$this->form_validation->set_message('integer','El campo zona es obligatorio');
		$this->form_validation->set_error_delimiters('<div>','</div>');
		if($this->form_validation->run()==TRUE){
			$this->usuario_model->insert();
			echo TRUE;			
		}else{		
			
			echo validation_errors();
		}
	}

	//validar producto nuevo
	public function productoNuevo()
	{
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('referencia', 'Referencia', 'required|xss_clean');
			$this->form_validation->set_rules('sku', 'SKU', 'trim|required|xss_clean|callback_val_sku');
			$this->form_validation->set_rules('descripcion', 'Descripcion', 'required|xss_clean');
			$this->form_validation->set_rules('um', 'Unidad de Medida', 'trim|required|xss_clean');
			$this->form_validation->set_rules('categoria', 'Categoria', 'trim|required|xss_clean');
			$this->form_validation->set_rules('precioc', 'Precio Costo', 'trim|required|is_natural_no_zero|xss_clean');
			$this->form_validation->set_rules('preciov', 'Precio Venta', 'trim|required|is_natural_no_zero|xss_clean');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('is_natural_no_zero','debe ser un entero y mayor a 0');	
			$this->form_validation->set_message('val_sku','El producto ya existe');
			$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');

			if($this->form_validation->run()==TRUE){

				$this->producto_model->insert();				
				echo TRUE;

			}else{

				echo(validation_errors());
			}

		}else{

			show_404();
		}
	}

	//validar cliente nuevo
	public function clienteNuevo()
	{
		if($this->input->is_ajax_request()){
			
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean|callback_val_nombre');
		$this->form_validation->set_rules('rfc', 'RFC', 'trim|required|xss_clean|callback_is_rfc|callback_val_rfc');		
		$this->form_validation->set_rules('cadena', 'Cadena', 'trim|required|xss_clean');
		$this->form_validation->set_rules('calle', 'Calle', 'trim|required|xss_clean');
		$this->form_validation->set_rules('interior', 'No. Interior', 'trim|required|xss_clean');
		$this->form_validation->set_rules('exterior', 'No. Exterior', 'trim|required|xss_clean');
		$this->form_validation->set_rules('colonia', 'Colonia', 'trim|required|xss_clean');
		$this->form_validation->set_rules('municipio', 'Municipio', 'trim|required|xss_clean');
		$this->form_validation->set_rules('correo', 'Correo', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('referencia', 'Referencia', 'trim|required|xss_clean');
		$this->form_validation->set_rules('codigo', 'Codigo Postal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('regimen', 'Regimen', 'trim|required|xss_clean');
		$this->form_validation->set_rules('representante', 'Representante', 'trim|required|xss_clean');
		$this->form_validation->set_rules('zona','Zona', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<div>','</div>');

		$this->form_validation->set_message('required','El campo %s es obligatorio');
		$this->form_validation->set_message('valid_email','El campo %s es incorrecto');
		$this->form_validation->set_message('is_rfc','<strong>El campo %s es incorrecto</strong>');
		$this->form_validation->set_message('val_rfc','<strong>El %s ya existe</strong>');
		$this->form_validation->set_message('val_nombre','<strong>El %s ya esta siendo utilizado</strong>');

		if($this->form_validation->run()==TRUE){
			$this->load->model('orm/clientes_model');
			$insert=array(
				'rfc'=>$this->input->post('rfc'),
				'id_cadena'=>$this->input->post('cadena'),
				'nombre'=>$this->input->post('nombre'),
				'calle'=>$this->input->post('calle'),
				'no_exterior'=>$this->input->post('exterior'),
				'no_interior'=>$this->input->post('interior'),
				'colonia'=>$this->input->post('colonia'),
				'municipio'=>$this->input->post('municipio'),
				'estado'=>$this->input->post('zona'),
				'pais'=>'MÉXICO',
				'correo'=>$this->input->post('correo'),
				'referencia'=>$this->input->post('referencia'),
				'cp'=>$this->input->post('codigo'),
				'regimen'=>$this->input->post('regimen'),
				'representante'=>$this->input->post('representante')
				);
			$this->clientes_model->insert($insert);
			$json['exito']=TRUE;
			$json['html']='<p><strong>AVISO : </strong>Se ha creado un nuevo cliente con exito</p>';
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


	//validar cadena nueva
	public function cadenaNueva()
	{
		$this->form_validation->set_rules('cadena', 'Nombre Cadena', 'trim|required|xss_clean|callback_val_cadena');
		$this->form_validation->set_rules('zona', 'Zona', 'trim|required|xss_clean|integer');
		$this->form_validation->set_rules('representante', 'Representante', 'trim|required|xss_clean');
		$this->form_validation->set_rules('telefono', 'Telefono', 'trim|required|min_length[10]|max_length[13]|xss_clean');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		$this->form_validation->set_message('min_length','El %s no es un telefono valido');
		$this->form_validation->set_message('integer','El campo Zona es obligatorio');
		$this->form_validation->set_message('max_length','El %s no es un telefono valido');		
		$this->form_validation->set_message('val_cadena','La cadena ya existe, verifique');
		$this->form_validation->set_error_delimiters('<div>','</div>');
		if($this->form_validation->run()==TRUE){
			//obtenemos la ultima id_cadena creada en la db y los productos
			$data['idcadena']=$this->cadena_model->insert();
			$data['productos']=$this->producto_model->select();			
			$json['exito']=TRUE;
			echo json_encode($json);
		}else{
			$json['exito']=FALSE;
			$json['html']=validation_errors();
			echo json_encode($json);
		}
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

		if($this->form_validation->run()==TRUE){

			$producto=$this->input->post('producto');
			$zona=$this->input->post('zona');
			$cantidad=$this->input->post('cantidad');

			if($this->productos_enalmacen_model->existeProductoAlmacen($producto,$zona)==TRUE){

				$this->productos_enalmacen_model->sumarProductoAlmacen($producto,$zona,$cantidad);
				$json['exito']=TRUE;
				echo(json_encode($json));
			}else{
				$this->productos_enalmacen_model->insertProductoAlmacen($producto,$zona,$cantidad);
				$json['exito']=TRUE;
				echo(json_encode($json));
			}


		}else{
			$json['exito']=FALSE;
			$json['html']=validation_errors();
			echo json_encode($json);
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
		if(count($this->clientes_model->whereCliente($this->input->post('rfc')))>0){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	//método para comprobar su una cadena existe, para evitar repetir cadenas
	public function val_cadena()
	{
		if($this->cadena_model->existeCadena()==0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//método para comprobar que el nombre del cliente no se repita
	public function val_nombre()
	{
		$this->load->model('orm/clientes_model');
		if(count($this->clientes_model->whereNombre($this->input->post('nombre')))==0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	//metodo para comprobar si un SKU del producto existe, para evitar repetir productos
	public function val_sku($sku)
	{
		if($this->producto_model->existeProducto()==0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

}

/* End of file validaciones.php */
/* Location: ./application/controllers/validaciones.php */