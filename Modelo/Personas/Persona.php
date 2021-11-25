
<?php

 include_once "../../Modelo/ModeloBaseDatos.php";

class Persona extends ModeloBaseDatos{

protected $idPersona;
protected $nombres;
protected $apellidos;
protected $direccion;
protected $telefono;
protected $celular;
protected $correo;
protected $usuario;
protected $contrasena;  
protected $estado;
protected $rol;
protected $validaciones = array();

function __construct($id,$nombres, $apellidos, $direccion, $telefono, $celular, $correo, $usuario, $contrasena,$rol,$estado) {
    $this->idPersona = $id;
    $this->nombres = $nombres;
    $this->apellidos = $apellidos;
    $this->direccion = $direccion;
    $this->telefono = $telefono;
    $this->celular = $celular;
    $this->correo = $correo;
    $this->usuario = $usuario;
    $this->contrasena = $contrasena;
    $this->rol = $rol;
    $this->estado = $estado;
}



 function consultar()
{
  
    $usuario = $this->usuario;
    $password = $this->contrasena;
    $this->query = "SELECT * FROM personas WHERE usuario = '$usuario' AND contrasena = '$password' ";  
    $this->query_preparada_retorna_valores();
    return $this->rows;
  
}

function consultarUsuario(){
  $id = $this->idPersona;
  $this->query = "SELECT id_persona,nombres,apellidos,direccion,telefono,celular,correo,usuario FROM personas WHERE id_persona = '$id'";
  $this->query_preparada_retorna_valores();
  return $this->rows;
}

  function existeUsuario(){
  $usuario = $this->usuario;
  $this->query = "SELECT id_persona FROM personas WHERE usuario = '$usuario'";
  $this->query_preparada_retorna_valores();
  return $this->rows;
}

function selecionarUsuario(){
  $this->query = "SELECT id_persona,nombres,apellidos,direccion,telefono,celular,correo,usuario FROM personas WHERE id_persona='$this->idPersona'";
  $this->query_preparada_retorna_valores();
  return $this->rows;
}

  function contar(){
   $this->query = "SELECT id_persona FROM personas WHERE estado = 'Activo'";  
   $this->query_preparada_retorna_valores();
   $cantidad = count($this->rows);
   return $cantidad;
 }


 function validar2($repCon){
  $puntero = -1;

if($this->nombres == ""){
  $puntero = $puntero + 1;
  $this->validaciones[$puntero] = ",El campo nombre, no debe estar vacio,"; 
} 
if($this->apellidos == ""){
  $puntero = $puntero + 1;
  $this->validaciones[$puntero] = ",El campo apellido, no debe estar vacio,"; 
}
if($this->direccion == ""){
 $puntero = $puntero + 1;
 $this->validaciones[$puntero] = ",El campo direccion, no debe estar vacio,"; 
} 


if($this->telefono == ""){
 $puntero = $puntero + 1;
 $this->validaciones[$puntero] = ",El campo telefono, no debe estar vacio,";  
}else if(!is_numeric($this->telefono)){
 $puntero = $puntero + 1;
 $this->validaciones[$puntero] = ",El campo telefono, debe ser numerico,";  
}

if($this->celular == ""){
 $puntero = $puntero + 1;
 $this->validaciones[$puntero] = ",El campo celular, no debe estar vacio,";  
}else if(!is_numeric($this->celular)){
 $puntero = $puntero + 1;
 $this->validaciones[$puntero] = ",El campo celular, debe ser numerico,";  
}

if($this->correo == ""){
 $puntero = $puntero + 1;
 $this->validaciones[$puntero] = ",El campo correo, no debe estar vacio,"; 
}
if($this->usuario == ""){
$puntero = $puntero + 1;
$this->validaciones[$puntero] = ",El campo usuario, no debe estar vacio,"; 
} 

if($this->contrasena == ""){
 $puntero = $puntero + 1;
 $this->validaciones[$puntero] = utf8_encode(",El campo contraseña, no debe estar vacio,"); 
}

if(strcmp($this->contrasena,$repCon) !== 0){//si es 0 son iguales
 $puntero = $puntero + 1;
 $this->validaciones[$puntero] = utf8_encode(",Las contraseñas no conciden,");; 
}


 return $puntero;


}

  function validar($repCon){
     $puntero = -1;
    $this->existeUsuario();
   if(count($this->rows) == 1){
    $puntero = $puntero + 1;
     $this->validaciones[$puntero] = ",El usuario ".$this->usuario.", ya existe,"; 
   }   

   if($this->nombres == ""){
     $puntero = $puntero + 1;
     $this->validaciones[$puntero] = ",El campo nombre, no debe estar vacio,"; 
   } 
   if($this->apellidos == ""){
     $puntero = $puntero + 1;
     $this->validaciones[$puntero] = ",El campo apellido, no debe estar vacio,"; 
   }
   if($this->direccion == ""){
    $puntero = $puntero + 1;
    $this->validaciones[$puntero] = ",El campo direccion, no debe estar vacio,"; 
  } 


  if($this->telefono == ""){
    $puntero = $puntero + 1;
    $this->validaciones[$puntero] = ",El campo telefono, no debe estar vacio,";  
  }else if(!is_numeric($this->telefono)){
    $puntero = $puntero + 1;
    $this->validaciones[$puntero] = ",El campo telefono, debe ser numerico,";  
  }

  if($this->celular == ""){
    $puntero = $puntero + 1;
    $this->validaciones[$puntero] = ",El campo celular, no debe estar vacio,";  
  }else if(!is_numeric($this->celular)){
    $puntero = $puntero + 1;
    $this->validaciones[$puntero] = ",El campo celular, debe ser numerico,";  
  }

  if($this->correo == ""){
    $puntero = $puntero + 1;
    $this->validaciones[$puntero] = ",El campo correo, no debe estar vacio,"; 
  }
  if($this->usuario == ""){
   $puntero = $puntero + 1;
   $this->validaciones[$puntero] = ",El campo usuario, no debe estar vacio,"; 
 } 

  if($this->contrasena == ""){
    $puntero = $puntero + 1;
    $this->validaciones[$puntero] = utf8_encode(",El campo contraseña, no debe estar vacio,"); 
  }
  
  if(strcmp($this->contrasena,$repCon) !== 0){//si es 0 son iguales
    $puntero = $puntero + 1;
    $this->validaciones[$puntero] = utf8_encode(",Las contraseñas no conciden,");; 
  }

   
    return $puntero;


 }


 function lista()
{
  
}



 function nuevo()
{
    $nombres = $this->nombres;
    $apellidos = $this->apellidos;
    $direccion = $this->direccion;
    $celular = $this->celular;
    $telefono = $this->telefono;
    $correo = $this->correo;
    $usuario = $this->usuario;
    $contrasena = $this->contrasena;
    $rol = $this->rol;
    $estado = $this->estado;
    $celular = $this->celular;
    $this->query = "INSERT INTO personas(nombres,apellidos,direccion,telefono,celular,correo,usuario,contrasena,rol,estado)
    VALUES('$nombres','$apellidos','$direccion','$telefono','$celular','$correo','$usuario','$contrasena','$rol','$estado')";
    return $this->query_no_retorna_valores();
}

 function borrar()
{
    
}

function editar()
{
  $id = $this->idPersona;
  $nombres = $this->nombres;
  $apellidos = $this->apellidos;
  $direccion = $this->direccion;
  $celular = $this->celular;
  $telefono = $this->telefono;
  $correo = $this->correo;
  $usuario = $this->usuario;
  $this->query = "UPDATE personas SET `nombres`='$nombres',`apellidos`='$apellidos',`direccion`='$direccion',`telefono`='$telefono',`celular`='$celular',`correo`='$correo',`usuario`='$usuario' WHERE `id_persona` = '$id'";
  return $this->query_no_retorna_valores();
  
}

function getValidar(){
  return $this->validaciones; 
} 



function getId(){
   return $this->idPersona; 
} 

function getNombres() {
    return $this->nombres;
}

function getApellidos() {
    return $this->apellidos;
}

function getDireccion() {
    return $this->direccion;
}

function getTelefono() {
    return $this->telefono;
}

function getCelular() {
    return $this->celular;
}

function getCorreo() {
    return $this->correo;
}

function getUsuario() {
    return $this->usuario;
}

function getContrasena() {
    return $this->contrasena;
}

function setIdPersona($id) {
  $this->idPersona = $id;
}

function setNombres($nombres) {
    $this->nombres = $nombres;
}

function setApellidos($apellidos) {
    $this->apellidos = $apellidos;
}

function setDireccion($direccion) {
    $this->direccion = $direccion;
}

function setTelefono($telefono) {
    $this->telefono = $telefono;
}

function setCelular($celular) {
    $this->celular = $celular;
}

function setCorreo($correo) {
    $this->correo = $correo;
}

function setUsuario($usuario) {
    $this->usuario = $usuario;
}

function setContrasena($contrasena) {
    $this->contrasena = $contrasena;
}

}

?>

