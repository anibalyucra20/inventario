<?php
require_once "../library/conexion.php";

class SessionModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
    public function registrarSesion($id_usuario, $fecha_hora_inicio, $fecha_hora_fin, $token)
    {
        $sql = $this->conexion->query("INSERT INTO sesiones (id_usuario , fecha_hora_inicio, fecha_hora_fin, token) VALUES ('$id_usuario','$fecha_hora_inicio','$fecha_hora_fin','$token')");
        if ($sql) {
            $sql = $this->conexion->insert_id;
        } else {
            $sql = 0;
        }
        return $sql;
    }
    public function verificar_sesion_si_activa($id_sesion, $token)
    {
        $hora_actuals = date("Y-m-d H:i:s");
        $hora_actual = strtotime('-1 minute', strtotime($hora_actuals));
        $hora_actual = date("Y-m-d H:i:s", $hora_actual);

        $b_sesion = $this->conexion->query("SELECT * FROM sesiones WHERE id='$id_sesion'");
        $datos_sesion = $b_sesion->fetch_object();

        $fecha_hora_fin_sesion = $datos_sesion->fecha_hora_fin;

        $fecha_hora_fin = strtotime('+8 hour', strtotime($fecha_hora_fin_sesion));
        $fecha_hora_fin = date("Y-m-d H:i:s", $fecha_hora_fin);

        if ((password_verify($datos_sesion->token, $token)) && ($hora_actual <= $fecha_hora_fin)) {
            // actualizar fecha de sesion
            $hora_actual = date("Y-m-d H:i:s");
            $nueva_fecha_hora_fin = strtotime('+1 minute', strtotime($hora_actual));
            $nueva_fecha_hora_fin = date("Y-m-d H:i:s", $nueva_fecha_hora_fin);

            $this->conexion->query("UPDATE sesiones SET fecha_hora_fin='$nueva_fecha_hora_fin' WHERE id=$id_sesion");
            return 1;
        } else {
            return 0;
        }
    }



    public function buscarSesionLoginById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM sesiones WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function buscarSesionLoginBySistema($id)
    {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM sesiones WHERE id_sistema_integrado='$id'");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }
}
