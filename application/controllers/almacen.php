<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Almacen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->removeCache();
		$this->load->library('session');
		$this->load->database();
		$this->load->library('form_validation');
		if(!$this->session->userdata('usuario')){
			redirect(base_url());
		}	
	}
	//evitar que se almacene cache en el controlador
	public function removeCache()
	{
		$this->output->set_header('Last-Modified:gmdate("D, d MYH: i: s"..)GMT');
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, post-check = 0, pre-check = 0 ");
		$this->output->set_header("Pragma: no-cache");
		$this->output->set_header("Expires: Mon, 26 de julio 1997 05:00:00 GMT");
	}

	//mostrar almacenes por zona: yucatan, campeche, q roo
	public function zona($almacen)
	{
		

		switch ($almacen) {
			case 'Yucatan':
				$id_almacen=1;
				break;
			case 'QRoo':
				$id_almacen=2;
				break;
			case 'Campeche':
				$id_almacen=3;
				break;		

			default:
				echo "<div class='alert alert-danger'>No hay referencia a este almacen</div>";
				die();
				break;
		}

		//cargamos los modelos necesarios
		$this->load->model('orm/zona_model');
		$this->load->model('crud_model');
		$this->load->model('orm/usuario_model');
		$this->load->model('orm/subalmacen_model');
			
			
			$query    = $this->crud_model->almacenZona($id_almacen);
			//obtenemos los usuarios que pertenece a esta zona
			$usuarios = $this->usuario_model->whereZona($id_almacen);

			//obtenemos los subalmacenes pertenecientes a cada usuario

			//arreglo que contrendra todos los subalmacenes
			$subalmacenes=NULL;
			if(count($usuarios)>0){
				foreach($usuarios as $usuario){

					$subalmacen = $this->subalmacen_model->whereUsuario($usuario['id_usuario']);

					//guardamos los datos el usuario

					//preguntamos si el usuario tiene productos en su subalmacen
					//si se cumple almacenamos si no el array subalmacenes no guardar nada
					if(count($subalmacen)>0){						
						$subalmacenes[$usuario['id_usuario']]['productos'] = $subalmacen;	
						$subalmacenes[$usuario['id_usuario']]['usuario']   = $usuario['nombres']." ".$usuario['apellidos'];

					}
				}
				
			}


					            
            $cuerpo=$query;        
            
            $data=array(
            	'id_almacen'   => $id_almacen,
            	'cuerpo'       => $cuerpo,            	
            	'nombre'       => $almacen,
            	'subalmacenes' => $subalmacenes            	
            );
           $this->load->view('template/encabezado');
           $this->load->view('almacen/zonaView', $data);
           $this->load->view('template/piepagina');
	}

	//mostrar modal para editar 
	public function modalEditar()
	{

		$idProducto = $this->input->post('id');

		//llamamos al modelo requerido		
		$this->load->model('orm/productos_enalmacen_model');
		//obtemos los datos del producto por zona
		$data['producto'] = $this->productos_enalmacen_model->getProducto($idProducto);
		$this->load->view('almacen/modalEditarView',$data);
	}
	//actualizar stock minimo y stock maximo de un producto
	public function updateProducto()
	{
		if($this->input->is_ajax_request()){


			$this->form_validation->set_rules('stock_min', 'stock_min', 'required|integer|xss_clean');
			$this->form_validation->set_rules('stock_max', 'stock_max', 'required|integer|xss_clean');
			
			if($this->form_validation->run() == TRUE){
				//capturamos los datos enviados por POST
				$id = $this->input->post('id');
				$data = array(
					'stock_max'=>$this->input->post('stock_max'),
					'stock_min'=>$this->input->post('stock_min')
				);
				//llamamos al modelo donde vamos a inserta
				$this->load->model('orm/productos_enalmacen_model');
				$this->productos_enalmacen_model->updateProducto($id,$data);
				echo json_encode(array('success'=>TRUE));				
			}else{
				echo json_encode(array('success'=>FALSE));
			}

		}else{
			show_404();
		}
	}





}