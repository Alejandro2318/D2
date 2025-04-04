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
        
        $estadoCaja = $cajas->getEstado();
        if ($estadoCaja != 1) {
            $_SESSION['cajaCerrada'] = true; 
        } else {
            $_SESSION['cajaCerrada'] = false;
        }

        $data['titulo'] = "Nueva Factura";
        $data["usuarios"] = $usuarios->listarCajeros(); // filtramos los usuarios con id_cargo = 2 que serian cajeros 
        $data["productos"] = $productos->listar();
        $data["cajas"] = $cajas->obtenerCaja(); 
        
        require_once "views/factura/insert.php";
    }

    // Guardar la información en la DB
  
    public function store()
    {
        $factura = new Factura();
        $detalleVenta = new DetalleVenta();
        $caja = new Caja();
        $productoModel = new Producto(); // Agregar modelo de productos
  
  
  // ✅ Obtener la caja activa
    $id_caja = $factura->obtenerCajaActiva();
    if (!$id_caja) {
        die("Error: No hay una caja activa.");
    }

        date_default_timezone_set('America/Bogota');
        $fecha_factura = date('Y-m-d h:i:s A');
        $total_factura = $_POST['total_factura'] ?? 0;

        $id_caja = $caja -> obtenerCaja2();
        // ✅ Insertamos la factura y obtenemos su ID
        $id_factura = $factura->insert($total_factura, $fecha_factura, $id_caja);


    // ✅ Insertamos la factura y obtenemos su ID
    $id_factura = $factura->insert($total_factura, $fecha_factura, $id_caja);
    if (!$id_factura) {
        die("Error: No se pudo crear la factura.");
    }

    // ✅ Insertar los productos en detalle_venta y actualizar stock
    $productos = $_POST['productos'] ?? [];
    foreach ($productos as $producto) {
        if (!empty($producto['id_producto']) && !empty($producto['cantidad']) && !empty($producto['subtotal'])) {
            $detalleVenta->insert(
                $producto['cantidad'],
                $producto['subtotal'],
                $producto['id_producto'],
                $id_factura
            );

            // 🔥 Descontar stock del producto
            $productoModel->actualizarStock($producto['id_producto'], $producto['cantidad']);
        }
    }


    // ✅ Redirigir a la vista de facturas
    $this->index();
}

    // Visualizar la información de un registro
    public function view($id_factura)
    {
        $factura = new Factura();
        $data['titulo'] = "Factura de la venta";
        $data['factura'] = $factura->getFactura($id_factura);

        $detallesVenta = new DetalleVenta();
        $data['detallesVenta'] = $detallesVenta->listar($id_factura);

        // Cargar la vista
        require_once "views/factura/view.php";
    }

}

?>
