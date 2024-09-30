<?php
require_once "../librerias/conexion.php";

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


    public function registrarConsulta($codigo, $nombre, $descripcion, $presentacion, $stock, $fecha_vencimiento, $id_categoria)
    {
        $sql = $this->conexion->query("CALL registrar_producto('{$codigo}','{$nombre}','{$descripcion}','{$presentacion}','{$stock}','{$fecha_vencimiento}','{$id_categoria}')");
        $sql = $sql->fetch_object();
        return $sql;
    }

    public function getConsulta($id)
    {
        $sql = $this->conexion->query("CALL buscar_productoporId('{$id}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function actualizarConsulta($id, $codigo, $nombre, $descripcion, $presentacion, $fecha_vencimiento, $id_categoria)
    {
        $sql = $this->conexion->query("CALL actualizarProducto('{$id}','{$codigo}','{$nombre}','{$descripcion}','{$presentacion}','{$fecha_vencimiento}','{$id_categoria}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function eliminarConsulta($id)
    {
        $sql = $this->conexion->query("CALL eliminarProducto('{$id}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
}
