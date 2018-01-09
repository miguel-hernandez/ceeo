<?php

class Coord_visit_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


     function get_visitadores($idcoordinador)
     {
       $str_query = " SELECT cv.idvisitador AS id, CONCAT_WS(' ', us.nombre, us.paterno, us.materno) AS nombre_completo
                      FROM coord_visit cv
                      INNER JOIN usuario us ON cv.idvisitador = us.idusuario
                      WHERE cv.idcoordinador = {$idcoordinador}
                    ";
       return $this->db->query($str_query)->result_array();
     }// get_asignadas()


}// Coord_visit_model
