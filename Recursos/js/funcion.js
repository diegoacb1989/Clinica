function Inicio(){
    //alert("Inicio");
	$("a").click(function(e){
     	e.preventDefault();
        var url = $(this).attr("href");
        //console.log("url: " + url);
        //alert("url " + url);
        $.post( url,function(resultado) {

          if(url == "./Citas/index.php?tipo=medica"){
            $("#tipo").val("Cirujia");
            //alert("Medicas");
          }
         
            if(url == "./Citas/index.php"){
              $("#tipo").val("Cita");
              //alert("Citas");
            }
            

        		if(url!="#"){
                    $("#contenedor").load(url);
                    $("#contenedor").show();
                }
        			
        });
     });
}