<?php
require_once "../librerias/conexion.php";

class tratamientoModel
{
    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }

    public function registrarTratamiento($id_consulta, $id_medicamento, $cantidad, $por_hora, $por_dia, $via)
    {
        $sql = $this->conexion->query("CALL registrar_tratamiento('{$id_consulta}','{$id_medicamento}','{$cantidad}','{$por_hora}','{$por_dia}','{$via}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function getTratamientos($id_consulta)
    {
        $arrRegistros = array();
        $rs = $this->conexion->query("SELECT tratamiento.id, tratamiento.id_atencion_consultorio, tratamiento.cantidad, tratamiento.por_hora, tratamiento.por_dia, tratamiento.via_administracion, producto.nombre, tratamiento.id_medicamento FROM tratamiento INNER JOIN producto ON tratamiento.id_medicamento = producto.id WHERE id_atencion_consultorio='$id_consulta'");

        while ($obj = $rs->fetch_object()) {
            array_push($arrRegistros,$obj);
        }
        return $arrRegistros;
    }
    public function actualizarTratamiento($id_tratamiento, $cantidad_t, $hora_t, $dia_t, $via_t)
    {
        $sql = $this->conexion->query("CALL actualizarTratamiento('{$id_tratamiento}','{$cantidad_t}','{$hora_t}','{$dia_t}','{$via_t}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function eliminarTratamiento($id)
    {
        $sql = $this->conexion->query("CALL eliminarTratamiento('{$id}')");
        $sql = $sql->fetch_object();
        return $sql;
    }

}

?>