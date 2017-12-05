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
<center>HEADER</center>
