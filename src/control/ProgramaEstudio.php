<?php
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-programaEstudioModel.php');
$tipo = $_REQUEST['tipo'];

//instanciar la clase periodo model
$objSesion = new SessionModel();
$objProgramaEstudio = new ProgramaEstudioModel();

//variables de sesion
$id_sesion = $_POST['sesion'];
$token = $_POST['token'];
if ($tipo == "listar") {
    //repuesta
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {

        $arr_PE = $objProgramaEstudio->buscarProgramaEstudios();
        if (!empty($arr_PE)) {
            // recorremos el array para agregar las opciones
            for ($i = 0; $i < count($arr_PE); $i++) {
                $opciones = '<button class="btn btn-success" data-toggle="modal" data-target=".modal_editar' . $arr_PE[$i]->id . '"><i class="fa fa-edit"></i></button>';
                $arr_PE[$i]->options = $opciones;
            }
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_PE;
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "registrar") {
    //print_r($_POST);
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
    }
}
if ($tipo == "actualizar") {
    //print_r($_POST);
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
    }
}
