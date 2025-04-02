<?php
require_once "../library/conexion.php";

class DatosSistemaModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    
    public function buscarDatosSistema()
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_datos_sistema LIMIT 1");
        $sql = $sql->fetch_object();
        return $sql;
    }
}