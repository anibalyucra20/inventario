<?php
require_once "../librerias/conexion.php";

class CategoriaModel
{
    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }


    public function getCategorias()
    {
        $arrRegistros = array();
        $rs = $this->conexion->query("CALL buscar_categorias()");

        while ($obj = $rs->fetch_object()) {
            array_push($arrRegistros,$obj);
        }
        return $arrRegistros;
    }
    public function registrarCategoria($nombre)
    {
        $sql = $this->conexion->query("CALL registrar_categoria('{$nombre}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function getCategoria($id)
    {
        $sql = $this->conexion->query("CALL buscar_categoriaPorId('{$id}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function actualizarCategoria($id, $nombre)
    {
        $sql = $this->conexion->query("CALL actualizarCategoria('{$id}','{$nombre}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function eliminarCategoria($id)
    {
        $sql = $this->conexion->query("CALL eliminarCategoria('{$id}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
}
