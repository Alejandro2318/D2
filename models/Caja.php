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
        $sql = "SELECT id_caja FROM caja"; 
        $resultado = $this->db->query($sql);

        while ($row = $resultado->fetch_assoc()) {
            $cajas[] = $row;
        }

        return $cajas;
    }

    public function obtenerCaja2(){
        $caja = null;
        $sql = "SELECT id_caja FROM caja";
        $resultado = $this->db->query($sql);
        if ($row = $resultado->fetch_assoc()) {
            $caja = $row['id_caja'];
        }
        return $caja;
    }

    public function getEstado()
    {
        $caja = $this->obtenerCaja2();
        $sql = "SELECT estado_caja FROM caja WHERE id_caja = $caja"; 
        $resultado = $this->db->query($sql);
    
        if ($row = $resultado->fetch_assoc()) {
            return $row['estado_caja'];
        }
    }
    public function actualizarEstado($id_caja, $estado)
    {
     $sql = "UPDATE caja SET estado_caja = $estado WHERE id_caja = $id_caja"; 
        $resultado = $this->db->query($sql);
    
        return $resultado; 
    }
}

?>
