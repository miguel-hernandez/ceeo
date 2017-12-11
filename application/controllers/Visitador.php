<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitador extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->library('Utilerias');
        $this->load->model('Visit_cct_model');
        $this->load->model('Aplicar_model');
        $this->load->model('Respuestas_model');
        $this->load->library('My_FPDF');

    }


	public function index()
	{
      if(Utilerias::verifica_sesion_redirige($this)){
        $data["titulo"] = "VISITADOR";
        $usuario = $this->session->userdata[DATOSUSUARIO];
        // echo "<pre>"; print_r($usuario); die();
        switch ($usuario["idtipousuario"]) {
          case UVISITADOR:
            $tipo = "VISITADOR: ";
          break;
          case UCOORDINADOR:
            $tipo = "COORDINADOR: ";
          break;
          case UADMINISTRADOR:
            $tipo = "ADMINISTRADOR: ";
          break;
        }
        // $tipo =
        $data["usuario"] = $tipo.$usuario["nombre"]." ".$usuario["paterno"]." ".$usuario["materno"];



        Utilerias::pagina_basica($this, "visitador/index", $data);
      }
	}//

  public function re_arma($array){
    $arr = array();
    foreach ($array as $item) {
      array_push($arr, $item);
    }
    return $arr;
  }

  function read(){
    if(Utilerias::verifica_sesion_redirige($this)){

      $usuario = $this->session->userdata[DATOSUSUARIO];
      $result = $this->Visit_cct_model->get_datos($usuario["idusuario"]);
      $result2 = $result;
      // $arr_columnas = array("id","nvisitas","cct","nombre_ct","turno", "nombre_nivel","nombre_modalidad","domicilio");
      $arr_columnas = array(
       "id"=>array("type"=>"hidden", "header"=>"id"),
       "nvisitas"=>array("type"=>"text", "header"=>"No. visitas"),
       "cct"=>array("type"=>"text", "header"=>"CCT"),
       "nombre_ct"=>array("type"=>"text", "header"=>"Nombre"),
       "nombre_nivel"=>array("type"=>"text", "header"=>"Nivel"),
       "nombre_modalidad"=>array("type"=>"text", "header"=>"Modalidad"),
       "domicilio"=>array("type"=>"text", "header"=>"Domicilio")
     );

      $array_aux = array();
      $array_pd = array();
      for($i=0;$i<count($result); $i++) {
          $item = $result[$i];
          $numero = 0;
          $cct = $item["cct"];
          for($j=0;$j<count($result2); $j++) {
            $item2 = $result2[$j];
            $cct2 = $item2["cct"];
            if($cct==$cct2){
              $numero = $numero+$item2["nvisitas"];
            }
          }
          $item["nvisitas"] = $numero;
         array_push($array_aux, $item);
      }

      $sin_duplicados = array_unique($array_aux, SORT_REGULAR);
      $result_final = $this->re_arma($sin_duplicados);

      $result = $this->Visit_cct_model->get_asignadas($usuario["idusuario"]);

      $result2 = $this->Aplicar_model->get_visitadas($usuario["idusuario"]);
      $result3 = $this->Aplicar_model->get_total_visitadas($usuario["idusuario"]);


      $data["asignadas"] = $result[0]["asignadas"];
      $data["visitadas"] = $result2[0]["visitadas"];
      $data["sin_visitar"] = $result[0]["asignadas"] - $result2[0]["visitadas"];
      $data["total_visitas"] = $result3[0]["total_visitadas"];
      $data["total_visitas"] = $result3[0]["total_visitadas"];

      $response = array(
        "result" => $result_final,
        "columnas" => $arr_columnas,
        "asignadas" => $result[0]["asignadas"],
        "visitadas" => $result2[0]["visitadas"],
        "sin_visitar" => $result[0]["asignadas"] - $result2[0]["visitadas"],
        "total_visitas" => $result3[0]["total_visitadas"],
        "total_visitas" => $result3[0]["total_visitadas"]

      );

      Utilerias::enviaDataJson(200, $response, $this);
      exit;
    }
  }// read()

  function reportevisitas(){
    if(Utilerias::verifica_sesion_redirige($this)){
      $idcct = $this->input->post('idcct');

      // $arr_columnas = array("id", "folio","fecha","atendio");
      $arr_columnas = array(
         "id"=>array("type"=>"hidden", "header"=>"id"),
         "folio"=>array("type"=>"text", "header"=>"Folio"),
         "fecha"=>array("type"=>"text", "header"=>"Fecha"),
         "atendio"=>array("type"=>"text", "header"=>"Atendió")
       );

      $usuario = $this->session->userdata[DATOSUSUARIO];
      $result = $this->Aplicar_model->get_datos_visitadas($idcct,$usuario["idusuario"]);

      $response = array(
        "result" => $result,
        "columnas" => $arr_columnas
      );

      Utilerias::enviaDataJson(200, $response, $this);
      exit;
    }
  }// read()

  function get_cuestions(){
    // echo "<pre>";
    // print_r($_POST);
    // die();
    if(Utilerias::verifica_sesion_redirige($this)){
      $tipo = $this->input->post('tipo');
      $idcct = $this->input->post('idcct');
      if($tipo == 2){
        $preguntas = $this->Visit_cct_model->get_cuestions($tipo);
      }elseif ($tipo == 1) {
        $preguntas = $this->Visit_cct_model->get_cuestions($tipo);
      }
      $response = array(
          "result" => $preguntas,
          "idcct" => $idcct,
          "atendio" => $tipo
        );
      Utilerias::enviaDataJson(200, $response, $this);
      exit;
    }
  }

  function savecuestionario(){
    if(Utilerias::verifica_sesion_redirige($this)){
      $usuario = $this->session->userdata[DATOSUSUARIO];
      $atendio = $this->input->post('atendio');
      $idcct = $this->input->post('idcct');
    $idaplica = $this->Aplicar_model->insert_aplica($usuario['idusuario'], $idcct, $atendio);
    foreach ($_POST as $key => $value) {
      if($key != 'atendio' && $key != 'idcct'){
        $porciones = explode("-", $key);
        $idpregunta = $porciones[0];
        $tipopregunta = $porciones[1];
        $inserto = $this->Respuestas_model->insert_response($idpregunta, $value, $idaplica, $tipopregunta);
      }
    }
    redirect('login/index');
    }
  }

  function get_pdf_encuesta(){
    if(Utilerias::verifica_sesion_redirige($this)){
      $idaplicar = $this->input->post('idaplicar');
      // echo $idaplicar; die();
      $obj_pdf = new FPDF; // Creación de la instancia

      $result = $this->Aplicar_model->get_pdf_encuesta($idaplicar);

      /*
      [folio] => 7
      [fecha] => 2017-12-07 17:16:34
      [atendio] => DIRECTOR
      [cct] => 21DAI0002Y
      [nombre_ct] => LICENCIADO BENITO JUAREZ
      [domicilio] => Domiclio 21DAI0002Y
      [nombre_modalidad] => INDIGENA
      [nombre_turno] => MATUTINO
      [pregunta] => Años de servicio
      [idtipopregunta] => 2
      [respuesta] =>
      [complemento_respuesta] => 3
      */
      echo "<pre>"; print_r($result); die();

      $obj_pdf->AddPage();
      // $obj_pdf->SetFont('Arial','B',16);
      // Logo
      $obj_pdf->Image(base_url().'assets/img/logosep.png',10,8,33);
      // Arial bold 15
      $obj_pdf->SetFont('Arial','B',15);
      // Movernos a la derecha
      $obj_pdf->Cell(80);
      // Título
      $obj_pdf->Cell(20,10,'Sistema de seguimiento CEEO',0,1,'C');
      $obj_pdf->Image(base_url().'assets/img/escudo_puebla.png',180,8,15);

      // Salto de línea
      $obj_pdf->Ln(10);

      // Datos de la escuela
      $datos = $result[0];

      $obj_pdf->SetFont('Arial','B',12);
      $obj_pdf->Cell(40,10, utf8_decode('Atendió: '.$datos['atendio']));
      // $obj_pdf->MultiCell(50,10,utf8_decode("Atendió: ".$datos["atendio"]),1,"L");
      $obj_pdf->Cell(40);
      $obj_pdf->Cell(20,10,'Folio: '.$datos["folio"],0,0,'C');
      // $obj_pdf->MultiCell(50,10,utf8_decode("Folio: ".$datos["folio"]),1,"C");
       // $obj_pdf->Cell(40);
       // $obj_pdf->MultiCell(0,5,$datos["pregunta"],0);
      // $obj_pdf->Cell(20,10,utf8_decode('Fecha: '.$datos['fecha']), 10,8,15);
      // $obj_pdf->Cell(0,0,'fecha: '.$datos["fecha"]);
      $obj_pdf->MultiCell(0,10,utf8_decode("Fecha: ".$datos["fecha"]),0,"R");

      // $obj_pdf->SetXY(30.2,30);
      // $obj_pdf->Text("texto de prueba");




      $obj_pdf->Ln(7);
      $obj_pdf->Cell(40,10, utf8_decode('Datos CCT: '.$datos['cct']." / " . $datos['nombre_turno'] .",     ". $datos['nombre_ct']. " (".$datos['domicilio'].")"));
      // $obj_pdf->Cell(40,10, utf8_decode(''.$datos['nombre_ct']));
      // $obj_pdf->Cell(10);




      // $obj_pdf->Cell(40,10, utf8_decode('Fecha: '.$datos['fecha']));
      $obj_pdf->SetFont('Arial','',12);
      $obj_pdf->Ln(15);
      foreach ($result as $item) {
        $obj_pdf->SetTextColor(0,0,0);
        switch ($item["idtipopregunta"]) {
          case 1:
          // $obj_pdf->Ln(5);
          $obj_pdf->SetFont('Arial','B',12);
          $obj_pdf->MultiCell(0,5,utf8_decode($item["npregunta"].".- ".$item["pregunta"]),0);
          $obj_pdf->SetTextColor(6,107,164);
          $obj_pdf->Ln(1);
          // $obj_pdf->Cell(0,10,utf8_decode("   ".$item["respuesta"]));
          $obj_pdf->MultiCell(0,10,utf8_decode("   ".$item["respuesta"]),0);

          break;
          case 2:

          // $obj_pdf->Ln(5);
          $obj_pdf->SetFont('Arial','B',12);
          $obj_pdf->MultiCell(0,5,utf8_decode($item["npregunta"].".- ".$item["pregunta"]),0);
          $obj_pdf->SetTextColor(6,107,164);
          $obj_pdf->Ln(1);
          $obj_pdf->MultiCell(0,10,utf8_decode("   ".$item["complemento_respuesta"]),0);

          break;
          case 3:

          // $obj_pdf->Ln(5);
          $obj_pdf->SetFont('Arial','B',12);
          $obj_pdf->MultiCell(0,5,utf8_decode($item["npregunta"].".- ".$item["pregunta"]),0);
          $obj_pdf->SetTextColor(6,107,164);
          $obj_pdf->Ln(2);
          // $obj_pdf->Cell(40,10,utf8_decode("   ".$item["respuesta"]));
          $obj_pdf->MultiCell(0,10,utf8_decode("   ".$item["respuesta"].", ".$item["complemento_respuesta"]),0);
          // $obj_pdf->Ln(1);
          // $obj_pdf->MultiCell(0,5,utf8_decode("   ".$item["complemento_respuesta"]),0);

          break;
        }
        $obj_pdf->Ln(5);
      }
      $obj_pdf->Output();

    }
  }// get_pdf_encuesta()


}
