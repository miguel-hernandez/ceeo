<div class="container-fluid">
  <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
      <center>
        Asignadas <br><?= $asignadas ?>
      </center>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
      <center>
        Visitadas <br><?= $visitadas ?>
      </center>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
      <center>
        Sin visitar <br><?= $sin_visitar ?>
      </center>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
      <center>
        Total visitas <br><?= $total_visitas ?>
      </center>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
      <button id="btn_visitador_mostrar" type="button" class="btn btn-primary btn-block">Mostrar</button>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
      <button id="" type="button" class="btn btn-primary btn-block">Registrar</button>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
      <button id="" type="button" class="btn btn-primary btn-block">Ubicación</button>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-1 col-lg-1">
      <button id="" type="button" class="btn btn-primary btn-block">Indicadores</button>
    </div>

  </div><!-- row -->

  <div class="row margintop10">
    <div class="col-xs-12">
      <div id="grid_visitador"></div>
    </div>
  </div><!-- row -->
</div>

<script src="<?php echo base_url('assets/js/visitador/visitador.js'); ?>"></script>
