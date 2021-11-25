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
              <th>Codigo</th>
              <th>Nombres</th>
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
            <label for="exampleInputEmail1">Ingrese codigo del pais</label>
            <input type="text" class="form-control" id="codigo" name="codigo">
            
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese nombre del pais</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
          
        </div>

        
        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese descripcion del pais</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion">
          
        </div>

        <input type="hidden" value="" name="accion" id="accion">
        <input type="hidden" value="" name="codigoAnterior" id="codigoAnterior">
        <button type="button" id="btnPais" class="btn btn-primary"></button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>






<!-- ---------------------------------------------------------------------------------------- -->
<script src="../../Recursos/js/Pais/pais.js"></script>