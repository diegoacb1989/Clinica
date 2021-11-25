$(document).ready(function(){

  dt = $("#tabla").DataTable({
    "columns": [
        { "data": "codigo" },
        { "data": "nombre" },
        { "data": "descripcion" },
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
  url:"../../Controlador/Pais/ControladorPais.php?accion=listar",
  data: {accion:'listar'},
  dataType:"json"
}).done(function( resultado ) {   
  console.log("------------------------------")
  //----------------------------------------------------------------------
   console.log(resultado.data);    
   for(var i=0;i<resultado.data.length;i++){
    dt.row.add(
      {
        codigo:resultado.data[i].codigo,
        nombre:resultado.data[i].nombre,
        descripcion:resultado.data[i].descripcion,
        elimilar: '<button type="button" data-codigo="'+ resultado.data[i].codigo + 
        '"  class="btn btn-link elimilar"><i class="fa fa-trash"></i></button>',
        actualizar: '<button type="button" data-codigo="'+ resultado.data[i].codigo + 
        '" class="btn btn-link editar" data-toggle="modal" data-target="" ><i class="fa fa-edit"></i></button>'
      }
     ).draw(true);
   }
  
});//INSERTAR DATOS A LA TABLA




  $(".modal-title").css('color', '#FFFFFF');
  $(".modal-header").css('background-color', '#617DCF');

    $("#btnAgregar").click(function(){
      $("#exampleModal").modal("show")
      $(".modal-title").text("Pais nuevo");
      $("#btnPais").text("registrar pais");
      $("#accion").val("nuevo");
    });

    $("#btnPais").click(function(){
      var datos = $("#formPais").serialize();
      //alert("Datos: " + datos )
      var cod = $("#codigo").val();
      var nom = $("#nombre").val();
      var des = $("#descripcion").val();
      $.ajax({
        type:"get",
        url:"../../Controlador/Pais/ControladorPais.php",
        data:datos,
        dataType:"json"
      }).done(function(resultado){   
        console.log("-------------------------------------------");
        console.log("Datos del pais: " + resultado.data[0].respuesta);
        console.log("-------------------------------------------");
        //---------------------------------------------------------
        if(resultado.data[0].respuesta == 'correcto'){
          //alert("datos correctos");

          if(resultado.data[0].accion == 'registrado'){
           dt.row.add(
            {
              codigo:cod,
              nombre:nom,
              descripcion:des,
              actualizar:'<button type="button" data-codigo="'+ cod + 
              '"  class="btn btn-link elimilar"><i class="fa fa-trash"></i></button>',
              elimilar: '<button type="button" data-codigo="'+ cod + 
              '" class="btn btn-link editar" data-toggle="modal" data-target="" ><i class="fa fa-edit"></i></button>'
            }
           ).draw(true);

          }else if(resultado.data[0].accion == 'actualizado'){
            
            ActualizarElimilarRegistro(resultado.data[0].codigoAnterior,resultado,0);
           
          }

        Swal.fire(
          'Pais',
          'Pais ' + resultado.data[0].accion + ' satisfactoriamente',
          'success'
        );

        }else if(resultado.data[0].respuesta == 'incorrecto'){
          Swal.fire(
            'Error de base de datos',
            'Por favor contactate con el proveedor del aplicativo',
            'error'
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

         $("#codigo").val("");
            $("#nombre").val("");
            $("#descripcion").val("");
      });//Contar     
    });//-------------------------------

    $(document).on("click",".editar",function(){//traer datos para mostrar en el formulario editar
      var codigo = $(this).data("codigo");
      //alert("BOTON EDITAR PAIS PRESIONADO: " + codigo);
    
      $.ajax({
        type:"get",
        url:"../../Controlador/Pais/ControladorPais.php",
        data: {accion:"consultar",codigo:codigo},
        dataType:"json"
      }).done(function(resultado) {   
        console.log("datos: " + resultado.data[0].nombre);
        $("#nombre").val(resultado.data[0].nombre.toString());
        $("#codigo").val(resultado.data[0].codigo.toString());
        $("#descripcion").val(resultado.data[0].descripcion.toString());
        $("#codigoAnterior").val(codigo);
        $("#exampleModal").modal("show");
        $(".modal-title").text("Actualizar pais");
        $("#btnPais").text("actualizar pais");
        $("#accion").val("editar");

      });//Contar

     });

     $(document).on("click",".elimilar",function(){//traer datos para mostrar en el formulario editar
      var codigo = $(this).data("codigo");
      //alert("BOTON ELIMILAR PAIS PRESIONADO: " + codigo);
    
      
      $.ajax({
        type:"get",
        url:"../../Controlador/Pais/ControladorPais.php",
        data: {accion:'consultar',codigo:codigo},
        dataType:"json"
      }).done(function( resultado){
        console.log("Registro a elimilar: "+resultado.data[0].nombre.toString());
  
        
        swal({
          title: '¿Está seguro?',
          text: "¿Realmente desea borrar, el pais : " + resultado.data[0].nombre.toString() + " ?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, Borrarlo!'
    }).then((decision) => {
            if (decision.value) {
  
              $.ajax({
                type:"get",
                url:"../../Controlador/Pais/ControladorPais.php",
                data: {accion:'borrar',codigo:codigo},
                dataType:"json"
              }).done(function(request) {   
               
                swal(
                  'Borrado!',
                  'El pais: ' + resultado.data[0].nombre.toString() +  ' fue borrado',
                  'success'
                 );

                //--------------------------------------------------------------------------------
                //console.log("Usuario a buscar para, elimilar: "+resultado.data[0].usuario.toString())
                ActualizarElimilarRegistro(resultado.data[0].codigo.toString(),null,1);
              });//INSERTAR D
  
  
            }else{
              swal(
                'Cancelado!',
                'El  pais ' + resultado.data[0].nombre.toString() + ", no fue elimilado",
                'warning'
               );
  
            }
    })
  
        
          
  
      });


      


   

     });




     function ActualizarElimilarRegistro(codigoAnterior,resultado,accion){
      dt.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
        console.log("Codigo :" + codigoAnterior + " es igual a: " + this.data().codigo);

        if(codigoAnterior == this.data().codigo){
          console.log("Se encontro el codigo en el indice: " + rowIdx);
          if(accion == 0)//SE DEBE ACTUALIZAR
          {

            dt.row(rowIdx).data(
              {
                  "codigo":resultado.data[0].codigo,
                  "nombre":resultado.data[0].nombre,
                  "descripcion":resultado.data[0].descripcion,
                  "elimilar": '<button type="button" data-codigo="'+ resultado.data[0].codigo + 
                  '"  class="btn btn-link elimilar"><i class="fa fa-trash"></i></button>',
                  "actualizar" : '<button type="button" data-codigo="'+ resultado.data[0].codigo + 
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