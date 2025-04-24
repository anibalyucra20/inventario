<?php
require_once "../library/conexion.php";

class MovimientoModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function registrarMovimiento($ambiente_origen, $ambiente_destino, $id_usuario, $descripcion, $institucion)
    {
        $sql = $this->conexion->query("INSERT INTO movimientos (id_ambiente_origen,id_ambiente_destino, id_usuario_registro, descripcion, id_ies) VALUES ('$ambiente_origen','$ambiente_destino','$id_usuario','$descripcion','$institucion')");
        if ($sql) {
            $sql = $this->conexion->insert_id;
        } else {
            $sql = 0;
        }
        return $sql;
    }
    public function registrarDetalleMovimiento($id_movimiento, $id_bien)
    {
        $sql = $this->conexion->query("INSERT INTO detalle_movimiento (id_movimiento,id_bien) VALUES ('$id_movimiento','$id_bien')");
        if ($sql) {
            $sql = $this->conexion->insert_id;
        } else {
            $sql = 0;
        }
        return $sql;
    }

    public function buscarMovimientoById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM ambientes_institucion WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }

    public function buscarUsuarioByNom($nomap)
    {
        $sql = $this->conexion->query("SELECT * FROM ambientes_institucion WHERE apellidos_nombres='$nomap'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarDetalle_MovimientoByMovimiento($movimiento)
    {
        $arrRespuesta = array();
        $sql = $this->conexion->query("SELECT * FROM detalle_movimiento WHERE id_movimiento='$movimiento'");
        while ($objeto = $sql->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }

    public function buscarMovimiento_tabla_filtro($busqueda_tabla_amb_origen, $busqueda_tabla_amb_destino, $busqueda_fecha_desde, $busqueda_fecha_hasta, $ies)
    {
        //condicionales para busqueda
        $condicion = " id_ies = '$ies' ";
        if ($busqueda_tabla_amb_origen > 0) {
            $condicion .= " AND id_ambiente_origen ='$busqueda_tabla_amb_origen'";
        }
        if ($busqueda_tabla_amb_destino > 0) {
            $condicion .= " AND id_ambiente_destino ='$busqueda_tabla_amb_destino'";
        }
        if ($busqueda_fecha_desde != '' && $busqueda_fecha_hasta != '') {
            $condicion .= " AND fecha_registro >= '$busqueda_fecha_desde' AND fecha_registro <= '$busqueda_fecha_hasta'";
        }
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM movimientos WHERE $condicion ORDER BY fecha_registro ASC");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarMovimiento_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_amb_origen, $busqueda_tabla_amb_destino, $busqueda_fecha_desde, $busqueda_fecha_hasta, $ies)
    {
        //condicionales para busqueda
        $condicion = " id_ies = '$ies' ";
        if ($busqueda_tabla_amb_origen > 0) {
            $condicion .= " AND id_ambiente_origen ='$busqueda_tabla_amb_origen'";
        }
        if ($busqueda_tabla_amb_destino > 0) {
            $condicion .= " AND id_ambiente_destino ='$busqueda_tabla_amb_destino'";
        }
        if ($busqueda_fecha_desde != '' && $busqueda_fecha_hasta != '') {
            $condicion .= " AND fecha_registro BETWEEN '$busqueda_fecha_desde' AND '$busqueda_fecha_hasta'";
        }
        $iniciar = ($pagina - 1) * $cantidad_mostrar;
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM movimientos WHERE $condicion ORDER BY fecha_registro LIMIT $iniciar, $cantidad_mostrar");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
}
