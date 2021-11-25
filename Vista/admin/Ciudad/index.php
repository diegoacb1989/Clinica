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
              <th>Codigo de la ciudad</th>
              <th>Codigo del pais</th>
              <th>Nombre de la ciudad</th>
              <th>Nombre del pais</th>
              <th>Descripciones</th>
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

      <form id="formPais">
        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese codigo de la ciudad</label>
            <input type="text" class="form-control" id="codigo" name="codigo">
            
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese nombre de la ciudad</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
          
        </div>


        
        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese descripcion de la ciudad</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion">
          
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Selecione pais</label>
            <select class="form-select form-select-lg mb-3" name="selectPaises" id="selectPaises" aria-label=".form-select-lg example">
          <option selected value="nulo">Selecione pais</option>
        </select><br>
        </div>

        
        
        <input type="hidden" value="" name="codigoAnteriorCiudad" id="codigoAnteriorCiudad">
        <input type="hidden" value="" name="codigoAnteriorPais" id="codigoAnteriorPais">
        <input type="hidden" value="" name="accion" id="accion">
        <button type="button" id="btnCiudad" class="btn btn-primary"></button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="cerrar" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>






<!-- ---------------------------------------------------------------------------------------- -->
<script src="../../Recursos/js/Ciudad/ciudad.js"></script>