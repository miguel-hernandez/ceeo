<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitador extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('Utilerias');
    }


	public function index()
	{
      if(Utilerias::verifica_sesion_redirige($this)){
        Utilerias::pagina_basica($this, "visitador/index", $data);
      }
	}


}