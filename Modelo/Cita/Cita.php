
<?php 
 include_once '../../Modelo/ModeloBaseDatos.php';
 class Cita extends ModeloBaseDatos{

    private $idPaciente;
    private $idMedico;
    private $idCita;
    private $descripcion;
    private $fecha;
    private $tipo;
    private $validar = array();

    function __construct($idPaciente, $idMedico, $idCita, $descripcion, $fecha, $tipo) {
        $this->idPaciente = $idPaciente;
        $this->idMedico = $idMedico;
        $this->idCita = $idCita;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;
        $this->tipo = $tipo;
    }
    function getValidar(){
     return $this->validar;  
    }
  
    function validar(){
      $puntero = -1;
      if($this->descripcion == ""){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "Por favor llena el text area de descripcion";
      }else if(strlen($this->descripcion) > 250){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "La longitud del text area no debe ser mayor a 250";
      }

      if($this->fecha == ""){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "Por favor llena la fecha";
      }



    }

    function lista()
    {
     $tipo = $this->tipo;
     $this->query = "SELECT c.id_paciente,c.id_medico,c.id_cita,c.descripcion,c.fecha,c.tipo,p.nombres AS nombres_paciente,p.apellidos AS apellidos_paciente,t3.nombres AS nombres_medico,t3.apellidos AS apellidos_medico FROM citas c INNER JOIN personas p ON p.id_persona = c.id_paciente INNER JOIN personas t3 ON t3.id_persona = c.id_medico WHERE c.tipo = '$tipo' AND c.estado = 'Activo'";
     $this->query_preparada_retorna_valores();
     return $this->rows; 
    }

    function obtenerUltimocodigo(){
        $this->query = "SELECT id_paciente,id_medico,id_cita FROM citas"; 
        $this->query_preparada_retorna_valores();
        return $this->rows;
    }

    function consultar()
    {
      $idCita = $this->idCita;  
      $this->query = "SELECT c.fecha,c.descripcion FROM citas c WHERE id_cita = '$idCita'";  
      $this->query_preparada_retorna_valores();
      return $this->rows;
    }

    function editar()
    {
        $fecha = $this->fecha;
        $idMedico = $this->idMedico;
        $idPaciente = $this->idPaciente;
        $descripcion = $this->descripcion;
        $tipo = $this->tipo;
        $idCita = $this->idCita;
        $this->query = "UPDATE citas SET id_paciente='$idPaciente',id_medico='$idMedico',descripcion='$descripcion',fecha='$fecha' WHERE id_cita='$idCita'";
        return $this->query_no_retorna_valores();     
    }

    function borrar()
    {
        $idCita = $this->idCita;
        $this->query = "UPDATE citas SET estado='Inactivo' WHERE id_cita='$idCita'";
        return $this->query_no_retorna_valores();     
    }

     function nuevo()
     {
       $fecha = $this->fecha;
       $idMedico = $this->idMedico;
       $idPaciente = $this->idPaciente;
       $descripcion = $this->descripcion;
       $tipo = $this->tipo;
       $this->query = "INSERT INTO citas(id_paciente,id_medico,descripcion,fecha,tipo,estado)VALUES('$idPaciente','$idMedico','$descripcion','$fecha','$tipo','Activo')";  
       return $this->query_no_retorna_valores();
     }


    function getIdPaciente() {
        return $this->idPaciente;
    }

    function getIdMedico() {
        return $this->idMedico;
    }

    function getIdCita() {
        return $this->idCita;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setIdPaciente($idPaciente) {
        $this->idPaciente = $idPaciente;
    }

    function setIdMedico($idMedico) {
        $this->idMedico = $idMedico;
    }

    function setIdCita($idCita) {
        $this->idCita = $idCita;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

 }

?>