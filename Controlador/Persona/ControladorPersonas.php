
<?php 

 include '../../Modelo/Personas/Persona.php';
 include '../../Controlador/Persona/Emcriptar.php';
 include '../../Controlador/Persona/Session.php';
 include '../../Modelo/Personas/Administrador.php';

  if(isset($_GET['accion'])){
   $personas = new Persona("","","","","","","","","","","");

   if($_GET['accion'] == "listar"){
    $administrador = new Administrador("","","","","","","","","","","");
    $rol = $_GET['rol'];
    $rows = $administrador->listar($rol);
    echo json_encode(array('data'=>$rows,JSON_UNESCAPED_UNICODE));
   }

   if($_GET['accion'] == "contar"){
    $rows = $personas->contar();
    $respuesta = array(
     "cantidad" => $rows
    );
    echo json_encode($respuesta);

   } //LOGIN

   else if($_GET['accion'] == "login"){

   $usuario = $_GET['usuario'];
   $password = $_GET['password'];
   //------------------------------------
    $encriptar = new Emcriptar($password);
    $encriptar->setEncriptar();
    $passEncriptado = $encriptar->getResultado();
    //echo $passEncriptado;
   //------------------------------------
   //echo $usuario."<br>".$password;
   $persona = new Persona("","","","","","","","","","","","","");
   $persona->setUsuario($usuario);
   $persona->setContrasena($passEncriptado);
   $rows = $persona->consultar();
   //echo count($rows)."<br>";
   foreach ($rows as $clave => $valor){
     $session = new Session($valor['id_persona'],$valor['nombres'], $valor['apellidos'], $valor['direccion'], $valor['telefono'], $valor['celular'], $valor['correo'], $valor['usuario'], $valor['contrasena'], $valor['rol'], $valor['estado']);
   }
   
   if(count($rows) == 1){
    $respuesta = array(
     'respuesta' => 'correcto',
     'rol' => $_SESSION['rol']
    );
   }else {//ES IGUAL A CERO NO ENCOTRO NADA
    $respuesta = array(
        'respuesta' => 'incorrecto'
    );
   }
   echo json_encode($respuesta);


   }//LOGIN

   else if($_GET['accion'] == "nuevo"){//NUEVO
    $nombres = $_GET['nombres'];
    $apellidos = $_GET['apellidos'];
    $direccion = $_GET['direccion'];
    $telefono = $_GET['telefono'];
    $celular = $_GET['celular'];
    $correo = $_GET['correo'];
    $usuario = $_GET['usuario'];
    $contrasena = $_GET['contrasena'];
    $repContra = $_GET['repContra'];
    $rol = $_GET['rol'];
    $persona = new Administrador("",$nombres, $apellidos, $direccion, $telefono, $celular, $correo, $usuario, $contrasena,$rol,"Activo");
    $validar = $persona->validar($repContra);
    $respuesta = $persona->getValidar();
    $longitud = sizeof($respuesta);
    $resultado = array();

    if($longitud >= 1){
    for($i=0;$i<$longitud;$i++){
      $resultado[$i] = $respuesta[$i];
    }
   }else{

     $encriptar = new Emcriptar($contrasena);
     $encriptar->setEncriptar();
     $contraEncriptada = $encriptar->getResultado();
     $persona->setContrasena($contraEncriptada);
     $sql = $persona->nuevo();

     if($sql == 1){
       $rows = $persona->existeUsuario();
       foreach($rows as $valor){
         $id = $valor['id_persona'];
       }
       $resultado = array(
       0 => array (
         'respuesta'=>'correcto',
         'nombres' => $nombres,
         'apellidos' => $apellidos,
         'correo' => $correo,
         'direccion' => $direccion,
         'telefono' => $telefono,
         'celular' => $celular,
         'usuario' => $usuario,
         'id_persona' => $id
        )
       );
     }
     else $resultado = "incorrecto";
   }
 
    echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
  } //NUEVO

  //CONSULTAR
  else if($_GET['accion'] == "consultar"){
    $id = $_GET['id_persona'];
    //echo "EL id es: ".$id."<br>";
    $administrador = new Administrador("","","","","","","","","","","");
    $administrador->setIdPersona($id);
    $resultado = $administrador->consultarUsuario();
    echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
  }//FINALIZA CONSULTAR

  else if($_GET['accion'] == "editar"){
    $nombres = $_GET['nombresAct'];
    $apellidos = $_GET['apellidosAct'];
    $direccion = $_GET['direccionAct'];
    $telefono = $_GET['telefonoAct'];
    $celular = $_GET['celularAct'];
    $correo = $_GET['correoAct'];
    $id = $_GET['id_persona'];
    $usuarioAnterior = $_GET['usuarioActAnt'];
    $usuarioNuevo = $_GET['usuarioAct'];
    $longitud = 0;
    

    $persona = new Administrador($id,$nombres, $apellidos, $direccion, $telefono, $celular, $correo,$usuarioNuevo,"null","null","Activo");
    if(strcmp($usuarioAnterior,$usuarioNuevo) !== 0){//El usuario nuevo es diferente al anterior se debe validar
      $validar = $persona->validar("null");
      $respuesta = $persona->getValidar();
      $longitud = sizeof($respuesta);
      $resultado = array();
      if($longitud >= 1){
      for($i=0;$i<$longitud;$i++){
        $resultado[$i] = $respuesta[$i];
      }}

    }else{//EL USUARIO QUE ESTAN EN EL CAMPO NO CAMBIO, NO ES NESECARIO VALIDARLO
      $validar = $persona->validar2("null");
      $respuesta = $persona->getValidar();
      $longitud = sizeof($respuesta);
      $resultado = array();
      if($longitud >= 1){
      for($i=0;$i<$longitud;$i++){
        $resultado[$i] = $respuesta[$i];
      }}
    }

    if($longitud < 1){
     $sql =  $persona->editar();//EL METODO UPDATE RETORNA 1 SI SE CAMBIA AL MENOS UN DATO, SINO LOS DATOS ACTUALIZADOS SON LOS MISMO, RETORNA CERO
        $resultado = array(
        0 => array (
          'respuesta'=>'correcto',
          'nombres' => $nombres,
          'apellidos' => $apellidos,
          'correo' => $correo,
          'direccion' => $direccion,
          'telefono' => $telefono,
          'celular' => $celular,
          'id_persona' => $id,
          'usuario_nuevo'=> $usuarioNuevo,
          'usuario_viejo' => $usuarioAnterior
         )
        );


    }

    //echo "Usuario nuevo: ".$usuarioNuevo." usuario viejo: ".$usuarioAnterior."<br>";

  
    echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
   }//EDITAR
  
   else if($_GET['accion'] == "borrar"){
    $codigo = $_GET['id_persona'];
    $administrador = new Administrador($codigo,"","","","","","","","","","");
     $administrador->elimilar();
    $resultado = array(
      0 => array (
        'respuesta'=>'correcto',
       )
      );
      echo json_encode($resultado);
   }

   else if($_GET['accion'] == "consultarSession"){
    $id = $_SESSION['id_persona'];
    //echo "EL id es: ".$id."<br>";
    $administrador = new Administrador("","","","","","","","","","","");
    $administrador->setIdPersona($id);
    $resultado = $administrador->consultarUsuario();
    echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
  }//FINALIZA CONSULTAR

  else if($_GET['accion'] == "editarDos"){
    $nombres = $_GET['nombresAct'];
    $apellidos = $_GET['apellidosAct'];
    $direccion = $_GET['direccionAct'];
    $telefono = $_GET['telefonoAct'];
    $celular = $_GET['celularAct'];
    $correo = $_GET['correoAct'];
    $id = $_GET['id_persona'];
    $usuarioAnterior = $_GET['usuarioActAnt'];
    $usuarioNuevo = $_GET['usuarioAct'];
    $longitud = 0;
    

    $persona = new Administrador($id,$nombres, $apellidos, $direccion, $telefono, $celular, $correo,$usuarioNuevo,"null","null","Activo");
    if(strcmp($usuarioAnterior,$usuarioNuevo) !== 0){//El usuario nuevo es diferente al anterior se debe validar
      $validar = $persona->validar("null");
      $respuesta = $persona->getValidar();
      $longitud = sizeof($respuesta);
      $resultado = array();
      if($longitud >= 1){
      for($i=0;$i<$longitud;$i++){
        $resultado[$i] = $respuesta[$i];
      }}

    }else{//EL USUARIO QUE ESTAN EN EL CAMPO NO CAMBIO, NO ES NESECARIO VALIDARLO
      $validar = $persona->validar2("null");
      $respuesta = $persona->getValidar();
      $longitud = sizeof($respuesta);
      $resultado = array();
      if($longitud >= 1){
      for($i=0;$i<$longitud;$i++){
        $resultado[$i] = $respuesta[$i];
      }}
    }

    if($longitud < 1){
     $sql =  $persona->editar();//EL METODO UPDATE RETORNA 1 SI SE CAMBIA AL MENOS UN DATO, SINO LOS DATOS ACTUALIZADOS SON LOS MISMO, RETORNA CERO
        $resultado = array(
        0 => array (
          'respuesta'=>'correcto',
          'nombres' => $nombres,
          'apellidos' => $apellidos,
          'correo' => $correo,
          'direccion' => $direccion,
          'telefono' => $telefono,
          'celular' => $celular,
          'id_persona' => $id,
          'usuario_nuevo'=> $usuarioNuevo,
          'usuario_viejo' => $usuarioAnterior
         )
        );


    }

    //echo "Usuario nuevo: ".$usuarioNuevo." usuario viejo: ".$usuarioAnterior."<br>";

  
    echo json_encode(array('data'=>$resultado), JSON_UNESCAPED_UNICODE);
   }//EDITAR
 

  }


?>