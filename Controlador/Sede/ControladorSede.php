<?php 
 include '../../Modelo/Sede/Sede.php';
 if(isset($_GET['accion'])){
     
  $accion = $_GET['accion'];

  if($accion == "nuevo"){
   $codigo_sede = $_GET['codigo_sede'];
   $nombre_sede = $_GET['nombre_sede'];
   $direccion_sede = $_GET['direccion_sede'];
   $telefono_sede = $_GET['telefono_sede'];
   $selectSede = $_GET['selectSede'];
   $separado = explode("-",$selectSede);
   
    //SEPARAMOS LA LLAVE COMPUESTA
    
    $sede = new Sede($codigo_sede,$separado[0],$separado[1],$nombre_sede,$direccion_sede,$telefono_sede); 
    $sede->validar();

    $respuesta = $sede->getValidar();
    $longitud = sizeof($respuesta);
    $resultado = array();

    if($longitud >= 1){
    for($i=0;$i<$longitud;$i++){
      $resultado[$i] = $respuesta[$i];
    }
   }else{
    $valor = $sede->nuevo();
    if($valor == 1){
      $resultado = array(
        0 => array (
          'respuesta'=>'correcto',
          'nombre_sede' => $nombre_sede,
          'nombre_ciudad' => $separado[2],
          'direccion_sede' => $direccion_sede,
          'telefono_sede' => $telefono_sede,
          'codigo_pais' => $separado[0],
          'codigo_ciudad' => $separado[1],
          'codigo_sede' => $codigo_sede,
          'accion' => 'registrada',
          'selectSede' => "codigo pais: ".$separado[0].", codigo de ciudad: ". $separado[1]
        )
        );
    }
    

   }

    echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
  }

  else if($accion == "listar"){
    $sede = new Sede("","","","","",""); 
    $rows = $sede->lista();
    echo json_encode(array('data'=>$rows,JSON_UNESCAPED_UNICODE));

  }
  
  else if($accion == "consultar"){

    $codigo_pais = $_GET['codigo_pais'];
    $codigo_sede = $_GET['codigo_sede'];
    $codigo_ciudad = $_GET['codigo_ciudad'];

    $sede = new Sede($codigo_sede,$codigo_pais,$codigo_ciudad,"","",""); 
    $rows = $sede->consultar();
    echo json_encode(array('data'=>$rows,JSON_UNESCAPED_UNICODE));

  }

  else if($accion == "editar"){

   $nombre_sede = $_GET['nombre_sede'];
   $direccion_sede = $_GET['direccion_sede'];
   $telefono_sede = $_GET['telefono_sede'];
   $selectSede = $_GET['selectSede'];
   $separado = explode("-",$selectSede);
   
   //SEPARAMOS LA LLAVE COMPUESTA
   //CODIGOS QUE TENIA ANTES DE LA ACTUALIZACION
   $codigo_pais_anterior = $_GET['codigo_pais_anterior'];
   $codigo_sede_anterior = $_GET['codigo_sede_anterior'];
   $codigo_ciudad_anterior = $_GET['codigo_ciudad_anterior'];
   //CODIGOS ACTUALES
   $codigo_sede = $_GET['codigo_sede'];
   $codigo_ciudad = $separado[1];
   $codigo_pais = $separado[0];
   //echo "Codigo de sede: ".$codigo_sede."<br>";
   $sede = new Sede($codigo_sede,$separado[0],$separado[1],$nombre_sede,$direccion_sede,$telefono_sede); 
   $longitud = 0;
   //echo $codigo_sede."=".$codigo_sede_anterior.",".$codigo_ciudad."=".$codigo_ciudad_anterior.",".$codigo_pais."=".$codigo_pais_anterior."<br>";
   if(($codigo_sede == $codigo_sede_anterior) && ($codigo_ciudad == $codigo_ciudad_anterior) && ($codigo_pais == $codigo_pais_anterior)){//NO MODIFCO LAS LLAVES, NO VALIDO LLAVES
    //echo "Son iguales";
     /*$resultado = array(
      0 => array (
        'respuesta'=>'SON IGUALES',
        
      )
      );*/

      $sede->validarDos();

      $respuesta = $sede->getValidar();
      $longitud = sizeof($respuesta);
      $resultado = array();
  
      if($longitud >= 1){
      for($i=0;$i<$longitud;$i++){
        $resultado[$i] = $respuesta[$i];
      }
    }

   }else{//HAY QUE VALIDAR LA LLAVES, SE VALIDA COMO SI SE FUERA A REGISTRAR UNA NUEVA SEDE
    $sede->validar();

    $respuesta = $sede->getValidar();
    $longitud = sizeof($respuesta);
    $resultado = array();

    if($longitud >= 1){
    for($i=0;$i<$longitud;$i++){
      $resultado[$i] = $respuesta[$i];
    }

  }
}

  if($longitud < 1){
   

      $sede->setCodigoAnteriores($codigo_sede_anterior,$codigo_ciudad_anterior,$codigo_pais_anterior);
      $valor =  $sede->editar();
 
      $resultado = array(
        0 => array (
         'respuesta'=>'correcto',
         'accion' => 'Actualizada',
         'codigo_sede' => $codigo_sede,
         'codigo_ciudad' => $codigo_ciudad,
         'codigo_pais' => $codigo_pais,
         'codigo_sede_anterior' => $codigo_sede_anterior,
         'codigo_ciudad_anterior' => $codigo_ciudad_anterior,
         'codigo_pais_anterior' => $codigo_pais_anterior,
         'nombre_sede' => $nombre_sede,
         'nombre_ciudad' => $separado[2],
         'direccion_sede' => $direccion_sede,
         'telefono_sede' => $telefono_sede
        )
        );
  }

    /*echo "No son iguales";
    $validar = $ciudad->validar();
      $respuesta = $sede->getValidar();
      $longitud = sizeof($respuesta);
      $resultado = array();

      if($longitud >= 1){
        for($i=0;$i<$longitud;$i++){
          $resultado[$i] = $respuesta[$i];
       }}*/

       /*$resultado = array(
        0 => array (
          'respuesta'=>'NO SON IGUALES',
          
        )
        );*/


      
   
   echo json_encode($resultado, JSON_UNESCAPED_UNICODE);

  }

  else if($accion == "borrar"){

    $codigo_pais = $_GET['codigo_pais'];
    $codigo_sede = $_GET['codigo_sede'];
    $codigo_ciudad = $_GET['codigo_ciudad'];

    $sede = new Sede($codigo_sede,$codigo_pais,$codigo_ciudad,"","",""); 
    $rows = $sede->borrar();
    $resultado = array(
      0 => array (
        'respuesta'=>'correcto',
        
      ));
    echo json_encode(array('data'=>$resultado,JSON_UNESCAPED_UNICODE));

  }

 }

?>