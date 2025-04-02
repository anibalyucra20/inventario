<?php
require_once "../library/conexion.php";

class SemestreModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function buscarSemestres()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_semestre");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarSemestreById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_semestre WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarSemestreByIdModulo_Formativo($id)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_semestre WHERE id_modulo_formativo=$id");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
}