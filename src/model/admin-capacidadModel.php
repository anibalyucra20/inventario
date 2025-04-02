<?php
require_once "../library/conexion.php";

class CapacidadModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function buscarCapacidades()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_capacidades");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarCapacidadById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_capacidades WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarCapacidadByIdUd($id)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_capacidades WHERE id_unidad_didactica=$id");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    
}