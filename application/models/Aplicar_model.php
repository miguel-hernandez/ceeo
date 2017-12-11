<?php

class Aplicar_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set(ZONAHORARIA);
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

     function get_datos_visitadas($idcct,$idvisitador)
     {
       $str_query = " SELECT ap.idaplicar AS id, ap.idaplicar AS folio, ap.fcreacion AS fecha,
       CASE ap.atendio
       WHEN 1 THEN 'DOCENTE'
       WHEN 2 THEN 'DIRECTOR'
       END atendio
                      FROM aplicar ap
                      WHERE ap.idcct = {$idcct} AND  ap.idusuario = {$idvisitador}
          ";
          // echo $str_query; die();
       return $this->db->query($str_query)->result_array();
     }// get_visitadas()

     function insert_aplica($idusuario, $idcct, $atendio){

      $fecha = date("Y-m-d H:i:s");
      $data = array(
        'idusuario' => $idusuario,
        'idcct' => $idcct,
        'fcreacion' => $fecha,
        'atendio' => $atendio
      );

      $this->db->insert('aplicar', $data);
      $id = $this->db->insert_id();
      return $id;
     }

     function get_pdf_encuesta($idaplicar){
           $str_query = " SELECT ap.idaplicar AS folio, ap.fcreacion AS fecha,
                                 CASE ap.atendio
                                 WHEN 1 THEN 'DOCENTE'
                                 WHEN 2 THEN 'DIRECTOR'
                                 END atendio
                                 ,ct.cct
                                 ,ct.nombre_ct
                                 ,ct.domicilio
                                 ,mo.nombre_modalidad
                                 ,tu.nombre_turno
                                 ,pre.pregunta, pre.idtipopregunta
                                 ,re.respuesta AS respuesta, re.complemento AS complemento_respuesta
                          FROM aplicar ap
                          INNER JOIN cct ct ON ct.idcct = ap.idcct
                          INNER JOIN turno tu ON tu.id_turno = ct.idturno
                          INNER JOIN modalidad mo ON mo.id_modalidad = ct.idmodalidad
                          LEFT JOIN respuesta re ON re.idaplicar = ap.idaplicar
                          LEFT JOIN pregunta pre ON pre.idpregunta = re.idpregunta
                          WHERE  ap.idaplicar = {$idaplicar}
              ";
          return $this->db->query($str_query)->result_array();
     }// get_pdf_encuesta()
}
