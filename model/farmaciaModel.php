<?php
require_once "../librerias/conexion.php";

class FarmaciaModel
{
    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }


    public function getAtenciones()
    {
        $arrRegistros = array();
        $rs = $this->conexion->query("SELECT movimientos.id,movimientos.fecha, producto.nombre, usuarios.apellidos_nombres FROM movimientos JOIN producto ON movimientos.id_medicamento = producto.id JOIN tratamiento ON movimientos.id_tratamiento = tratamiento.id JOIN atencion_consultorio ON tratamiento.id_atencion_consultorio = atencion_consultorio.id JOIN usuarios ON atencion_consultorio.id_paciente = usuarios.id ORDER BY movimientos.fecha DESC;");
        while ($obj = $rs->fetch_object()) {
            array_push($arrRegistros, $obj);
        }
        return $arrRegistros;
    }

    public function registrarSalida($tipo, $id_tratamiento, $id_medicamento, $cantidad, $detalle, $procedencia, $id_usuario)
    {
      
        $sql = $this->conexion->query("CALL registrarSalida('{$tipo}', '{$id_tratamiento}', '{$id_medicamento}', '{$cantidad}', '{$detalle}', '{$procedencia}', '{$id_usuario}')");
        
        $sql = $sql->fetch_object();
        return $sql;
    }


    public function getConsulta($id)
    {
        $sql = $this->conexion->query("CALL buscarConsultaId('{$id}')");
        $sql = $sql->fetch_object();
        return $sql;
    }
    public function getConsultasReporte($id_usuario, $fecha)
    {
        $arrRegistros = array();
        $rs = $this->conexion->query("SELECT * FROM movimientos WHERE id_responsable_atención='{$id_usuario}' AND fecha LIKE '{$fecha}%'");

        while ($obj = $rs->fetch_object()) {
            array_push($arrRegistros, $obj);
        }
        return $arrRegistros;
    }
   
}
