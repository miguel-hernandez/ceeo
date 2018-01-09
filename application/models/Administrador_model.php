<?php

class Administrador_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_coordinadores(){
      $str_query = 'SELECT idusuario AS id, CONCAT(nombre, " ", paterno, " ", materno) AS nombre, email, ntelefono AS telefono FROM usuario 
                    WHERE idtipousuario = 2';

      return $this->db->query($str_query)->result_array();
    }
}