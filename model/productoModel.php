<?php
require_once "../librerias/conexion.php";

class ProductoModel
{
    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }
    public function getProductos()
    {
        $arrRegistros = array();
        // llamar al procedemiento almacenado en BD - buscar_Productos
        $rs = $this->conexion->query("CALL buscar_Productos()");

        while ($obj = $rs->fetch_object()) {
            array_push($arrRegistros, $obj);
        }
        return $arrRegistros;
    }
    public function registrarProducto($codigo, $nombre, $descripcion, $presentacion, $stock, $fecha_vencimiento, $id_categoria)
    {
        $sql = $this->conexion->query("CALL registrar_producto('{$codigo}','{$nombre}','{$descripcion}','{$presentacion}','{$stock}','{$fecha_vencimiento}','{$id_categoria}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function busquedaProducto($busqueda)
    {
        $arrRegistros = array();
        $rs = $this->conexion->query("SELECT * FROM producto WHERE (nombre LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%' OR presentacion LIKE '%$busqueda%')  AND estado=1 ORDER BY nombre ASC LIMIT 5");

        while ($obj = $rs->fetch_object()) {
            array_push($arrRegistros, $obj);
        }
        return $arrRegistros;
    }
    public function getProductoStock($id)
    {
        $sql = $this->conexion->query("SELECT stock FROM producto WHERE id='{$id}'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function actualizarCantidad($id, $cantidad){
        $sql = $this->conexion->query("CALL actualizarCantidadMedicamento('{$id}', '{$cantidad}')");
        $sql = $sql->fetch_object();
        return $sql;
    }

    public function getProducto($id)
    {
        $sql = $this->conexion->query("CALL buscar_productoporId('{$id}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function getProductoId($id)
    {
        $arrRegistros = array();
        $sql = $this->conexion->query("SELECT * FROM producto WHERE id='{$id}'");
        while ($obj = $sql->fetch_object()) {
            array_push($arrRegistros, $obj);
        }
        return $sql;
    }
    public function actualizarProducto($id, $codigo, $nombre, $descripcion, $presentacion, $fecha_vencimiento, $id_categoria)
    {
        $sql = $this->conexion->query("CALL actualizarProducto('{$id}','{$codigo}','{$nombre}','{$descripcion}','{$presentacion}','{$fecha_vencimiento}','{$id_categoria}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function eliminarProducto($id)
    {
        $sql = $this->conexion->query("CALL eliminarProducto('{$id}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
}
