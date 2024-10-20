<h1>Crear nuevo usuario</h1>
<hr />

<form method="POST" action="./?controlador=usuarios&accion=crear">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre usuario</label>
        <input class="form-control" id="nombre" name="nombre">
    </div>
    <div class="mb-3">
        <laber for="email" class="form-label">E-mail</label>
        <input class="form-control" id="email" name="email" />
    </div>
    <div class="mb-3">
        <laber for="contrasena" class="form-label">Contraseña</label>
        <input class="form-control" id="contrasena" name="contrasena" />
    </div>
    <div class="mb-3">
        <a class="btn btn-info" href="./?controlador=usuarios&accion=listado">Cancelar</a>
        <button class="btn btn-dark" 
                type="submit"
                name="btn_registrar"
        >
                Guardar
        </button>
    </div>
</form>
