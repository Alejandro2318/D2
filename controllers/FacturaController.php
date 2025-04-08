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
  

    // Cambie todo el store, con el fin de hacer las condicionales del stock
    public function store()
{
    $factura = new Factura();
    $detalleVenta = new DetalleVenta();
    $caja = new Caja();
    $productoModel = new Producto();

    // ✅ Obtener la caja activa
    $id_caja = $factura->obtenerCajaActiva();
    if (!$id_caja) {
        die("Error: No hay una caja activa.");
    }

    date_default_timezone_set('America/Bogota');
    $fecha_factura = date('Y-m-d h:i:s A');
    $total_factura = $_POST['total_factura'] ?? 0;

    $productos = $_POST['productos'] ?? [];

    // ✅ Validar stock antes de insertar la factura
    foreach ($productos as $producto) {
        $idProducto = $producto['id_producto'];
        $cantidadSolicitada = $producto['cantidad'];

        // Obtener información actual del producto
        $infoProducto = $productoModel->getProducto($idProducto); // Asegúrate de tener esta función en tu modelo
        if (!$infoProducto) {
            die("Error: El producto con ID $idProducto no existe.");
        }

        $stockDisponible = $infoProducto['cantidad_producto'];
        if ($cantidadSolicitada > $stockDisponible) {
            $_SESSION['stockInsuficiente'] = [
                'producto' => $infoProducto['nombre_producto'],
                'disponible' => $stockDisponible
            ];
            header("Location: index.php?controlador=factura&accion=insert");
            exit;
        }
        
        
    }

    // ✅ Insertar factura si todo el stock está bien
    $id_factura = $factura->insert($total_factura, $fecha_factura, $id_caja);
    if (!$id_factura) {
        die("Error: No se pudo crear la factura.");
    }

    // ✅ Insertar detalles de venta y actualizar stock
    foreach ($productos as $producto) {
        if (!empty($producto['id_producto']) && !empty($producto['cantidad']) && !empty($producto['subtotal'])) {
            $detalleVenta->insert(
                $producto['cantidad'],
                $producto['subtotal'],
                $producto['id_producto'],
                $id_factura
            );

            // Descontar el stock
            $productoModel->actualizarStock($producto['id_producto'], $producto['cantidad']);
        }
    }

    // Redirigir
    $this->index();
}

    public function calculate(){
        $factura = new Factura();
        $data['titulo'] = "Total ventas diarias";
        $data['totalVentaDia'] = $factura->obtenerTotalVentaDia();
        require_once "views/factura/calculate.php";
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
