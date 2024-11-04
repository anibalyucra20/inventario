<?php

require_once "../model/consultorioModel.php";
require_once "../model/productoModel.php";
require_once "../model/tratamientoModel.php";

$option = $_REQUEST['op'];



$objConsulta = new ConsultorioModel();
$objTratamiento = new tratamientoModel();

if ($option == "listar") {
    $arrResponse = array('status' => false, 'data' => "");
    $arrConsulta = $objConsulta->getConsultas();

    if (!empty($arrConsulta)) {
        for ($i = 0; $i < count($arrConsulta); $i++) {
            $id_consulta = $arrConsulta[$i]->id;
            $options = '<a class="btn btn-outline-info" href="' . BASE_URL . 'consulta/' . $id_consulta . '"><i class="fa-solid fa-pen-to-square"></i></a>
            <a class="btn btn-outline-info" href="' . BASE_URL . 'ver-consulta/' . $id_consulta . '"><i class="fa-solid fa-print"></i></a>
        ';
            $arrConsulta[$i]->options = $options;
        }
        $arrResponse['status'] = true;
        $arrResponse['data'] = $arrConsulta;
    }
    echo json_encode($arrResponse);
}
if ($option == "guardar") {
    # code...
}
if ($option == "buscar_registro") {
    if ($_POST) {
        if (empty($_POST['id_usuario'])) {
            $arrResponse = array('status' => false, 'msg' => "Error, Campos vacíos");
        } else {
            $id_usuario = trim($_POST['id_usuario']);
            $arrConsulta = $objConsulta->getConsultaRegistro($id_usuario);
            if (empty($arrConsulta)) {
                $arrResponse = array('status' => false, 'msg' => "Error, No se pudo Crear Consulta");
            } else {
                $arrResponse = array('status' => true, 'msg' => "Datos encontrados", 'data' => $arrConsulta);
            }
            echo json_encode($arrResponse);
        }
    }
    die();
}
if ($option == "ver") {
    if ($_POST) {
        //print_r($_POST);
        if (empty($_POST['id_consulta'])) {
            $arrResponse = array('status' => false, 'msg' => "Error, Campos vacíos");
        } else {
            $id_consulta = trim($_POST['id_consulta']);
            $arrConsulta = $objConsulta->getConsulta($id_consulta);
            if (empty($arrConsulta)) {
                $arrResponse = array('status' => false, 'msg' => "Error, No se pudo Crear Consulta");
            } else {
                $arrResponse = array('status' => true, 'msg' => "Datos encontrados", 'data' => $arrConsulta);
            }
            echo json_encode($arrResponse);
        }
    }
    die();
}
if ($option == "actualizar") {
    //print_r($_POST);
    if ($_POST) {
        if (empty($_POST['id_consulta']) || empty($_POST['id_paciente']) || empty($_POST['id_usuario']) || empty($_POST['motivo_c']) || empty($_POST['diagnostico_c'])) {
            $arrResponse = array('status' => false, 'msg' => "Error de datos");
        } else {
            $id_consulta = trim($_POST['id_consulta']);
            $id_paciente = trim($_POST['id_paciente']);
            $id_usuario = trim($_POST['id_usuario']);
            $motivo_c = ucwords(trim($_POST['motivo_c']));
            $diagnostico_c = ucwords(trim($_POST['diagnostico_c']));

            $arrConsulta = $objConsulta->actualizarConsulta($id_consulta, $id_paciente, $id_usuario, $motivo_c, $diagnostico_c);
            //print_r($arrProducto);
            if ($arrConsulta->id_consulta_p > 0) {
                $arrResponse = array('status' => true, 'msg' => "Datos Actualizados correctamente");
            } else {
                $arrResponse = array('status' => false, 'msg' => "Error al Registrar datos, Código ya existe");
            }
            echo json_encode($arrResponse);
        }
    }
    die();
}
if ($option == "reporte") {
    //print_r($_POST);

    if ($_POST) {
        if (empty($_POST['id_usuario'])) {
            $arrResponse = array('status' => false, 'msg' => "Error, de sesión");
        } else {
            $id_usuario = trim($_POST['id_usuario']);
            $fecha = trim($_POST['fecha']);
            $arrResponse = array('status' => false, 'data' => "");
            $arrConsulta = $objConsulta->getConsultasReporte($id_usuario, $fecha);

            if (!empty($arrConsulta)) {
                for ($i = 0; $i < count($arrConsulta); $i++) {
                    $id_trata = $arrConsulta[$i]->id;

                    $arrTratamientos = $objTratamiento->getTratamientos($id_trata);
                    $arrConsulta[$i]->datos_tratamiento = $arrTratamientos;

                    $nacimiento = $arrConsulta[$i]->fecha_nacimiento;
                    $fch = explode("-", $nacimiento);
                    $tfecha = $fch[2] . "-" . $fch[1] . "-" . $fch[0];

                    $dias = explode("-", $tfecha, 3);
                    $dias = mktime(0, 0, 0, $dias[1], $dias[0], $dias[2]);
                    $edad = (int)((time() - $dias) / 31556926);
                    $arrConsulta[$i]->edad = '' . $edad . '';
                }
                $arrResponse['status'] = true;
                $arrResponse['data'] = $arrConsulta;
            }
            echo json_encode($arrResponse);
        }
    }
    die();
}
