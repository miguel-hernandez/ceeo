<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitador extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('Utilerias');
        $this->load->model('Visit_cct_model');
        $this->load->model('Aplicar_model');
    }


	public function index()
	{
      if(Utilerias::verifica_sesion_redirige($this)){
        $data["titulo"] = "VISITADOR";
        Utilerias::pagina_basica($this, "visitador/index", $data);
      }
	}//

  public function re_arma($array){
    $arr = array();
    foreach ($array as $item) {
      array_push($arr, $item);
    }
    return $arr;
  }

  function read(){
    if(Utilerias::verifica_sesion_redirige($this)){

      $usuario = $this->session->userdata[DATOSUSUARIO];
      $result = $this->Visit_cct_model->get_datos($usuario["idusuario"]);
      $result2 = $result;
      $arr_columnas = array("id","nvisitas","cct","nombre_ct","turno", "nombre_nivel","nombre_modalidad","domicilio");

      $array_aux = array();
      $array_pd = array();
      for($i=0;$i<count($result); $i++) {
          $item = $result[$i];
          $numero = 0;
          $cct = $item["cct"];
          for($j=0;$j<count($result2); $j++) {
            $item2 = $result2[$j];
            $cct2 = $item2["cct"];
            if($cct==$cct2){
              $numero = $numero+$item2["nvisitas"];
            }
          }
          $item["nvisitas"] = $numero;
         array_push($array_aux, $item);
      }

      $sin_duplicados = array_unique($array_aux, SORT_REGULAR);
      $result_final = $this->re_arma($sin_duplicados);

      $result = $this->Visit_cct_model->get_asignadas($usuario["idusuario"]);

      $result2 = $this->Aplicar_model->get_visitadas($usuario["idusuario"]);
      $result3 = $this->Aplicar_model->get_total_visitadas($usuario["idusuario"]);


      $data["asignadas"] = $result[0]["asignadas"];
      $data["visitadas"] = $result2[0]["visitadas"];
      $data["sin_visitar"] = $result[0]["asignadas"] - $result2[0]["visitadas"];
      $data["total_visitas"] = $result3[0]["total_visitadas"];
      $data["total_visitas"] = $result3[0]["total_visitadas"];

      $response = array(
        "result" => $result_final,
        "columnas" => $arr_columnas,
        "asignadas" => $result[0]["asignadas"],
        "visitadas" => $result2[0]["visitadas"],
        "sin_visitar" => $result[0]["asignadas"] - $result2[0]["visitadas"],
        "total_visitas" => $result3[0]["total_visitadas"],
        "total_visitas" => $result3[0]["total_visitadas"]

      );

      Utilerias::enviaDataJson(200, $response, $this);
      exit;
    }
  }// read()

  function reportevisitas(){
    if(Utilerias::verifica_sesion_redirige($this)){
      $idcct = $this->input->post('idcct');

      $arr_columnas = array("id", "folio","fecha","atendio");

      $usuario = $this->session->userdata[DATOSUSUARIO];
      $result = $this->Aplicar_model->get_datos_visitadas($idcct,$usuario["idusuario"]);

      $response = array(
        "result" => $result,
        "columnas" => $arr_columnas
      );

      Utilerias::enviaDataJson(200, $response, $this);
      exit;
    }
  }// read()

  function get_cuestions(){
    // echo "<pre>";
    // print_r($_POST);
    // die();
    if(Utilerias::verifica_sesion_redirige($this)){
      $tipo = $this->input->post('tipo');
      $idcct = $this->input->post('idcct');
      if($tipo == 2){
        $preguntas = $this->Visit_cct_model->get_cuestions($tipo);
      }elseif ($tipo == 1) {
        $preguntas = $this->Visit_cct_model->get_cuestions($tipo);
      }
      $response = array(
          "result" => $preguntas,
          "idcct" => $idcct,
          "atendio" => $tipo
        );
      Utilerias::enviaDataJson(200, $response, $this);
      exit;
    }
  }

  function savecuestionario(){
    // echo "<pre>";
    // print_r($_POST);
    // die();
    if(Utilerias::verifica_sesion_redirige($this)){
      $usuario = $this->session->userdata[DATOSUSUARIO];
      $atendio = $this->input->post('atendio');
      $idcct = $this->input->post('idcct');
    //   echo "<pre>";
    // print_r($usuario['idusuario']);
    // die();
    $idaplica = $this->Aplicar_model->insert_aplica($usuario['idusuario'], $idcct, $atendio);
    echo $idaplica; die();
    }
  }


}
