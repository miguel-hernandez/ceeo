<?php if (!isset($titulo)) $titulo = ''; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> CEEO [<?= $titulo ?>] </title>

  <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.png'); ?>">

  <link href="<?php echo base_url('assets/bootstrap337/css/bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
  <link href="<?php echo base_url('assets/sweetalert2/sweetalert2.min.css'); ?>" rel="stylesheet" media="screen">
  <link href="<?php echo base_url('assets/css/estilos-master.css'); ?>" rel="stylesheet" media="screen">
  <link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" media="screen">
  <link href="<?php echo base_url('assets/css/header.css'); ?>" rel="stylesheet" media="screen">


  <script src="<?php echo base_url('assets/jquery-3.2.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/jquery.validate.js'); ?>"></script>
  <script src="<?php echo base_url('assets/bootstrap337/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/sweetalert2/sweetalert2.min.js'); ?>"></script>

  <script src="<?php echo base_url('assets/js/utils/messages.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/utils/design.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/utils/tablejs/table.js'); ?>"></script>


  <script type="text/javascript">
    $(document).ready(function () {
      base_url = live_url = "<?php echo base_url(); ?>";
      base_url = base_url+"index.php/";
    });
  </script>

</head>



<body>
  <!-- Header Logo -->
  <div class="headerlogo">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <h4>CEEO</h4>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="pull-right">
              <img src="" alt="">
            </div>
        </div>
      </div><!-- row -->
    </div>
  </div>
  <!-- Header Logo END -->
  <!-- NAVBAR -->
  <nav class="navbar">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#NavComponents" aria-expanded="false">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <div class="collapse navbar-collapse navbar_master" id="NavComponents">
        <!-- Navbar Links -->
        <ul class="nav navbar-nav navbar-left">

          <li class="dropdown">
            <a href="<?php echo site_url(''); ?>"  aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle-o"></i>INICIO</a>
          </li>

          <li>
            <a href="<?php echo site_url(''); ?>" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-television"></i> Consultas y Registros </a>
          </li>
          <li>
            <a href="<?php echo site_url(''); ?>" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-power-off"></i> Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- NAVBAR END -->