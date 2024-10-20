<?php

require_once "./Clases/Aplicacion.php";
#se puede de esta manera
#$controlador = isset($_GET['controlador']) ? $_GET['controlador'] : 'inicio';

#tambien se puede de esta otra
#$controlador = "inicio";
#if (isset($_GET['controlador'])) {
 #   $controlador = $_GET ['controlador'];
#}

#la tercera manera
#$controlador = $_GET['controlador'] ?? 'inicio';


#este es un ejemplo de cargar controladores-este no es optimo porque tocaria uno por uno
#if ($controlador === 'inicio') {
 #   require_once "./Controladores/ControladorInicial.php";
#} else if ($controlador === 'usuarios') {
 #   require_once "./Controladores/ControladorUsuarios.php";
#} else {
 #   echo "Controlador invalido";
#}
    
#echo "Punto de entrada";

$aplicacion = new Aplicacion(__DIR__);
$aplicacion->correrApp();