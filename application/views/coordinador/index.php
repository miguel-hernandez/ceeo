<style>
body{
  background-color: #F6F8F8;
}
.icono{
  width: 30px;
}
</style>
<input id="itxt_coordinador_id" name="itxt_coordinador_id" type="hidden"  value="<?= $id_coordinador; ?>">
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12">
      <center><h2>Sistema de seguimiento CEEO</h2></center>
    </div>
  </div><!-- row -->

  <div class="row margintop10">
    <div class="col-xs-0 col-sm-0 col-md-10 col-lg-10"></div>

      <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
        <?php echo form_open("Visitador/index", array("id"=>"form_coordinador_mostrar", "target"=>"_blank")); ?>
          <input id="itxt_coordinador_id_visitador" name="itxt_coordinador_id_visitador" type="hidden">
          <button id="btn_coordinador_mostrar" type="submit" class="btn btn-primary btn-block">
            <center>
              <img src="<?php echo base_url('assets/img/mostrar.svg'); ?>" alt="" class="img-responsive icono">
              Mostrar
            </center>
          </button>
        <?php echo form_close(); ?>
      </div><!-- col-md-1 -->

      <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
        <button id="btn_coordinador_estadisticas" type="button" class="btn btn-primary btn-block">
          <center>
            <img src="<?php echo base_url('assets/img/chart.svg'); ?>" alt="" class="img-responsive icono">
            Estadísticas
          </center>
        </button>
      </div><!-- col-md-1 -->
  </div><!-- row -->



  <div class="row margintop10">
    <div class="col-xs-12">
      <div id="grid_coordinador"></div>
    </div>
  </div><!-- row -->

</div><!-- container-fluid -->


<div class="modal" id="modal_estadisticas" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal_head">
        <button type="button" class="close bold_white" id="modal_estadisticas_btn_cerrar" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Registro</h4>
      </div>
      <div class="modal-body">

        <div class="row ">
            <div class='col-xs-8 col-xs-8 col-md-10 col-lg-10'>
              <!-- <label for="estadisticas_tipo">Seleccione</label> -->
              <select id="estadisticas_tipo" name="" class="form-control">
                <option value="0"> Seleccione </option>
                <option value="1"> Quién atendió </option>
                <option value="2">  Preguntas SI y NO </option>
              </select>
            </div>
            <div class='col-xs-4 col-xs-4 col-md-2 col-lg-2'>
              <button id="estadisticas_mostrar" name="" class="btn btn-primary btn-block">Mostrar</button>
            </div>
        </div>



        <div class="row margintop10">
            <div class='col-xs-12'>
              <div id="chart_div"></div>
            </div>
        </div>



      </div><!-- modal-body -->
    </div>
  </div>
</div><!-- modal_estadisticas -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="<?php echo base_url('assets\js\estadisticas\estadisticas.js'); ?>"></script>
<script src="<?php echo base_url('assets\js\coordinador\coordinador.js'); ?>"></script>
