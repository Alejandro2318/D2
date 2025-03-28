<?php

class Caja
{
    private $db;
    private $caja;

    // Contructor
    public function __construct()
    {
        $this->db = Conexion::conectar();
        $this->caja = [];
    }

    public function obtenerCaja()
    {
        $cajas = [];
        $sql = "SELECT id_caja FROM caja"; // Ajusta el nombre de la columna si es diferente
        $resultado = $this->db->query($sql);

        while ($row = $resultado->fetch_assoc()) {
            $cajas[] = $row;
        }

        return $cajas;
    }
}

?>