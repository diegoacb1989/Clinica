
<?php 

if ( 0 < $_FILES['file']['error'] ) {
    $resultado = array(
        0 => array (
          'respuesta'=>'incorrecto',
          'error' => $_FILES['file']['error'],
         )
        );
        echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
}
else {
    $ruta = "../../Recursos/imgProductos/";
    move_uploaded_file($_FILES['file']['tmp_name'],$ruta.$_FILES['file']['name']);
    $resultado = array(
        0 => array (
          'respuesta'=>'correcto',
         )
        );
        echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
}



?>