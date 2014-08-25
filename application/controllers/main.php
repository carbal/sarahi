<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller{
  
  public function __construct(){
    parent::__construct();
    //llamamos al modelo correspondiente a la tabla usuario
  	$this->load->model('orm/usuario_model');   	
  	$this->load->library('form_validation');
    $this->load->library('encrypt');
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

  public function validar()
  {   
    $this->form_validation->set_rules('user', 'Usuario', 'required');
    $this->form_validation->set_rules('pass', 'Contraseña', 'required|callback_valuser');
    $this->form_validation->set_message('required','Requerido');
    $this->form_validation->set_message('valuser','Datos incorrectos');

      if($this->form_validation->run() == TRUE){
          
          if($this->session->userdata('tipo')==1){
          redirect(base_url()."index.php/panel/");        
          }
          elseif ($this->session->userdata('tipo')==0) {
            redirect(base_url()."index.php/vendedor/");
          }
          else{
            redirect(base_url().'index.php/main');
          }
      }
      else{    
        $this->load->view('main/entrada');
      }
   	 
  } 


 //callback form_validation
  public function valuser()
  {
    $data      =  $this->usuario_model->val_usuario();
    $pass      =  $this->input->post('pass');

    if(!empty($data)){
      if($pass == $this->encrypt->decode($data['password'])){
        $data=array(
          'usuario'  => $data['usuario'],
          'nombres'  => $data['nombres'],
          'apellido' => $data['apellidos'],
          'tipo'     => $data['tipo'],
          'idusuario'=> $data['id_usuario'],
          'idzona'   => $data['id_zona']
        );
        $this->session->set_userdata( $data );
        return TRUE;
      }
      else
        return FALSE;
    }
  }


  
}
