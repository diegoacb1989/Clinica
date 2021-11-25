
<?php 

  include '../../Modelo/Ciudad/Ciudad.php';
  include '../../Modelo/Pais/Pais.php';


 if(isset($_GET['accion'])){

   $accion = $_GET['accion'];
   $ciudad = new Ciudad("","","","","");
   if($accion  == "listar"){
    $rows = $ciudad->lista();
    echo json_encode($rows,JSON_UNESCAPED_UNICODE);
   }

   else if($accion == "nuevo"){
     $codigo_ciudad = $_GET['codigo'];
     $codigo_pais = $_GET['selectPaises'];
     $nombre = $_GET['nombre'];
     $descripcion = $_GET['descripcion'];

     $ciudad = new Ciudad($codigo_ciudad,$nombre,$descripcion,"",$codigo_pais);
     $validar = $ciudad->validar();
     $respuesta = $ciudad->getValidar();
     $longitud = sizeof($respuesta);
     $resultado = array();

     if($longitud >= 1){
      for($i=0;$i<$longitud;$i++){
        $resultado[$i] = $respuesta[$i];
     }}else{
       $sql = $ciudad->nuevo();
       if($sql == 1){
         

        $pais = new Pais($codigo_pais,"","");
        $rows = $pais->consultar();
        foreach($rows as $valor){
          $nombre_pais = $valor['nombre'];
        }

        $resultado = array(
        0 => array (
          'respuesta'=>'correcto',
          'codigo_ciudad' => $codigo_ciudad,
          'codigo_pais' => $codigo_pais,
          'nombre_ciudad' => $nombre,
          'nombre_pais' => $nombre_pais,
          'descripcion' => $descripcion,
          'accion' => 'Registrada'
         )
        );
      }
     }




     echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
   }
   else if($accion == "consultar"){
    $codigo_ciudad = $_GET['codigo_ciudad'];
    $codigo_pais = $_GET['codigo_pais'];
    $ciudad = new Ciudad($codigo_ciudad,"","","",$codigo_pais);
    $rows = $ciudad->consultar();
    echo json_encode($rows,JSON_UNESCAPED_UNICODE);
   }

   else if($accion == "editar"){
    //-------------------------------------------------------------------------
     $codigo_ciudad = $_GET['codigo'];
     $codigo_pais = $_GET['selectPaises'];
     $codigoAnteriorCiudad = $_GET['codigoAnteriorCiudad'];
     $codigoAnteriorPais = $_GET['codigoAnteriorPais'];

     $nombre = $_GET['nombre'];
     $descripcion = $_GET['descripcion'];

     $ciudad = new Ciudad($codigo_ciudad,$nombre,$descripcion,"",$codigo_pais);
     $longitud = 0;
     if(($codigo_ciudad == $codigoAnteriorCiudad) && ($codigo_pais == $codigoAnteriorPais)){//NO MIDIFCO LAS LLAVES, NO VALIDO LLAVES
      
      $validar = $ciudad->validar2();
      $respuesta = $ciudad->getValidar();
      $longitud = sizeof($respuesta);
      $resultado = array();

      if($longitud >= 1){
        for($i=0;$i<$longitud;$i++){
          $resultado[$i] = $respuesta[$i];
       }}

     }else{//HAY QUE VALIDAR LA LLAVES 

      $validar = $ciudad->validar();
      $respuesta = $ciudad->getValidar();
      $longitud = sizeof($respuesta);
      $resultado = array();

      if($longitud >= 1){
        for($i=0;$i<$longitud;$i++){
          $resultado[$i] = $respuesta[$i];
       }}

     }

     if($longitud == 0){

      $ciudad->setCodigoCiudadPaisAnterior($codigoAnteriorCiudad,$codigoAnteriorPais);
      $ciudad->editar();

      $pais = new Pais($codigo_pais,"","");
      $rows = $pais->consultar();
      foreach($rows as $valor){
        $nombre_pais = $valor['nombre'];
      }
      
      $resultado = array(
        0 => array (
          'respuesta'=>'correcto',
          'accion' => 'actualizada',
          'codigo_ciudad' => $codigo_ciudad,
          'codigo_pais' => $codigo_pais,
          'nombre_ciudad' => $nombre,
          'nombre_pais' => $nombre_pais,
          'descripcion' => $descripcion
         )
        );

     }


    
     echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
     
   }
    else if($accion == "borrar"){
      $codigo_ciudad = $_GET['codigo_ciudad'];
      $codigo_pais = $_GET['codigo_pais']; 
      $ciudad = new Ciudad($codigo_ciudad,"","","",$codigo_pais);
      $ciudad->borrar();
        
      $resultado = array(
        0 => array (
          'respuesta'=>'correcto',
          'accion' => 'Actualizada'
         )
        );
      echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
    }


 }