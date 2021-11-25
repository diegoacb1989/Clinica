<?php
  session_start();

  if(isset($_GET["cerrar_session"]) and $_GET["cerrar_session"]==true){
    session_destroy();
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Iniciar session</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="Recursos/css/bootstrap.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
 
  <!-- Ionicons -->
  <link rel="stylesheet" href="Recursos/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Recursos/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="Recursos/css/blue.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Ciudadano sano</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Autenticarse para inciar sesión</p>

    <form id="login-form" action="" method="post">
      <div class="form-group has-feedback">
        <input type="type" id="usuario" name="usuario" class="form-control" placeholder="Usuario">
        <span class="form-control-feedback"><i class="fas fa-user-tie"></i></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <span class="form-control-feedback"> <i class="fas fa-key"></i></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" id="ingresar" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
        <input type="hidden" value="login" name="accion">
      </div>
    </form>

   
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box  -->

<!-- Librearía para las funcionalidades de la tabla -->

<!-- ---------------------------------------------------------------------------------------- -->
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.2/sweetalert2.all.js"></script>
<script src="./Recursos/js/funcionesUsuario.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
  $(document).ready(usuario);
</script>


</body>
</html>
