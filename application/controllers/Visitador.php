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


        $usuario = $this->session->userdata[DATOSUSUARIO];
			  $result = $this->Visit_cct_model->get_asignadas($usuario["idusuario"]);

        $result2 = $this->Aplicar_model->get_visitadas($usuario["idusuario"]);
        $result3 = $this->Aplicar_model->get_total_visitadas($usuario["idusuario"]);


        // echo "<pre>"; print_r($result2[0]["asignadas"]); die();
        $data["asignadas"] = $result[0]["asignadas"];
        $data["visitadas"] = $result2[0]["visitadas"];
        $data["sin_visitar"] = $result[0]["asignadas"] - $result2[0]["visitadas"];
        $data["total_visitas"] = $result3[0]["total_visitadas"];
        $data["total_visitas"] = $result3[0]["total_visitadas"];
        Utilerias::pagina_basica($this, "visitador/index", $data);
      }
	}//

  function read(){
    if(Utilerias::verifica_sesion_redirige($this)){

      $usuario = $this->session->userdata[DATOSUSUARIO];
      $result = $this->Visit_cct_model->get_datos($usuario["idusuario"]);

      $arr_columnas = array("id","nvisitas","cct","nombre_ct","nombre_nivel","nombre_modalidad","domicilio");

      $response = array(
        "result" => $result,
        "columnas" => $arr_columnas
      );
      // echo "<pre>"; print_r($response); die();
      Utilerias::enviaDataJson(200, $response, $this);
      exit;
    }
  }// get_all()

  function get_cuestions(){
    if(Utilerias::verifica_sesion_redirige($this)){
      $tipo = $this->input->post('tipo');
      if($tipo == 2){
        $preguntas = $this->Visit_cct_model->get_cuestions($tipo);
      }elseif ($tipo == 1) {
        $preguntas = $this->Visit_cct_model->get_cuestions($tipo);
      }
      $response = array(
          "result" => $preguntas,
        );
      Utilerias::enviaDataJson(200, $response, $this);
      exit;
    }
  }


}
