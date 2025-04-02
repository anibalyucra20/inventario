<?php
require_once "../library/conexion.php";

class IndLogroCompetenciaModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function buscarIndCompetencias()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_ind_logro_competencia");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarIndCompetenciasById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_ind_logro_competencia WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarIndCompetenciasByIdCompetencia($id)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_ind_logro_competencia WHERE id_competencia=$id");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    
}