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
</style>


<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12">
      <center><h2>Sistema de seguimiento CEEO</h2></center>
    </div>
  </div><!-- row -->
  <div class="row">
  	<div class="col-xs-6 col-sm-6 col-md-1 col-lg-1 pull-right">
        <?php echo form_open("Coordinador/index", array("id"=>"form_administrador_mostrar", "target"=>"_self")); ?>
          <input id="itxt_administrador_id_coordinador" name="itxt_administrador_id_coordinador" type="hidden">
          <button id="btn_administrador_mostrar" type="submit" class="btn btn-primary btn-block">
            <center>
              <img src="<?php echo base_url('assets/img/mostrar.svg'); ?>" alt="" class="img-responsive icono">
              Mostrar
            </center>
          </button>
        <?php echo form_close(); ?>
      </div><!-- col-md-1 -->
  </div>


  <div class="row margintop10">
    <div class="col-xs-12">
      <div id="grid_administrador"></div>
    </div>
  </div><!-- row -->
</div><!-- container-fluid -->
</div><!-- container-fluid -->
<script src="<?php echo base_url('assets/js/administrador/administrador.js'); ?>"></script>