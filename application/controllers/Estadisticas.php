<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadisticas extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('Utilerias');
        $this->load->helper('form');
        $this->load->model('Estadisticas_model');
    }




    function get_datos(){
    if(Utilerias::verifica_sesion_redirige($this)){

      // $usuario = $this->session->userdata[DATOSUSUARIO];
      $tipo = $this->input->post('tipo');
      switch ($tipo) {
        case '1':
          $result = $this->Estadisticas_model->get_xatendio();
        break;
        case '2':
          $usuario = $this->session->userdata[DATOSUSUARIO];
          $idcoordinador = $usuario["idusuario"];
          $result = $this->Estadisticas_model->get_xtipopregunta($idcoordinador);
          $arr = $this->arma_xtipopregunta($result);
          echo "<pre>"; print_r($result); die();
        break;
      }


      $response = array(
        "result" => $result[0]
      );

      Utilerias::enviaDataJson(200, $response, $this);
      exit;
    }
  }// get_datos()

  function arma_xtipopregunta($arr_datos){
    $idpregunta = 0;
    $arr_finalfinal = array();

    $arr_final = array();
    $arr_aux = array();
    foreach ($arr_datos as $item) {

      if( $idpregunta != $item["idpregunta"] ){
        $idpregunta = $item["idpregunta"];
        array_push($arr_final,$arr_aux);
        $arr_aux = array();
      }else{
        array_push($arr_aux,$item);
      }

    }

    // Contamos Si y no
    $nsi = 0;
    $nno = 0;
    $arr_finalfinal = array();
    // LA posición 0 tiene un array vacío
    unset($arr_final[0]);
    echo "<pre>"; print_r($arr_final); die();

    foreach ($arr_final as $item) {
      foreach ($item as $item_hijo) {
              if($item_hijo["respuesta"] == "si"){
                $nsi++;
              }
              elseif ($item_hijo["respuesta"] == "no") {
                $nno++;
              }
      }
      // Armamos el array final
      $arr_aux2 = array(
                        "idpregunta"=>$item[0]["idpregunta"],
                        "npregunta"=>$item[0]["npregunta"],
                        "nsi"=>$nsi,
                        "nno"=>$nno
                        );
        array_push($arr_finalfinal, $arr_aux2);

    }

    echo "<pre>"; print_r($arr_finalfinal); die();
    //
  }// arma_xtipopregunta()


}
