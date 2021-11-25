<div class="card mb-4">
    <div class="card-header">

            <button type="button" class="btn btn-primary" id="btnAgregar">
            <i class="fas fa-ad"></i>
                
            </button>

    </div>
    <div class="card-body">

    <div class="table-responsive-xl">
        <table id="tabla" class="table table-striped" cellspacing="0" width="100%">
          <thead>
          <tr>
              <th>Codigo de la sede</th>
              <th>Codigo de la ciudad</th>
              <th>Codigo del pais</th>
              <th>Nombre de la sede</th>
              <th>Nombre de la ciudad</th>
              <th>Direccion de sede</th>
              <th>Telefono de sede</th>
              <th>Eli</th>
              <th>Act</th>
           
          </tr>
          </thead>

          <tbody>
    

          </tbody>
     

 



        </table>   
    </div>

        


    </div>
</div>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form id="formSede">
        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese codigo de sede</label>
            <input type="text" class="form-control" id="codigo_sede" name="codigo_sede">
            
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese nombre de la sede</label>
            <input type="text" class="form-control" id="nombre_sede" name="nombre_sede">
          
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese direccion de la sede</label>
            <input type="text" class="form-control" id="direccion_sede" name="direccion_sede">
          
        </div>

        
        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese Telefono de la sede</label>
            <input type="text" class="form-control" id="telefono_sede" name="telefono_sede">
          
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Selecione ciudad</label>
            <select class="form-select form-select-lg mb-3" name="selectSede" id="selectSede" aria-label=".form-select-lg example">
        </select><br>
        </div>

        <input type="hidden" value="" name="codigo_pais_anterior" id="codigo_pais_anterior">
        <input type="hidden" value="" name="codigo_sede_anterior" id="codigo_sede_anterior">
        <input type="hidden" value="" name="codigo_ciudad_anterior" id="codigo_ciudad_anterior">


        <input type="hidden" value="" name="accion" id="accion">
        <button type="button" id="btnSede" class="btn btn-primary"></button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="cerrar" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>






<!-- ---------------------------------------------------------------------------------------- -->
<script src="../../Recursos/js/Sede/Sede.js"></script>