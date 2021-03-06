
<?php $alert = (isset($datos_incorrectos) && $datos_incorrectos)?"":"hidden"?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> CEEO </title>

  <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.png'); ?>">
  <link href="<?php echo base_url('assets/bootstrap337/css/bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
  <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" media="screen">
  <link href="<?php echo base_url('assets/css/estilos-master.css'); ?>" rel="stylesheet" media="screen">

  <script src="<?php echo base_url('assets/jquery-3.2.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/jquery.validate.js'); ?>"></script>
  <script src="<?php echo base_url('assets/bootstrap337/js/bootstrap.min.js'); ?>"></script>

  <script type="text/javascript" src="<?php echo base_url("assets/js/login/login.js"); ?>"></script>

  <style>
  .div_white{
    background: #FFF;
    padding: 20px;
    border-radius: 8px;
    border: 2px solid #DDE4E5;
  }
  body{
    background-color: #F6F8F8;
  }
  </style>

</head>
<body>

  <div class="container">

    <div class="row">
      <br>
    </div><!-- row -->

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>

      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="div_white">
          <?php echo form_open('Login/validar_login', array("id"=>"form_login")); ?>
          <div class="row">
            <div class="col-xs-12">
              <?= $this->session->flashdata(MESSAGEREQUEST); ?>
              <img src="<?php echo base_url('assets/img/logosep.png'); ?>" alt="" class="img-responsive">
            </div>
          </div><!-- row -->

          <div class="row margintop10">
            <div class="col-xs-12">
              <i class="fa fa-user-o" aria-hidden="true"></i>
              <input id="" name="username" type="text" class="form-control" placeholder="usuario" autofocus>
            </div>
          </div><!-- row -->

          <div class="row margintop10">
            <div class="col-xs-12">
              <i class="fa fa-key" aria-hidden="true"></i>
              <input id="" name="clave" type="password" class="form-control" placeholder="contraseña">
            </div>
          </div><!-- row -->

          <div class="row margintop10">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
          </div><!-- row -->
          <?php echo form_close(); ?>
        </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
    </div><!-- row -->

  </div><!-- container -->

</body>
</html>
