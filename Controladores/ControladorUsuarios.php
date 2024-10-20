<?php

class ControladorUsuarios extends ControladorBase {
    public $requiereLogin = true;
    
    public function listado() {
        $query = "SELECT * FROM usuarios";
        $filtros = [];
        # Validamos si se quiere filtrar
        if (isset($_POST['btn_filtrar'])) {
            $condiciones = [];
            $nombre = $_POST['nombre'] ?? false;
            $email = $_POST['email'] ?? false;
            $id = $_POST['id'] ?? false;
            if ($nombre !== false && !empty($nombre)) {
                $condiciones[] = "nombre LIKE '%{$nombre}%'";
            }
            if ($email !== false && !empty($email)) {
                $condiciones[] = "email LIKE '%{$email}%'";
            }
            if ($id !== false && !empty($id)) {
                $condiciones[] = "id='{$id}'";
            }
            # Concateno las condiciones
            if (count($condiciones) > 0) {
                # $query = $query . "";
                $query .= " WHERE " . implode(' AND ', $condiciones);
            }
            $filtros = [
                'nombre' => $nombre,
                'email' => $email,
                'id' => $id
            ];
        }
        $usuarios = ConexionDB::get()->query($query);
        $this->mostrarVista("usuarios", "listado" , [
            'datos' => $usuarios,
            'filtros' => $filtros,
        ]); 
    }

    public function crear () {
        if (isset($_POST['btn_registrar'])) {
            echo "Formulario enviado !!";
            $nombre = $_POST['nombre'] ?? '';
            $contrasena = $_POST['contrasena'] ?? '';
            $email = $_POST['email'] ?? '';
            $usuarioGuardado = ConexionDB::get()->insertar("usuarios", [
                'nombre' => $nombre,
                'contrasena' => $contrasena,
                'email' => $email
            ]);
            if ($usuarioGuardado) {
                # redireccionar a inicio
                #header('Location: http://localhost/proyecto-libreria/?controlador=usuarios&accion=listado');
                #exit();
                $this->app->redireccionar("usuarios", "listado"); 
            } else {
                throw new Exception("Error al guardar el usuario");
                exit();
            }
        }
        $this->mostrarVista("usuarios", "crear");
    }

    public function editar() {
        $idUsuario = $_GET['id'];
        # Traer los datos del usuario a editar
        $sqlUsuario = "SELECT * FROM usuarios WHERE id ='{$idUsuario}'";
        $resultado = ConexionDB::get()->query($sqlUsuario);
        $usuario = $resultado[0] ?? null;
        if ($usuario === null) {
            throw new Exception("Usuario con ID #{$idUsuario} no existe");
        }

        if (isset($_POST['btn_actualizar'])) {
            $usuarioActualizado = ConexionDB::get()
                ->actualizar("usuarios", $idUsuario, [
                    'nombre' => $_POST['nombre'] ?? '',
                    'email' => $_POST['email'] ?? '',
                    'contrasena' => $_POST['contrasena'] ?? ''
                ]);
            if ($usuarioActualizado) {
                $this->app->redireccionar("usuarios", "listado"); 
            } else {
                throw new Exception("Error al actualizar el usuario");
            }              
        }
        
        $this->mostrarVista("Usuarios", "editar", [
            'usuario' => $usuario
        ]);
    }

    public function eliminar() {
        $idUsuario = $_GET['id'];
        $sqlUsuario = "SELECT * FROM usuarios WHERE id ='{$idUsuario}'";
        $resultado = ConexionDB::get()->query($sqlUsuario);
        $usuario = $resultado[0] ?? null;
        if ($usuario === null) {
            throw new Exception("Usuario con ID #{$idUsuario} no existe");
        }
        $usuarioEliminado = ConexionDB::get()->eliminar("usuarios", $idUsuario);
        if ($usuarioEliminado) {
           $this->app->redireccionar("usuarios", "listado");
        } else {
            throw new Exception("Error al eliminar el usuario");
        }
    }
}

