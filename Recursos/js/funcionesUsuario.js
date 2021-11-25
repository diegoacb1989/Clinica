
function usuario(){
 $("#ingresar").on("click",function(){
    var datos = $("#login-form").serialize();
    //alert("datos serializados " + datos);
    var usuario = $("#usuario").val();
    var password = $("#password").val();
    if(usuario != "" &&  password != ""){
     //alert("Campos llenos");
     console.log("Datos llenos");
     $.ajax({
      type:"get",
      url:"./Controlador/Persona/ControladorPersonas.php",
      data: datos,
      dataType:"json"
    }).done(function( resultado ) {
      //alert("Respuesta: " + resultado.respuesta);
       if(resultado.respuesta == "correcto"){
          var url = "";
          console.log('Rol:' + resultado.rol);
          if(resultado.rol == "Administrador")url = "./Vista/admin/";  
          else if(resultado.rol == "Director_Sede")url = "./Vista/Director/";
          else if(resultado.rol == "Empleado")url = "./Vista/Empleado/";
          else if(resultado.rol == "Asesor_Afiliacion")url = "./Vista/Asesor/";
          console.log("Rol: " + resultado.rol);
          console.log("Url: " + url);
        swal({
          title: "Usuario correcto",
          text: "Bienvenido señor: " + resultado.rol,
          type: "success"
          }).then(function() {
           window.location= url;
          });
        
       }else if(resultado.respuesta == "incorrecto"){
        Swal.fire(
          'Usuario y/o contraseña incorrecta',
          'Error de session',
          'error'
        )
       }
       
  });

    }else{
      Swal.fire(
          'Debes llenar los campos vacios',
          'Advertencia de campos',
          'warning'
      )
    }

 });
}