<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class FacturaController
{
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

    public function calculate()
    {
        $factura = new Factura();
        $data['titulo'] = "Total ventas diarias";
        $data['totalVentaDia'] = $factura->obtenerTotalVentaDia();
        
        // Si el usuario pidió el PDF
        if (isset($_GET['pdf']) && $_GET['pdf'] == 1) {
            require_once 'vendor/autoload.php';
            
            // Generar contenido HTML para el PDF directamente en el controlador
            ob_start();
            
            ?>
            <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            font-size: 12px;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        th, td {
                            padding: 8px;
                            border: 1px solid #ddd;
                            text-align: left;
                        }
                        th {
                            background-color: #f2f2f2;
                        }
                    </style>
                </head>
                <body>
                    <h1><?= $data['titulo'] ?></h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Total Venta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['totalVentaDia'] as $venta): ?>
                                <tr>
                                    <td><?= $venta['fecha'] ?></td>
                                    <td>$<?= number_format($venta['total_ventas'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </body>
            </html>
            <?php
    
            // Capturar el contenido HTML generado
            $html = ob_get_clean();
            
            // Crear instancia de Dompdf
            $options = new Options();
            $options->set('defaultFont', 'Arial');
            $dompdf = new Dompdf($options);
            
            // Cargar el contenido HTML en Dompdf
            $dompdf->loadHtml($html);
            
            // Configurar tamaño de papel
            $dompdf->setPaper('A4', 'portrait');
            
            // Renderizar el PDF (esto puede tomar un tiempo)
            $dompdf->render();
            
            // Forzar la descarga del PDF en lugar de mostrarlo en pantalla
            $dompdf->stream("reporte_ventas_diarias.pdf", ["Attachment" => true]); // Cambia a true para descargar
            
            return; // Importante para evitar que se cargue el contenido de la vista calculate.php después
        }
    
        // Si no pidió PDF, muestra la vista HTML normal
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


    //eliminar factura  rama viviam
    public function delete($id_factura)
    {
        $factura = new Factura();
        $factura->delete($id_factura);
        $this->index();
    }
    public function descargarFactura()
    {
        if (!isset($_GET['id_factura'])) {
            die("ID de factura no especificado.");
        }
    
        $id_factura = intval($_GET['id_factura']);
    
        // Obtenemos los datos de la factura
        $factura = new Factura();
        $detalleVenta = new DetalleVenta();
        $producto = new Producto();  // Asumiendo que existe el modelo Producto
    
        // Llamamos a la consulta y obtenemos la factura
        $data['factura'] = $factura->getFactura($id_factura);
        
        // Obtenemos los detalles de la venta usando la función listarDetalleVenta()
        $detalles = $detalleVenta->listarDetalleVenta($id_factura);
        
        // Iniciamos el almacenamiento del contenido HTML
        ob_start();
        ?>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; }
                h2 { text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
            </style>
        </head>
        <body>
            <h2>Factura #<?= isset($data['factura']['id_factura']) ? $data['factura']['id_factura'] : 'No disponible' ?></h2>
            <p><strong>Fecha:</strong> <?= isset($data['factura']['fecha_factura']) ? $data['factura']['fecha_factura'] : 'No disponible' ?></p>
            <p><strong>Cajero:</strong> <?= isset($data['factura']['nombre_usuario']) ? $data['factura']['nombre_usuario'] : 'No disponible' ?></p>
            <p><strong>Caja:</strong> <?= isset($data['factura']['id_caja']) ? $data['factura']['id_caja'] : 'No disponible' ?></p>
    
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Verificamos si hay detalles para mostrar
                    if (!empty($detalles)) {
                        foreach ($detalles as $item):
                            // Obtener el producto para cada detalle de venta
                            $productoInfo = $producto->getProducto($item['id_producto']);
                            ?>
                            <tr>
                                <td><?= isset($productoInfo['nombre_producto']) ? $productoInfo['nombre_producto'] : 'No disponible' ?></td>
                                <td><?= isset($item['cantidad_producto_venta']) ? $item['cantidad_producto_venta'] : 'N/A' ?></td>
                                <td>$<?= isset($productoInfo['precio_producto']) ? number_format($productoInfo['precio_producto'], 2) : 'N/A' ?></td>
                                <td>$<?= isset($item['subtotal']) ? number_format($item['subtotal'], 2) : 'N/A' ?></td>
                            </tr>
                        <?php endforeach;
                    } else { ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">No hay productos para esta factura.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    
            <h3 style="text-align:right">Total: $<?= isset($data['factura']['total_factura']) ? number_format($data['factura']['total_factura'], 2) : 'No disponible' ?></h3>
        </body>
        </html>
        <?php
        // Obtenemos el contenido HTML generado
        $html = ob_get_clean();
    
        // Configuración de Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("factura_{$id_factura}.pdf", ["Attachment" => true]);
        exit;
    }
    
}



?>