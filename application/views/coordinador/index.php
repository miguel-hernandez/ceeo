<style>
body{
  background-color: #F6F8F8;
}
.icono{
  width: 30px;
}
</style>

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

<script src="<?php echo base_url('assets\js\coordinador\coordinador.js'); ?>"></script>
