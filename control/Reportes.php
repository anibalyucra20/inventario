<?php

//require_once "../model/productoModel.php";
//require_once "../model/usuarioModel.php";
require_once "../model/consultorioModel.php";
//require_once "../model/farmaciaModel.php";
//require_once "../model/tratamientoModel.php";


$option = $_REQUEST['op'];



//$objProducto = new productoModel();
//$objUsuario = new UsuarioModel();
$objConsulta = new ConsultorioModel();
//$objTratamiento = new tratamientoModel();
//$objFarmacia = new FarmaciaModel();

if ($option == "consultas") {
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
                    $id_producto = $arrConsulta[$i]->id;
                    $options = '<a class="btn btn-outline-info" href="' . BASE_URL . 'editar-medicamento/' . $id_producto . '"><i class="fa-solid fa-pen-to-square"></i></a>
        <button class="btn btn-outline-danger" onclick="eliminarProducto(' . $id_producto . ');"><i class="fa-solid fa-trash"></i></button>';
                    $arrConsulta[$i]->options = $options;
                }
                $arrResponse['status'] = true;
                $arrResponse['data'] = $arrConsulta;
            }
            echo json_encode($arrResponse);
        }
    }
    die();
}


die();
