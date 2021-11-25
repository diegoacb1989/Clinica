<?php 

   include '../../Modelo/Nomina/Nomina.php';
   include '../../Modelo/Personas/Persona.php';
   
 if(isset($_GET['accion'])){
  $accion = $_GET['accion'];

  if($accion == "nuevo"){
   
    $salarioBasico = $_GET['salarioBasico'];
    $cantiHorExt = $_GET['cantiHorExt'];
    $valHhrExtra = $_GET['valHhrExtra'];
    $fecha = $_GET['fecha'];
    $selectEmpleado = $_GET['selectEmpleado'];

    $nomina = new Nomina($selectEmpleado,"",$salarioBasico,$valHhrExtra,$cantiHorExt,$fecha);
    $validar = $nomina->validar();
    $respuesta = $nomina->getValidar();
    $longitud = sizeof($respuesta);
    $resultado = array();
 
    if($longitud >= 1){
     for($i=0;$i<$longitud;$i++){
      $resultado[$i] = $respuesta[$i];
    }}else{
       $nomina->nuevo();
       $rows = $nomina->obtenerUltimocodigo();
       $id_nomina = count($rows);
       $s_total = $nomina->getS_total();
       $persona = new Persona($selectEmpleado,"","","","","","","","","","","");
       $rows = $persona->consultarUsuario();

       foreach ($rows as  $valor){
        //echo $valor['id_persona']." ".$valor['nombres']."<br>";
        $nombre = $valor['nombres'];
       }

        $resultado = array(
            0 => array (
              'respuesta'=>'correcto',
              'accion' => 'Registrada',
              'id_nomina' => $id_nomina,
              'id_empleado' => $selectEmpleado,
              'nombre_empleado' => $nombre,
              'salario_basico' => $salarioBasico,
              'can_horario_extra' => $cantiHorExt,
              'valor_horario_extra' => $valHhrExtra,
              'fecha' => $fecha,
              's_total' => $s_total
             )
            );

    }
   echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
  }else if($accion == "listar"){

   $nomina = new Nomina("","","","","","");
   $rows = $nomina->lista();
   echo json_encode(array('data'=>$rows), JSON_UNESCAPED_UNICODE);

  }

  else if($accion == "consultar"){
    $codigoEmpleado = $_GET['codigoEmpleado'];
    $codigoNomina = $_GET['codigoNomina'];
    $nomina = new Nomina($codigoEmpleado,$codigoNomina,"","","","");
    $rows = $nomina->consultar();
    echo json_encode(array('data'=>$rows), JSON_UNESCAPED_UNICODE);
    

   }else if($accion == "editar"){

    $salarioBasico = $_GET['salarioBasico'];
    $cantiHorExt = $_GET['cantiHorExt'];
    $valHhrExtra = $_GET['valHhrExtra'];
    $fecha = $_GET['fecha'];
    $selectEmpleado = $_GET['selectEmpleado'];
    $id_empleado = $_GET['id_empleado'];//ID EMPLEADO ANTERIOR
    $id_nomina = $_GET['id_nomina'];


    $nomina = new Nomina($selectEmpleado,$id_nomina,$salarioBasico,$valHhrExtra,$cantiHorExt,$fecha);
    $validar = $nomina->validar();
    $respuesta = $nomina->getValidar();
    $longitud = sizeof($respuesta);
    $resultado = array();

    if($longitud >= 1){
      for($i=0;$i<$longitud;$i++){
       $resultado[$i] = $respuesta[$i];
     }}else{
        $nomina->setid_empleadoAnterior($id_empleado);
        $nomina->editar();
        $s_total = $nomina->getS_total();
        $persona = new Persona($selectEmpleado,"","","","","","","","","","","");
        $rows = $persona->consultarUsuario();
 
        foreach ($rows as  $valor){
         //echo $valor['id_persona']." ".$valor['nombres']."<br>";
         $nombre = $valor['nombres'];
        }
 
         $resultado = array(
             0 => array (
               'respuesta'=>'correcto',
               'accion' => 'Actualizada',
               'id_nomina' => $id_nomina,
               'id_empleado' => $selectEmpleado,
               'nombre_empleado' => $nombre,
               'salario_basico' => $salarioBasico,
               'can_horario_extra' => $cantiHorExt,
               'valor_horario_extra' => $valHhrExtra,
               'fecha' => $fecha,
               's_total' => $s_total
              )
             );
 
     }
    echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);



  }//----------------------------------------------
  else if($accion == "borrar"){

    $codigoEmpleado = $_GET['codigoEmpleado'];
    $codigoNomina = $_GET['codigoNomina'];
    $nomina = new Nomina($codigoEmpleado,$codigoNomina,"","","","");
    $rows = $nomina->borrar();

    echo json_encode(array('data'=>$rows), JSON_UNESCAPED_UNICODE);
 
   }



 }


?>