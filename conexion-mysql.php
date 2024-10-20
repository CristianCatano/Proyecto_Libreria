<?php

#echo "hola mundo";

$host = "localhost";
$database = "proyecto_libreria";
$usuario = "root";
$contrasena = "2014";

$conexionString = "mysql:host={$host};dbname={$database};charset=UTF8";

try{
   $conexion = new PDO($conexionString, $usuario, $contrasena);
   if (!$conexion) {
    echo "Error inesperado al conectarse a la base de datos";
    exit();           
   }
   $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $consulta = "SELECT * FROM usuarios";
   $consultaEjecutada = $conexion->query($consulta, PDO::FETCH_ASSOC);
   $resultado = $consultaEjecutada->fetchall();
   var_dump($resultado);
}catch (PDOException $e) {
   echo $e->getMessage();
   throw $e;
}
