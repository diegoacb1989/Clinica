$(document).ready(function(){

    dt = $("#tabla").DataTable({
        "columns": [
            { "data": "codigo_sede" },
            { "data": "codigo_ciudad" },
            { "data": "codigo_pais" },
            { "data": "nombre_sede" },
            { "data": "nombre_ciudad" },
            { "data": "direccion_sede" },
            { "data": "telefono_sede" },
            {"data":"elimilar"},
            {"data":"actualizar"},     
        ],
        "columnDefs":[{
          "targets":-1,
          "data":null,
    
        }] 
    
    });

    
    

    $(".modal-title").css('color', '#FFFFFF');
    $(".modal-header").css('background-color', '#617DCF');

    $("#btnAgregar").click(function(){
        $("#accion").val("nuevo");
        $("#btnSede").text("Registrar sede");
        $(".modal-title").text("Nueva sede");
        $("#exampleModal").modal("show");
        $("#selectSede").empty();
        limpiarDatos();
        llenarSelect(-1);
    });

    //LLENAR REGISTROS DE SEDE
    $.ajax({
      type:"get",
      url:"../../Controlador/Sede/ControladorSede.php",
      data: {accion:'listar'},
      dataType:"json"
    }).done(function( resultado ) {   
      vectorDatos = resultado;
    
      console.log("------------------------------")
      //----------------------------------------------------------------------
       for(var i=0;i<resultado.data.length;i++){
        dt.row.add(
          {
            codigo_sede:resultado.data[i].codigo_sede,
            codigo_ciudad:resultado.data[i].codigo_ciudad,
            codigo_pais:resultado.data[i].codigo_pais,
            nombre_sede:resultado.data[i].nombre_sede,
            nombre_ciudad:resultado.data[i].nombre_ciudad,
            direccion_sede:resultado.data[i].direccion,
            telefono_sede:resultado.data[i].telefono,
            elimilar: '<button type="button" data-codigo_sede="'+ resultado.data[i].codigo_sede + 
            '" data-codigo_pais="'+ resultado.data[i].codigo_pais + 
            '" data-codigo_ciudad = "'+ resultado.data[i].codigo_ciudad + 
            '"  class="btn btn-link elimilar"><i class="fa fa-trash"></i></button>',
            actualizar: '<button type="button" data-codigo_sede="'+ resultado.data[i].codigo_sede + 
            '" data-codigo_pais="'+ resultado.data[i].codigo_pais + 
            '" data-codigo_ciudad = "'+ resultado.data[i].codigo_ciudad + 
            '"  class="btn btn-link editar"><i class="fa fa-edit"></i></button>'
          }
         ).draw(true);
       }
      
    });


       $("#btnSede").click(function(){
        var datos = $("#formSede").serialize();
        alert(datos);
        console.log(datos);
        $.ajax({
          type:"get",
          url:"../../Controlador/Sede/ControladorSede.php",
          data: datos,
          dataType:"json"
        }).done(function( resultado ) {  
          console.log("-------------------------------------------------"); 
          console.log("sede: " + resultado); 
          console.log("sede: " + resultado.data);
          //console.log("Respuesta: " + resultado.data[0].respuesta);
          if(resultado[0].respuesta == "correcto"){

             if(resultado[0].accion == "registrada"){
             //INSERTAR NUEVA SEDE
              dt.row.add(
                {
                  codigo_sede:resultado[0].codigo_sede,
                  codigo_ciudad:resultado[0].codigo_ciudad,
                  codigo_pais:resultado[0].codigo_pais,
                  nombre_sede:resultado[0].nombre_sede,
                  nombre_ciudad:resultado[0].nombre_ciudad,
                  direccion_sede:resultado[0].direccion_sede,
                  telefono_sede:resultado[0].telefono_sede,
                  elimilar: '<button type="button" data-codigo_sede="'+ resultado[0].codigo_sede + 
                  '" data-codigo_pais="'+ resultado[0].codigo_pais + 
                  '" data-codigo_ciudad = "'+ resultado[0].codigo_ciudad + 
                  '"  class="btn btn-link elimilar"><i class="fa fa-trash"></i></button>',
                  actualizar: '<button type="button" data-codigo_sede="'+ resultado[0].codigo_sede + 
                  '" data-codigo_pais="'+ resultado[0].codigo_pais + 
                  '" data-codigo_ciudad = "'+ resultado[0].codigo_ciudad + 
                  '"  class="btn btn-link editar"><i class="fa fa-edit"></i></button>'
                }
               ).draw(true);

             }
             else if(resultado[0].accion == "Actualizada"){
               ActualizarElimilarRegistro(resultado[0].codigo_ciudad_anterior,resultado[0].codigo_pais_anterior,resultado[0].codigo_sede_anterior,resultado,0);
             }
            

            Swal.fire(
              'Sede',
              'sede ' + resultado[0].accion.toString() + ' satisfactoriamente',
              'success'
            );



          }else{

            var texto = "";
            texto =  resultado[0];
            for (var i = 1; i < resultado.length; i++) {
              texto =  texto + ",\n" + resultado[i];
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

      $(document).on("click",".elimilar",function(){

        var codigo_pais = $(this).data("codigo_pais");
        var codigo_sede = $(this).data("codigo_sede");
        var codigo_ciudad = $(this).data("codigo_ciudad");
        //alert("Actualizr: " + codigo_pais + "-" + codigo_sede + "-" + codigo_ciudad);
        $.ajax({
          type:"get",
          url:"../../Controlador/Sede/ControladorSede.php?accion=consultar",
          data: {accion:'consultar',codigo_pais:codigo_pais,codigo_sede:codigo_sede,codigo_ciudad:codigo_ciudad},
          dataType:"json"
        }).done(function(resultado){   
          console.log("------------------------------");
          console.log("Datos: " + resultado.data);
          //-------------------------------------------------------------------------------------------------------
          
          swal({
            title: '¿Está seguro?',
            text: "¿Realmente desea borrar la sede : " + resultado.data[0].nombre + " ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Borrarlo!'
      }).then((decision) => {
              if (decision.value) {
    
                $.ajax({
                  type:"get",
                  url:"../../Controlador/Sede/ControladorSede.php?accion=borrar",
                  data: {accion:'borrar',codigo_pais:codigo_pais,codigo_sede:codigo_sede,codigo_ciudad:codigo_ciudad},
                  dataType:"json"
                }).done(function(request) {   
                 
                  swal(
                    'Borrado!',
                    'La sede: ' + resultado.data[0].nombre +  ' fue borrada',
                    'success'
                   );
                  //--------------------------------------------------------------------------------
                  ActualizarElimilarRegistro(codigo_ciudad,codigo_pais,codigo_sede,null,1);
                });//INSERTAR D
    
    
              }else{
                swal(
                  'Cancelado!',
                  'La sede ' + resultado.data[0].nombre  + " no fue elimilada",
                  'warning'
                 );
    
              }
      });
          
          
      });
    });

      $(document).on("click",".editar",function(){//traer datos para mostrar en el formulario editar

        var codigo_pais = $(this).data("codigo_pais");
        var codigo_sede = $(this).data("codigo_sede");
        var codigo_ciudad = $(this).data("codigo_ciudad");

        $("#codigo_sede_anterior").val(codigo_sede);
        $("#codigo_ciudad_anterior").val(codigo_ciudad);
        $("#codigo_pais_anterior").val(codigo_pais);

        //alert("Actualizr: " + codigo_pais + "-" + codigo_sede + "-" + codigo_ciudad);
        $("#codigo_pais").val(codigo_pais);
        $("#codigo_sede").val(codigo_sede);
        $("#codigo_ciudad").val(codigo_ciudad);
        $("#accion").val("editar");
        $("#btnSede").text("Actualizar sede");
        $.ajax({
          type:"get",
          url:"../../Controlador/Sede/ControladorSede.php?accion=consultar",
          data: {accion:'consultar',codigo_pais:codigo_pais,codigo_sede:codigo_sede,codigo_ciudad:codigo_ciudad},
          dataType:"json"
        }).done(function(resultado) {   
          console.log("------------------------------");
          console.log("Datos: " + resultado.data);
          //----------------------------------------------------------------------
          $("#codigo_sede").val(resultado.data[0].codigo_sede);
          $("#nombre_sede").val(resultado.data[0].nombre);
          $("#direccion_sede").val(resultado.data[0].direccion);
          $("#telefono_sede").val(resultado.data[0].telefono);
          $("#selectSede").empty();
          llenarSelect(codigo_ciudad,codigo_pais);
          $(".modal-title").text("Actualizar sede");
          $("#exampleModal").modal("show");
        });
        
       });

       
       function ActualizarElimilarRegistro(ciudadAnterior,paisAnterior,codigo_sede,resultado,accion){
        dt.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
          console.log("Codigo ciudad:" + ciudadAnterior + " es igual a: " + this.data().codigo_ciudad + "AND" + "Codigo pais:" + paisAnterior + " es igual a: " + this.data().codigo_pais + "codigo de sede: " + codigo_sede + " = " + this.data().codigo_sede);
      
      
          if((ciudadAnterior == this.data().codigo_ciudad) && (paisAnterior == this.data().codigo_pais) && (codigo_sede == this.data().codigo_sede)){
            console.log("Se encontro la cordenada: " + "ciu: " + ciudadAnterior + ", pais: " + paisAnterior + ", sede: " + codigo_sede + ",index: " + rowIdx);
            if(accion == 0)//SE DEBE ACTUALIZAR
            {
           
              dt.row(rowIdx).data(
                {
                  "codigo_sede":resultado[0].codigo_sede,
                  "codigo_ciudad":resultado[0].codigo_ciudad,
                  "codigo_pais":resultado[0].codigo_pais,
                  "nombre_sede":resultado[0].nombre_sede,
                  "nombre_ciudad":resultado[0].nombre_ciudad,
                  "direccion_sede":resultado[0].direccion_sede,
                  "telefono_sede":resultado[0].telefono_sede,
                  
                  "elimilar": '<button type="button" data-codigo_sede="'+ resultado[0].codigo_sede + 
                  '" data-codigo_pais="'+ resultado[0].codigo_pais + 
                  '" data-codigo_ciudad = "'+ resultado[0].codigo_ciudad + 
                  '"  class="btn btn-link elimilar"><i class="fa fa-trash"></i></button>',

                  "actualizar": '<button type="button" data-codigo_sede="'+ resultado[0].codigo_sede + 
                  '" data-codigo_pais="'+ resultado[0].codigo_pais + 
                  '" data-codigo_ciudad = "'+ resultado[0].codigo_ciudad + 
                  '"  class="btn btn-link editar"><i class="fa fa-edit"></i></button>'
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

    function llenarSelect(codigo_ciudad,codigo_pais){

        $.ajax({
          type:"get",
          url:"../../Controlador/Ciudad/ControladorCiudad.php?accion=listar",
          data: {accion:'listar'},
          dataType:"json"
        }).done(function( resultado ) {   
          console.log("------------------------------")
          //----------------------------------------------------------------------
           console.log("Ciudades"+resultado);    
           console.log("Nopmbre posicion 0 "+resultado[0].nombre);  
           console.log("Codigo de ciudad posicion 0 "+resultado[0].codigo);
           console.log("Codigo de pais posicion  "+resultado[0].codigo_pais);
           console.log("Longitud "+resultado.length);   
           var codigoCompuesto = ""; 
           for(var i=0;i<resultado.length;i++){
            console.log("Validacion "+ "codigo de pais: " + codigo_ciudad + " = " + resultado[i].codigo);  
            codigoCompuesto = resultado[i].codigo_pais + "-" + resultado[i].codigo + "-" + resultado[i].nombre;
            
             if((codigo_ciudad == resultado[i].codigo) && (codigo_pais == resultado[i].codigo_pais)){
              $("#selectSede").append("<option selected value='" + codigoCompuesto + "'>" + resultado[i].nombre + "</option>");
             } 
             else{
              $("#selectSede").append("<option value='" + codigoCompuesto + "'>" + resultado[i].nombre + "</option>");
             }  
           }

        });

      
       }


       function limpiarDatos(){
        $("#codigo_sede").val("");
        $("#nombre_sede").val("");
        $("#direccion_sede").val("");
        $("#telefono_sede").val("");
       }
       

});