<?php

class Visit_cct_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

     function get_asignadas($idvisitador)
     {
       $str_query = "SELECT COUNT(*) AS asignadas
                      FROM visit_cct vc
                      WHERE vc.idvisitador = {$idvisitador}
          ";
          // echo $str_query; die();
       return $this->db->query($str_query)->result_array();
     }// get_asignadas()


}
