<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>

            <button type="button" class="btn btn-primary" id="btnAgregar" data-toggle="modal" data-target="#exampleModal">
               <i class='fa fa-save'> </i>
                <span>Nuevo</span>
            </button>

    </div>
    
    <div class="card-body">

    <div class="table-responsive-xl">
        <table id="tabla" class="table table-striped" cellspacing="0" width="100%">
          <thead>
          <tr>
              <th>Codigo</th>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Direccion</th>
              <th>Telefono</th>
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

      <form id="formProveedor">
       

        <div class="form-group">
            <label for="exampleInputEmail1" id="labelFecha">Ingrese nombre del proveedor</label>
            <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="emailHelp">        
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1" id="labelDescripcion">Ingrese descripcion del proveedor</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder=""></textarea>    
       </div>

       <div class="form-group">
            <label for="exampleFormControlTextarea1" id="labelDescripcion">Ingrese direccion del proveedor</label>
            <input type="text" class="form-control" id="direccion" name="direccion" aria-describedby="emailHelp">      
       </div>

       <div class="form-group">
            <label for="exampleFormControlTextarea1" id="labelDescripcion">Ingrese telefono del Proveedor</label>
            <input type="text" class="form-control" id="telefono" name="telefono" aria-describedby="emailHelp">   
       </div>

      <br>
        <input type="hidden" value="" id="accion" name="accion">
        <input type="hidden" value="" id="id_proveedor" name="id_proveedor">
        <button type="button" id="btnProveedor" class="btn btn-primary"></button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!---------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------->
<script src="../../Recursos/js/Proveedor/Proveedor.js"></script>