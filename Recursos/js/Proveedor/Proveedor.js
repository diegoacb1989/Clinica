$(document).ready(function(){

    dt = $("#tabla").DataTable({
        "columns": [
            { "data": "codigo" },
            { "data": "nombre" },
            { "data": "descripcion" },
            { "data": "direccion"} ,
            { "data": "telefono" },
            {"data":"elimilar"},
            {"data":"actualizar"},     
        ],
        "columnDefs":[{
          "targets":-1,
          "data":null,
    
        }] 
    
    });

    

    $.ajax({
        type:"get",
        url:"../../Controlador/Proveedor/ControladroProveedor.php?accion=listar",
        data: {accion:'listar'},
        dataType:"json"
      }).done(function( resultado ) {   
        console.log("------------------------------")
        //----------------------------------------------------------------------
     
         console.log("Longitud "+resultado.length); 
         for(var i=0;i<resultado.length;i++){
            dt.row.add(
                {
                  codigo:resultado[i].id_proveedor,
                  nombre:resultado[i].nombre,
                  descripcion:resultado[i].descripcion,
                  direccion:resultado[i].direccion,
                  telefono:resultado[i].telefono,
                  elimilar: '<button type="button" data-codigo="'+ resultado[i].id_proveedor + 
                  '" class="btn btn-link elimilar"><i class="fa fa-trash"></i></button>',
                  actualizar: '<button type="button" data-codigo="'+ resultado[i].id_proveedor + 
                  '"  class="btn btn-link editar"><i class="fa fa-edit"></i></button>'
                }
               ).draw(true);
    
         }
    
      });

      $(document).on("click",".elimilar",function(){//traer datos para mostrar en el formulario editar
        var codigo = $(this).data("codigo");
        //alert("BOTON EDITAR DIRECTOR DE SEDE PRESIONADO: " + codigo);
        $("#id_proveedor").val(codigo);
        $.ajax({
         type:"get",
         url:"../../Controlador/Proveedor/ControladroProveedor.php",
         data: {accion:'consultar',id_proveedor:codigo},
         dataType:"json"
       }).done(function(resultado) {  
         //alert("BOTON EDITAR DIRECTOR DE SEDE PRESIONADO: " + codigo);
         console.log( "Nombres: " + resultado.data[0].nombre); 
        
         swal({
          title: '¿Está seguro?',
          text: "¿Realmente desea borrar, el proveedor : " + resultado.data[0].nombre.toString() + " ?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Borrarlo!'
    }).then((decision) => {
            if (decision.value) {
  
              $.ajax({
                type:"get",
                url:"../../Controlador/Proveedor/ControladroProveedor.php",
                data: {accion:'borrar',id_proveedor:codigo},
                dataType:"json"
              }).done(function(request) {   
               
                swal(
                  'Borrado!',
                  'El proveedor: ' + resultado.data[0].nombre.toString() +  ' fue borrado',
                  'success'
                 );

                //--------------------------------------------------------------------------------
                //console.log("Usuario a buscar para, elimilar: "+resultado.data[0].usuario.toString())
                ActualizarElimilarRegistro(codigo,null,1);
              });//INSERTAR D
  
  
            }else{
              swal(
                'Cancelado!',
                'El  proveedor ' + resultado.data[0].nombre.toString() + ", no fue elimilado",
                'warning'
               );
  
            }
    })


       });
         
       });
      
    $(document).on("click",".editar",function(){//traer datos para mostrar en el formulario editar
      var codigo = $(this).data("codigo");
      //alert("BOTON EDITAR DIRECTOR DE SEDE PRESIONADO: " + codigo);
      $("#id_proveedor").val(codigo);
      $.ajax({
       type:"get",
       url:"../../Controlador/Proveedor/ControladroProveedor.php",
       data: {accion:'consultar',id_proveedor:codigo},
       dataType:"json"
     }).done(function(resultado) {  
       //alert("BOTON EDITAR DIRECTOR DE SEDE PRESIONADO: " + codigo);
       console.log( "Nombres: " + resultado.data[0].nombre); 
       $("#accion").val("editar");
       $("#btnProveedor").text("Actualizar proveedor");
       $(".modal-title").text("Actualizar proveedor");
       $("#nombre").val(resultado.data[0].nombre);
       $("#direccion").val(resultado.data[0].direccion);
       $("#telefono").val(resultado.data[0].telefono);
       $("#descripcion").val(resultado.data[0].descripcion);
      
       $("#exampleModal").modal("show");
     });
       
     });

     //alert("Proveedor");
     $(".modal-title").css('color', '#FFFFFF');
     $(".modal-header").css('background-color', '#617DCF');


     $("#btnAgregar").click(function(){
       limpiar();
       $("#accion").val("nuevo");   
       $("#btnProveedor").text("Registrar proveedor");
        $(".modal-title").text("Nuevo proveedor");
        $("#exampleModal").modal("show");
     });

     $("#btnProveedor").click(function(){
       var datos = $("#formProveedor").serialize();
       console.log(datos);
       //alert(datos);
       $.ajax({
        type:"get",
        url:"../../Controlador/Proveedor/ControladroProveedor.php",
        data: datos,
        dataType:"json"
      }).done(function( resultado ){  
        console.log("-------------------------------------------------"); 
        
        console.log("Respuesta: " + resultado[0].respuesta);
        if(resultado[0].respuesta == "correcto"){

           if(resultado[0].accion == "Registrado"){
            //INSERTAR NUEVO PROVEEDOR
            dt.row.add(
                {
                  codigo:resultado[0].id_proveedor,
                  nombre:resultado[0].nombre,
                  descripcion:resultado[0].descripcion,
                  direccion:resultado[0].direccion,
                  telefono:resultado[0].telefono,
                  elimilar: '<button type="button" data-codigo="'+ resultado[0].id_proveedor + 
                  '" class="btn btn-link elimilar"><i class="fa fa-trash"></i></button>',
                  actualizar: '<button type="button" data-codigo="'+ resultado[0].id_proveedor + 
                  '"  class="btn btn-link editar"><i class="fa fa-edit"></i></button>'
                }
               ).draw(true);

           }
           else if(resultado[0].accion == "Actualizado"){
            
            ActualizarElimilarRegistro(resultado[0].id_proveedor,resultado,0);

           }
          

          Swal.fire(
            'Proveedor',
            'Proveedor ' + resultado[0].accion.toString() + ' satisfactoriamente',
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


     })

     function limpiar(){
       //alert("Limpiar formulario");
       $("#formProveedor")[0].reset();
     }

     function ActualizarElimilarRegistro(idProveedor,resultado,accion){
      dt.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
        console.log("Codigo :" + idProveedor + " es igual a: " + this.data().codigo);

        if(idProveedor == this.data().codigo){
          console.log("Se encontro el codigo en el indice: " + rowIdx);
          if(accion == 0)//SE DEBE ACTUALIZAR
          {

            dt.row(rowIdx).data(
              {
                codigo:resultado[0].id_proveedor,
                nombre:resultado[0].nombre,
                descripcion:resultado[0].descripcion,
                direccion:resultado[0].direccion,
                telefono:resultado[0].telefono,
                elimilar: '<button type="button" data-codigo="'+ resultado[0].id_proveedor + 
                '" class="btn btn-link elimilar"><i class="fa fa-trash"></i></button>',
                actualizar: '<button type="button" data-codigo="'+ resultado[0].id_proveedor + 
                '"  class="btn btn-link editar"><i class="fa fa-edit"></i></button>'
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