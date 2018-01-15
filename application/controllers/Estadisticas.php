<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadisticas extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('Utilerias');
        $this->load->helper('form');
        $this->load->model('Estadisticas_model');
        $this->load->model('Aplicar_model');
        $this->load->model('Coordinador_model');
    }





    function get_datos(){
    if(Utilerias::verifica_sesion_redirige($this)){

      $usuario = $this->session->userdata[DATOSUSUARIO];

      $visitadores = "";
      if($usuario["idtipousuario"] == UCOORDINADOR){ // corrdinador es 2 en las constantes de Utilerias
          $result = $this->Coordinador_model->get_visitadores($usuario["idusuario"]);
          foreach ($result as $item) {
            $visitadores .= $item["idvisitador"].',';
          }
          $visitadores = substr($visitadores, 0, -1);
      }

      $tipo = $this->input->post('tipo');
      switch ($tipo) {
        case '1':
          $result = $this->Estadisticas_model->get_xatendio($visitadores);
          $response = array(
            "result" => $result[0]
          );
        break;
        case '2':
        // comentario

          $idcoordinador = $usuario["idusuario"];
          $result_pdocente = $this->Estadisticas_model->get_xtipopregunta($idcoordinador, TADOCENTE);
          $result_pdirecor = $this->Estadisticas_model->get_xtipopregunta($idcoordinador, TADIRECTOR);
          // echo "<pre>"; print_r($result); die();
          $arr_pdirector = $this->arma_xtipopregunta($result_pdirecor, 1);
          $arr_pdocente = $this->arma_xtipopregunta($result_pdocente, 2);
          $result = array(
            "result_pdocente" => $arr_pdocente,
            "result_pdirector" => $arr_pdirector
          );
          $response = array(
            "result" => $result
          );
          // echo "<pre>"; print_r($arr); die();
        break;
      }


      Utilerias::enviaDataJson(200, $response, $this);
      exit;
    }
  }// get_datos()

  function arma_xtipopregunta($arr_datos, $atendio){

    $result = $this->Aplicar_model->get_aplicadasxatendio($atendio); // Docente
    $total_aplicadas = $result[0]["total"];

    $idpregunta = 0;
    $arr_finalfinal = array();
    $arr_final = array();
    $array_aux = array();
    $arr_idp = array();
    foreach ($arr_datos as $item) {
      if( $idpregunta == $item["idpregunta"] ){
      }elseif ($idpregunta != $item["idpregunta"]) {
        $idpregunta = $item["idpregunta"];
        array_push($arr_idp, $item["idpregunta"]);
      }
    }

    for($i=0;$i<count($arr_idp); $i++) {
        $idpregunta = $arr_idp[$i];
        foreach ($arr_datos as $item) {
          $idpregunta2 = $item["idpregunta"];
          if($idpregunta==$idpregunta2){
            array_push($array_aux,$item);
          }
        }
        array_push($arr_final, $array_aux);
        $array_aux = array();
    }

    // Contamos Si y no
    $nsi = 0;
    $nno = 0;
    $arr_finalfinal = array();
    array_push($arr_finalfinal,  array());

    foreach ($arr_final as $item) {
      $arr_aux2 = array();
      $nsi = 0;
      $nno = 0;
      foreach ($item as $item_hijo) {
              if($item_hijo["respuesta"] == "no"){
                $nno++;
              }
              elseif ($item_hijo["respuesta"] == "si") {
                $nsi++;
              }
      }

        array_push($arr_aux2, $item[0]["pregunta"]);
        array_push($arr_aux2, (($nsi*100)/$total_aplicadas));
        array_push($arr_aux2, (($nno*100)/$total_aplicadas));

        array_push($arr_finalfinal, $arr_aux2);

    }

    $arr_return = array("datos" => $arr_finalfinal, "totalaplicadas"=>$total_aplicadas);

    return $arr_return;
  }// arma_xtipopregunta()


}
