<?php

require_once "../model/tratamientoModel.php";

$option = $_REQUEST['op'];



$objTratamiento = new tratamientoModel();

if ($option == "registrar") {
    if ($_POST) {
        if (empty($_POST['id_consulta']) || empty($_POST['id_medicamento_frm']) || empty($_POST['cantidad_c']) || empty($_POST['frecuencia_c']) || empty($_POST['dias_c']) || empty($_POST['via_c'])) {
            $arrResponse = array('status' => false, 'msg' => "Error, Campos vacíos");
        } else {
            $id_consulta = trim($_POST['id_consulta']);
            $id_medicamento_frm = trim($_POST['id_medicamento_frm']);
            $cantidad_c = trim($_POST['cantidad_c']);
            $frecuencia_c = ucwords(trim($_POST['frecuencia_c']));
            $dias_c = ucwords(trim($_POST['dias_c']));
            $via_c = ucwords(trim($_POST['via_c']));

            $arrProducto = $objTratamiento->registrarTratamiento($id_consulta, $id_medicamento_frm, $cantidad_c, $frecuencia_c, $dias_c, $via_c);

            if ($arrProducto->id > 0) {
                $arrResponse = array('status' => true, 'msg' => "Agregado correctamente");
            } else {
                $arrResponse = array('status' => false, 'msg' => "Error, Tratamiento ya agregado");
            }
            echo json_encode($arrResponse);
        }
    }
    die();
}
if ($option == "listar") {
    if ($_POST) {
        $id_consulta = $_POST['id_consulta'];
        $arrResponse = array('status' => false, 'data' => "");
        $arrTratamientos = $objTratamiento->getTratamientos($id_consulta);

        if (!empty($arrTratamientos)) {
            for ($i = 0; $i < count($arrTratamientos); $i++) {
                $id_tratamiento = $arrTratamientos[$i]->id;
                $options = '<a class="btn btn-outline-info" href="' . BASE_URL . 'editar-tratamiento/' . $id_tratamiento . '"><i class="fa-solid fa-pen-to-square"></i></a>
        <button class="btn btn-outline-danger" onclick="eliminarTratamiento(' . $id_tratamiento . ');"><i class="fa-solid fa-trash"></i></button>';
                $arrTratamientos[$i]->options = $options;
            }
            $arrResponse['status'] = true;
            $arrResponse['data'] = $arrTratamientos;
        }
        echo json_encode($arrResponse);
    }
}
