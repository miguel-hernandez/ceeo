<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('DATOSUSUARIO', "datos_usuario_ceeo");

define('UVISITADOR', 1);
define('UCOORDINADOR', 2);
define('UADMINISTRADOR', 3);

class Utilerias{
		public function __construct() {
	        //  require_once APPPATH.'third_party/Utils.php';
	    }

	    /**
     * Carga la vista básica de una página: header, vista y footer.
     *
     * @param CONTROLLER $contexto   Desde dónde se llamará a la vista
     * @param VISTA $vista      El nombre de la vista que se cargará después del header
     * @param DATA  $data       Arreglo con los campos que usará templates/header y $vista
     */
	    public static function pagina_basica($contexto, $vista = '', $data) {
	        $contexto->load->view('templates/header',$data);
	        $contexto->load->view($vista, $data);
	        $contexto->load->view('templates/footer');
	    }// pagina_basica()

			/*
	    Función para retornar datos a peticiones ajax
	     */
	    public static function enviaDataJson($status, $data, $contexto){
	        return $contexto->output
	                    ->set_status_header($status)
	                    ->set_content_type('application/json', 'utf-8')
	                    ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
	                    ->_display();
	    }// enviaDataJson()


			/**
	     * Comprueba si en la sesión existe valor para la clave 'nombre_usuario'
	     * @param CI_Controller $contexto  Controlador en donde se desea verificar si existe sesión abierta.
	     * @return boolean TRUE si existe valor para la clave 'nombre_usuario'
	     */
	    public static function is_session_open($contexto) {
	        return $contexto->session->has_userdata(DATOSUSUARIO);
	    }// is_session_open()

			public static function verifica_sesion_redirige($contexto) {
	        if (!Utilerias::is_session_open($contexto)) {
	            redirect('login');
	        }
	        return true;
	    }// verifica_sesion_redirige()

	}
?>
