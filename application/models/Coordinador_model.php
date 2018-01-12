<?php

class Coordinador_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_visitadores($idcoordinador){
      $str_query = " SELECT cv.idvisitador
                     FROM usuario us
                     INNER JOIN coord_visit cv ON cv.idcoordinador = us.idusuario
                     WHERE cv.idcoordinador = {$idcoordinador}";

      return $this->db->query($str_query)->result_array();
    }
}
