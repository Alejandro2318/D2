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


    
}




?>

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
    
}



