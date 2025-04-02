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
    public function registrarUsuario($dni, $apellidos_nombres, $genero, $fecha_nac, $direccion, $correo, $telefono, $discapacidad, $id_sede, $id_rol, $id_programa_estudios, $id_periodo_actual)
    {
        $sql = $this->conexion->query("INSERT INTO sigi_usuarios (dni, apellidos_nombres, genero, fecha_nac, direccion,correo, telefono,id_periodo_registro,id_programa_estudios ,discapacidad,id_rol ,id_sede ) VALUES ('$dni','$apellidos_nombres','$genero','$fecha_nac','$direccion','$correo','$telefono','$id_periodo_actual','$id_programa_estudios','$discapacidad','$id_rol','$id_sede')");
        if ($sql) {
            $sql = $this->conexion->insert_id;
        } else {
            $sql = 0;
        }
        return $sql;
    }
    public function actualizarUsuario($id, $dni, $apellidos_nombres, $genero, $fecha_nac, $direccion, $correo, $telefono, $discapacidad, $id_sede, $id_rol, $id_programa_estudios, $estado)
    {
        $sql = $this->conexion->query("UPDATE sigi_usuarios SET dni='$dni',apellidos_nombres='$apellidos_nombres',genero='$genero',fecha_nac='$fecha_nac',direccion='$direccion',correo='$correo',telefono='$telefono',id_programa_estudios ='$id_programa_estudios ',discapacidad='$discapacidad',id_rol ='$id_rol',id_sede  ='$id_sede',estado ='$estado' WHERE id='$id'");
        return $sql;
    }
    public function actualizarPassword($id, $password)
    {
        $sql = $this->conexion->query("UPDATE sigi_usuarios SET password ='$password' WHERE id='$id'");
        return $sql;
    }

    public function buscarUsuarioById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarUsuarioByDni($dni)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE dni='$dni'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarUsuarioByNomAp($nomap)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE apellidos_nombres='$nomap'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarUsuarioByApellidosNombres_like($dato)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE apellidos_nombres LIKE '%$dato%'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarUsuarioByDniCorreo($dni, $correo)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE dni='$dni' AND correo='$correo'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    // busqueda de directores
    public function buscarUsuarioDirector_All()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE id_rol=2");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    // busqueda de secretario academico
    // busqueda de coordinadores
    public function buscarUsuarioCoordinador_sede($sede)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE id_rol=5 AND id_sede='$sede'");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarUsuarioCoordinador_sedeAndPe($sede, $pe)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE id_rol=5 AND id_sede='$sede' AND id_programa_estudios='$pe'");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    // busqueda de docentes
    public function buscarUsuarioDocentes()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE id_rol<=6");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarUsuarioDocentesBySede($sede)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE id_rol<=6 AND id_sede='$sede'");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarUsuarioDocentesOrderByApellidosNombres()
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE id_rol<=6 ORDER BY apellidos_nombres");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarUsuarioDocentesOrderByApellidosNombresAndSede($sede)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE id_rol<=6 AND id_sede='$sede' ORDER BY apellidos_nombres");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarUsuarioDocentesOrderByApellidosNombres_tabla_filtro($busqueda_tabla_dni, $busqueda_tabla_nomap, $busqueda_tabla_pe, $busqueda_tabla_estado, $busqueda_tabla_sede)
    {
        //condicionales para busqueda
        $condicion = "";
        $condicion .= " AND dni LIKE '$busqueda_tabla_dni%' AND apellidos_nombres LIKE '$busqueda_tabla_nomap%'";
        if ($busqueda_tabla_pe > 0) {
            $condicion .= " AND id_programa_estudios = '$busqueda_tabla_pe'";
        }
        if ($busqueda_tabla_sede > 0) {
            $condicion .= " AND id_sede = '$busqueda_tabla_sede'";
        }
        if ($busqueda_tabla_estado != '') {
            $condicion .= " AND estado = '$busqueda_tabla_estado'";
        }
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE id_rol<=5 $condicion ORDER BY apellidos_nombres");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarUsuarioDocentesOrderByApellidosNombres_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_dni, $busqueda_tabla_nomap, $busqueda_tabla_pe, $busqueda_tabla_estado, $busqueda_tabla_sede)
    {
        //condicionales para busqueda
        $condicion = "";
        $condicion .= " AND dni LIKE '$busqueda_tabla_dni%' AND apellidos_nombres LIKE '$busqueda_tabla_nomap%'";
        if ($busqueda_tabla_pe > 0) {
            $condicion .= " AND id_programa_estudios = '$busqueda_tabla_pe'";
        }
        if ($busqueda_tabla_sede > 0) {
            $condicion .= " AND id_sede = '$busqueda_tabla_sede'";
        }
        if ($busqueda_tabla_estado != '') {
            $condicion .= " AND estado = '$busqueda_tabla_estado'";
        }

        $iniciar = ($pagina - 1) * $cantidad_mostrar;
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE id_rol<=6 $condicion ORDER BY apellidos_nombres LIMIT $iniciar, $cantidad_mostrar");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }

    // busqueda de estudiantes
    public function buscarUsuarioEstudiantesBySede($sede)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE id_rol=7 AND id_sede='$sede'");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarUsuarioEstudiantesBySedePeriodo($sede, $periodo)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sigi_usuarios WHERE id_rol=7 AND id_sede='$sede' AND id_periodo_registro='$periodo'");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }

    // estudiante - programa de estudios

    public function buscarEstudiantePeById_est($id_usu)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM acad_estudiante_programa WHERE id_usuario='$id_usu'");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
    public function buscarEstudiantePeByEst_Pe($id_usu, $id_pe)
    {
        $sql = $this->conexion->query("SELECT * FROM acad_estudiante_programa WHERE id_usuario='$id_usu' AND id_programa_estudio='$id_pe'");
        $sql = $sql->fetch_object();
        return $sql;
    }

    // ----------------------------- PERMISOS DE USUARIO ----------------------------------------
    public function registrar_permiso($usuario, $sistema, $rol)
    {
        $sql = $this->conexion->query("INSERT INTO sigi_permisos_usuarios (id_usuario, id_sistema, id_rol) VALUES ('$usuario', '$sistema', '$rol')");
        if ($sql) {
            $sql = $this->conexion->insert_id;
        } else {
            $sql = 0;
        }
    }
    // actualizar
    public function actualizarPermisoUsuarioByUsuarioSistemaRol($id, $rol)
    {
        $sql = $this->conexion->query("UPDATE sigi_permisos_usuarios SET id_rol ='$rol' WHERE id='$id'");
        return $sql;
    }
    // eliminar
    public function eliminarPermisoUsuarioByUsuarioSistemaRol($id)
    {
        $sql = $this->conexion->query("DELETE FROM sigi_permisos_usuarios WHERE id='$id'");
        return $sql;
    }
    public function buscarPermisoUsuarioByUsuarioSistema($usuario, $sistema)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_permisos_usuarios WHERE id_usuario='$usuario' AND id_sistema='$sistema'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarPermisoUsuarioByUsuarioSistemaRol($usuario, $sistema, $rol)
    {
        $sql = $this->conexion->query("SELECT * FROM sigi_permisos_usuarios WHERE id_usuario='$usuario' AND id_sistema='$sistema' AND id_rol='$rol'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    

}
