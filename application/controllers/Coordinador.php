<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coordinador extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Coord_visit_model');
        $this->load->library('Utilerias');

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


        // echo $this->input->post('itxt_administrador_id_coordinador'); die();

        if($this->input->post('itxt_administrador_id_coordinador') != NULL){
          $data["id_coordinador"] = $this->input->post('itxt_administrador_id_coordinador');
        }
        else{
          $data["id_coordinador"] = 0;
        }

          $data["usuario"] = $tipo.$usuario["nombre"]." ".$usuario["paterno"]." ".$usuario["materno"];

          Utilerias::pagina_basica($this, "coordinador/index", $data);
        }
    }//

    function read(){
      if(Utilerias::verifica_sesion_redirige($this)){

        $usuario = $this->session->userdata[DATOSUSUARIO];
        $idcoordinador = $this->input->post('idcoordinador');
        // echo $idcoordinador; die();
        if($idcoordinador==0){
          $idusuario = $usuario["idusuario"];
        }else{
          $idusuario = $idcoordinador;
        }
        $result = $this->Coord_visit_model->get_visitadores($idusuario);

        $arr_columnas = array(
         "id"=>array("type"=>"hidden", "header"=>"id"),
         "nombre_completo"=>array("type"=>"text", "header"=>"Visitador")
       );

        $response = array(
          "result" => $result,
          "columnas" => $arr_columnas
        );
        Utilerias::enviaDataJson(200, $response, $this);
        exit;
      }
    }// read()

}// Coordinador
