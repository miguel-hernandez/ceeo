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
</div>


<div id="modal_reportevisitas" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal_head">
        <button type="" id="modal_reportevisitas_btn_cerrar" class="close bold_white">&times;</button>
        <div id="modal_reportevisitas_title" class="text_bold">Reporte de visitas</div>
      </div>
      <div class="modal-body">

        <div class="row">
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
</div> <!--  modal -->

<script src="<?php echo base_url('assets/js/visitador/visitador.js'); ?>"></script>
