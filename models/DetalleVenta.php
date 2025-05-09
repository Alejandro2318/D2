<?php

class DetalleVenta 
{
    // Atributos
    private $db;
    private $detallesVenta;

    // Contructor
    public function __construct()
    {
        $this->db = Conexion::conectar();
        $this->detallesVenta = [];
    }

    // Métodos

    public function listar($id_factura)
    {
        $sql = "SELECT *
                FROM detalle_venta
                JOIN productos ON productos.id_producto = detalle_venta.id_producto
                WHERE id_factura = $id_factura";
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
            // Agregar la fila al final del arreglo clientes
            $this->detallesVenta[] = $row;
        }

        return $this->detallesVenta;
    }

    

    public function insert($cantidad_producto_venta, $subtotal,$id_producto, $id_factura, ) 
{
    // Verificar si la factura existe antes de insertar el detalle
    $checkFactura = $this->db->query("SELECT id_factura FROM factura WHERE id_factura = $id_factura");
    if ($checkFactura->num_rows == 0) {
        die("Error: La factura con ID $id_factura no existe.");
    }

    $sql = "INSERT INTO detalle_venta (cantidad_producto_venta,subtotal,id_producto, id_factura) 
            VALUES ($cantidad_producto_venta,$subtotal, $id_producto, $id_factura)";

            // Ejecutar la consulta
    if ($this->db->query($sql) === TRUE) {
        return true;
    } else {
        die("Error al insertar detalle de venta: " . $this->db->error);
    }

}

public function listarDetalleVenta($id_factura)
{
    $sql = "SELECT detalle_venta.id_detalle_venta, detalle_venta.cantidad_producto_venta, detalle_venta.subtotal, detalle_venta.id_producto, detalle_venta.id_factura
            FROM detalle_venta
            WHERE detalle_venta.id_factura = ?";

    $stmt = $this->db->prepare($sql);

    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . $this->db->error);
    }

    $stmt->bind_param("i", $id_factura);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Leer cada fila del resultado
    $detallesVenta = [];
    while ($row = $resultado->fetch_assoc()) {
        $detallesVenta[] = $row;
    }

    return $detallesVenta;
}



}

?>