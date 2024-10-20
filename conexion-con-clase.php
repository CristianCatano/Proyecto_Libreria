<?php

require_once "./Clases/ConexionDB.php";

#$db = new ConexionDB();
#$db->conectar();
#$resultado = $db->query("SELECT * FROM usuarios");

#$resultado = ConexionDB::get()->query("SELECT * FROM usuarios");
#$otroResultado = ConexionDB::get()->query("SELECT nombre  FROM usuarios");

#var_dump($resultado, $otroResultado);

#$datos = [
 #   'nombre' => 'Peranito',
  #  'email' => 'peranito@gmail.com',
   # 'contrasena' => '1234'
#];
#$resultado = ConexionDB::get()->insertar("usuarios", $datos);
#var_dump($resultado);

#$idAEditar = 4;
#$datosAModificar = [
    #'nombre' => 'USUARIO ACTUALIZADO',
    #'email' => 'emailactializado@gmail.com',
    #'contrasena' => '1',
#];
#$resultado = ConexionDB::get()->actualizar("usuarios", $idAEditar, $datosAModificar);
#var_dump($resultado);

$idAEliminar = 4;
$resultado = ConexionDB::get()->eliminar("usuarios", $idAEliminar);
var_dump($resultado);

