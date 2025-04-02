<?php
require_once "../library/conexion.php";

class UnidadDidacticaModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function buscarUnidadDidacticas()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_unidad_didactica");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarUnidadDidacticaById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_unidad_didactica WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarUdByName($nombre)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_unidad_didactica WHERE nombre=$nombre");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarUnidadDidacticaByIdSemestre($id)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_unidad_didactica WHERE id_semestre=$id");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
}