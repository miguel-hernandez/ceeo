
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
  .thumbnail {
    /*background: #EF3B3A;*/
    background: #FFF;
    width: 150px;
    height: 150px;
    margin: 0 auto 30px;
    padding: 50px 30px;
    border-top-left-radius: 100%;
    border-top-right-radius: 100%;
    border-bottom-left-radius: 100%;
    border-bottom-right-radius: 100%;
    box-sizing: border-box;
  }
  .form .thumbnail img {
    display: block;
    width: 100%;
  }

  .div_gray{
    background: #f6f6f6;
    padding: 20px;
  }
  </style>

</head>
<body>

  <div class="container">
    <div class="row">
      <br>
    </div>

    <div class="row">
      <div class="col-xs-4"></div>
      <div class="col-xs-4 div_gray">
        <?= $this->session->flashdata(MESSAGEREQUEST); ?>
        <?php echo form_open('Login/validar_login', array("id"=>"form_login")); ?>


        <div class="row">
          <div class="col-xs-12 margin_top_7">
            <div class="thumbnail"><img src="<?php echo base_url('assets/img/ke_logo.jpg'); ?>" alt=""> </div>
          </div>
        </div><!-- row -->

          <div class="row">
            <div class="col-xs-12 margin_top_7">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user-o" aria-hidden="true"></i>
                </span>
                <input id="" name="username" type="text" class="form-control" placeholder="usuario">
              </div>
            </div>
          </div><!-- row -->

          <div class="row">
            <div class="col-xs-12 margin_top_7">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-key" aria-hidden="true"></i>
                </span>
                <input id="" name="clave" type="password" class="form-control" placeholder="clave">
              </div>
            </div>
          </div><!-- row -->

          <div class="row">
            <div class="col-xs-12 margin_top_7">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
          </div><!-- row -->

        <?php echo form_close(); ?>
      </div>
      <div class="col-xs-4"></div>

    </div><!-- row -->

</div> <!-- container -->

</body>
</html>
