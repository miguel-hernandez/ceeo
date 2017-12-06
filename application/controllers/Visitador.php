<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitador extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('Utilerias');
        $this->load->model('Visit_cct_model');
    }


	public function index()
	{
      if(Utilerias::verifica_sesion_redirige($this)){
        $data["titulo"] = "VISITADOR";

        $usuario = $this->session->userdata[DATOSUSUARIO];
			  $result = $this->Visit_cct_model->get_asignadas($usuario["idusuario"]);
        // echo "<pre>"; print_r($result[0]["asignadas"]); die();
        $data["asignadas"] = $result[0]["asignadas"];
        $data["visitadas"] = 0;
        $data["sin_visitar"] = 0;
        $data["total_visitas"] = 0;
        Utilerias::pagina_basica($this, "visitador/index", $data);
      }
	}


}
