<?php
require_once "../library/conexion.php";

class UsuarioModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function registrarUsuario($dni, $apellidos_nombres,$correo, $telefono)
    {
        $sql = $this->conexion->query("INSERT INTO usuarios (dni, nombres_apellidos, correo, telefono) VALUES ('$dni','$apellidos_nombres','$correo','$telefono')");
        if ($sql) {
            $sql = $this->conexion->insert_id;
        } else {
            $sql = 0;
        }
        return $sql;
    }
    public function actualizarUsuario($id, $dni, $nombres_apellidos, $correo, $telefono, $estado)
    {
        $sql = $this->conexion->query("UPDATE usuarios SET dni='$dni',nombres_apellidos='$nombres_apellidos',correo='$correo',telefono='$telefono',estado ='$estado' WHERE id='$id'");
        return $sql;
    }
    public function actualizarPassword($id, $password)
    {
        $sql = $this->conexion->query("UPDATE usuarios SET password ='$password' WHERE id='$id'");
        return $sql;
    }

    public function buscarUsuarioById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarUsuarioByDni($dni)
    {
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE dni='$dni'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarUsuarioByNomAp($nomap)
    {
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE nombres_apellidos='$nomap'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarUsuarioByApellidosNombres_like($dato)
    {
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE nombres_apellidos LIKE '%$dato%'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarUsuarioByDniCorreo($dni, $correo)
    {
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE dni='$dni' AND correo='$correo'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarUsuariosOrdenados()
    {
        $arrRespuesta = array();
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE estado='1' ORDER BY nombres_apellidos ASC ");
        while ($objeto = $sql->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
   
    public function buscarUsuariosOrderByApellidosNombres_tabla_filtro($busqueda_tabla_dni, $busqueda_tabla_nomap, $busqueda_tabla_estado)
    {
        //condicionales para busqueda
        $condicion = "";
        $condicion .= " dni LIKE '$busqueda_tabla_dni%' AND nombres_apellidos LIKE '$busqueda_tabla_nomap%'";
        if ($busqueda_tabla_estado != '') {
            $condicion .= " AND estado = '$busqueda_tabla_estado'";
        }
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM usuarios WHERE $condicion ORDER BY nombres_apellidos");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarUsuariosOrderByApellidosNombres_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_dni, $busqueda_tabla_nomap, $busqueda_tabla_estado)
    {
        //condicionales para busqueda
        $condicion = "";
        $condicion .= " dni LIKE '$busqueda_tabla_dni%' AND nombres_apellidos LIKE '$busqueda_tabla_nomap%'";
        if ($busqueda_tabla_estado != '') {
            $condicion .= " AND estado = '$busqueda_tabla_estado'";
        }
        $iniciar = ($pagina - 1) * $cantidad_mostrar;
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM usuarios WHERE $condicion ORDER BY nombres_apellidos LIMIT $iniciar, $cantidad_mostrar");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }



}
