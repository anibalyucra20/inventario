<?php
require_once "../library/conexion.php";

class IndLogroCapacidadModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function buscarIndCapacidad()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_ind_logro_capacidad");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarIndCapacidadById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_ind_logro_capacidad WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarIndCapacidadByIdCapacidad($id)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_ind_logro_capacidad WHERE id_capacidad=$id");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    
}