<div class="container-fluid">
  <div class="row">
    <center>
      <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
        Asignadas<br><label id="visitador_asignadas"></label>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
        Visitadas<br><label id="visitador_visitadas"></label>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
        Sin visitar<br><label id="visitador_sinvisitar"></label>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
        Total visitas<br><label id="visitador_tvisitadas"></label>
      </div>

      <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
        <button id="btn_visitador_mostrar" type="button" class="btn btn-primary btn-block">Mostrar</button>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
        <button id="btn_visitador_registrar" type="button" class="btn btn-primary btn-block">Registrar</button>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
        <button id="" type="button" class="btn btn-primary btn-block">Ubicación</button>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
        <button id="" type="button" class="btn btn-primary btn-block">Indicadores</button>
      </div>
    </center>
  </div><!-- row -->

  <div class="row margintop10">
    <div class="col-xs-12">
      <div id="grid_visitador"></div>
    </div>
  </div><!-- row -->
</div><!-- container-fluid -->

<div class="modal" id="modal_visitador">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal_head">
        <button type="button" class="close bold_white" id="modal_visitador_btn_cerrar" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Registro</h4>
      </div>
      <div class="modal-body">

          <div class='col-xs-12'><center><label id="modal_visitador_nombrect"></label></center></div>
          <div class='col-xs-12'><label>Seleccione una seleccion de cuestionario</label></div>
          <label class='checkbox-inline'>
            <input type='radio' name='opciones' id='radio_director_visitador' onclick='obj_visitador.get_cuestions(1);' value='opcion_1'> Director
          </label>
          <label class='checkbox-inline'>
            <input type='radio' name='opciones' id='radio_docente_visitador' onclick='obj_visitador.get_cuestions(2);' value='opcion_2'> Docente
          </label>
          <input type="hidden" name="atendio" id="idcct" >
        <!-- </div> -->
        <div id= 'div_contenedor_preguntas'></div>

      </div><!-- modal-body -->
    </div>
  </div>
</div><!-- modal_visitador -->

<div id="modal_reportevisitas" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal_head">
        <button type="" id="modal_reportevisitas_btn_cerrar" class="close bold_white">&times;</button>
        <div id="modal_reportevisitas_title" class="text_bold">Reporte de visitas</div>
      </div>
      <div class="modal-body">

        <div class="row">
          <center>
          <label id="lbl_reportevisitas_nombrect"></label>
        </center>
        </div><!-- row -->

        <div class="row margintop10">
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <button id="" type="button" class="btn btn-primary btn-block">Editar</button>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <button id="" type="button" class="btn btn-primary btn-block">Imprimir</button>
          </div>
        </div><!-- row -->

        <div class="row margintop10">
          <div class="col-xs-12">
            <div id="grid_reportevisitas"></div>
          </div>
        </div><!-- row -->

      </div><!-- modal-body -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div> <!--  modal_reportevisitas -->

<script src="<?php echo base_url('assets/js/visitador/visitador.js'); ?>"></script>
<!-- <script src="<?php echo base_url(); ?>js/jquery.validate_vi.js"></script> -->
