<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Almacen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->removeCache();
		$this->load->library('session');
		$this->load->database();
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
			
			
			$query=$this->crud_model->almacenZona($id_almacen);
			//obtenemos los usuarios que pertenece a esta zona
			$usuarios=$this->usuario_model->whereZona($id_almacen);

			//obtenemos los subalmacenes pertenecientes a cada usuario

			//arreglo que contrendra todos los subalmacenes
			$subalmacenes=NULL;
			if(count($usuarios)>0){
				foreach($usuarios as $usuario){

					$subalmacen=$this->subalmacen_model->whereUsuario($usuario['id_usuario']);

					//guardamos los datos el usuario

					//preguntamos si el usuario tiene productos en su subalmacen
					//si se cumple almacenamos si no el array subalmacenes no guardar nada
					if(count($subalmacen)>0){						
						$subalmacenes[$usuario['id_usuario']]['productos']=$subalmacen;	
						$subalmacenes[$usuario['id_usuario']]['usuario']=$usuario['nombres']." ".$usuario['apellidos'];

					}
				}
				
			}


					            
            $cuerpo=$query;        
            
            $data=array(
            	'cuerpo'=>$cuerpo,            	
            	'nombre'=>$almacen,
            	'subalmacenes'=>$subalmacenes            	
            	);
           $this->load->view('template/encabezado');
           $this->load->view('almacen/show_almacen', $data);
           $this->load->view('template/piepagina');
	}





}