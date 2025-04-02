<?php
require_once "../library/conexion.php";

class RolModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function buscarRoles()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_roles");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarRolById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_roles WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
}