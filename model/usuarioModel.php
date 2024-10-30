<?php
require_once("../librerias/conexion.php");

class UsuarioModel
{
    private $conexion;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }

    public function ListarUsuarios()
    {
        $arrUsuarios = array();
        $rs = $this->conexion->query("CALL buscar_Usuarios()");

        while ($obj = $rs->fetch_object()) {
            array_push($arrUsuarios, $obj);
        }
        return $arrUsuarios;
    }



    public function getUsuario($id)
    {
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function getUsuarioDni($dni)
    {
        $sql = $this->conexion->query("SELECT * FROM usuarios WHERE dni='$dni'");
        $sql = $sql->fetch_object();
        return $sql;
    }

    public function registrarUsuario($dni, $cip, $nombres, $fecha_nacimiento, $genero, $talla, $peso, $grado, $cia, $tipo_usuario, $password)
    {
        $sql = $this->conexion->query("CALL registrar_usuario('{$dni}','{$cip}','{$nombres}','{$fecha_nacimiento}','{$genero}','{$talla}','{$peso}','{$grado}','{$cia}','{$tipo_usuario}','{$password}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function actualizarUsuario($id, $dni, $cip, $nombres, $fecha_nacimiento, $genero, $talla, $peso, $grado, $cia, $tipo_usuario)
    {
        $sql = $this->conexion->query("CALL actualizarUsuario('{$id}','{$dni}','{$cip}','{$nombres}','{$fecha_nacimiento}','{$genero}','{$talla}','{$peso}','{$grado}','{$cia}','{$tipo_usuario}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function eliminarUsario($id)
    {
        $sql = $this->conexion->query("CALL eliminarUsuario('{$id}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function getUsuarioIdConsulta($id_consulta)
    {
        $sql = $this->conexion->query("SELECT usuarios.dni,usuarios.cia, usuarios.grado, usuarios.apellidos_nombres, usuarios.fecha_nacimiento, atencion_consultorio.diagnostico FROM usuarios JOIN atencion_consultorio ON atencion_consultorio.id_paciente = usuarios.id WHERE atencion_consultorio.id='{$id_consulta}';");
        $sql = $sql->fetch_object();
        return $sql;
    }
}
