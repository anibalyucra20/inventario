<?php
require_once "../library/conexion.php";

class InstitucionModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function registrarInstitucion($beneficiario,$cod_modular, $ruc, $nombre)
    {
        $sql = $this->conexion->query("INSERT INTO institucion (beneficiario, cod_modular, ruc, nombre) VALUES ('$beneficiario','$cod_modular','$ruc','$nombre')");
        if ($sql) {
            $sql = $this->conexion->insert_id;
        } else {
            $sql = 0;
        }
        return $sql;
    }
    public function actualizarInstitucion($id, $beneficiario, $cod_modular, $ruc, $nombre)
    {
        $sql = $this->conexion->query("UPDATE institucion SET beneficiario= '$beneficiario', cod_modular='$cod_modular',ruc='$ruc',nombre='$nombre' WHERE id='$id'");
        return $sql;
    }
    public function buscarInstitucionOrdenado()
    {
        $sql = $this->conexion->query("SELECT * FROM institucion order by nombre ASC");
        $arrRespuesta = array();
        while ($objeto = $sql->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarInstitucionById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM institucion WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarPrimerIe()
    {
        $sql = $this->conexion->query("SELECT * FROM institucion ORDER BY id ASC LIMIT 1");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarInstitucionByCodigo($codigo)
    {
        $sql = $this->conexion->query("SELECT * FROM institucion WHERE cod_modular='$codigo'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarInstitucionOrderByApellidosNombres_tabla_filtro($busqueda_tabla_codigo, $busqueda_tabla_ruc, $busqueda_tabla_insti)
    {
        //condicionales para busqueda
        $condicion = "";
        $condicion .= " cod_modular LIKE '$busqueda_tabla_codigo%' AND ruc LIKE '$busqueda_tabla_ruc%' AND nombre LIKE '$busqueda_tabla_insti%'";
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM institucion WHERE $condicion ORDER BY nombre");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarInstitucionOrderByApellidosNombres_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_codigo, $busqueda_tabla_ruc, $busqueda_tabla_insti)
    {
        //condicionales para busqueda
        $condicion = "";
        $condicion .= " cod_modular LIKE '$busqueda_tabla_codigo%' AND ruc LIKE '$busqueda_tabla_ruc%' AND nombre LIKE '$busqueda_tabla_insti%'";
        $iniciar = ($pagina - 1) * $cantidad_mostrar;
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM institucion WHERE $condicion ORDER BY nombre LIMIT $iniciar, $cantidad_mostrar");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }



}
