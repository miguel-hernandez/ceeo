<?php

class Estadisticas_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

     function get_xatendio()
     {
       $str_query = " SELECT
                      SUM(CASE  WHEN atendio=1 THEN 1 ELSE 0 END) AS 'tdirectores',
                      SUM(CASE  WHEN atendio=2 THEN 1 ELSE 0 END) AS 'tdocentes',
                      count(atendio) AS total
                      FROM aplicar ap
                      WHERE ap.idusuario IN (1,2)
                      ";
          // echo $str_query; die();
       return $this->db->query($str_query)->result_array();
     }// get_xatendio()


}
