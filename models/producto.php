<?php

// Definición de la clase Producto
class Producto
{
    // Atributos privados de la clase
    private $db;           // Variable para la conexión a la base de datos
    private $productos;    // Array para almacenar los productos

    // Constructor de la clase
    public function __construct()
    {
        // Establece la conexión a la base de datos utilizando el método conectar de la clase Conexion
        $this->db = Conexion::conectar();
        // Inicializa el array de productos como un array vacío
        $this->productos = [];
    }

    // Método para listar todos los productos
    public function listar()
    {
        // Consulta SQL para obtener todos los productos de la base de datos
        $sql = "SELECT * FROM productos";

        // Ejecutar la consulta
        $resultado = $this->db->query($sql);

        // Verificar si la consulta falló
        if (!$resultado) {
            // Mensaje de error (para depuración, no se recomienda en producción)
            echo "Lo sentimos, este sitio está experimentando problemas.";
            echo "Error: La ejecución de la consulta falló debido a:\n";
            echo "Query: $sql\n";
            echo "Errno: " . mysqli_connect_errno() . "\n";
            echo "Error: " . mysqli_connect_error() . "\n";
            exit;
        }

        // Leer cada fila del resultado de la consulta
        while ($row = $resultado->fetch_assoc()) {
            // Agregar la fila al array de productos
            $this->productos[] = $row;
        }

        // Retornar el array de productos obtenidos
        return $this->productos;
    }

    public function obtenerCategorias()
    {
        $categorias = [];
        $sql = "SELECT id_categoria, tipo_categoria FROM categoria"; // Ajusta el nombre de la columna si es diferente
        $resultado = $this->db->query($sql);

        while ($row = $resultado->fetch_assoc()) {
            $categorias[] = $row;
        }

        return $categorias;
    }
    // Método para insertar un nuevo producto en la base de datos
    public function insert($nombre_producto, $precio_producto, $cantidad_producto, $id_categoria, $es_perecedero, $fecha_caducidad)
    {
        if ($es_perecedero && empty($fecha_caducidad)) {
            throw new Exception("Error: Los productos perecederos deben tener una fecha de caducidad.");
        }

        // Si el producto no es perecedero, la fecha debe ser NULL
        $fecha_caducidad = $es_perecedero ? "'$fecha_caducidad'" : "NULL";

        $sql = "INSERT INTO productos (nombre_producto, precio_producto, cantidad_producto, id_categoria, es_perecedero, fecha_caducidad) 
            VALUES ('$nombre_producto', $precio_producto, $cantidad_producto, $id_categoria, $es_perecedero, $fecha_caducidad)";

        if (!$this->db->query($sql)) {
            throw new Exception("Error en la inserción: " . $this->db->error);
        }
    }
    //eliminar el producto
    public function delete($id_producto)
    {
        $sql = "DELETE FROM productos
            WHERE id_producto = $id_producto";

        $resultado = $this->db->query($sql);
    }

    public function obtenerProducto($id_producto) {
        $sql = "SELECT id_producto, nombre_producto, precio_producto, id_categoria, cantidad_producto, es_perecedero, fecha_caducidad 
                FROM productos 
                WHERE id_producto = $id_producto";
        
        $resultado = $this->db->query($sql);
            $row = $resultado->fetch_assoc();
            return $row;
        }
        public function update($id_producto, $nombre_producto, $precio_producto, $cantidad_producto, $fecha_caducidad, $es_perecedero, $id_categoria)
    {
        $fecha_caducidad = $es_perecedero ? "'$fecha_caducidad'" : "NULL";
        $sql = "UPDATE productos 
            SET nombre_producto = '$nombre_producto', 
                precio_producto = $precio_producto, 
                cantidad_producto = $cantidad_producto, 
                fecha_caducidad = $fecha_caducidad, 
                es_perecedero = $es_perecedero, 
                id_categoria = $id_categoria 
            WHERE id_producto = $id_producto";

        $resultado = $this->db->query($sql);
    }
}
