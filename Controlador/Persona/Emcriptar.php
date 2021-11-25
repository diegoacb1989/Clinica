
<?php 
  
  class Emcriptar{
    private $data;
    private $algo = "sha256";
    private $raw_output = false;//salida de hexadecimales
    private $resultado;
    function __construct($data) {
     $this->data = $data;
    }
    function setEncriptar(){
      $this->resultado = hash($this->algo,$this->data,$this->raw_output);      
    }
     
    function getResultado(){
        return $this->resultado;
    }

  }
 
   /*$encriptar = new Emcriptar("Ot4n675?");//admin = Ot4n675? 
   $encriptar->setEncriptar();
   $resultado = $encriptar->getResultado();
   echo "Ot4n675? = " .$resultado."<br>";
   echo "Longitud: " .strlen($resultado);*/
?>