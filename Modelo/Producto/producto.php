

<?php 

 include_once '../../Modelo/ModeloBaseDatos.php';

 class Producto extends ModeloBaseDatos{

    private $idProducto;
    private $nombre;
    private $descripcion;
    private $valorUnitario;
    private $urlImagen;
    
  
    function __construct($idProducto, $nombre, $descripcion, $valorUnitario, $urlImagen) {
        $this->idProducto = $idProducto;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->valorUnitario = $valorUnitario;
        $this->urlImagen = $urlImagen;
    }

    function consultar(){

    }

    function nuevo(){

    }

    function editar(){

    }

    function borrar(){

    }

    function lista(){
        
    }
    
    function getIdProducto() {
        return $this->idProducto;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getValorUnitario() {
        return $this->valorUnitario;
    }

    function getUrlImagen() {
        return $this->urlImagen;
    }

    function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setValorUnitario($valorUnitario) {
        $this->valorUnitario = $valorUnitario;
    }

    function setUrlImagen($urlImagen) {
        $this->urlImagen = $urlImagen;
    }

 }
 
?>