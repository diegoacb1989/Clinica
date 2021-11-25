$(document).ready(function(){
 //alert("Ciudad");

 dt = $("#tabla").DataTable({
  "columns": [
      {"data": "codigo" },
      {"data":"codigo_pais"},
      { "data": "nombre_ciudad" },
      { "data": "nombre_pais"},
      { "data": "descripcion" },
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

 //-------------------------------------------------------
   //LLENAMOS SELECT
   //llenarSelect(-1);
  //LLENAMOS TABLA
  $.ajax({
    type:"get",
    url:"../../Controlador/Ciudad/ControladorCiudad.php?accion=listar",
    data: {accion:'listar'},
    dataType:"json"
  }).done(function( resultado ) {   
    console.log("------------------------------")
    //----------------------------------------------------------------------

     console.log("Prueba de ciudad "+resultado[2].nombre); 
     console.log("Longitud "+resultado.length); 
     for(var i=0;i<resultado.length;i++){
      dt.row.add(
        {
          codigo:resultado[i].codigo,
          codigo_pais:resultado[i].codigo_pais,
          nombre_ciudad:resultado[i].nombre,
          nombre_pais:resultado[i].nombre_pais,
          descripcion:resultado[i].descripcion,
          elimilar: '<button type="button" data-codigo="'+ resultado[i].codigo + 
          '" data-pais="'+resultado[i].codigo_pais+'"  class="btn btn-link elimilar" data-toggle="modal" data-target="" ><i class="fa fa-trash"></i></button>',
          actualizar:'<button type="button" data-codigo="'+ resultado[i].codigo + 
          '" data-pais="'+resultado[i].codigo_pais+'"   class="btn btn-link editar"><i class="fa fa-edit"></i></button>',
        }
       ).draw(true);

     }

  });
 //-------------------------------------------------------

 $("#btnAgregar").click(function(){
  $("#exampleModal").modal("show")
  $(".modal-title").text("Ciudad nueva");
  $("#btnCiudad").text("registrar ciudad");
  $("#accion").val("nuevo");
  $("#codigo").val("");
  $("#nombre").val("");
  $("#descripcion").val("");
  $("#selectPaises").empty();
  llenarSelect(-1);

});

 $("#btnCiudad").click(function(){
  var datos = $("#formPais").serialize();
  //alert("Datos: " + datos )
  $.ajax({
    type:"get",
    url:"../../Controlador/Ciudad/ControladorCiudad.php",
    data: datos,
    dataType:"json"
  }).done(function( resultado ) {   
    console.log("------------------------------")
    //console.log("ciudad: " + resultado[0].codigo_pais);
    console.log("Respuesta: " + resultado.data);
    //----------------------------------------------------------------------
    if(resultado.data[0].respuesta == 'correcto'){

       console.log("MENSJAE: " + resultado.data[0].mensaje);
     
      Swal.fire(
        'Ciudad',
        'Ciudad, ' + resultado.data[0].accion + ', satisfactoriamente',
        'success'
      );

      if(resultado.data[0].accion == 'Registrada'){

        dt.row.add(
          {
            codigo:resultado.data[0].codigo_ciudad,
            codigo_pais:resultado.data[0].codigo_pais,
            nombre_ciudad:resultado.data[0].nombre_ciudad,
            nombre_pais:resultado.data[0].nombre_pais,
            descripcion:resultado.data[0].descripcion,
            elimilar: '<button type="button" data-codigo="'+ resultado.data[0].codigo_ciudad + 
            '" data-pais="'+resultado.data[0].codigo_pais+'" class="btn btn-link elimilar" data-toggle="modal" data-target="" ><i class="fa fa-trash"></i></button>',
            actualizar:'<button type="button" data-codigo="'+ resultado.data[0].codigo_ciudad + 
            '" data-pais="'+resultado.data[0].codigo_pais+'"  class="btn btn-link editar"><i class="fa fa-edit"></i></button>',
          }
         ).draw(true);

      }else if(resultado.data[0].accion == 'actualizada'){

        ActualizarElimilarRegistro($("#codigoAnteriorCiudad").val(),$("#codigoAnteriorPais").val(),resultado,0);
        $("#selectPaises").empty();
      }

      $("#exampleModal").modal("hide");
      $("#codigo").val("");
      $("#nombre").val("");
      $("#descripcion").val("");


    }else if(resultado.data[0].respuesta == 'incorrecto'){

    }else{//HUBO ERRORES EN EL FORMULARIO

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

  $("#selectPaises").empty();

 });

//ACTUALIZAR

$(document).on("click",".editar",function(){//traer datos para mostrar en el formulario editar
  var codigo = $(this).data("codigo");
  var codigo_pais = $(this).data("pais");
  //alert("Codigo de la ciudad: " + codigo + ", Codigo del pais: " + codigo_pais);
  $("#selectPaises").empty();
  $.ajax({
    type:"get",
    url:"../../Controlador/Ciudad/ControladorCiudad.php",
    data: {accion:"consultar",codigo_ciudad:codigo,codigo_pais:codigo_pais},
    dataType:"json"
  }).done(function(resultado) {   
    
    $("#nombre").val(resultado[0].nombre);
    $("#descripcion").val(resultado[0].descripcion);
    $("#codigo").val(codigo);
    $(".modal-title").text("Actualizar ciudad");
    $("#btnCiudad").text("actualizar ciudad");
    $("#accion").val("editar");
    $("#codigoAnteriorCiudad").val(codigo);
    $("#codigoAnteriorPais").val(codigo_pais);
    $("#exampleModal").modal("show");
    llenarSelect(codigo_pais);
  
  });//Contar

 });


 $(document).on("click",".elimilar",function(){
   var codigo = $(this).data("codigo");
   var codigo_pais = $(this).data("pais");
   //alert("Codigo de la ciudad: " + codigo + ", Codigo del pais: " + codigo_pais);
   $.ajax({
    type:"get",
    url:"../../Controlador/Ciudad/ControladorCiudad.php",
    data: {accion:"consultar",codigo_ciudad:codigo,codigo_pais:codigo_pais},
    dataType:"json"
  }).done(function(resultado) {   
    
    swal({
      title: '¿Está seguro?',
      text: "¿Realmente desea borrar, la ciudad : " + resultado[0].nombre.toString() + " ?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Borrarlo!'
}).then((decision) => {
        if (decision.value) {

          $.ajax({
            type:"get",
            url:"../../Controlador/Ciudad/ControladorCiudad.php",
            data: {accion:'borrar',codigo_ciudad:codigo,codigo_pais:codigo_pais},
            dataType:"json"
          }).done(function(request) {   
           
            swal(
              'Borrado!',
              'La ciudad: ' + resultado[0].nombre.toString() +  ' fue borrada',
              'success'
             );

            //--------------------------------------------------------------------------------
            //console.log("Usuario a buscar para, elimilar: "+resultado.data[0].usuario.toString())
            ActualizarElimilarRegistro(codigo,codigo_pais,null,1);
          });//INSERTAR D


        }else{
          swal(
            'Cancelado!',
            'La ciudad ' + resultado[0].nombre.toString() + ", no fue elimilado",
            'warning'
           );

        }
});

  
  });//Contar


 });

 $("#cerrar").click(function(){
   $("#selectPaises").empty();
   $("#codigo").val("");
   $("#nombre").val("");
   $("#descripcion").val("");

 });



 function llenarSelect(codigoPais){

  $.ajax({
    type:"get",
    url:"../../Controlador/Pais/ControladorPais.php?accion=listar",
    data: {accion:'listar'},
    dataType:"json"
  }).done(function( resultado ) {   
    console.log("------------------------------")
    //----------------------------------------------------------------------
     console.log("Paises"+resultado);    
     console.log("Prueba "+resultado.data[0].nombre);  
     for(var i=0;i<resultado.data.length;i++){
      console.log("Validacion "+ "codigo de pais: " + codigoPais + " = " + resultado.data[i].codigo);  
       if(codigoPais == resultado.data[i].codigo){
        $("#selectPaises").append("<option selected value='" + resultado.data[i].codigo + "'>" + resultado.data[i].nombre + "</option>");
       } 
       else{
        $("#selectPaises").append("<option value='" + resultado.data[i].codigo + "'>" + resultado.data[i].nombre + "</option>");
       }    
       

     }
  });

 }


 function ActualizarElimilarRegistro(ciudadAnterior,paisAnterior,resultado,accion){
  dt.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
    console.log("Codigo ciudad:" + ciudadAnterior + " es igual a: " + this.data().codigo + "AND" + "Codigo pais:" + paisAnterior + " es igual a: " + this.data().codigo_pais);


    if((ciudadAnterior == this.data().codigo) && (paisAnterior == this.data().codigo_pais)){
      console.log("Se encontro la  ciudad en el indice: " + rowIdx + ", con las siguientes cordenadas: " + "Codigo ciudad:" + ciudadAnterior + " es igual a: " + this.data().codigo + "AND" + "Codigo pais:" + paisAnterior + " es igual a: " + this.data().codigo_pais);
      if(accion == 0)//SE DEBE ACTUALIZAR
      {
      dt.row(rowIdx).data(
      {
          "codigo":resultado.data[0].codigo_ciudad,
          "codigo_pais":resultado.data[0].codigo_pais,
          "nombre_ciudad":resultado.data[0].nombre_ciudad,
          "nombre_pais":resultado.data[0].nombre_pais,
          "descripcion":resultado.data[0].descripcion,
          "elimilar": '<button type="button" data-codigo="'+ resultado.data[0].codigo_ciudad + 
          '" data-pais="'+resultado.data[0].codigo_pais+'"  class="btn btn-link elimilar" data-toggle="modal" data-target="" ><i class="fa fa-trash"></i></button>',
          "actualizar":'<button type="button" data-codigo="'+ resultado.data[0].codigo_ciudad + 
          '" data-pais="'+resultado.data[0].codigo_pais+'"   class="btn btn-link editar"><i class="fa fa-edit"></i></button>',
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

});