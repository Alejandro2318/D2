<?php

class cajaController {
    public function __construct()
    {
        require_once "models/Caja.php";
    }

    public function index()
    {
        $caja = new caja();
        $data["titulo"] = "Caja";
        $data["caja"] = $caja->obtenerCaja2();
        $data["estadoCaja"] = $caja->getEstado();

        // Cargar la vista
        require_once "views/caja/gestionar.php";
    }

    public function actualizarEstado()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['estado'])) {
        $caja = new Caja();
        $id_caja = $caja ->obtenerCaja2();
        $nuevo_estado = $_POST['estado'];
        
        $caja->actualizarEstado($id_caja, $nuevo_estado);

        $this ->index();
    }
}

}
?>
