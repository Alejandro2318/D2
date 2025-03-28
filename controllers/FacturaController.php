<?php

class FacturaController {
    public function __construct()
    {
        require_once "models/Factura.php";
        require_once "models/Usuario.php";
        require_once "models/Producto.php";
        require_once "models/DetalleVenta.php";
        require_once "models/Caja.php";
    }

    public function index()
    {
        $facturas = new Factura();
        $data["titulo"] = "Facturas";
        $data["facturas"] = $facturas->listar();

        // Cargar la vista
        require_once "views/factura/index.php";
    }

    // Mostrar la vista para crear el registro
    public function insert()
    {
        $usuarios = new Usuario();
        $productos = new Producto();
        $cajas = new Caja();
        
        $data['titulo'] = "Nueva Factura";
        $data["usuarios"] = $usuarios->listar();
        $data["productos"] = $productos->listar();
        $data["cajas"] = $cajas->obtenerCaja(); 
        
        require_once "views/factura/insert.php";
    }

    // Guardar la información en la DB
    public function store()
    {
        $factura = new Factura();
        $detalleVenta = new DetalleVenta();

        // ✅ Obtener la caja activa
        $id_caja = $factura->obtenerCajaActiva();

        if (!$id_caja) {
            die("Error: No hay una caja activa.");
        }

        date_default_timezone_set('America/Bogota');
        $fecha_factura = date('Y-m-d h:i:s A');
        $total_factura = $_POST['total_factura'] ?? 0;

        // ✅ Insertamos la factura y obtenemos su ID
        $id_factura = $factura->insert($total_factura, $fecha_factura, $id_caja);

        if (!$id_factura) {
            die("Error: No se pudo crear la factura.");
        }

        // ✅ Insertar los productos en detalle_venta
        $productos = $_POST['productos'] ?? [];

        foreach ($productos as $producto) {
            if (!empty($producto['id_producto']) && !empty($producto['cantidad']) && !empty($producto['subtotal'])) {
                $detalleVenta->insert(
                    $producto['cantidad'],
                    $producto['subtotal'],
                    $producto['id_producto'],
                    $id_factura
                );
            }
        }

        // ✅ Redirigir a la vista de facturas
        $this->index(); // 🔥 Redirección usando la función directamente
    }
}

?>
