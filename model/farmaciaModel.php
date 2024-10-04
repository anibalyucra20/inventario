<?php
require_once "../librerias/conexion.php";

class FarmaciaModel
{
    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }


    public function getAtenciones()
    {
        $arrRegistros = array();
        $rs = $this->conexion->query("SELECT atencion_farmacia.id, atencion_farmacia.id_atencion_consultorio, atencion_farmacia.fecha_hora, atencion_consultorio.motivo_consulta, usuarios.apellidos_nombres FROM atencion_farmacia JOIN atencion_consultorio ON atencion_farmacia.id_atencion_consultorio = atencion_consultorio.id JOIN usuarios ON atencion_consultorio.id_paciente = usuarios.id ORDER BY atencion_farmacia.fecha_hora DESC;");
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
