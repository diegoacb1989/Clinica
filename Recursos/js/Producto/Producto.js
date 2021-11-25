$(document).ready(function(){ 

 dt = $("#tabla").DataTable({
    "columns": [
        { "data": "codigo" },
        { "data": "nombre" },
        { "data": "descripcion" },
        { "data": "valor_unitario"} ,
        {"data":"elimilar"},
        {"data":"actualizar"} 
    ],
    "columnDefs":[{
      "targets":-1,
      "data":null,

    }] 

});

$(".modal-title").css('color', '#FFFFFF');
$(".modal-header").css('background-color', '#617DCF');


$("#btnProducto").click(function(){
 
    var datos = $("#formProducto").serialize();
    console.log(datos);
    alert(datos);

    if(document.getElementById("archivo").files.length == 0 ){
        Swal.fire(
            'Archivo',
            'Por favor seleciona un archivo',
            'error'
          )
    }else{

    //INSERTAR IMAGEN-------------------------------------------------------
    var file_data = $('#archivo').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    alert(form_data);                             
    $.ajax({
        url: '../../Controlador/Producto/ControladorProducto.php', // point to server-side PHP script 
        dataType: 'json',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(respuesta){
          alert("Respuesta: " + respuesta.data[0].respuesta); // display response from the PHP script, if any
        },
        
     });
    //-----------------------------------------------------------------------------------------------------

    }




});



$("#btnAgregar").click(function(){
    limpiar();
    $("#accion").val("nuevo");   
    $("#btnProducto").text("Registrar producto");
     $(".modal-title").text("Nuevo producto");
     $("#exampleModal").modal("show");
  });


  function limpiar(){
    //alert("Limpiar formulario");
    $("#formProducto")[0].reset();
  }

});
