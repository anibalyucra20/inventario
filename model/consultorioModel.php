<?php
require "./librerias/conexion.php";

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
    public function getConsultasReporte($id_usuario, $fecha)
    {
        $arrRegistros = array();
        $rs = $this->conexion->query("SELECT atencion_consultorio.id, atencion_consultorio.id_responsable_atencion, atencion_consultorio.id_paciente, atencion_consultorio.fecha_hora, atencion_consultorio.diagnostico, atencion_consultorio.motivo_consulta, usuarios.dni, usuarios.apellidos_nombres, usuarios.cip, usuarios.fecha_nacimiento, usuarios.genero, usuarios.talla, usuarios.peso, usuarios.grado, usuarios.cia FROM atencion_consultorio JOIN usuarios ON atencion_consultorio.id_paciente = usuarios.id WHERE atencion_consultorio.id_responsable_atencion ='{$id_usuario}' AND atencion_consultorio.fecha_hora LIKE '{$fecha}%' AND atencion_consultorio.estado=1 ORDER BY atencion_consultorio.fecha_hora ASC;");

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
