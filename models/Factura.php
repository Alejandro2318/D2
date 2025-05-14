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
        if (!$resultado) {
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
        while ($row = $resultado->fetch_assoc()) {
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

   public function obtenerTotalVentaDia($fechaInicio = null, $fechaFin = null)
{
    $totalVentaDia = [];

    $condiciones = [];
    if ($fechaInicio) {
        $condiciones[] = "DATE(fecha_factura) >= '" . $this->db->real_escape_string($fechaInicio) . "'";
    }
    if ($fechaFin) {
        $condiciones[] = "DATE(fecha_factura) <= '" . $this->db->real_escape_string($fechaFin) . "'";
    }

    $where = '';
    if (!empty($condiciones)) {
        $where = 'WHERE ' . implode(' AND ', $condiciones);
    }

    $sql = "SELECT DATE(fecha_factura) AS fecha, SUM(total_factura) AS total_ventas
            FROM factura
            $where
            GROUP BY DATE(fecha_factura)
            ORDER BY fecha DESC";

    $resultado = $this->db->query($sql);

    while ($row = $resultado->fetch_assoc()) {
        $totalVentaDia[] = $row;
    }

    return $totalVentaDia;
}


public function getFactura($id_factura)
{
    $sql = "SELECT factura.*, caja.*, usuario.*
            FROM factura
            JOIN caja ON caja.id_caja = factura.id_caja
            JOIN usuario ON usuario.id_usuario = caja.id_usuario
            WHERE factura.id_factura = ?";

    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $id_factura);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    return $resultado->fetch_assoc();
}


//eliminar la factura metodo viviam
public function delete($id_factura)
{
    $sql = "DELETE FROM factura
        WHERE id_factura = $id_factura";

    $resultado = $this->db->query($sql);
}


}

?>