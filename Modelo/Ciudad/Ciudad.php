<?php

include_once "../../Modelo/ModeloBaseDatos.php";

class Ciudad extends ModeloBaseDatos{

    private $codigo;
    private $codigo_pais;
    private $nombre;
    private $descripcion;
    private $nombrePais;

    private $codigo_ciudadAnterior;
    private $codigo_PaisAnterior;
    private $validar = array();

    function __construct($codigo, $nombre, $descripcion, $nombrePais,$codigo_pais) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->nombrePais = $nombrePais;
        $this->codigo_pais = $codigo_pais;
    }

    function setCodigoCiudadPaisAnterior($ciudad,$pais){
      $this->codigo_ciudadAnterior = $ciudad;
      $this->codigo_PaisAnterior = $pais;
    }

    public function existeCodigo(){
        $codigo = $this->codigo;
        $codigo_pais = $this->codigo_pais;
        $this->query = "SELECT codigo FROM ciudades WHERE codigo='$codigo' AND codigo_pais='$codigo_pais'";
        $this->query_preparada_retorna_valores();
 
     }

     function validar2(){

      $puntero = -1;

      if($this->nombre == ""){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "Por favor llena el campo nombre";
      }else if(!preg_match("/^[A-Za-z\_\-\.\s\xF1\xD1]+$/",$this->nombre)){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "El campo nombre solo debe llevar letras";
      }

      if($this->descripcion == ""){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "Por favor llena el campo descripcion";
      }

        return $puntero;

     }

    function validar(){

        $puntero = -1;

        $this->existeCodigo();
        if(count($this->rows) == 1){
          $puntero = $puntero + 1;
          $this->validar[$puntero] = "El codigo de la ciudad, ".$this->codigo.", junto con el  codigo del pais,".$this->codigo_pais.", ya existe";
        }
  
        if($this->codigo_pais == "nulo"){
          $puntero = $puntero + 1;
          $this->validar[$puntero] = "Por favor seleciona un pais";
        }

      if($this->codigo == ""){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "Por favor llena el campo codigo";
      }else if(!is_numeric($this->codigo)){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "El campo codigo debe, ser numerico";
      } 

      if($this->nombre == ""){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "Por favor llena el campo nombre";
      }else if(!preg_match("/^[A-Za-z\_\-\.\s\xF1\xD1]+$/",$this->nombre)){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "El campo nombre solo debe llevar letras";
      }

      if($this->descripcion == ""){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "Por favor llena el campo descripcion";
      }

        return $puntero;

    }


    function getValidar(){
      return $this->validar;
    }

    function lista()
    {
       $this->query = "SELECT c.codigo,c.codigo_pais,c.nombre,c.descripcion,p.nombre AS nombre_pais FROM ciudades c INNER JOIN paises p ON c.codigo_pais = p.codigo AND c.estado='Activo'"; 
       $this->query_preparada_retorna_valores();
       return $this->rows;
    }

    function nuevo()
    {
      $codigo_ciudad = $this->codigo;
      $codigo_pais = $this->codigo_pais;
      $nombre = $this->nombre;
      $descripcion = $this->descripcion;
      $this->query = "INSERT INTO ciudades(codigo,codigo_pais,nombre,descripcion,estado)VALUES('$codigo_ciudad','$codigo_pais','$nombre','$descripcion','Activo')"; 
      return $this->query_no_retorna_valores();
    }

    function borrar()
    {
      $codigo_ciudad = $this->codigo;
      $codigo_pais = $this->codigo_pais;  
      $this->query = "UPDATE ciudades SET estado='Desactivado' WHERE codigo='$codigo_ciudad' AND codigo_pais='$codigo_pais'";
      return $this->query_no_retorna_valores();
    }

    function editar()
    {
      $codigo_ciudad = $this->codigo;
      $codigo_pais = $this->codigo_pais;
      $nombre = $this->nombre;
      $descripcion = $this->descripcion;
      

      $codigo_ciudadAnterior = $this->codigo_ciudadAnterior;
      $codigo_PaisAnterior = $this->codigo_PaisAnterior;

      $this->query = "UPDATE ciudades SET codigo='$codigo_ciudad',codigo_pais='$codigo_pais',nombre='$nombre',descripcion='$descripcion' WHERE codigo='$codigo_ciudadAnterior' AND codigo_pais='$codigo_PaisAnterior'";
      return $this->query_no_retorna_valores();
    }

    function consultar()
    {
      $codigo_ciudad = $this->codigo;
      $codigo_pais = $this->codigo_pais;
      $this->query = "SELECT nombre,descripcion FROM ciudades WHERE codigo = '$codigo_ciudad' AND codigo_pais = '$codigo_pais'";
      $this->query_preparada_retorna_valores();
      return $this->rows;
    }
    

    function getCodigo() {
        return $this->codigo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getNombrePais() {
        return $this->nombrePais;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setNombrePais($nombrePais) {
        $this->nombrePais = $nombrePais;
    }

}