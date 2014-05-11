<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Abono extends CI_Controller {

	//constructor principal del controlador
	public function __construct()
	{	
		parent::__construct();
		$this->removeCache();
		$this->load->database();
		$this->load->library('session');
		$this->load->library('form_validation');	
		$this->load->library('jquery_pagination');	

		if(!$this->session->userdata('usuario')){
			redirect(base_url());
		}
	}
	//remover caché
	public function removeCache()
	{
		$this->output->set_header('Last-Modified:gmdate("D, d MYH: i: s"..)GMT');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, post-check = 0, pre-check = 0 ");
		$this->output->set_header("Pragma: no-cache");
		$this->output->set_header("Expires: Mon, 26 de julio 1997 05:00:00 GMT");		
	}	
	//metodo para enviar las posibles opciones de autocompletado
	public function autocompletarAdmon()
	{
		//cargamos los modelos que necesitaremos
		$this->load->model('orm/cadena_model');
		$this->load->model('orm/clientes_model');
		if($this->input->is_ajax_request()){
			$cadena=$this->input->post('cadena');			
			$data['cadenas']=$this->cadena_model->likeAdmon($cadena);
			$data['clientes']=$this->clientes_model->likeAdmon($cadena);
			$this->load->view('abono/autocompletar_view',$data);
		}else{
			show_404();
		}
	}
	//mostrar sugerencias de clientes y cadenas minoristas al vendedor
	public function autocompletarVendedor()
	{
		
		$this->load->model('orm/clientes_model');
		//obtenemos la zona del vendedor
		$zonaVendedor=$this->session->userdata('idzona');
		if($this->input->is_ajax_request()){
			$cadena=$this->input->post('cadena');
			$data['cadenas']=NULL;
			$data['clientes']=$this->clientes_model->likeVendedor($cadena,$zonaVendedor);
			$this->load->view('abono/autocompletar_view',$data);
		}else{
			show_404();
		}
	}
	//metodo para guardar las sessiones necesarias para realizar la busqueda
	public function saveIdAbono()
	{
		if($this->input->is_ajax_request()){						
			$this->session->set_userdata('idabono',$this->input->post('id'));
			$this->session->set_userdata('tabla',$this->input->post('tabla'));
		}else{
			show_404();
		}
	}
	//buscar cuentas por pagar segun 
	public function buscarCuenta()
	{
		//llamamos las sessiones para realizar busqueda
		$id=$this->session->userdata('idabono');
		$tabla=$this->session->userdata('tabla');

		if($this->input->is_ajax_request()){

			$this->form_validation->set_rules('parametro', 'Parametro', 'trim|required|callback_idSelected|xss_clean');
			$this->form_validation->set_message('required','El campo de Busqueda es obligatorio');	
			$this->form_validation->set_message('idSelected','Debe de elegir una opcion de las sugerencias proporcionadas');		
			$this->form_validation->set_error_delimiters('<div>','</div>');
			if($this->form_validation->run()==TRUE){

				$json['exito']=TRUE;
				$json['html']="TODO BIEN";

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
	//metodo par obtener los resultados de la busqueda
	public function obtenerResultados()
	{
		//obtenemos las sessiones necesarias para poder realizar la busqueda
		$id=$this->session->userdata('idabono');
		$tabla=$this->session->userdata('tabla');
		switch ($tabla) {
			case 'cadena':{
				$this->cppCadena();
				break;
			}
			case 'clientes':{
				$this->cppCliente();
				break;
			}			
			
			default:{

				break;
			}
				
		}
	}
	//método para mostrar cuentas por pagar por cadena
	public function cppCadena($apartir=0)
	{

		//llamamos a los modelos necesarios
		$this->load->model('cpp/cadena_model');
		//llamamos a las sesiones necesarias
		$idCadena=$this->session->userdata('idabono');

			//configuramos la url de la paginacion
            $config['base_url'] =base_url()."index.php/abono/cppCadena/";            
            $config['div'] = 'div#resultados';            
            $rows=$this->cadena_model->rowscadena($idCadena);
            $config['total_rows'] = $rows->num_rows();
            $rows->next_result();
            $rows->free_result();            
            $config['per_page'] = 10;            
            $config['num_links'] = 4;             
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Último';
             
            //cargamos la librería con nuestra configuracion
            $this->jquery_pagination->initialize($config);
             
            //obtemos los valores
            $query=$this->cadena_model->cadena($idCadena,$apartir);
            $data['query'] = $query->result_array();
            $query->next_result();
            $query->free_result();
            $data['page'] = $this->jquery_pagination->create_links();  
            
           	$this->load->view('abono/cppCadena_view',$data);     
	}
	//método para mostrar cuentas por pagar por cliente
	public function cppCliente($apartir=0)
	{
			//llamamos a los modelos necesarios
			$this->load->model('cpp/cliente_model');
			//llamamos a las sesiones necesarias
			$idCliente=$this->session->userdata('idabono');
			//configuramos la url de la paginacion
            $config['base_url'] =base_url()."index.php/abono/cppCliente/";            
            $config['div'] = 'div#resultados';            
            //le decimos cuantas filas en total tiene nuestra tabla noticias
            $rows=$this->cliente_model->rowscliente($idCliente);
            $config['total_rows'] = $rows->num_rows();
            $rows->next_result();
            $rows->free_result();           
            $config['per_page'] = 10;            
            $config['num_links'] = 4;             
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Último';
             
            //cargamos la librería con nuestra configuracion
            $this->jquery_pagination->initialize($config);
             
            //obtemos los valores
            $query=$this->cliente_model->cliente($idCliente,$apartir);
            $data['query'] = $query->result_array();
            $query->next_result();
            $query->free_result();
            $data['page'] = $this->jquery_pagination->create_links();  
            
           	$this->load->view('abono/cppCliente_view',$data);
	}
	//método para cargar vista para agregar un nuevo abono
	public function addabono($idVenta)
	{
		//cargamos los modelos necesarios
		$this->load->model('orm/cuentasporpagar_model');
		//obtenemos los datos necesarios
		$data['id_venta']=$idVenta;
		$data['pagos']=$this->cuentasporpagar_model->pagosporVenta($idVenta);
			if(count($data['pagos'])>=1){
					$data['primero']=$this->cuentasporpagar_model->primerpago($idVenta);					
					$data['ultimo']=$this->cuentasporpagar_model->ultimopago($idVenta);
					$this->load->view('template/encabezado');
					$this->load->view('abono/addabono_view',$data);
					$this->load->view('template/piepagina');			
				
			}else{
				show_404();
			}
	}
	//metodo para validar la cantidad abonada a cuenta del cliente
	public function validarAbono()
	{
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('valor', 'Abono', 'trim|required|greater_than[0]|xss_clean|callback_valAbono');
			$this->form_validation->set_message('required','El campos %s es obligatorio');
			$this->form_validation->set_message('greater_than','El campo debe ser un numero mayor a cero');
			$this->form_validation->set_message('valAbono','No se puede cobrar una cantidad mayor a la que se debe');
			$this->form_validation->set_error_delimiters('<div>','</div>');
			if($this->form_validation->run()==TRUE){
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
	//insertar un nuevo abono a la base de datos
	public function insertAbono()
	{
		if($this->input->is_ajax_request()){
		$id_venta=$this->input->post('id_venta');
		$abono=$this->input->post('valor');
		$this->load->model('orm/cuentasporpagar_model');
		$ultimo=$this->cuentasporpagar_model->ultimopago($id_venta);
		$porpagar=$ultimo['porpagar']-$abono;
		$this->cuentasporpagar_model->insert($id_venta,$abono,$porpagar);	

		//IMPORTANTE agregamos a ventas la cantidad abonada 

		$this->load->model('orm/ventas_model');
		$venta=$this->ventas_model->getVenta($id_venta);
		$importe=$venta['importe']+$abono;
		$iva_venta;
		if($this->session->userdata('idzona')==2){
			$iva_venta=$importe*IVA_FRONTERA;
			$total_venta=$importe-$iva_venta;
		}
		elseif ($this->session->userdata('idzona')!=2) {
			$iva_venta=$importe*IVA_NORMAL;
			$total_venta=$importe-$iva_venta;
		}
		$insert=array(
			'importe'=>$importe,
			'iva_venta'=>$iva_venta,
			'total_venta'=>$total_venta
			);
		if($porpagar==0){
			$this->ventas_model->updateEstado($id_venta,$insert);
		}else{
			$this->ventas_model->updateImporte($id_venta,$insert);
		}

		}else{
			show_404();
		}
	}
	//callback para comprobar si alguna opcion de busqueda fue elegida 
	public function idSelected()
	{
		if($this->session->userdata('idabono')==NULL || $this->session->userdata('idabono')==""){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function valAbono()
	{
		$this->load->model('abonar_model');		
		$id_venta=$this->input->post('id_venta');
		$abono=$this->input->post('valor');
		$ultimo=$this->abonar_model->ultimopago($id_venta);

		if($abono<=$ultimo['porpagar']){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

/* End of file abono.php */
/* Location: ./application/controllers/abono.php */
?>