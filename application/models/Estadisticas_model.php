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

     function get_xtipopregunta($idcoordinador)
     {
      // Tipo de pregunta 1 es SI o NO
       $str_query = " SELECT a.idaplicar, a.atendio, r.idpregunta, r.respuesta, cv.idvisitador, p.pregunta, p.npregunta, IF(a.atendio='1', 'DIRECTOR', 'DOCENTE') AS atendio
                      FROM coord_visit cv
                      INNER JOIN aplicar a ON a.idusuario = cv.idvisitador
                      INNER JOIN respuesta r ON r.idaplicar = a.idaplicar
                      INNER JOIN pregunta p ON p.idpregunta = r.idpregunta
                      WHERE cv.idcoordinador = {$idcoordinador} AND p.idtipopregunta=1
                      ORDER BY p.idpregunta
                      ";
          // echo $str_query; die();
       return $this->db->query($str_query)->result_array();
     }// get_xtipopregunta()


}
