<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('Utilerias');
	}

	public function index()
	{
		$data["titulo"] = "index";
		$this->direcciona_user(3);
		// Utilerias::pagina_basica($this, "index", $data);
	}// index()

	function direcciona_user($tipo_usuario){
		switch ($tipo_usuario) {
			case UVISITADOR:
				# code...
				redirect('visitador/index');
				break;

			case UCOORDINADOR:
				# code...
				redirect('coordinador/index');
				break;

			case UADMINISTRADOR:
				# code...
				redirect('administrador/index');
				break;
			
			default:
				# code...
				$data = $this->data;
            	$data['login_failed'] = TRUE;
            	$this->load->view('login',$data); 
				break;
		}
	}

}// class
