<?php

class ControladorAcceso extends ControladorBase {

    public function ingresar() {
        #Definimos la plantilla a utilizar
        # validamos que el formulario se envia al
        # Validar que post contiene la posición btn_login
        if (isset($_POST['btn_login'])) {
           # La condicion solo se cumple cuando se presiona el botón
           $email = $_POST['email'] ?? '';
           $contrasena = $_POST['contrasena'] ?? '';
           $sql = "SELECT * FROM usuarios WHERE " 
            . "email='{$email}' " 
            . " AND contrasena='{$contrasena}' ";
           $resultado = ConexionDB::get()->query($sql);

           $usuarioEncontrado = $resultado[0] ?? false;

           # Condición que valida las credenciales
           if ($usuarioEncontrado !== false && !is_null($usuarioEncontrado)) {
            $_SESSION['logueado'] = true;
            $_SESSION['id_usuario'] = $usuarioEncontrado['id'];
            $_SESSION['nombre_usuario'] = $usuarioEncontrado['nombre'];
            $_SESSION['email'] = $usuarioEncontrado['email'];
            # Por seguridad no se guarda la contraseña en la sesión
            $this->app->redireccionar("inicio", "inicio");
           }
        }
        $this->plantilla = "vacia";
        $this->mostrarVista("acceso", "ingresar");
    }

    public function salir() {
        session_destroy();
        $this->app->redireccionar("acceso", "ingresar");
    }

}