<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coordinador extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('Utilerias');
    }


	public function index()
	{
      if(Utilerias::verifica_sesion_redirige($this)){
        Utilerias::pagina_basica($this, "coordinador/index", $data);
      }
	}


}