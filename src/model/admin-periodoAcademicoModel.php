<?php
require_once "../library/conexion.php";

class PeriodoAcademicoModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function registrarProductoeriodoAcademico($periodo, $fecha_inicio, $fecha_fin, $director, $fecha_actas)
    {
        $sql = $this->conexion->query("INSERT INTO sigi_periodo_academico (nombre, fecha_inicio, fecha_fin, director, fecha_actas) VALUES ('$periodo','$fecha_inicio','$fecha_fin','$director','$fecha_actas')");
        if ($sql) {
            $sql = $this->conexion->insert_id;
        } else {
            $sql = 0;
        }
        return $sql;
    }
    public function actualizarPeriodo($id, $periodo, $fecha_inicio, $fecha_fin, $director, $fecha_actas)
    {
        $sql = $this->conexion->query("UPDATE sigi_periodo_academico SET nombre='$periodo',fecha_inicio='$fecha_inicio',fecha_fin='$fecha_fin',director='$director',fecha_actas='$fecha_actas' WHERE id='$id'");
        return $sql;
    }
    public function buscarPeriodoAcademico_tabla_filtro($busqueda_tabla)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_periodo_academico WHERE nombre LIKE '%$busqueda_tabla%' ORDER BY nombre DESC");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarPeriodoAcademico_tabla($pagina, $cantidad_mostrar, $busqueda_tabla)
    {
        $iniciar = ($pagina - 1) * $cantidad_mostrar;
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_periodo_academico WHERE nombre LIKE '%$busqueda_tabla%' ORDER BY nombre DESC LIMIT $iniciar, $cantidad_mostrar");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarPeriodoAcademico()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_periodo_academico ORDER BY nombre DESC");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarPeriodoAcademicoInvert()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_periodo_academico ORDER BY id DESC");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarPeriodoAcadById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_periodo_academico WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarPresentePeriodoAcad()
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_periodo_academico ORDER BY id DESC LIMIT 1");
        $sql = $sql->fetch_object();
        return $sql;
    }
}
