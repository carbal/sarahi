<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller{
  
  public function __construct(){
    parent::__construct();
    $this->removeCache();
    //llamamos al modelo correspondiente a la tabla usuario
  	$this->load->model('orm/usuario_model');   	
  	$this->load->library('form_validation');
    $this->load->library('session');    
    $this->load->database();

   if($this->session->userdata('usuario') && $this->session->userdata('tipo')==1){
    redirect(base_url().'index.php/panel/');
   }elseif ($this->session->userdata('usuario') && $this->session->userdata('tipo')==0) {
     redirect(base_url().'index.php/vendedor/');
   }
    
  }
  
public function index()
{	  
	$this->load->view('main/entrada');
}

public function removeCache()
{
  $this->output->set_header('Last-Modified:gmdate("D, d MYH: i: s"..)GMT');
  $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, post-check = 0, pre-check = 0 ");
  $this->output->set_header("Pragma: no-cache");
  $this->output->set_header("Expires: Mon, 26 de julio 1997 05:00:00 GMT");
}


public function validar()
{   
  $this->form_validation->set_rules('user', 'Usuario', 'required');
  $this->form_validation->set_rules('pass', 'Contraseña', 'required|callback_valuser');
  $this->form_validation->set_message('required','Requerido');
  $this->form_validation->set_message('valuser','Datos incorrectos');

    if($this->form_validation->run()==TRUE){
         //obtenemos los datos del usuario logeado
        $datos=$this->usuario_model->get_usuario();
        //IMPORTANTE: Se guardan en sesesiones datos esenciales durante todo
        //el tiempo que el usuario esta logueado
        $data=array(
          'usuario'=> $datos['nombres'],
          'apellido'=>$datos['apellidos'],
          'tipo'=>$datos['tipo'],
          'idusuario'=>$datos['id_usuario'],
          'idzona'=>$datos['id_zona']
          );      
              
        $this->session->set_userdata( $data );

        if($this->session->userdata('tipo')==1){
        redirect(base_url()."index.php/panel/");        
        }
        elseif ($this->session->userdata('tipo')==0) {
          redirect(base_url()."index.php/vendedor/");
        }
        else{
          redirect(base_url());
        }
    }
    else{    
      $this->load->view('main/entrada');
    }
 	 
} 


 //callback form_validation
 public function valuser()
 {
  if($this->usuario_model->val_usuario()==TRUE){    
       return TRUE;
  }else{
        return FALSE;
  }

 }



}
