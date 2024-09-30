<?php

require_once "../model/consultorioModel.php";

$option = $_REQUEST['op'];



$objConsulta = new ConsultorioModel();

if ($option == "listar") {
    $arrResponse = array('status' => false, 'data' => "");
    $arrConsulta = $objConsulta->getConsultas();

    if (!empty($arrConsulta)) {
        for ($i = 0; $i < count($arrConsulta); $i++) {
            $id_consulta = $arrConsulta[$i]->id;
            $options = '<a class="btn btn-outline-info" href="' . BASE_URL . 'consulta/' . $id_consulta . '"><i class="fa-solid fa-pen-to-square"></i></a>
        <button class="btn btn-outline-danger" onclick="eliminarConsulta(' . $id_consulta . ');"><i class="fa-solid fa-trash"></i></button>';
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
    # code...
}
if ($option == "actualizar") {
    # code...
}
if ($option == "eliminar") {
    # code...
}
