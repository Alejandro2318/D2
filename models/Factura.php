<?php

class Factura 
{
    // Atributos
    private $db;
    private $facturas;

    // Contructor
    public function __construct()
    {
        $this->db = Conexion::conectar();
        $this->facturas = [];
    }

    // Métodos

    public function listar()
    {
        $sql = "SELECT *
                FROM factura";
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
            $this->facturas[] = $row;
        }

        return $this->facturas;
    }

    public function insert($total_factura, $fecha_factura, $id_caja) 
{
    $sql = "INSERT INTO factura (total_factura, fecha_factura, id_caja) 
            VALUES (?, ?, ?)";

    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("dsi", $total_factura, $fecha_factura, $id_caja);

    if ($stmt->execute()) {
        return $this->db->insert_id; // Retorna el ID de la factura insertada
    } else {
        die("Error al insertar la factura: " . $stmt->error);
    }
}
public function obtenerCajaActiva()
{
    $sql = "SELECT id_caja FROM caja WHERE estado_caja = 1 LIMIT 1"; // Busca la caja abierta

    $resultado = $this->db->query($sql);

    if ($fila = $resultado->fetch_assoc()) {
        return $fila['id_caja'];
    }

    return null; // No hay caja abierta
}




    

    

    
}

?>