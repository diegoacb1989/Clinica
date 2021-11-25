<?php 
session_start();
 class Session{
    function __construct($id,$nombres, $apellidos, $direccion, $telefono, $celular, $correo, $usuario, $contrasena,$rol,$estado) {
        $_SESSION['id_persona'] = $id;
        $_SESSION['nombres'] = $nombres;
        $_SESSION['apellidos'] = $apellidos;
        $_SESSION['direccion'] = $direccion;
        $_SESSION['telefono']= $telefono;
        $_SESSION['celular'] = $celular;
        $_SESSION['correo'] = $correo;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['contrasena'] = $contrasena;
        $_SESSION['rol'] = $rol;
        $_SESSION['estado'] = $estado;
    }
   function destruirSessiones(){
       session_destroy();
   }

   public static function validarSession($rol){
    session_start();
    if(isset($_SESSION['estado']) && $_SESSION['estado'] == "Activo"){

        
        if($_SESSION['rol'] == $rol){
      
        }else{
         ?>
          <script>
           swal({
            title: "Su rol no corresponde a esta cuenta",
            text: "Error de inicio de session",
            type: "error"
            }).then(function() {
            window.location="../../";
            });
          </script>
         <?php 
        } 
      
       }else{
        ?>
         <script>
          swal({
            title: "Inicia session primero y/o tu cuenta esta desactivada",
            text: "Error de inicio de session",
            type: "error"
            }).then(function() {
            window.location="../../index.php";
            });
         </script>
        <?php
       }

   }//VALIDAR SESSION

 }
?>