<?php
require_once "../library/conexion.php";

class DatosIntitucionModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    
    public function buscarDatosInstitucional()
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_datos_institucionales LIMIT 1");
        $sql = $sql->fetch_object();
        return $sql;
    }
}