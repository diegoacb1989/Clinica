<?php 
  include '../../Modelo/Pais/Pais.php';
  
  if(isset($_GET['accion'])){
   
    $accion = $_GET['accion'];
    if($accion == "nuevo"){
     $codigo = $_GET['codigo'];
     $nombre =  $_GET['nombre'];
     $descripcion =  $_GET['descripcion'];
     $pais = new Pais($codigo,$nombre,$descripcion);
     $pais->validarPais();   
     $respuesta = $pais->getValidar();
     $longitud = sizeof($respuesta);
     $resultado = array();
   

     if($longitud >= 1){
      for($i=0;$i<$longitud;$i++){
        $resultado[$i] = $respuesta[$i];
      }
     }else{//TODO ESTA CORRECTO
       $sql = $pais->nuevo();
       if($sql == 1){

        $respuesta = array(
          0 => array (
            'respuesta'=>'correcto',
            'accion' => 'registrado'
           )
          );
       }
     }


     echo json_encode(array('data'=>$respuesta),JSON_UNESCAPED_UNICODE);
      
    }
    
    else if($accion == "listar"){
      $pais = new Pais("","","");
      $rows = $pais->lista();
      echo json_encode(array('data'=>$rows), JSON_UNESCAPED_UNICODE);
    }

    else if($accion == "consultar"){
      $codigo = $_GET['codigo'];
      $pais = new Pais($codigo,"","");
      $resultado = $pais->consultar();
      echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
    } 

    else if($accion == "editar"){
     $nombre = $_GET['nombre'];
     $codigo = $_GET['codigo'];
     $descripcion = $_GET['descripcion'];
     $codigoAnterior = $_GET['codigoAnterior'];
     $pais = new Pais($codigo,$nombre,$descripcion);
     $resultado = array();
     if($codigo == $codigoAnterior){//EL CODIGO NUEVO ES IGUAL AL QUE TENIA ANTES POR ENDE SOLO SE VALIDA EL NOMBRE Y DESCRIPCION
       
      $pais->validarPaisDos();   
      $respuesta = $pais->getValidar();
      $longitud = sizeof($respuesta);

      for($i=0;$i<$longitud;$i++){
        $resultado[$i] = $respuesta[$i];
      }

     }else{//SE VALIDA TODO
       
      $pais->validarPais();   
      $respuesta = $pais->getValidar();
      $longitud = sizeof($respuesta);

      for($i=0;$i<$longitud;$i++){
        $resultado[$i] = $respuesta[$i];
      }

     }


     if($longitud < 1){
      $pais->setCodigoAnte($codigoAnterior);
      $sql = $pais->editar();
      $resultado = array(
        0 => array (
          'respuesta'=>'correcto',
          'accion' => 'actualizado',
          'codigo' => $codigo,
          'codigoAnterior' => $codigoAnterior,
          'nombre' => $nombre,
          'descripcion' => $descripcion
         )
        );

     }
     echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
    }//ACTUALIZAR
    
    else if($accion == "borrar"){
      $codigo = $_GET['codigo'];
      $pais = new Pais($codigo,"",""); 
      $pais->borrar();
      $resultado = array(
        0 => array (
          'respuesta'=>'correcto',
         )
        );
        echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
    }
    
  }

?>