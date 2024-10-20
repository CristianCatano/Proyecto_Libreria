<?php
#No es necesario hacer el import

class Controladorinicio extends ControladorBase {
    public $requiereLogin = true;

    public function inicio() {
        $this->mostrarVista("inicio", "dashboard");
    }

    public function login() {
        echo "Pantalla de inicio de sesión";
    }

    public function acercaDe() {
        $this->mostrarVista("inicio", "acercaDe");
    }
}

