<?php 
  
  include_once "../../Modelo/ModeloBaseDatos.php";

 class Sede extends ModeloBaseDatos{

    private $codigo_sede;
    private $codigo_ciudad;
    private $codigo_pais;
    private $nombre;
    private $direccion;
    private $telefono;
    private $validaciones = array();


    private $codigo_sede_anterior;
    private $codigo_ciudad_anterior;
    private $codigo_pais_anterior;

    function __construct($codigo_sede,$codigo_pais,$codigo_ciudad, $nombre, $direccion, $telefono) {
        $this->codigo_sede = $codigo_sede;
        $this->codigo_pais = $codigo_pais;
        $this->codigo_ciudad = $codigo_ciudad;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }
    function  getValidar(){
        return $this->validaciones;
    }

    function existeSede(){
        $codigo_sede = $this->codigo_sede;
        $codigo_ciudad = $this->codigo_ciudad;
        $codigo_pais = $this->codigo_pais;
        $this->query = "SELECT codigo_sede FROM sedes WHERE codigo_sede = '$codigo_sede' AND codigo_pais = '$codigo_pais' AND codigo_ciudad = '$codigo_ciudad'";
        $this->query_preparada_retorna_valores();
        return $this->rows;
    }

    function validar(){
      $puntero = -1;

      if($this->codigo_sede == ""){
        $puntero = $puntero + 1;
        $this->validaciones[$puntero] = "El campo codigo sede no debe estar vacio,"; 
      } 
    else {
        $this->existeSede();
        if(count($this->rows) == 1){
            $puntero = $puntero + 1;
            $this->validaciones[$puntero] = "La sede con codigo sede-pais-ciudad: ".$this->codigo_sede."-".$this->codigo_pais."-".$this->codigo_ciudad." ya existe, "; 
        }   

    }


    if($this->nombre == ""){
        $puntero = $puntero + 1;
        $this->validaciones[$puntero] = "El campo nombre no debe estar vacio,"; 
      } 

      if($this->direccion == ""){
        $puntero = $puntero + 1;
        $this->validaciones[$puntero] = "El campo direccion no debe estar vacio,"; 
      } 

      if($this->telefono == ""){
        $puntero = $puntero + 1;
        $this->validaciones[$puntero] = "El campo telefono no debe estar vacio,";  
      }else if(!is_numeric($this->telefono)){
        $puntero = $puntero + 1;
        $this->validaciones[$puntero] = "El campo telefono debe ser numerico";  
      }
    

    }

    function validarDos(){

      $puntero = -1;

      if($this->codigo_sede == ""){
        $puntero = $puntero + 1;
        $this->validaciones[$puntero] = "El campo codigo sede no debe estar vacio,"; 
      } 
    
    if($this->nombre == ""){
        $puntero = $puntero + 1;
        $this->validaciones[$puntero] = "El campo nombre no debe estar vacio,"; 
      } 

      if($this->direccion == ""){
        $puntero = $puntero + 1;
        $this->validaciones[$puntero] = "El campo direccion no debe estar vacio,"; 
      } 

      if($this->telefono == ""){
        $puntero = $puntero + 1;
        $this->validaciones[$puntero] = "El campo telefono no debe estar vacio,";  
      }else if(!is_numeric($this->telefono)){
        $puntero = $puntero + 1;
        $this->validaciones[$puntero] = "El campo telefono debe ser numerico";  
      }

    }

  function consultar()
  {
    $codigo_sede = $this->codigo_sede;
    $codigo_pais = $this->codigo_pais;
    $codigo_ciudad = $this->codigo_ciudad;
    $this->query = "SELECT * FROM sedes s WHERE codigo_sede = '$codigo_sede' AND codigo_pais = '$codigo_pais' AND codigo_ciudad = '$codigo_ciudad'";
    $this->query_preparada_retorna_valores();
    return $this->rows;

  }

  function editar()
  {
    //CODIGO NUEVOS
    $codigo_sede = $this->codigo_sede;
    $codigo_pais = $this->codigo_pais;
    $codigo_ciudad = $this->codigo_ciudad;
    //CODIGO ANTERIORES
    $codigo_pais_anterior = $this->codigo_pais_anterior;
    $codigo_ciudad_anterior = $this->codigo_ciudad_anterior;
    $codigo_sede_anterior = $this->codigo_sede_anterior;
    //--------------------------------------------------------
    $nombre = $this->nombre;
    $direccion = $this->direccion;
    $telefono = $this->telefono;
    $this->query = "UPDATE `sedes` SET `codigo_sede`='$codigo_sede',`codigo_pais`='$codigo_pais',`codigo_ciudad`='$codigo_ciudad', `nombre`= '$nombre',`direccion`= '$direccion',`telefono`='$telefono' WHERE `codigo_sede` = '$codigo_sede_anterior' AND `codigo_ciudad` = '$codigo_ciudad_anterior' AND `codigo_pais` = '$codigo_pais_anterior'";
    return $this->query_no_retorna_valores();
  }

  function setCodigoAnteriores($codigo_sede_anterior,$codigo_ciudad_anterior,$codigo_pais_anterior){

    $this->codigo_sede_anterior = $codigo_sede_anterior;
    $this->codigo_ciudad_anterior = $codigo_ciudad_anterior;
    $this->codigo_pais_anterior = $codigo_pais_anterior;
    

  }

function nuevo()
{
    $codigo_sede = $this->codigo_sede;
    $codigo_pais = $this->codigo_pais;
    $codigo_ciudad = $this->codigo_ciudad;
    $direccion = $this->direccion;
    $telefono = $this->telefono;
    $direccion = $this->direccion;
    $nombre = $this->nombre;

    $this->query = "INSERT INTO sedes(codigo_sede,codigo_pais,codigo_ciudad,nombre,direccion,telefono,estado)
    VALUES('$codigo_sede','$codigo_pais','$codigo_ciudad','$nombre','$direccion','$telefono','Activo')";
    return $this->query_no_retorna_valores();
}
  

  function lista()
  {
  
    $this->query = "SELECT s.codigo_sede,s.codigo_ciudad,s.codigo_pais,s.nombre AS nombre_sede,s.direccion,s.telefono,c.nombre AS nombre_ciudad FROM sedes s INNER JOIN ciudades c ON s.codigo_ciudad = c.codigo AND s.codigo_pais = c.codigo_pais WHERE s.estado = 'Activo'";
    $this->query_preparada_retorna_valores();
    return $this->rows;

  }

  function borrar()
  {
    $codigo_sede = $this->codigo_sede;
    $codigo_pais = $this->codigo_pais;
    $codigo_ciudad = $this->codigo_ciudad;
    $this->query = "UPDATE sedes SET estado='Desactivado' WHERE codigo_sede = '$codigo_sede' AND codigo_pais = '$codigo_pais' AND codigo_ciudad = '$codigo_ciudad'";
    return $this->query_no_retorna_valores();
  }
    
    function getCodigo_sede() {
        return $this->codigo_sede;
    }

    function getCodigo_ciudad() {
        return $this->codigo_ciudad;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function setCodigo_sede($codigo_sede) {
        $this->codigo_sede = $codigo_sede;
    }

    function setCodigo_ciudad($codigo_ciudad) {
        $this->codigo_ciudad = $codigo_ciudad;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }


 }