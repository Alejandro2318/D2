<?php

class Usuario
{
    // Atributos
    private $db;
    private $usuarios;

    // Contructor
    public function __construct()
    {
        $this->db = Conexion::conectar();
        $this->usuarios = [];
    }

    // Métodos

    public function listar()
    {
        $sql = "SELECT *
                FROM usuario";
        // Ejecució de la consulta
        $resultado = $this->db->query($sql);

        // Si falla la consulta
        if(!$resultado)
        {
            // ¡Oh, no! La consulta falló :(
            echo "Lo sentimos, este sitio está experimentando problemas.";

            // OJO: No hacer esto en producción!!!!
            echo "Error: La ejecución de la consulta falló debido a:\n";
            echo "Query: $sql\n";
            echo "Errno: " . mysqli_connect_errno() . "\n";
            echo "Error: " . mysqli_connect_error() . "\n";
            exit;
        }

        // Leer cada fila del resultado
        while($row = $resultado->fetch_assoc())
        {
            // Agregar la fila al final del arreglo productos
            $this->usuarios[] = $row;
        }

        return $this->usuarios;
    }


    public function obtenerCargos()
{
    $cargos = [];
    $sql = "SELECT id_cargo, tipo_cargo FROM cargo"; // Ajusta el nombre de la columna si es diferente
    $resultado = $this->db->query($sql);

    while ($row = $resultado->fetch_assoc()) {
        $cargos[] = $row;
    }

    return $cargos;
}


    public function insert($nombre_usuario, $contraseña, $id_cargo) 
    {
        $sql = "INSERT INTO usuario( nombre_usuario, contraseña, id_cargo)
                VALUES('$nombre_usuario', '$contraseña', $id_cargo)";
        
        $this->db->query($sql);
    }


    // Obtener la información de un Producto
    public function getUsuario($id_usuario)
    {
        $sql = "SELECT * 
                FROM usuario
                WHERE id_usuario = $id_usuario";
        
        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    }

    // Actualizar el Producto
    public function update($id_usuario, $nombre_usuario, $contraseña, $id_cargo)
    {
        $sql = "UPDATE usuario
                SET nombre_usuario = '$nombre_usuario', contraseña = '$contraseña', id_cargo = $id_cargo
                WHERE id_usuario = $id_usuario";
        
        $resultado = $this->db->query($sql);
    }

    // Eliminar un registro
    public function delete($id_usuario)
    {
        $sql = "DELETE FROM usuario
                WHERE id_usuario = $id_usuario";

        $resultado = $this->db->query($sql);
    }
}

?>