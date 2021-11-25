
<?php 

 include_once '../../Modelo/Cita/Cita.php';
 if(isset($_GET['accion'])){
  $accion = $_GET['accion'];

  $cita = new Cita("","","","","","");
  if($accion == "nuevo"){
   $fecha = $_GET['fecha'];
   $descripcion = $_GET['descripcion'];
   $selectMedico = $_GET['selectMedico'];
   $selectPaciente = $_GET['selectPaciente'];
   $tipo = $_GET['tipo2'];

   $separadoMedico = explode("-",$selectMedico);
   $separadoPaciente = explode("-",$selectPaciente);

   $IdPaciente = $separadoPaciente[0];
   $nombrePaciente = $separadoPaciente[1];
   $apellidoPaciente = $separadoPaciente[2];

   $IdMedico = $separadoMedico[0];
   $nombreMedico = $separadoMedico[1];
   $apellidoMedico = $separadoMedico[2];

   /*echo "CODIGOS ".$IdMedico."-".$IdPaciente."<BR>";
   echo "NOMBRES ".$nombreMedico."-".$nombrePaciente."<BR>";
   echo "APELLIDOS ".$apellidoPaciente."-".$apellidoMedico."<BR>";*/

   $cita = new Cita($IdPaciente,$IdMedico,"",$descripcion,$fecha,$tipo);

   $cita->validar();   
   $respuesta = $cita->getValidar();
   $longitud = sizeof($respuesta);
   $resultado = array();
 

   if($longitud >= 1){
    for($i=0;$i<$longitud;$i++){
      $resultado[$i] = $respuesta[$i];
    }
   }else{

    $cita->nuevo();
    $rows = $cita->obtenerUltimocodigo();
    $id_cita = count($rows);
    $resultado = array(

        0 => array (
          'respuesta'=>'correcto',
          'accion' => 'registrada',
          'id_cita' => $id_cita,
          'id_paciente' => $IdPaciente,
          'id_medico' => $IdMedico,
          'fecha' => $fecha,
          'descripcion' => $descripcion,
          "nombre_medico" => $nombreMedico." ".$apellidoMedico,
          "nombre_paciente" => $nombrePaciente." ".$apellidoPaciente
         )
        );

   }
   echo json_encode(array('data'=>$resultado),JSON_UNESCAPED_UNICODE);

  }

  else if($accion  == "listar"){
    $tipo = $_GET['tipo2'];
    $cita = new Cita("","","","","",$tipo);
    $rows = $cita->lista();
    //echo "Tipo: ".$tipo;
    echo json_encode($rows,JSON_UNESCAPED_UNICODE);
   }

   else if($accion  == "consultar"){
    $id_cita = $_GET['id_cita'];
    $cita = new Cita("","",$id_cita,"","","");
    $rows = $cita->consultar();
    //echo "Tipo: ".$tipo;
    echo json_encode($rows,JSON_UNESCAPED_UNICODE);
   }

   else if($accion  == "editar"){

    $fecha = $_GET['fecha'];
    $descripcion = $_GET['descripcion'];
    $selectMedico = $_GET['selectMedico'];
    $selectPaciente = $_GET['selectPaciente'];
    //$tipo = $_GET['tipo2'];
 
    $separadoMedico = explode("-",$selectMedico);
    $separadoPaciente = explode("-",$selectPaciente);
 
    $IdPaciente = $separadoPaciente[0];
    $nombrePaciente = $separadoPaciente[1];
    $apellidoPaciente = $separadoPaciente[2];
 
    $IdMedico = $separadoMedico[0];
    $nombreMedico = $separadoMedico[1];
    $apellidoMedico = $separadoMedico[2];
    $id_cita = $_GET['id_cita'];

    $cita = new Cita($IdPaciente,$IdMedico,$id_cita,$descripcion,$fecha,"");

    $cita->validar();   
    $respuesta = $cita->getValidar();
    $longitud = sizeof($respuesta);
    $resultado = array();
 

   if($longitud >= 1){
    for($i=0;$i<$longitud;$i++){
      $resultado[$i] = $respuesta[$i];
    }
   }else{

    $cita->editar();
    $resultado = array(

        0 => array (
          'respuesta'=>'correcto',
          'accion' => 'Actualizada',
          'id_cita' => $id_cita,
          'id_paciente' => $IdPaciente,
          'id_medico' => $IdMedico,
          'fecha' => $fecha,
          'descripcion' => $descripcion,
          "nombre_medico" => $nombreMedico." ".$apellidoMedico,
          "nombre_paciente" => $nombrePaciente." ".$apellidoPaciente
         )
        );
   }

   echo json_encode(array('data'=>$resultado),JSON_UNESCAPED_UNICODE);


   }//EDITAR

   else if($accion  == "borrar"){
    $id_cita = $_GET['id_cita'];
    $cita = new Cita("","",$id_cita,"","","");
    $rows = $cita->borrar();
    //echo "Tipo: ".$tipo;
    echo json_encode($rows,JSON_UNESCAPED_UNICODE);
   }


 }
  
?>