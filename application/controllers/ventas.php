<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ventas extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->removeCache();
		$this->load->database();
		$this->load->library('form_validation');		
		$this->load->model('orm/clientes_model');
		$this->load->model('orm/producto_model');
		$this->load->model('orm/detalle_venta_model');
		$this->load->model('orm/productos_enalmacen_model');
		$this->load->model('preciocadena_model');
		$this->load->model('orm/ventas_model');
		$this->load->library('session');

		if(!$this->session->userdata('usuario')){		
			redirect(base_url());
		}		
	}

	public function removeCache()
	{
		$this->output->set_header('Last-Modified:gmdate("D, d MYH: i: s"..)GMT');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, post-check = 0, pre-check = 0 ");
		$this->output->set_header("Pragma: no-cache");
		$this->output->set_header("Expires: Mon, 26 de julio 1997 05:00:00 GMT");
	}
	
	//método principal del constructor
	public function index()
	{
		//generamos template
		$this->load->view('template/encabezado');
		$this->load->view('ventas/indexView');
		$this->load->view('template/piepagina');
		//creamos sessiones importantes para el proceso de venta
		$this->session->set_userdata('rfc_cliente',NULL);	
		$this->session->set_userdata('pila_productos',array());	
	}

	//METODO PARA OBTENER LAS SUGERENCIAS DE CLIENTE PETICION AJAX
	public function getClientes()
	{
		$cadena = $this->input->post('string');
		//SESSION DEL USUARIO
		$idZona = $this->session->userdata('idzona');
		$query  = $this->clientes_model->likeNombreZona($cadena,$idZona);
		$data['sugerencias'] = $query;			
		$this->load->view('ventas/getClientesView', $data);		
	}

	//método para devolver los datos del cliente
	public function datosCliente()
	{
		if($this->input->is_ajax_request()){
			//obtenemos el rfc del cliente PK para obtener sus datos
		$rfc = $this->input->post('rfc');
				
		$this->session->set_userdata('rfc_cliente',$rfc);			
		$data['cliente'] = $this->clientes_model->whereCliente($rfc);
		$deuda;
		//verificamos si el cliente tiene cuentas pendientes
		$cliente_deuda=$this->ventas_model->clienteCuenta($rfc);
		if(count($cliente_deuda) > 0){
			$deuda = TRUE;
		}else{
			$deuda = FALSE;
		}
		//cargamos los productos que tiene permiso el cliente
		$data['productos'] = $this->preciocadena_model->productoCadena($data['cliente']['id_cadena']);
		$json['html']      = $this->load->view('ventas/datosClienteView', $data,TRUE);
		$json['deuda']     = $deuda;
		echo json_encode($json);		
		}else{
			show_404();
		}
	}
	//método para agregar productos a la venta
	public function addproductos()
	{
		$this->form_validation->set_rules('sku', 'Producto','trim|required|callback_existeProducto|xss_clean');
		$this->form_validation->set_rules('precio', 'Precio', 'trim|is_natural_no_zero|required|xss_clean');
		$this->form_validation->set_rules('cantidad','Cantidad','trim|required|is_natural_no_zero|callback_productosinsuficientes|xss_clean');
		$this->form_validation->set_message('is_natural_no_zero','El campo %s debe ser mayor a cero');
		$this->form_validation->set_message('required','El campo %s es requerido');
		$this->form_validation->set_message('productosinsuficientes','No existen productos suficiente para realizar la operacion.');
		$this->form_validation->set_message('existeProducto','<strong>ADVERTENCIA:</strong>El producto :'.$this->input->post('describe').' no esta agregado a su <br> <strong>Subalmacen</strong>');
		
		if($this->form_validation->run() == TRUE){
			$sku      = $this->input->post('sku');
			$precio   = $this->input->post('precio');
			$cantidad = $this->input->post('cantidad');
			$describe = $this->input->post('describe');
			if($this->sumar_producto($sku,$precio,$cantidad,$describe) == TRUE){					
				echo TRUE;
			}else{
				echo "ADVERTENCIA : No se puede agregar un mismo producto con diferente precio";				
			}
			
		}else{
			echo validation_errors();
		}
	}

//método para agregar un nuevo producto a la session
	function sumar_producto($sku,$precio,$cantidad,$describe)
	{
		$pila_actual=$this->session->userdata('pila_productos');		
		if(array_key_exists($sku,$pila_actual)){
			if($pila_actual[$sku]['precio'] == $precio){

				$pila_actual[$sku]['cantidad'] += $cantidad;
				$pila_actual[$sku]['total'] = $pila_actual[$sku]['cantidad']*$pila_actual[$sku]['precio'];
				$this->session->set_userdata('pila_productos',$pila_actual);	
				return TRUE;			
			}else{
				return FALSE;
			}

		}else{
			$total=$precio*$cantidad;
			$pila_actual[$sku]=array(
				'describe' => $describe,
				'sku'      => $sku,					
				'precio'   => $precio,
				'cantidad' => $cantidad,
				'total'    => $total
			);			
			$this->session->set_userdata('pila_productos',$pila_actual);
			return TRUE;
		}		
	}
	//MÉTODO PARA MOSTRAR LOS PRODUCTO RELACIONADO CON VISTA
	public function tablaProductos()
	{

		$data['detalles'] = $this->session->userdata('pila_productos');
		//obtenemos la columna total de la pila de productos
		$productos_total  = $this->get_column($data['detalles'],'total');
		$data['importe']  = $this->venta_total($productos_total);
		$this->load->view('ventas/tablaProductosView', $data);
	}

	//MÉTODO PARA PREGUNTAR SI EXISTEN PRODUCTOS EN LA PILA
	public function existen_productos()
	{
		if(count($this->session->userdata('pila_productos')) > 0){
			echo TRUE;		
		}else{
			echo FALSE;
		}
	}
	//MÉTODO PARA VACIAR LA PILA DE PRODUCTOS
	public function vaciar_pila()
	{
		$this->session->set_userdata('pila_productos',array());
		
	}
	//METODO PARA ELIMINAR UN PRODUCTO ESPECIFICO
	public function eliminar_producto()
	{
		if($this->input->is_ajax_request()){
		$sku  = $this->input->post('sku');	
		$pila = $this->session->userdata('pila_productos');
		unset($pila[$sku]);		
		$this->session->set_userdata('pila_productos',$pila);
		}else{
			show_404();
		}
	}


	public function finalizar_venta()
	{
		//obtengo los valores almacenados en las cookies¡¡¡
		$insert;

		//creamos objeto para guardar hora correcta
		$hora = new DateTime();
		$hora->setTimezone(new DateTimeZone('America/Mexico_City'));
		
		//obtenemos sessiones necesarios
		$rfc_cliente    = $this->session->userdata('rfc_cliente');
		$id_vendedor    = $this->session->userdata('idusuario');		
		$pila_productos = $this->session->userdata('pila_productos');
		//obtenemos el valor total de todos los productos y lo almacenamos en un array
		$array_totales  = $this->get_column($pila_productos,'total');
		$total_venta    = $this->venta_total($array_totales);
		$iva_venta;
		$importe;
		$folio_venta = '00001';
		$tipo_venta;
		$estado;


		if($this->input->post('tipo_venta') == 'efectivo'){
			$tipo_venta = 1;
			$estado     = 1;
			if ($this->session->userdata('idzona') == 2) {
			$iva_venta = $total_venta*IVA_FRONTERA;
			$importe   = $total_venta+$iva_venta;

			}elseif ($this->session->userdata('idzona') != 2) {				
			$iva_venta = $total_venta*IVA_NORMAL;
			$importe   = $total_venta+$iva_venta;
			}

			$insert=array(
				'rfc'         => $rfc_cliente,
				'id_usuario'  => $id_vendedor,
				'total_venta' => $total_venta,
				'iva_venta'   => $iva_venta,
				'importe'     => $importe,
				'fecha'       => $hora->format("Y-m-d"),
				'hora'        => $hora->format("H:i:s"),
				'folio_venta' => $folio_venta,
				'tipo_venta'  => $tipo_venta,
				'estado'      => $estado
			);

			//enviamos los datos del cliente y el costo total de su compra para almacenar en la tabla ventas			
			$id_venta = $this->ventas_model->insert($insert);
			//almacenamos el detalle de ventas
			$this->agregar_productos($id_venta,$pila_productos);
			$this->restarSubalmacen();
		}
		elseif($this->input->post('tipo_venta') == 'credito'){
			$tipo_venta = 0;
			$estado     = 0;

			if ($this->session->userdata('idzona') == 2) {
			$iva_venta = $total_venta*IVA_FRONTERA;
			$importe   = $iva_venta+$total_venta;

			}elseif ($this->session->userdata('idzona') != 2) {				
			$iva_venta = $total_venta*IVA_NORMAL;
			$importe   = $iva_venta+$total_venta;
			}

			$insert=array(
				'rfc'         => $rfc_cliente,
				'id_usuario'  => $id_vendedor,
				'total_venta' => 0,
				'iva_venta'   => 0,
				'importe'     => 0,
				'fecha'       => $hora->format("Y-m-d"),
				'hora'        => $hora->format("H:i:s"),
				'folio_venta' => $folio_venta,
				'tipo_venta'  => $tipo_venta,
				'estado'      => $estado
			);

			//enviamos los datos del cliente y el costo total de su compra para almacenar en la tabla ventas			
			$id_venta = $this->ventas_model->insert($insert);
			//almacenamos el detalle de ventas
			$this->agregar_productos($id_venta,$pila_productos);
			$this->restarSubalmacen();
			//guardamos lo que se debe en cuentasporcobrar
			$this->load->model('orm/cuentasporpagar_model');
			$this->cuentasporpagar_model->insert($id_venta,0,$importe);
		}	
	}


	public function get_column($array,$column)
	{
		//extraer la llave total para obtener el total, iva
		$get_column=array();
		foreach ($array as $producto) {
			if(isset($producto[$column])){
                    
 				$get_column[]=$producto[$column];	

			}
		}
		return $get_column;		
	}
	//SUMAR TODOS LOS TOTAL DE PRODUCTOS QUE SE DEBEN DE VENDER
	public function venta_total($array)
	{
		$importe=0;
		foreach ($array as $llave) {
			$importe+=$llave;
		}
		return $importe;
	}
	//METODO PARA AGREGAR LOS PRODUCTOS VENDIDOS  A LA TABLA DETALLEVENTAS
	public function agregar_productos($id_venta,$pila_productos)
	{
		
		foreach ($pila_productos as $producto) {

			$this->detalle_venta_model->insert($id_venta,$producto);
			
		}
	}
	//METODO PARA ELIMINAR EXISTENCIAS DE PRODUCTOS_ENALMACEN
	public function restarSubalmacen()
	{
		//OBTENEMOS LA ZONA DEL VENDEDOR ALMACENADA EN LA COKKIE
		$this->load->model('subalmacen_model');
		$idusuario  = $this->session->userdata('idusuario');
		$productos  = $this->session->userdata('pila_productos');
		
		//ITERAMOS LA PILA DE PRODUCTOS->
		foreach ($productos as $producto) {
			//LLAMAMOS ALA FUNCION DEL MODELO ENCARGADA DE RESTAR LA CANTIDAD VENDIDA
			//ENVIAMOS LOS PARAMETROS 
			$this->subalmacen_model->updateExistencia($idusuario,$producto['sku'],$producto['cantidad']);
		}
	}
	//MENSAJE PARA DAR AVISO DE EXITO AL FINALIZAR LA VENTA
	public function msj_success()
	{
		$data['titulo'] = "La venta a finalizado con exito";
		$data['sub']    = "Por favor verifique en Mis venta";
		$this->load->view('ventas/venta_terminada',$data);
	}
	//MENSAJE PARA DAR AVISO DE ERROR AL FINALIZAR LA VENTA
	public function msj_error()
	{
		$data['titulo'] = "Se ha encontrado un error al finalizar la venta";
		$data['sub']    = "Por favor notifique al administrador";
		$this->load->view('ventas/venta_terminada',$data);
	}
/*
*SECCION DE MÉTODO PERSONALIZADOS CALLBACK DE
* LAS LIBRERIA FORM_VALIDATION
*/
	
//METODO CALLBACK PARA COMPROBAR SI EXISTEN PRODUCTOS SUFICIENTES PARA PODER VENDER
	public function existeProducto()
	{
		$this->load->model('subalmacen_model');
		$id        = $this->session->userdata('idusuario');
		$sku       = $this->input->post('sku');
		$productos = $this->subalmacen_model->existeProducto($id,$sku);
		if(count($productos) > 0){
			return 	TRUE;
		}else{
			return FALSE;
		}
	}

	public function productosinsuficientes()
	{
		$this->load->model('subalmacen_model');

		$id        = $this->session->userdata('idusuario');
		$sku       = $this->input->post('sku');
		$cantidad  = $this->input->post('cantidad');
		$productos = $this->subalmacen_model->existeProducto($id,$sku);
		$pila      = $this->session->userdata('pila_productos');

		if(isset($pila[$sku])){

			if(($pila[$sku]['cantidad']+$cantidad) <= $productos['existencia'])
				return TRUE;
			else
				return FALSE;
		}else{

			if(count($productos) > 0){

				if( $cantidad <= $productos['existencia'])
					return TRUE;
				else
					return FALSE;

			}else{
				return TRUE;				
			}
		}
	}
}
