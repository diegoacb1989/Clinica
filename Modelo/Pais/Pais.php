
<?php 
 include_once "../../Modelo/ModeloBaseDatos.php";

 class Pais extends ModeloBaseDatos{

    private $codigo;
    private $nombre;
    private $descripcion;
    private $codigoAnte;
    private $validar = array();

    public function existeCodigo(){
       $codigo = $this->codigo;
       $this->query = "SELECT codigo FROM paises WHERE codigo='$codigo'";
       $this->query_preparada_retorna_valores();

    }
    
    public function validarPais(){
      $puntero = -1;
      $this->existeCodigo();
      if(count($this->rows) == 1){
        $puntero = $puntero + 1;
        $this->validar[$puntero] = "El codigo, ".$this->codigo.", ya existe";
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

    function validarPaisDos(){

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

    

    function getValidar(){
      return $this->validar;
    }

    function lista(){
     $this->query = "SELECT codigo,nombre,descripcion FROM paises WHERE estado='Activo'";
     $this->query_preparada_retorna_valores();
     return $this->rows;
    }

    function consultar()
    {
      $codigo = $this->codigo; 
      $this->query = "SELECT codigo,nombre,descripcion FROM paises WHERE codigo='$codigo'";  
      $this->query_preparada_retorna_valores();
      return $this->rows;
    }


    function borrar(){
      $codigo = $this->codigo;
      $this->query = "UPDATE paises SET estado='Desactivado' WHERE codigo='$codigo'";
      return $this->query_no_retorna_valores();   
    }

    

    function editar()
    {
      $codigo = $this->codigo;
      $nombre = $this->nombre;
      $descripcion = $this->descripcion;
      $codigoAnte = $this->codigoAnte;
      $this->query = "UPDATE paises SET codigo='$codigo',nombre='$nombre',descripcion='$descripcion' WHERE codigo='$codigoAnte'";
      return $this->query_no_retorna_valores();     
    }

    
    function nuevo()
    { 
      $codigo = $this->codigo;
      $nombre = $this->nombre;
      $descripcion = $this->descripcion;
      $this->query = "INSERT INTO paises(codigo,nombre,descripcion,estado)VALUES('$codigo','$nombre','$descripcion','Activo')"; 
      return $this->query_no_retorna_valores();
    }




    function __construct($codigo, $nombre, $descripcion) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
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

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setCodigoAnte($codigo) {
      $this->codigoAnte = $codigo;
  }
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }


    

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    } 

 }
?>