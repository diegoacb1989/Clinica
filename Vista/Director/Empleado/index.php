<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
               <i class='fa fa-save'> </i>
                <span>Nuevo</span>
            </button>

    </div>
    
    <div class="card-body">

    <div class="table-responsive-xl">
        <table id="tabla" class="table table-striped" cellspacing="0" width="100%">
          <thead>
          <tr>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Correo</th>
              <th>Direccion</th>
              <th>Telefono</th>
              <th>Celular</th>
              <th>Usuario</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form id="formPersona">
        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres" aria-describedby="emailHelp">
            
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" aria-describedby="emailHelp">
          
        </div>

        
        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese direccion</label>
            <input type="text" class="form-control" id="direccion" name="direccion" aria-describedby="emailHelp">
          
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese telefono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" aria-describedby="emailHelp">
         
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese celular</label>
            <input type="text" class="form-control" id="celular" name="celular" aria-describedby="emailHelp">

        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese correo</label>
            <input type="text" class="form-control" id="correo" name="correo" aria-describedby="emailHelp">
       
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" aria-describedby="emailHelp">
        
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" aria-describedby="emailHelp">
            
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">repetir contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="repContra" aria-describedby="emailHelp">
           
        </div>
        <input type="hidden" value="nuevo" name="accion">
        <input type="hidden" value="Empleado" name="rol" id="rol">
        <button type="button" id="btnRegistrar" class="btn btn-primary">Registrar</button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- ----------------------------------->

<div class="modal fade" id="modalActualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form id="formActualizar">
        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese nombres</label>
            <input type="text" class="form-control" id="nombresAct" name="nombresAct" aria-describedby="emailHelp">
            
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese apellidos</label>
            <input type="text" class="form-control" id="apellidosAct" name="apellidosAct" aria-describedby="emailHelp">
          
        </div>

        
        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese direccion</label>
            <input type="text" class="form-control" id="direccionAct" name="direccionAct" aria-describedby="emailHelp">
          
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese telefono</label>
            <input type="text" class="form-control" id="telefonoAct" name="telefonoAct" aria-describedby="emailHelp">
         
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese celular</label>
            <input type="text" class="form-control" id="celularAct" name="celularAct" aria-describedby="emailHelp">

        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese correo</label>
            <input type="text" class="form-control" id="correoAct" name="correoAct" aria-describedby="emailHelp">
       
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Ingrese usuario</label>
            <input type="text" class="form-control" id="usuarioAct" name="usuarioAct" aria-describedby="emailHelp">
        
        </div>



       
        <input type="hidden" value="editar" name="accion">
        <input type="hidden" value="" name="usuarioActAnt" id="usuarioActAnt">
        <input type="hidden" value="" name="id_persona" id="id_persona">
   

        <button type="button" id="btnAct" class="btn btn-primary">Actualizar</button>
</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>





<!-- ---------------------------------------------------------------------------------------- -->
<script src="../../Recursos/js/Persona/funcionesPersona.js"></script>