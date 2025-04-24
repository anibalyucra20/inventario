<?php
require_once "../library/conexion.php";

class AmbienteModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function registrarAmbiente($institucion, $encargado, $codigo, $detalle, $otros_detalle)
    {
        $sql = $this->conexion->query("INSERT INTO ambientes_institucion (id_ies,encargado,codigo, detalle, otros_detalle) VALUES ('$institucion','$encargado','$codigo','$detalle','$otros_detalle')");
        if ($sql) {
            $sql = $this->conexion->insert_id;
        } else {
            $sql = 0;
        }
        return $sql;
    }
    public function actualizarAmbiente($id, $id_ies, $encargado, $codigo, $detalle, $otros_detalle)
    {
        $sql = $this->conexion->query("UPDATE ambientes_institucion SET id_ies='$id_ies', encargado='$encargado', codigo='$codigo',detalle='$detalle',otros_detalle='$otros_detalle' WHERE id='$id'");
        return $sql;
    }
    public function buscarAmbienteById($id)
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
    public function buscarAmbienteByInstitucion($institucion)
    {
        $arrRespuesta = array();
        $sql = $this->conexion->query("SELECT * FROM ambientes_institucion WHERE id_ies='$institucion'");
        while ($objeto = $sql->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarAmbienteByCpdigoInstitucion($codigo, $institucion)
    {
        $sql = $this->conexion->query("SELECT * FROM ambientes_institucion WHERE codigo='$codigo' AND id_ies='$institucion'");
        $sql = $sql->fetch_object();
        return $sql;
    }

    public function buscarAmbientesOrderByApellidosNombres_tabla_filtro($busqueda_tabla_codigo, $busqueda_tabla_ambiente, $ies)
    {
        //condicionales para busqueda
        $condicion = "";
        $condicion .= " codigo LIKE '$busqueda_tabla_codigo%' AND detalle LIKE '$busqueda_tabla_ambiente%' AND id_ies = '$ies'";
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM ambientes_institucion WHERE $condicion ORDER BY detalle");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarAmbientesOrderByApellidosNombres_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_codigo, $busqueda_tabla_ambiente, $ies)
    {
        //condicionales para busqueda
        $condicion = "";
        $condicion .= " codigo LIKE '$busqueda_tabla_codigo%' AND detalle LIKE '$busqueda_tabla_ambiente%' AND id_ies = '$ies'";
        $iniciar = ($pagina - 1) * $cantidad_mostrar;
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM ambientes_institucion WHERE $condicion ORDER BY detalle LIMIT $iniciar, $cantidad_mostrar");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
}
