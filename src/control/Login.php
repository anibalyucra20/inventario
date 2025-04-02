<?php
require_once("../model/admin-usuarioModel.php");
require_once("../model/admin-sesionModel.php");
require_once("../model/adminModel.php");
require_once("../model/admin-periodoAcademicoModel.php");

$objUsuario = new UsuarioModel();
$objSesion = new SessionModel();
$objAdmin = new AdminModel();
$objPeriodo = new PeriodoAcademicoModel();

$tipo = $_GET['tipo'];

if ($tipo == "iniciar_sesion") {
    //print_r($_POST);
    $usuario = trim($_POST['dni']);
    $password = trim($_POST['password']);
    $arrResponse = array('status' => false, 'msg' => '');

    $arrPersona = $objUsuario->buscarUsuarioByDni($usuario);
    //print_r($arrPersona);
    if (empty($arrPersona)) {
        $arrResponse = array('status' => false, 'msg' => 'Error, Usuario no esta registrado en el sistema');
    } else {
        if (password_verify($password, $arrPersona->password)) {
            $arr_contenido = [];
            // datos de sesion
            $fecha_hora_inicio = date("Y-m-d H:i:s");
            $fecha_hora_fin = strtotime('+2 minute', strtotime($fecha_hora_inicio));
            $fecha_hora_fin = date("Y-m-d H:i:s", $fecha_hora_fin);

            $llave = $objAdmin->generar_llave(30);
            $token = password_hash($llave, PASSWORD_DEFAULT);
            $id_usuario = $arrPersona->id;

            $arrSesion = $objSesion->registrarSesion($id_usuario, $fecha_hora_inicio, $fecha_hora_fin, $llave);
            //buscamos ultimo periodo
            $arrPeriodo = $objPeriodo->buscarPresentePeriodoAcad();
            $arrResponse = array('status' => true, 'msg' => 'Ingresar al sistema');

            $arr_contenido['sesion_sigi_id'] = $arrSesion;
            $arr_contenido['sesion_sigi_usuario'] = $id_usuario;
            $arr_contenido['sesion_sigi_usuario_nom'] = $arrPersona->apellidos_nombres;
            $arr_contenido['sesion_sigi_token'] = $token;
            $arr_contenido['sesion_sigi_periodo'] = $arrPeriodo->id;
            $arr_contenido['sesion_sigi_sede'] = $arrPersona->id_sede;
            $arrResponse['contenido'] = $arr_contenido;
        } else {
            $arrResponse = array('status' => false, 'msg' => 'Error, Usuario y/o Contraseña Incorrecta');
        }
    }
    echo json_encode($arrResponse);
}

die;
