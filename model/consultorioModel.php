<?php
require_once "./librerias/conexion.php";

class ConsultorioModel
{
    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }


    public function getConsultas()
    {
        $arrRegistros = array();
        $rs = $this->conexion->query("CALL buscarConsultas()");

        while ($obj = $rs->fetch_object()) {
            array_push($arrRegistros, $obj);
        }
        return $arrRegistros;
    }
    public function getConsultaRegistro($id_usuario)
    {
        $sql = $this->conexion->query("CALL buscar_consulta_registro('{$id_usuario}')");
        $sql = $sql->fetch_object();
        return $sql;
    }

    public function actualizarConsulta($id_consulta, $id_paciente, $id_usuario, $motivo_c, $diagnostico_c)
    {
        $sql = $this->conexion->query("CALL actualizarConsulta('{$id_consulta}','{$id_paciente}','{$id_usuario}','{$motivo_c}','{$diagnostico_c}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function getConsulta($id)
    {
        $sql = $this->conexion->query("CALL buscarConsultaId('{$id}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
   
}
