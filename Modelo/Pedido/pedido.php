<?php 
 include_once '../../Modelo/ModeloBaseDatos.php';
 class Pedido extends ModeloBaseDatos{

    private $idPedido;
    private $idAdministrador;
    private $cantProductos;
    private $total;
    private $fecha;

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
  
    function __construct($idPedido, $idAdministrador, $cantProductos, $total, $fecha) {
        $this->idPedido = $idPedido;
        $this->idAdministrador = $idAdministrador;
        $this->cantProductos = $cantProductos;
        $this->total = $total;
        $this->fecha = $fecha;
    }

    function getIdPedido() {
        return $this->idPedido;
    }

    function getIdAdministrador() {
        return $this->idAdministrador;
    }

    function getCantProductos() {
        return $this->cantProductos;
    }

    function getTotal() {
        return $this->total;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    function setIdAdministrador($idAdministrador) {
        $this->idAdministrador = $idAdministrador;
    }

    function setCantProductos($cantProductos) {
        $this->cantProductos = $cantProductos;
    }

    function setTotal($total) {
        $this->total = $total;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

 }
  
?>