<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadisticas extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('Utilerias');
        $this->load->helper('form');
        $this->load->model('Estadisticas_model');
        $this->load->model('Aplicar_model');
    }




    function get_datos(){
    if(Utilerias::verifica_sesion_redirige($this)){

      // $usuario = $this->session->userdata[DATOSUSUARIO];
      $tipo = $this->input->post('tipo');
      switch ($tipo) {
        case '1':
          $result = $this->Estadisticas_model->get_xatendio();
          $response = array(
            "result" => $result[0]
          );
        break;
        case '2':
        // comentario
          $usuario = $this->session->userdata[DATOSUSUARIO];
          $idcoordinador = $usuario["idusuario"];
          $result = $this->Estadisticas_model->get_xtipopregunta($idcoordinador);
          // echo "<pre>"; print_r($result); die();
          $arr = $this->arma_xtipopregunta($result);
          $response = array(
            "result" => $arr
          );
          // echo "<pre>"; print_r($arr); die();
        break;
      }


      Utilerias::enviaDataJson(200, $response, $this);
      exit;
    }
  }// get_datos()

  function arma_xtipopregunta($arr_datos){

    $result = $this->Aplicar_model->get_aplicadasxatendio();
    $total_aplicadas = $result[0]["total"];

    $idpregunta = 0;
    $arr_finalfinal = array();

    $arr_final = array();
    $arr_aux = array();
    // echo "<pre>"; print_r($arr_datos); die();
    foreach ($arr_datos as $item) {

      // echo "<pre>"; print_r($item);
      // echo "\n";
      // echo $idpregunta;
      // echo "\n";
      // echo $item["idpregunta"];
      // echo "\n";
      // echo "\n";
      if( $idpregunta != $item["idpregunta"] ){
        $idpregunta = $item["idpregunta"];
        // echo "\n diferente  ";
        array_push($arr_final,$arr_aux);
        $arr_aux = array();
        array_push($arr_aux,$item);

      }elseif ($idpregunta === $item["idpregunta"]) {
        // echo "igual  ";
        array_push($arr_aux,$item);
        // $idpregunta = $item["idpregunta"];
      }

    }


    // echo "<pre>"; print_r($arr_final); die();

    // Contamos Si y no
    $nsi = 0;
    $nno = 0;
    $arr_finalfinal = array();
    array_push($arr_finalfinal,  array());
    // LA posición 0 tiene un array vacío

    unset($arr_final[0]);
    // echo "<pre>"; print_r($arr_final); die();

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
      // Armamos el array final
      /*
      $arr_aux2 = array(
                        // "idpregunta"=>$item[0]["idpregunta"],
                        // "npregunta"=>$item[0]["npregunta"],
                        "pregunta"=>$item[0]["pregunta"],
                        "nsi"=>$nsi,
                        "nno"=>$nno
                        );
                        */


        array_push($arr_aux2, $item[0]["pregunta"]);
        array_push($arr_aux2, (($nsi*100)/$total_aplicadas));
        array_push($arr_aux2, (($nno*100)/$total_aplicadas));

        // $arr_aux2 =  (array)$arr_aux2;
        array_push($arr_finalfinal, $arr_aux2);

    }



    $arr_return = array("datos" => $arr_finalfinal, "totalaplicadas"=>$total_aplicadas);

    return $arr_return;

    // echo "<pre>"; print_r($arr_finalfinal); die();
    //
    //
    // $total_preguntas = count($arr_finalfinal);
    // // echo $total_preguntas; die();
    // $cien_porciento = $total_aplicadas*$total_preguntas;
    // // echo "<pre>"; print_r($result[0]["total"]); die();
    // echo $cien_porciento; die();
    // echo "<pre>"; print_r($arr_finalfinal); die();
    //
  }// arma_xtipopregunta()


}
