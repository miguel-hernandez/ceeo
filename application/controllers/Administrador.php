<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('Utilerias');
        $this->load->helper('form');
        $this->load->model('Administrador_model');
    }


    public function index()
    {
        if(Utilerias::verifica_sesion_redirige($this)){
          $data["titulo"] = "COORDINADOR";
          $usuario = $this->session->userdata[DATOSUSUARIO];
          // echo "<pre>"; print_r($usuario); die();
          switch ($usuario["idtipousuario"]) {
            case UVISITADOR:
              $tipo = "VISITADOR: ";
            break;
            case UCOORDINADOR:
              $tipo = "COORDINADOR: ";
            break;
            case UADMINISTRADOR:
              $tipo = "ADMINISTRADOR: ";
            break;
          }
          // $tipo =
          $data["usuario"] = $tipo.$usuario["nombre"]." ".$usuario["paterno"]." ".$usuario["materno"];

          Utilerias::pagina_basica($this, "administrador/index", $data);
        }
    }//

    function read(){
    if(Utilerias::verifica_sesion_redirige($this)){
      $usuario = $this->session->userdata[DATOSUSUARIO];
      $result = $this->Administrador_model->get_coordinadores();

      $arr_columnas = array(
       "id"=>array("type"=>"hidden", "header"=>"idusuario"),
       "nombre"=>array("type"=>"text", "header"=>"Nombre"),
       "email"=>array("type"=>"text", "header"=>"Mail"),
       "telefono"=>array("type"=>"text", "header"=>"Telefono")
     );

      $response = array(
        "result" => $result,
        "columnas" => $arr_columnas
      );

      Utilerias::enviaDataJson(200, $response, $this);
      exit;
    }
  }// read()


}
