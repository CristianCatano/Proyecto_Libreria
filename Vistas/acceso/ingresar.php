<div class="container">
    <!-- contenedor principal -->
    <div class="row justify-conter-center">
        <!-- contenedor para centrar -->
         <div class="col-md-6">
            <!-- columna -->
             <div class="card">
                <!-- Inicio card -->
                 <div class="card-header">
                    Inicio sesión
                 </div>
                 <div class="card-body">
                    <!-- Inicio Body o formulario -->
                      <form 
                       action="<?= ruta('acceso', 'ingresar') ?>"
                       method="POST"
                     >
                        <!-- Inicio formulario -->
                         <div class="form-group">
                            <label for="email">E-mail</label>
                           <input 
                             id="email"
                             name="email"
                             type="text"
                             class="form-control"
                             placeholder="Ingresa tu e-mail ej. 	cristian_andresct@hotmail.com"
                           />
                         </div>
                         <div class="form-group">
                            <label for="contrasena">Contraseña</label>
                           <input
                              id="contrasena"
                              name="contrasena"
                              type="password"
                              class="form-control"
                              placeholder="Ingrese tu contraseña ej. 1234"
                           />
                         </div>
                         <button 
                          type="submit" 
                          class="btn btn-primary"
                          name="btn_login"
                        >
                          Ingresar
                        </button>
                         <!-- Fin formulario -->
                      </form>  
                     <!-- Fin Body o formulario -->
                 </div>
                 <!-- fin Card -->
             </div>
             <!-- fin columna -->
         </div>
         <!-- fin contenedor para centrar -->
    </div>
      <!-- fin contenedor principal -->
</div>