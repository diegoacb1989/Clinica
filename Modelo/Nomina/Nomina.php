

<?php 

 include_once '../../Modelo/ModeloBaseDatos.php';

 class Nomina extends ModeloBaseDatos{
    
    private $id_empleado;
    private $id_nomina;
    private $s_basico;
    private $v_hor_extra;
    private $s_total;
    private $can_hor;
    private $fecha;
    private $validar = array();
    private $id_empleadoAnterior;

    function setid_empleadoAnterior($id_empleadoAnterior){
     $this->id_empleadoAnterior = $id_empleadoAnterior;
    }

    function lista()
    {
      $this->query = "SELECT n.id_empleado,n.id_nomina,n.s_basico,n.can_hor,n.v_hor_extra,n.s_total,n.fecha,p.nombres AS nombre_empleado FROM nominas n INNER JOIN personas p ON P.id_persona=n.id_empleado WHERE n.estado='Activo'";
      $this->query_preparada_retorna_valores();
      return $this->rows;
    }

    function obtenerUltimocodigo(){
        $this->query = "SELECT id_empleado,id_nomina FROM nominas"; 
        $this->query_preparada_retorna_valores();
        return $this->rows;
    }

    function nuevo()
    {
        $id_empleado =  $this->id_empleado;
        $s_basico = $this->s_basico;
        $v_hor_extra = $this->v_hor_extra;
        $can_hor = $this->can_hor;
        $fecha = $this->fecha;
        $s_total = $this->calcularSaldo();
        $this->s_total = $s_total;

        $this->query = "INSERT INTO nominas(id_empleado,s_basico,can_hor,v_hor_extra,s_total,fecha,estado)VALUES('$id_empleado','$s_basico','$can_hor','$v_hor_extra','$s_total','$fecha','Activo')"; 
        return $this->query_no_retorna_valores();
    }

    function borrar()
    {
      $id_empleado =  $this->id_empleado;
      $id_nomina = $this->id_nomina;
      $this->query = "UPDATE nominas SET estado='Desactivado' WHERE id_empleado='$id_empleado' AND id_nomina='$id_nomina'";
      return $this->query_no_retorna_valores();   
    }

    function editar()
    {
      $id_empleadoAnterior = $this->id_empleadoAnterior;
      $id_empleado =  $this->id_empleado;
      $s_basico = $this->s_basico;
      $v_hor_extra = $this->v_hor_extra;
      $can_hor = $this->can_hor;
      $fecha = $this->fecha;
      $s_total = $this->calcularSaldo();
      $this->s_total = $s_total;
      $id_nomina = $this->id_nomina;
      $this->query = "UPDATE nominas SET id_empleado='$id_empleado',s_basico='$s_basico',can_hor='$can_hor',v_hor_extra='$v_hor_extra',s_total='$s_total',fecha='$fecha' WHERE id_nomina='$id_nomina' AND id_empleado='$id_empleadoAnterior'";
      return $this->query_no_retorna_valores();   
    }

    function consultar()
    {
      $id_empleado =  $this->id_empleado;
      $id_nomina = $this->id_nomina;
      $this->query = "SELECT n.id_empleado,n.id_nomina,n.s_basico,n.can_hor,n.v_hor_extra,n.s_total,n.fecha,p.nombres AS nombre_empleado FROM nominas n INNER JOIN personas p ON P.id_persona=n.id_empleado WHERE n.id_empleado = '$id_empleado' AND n.id_nomina = '$id_nomina'";
      $this->query_preparada_retorna_valores();
      return $this->rows;

    }
    
    function __construct($id_empleado, $id_nomina, $s_basico, $v_hor_extra, $can_hor,$fecha) {
        $this->id_empleado = $id_empleado;
        $this->id_nomina = $id_nomina;
        $this->s_basico = $s_basico;
        $this->v_hor_extra = $v_hor_extra;
        $this->can_hor = $can_hor;
        $this->fecha = $fecha;
    }

    function validar(){

        $puntero = -1;

  
      if($this->s_basico == ""){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "Por favor llena el campo salario basico";
      }else if(!is_numeric($this->s_basico)){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "El campo salario basico debe, ser numerico";
      } 

      if($this->v_hor_extra == ""){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "Por favor llena el campo valor de hora extra";
      }else if(!is_numeric($this->v_hor_extra)){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "El campo valor de hora extra debe, ser numerico";
      } 

      if($this->can_hor == ""){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "Por favor llena el campo cantidad de horas extras";
      }else if(!is_numeric($this->can_hor)){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "El campo cantidad de horas extras debe, ser entero";
      } 

      if($this->fecha == ""){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "Por favor llena el campo fecha";
      }

        return $puntero;

    }

    public function getValidar(){
      return $this->validar;
    }

    private function calcularSaldo(){
      $v_hor_extra = $this->v_hor_extra;
      $can_hor = $this->can_hor;
      $subTotal = $v_hor_extra * $can_hor;
      $s_basico = $subTotal + $this->s_basico;
      return $s_basico;
    }

    function getId_empleado() {
        return $this->id_empleado;
    }

    function getId_nomina() {
        return $this->id_nomina;
    }

    function getS_basico() {
        return $this->s_basico;
    }

    function getV_hor_extra() {
        return $this->v_hor_extra;
    }

    function getS_total() {
        return $this->s_total;
    }

    function getCan_hor() {
        return $this->can_hor;
    }

    function setId_empleado($id_empleado) {
        $this->id_empleado = $id_empleado;
    }

    function setId_nomina($id_nomina) {
        $this->id_nomina = $id_nomina;
    }

    function setS_basico($s_basico) {
        $this->s_basico = $s_basico;
    }

    function setV_hor_extra($v_hor_extra) {
        $this->v_hor_extra = $v_hor_extra;
    }

    function setS_total($s_total) {
        $this->s_total = $s_total;
    }

    function setCan_hor($can_hor) {
        $this->can_hor = $can_hor;
    }
    
 }

?>