<?php

// Definición de la clase ProductosController, que se encarga de manejar la lógica relacionada con los productos.
class ProductoController
{

    // Constructor de la clase
    public function __construct()
    {
        // Se requiere el archivo que contiene la definición de la clase Producto
        require_once "models/producto.php";

    }

    // Método que muestra la lista de productos en la vista principal
    public function index()
    {
        // Se crea una instancia de la clase Producto
        $productos = new Producto();

        // Se prepara un array con información para la vista
        $data["titulo"] = "Productos"; // Título de la vista
        $data["productos"] = $productos->listar(); // Se obtiene la lista de productos desde la base de datos

        // Se carga la vista correspondiente a la lista de productos
        require_once "views/productos/index.php";
    }

    // Método que muestra la vista para crear un nuevo producto
    public function insert()
    {
        // Se crea una instancia de la clase Categoria para obtener las categorías disponibles
        $productos = new Producto();
        $data['titulo'] = "Registrar Producto"; // Título de la vista
        $data['categorias'] = $productos->obtenerCategorias(); // Se obtiene la lista de categorías desde la base de datos


        // Se carga la vista donde se mostrará el formulario para crear un producto
        require_once "views/productos/insert.php";
    }

    // Método que guarda la información de un nuevo producto en la base de datos
    public function store()
    {
        $nombre_producto = $_POST['nombre_producto'];
        $precio_producto = $_POST['precio_producto'];
        $cantidad_producto = $_POST['cantidad_producto'];
        $id_categoria = $_POST['id_categoria'];
        $es_perecedero = isset($_POST['es_perecedero']) ? intval($_POST['es_perecedero']) : 0;

        // Si el producto es perecedero, obtener la fecha de caducidad. Si no, asignar NULL.
        $fecha_caducidad = ($es_perecedero === 1 && !empty($_POST['fecha_caducidad'])) ? $_POST['fecha_caducidad'] : null;

        $productos = new Producto();
        $productos->insert($nombre_producto, $precio_producto, $cantidad_producto, $id_categoria, $es_perecedero, $fecha_caducidad);

        $this->index();
    }


     // Visualizar la información de un registro
     public function view($id_producto)
     {
         $productos = new Producto();
         $data['titulo'] = "Detalle del Producto";
         $data['productos'] = $productos->getProducto($id_producto);
         require_once "views/productos/view.php";
     }
 

    //eliminar producto
    public function delete($id_producto)
    {
        $producto = new Producto();
        $producto->delete($id_producto);
        $this->index();
    }

    public function edit($id_producto)
    {
        $producto = new Producto();
        $data['titulo'] = "Actualizar producto";
        $data['producto'] = $producto->obtenerProducto($id_producto);
        $data['id_producto'] = $id_producto;
        $data['categorias'] = $producto->obtenerCategorias();
        require_once "views/productos/edit.php";
    }

    public function update()
    {
        // recibir los datos del formulario
        $id_producto = $_POST['id_producto'];
    
        $producto = new Producto();
    
        // Se obtiene el producto actual que está en la base de datos
        $productoActual = $producto->obtenerProducto($id_producto);
    
        // Se verifica si hay un nuevo valor; si no, mantiene el valor actual
        $nombre_producto = !empty($_POST['nombre_producto']) ? $_POST['nombre_producto'] : $productoActual['nombre_producto'];
        $precio_producto = !empty($_POST['precio_producto']) ? $_POST['precio_producto'] : $productoActual['precio_producto'];
        $cantidad_producto = !empty($_POST['cantidad_producto']) ? $_POST['cantidad_producto'] : $productoActual['cantidad_producto'];
        $fecha_caducidad = !empty($_POST['fecha_caducidad']) ? $_POST['fecha_caducidad'] : $productoActual['fecha_caducidad'];
        $es_perecedero = isset($_POST['es_perecedero']) ? $_POST['es_perecedero'] : $productoActual['es_perecedero'];
        $id_categoria = !empty($_POST['id_categoria']) ? $_POST['id_categoria'] : $productoActual['id_categoria'];
    
        // Actualiza el producto
        $producto->update($id_producto, $nombre_producto, $precio_producto, $cantidad_producto, $fecha_caducidad, $es_perecedero, $id_categoria);
    
        // Redirige al listado de productos
        $this->index();
    }


    // *********Cantidad total vendida por producto
    public function masVendidos()
{
    include_once("models/producto.php");
    $producto = new Producto();
    $productosMasVendidos = $producto->obtenerProductosMasVendidos();

    $data['titulo'] = "Cantidad total vendida por producto";
    $data['productosMasVendidos'] = $productosMasVendidos;

    require_once("views/productos/masVendidos.php");
}



    // Cargar vista a la lista de productos que se deben reabastecer 
public function replenish()
{
    // Se crea una instancia de la clase Categoria para obtener las categorías disponibles
    $productos = new Producto();
    $data['titulo'] = "Lista de productos a reabastecer"; // Título de la vista
    $data['productosBajoStock'] = $productos -> obtenerProductosBajosStock();
    // Se carga la vista donde se mostrará el formulario para crear un producto
    require_once "views/productos/replenish.php";
}



// funcion para el inventariooooo ultima HU
public function descargarinventario() {
    $producto = new Producto();
    $productos = $producto->listar();

    $filename = "inventario_" . date('Ymd_His') . ".xls";

    header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
    header("Content-Disposition: attachment; filename=$filename");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "<html>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<style>
        table { border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; }
        th, td { border: 1px solid #999; padding: 8px; text-align: center; }
        th { background-color: #d0f0c0; font-weight: bold; }
        tr:nth-child(even) { background-color: #f7f7f7; }
    </style>";
    echo "</head>";
    echo "<body>";
    echo "<table>";
    echo "<tr>
            <th>ID Producto</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Fecha Caducidad</th>
            <th>Perecedero</th>
          </tr>";

    foreach ($productos as $prod) {
        $fecha = !empty($prod['fecha_caducidad']) 
            ? date('d/m/Y', strtotime($prod['fecha_caducidad'])) 
            : 'No expira';

        $perecedero = ($prod['es_perecedero'] == 1) ? 'Sí' : 'No';

        echo "<tr>";
        echo "<td>{$prod['id_producto']}</td>";
        echo "<td>" . htmlspecialchars($prod['nombre_producto']) . "</td>";
        echo "<td>" . number_format($prod['precio_producto'], 2, ',', '.') . "</td>";
        echo "<td>{$prod['cantidad_producto']}</td>";
        echo "<td>$fecha</td>";
        echo "<td>$perecedero</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</body>";
    echo "</html>";

    exit();
}












    

    
}






?>




