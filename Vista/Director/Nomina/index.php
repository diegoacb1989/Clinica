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
              <th>N.Empleado</th>
              <th>S.Basico</th>
              <th>H.Extras</th>
              <th>V.h.extra</th>
              <th>fecha</th>
              <th>S.Total</th>
              <th>Act</th>
              <th>Eli</th>
              
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

      <form id="formNomina">
        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese salario basico</label>
            <input type="text" class="form-control" id="salarioBasico" name="salarioBasico" aria-describedby="emailHelp">
            
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese cantidad horax extras</label>
            <input type="text" class="form-control" id="cantiHorExt" name="cantiHorExt" aria-describedby="emailHelp">
          
        </div>

        
        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese valor de horas extras</label>
            <input type="text" class="form-control" id="valHhrExtra" name="valHhrExtra" aria-describedby="emailHelp">
          
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" aria-describedby="emailHelp">
         
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Selecione empleado</label>
            <select class="form-select form-select-lg mb-3" name="selectEmpleado" id="selectEmpleado" aria-label=".form-select-lg example">
       
        </select>
        </div>

        <input type="hidden" value="" id="accion" name="accion">
        <input type="hidden" value="Empleado" name="id_empleado" id="id_empleado">
        <input type="hidden" value="Empleado" name="id_nomina" id="id_nomina">
        <button type="button" id="btnNomina" class="btn btn-primary">Registrar</button>
           
        
    
</form>

  </div>
 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<script src="../../Recursos/js/Nomina/nomina.js"></script>