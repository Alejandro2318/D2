<?php

class FacturaController {
    public function __construct()
    {
        require_once "models/Factura.php";
        require_once "models/Usuario.php";
        require_once "models/producto.php";
        require_once "models/DetalleVenta.php";
    }

    public function index()
    {
        $facturas = new Factura();
        $data["titulo"] = "Facturas";
        $data["facturas"] = $facturas->listar();

        // Cargar la vista
        require_once "views/factura/index.php";
    }

    // Mostrar la vista para crear el registro (Proyecto)
    public function insert()
    {
        $usuarios = new Usuario();
        $productos = new Producto();
        $data['titulo'] = "Nueva Factura";
        $data["usuarios"] = $usuarios->listar();
        $data["productos"] = $productos->listar();
        require_once "views/factura/insert.php";
    }

     // Guardar la información en la DB
    public function store()
{
    $factura = new Factura();
    $detalleVenta = new DetalleVenta(); // Agregar el modelo de DetalleVenta

    $id_caja = $factura->obtenerCajaActiva();

    if (!$id_caja) {
        die("Error: No hay una caja activa.");
    }

    $fecha_factura = (new DateTime())->format('Y-m-d H:i:s');
    $total_factura = $_POST['total_factura'] ?? 0;

    // Insertamos la factura y obtenemos su ID
    $id_factura = $factura->insert($total_factura, $fecha_factura, $id_caja);

    if (!$id_factura) {
        die("Error: No se pudo crear la factura.");
    }

    // 4️⃣ Insertar los productos en detalle_venta
    $productos = $_POST['productos'] ?? [];
    $detalleVenta = new DetalleVenta();

    foreach ($productos as $producto) {
        $detalleVenta->insert(
            $producto['cantidad_producto_venta'],
            $producto['subtotal'],
            $producto['id_producto'],
            $id_factura
        );
    }


    // Redirigir a la vista de facturas
    $this->index();
}





    
    
    
    

    
}
?>