<?php
class LoginController {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->login();
        } else {
            require 'views/login.php'; 
        }
    }

    private function login() {
        // Obtener los datos del formulario
        $nombre_usuario = $_POST['username'];
        $contraseña = $_POST['password'];

        // Conexión a la base de datos
        $conexion = Conexion::conectar();

        // Consulta a la tabla admin para verificar el usuario
        $query = $conexion->prepare("SELECT * FROM usuario WHERE nombre_usuario = ? AND contraseña = ?");
        $query->bind_param("ss", $nombre_usuario, $contraseña);
        $query->execute();
        $result = $query->get_result();

        // Verificar si existe el usuario
        if ($result->num_rows > 0) {
            // Iniciar sesión y redirigir a las ventas
            $_SESSION['authenticated'] = true;
            $_SESSION['nombre_usuario'] = $nombre_usuario;
            //header('Location: index.php?controlador=venta&accion=index');
        } else {
            // Mostrar un error de autenticación
            $error = "Usuario o contraseña incorrectos";
            require 'views/login.php';
        }

        $query->close();
        $conexion->close();
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php?controlador=login&accion=index');
        exit();
    }
}
?>
