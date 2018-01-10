<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadisticas extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('Utilerias');
        $this->load->helper('form');
        $this->load->model('Estadisticas_model');
    }




    function get_xatendio(){
    if(Utilerias::verifica_sesion_redirige($this)){

      // $usuario = $this->session->userdata[DATOSUSUARIO];

      $result = $this->Estadisticas_model->get_xatendio();

      $response = array(
        "result" => $result[0]
      );

      Utilerias::enviaDataJson(200, $response, $this);
      exit;
    }
  }// read()


}
