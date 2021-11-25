
<?php 
 include_once '../../Modelo/Proveedor/proveedor.php';
  if(isset($_GET['accion'])){

    $accion = $_GET['accion'];

    if($accion == 'nuevo'){
     $nombre = $_GET['nombre'];
     $descripcion = $_GET['descripcion'];
     $direccion = $_GET['direccion'];
     $telefono = $_GET['telefono'];
     $proveedor = new Proveedor("",$nombre,$descripcion,$direccion,$telefono);
     $proveedor->validar();   
     $respuesta = $proveedor->getValidar();
     $longitud = sizeof($respuesta);
     $resultado = array();
     if($longitud >= 1){
   
     }else{
        $proveedor->nuevo();
        $rows = $proveedor->obtenerUltimocodigo();
        $id_proveedor = count($rows);
        $respuesta = array(
            0 => array (
              'respuesta'=>'correcto',
              'accion' => 'Registrado',
              'id_proveedor' => $id_proveedor,
              'nombre' => $nombre,
              'descripcion' => $descripcion,
              'direccion' => $direccion,
              'telefono' => $telefono
             )
            );

     }

     echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

    }else if($accion == "listar"){

        $proveedor = new Proveedor("","","","","");
        $rows = $proveedor->lista();
        echo json_encode($rows,JSON_UNESCAPED_UNICODE);

    }

    else if($accion == "consultar"){
        $id_proveedor = $_GET['id_proveedor'];
        $proveedor = new Proveedor($id_proveedor,"","","","");
        $rows = $proveedor->consultar();
        echo json_encode(array('data'=>$rows), JSON_UNESCAPED_UNICODE);

    }

    else if($accion == "editar"){

      $nombre = $_GET['nombre'];
      $descripcion = $_GET['descripcion'];
      $direccion = $_GET['direccion'];
      $telefono = $_GET['telefono'];
      $id_proveedor = $_GET['id_proveedor'];
      $proveedor = new Proveedor($id_proveedor,$nombre,$descripcion,$direccion,$telefono);
      $proveedor->validar();   
      $respuesta = $proveedor->getValidar();
      $longitud = sizeof($respuesta);
      $resultado = array();
      if($longitud >= 1){
   
      }else{
         $proveedor->editar();
         $respuesta = array(
             0 => array (
               'respuesta'=>'correcto',
               'accion' => 'Actualizado',
               'id_proveedor' => $id_proveedor,
               'nombre' => $nombre,
               'descripcion' => $descripcion,
               'direccion' => $direccion,
               'telefono' => $telefono
              )
             );
 
      }

      echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

  }

    else if($accion == "borrar"){
    $id_proveedor = $_GET['id_proveedor'];
    $proveedor = new Proveedor($id_proveedor,"","","","");
    $rows = $proveedor->borrar();
    echo json_encode(array('data'=>$rows), JSON_UNESCAPED_UNICODE);
}



  }

?>