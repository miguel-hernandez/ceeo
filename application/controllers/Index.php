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
		Utilerias::pagina_basica($this, "index", $data);
	}// index()

	function direcciona_user($tipo_usuario){
		switch ($tipo_usuario) {
			case :''
				# code...
				redirect('visitador/index');
				break;

			case '2':
				# code...
				redirect('coordinador/index');
				break;

			case '3':
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
