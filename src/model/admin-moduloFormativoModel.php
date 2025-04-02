<?php
require_once "../library/conexion.php";

class ModuloFormativoModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function buscarModulosFormativos()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_modulo_formativo");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarModuloFormativoById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_modulo_formativo WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarModuloFormativoByIdPe($id)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_modulo_formativo WHERE id_programa_estudio=$id");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
}