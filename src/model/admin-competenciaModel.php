<?php
require_once "../library/conexion.php";

class CompetenciaModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function buscarCompetencias()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_competencias");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarCompetenciasById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_competencias WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarCompetenciasByIdModuloFormativo($id)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_competencias WHERE id_modulo_formativo=$id");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarCompetenciasEspecialidadByIdModulo($id)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_competencias WHERE id_modulo_formativo='$id' AND tipo='ESPECÍFICA'");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
}