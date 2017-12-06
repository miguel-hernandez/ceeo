<?php

class Aplicar_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

     function get_visitadas($idvisitador)
     {
       $str_query = " SELECT COUNT(DISTINCT ap.idcct) AS visitadas
                      FROM aplicar ap
                      WHERE ap.idusuario = {$idvisitador}
          ";
          // echo $str_query; die();
       return $this->db->query($str_query)->result_array();
     }// get_visitadas()

     function get_total_visitadas($idvisitador)
     {
       $str_query = " SELECT COUNT(ap.idcct) AS total_visitadas
                      FROM aplicar ap
                      WHERE ap.idusuario = {$idvisitador}
          ";
          // echo $str_query; die();
       return $this->db->query($str_query)->result_array();
     }// get_visitadas()

}
