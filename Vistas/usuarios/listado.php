    <h1>Listado de usuarios</h1>
    <div>
        <!--
        <a 
           href="./?controlador=usuarios&accion=crear" 
           class="btn btn-primary"
    >
        Registrar usuario
    </a>
    Equivale a lo de abajo
    -->
    <?= crearLink("Registrar usuario", [
            'controlador' => 'usuarios',
            'accion' => 'crear',
            'optionsHtml' => [
             'class' => 'btn btn-primary'
          ]
        ]) 
    ?>
</div>
<hr />
<!-- inicio filtros -->
<form 
  class="card"
  action="<?= ruta('usuarios', 'listado') ?>"
  method="POST"
>
    <div class="card-header">
      Filtros
    </div>
    <div class="cardbody">
       <div class="row">
         <div class="col">
           <input 
              type="text"
              class="form-control"
              placeholder="Filtrar por nombre"
              name="nombre"
              value="<?= $filtros['nombre'] ?? '' ?>"
            />
         </div>
         <div class="col">
          <!-- trim() -->
           <input 
              type="text"
              class="form-control"
              placeholder="Filtrar por e-mail"
              name="email"
              value="<?= $filtros['email'] ?? '' ?>"
            />
         </div>
         <div class="col">
          <!-- trim() -->
           <input 
              type="text"
              class="form-control"
              placeholder="Filtrar por ID"
              name="id"
              value="<?= $filtros['id'] ?? '' ?>"
            />
         </div>
         <div class="col">
          <button class="btn btn-primary" name="btn_filtrar" type="submit">
            Filtrar
          </button>
         </div>
       </div>
    </div>
</form>
<!-- Fin filtros -->
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Contraseña</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody> 
    <?php foreach ($datos as $usuario) { ?>
        <tr>
            <th scope="row">
                <?= $usuario['id'] ?>
        </th>
        <td>
                <?= $usuario['nombre'] ?>
        </td>
        <td>    
                <?= $usuario['email'] ?>
        </td>
        <td>
                <?= $usuario['contrasena'] ?>
        </td>
        <td>
        <?= crearLink("Editar", [
            'controlador' => 'usuarios',
            'accion' => 'editar',
            'parametros' => [
                'id' => $usuario['id']
            ],
            'optionsHtml' => [
              'class' => 'btn btn-outline-info btn-sm'
          ]
        ]) 
    ?>
            <?= crearLink("Eliminar", [
            'controlador' => 'usuarios',
            'accion' => 'Eliminar',
            'parametros' => [
                'id' => $usuario['id']
            ],
            'optionsHtml' => [
              'class' => 'btn btn-outline-danger btn-sm'
          ]
        ]) 
    ?>
        </td>
        </tr>
    <?php } ?>
  </tbody>
</table>
