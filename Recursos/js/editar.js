//alert("Editar");

$(document).ready(function(){
  //var id_persona = getParameterByName('id_persona');
  
    $.ajax({
     type:"get",
     url:"../../Controlador/Persona/ControladorPersonas.php?accion=consultarSession",
     data: {accion:'consultarSession'},
     dataType:"json"
   }).done(function( resultado ) {   
     console.log("VALIDACION "+resultado.data);
     $("#nombresAct").val(resultado.data[0].nombres);
     $("#apellidosAct").val(resultado.data[0].apellidos);
     $("#direccionAct").val(resultado.data[0].direccion);
     $("#telefonoAct").val(resultado.data[0].telefono);
     $("#celularAct").val(resultado.data[0].celular);
     $("#correoAct").val(resultado.data[0].correo);
     $("#usuarioActAnt").val(resultado.data[0].usuario);
     $("#usuarioAct").val(resultado.data[0].usuario);
     
     $("#id_persona").val(resultado.data[0].id_persona);
     $("#usuarioActAnt").val(resultado.data[0].usuario);
    });

    $("#btnAct").click(function(){
      //alert("Actualizar");
      var datos = $("#formActualizar").serialize();
      //alert(datos);
      console.log(datos);
      $.ajax({
        type:"get",
        url:"../../Controlador/Persona/ControladorPersonas.php",
        data: datos,
        dataType:"json"
      }).done(function( resultado ) {   
        console.log("VALIDACION "+resultado.data);
        if(resultado.data[0].respuesta == "correcto"){
          Swal.fire(
            'Actualizacion',
            'Datos actualizados satisfactoriamente',
            'success'
          );
        }
       });

    });


});