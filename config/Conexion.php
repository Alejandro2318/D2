<?php
class Conexion {
    public static function conectar(){
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'd2';

        $conexion = new mysqli($host, $user, $password, $database);

        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }
        return $conexion;
    }
}
