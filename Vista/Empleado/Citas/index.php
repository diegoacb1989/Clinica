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
              <th>Nombre paciente</th>
              <th>Nombre medico</th>
              <th>fecha</th>
              <th>descripcion</th>
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

      <form id="formCita">
       

        <div class="form-group">
            <label for="exampleInputEmail1" id="labelFecha"></label>
            <input type="date" class="form-control" id="fecha" name="fecha" aria-describedby="emailHelp">        
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1" id="labelDescripcion"></label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Maximo docientos sincuenta caracteres"></textarea>    
       </div>


        <div class="form-group">
            <label for="exampleInputEmail1" id="labelMedico"></label>
            <select class="form-select form-select-lg mb-3" name="selectMedico" id="selectMedico" aria-label=".form-select-lg example">
       
        </select>

        <div class="form-group">
            <label for="exampleInputEmail1" id="labelPaciente"></label>
            <select class="form-select form-select-lg mb-3" name="selectPaciente" id="selectPaciente" aria-label=".form-select-lg example">
       
        </select>
      <br>
        <input type="hidden" value="" id="accion" name="accion">
        <input type="hidden" value="" id="tipo2" name="tipo2">
        <input type="hidden" value="" id="id_cita" name="id_cita">
        <button type="button" id="btnCita" class="btn btn-primary"></button>
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
<script src="../../Recursos/js/Citas/citas.js"></script>