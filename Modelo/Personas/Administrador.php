
<?php
  include_once "Persona.php"; 
 class Administrador extends Persona{

   //ESTA CLASE SE DIFERENCIA DE LAS OTRAS POR SUS METODOS. QUE SERIAN LAS FUNCIONES DEL ADMINISTRADOR  
   function __construct($id,$nombres, $apellidos, $direccion, $telefono, $celular, $correo, $usuario, $contrasena,$rol,$estado) {
    parent::__construct($id,$nombres, $apellidos, $direccion, $telefono, $celular, $correo, $usuario, $contrasena,$rol,$estado);
   }
    
   function listar($rol){
    $this->query = "SELECT id_persona,nombres,apellidos,direccion,telefono,celular,correo,usuario FROM personas WHERE estado = 'Activo' AND rol='$rol'";
    $this->query_preparada_retorna_valores();
    return $this->rows;
   }

   function elimilar(){
     $id = $this->idPersona;
    $this->query = "UPDATE personas SET `estado`='Desactivado' WHERE `id_persona` = '$id'";
    return $this->query_no_retorna_valores();
   }

   //METODOS O FUNCIONES DEL ADMINISTRADOR DENTRO DEL SISTEMA
     
 }

?>