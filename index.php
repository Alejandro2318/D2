<?php
require_once "config/config.php";
require_once "core/routes.php";
require_once "config/Conexion.php";
//require_once "controllers/ProductoController.php";

// Iniciar sesión
session_start();

// Verificar autenticación
if (!isset($_SESSION['authenticated']) && $_GET['controlador'] != 'login') {
    header('Location: index.php?controlador=login&accion=index');
    exit();
}

if(isset($_GET['controlador'])) {
    $controlador = cargarControlador($_GET['controlador']);

    if(isset($_GET['accion'])) {
        if(isset($_GET['id'])) {
            cargarAccion($controlador, $_GET['accion'], $_GET['id']);    
        } else {
            cargarAccion($controlador, $_GET['accion']);
        }
    } else {
        cargarAccion($controlador, ACCION_PRINCIPAL);
    }

} else {
    $controlador = cargarControlador(CONTROLADOR_PRINCIPAL);
    cargarAccion($controlador, ACCION_PRINCIPAL);
}
?>
