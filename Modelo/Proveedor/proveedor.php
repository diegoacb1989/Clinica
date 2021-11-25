
<?php 

 include_once '../../Modelo/ModeloBaseDatos.php';

  class Proveedor extends ModeloBaseDatos{

    private $idProveedor;
    private $nombre;
    private $descripcion;
    private $direccion;
    private $telefono;
    private $validaciones = array();
  
    function __construct($idProveedor, $nombre, $descripcion, $direccion, $telefono) {
        $this->idProveedor = $idProveedor;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }

    function validar(){
      $puntero = -1;
        
        if($this->telefono == ""){
            $puntero = $puntero + 1;
            $this->validaciones[$puntero] = ",El campo telefono, no debe estar vacio,";  
           }else if(!is_numeric($this->telefono)){
            $puntero = $puntero + 1;
            $this->validaciones[$puntero] = ",El campo telefono, debe ser numerico,";  
           }

           if($this->nombre == ""){
            $puntero = $puntero + 1;
            $this->validaciones[$puntero] = ",El campo nombre, no debe estar vacio,";  
           }

           if($this->descripcion == ""){
            $puntero = $puntero + 1;
            $this->validaciones[$puntero] = ",El campo descripcion, no debe estar vacio,";  
           }

           if($this->direccion == ""){
            $puntero = $puntero + 1;
            $this->validaciones[$puntero] = ",El campo direccion, no debe estar vacio,";  
           }

           return $puntero;

    }

    function getValidar(){
      return $this->validaciones;  
    }

    function getIdProveedor() {
        return $this->idProveedor;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function setIdProveedor($idProveedor) {
        $this->idProveedor = $idProveedor;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function consultar(){
        $idProveedor = $this->idProveedor;
        $this->query = "SELECT * FROM proveedores WHERE id_proveedor='$idProveedor'"; 
        $this->query_preparada_retorna_valores();
        return $this->rows; 
    }

    function obtenerUltimocodigo(){
        $this->query = "SELECT id_proveedor FROM proveedores"; 
        $this->query_preparada_retorna_valores();
        return $this->rows;
    }

    function nuevo(){
      $nombre = $this->nombre;
      $telefono = $this->telefono;
      $direccion = $this->direccion;
      $descripcion = $this->descripcion;
      $this->query = "INSERT INTO proveedores(nombre,descripcion,direccion,telefono,estado)VALUES('$nombre','$descripcion','$direccion','$telefono','Activo')";
      return $this->query_no_retorna_valores();
    }

    function editar(){
        $idProveedor = $this->idProveedor;
        $nombre = $this->nombre;
        $telefono = $this->telefono;
        $direccion = $this->direccion;
        $descripcion = $this->descripcion;
        $this->query = "UPDATE proveedores SET nombre='$nombre',telefono='$telefono',direccion='$direccion',descripcion='$descripcion' WHERE id_proveedor='$idProveedor'";
        return $this->query_no_retorna_valores();
    }

    function borrar(){
        $idProveedor = $this->idProveedor;
        $this->query = "UPDATE proveedores SET estado='Desactivado' WHERE id_proveedor='$idProveedor'";
        return $this->query_no_retorna_valores();

    }

    function lista(){
      $this->query = "SELECT * FROM proveedores WHERE estado='Activo'"; 
      $this->query_preparada_retorna_valores();
      return $this->rows;
    }
     

  }

?>