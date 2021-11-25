$(document).ready(function(){
  $("#selectMedico").empty();
    $("#selectPaciente").empty();
  dt = $("#tabla").DataTable({
    "columns": [
        {"data": "codigo" },
        {"data":"nombre_paciente"},
        { "data": "nombre_medico"},
        { "data": "fecha"},
        { "data": "descripcion" },
        {"data":"elimilar"},
        {"data":"actualizar"},     
    ],
    "columnDefs":[{
      "targets":-1,
      "data":null,
  
    }] 
  
  });
  var tipo = $("#tipo").val();
  console.log("Tipooooooooo:  "+$("#tipo").val());
  $.ajax({
    type:"get",
    url:"../../Controlador/Cita/ControladorCita.php?accion=listar",
    data: {accion:'listar',tipo2:$("#tipo").val()},
    dataType:"json"
  }).done(function( resultado ) {   
    console.log("------------------------------")
    //----------------------------------------------------------------------

     console.log("Longitud "+resultado.length); 
     for(var i=0;i<resultado.length;i++){
      dt.row.add(
        {
          codigo:resultado[i].id_cita,
          nombre_paciente:resultado[i].nombres_paciente + " " + resultado[i].apellidos_paciente,
          nombre_medico:resultado[i].nombres_medico + " " + resultado[i].apellidos_paciente,
          fecha:resultado[i].fecha,
          descripcion:resultado[i].descripcion,
          elimilar: '<button type="button" data-codigo="'+ resultado[i].id_cita + 
          '" data-paciente="'+ resultado[i].id_paciente + 
          '" data-medico="'+ resultado[i].id_medico + 
          '"   class="btn btn-link elimilar" data-toggle="modal" data-target="" ><i class="fa fa-trash"></i></button>',

          actualizar:'<button type="button" data-codigo="'+ resultado[i].id_cita + 
          '" data-paciente="'+ resultado[i].id_paciente + 
          '" data-medico="'+ resultado[i].id_medico + 
          '"   class="btn btn-link editar" data-toggle="modal" data-target="" ><i class="fa fa-edit"></i></button>'
        }
       ).draw(true);

     }

  });
 //----------------------------------------------------------------------------

 //alert("Citas");
 
 //alert("Tipo: " + tipo);
 $("#labelFecha").text("Ingrese fecha de la " + tipo);
 $("#labelDescripcion").text("Ingrese descripcion de la " + tipo);
 $("#labelMedico").text("Ingrese medico de la " + tipo);
 $("#labelPaciente").text("Ingrese paciente de la " + tipo);
 $("#exampleModalLabel").text("Nueva " + tipo);
 $(".modal-title").css('color', '#FFFFFF');
 $(".modal-header").css('background-color', '#617DCF');

 $("#btnAgregar").click(function(){
    //alert("Nuevo");
    $(".modal-title").text("Nueva " + tipo);
    $("#btnCita").text("registrar " + tipo);
    $("#tipo2").val(tipo);
    $("#accion").val("nuevo");
    $("#btnCita").text("Registrar " + tipo);

    limpiar();
    llenarSelectPaciente(-1);
    llenarSelectMedico(-1);
    $("#exampleModal").modal("show");
  });
//---------------------------------------------------------------------------------------

    $(document).on("click",".elimilar",function(){
      var idCita = $(this).data("codigo");
   
      //alert("Codigo cita: " + idCita);

      $.ajax({
        type:"get",
        url:"../../Controlador/Cita/ControladorCita.php",
        data: {accion:"consultar",id_cita:idCita},
        dataType:"json"
      }).done(function(resultado){   
        console.log("------------------------------");
        console.log("Datos: " + resultado.data);
        //-------------------------------------------------------------------------------------------------------
        var descripcion = resultado[0].descripcion;
        swal({
          title: '¿Está seguro?',
          text: "¿Realmente desea borrar la " + tipo + " con la descripcion: " + resultado[0].descripcion + " ?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Borrarlo!'
    }).then((decision) => {
            if (decision.value) {
  
              $.ajax({
                type:"get",
                url:"../../Controlador/Cita/ControladorCita.php",
                data: {accion:'borrar',id_cita:idCita},
                dataType:"json"
              }).done(function(request) {   
               
                swal(
                  'Borrado!',
                  'La ' + tipo + ' con la descripcion ' +  descripcion +  ' fue borrada',
                  'success'
                 );
                //--------------------------------------------------------------------------------
                ActualizarElimilarRegistro(idCita,null,1);
              });//INSERTAR D
  
  
            }else{
              swal(
                'Cancelado!',
                'La ' + tipo + ' con la descripcion ' + descripcion + " no fue elimilada",
                'warning'
               );
  
            }
    });
        
        
    });

    });


//---------------------------------------------------------------------------------------
  $(document).on("click",".editar",function(){//traer datos para mostrar en el formulario editar
    var codigo = $(this).data("codigo");
    var paciente = $(this).data("paciente");
    var medico = $(this).data("medico");
    //alert("Codigo: " + " - " + codigo + " - " + paciente + " - " + medico);
  
    $("#btnCita").text("Actualizar " + tipo);
    
     limpiar();
     llenarSelectPaciente(paciente);
     llenarSelectMedico(medico);

    $.ajax({
      type:"get",
      url:"../../Controlador/Cita/ControladorCita.php",
      data: {accion:"consultar",id_cita:codigo},
      dataType:"json"
    }).done(function(resultado) {   
      
      $("#fecha").val(resultado[0].fecha);
      $("#descripcion").val(resultado[0].descripcion);
      $("#id_cita").val(codigo);
      $("#accion").val("editar");
      $("#id_cita").val(codigo);

    });//Contar

    $("#exampleModal").modal("show");
  
   });


  $("#btnCita").on("click",function(){
    //alert("BTN CITA") 
    var datos = $("#formCita").serialize();
    //alert(datos);
    console.log(datos);
    $.ajax({
      url:"../../Controlador/Cita/ControladorCita.php",
      data:datos,
      dataType:"json"
  }).done(function( resultado ){   
    console.log("------------------------------");
    console.log("Resultado: " + resultado.data);

    if(resultado.data[0].respuesta == "correcto"){

      if(resultado.data[0].accion == "registrada"){
        console.log("" + resultado.data[0].id_cita);
        console.log("" + resultado.data[0].fecha);
        console.log("" + resultado.data[0].descripcion);
        console.log("" + resultado.data[0].nombre_medico);
        console.log("" + resultado.data[0].nombre_paciente);

        dt.row.add(
        {
          codigo:resultado.data[0].id_cita,
          nombre_paciente:resultado.data[0].nombre_paciente,
          nombre_medico:resultado.data[0].nombre_medico,
          fecha:resultado.data[0].fecha,
          descripcion:resultado.data[0].descripcion,
          elimilar: '<button type="button" data-codigo="'+ resultado.data[0].id_cita + 
          '" data-paciente="'+ resultado.data[0].id_paciente + 
          '" data-medico="'+ resultado.data[0].id_medico + 
          '" class="btn btn-link elimilar" data-toggle="modal" data-target="" ><i class="fa fa-trash"></i></button>',

          actualizar:'<button type="button" data-codigo="'+ resultado.data[0].id_cita + 
          '" data-paciente="'+ resultado.data[0].id_paciente + 
          '" data-medico="'+ resultado.data[0].id_medico + 
          '" class="btn btn-link editar" data-toggle="modal" data-target="" ><i class="fa fa-edit"></i></button>',
        }
       ).draw(true);

      }else if(resultado.data[0].accion == "Actualizada"){
         
         ActualizarElimilarRegistro(resultado.data[0].id_cita,resultado,0);
    
      }



      Swal.fire(
        tipo,
        tipo + " " + resultado.data[0].accion + ', satisfactoriamente',
        'success'
      );


    }else{

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


  });//BTN CITA

  function llenarSelectPaciente(idPaciente){

    $.ajax({
        url:"../../Controlador/Persona/ControladorPersonas.php",
        data: {accion:'listar',rol:'Paciente'},
        dataType:"json"
    }).done(function( resultado ){   
      console.log("------------------------------")
      //----------------------------------------------------------------------
       console.log("Paises"+resultado);    
       console.log("Prueba "+resultado.data[0].nombres);  
       $codigoCompuesto = "";
       for(var i=0;i<resultado.data.length;i++){
        $codigoCompuesto = resultado.data[i].id_persona + "-" + resultado.data[i].nombres + "-" + resultado.data[i].apellidos;
        console.log("Validacion "+ "codigo de paciente: " + idPaciente + " = " + resultado.data[i].id_persona);  
         if(idPaciente == resultado.data[i].id_persona){
          console.log("codigos pacientes iguales " + resultado.data[i].id_persona);
          $("#selectPaciente").append("<option selected value='" + $codigoCompuesto +"'>" + resultado.data[i].nombres + " " + resultado.data[i].apellidos + "</option>");
         } 
         else{
          $("#selectPaciente").append("<option value='" + $codigoCompuesto +"'>" + resultado.data[i].nombres + " " + resultado.data[i].apellidos + "</option>");
         }    
       }
    });
  
   }

      function ActualizarElimilarRegistro(idCita,resultado,accion){
        dt.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
          console.log("Cita:" + idCita + " es igual a: " + this.data().codigo);
      
      
          if(idCita == this.data().codigo){
            console.log("Se encontro la cordenada la id cita " + rowIdx);
            if(accion == 0)//SE DEBE ACTUALIZAR
            {
           
              dt.row(rowIdx).data(
                {
                  "codigo":resultado.data[0].id_cita,
                  "nombre_paciente":resultado.data[0].nombre_paciente,
                  "nombre_medico":resultado.data[0].nombre_medico,
                  "fecha":resultado.data[0].fecha,
                  "descripcion":resultado.data[0].descripcion,
                "elimilar": '<button type="button" data-codigo="'+ resultado.data[0].id_cita + 
                  '" data-paciente="'+ resultado.data[0].id_paciente + 
                  '" data-medico="'+ resultado.data[0].id_medico + 
                  '" class="btn btn-link elimilar" data-toggle="modal" data-target="" ><i class="fa fa-trash"></i></button>',

                  "actualizar":'<button type="button" data-codigo="'+ resultado.data[0].id_cita + 
                  '" data-paciente="'+ resultado.data[0].id_paciente + 
                  '" data-medico="'+ resultado.data[0].id_medico + 
                  '" class="btn btn-link editar" data-toggle="modal" data-target="" ><i class="fa fa-edit"></i></button>',
                  }         
                );

            }
      
            else{
              console.log("Elimilar row index: " + rowIdx);
              //elimilar
              dt.row(rowIdx).remove().draw();
            }
      
          }
          
      
      } );
      }//--------------------------

  function llenarSelectMedico(idMedico){

    $.ajax({
      url:"../../Controlador/Persona/ControladorPersonas.php",
      data: {accion:'listar',rol:'Medico'},
      dataType:"json"
  }).done(function( resultado ) {   
    console.log("------------------------------")
    //----------------------------------------------------------------------
     console.log("Paises"+resultado);    
     console.log("Prueba "+resultado.data[0].nombres);  
     for(var i=0;i<resultado.data.length;i++){
      console.log("Validacion "+ "codigo de medico: " + idMedico + " = " + resultado.data[i].id_persona);  
      $codigoCompuesto = resultado.data[i].id_persona + "-" + resultado.data[i].nombres + "-" + resultado.data[i].apellidos;
       if(idMedico == resultado.data[i].id_persona){
        console.log("codigos medico iguales " + resultado.data[i].id_persona);
        $("#selectMedico").append("<option selected value='" + $codigoCompuesto +"'>" + resultado.data[i].nombres + " " + resultado.data[i].apellidos + "</option>");
       } 
       else{
        $("#selectMedico").append("<option  value='" + $codigoCompuesto +"'>" + resultado.data[i].nombres + " " + resultado.data[i].apellidos + "</option>");
       } 
       

     }
  });

  }



  function limpiar(){
    $("#fecha").val("");
    $("#descripcion").val("");  
    $("#selectMedico").empty();
    $("#selectPaciente").empty();
    
  }


}); 