<?php

abstract class ControladorBase {
    protected $app;
    protected $plantilla = "base";
    protected $requiereLogin = false;

    public function __construct($app) {
        $this->app = $app;
    }

    public function getRequiereLogin () {
        return $this->requiereLogin;
    }

    public function mostrarVista($modulo, $vista, $variables = []) {
        $dirVistas = $this->app->getCarpetaRaiz() . "/Vistas";
        # Vamos a mover este import a la aplicación
        #$dirUtilidades = $this->app->getCarpetaRaiz() . "/Utilidades";
        $dirVistaAMostrar = "{$dirVistas}/{$modulo}/{$vista}.php";
        $dirPlantilla = "{$dirVistas}/plantillas/{$this->plantilla}.php";
        # Declarar variables para las vistas
        foreach ($variables as $clave=> $valor) {
            $$clave = $valor;
        }
        #include($dirUtilidades . "/funciones.php");
        ob_start();
        include $dirVistaAMostrar;
        $contenido = ob_get_clean();
        ob_start();
        include $dirPlantilla;
        $plantilla = ob_get_clean();
        echo $plantilla;
        exit();
    }
}