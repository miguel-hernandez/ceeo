<style>
#grid_reportevisitas{
  background: #FFF;
}
body{
  background-color: #F6F8F8;
}
.icono{
  width: 30px;
}
.conteo{
  font-size: 20px;
  /*font-weight: bold;*/
}

</style>

<input id="itxt_visitador_id" name="itxt_visitador_id" type="hidden" value="<?= $id_visitador; ?>">
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12">
      <center><h2>Sistema de seguimiento CEEO</h2></center>
    </div>
  </div><!-- row -->
  <br>
  <br>
  <div class="row">
    <center>

        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
          <div class="conteo">Asignadas<br><span id="visitador_asignadas"></span></div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
          <div class="conteo">Visitadas<br><span id="visitador_visitadas"></span></div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
          <div class="conteo">Sin visitar<br><span id="visitador_sinvisitar"></span></div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
          <div class="conteo">Total visitas<br><span id="visitador_tvisitadas"></span></div>
        </div>



        <!-- pull-right -->
      <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
        <button id="btn_visitador_mostrar" type="button" class="btn btn-primary btn-block">
          <center>
            <img src="<?php echo base_url('assets/img/mostrar.svg'); ?>" alt="" class="img-responsive icono">
            Mostrar
          </center>
        </button>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
        <button id="btn_visitador_registrar" type="button" class="btn btn-primary btn-block">
          <center>
          <img src="<?php echo base_url('assets/img/registrar.svg'); ?>" alt="" class="img-responsive icono">
          Registrar
        </center>
        </button>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
        <button id="" type="button" class="btn btn-primary btn-block">
          <center>
            <img src="<?php echo base_url('assets/img/ubicacion.svg'); ?>" alt="" class="img-responsive icono">
            Ubicación
         </center>
      </button>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
        <!-- <button id="" type="button" class="btn btn-primary btn-block">Indicadores</button> -->
        <button id="" type="button" class="btn btn-primary btn-block">
          <center>
            <img src="<?php echo base_url('assets/img/indicadores.svg'); ?>" alt="" class="img-responsive icono">
            Indicadores
         </center>
      </button>
      </div>
    </center>
  </div><!-- row -->

  <div class="row margintop10">
    <div class="col-xs-12">
      <div id="grid_visitador"></div>
    </div>
  </div><!-- row -->
</div><!-- container-fluid -->

<div class="modal" id="modal_visitador" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
            <input type='radio' name='opciones' id='radio_director_visitador' onclick='obj_visitador.get_cuestions(1, "nuevo", "div_contenedor_preguntas");' value='opcion_1'> Director
          </label>
          <label class='checkbox-inline'>
            <input type='radio' name='opciones' id='radio_docente_visitador' onclick='obj_visitador.get_cuestions(2, "nuevo", "div_contenedor_preguntas");' value='opcion_2'> Docente
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
            <button id="btn_visitador_editar_encuesta" type="button" class="btn btn-primary btn-block">
              <center>
                <img src="<?php echo base_url('assets/img/editar.svg'); ?>" alt="" class="img-responsive icono">
                Editar
              </center>
            </button>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <!-- <button id="" type="button" class="btn btn-primary btn-block"></button> -->
            <button id="btn_visitador_imprimir" type="button" class="btn btn-primary btn-block">
              <center>
                <img src="<?php echo base_url('assets/img/imprimir.svg'); ?>" alt="" class="img-responsive icono">
                Imprimir
              </center>
            </button>
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

<div class="modal" id="modal_visitador_editar" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal_head">
        <button type="button" class="close bold_white" id="modal_visitador_editar_btn_cerrar" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Actualiza Registro</h4>
      </div>
      <div class="modal-body">

          <div class='col-xs-12'><center><label id="modal_visitador_editar_nombrect"></label></center></div>
          <div class='col-xs-12' id="contenedor_check_update"></div>
          <label class='checkbox-inline'>
            <input type='radio' name='opciones' id='radio_director_visitador_editar' value='opcion_1' disabled> Director
          </label>
          <label class='checkbox-inline'>
            <input type='radio' name='opciones' id='radio_docente_visitador_editar'  value='opcion_2' disabled> Docente
          </label>
          <input type="hidden" name="atendio" id="idcct" >
        <!-- </div> -->
        <div id= 'div_contenedor_preguntas_editar'></div>

      </div><!-- modal-body -->
    </div>
  </div>
</div><!-- modal_visitador_editar -->

<script src="<?php echo base_url('assets/js/visitador/visitador.js'); ?>"></script>
<!-- <script src="<?php echo base_url(); ?>js/jquery.validate_vi.js"></script> -->
