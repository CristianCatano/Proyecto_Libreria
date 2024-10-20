<?php

class ConexionDB {
    private $host;
    private $usuario;
    private $database;
    private $contrasena;
    private $conexion;

    public function __construct(){
    $this->host = "localhost";
    $this->usuario = "root";
    $this->database = "proyecto_libreria";
    $this->contrasena = "2014";
    }

    public static function get() {
        static $instancia = null;
        if ($instancia === null) {
            #echo "Se instanció la conexión a la base de datos...";
            $instancia = new ConexionDB();
            $instancia->conectar();
        }
        return $instancia;
    }

    public function conectar() {
        try{
            $conexionString = "mysql:host={$this->host};dbname={$this->database};charset=UTF8";
            $this->conexion = new PDO($conexionString, $this->usuario, $this->contrasena);
            if (!$this->conexion) {
             echo "Error inesperado al conectarse a la base de datos";
             exit();           
            }
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         } catch (PDOException $e) {
            #echo $e->getMessage();
            throw $e;
         }
    }

    public function query($consulta) {
        $consultaEjecutada = $this->conexion->query($consulta, PDO::FETCH_ASSOC);
        $resultado = $consultaEjecutada->fetchall();
        return $resultado;
    }

    public function insertar($tabla, $datos) {
        $columnas = implode(', ', array_keys($datos));
        $valores = array_values($datos);
        $tokens = implode(', ', array_fill(0, count($datos), "?"));
        $sql = "INSERT INTO {$tabla} ({$columnas}) VALUES ({$tokens})";
        $consultaAEjecutar = $this->conexion->prepare($sql);
        $resultado = $consultaAEjecutar->execute($valores);
        return $resultado;
    }

    public function actualizar($tabla, $id, $datos) {
        $columnas = array_keys($datos);
        $colsActualizar = array_map(function ($nombreColumna) {
            return "{$nombreColumna}=:{$nombreColumna}";
        }, $columnas);
        $sql = "UPDATE {$tabla} SET " . implode(', ', $colsActualizar) . " WHERE id=:id";
        $consultaAEjecutar = $this->conexion->prepare($sql);
        #vamos añadir el id al array de datos 
        $datos['id'] = $id;
        $resultado = $consultaAEjecutar->execute($datos);
        return $resultado;

    }

    public function eliminar($tabla, $id) {
        $sql = "DELETE FROM {$tabla} WHERE id=:id";
        $consultaAEjecutar = $this->conexion->prepare($sql);
        $resultado = $consultaAEjecutar->execute([ 'id' => $id ]);
        return $resultado;
    }
}