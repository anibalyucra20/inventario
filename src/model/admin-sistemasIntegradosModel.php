<?php
require_once "../library/conexion.php";

class SistemasIntegradosModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function buscarSistemas()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_sistemas_integrados");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarSistemaByCodigo($sistema)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_sistemas_integrados WHERE codigo='$sistema'");
        $sql = $sql->fetch_object();
        return $sql;
    }
}