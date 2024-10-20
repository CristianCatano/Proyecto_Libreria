<?php

class Aplicacion {
    private $nombreControlador;
    private $nombreAccion;
    private $carpetaRaiz;

    # Instancia del cotrolador
    private $controlador;

    public function __construct($carpetaRaiz) {
        $this->carpetaRaiz = $carpetaRaiz;
    }

    public function redireccionar ($controlador, $accion, $parametros = []) {
        $url = ruta($controlador, $accion, $parametros);
        header('Location: ' . $url);
        exit(); 
    }

    #metodo para importar los controladores
    public function cargarControlador() {
        $nombreRealControlador = "Controlador" . ucfirst($this->nombreControlador);
        $dirControlador = "{$this->carpetaRaiz}/Controladores/{$nombreRealControlador}.php";
        #validamos si existe un controlador con ese nombre
        if (!realpath($dirControlador)) {
            throw new Exception("No existe el archivo {$dirControlador}");
        }
        #importamos
        require_once "{$this->carpetaRaiz}/Clases/ConexionDB.php";
        require_once "{$this->carpetaRaiz}/Utilidades/funciones.php";
        require_once "{$this->carpetaRaiz}/Controladores/ControladorBase.php";
        require_once $dirControlador;
        #Validamos que exista una clase de controlador 
        if (!class_exists($nombreRealControlador)) {
            throw new Exception("No existe el controlador {$nombreRealControlador}"); 
        }

        # instancia del controlador cargado
        $this->controlador = new $nombreRealControlador($this);
        # Vamos a validar si se ha iniciado sesión
        if ($this->controlador->getRequiereLogin() && !isset($_SESSION['logueado'])){
            $this->redireccionar("acceso", "ingresar");
        }
    }

    
     #funcion para correr mi aplicacion
     public function correrApp() {
        # Inicializar la sesión
        #Siempre que se trabaja con sesiones
        # Hay que decirle a php que las active
        session_start();

        $this->nombreControlador = $_GET['controlador'] ?? 'inicio';
        $this->nombreAccion = $_GET['accion'] ?? 'inicio'; 
        $this->cargarControlador();
        #validamos que el controlador tenga una función con el nombre de la acción
        if (!method_exists($this->controlador, $this->nombreAccion)) {
            throw new Exception("No existe la acción {$this->nombreAccion}");
        }
        call_user_func_array([ $this->controlador, $this->nombreAccion ], []);
     }
     
     public function getCarpetaRaiz() {
        return $this->carpetaRaiz;
     }
}