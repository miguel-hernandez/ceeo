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

     function get_datos($idvisitador)
     {
       $str_query = " SELECT ct.idcct AS id, ct.cct, ct.nombre_ct, n.nombre_nivel, m.nombre_modalidad,
                      ct.domicilio,IF( ap.idcct IS NULL,0,1) AS nvisitas, t.nombre_turno AS turno
                      FROM visit_cct vc
                      INNER JOIN usuario us ON us.idusuario = vc.idvisitador
                      INNER JOIN cct ct ON ct.idcct = vc.idcct
                      INNER JOIN nivel n ON n.id_nivel = ct.idnivel
                      INNER JOIN modalidad m ON m.id_modalidad = ct.idmodalidad
                      INNER JOIN turno t ON t.id_turno = ct.idturno
                      LEFT JOIN aplicar ap ON ap.idcct = vc.idcct
                      WHERE vc.idvisitador = {$idvisitador}
          ";
          // echo $str_query; die();
       return $this->db->query($str_query)->result_array();
     }// get_asignadas()

}
