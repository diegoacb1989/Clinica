
<?php 

  abstract class ModeloBaseDatos{

   static private $usuario = "root"; 
   static private $password = "";
   static private $dbName = "clinica";
   static private $host = "localhost";
   protected $conexion;

   protected $query;
   protected $rows = array();
   protected $mensaje;


   abstract  function consultar();
   abstract  function nuevo();
   abstract  function editar();
   abstract  function borrar();
   abstract  function lista();

    function abrir_conexion(){
  
    $this->conexion =  new mysqli(self::$host,self::$usuario,self::$password,self::$dbName);
    if($this->conexion->connect_error){
      echo "Error de conexion: ".$this->conexion->connect_error;
    }

  }

  protected function query_preparada_retorna_valores(){

      try {
				$this->abrir_conexion();
				$result = $this->conexion->query($this->query) 
					or die(mysqli_errno($this->conexion)." : " 
					.mysqli_error($this->conexion)." | Query=".$this->query);

				while ($fila = $result->fetch_assoc()){
					$this->rows[] = array_map('utf8_encode',$fila);
				}
				$result->close();
				$this->cerrar_conexion();
				//array_pop($this->rows);
			} catch(Exception $e) {
		        echo "Error! : " . $e->getMessage();
		        return false;
		    }

    }

    protected function query_no_retorna_valores(){

      try {
				$this->abrir_conexion();
		        $this->conexion->query($this->query) 
				or die(mysqli_errno($this->conexion)." : " 
				.mysqli_error($this->conexion)."  | Query=".$this->query);
				$resultado = $this->conexion->affected_rows;
				$this->cerrar_conexion();
				return $resultado;
		    } catch(Exception $e) {
		        echo "Error! : " . $e->getMessage();
		        return false;
		    }

    }

    private function cerrar_conexion(){
        $this->conexion->close();
    }

  }//FIN DE LA CLASE

  /*$conexion = new ModeloBaseDatos();
  $conexion->abrir_conexion();
  $conexion->query = "SELECT  * FROM personas";
  $conexion->query_preparada_retorna_valores();
  echo json_encode(array('data'=>$conexion->rows));
  foreach ($conexion->rows as $clave => $valor){
   //echo $clave." = ".$valor['id_usuario']." ".$valor['nombres']."<br>";
  }
  $nombres = "Sede suroccidente";
  $descripciones = "Sede occidente";
  $direcciones = "kr 68 d4 ";
  $telefono = "4789654";
  $estado = "Activo";
  $conexion->query = "INSERT INTO sedes(nombres,descripciones,direcciones,telefonos,estado)VALUES(\"$nombres\",\"$descripciones\",\"$direcciones\",\"$telefono\",\"$estado\")";
  echo "Fila afectada: ".$conexion->query_no_retorna_valores();*/
?>