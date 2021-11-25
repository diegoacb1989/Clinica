

  $(document).ready(function(){

    dt = $("#tabla").DataTable({
      "columns": [
         { "data": "codigo" },
          { "data": "nombre_empleado" },
          { "data": "salario_basico" },
          { "data": "can_horario_extra" },
          { "data": "valor_horario_extra" },
          { "data": "fecha" },
          { "data": "salario_total" },
          { "data": "actualizar" },
          {"data": "elimilar"}    
      ],
      "columnDefs":[{
        "targets":-1,
        "data":null,
  
      }] 
  
  });

  $.ajax({
    type:"get",
    url:"../../Controlador/Nomina/ControladorNomina.php",
    data: {accion:'listar'},
    dataType:"json"
  }).done(function( resultado ) {  

    for(var i=0;i<resultado.data.length;i++){
      
      dt.row.add(
        {
          
          codigo:resultado.data[i].id_nomina,
          nombre_empleado:resultado.data[i].nombre_empleado,
          salario_basico:resultado.data[i].s_basico,
          can_horario_extra:resultado.data[i].can_hor,
          valor_horario_extra:resultado.data[i].v_hor_extra,
          fecha:resultado.data[i].fecha,
          salario_total:resultado.data[i].s_total,
          actualizar: '<button type="button" data-empleado="'+ resultado.data[i].id_empleado + 
          '" data-nomina = "'+ resultado.data[i].id_nomina + 
          '"  class="btn btn-link editar"><i class="fa fa-edit"></i></button>',
          elimilar: '<button type="button" data-empleado="'+ resultado.data[i].id_empleado + 
          '" data-nomina = "'+ resultado.data[i].id_nomina + 
          '"  class="btn btn-link eliminar"><i class="fa fa-trash"></i></button>'
        }
       ).draw(true);

     }
  });

  


    $(".modal-title").css('color', '#FFFFFF');
    $(".modal-header").css('background-color', '#617DCF');

    $(document).on("click",".editar",function(){
     
      var codigoEmpleado = $(this).data("empleado");
      var codigoNomina = $(this).data("nomina");
      //alert("Codigo empleado: " + codigoEmpleado + " Codigo de nomina: " + codigoNomina);

      $.ajax({
        type:"get",
        url:"../../Controlador/Nomina/ControladorNomina.php",
        data: {accion:'consultar',codigoEmpleado:codigoEmpleado,codigoNomina:codigoNomina},
        dataType:"json"
      }).done(function( resultado ) {   
        console.log(resultado.data);
        $("#accion").val("editar");
        $("#salarioBasico").val(resultado.data[0].s_basico);
        $("#cantiHorExt").val(resultado.data[0].can_hor);
        $("#valHhrExtra").val(resultado.data[0].v_hor_extra);
        $("#fecha").val(resultado.data[0].fecha);
        $("#selectEmpleado").empty();
        llenarSelect(resultado.data[0].id_empleado);
        $(".modal-title").text("Actualizar nomina");
        $("#btnNomina").text("actualizar nomina");
        $("#id_empleado").val(resultado.data[0].id_empleado);
        $("#id_nomina").val(resultado.data[0].id_nomina);
        $("#exampleModal").modal("show");
      });

    });

    $(document).on("click",".eliminar",function(){
      var codigoEmpleado = $(this).data("empleado");
      var codigoNomina = $(this).data("nomina");
      //alert("Codigo empleado: " + codigoEmpleado + " Codigo de nomina: " + codigoNomina);

      $.ajax({
        type:"get",
        url:"../../Controlador/Nomina/ControladorNomina.php",
        data: {accion:'consultar',codigoEmpleado:codigoEmpleado,codigoNomina:codigoNomina},
        dataType:"json"
      }).done(function(resultado){   
        console.log("------------------------------");
        console.log("Datos: " + resultado.data);
        //-------------------------------------------------------------------------------------------------------
        
        swal({
          title: '¿Está seguro?',
          text: "¿Realmente desea borrar la nomina con el saldo basico : " + resultado.data[0].s_basico + " ?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Borrarlo!'
    }).then((decision) => {
            if (decision.value) {
  
              $.ajax({
                type:"get",
                url:"../../Controlador/Nomina/ControladorNomina.php",
                data: {accion:'borrar',codigoEmpleado:codigoEmpleado,codigoNomina:codigoNomina},
                dataType:"json"
              }).done(function(request) {   
               
                swal(
                  'Borrado!',
                  'La nomina con el sueldo basico: ' + resultado.data[0].s_basico +  ' fue borrada',
                  'success'
                 );
                //--------------------------------------------------------------------------------
                ActualizarElimilarRegistro(resultado.data[0].id_nomina,null,1);
              });//INSERTAR D
  
  
            }else{
              swal(
                'Cancelado!',
                'La nomina con el sueldo basico ' + resultado.data[0].s_basico  + " no fue elimilada",
                'warning'
               );
  
            }
    });
        
        
    });

    });

    $("#btnAgregar").click(function(){
        $(".modal-title").text("Nueva nomina");
        $("#btnNomina").text("Insertar nomina");
        $("#accion").val("nuevo");
        limpiar();
        $("#exampleModal").modal("show");
      });


    $("#btnNomina").click(function(){
        var datos = $("#formNomina").serialize();
        //alert(datos);
        console.log(datos);
        $.ajax({
          type:"get",
          url:"../../Controlador/Nomina/ControladorNomina.php",
          data: datos,
          dataType:"json"
        }).done(function( resultado ) {
          console.log("Preuba: " + resultado.data);
          if(resultado.data[0].respuesta == 'correcto'){

            if(resultado.data[0].accion == "Registrada"){

             console.log("id_nomina: " + resultado.data[0].id_nomina);
             console.log("id_empleado: " + resultado.data[0].id_empleado);
             console.log("nombre_empleado: " + resultado.data[0].nombre_empleado);
             console.log("salario_basico: " + resultado.data[0].salario_basico);
             console.log("can_horario_extra: " + resultado.data[0].can_horario_extra);
             console.log("valor_horario_extra: " + resultado.data[0].valor_horario_extra);
             console.log("fecha: " + resultado.data[0].fecha);
             console.log("s_total: " + resultado.data[0].s_total);

             dt.row.add(
              {
                codigo:resultado.data[0].id_nomina,
                nombre_empleado:resultado.data[0].nombre_empleado,
                salario_basico:resultado.data[0].salario_basico,
                can_horario_extra:resultado.data[0].can_horario_extra,
                valor_horario_extra:resultado.data[0].valor_horario_extra,
                fecha:resultado.data[0].fecha,
                salario_total:resultado.data[0].s_total,
                actualizar: '<button type="button" data-empleado="'+ resultado.data[0].id_empleado + 
                '" data-nomina = "'+ resultado.data[0].id_nomina + 
                '"  class="btn btn-link editar"><i class="fa fa-edit"></i></button>',
                elimilar: '<button type="button" data-empleado="'+ resultado.data[0].id_empleado + 
                '" data-nomina = "'+ resultado.data[0].id_nomina + 
                '"  class="btn btn-link eliminar"><i class="fa fa-trash"></i></button>'
              }
             ).draw(true); 



            }else if(resultado.data[0].accion == 'Actualizada'){

              ActualizarElimilarRegistro(resultado.data[0].id_nomina,resultado,0);

            }
            
            Swal.fire(
              'Nomina',
              'Nomina ' + resultado.data[0].accion + ' satisfactoriamente',
              'success'
            );
            console.log("id_nomina: " + resultado.data[0].id_nomina);
          }
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



        });
     });

     function ActualizarElimilarRegistro(id_nomina,resultado,accion){
      dt.rows().every( function ( rowIdx, tableLoop, rowLoop ) {

        console.log("id nomina: " + id_nomina + " = " + this.data().codigo);
    
        if(id_nomina == this.data().codigo){
          console.log("Encontrado en la posicion: " + rowIdx);
           
          if(accion == 0)//SE DEBE ACTUALIZAR
          {
         
            dt.row(rowIdx).data(
              {
                "codigo":resultado.data[0].id_nomina,
                "nombre_empleado":resultado.data[0].nombre_empleado,
                "salario_basico":resultado.data[0].salario_basico,
                "can_horario_extra":resultado.data[0].can_horario_extra,
                "valor_horario_extra":resultado.data[0].valor_horario_extra,
                "fecha":resultado.data[0].fecha,
                "salario_total":resultado.data[0].s_total,

                "actualizar": '<button type="button" data-empleado="'+ resultado.data[0].id_empleado + 
                '" data-nomina = "'+ resultado.data[0].id_nomina + 
                '"  class="btn btn-link editar"><i class="fa fa-edit"></i></button>',

                "elimilar": '<button type="button" data-empleado="'+ resultado.data[0].id_empleado + 
                '" data-nomina = "'+ resultado.data[0].id_nomina + 
                '"  class="btn btn-link elimiar"><i class="fa fa-trash"></i></button>'
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
    }

  
      function limpiar(){
        $("#salarioBasico").val("");
        $("#cantiHorExt").val("");
        $("#valHhrExtra").val("");
        $("#fecha").val("dd/mm/aaaa");
        $("#selectEmpleado").empty();
        llenarSelect(-1);
      }


      function llenarSelect(idEmpleado){

        $.ajax({
            url:"../../Controlador/Persona/ControladorPersonas.php",
            data: {accion:'listar',rol:'Empleado'},
            dataType:"json"
        }).done(function( resultado ) {   
          console.log("------------------------------")
          //----------------------------------------------------------------------
           console.log("Paises"+resultado);    
           console.log("Prueba "+resultado.data[0].nombres);  
           for(var i=0;i<resultado.data.length;i++){
            console.log("Validacion "+ "codigo de pais: " + idEmpleado + " = " + resultado.data[i].id_persona);  
             if(idEmpleado == resultado.data[i].id_persona){
              $("#selectEmpleado").append("<option selected value='" + resultado.data[i].id_persona + "'>" + resultado.data[i].nombres + " " + resultado.data[i].apellidos + "</option>");
             } 
             else{
              $("#selectEmpleado").append("<option value='" + resultado.data[i].id_persona + "'>" + resultado.data[i].nombres + " " + resultado.data[i].apellidos + "</option>");
             }    
             
      
           }
        });
      
       }

  });