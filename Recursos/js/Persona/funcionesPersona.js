
$(document).ready(function(){ 
  var rol = $("#rol").val();
  //alert("Funciones del: " + rol);
  
  dt = $("#tabla").DataTable({
    "columns": [
        { "data": "nombres" },
        { "data": "apellidos" },
        { "data": "correo" },
        { "data": "direccion"} ,
        { "data": "telefono" },
        { "data": "celular" },
        { "data": "usuario" },
        {"data":"elimilar"},
        {"data":"actualizar"},     
    ],
    "columnDefs":[{
      "targets":-1,
      "data":null,

    }] 

});

//------------------------------------------------------------------------
  $.ajax({
    type:"get",
    url:"../../Controlador/Persona/ControladorPersonas.php",
    data: {accion:'listar',rol:rol},
    dataType:"json"
  }).done(function( resultado ) {   
    vectorDatos = resultado;
  
    console.log("------------------------------")
    //----------------------------------------------------------------------
     console.log(resultado.data);    
     $("#totDirec").text("Total de: " + rol + " " + resultado.data.length);
     for(var i=0;i<resultado.data.length;i++){
      dt.row.add(
        {
          nombres:resultado.data[i].nombres,
          apellidos:resultado.data[i].apellidos,
          correo:resultado.data[i].correo,
          direccion:resultado.data[i].direccion,
          telefono:resultado.data[i].telefono,
          celular:resultado.data[i].celular,
          usuario:resultado.data[i].usuario,
          elimilar: '<button type="button" data-codigo="'+ resultado.data[i].id_persona + 
          '"  class="btn btn-link elimilar"><i class="fa fa-trash"></i></button>',
          actualizar: '<button type="button" data-codigo="'+ resultado.data[i].id_persona + 
          '" class="btn btn-link editar" data-toggle="modal" data-target="#modalActualizar" ><i class="fa fa-edit"></i></button>'
        }
       ).draw(true);
     }
    
  });//INSERTAR DATOS AL LA TABLA


  $.ajax({
    type:"get",
    url:"../../Controlador/Persona/ControladorPersonas.php?accion=contar",
    data: {accion:'contar'},
    dataType:"json"
  }).done(function( resultado ) {   
    $("#totPar").text("Total de usuarios: " +  resultado.cantidad);
    console.log("-------------------------------------------");
    console.log("Total de usuarios: " + resultado.cantidad)
    console.log("-------------------------------------------");
    //----------------------------------------------
     
  });//Contar

  


//-----------------------------------------------------------------------------------
  $("#btnRegistrar").click(function(){//INSERTAR NUEVO DIRECTOR DE SEDE
    var datos = $("#formPersona").serialize();
    //alert("Datos serializados" + datos);
    $.ajax({
      type:"get",
      url:"../../Controlador/Persona/ControladorPersonas.php",
      data:datos,
      dataType:"json"
    }).done(function(resultado) {   
      console.log(resultado);
      console.log("Respuesta: " + resultado.data[0].respuesta);
      if(resultado.data[0].respuesta == 'correcto'){//CORRECTO
        //alert("datos correctos");
        Swal.fire(
          rol,
          rol + ' registrado satisfactoriamente',
          'success'
        );
        $("#exampleModal").modal("hide");
        dt.row.add(
          {
            nombres:resultado.data[0].nombres,
            apellidos:resultado.data[0].apellidos,
            correo:resultado.data[0].correo,
            direccion:resultado.data[0].direccion,
            telefono:resultado.data[0].telefono,
            celular:resultado.data[0].celular,
            usuario:resultado.data[0].usuario,
            elimilar: '<button type="button" data-codigo="'+ resultado.data[0].id_persona + 
            '"  class="btn btn-link elimilar"><i class="fa fa-trash"></i></button>',
            actualizar: '<button type="button" data-codigo="'+ resultado.data[0].id_persona + 
          '" class="btn btn-link editar" data-toggle="modal" data-target="#modalActualizar" ><i class="fa fa-edit"></i></button>'
          }
         ).draw(true);
      }

      //INCORRECTO
      else if(resultado.data == 'incorrecto'){
        Swal.fire(
          'Error de base de datos',
          'Por favor contactate con el proveedor del aplicativo',
          'error'
        );
      }
      else{//ERRORES DE FORMULARIO
        var texto = "";
        texto =  resultado.data[0];
        for (var i = 1; i < resultado.data.length; i++) {
          texto =  texto + ",\n" + resultado.data[i];
       }
       Swal.fire(
        'Error en el formulario',
        texto,
        'error'
      );
       //console.log(texto);
      }

      
      

    });

  });//FINALIZA INSERTAR NUEVO REGISTRO CON SU ROL
 //-------------------------------------


  $(document).on("click",".editar",function(){//traer datos para mostrar en el formulario editar
   var codigo = $(this).data("codigo");
   //alert("BOTON EDITAR DIRECTOR DE SEDE PRESIONADO: " + codigo);
   $("#id_persona").val(codigo);
   $.ajax({
    type:"get",
    url:"../../Controlador/Persona/ControladorPersonas.php",
    data: {accion:'consultar',id_persona:codigo},
    dataType:"json"
  }).done(function( resultado ) {   
    console.log(resultado.data);
    $("#nombresAct").val(resultado.data[0].nombres);
    $("#apellidosAct").val(resultado.data[0].apellidos);
    $("#direccionAct").val(resultado.data[0].direccion);
    $("#telefonoAct").val(resultado.data[0].telefono);
    $("#celularAct").val(resultado.data[0].celular);
    $("#correoAct").val(resultado.data[0].correo);
    $("#usuarioActAnt").val(resultado.data[0].usuario);
    $("#usuarioAct").val(resultado.data[0].usuario);
    
  });

  });
   //ACTUALIZAR DATOS
   $("#btnAct").click(function(e){
    var datos = $("#formActualizar").serialize();
    //alert("Datos: " + datos);
    $.ajax({
      type:"get",
      url:"../../Controlador/Persona/ControladorPersonas.php",
      data: datos,
      dataType:"json"
    }).done(function( resultado ) {   
      //console.log("datos: " + resultado.data[0].id_persona);
      console.log("--------Resultado de actualizacion-------");
      console.log(resultado.data);
      console.log("-----------------------------------------");
      if(resultado.data[0].respuesta == 'correcto'){
        Swal.fire(
          'Director de sede',
          'El ' + rol + resultado.data[0].nombres + ', se actualizo satisfactoriamente',
          'success'
        );
        var usuarioAnterior = resultado.data[0].usuario_viejo;
        ActualizarElimilarRegistro(usuarioAnterior,resultado,0);
        $("#modalActualizar").modal("hide");


      }//CORRECTO
      else{

        var texto = "";
        texto =  resultado.data[0];
        for (var i = 1; i < resultado.data.length; i++) {
          texto =  texto + ",\n" + resultado.data[i];
       }
       Swal.fire(
        'Error en el formulario',
        texto,
        'error'
      );
       //console.log(texto);

      }

    });//

   });//FINALIZA LA ACTUALIZACION DE DATOS

   //ELIMILAR FILA
   
   $(document).on("click",".elimilar",function(){//traer datos para mostrar en el formulario editar
    var codigo = $(this).data("codigo");
    $.ajax({
      type:"get",
      url:"../../Controlador/Persona/ControladorPersonas.php",
      data: {accion:'consultar',id_persona:codigo},
      dataType:"json"
    }).done(function( resultado){
      console.log("Registro a elimilar: "+resultado.data[0].nombres.toString());

      
      swal({
        title: '¿Está seguro?',
        text: "¿Realmente desea borrar el : " + rol + " " + resultado.data[0].nombres.toString()  + " ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Borrarlo!'
  }).then((decision) => {
          if (decision.value) {

            $.ajax({
              type:"get",
              url:"../../Controlador/Persona/ControladorPersonas.php",
              data: {accion:'borrar',id_persona:codigo},
              dataType:"json"
            }).done(function(request) {   
             
              swal(
                'Borrado!',
                'El: ' +  rol + ": " + resultado.data[0].nombres.toString() +  ' fue borrado',
                'success'
               );
              //--------------------------------------------------------------------------------
              console.log("Usuario a buscar para, elimilar: "+resultado.data[0].usuario.toString())
              ActualizarElimilarRegistro(resultado.data[0].usuario.toString(),null,1);
            });//INSERTAR D


          }else{
            swal(
              'Cancelado!',
              'El ' + rol + ", no fue elimilado",
              'warning'
             );

          }
  });

      
        

    });
 
   });

   



   function ActualizarElimilarRegistro(usuarioAnterior,resultado,accion){
      dt.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
        //console.log("Usuario :" + usuarioAnterior + " es igual a: " + this.data().usuario);

        if(usuarioAnterior == this.data().usuario){
          //console.log("Se encontro el usuario el indice: " + rowIdx);
          if(accion == 0)//SE DEBE ACTUALIZAR
          {
          dt.row(rowIdx).data(
          {
              "nombres":resultado.data[0].nombres,
              "apellidos":resultado.data[0].apellidos,
              "correo":resultado.data[0].correo,
              "direccion":resultado.data[0].direccion,
              "telefono":resultado.data[0].telefono,
              "celular":resultado.data[0].celular,
              "usuario":resultado.data[0].usuario_nuevo,
              "elimilar": '<button type="button" data-codigo="'+ resultado.data[0].id_persona + 
              '"  class="btn btn-link elimilar"><i class="fa fa-trash"></i></button>',
              "actualizar" : '<button type="button" data-codigo="'+ resultado.data[0].id_persona + 
              '" class="btn btn-link editar" data-toggle="modal" data-target="#modalActualizar" ><i class="fa fa-edit"></i></button>'
            }         
          );
          }

          else{
            //elimilar
            dt.row(rowIdx).remove().draw();
          }

        }
        

    } );
  }
     
});
