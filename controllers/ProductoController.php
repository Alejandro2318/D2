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
        $data['titulo'] = "Crear producto"; // Título de la vista
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

    public function ver()
{
    $id = $_GET['id'];
    $producto = new Producto();
    $data["producto"] = $producto->obtenerPorId($id);
    require_once "views/productos/ver.php"; // Asegúrate de que este archivo existe
}

public function editar()
{
    $id = $_GET['id'];
    $producto = new Producto();
    $data["producto"] = $producto->obtenerPorId($id);
    require_once "views/productos/editar.php"; // Asegúrate de que este archivo existe
}

public function actualizar()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_producto = $_POST["id"];
        $nombre_producto = $_POST["nombre"];
        $precio_producto = $_POST["precio"];
        $cantidad_producto = $_POST["cantidad"];
        $fecha_caducidad = $_POST["fecha_caducidad"];
        $es_perecedero = $_POST["es_perecedero"];
        $id_categoria = $_POST["id_categoria"];

        $producto = new Producto();
        $producto->actualizar($id_producto, $nombre_producto, $precio_producto, $cantidad_producto, $fecha_caducidad, $es_perecedero, $id_categoria);

        header("Location: index.php?controlador=producto&accion=index");
        exit(); // Asegura que no haya ejecución adicional
    }
}


    
   
    
}
