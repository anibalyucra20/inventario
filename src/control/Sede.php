<?php
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-sedeModel.php');
require_once('../model/admin-usuarioModel.php');
$tipo = $_REQUEST['tipo'];

//instanciar la clase model
$objSesion = new SessionModel();
$objSede = new SedeModel();
$objUsuario = new UsuarioModel();

//variables de sesion
$id_sesion = $_POST['sesion'];
$token = $_POST['token'];

if ($tipo == "listar") {
    //repuesta
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $arr_Sedes = $objSede->buscarSedes();
        if (!empty($arr_Sedes)) {
            // recorremos el array para agregar las opciones
            for ($i = 0; $i < count($arr_Sedes); $i++) {
                $id_responsable = $arr_Sedes[$i]->responsable;
                $arr_Usuario = $objUsuario->buscarUsuarioById($id_responsable);
                $arr_Sedes[$i]->nombre_responsable = $arr_Usuario->apellidos_nombres;

                $id_periodo = $arr_Sedes[$i]->id;

                $opciones = '<button class="btn btn-success" data-toggle="modal" data-target=".modal_editar' . $arr_Sedes[$i]->id . '"><i class="fa fa-edit"></i></button> <a href="" class="btn btn-primary" waves-effect waves-light data-toggle="modal" data-target=".bd-example-modal-enable"><i class="fa fa-briefcase"></i></a>';
                $arr_Sedes[$i]->options = $opciones;
            }
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_Sedes;
        }
    }
    echo json_encode($arr_Respuesta);
}


if ($tipo == "registrar") {
    //print_r($_POST);
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {

        $codigoModular = $_POST['codigoModular'];
        $nombre = $_POST['nombre'];
        $departamento = $_POST['departamento'];
        $provincia = $_POST['provincia'];
        $distrito = $_POST['distrito'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $responsable = $_POST['responsable'];

        if ($codigoModular == "" || $nombre == "" || $departamento == "" || $provincia == "" || $distrito == "" || $direccion == "" || $telefono == "" || $correo == "" || $responsable == "") {
            //repuesta
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
        } else {
            $id_sede = $objSede->registrarSede($codigoModular, $nombre, $departamento, $provincia, $distrito, $direccion, $telefono, $correo, $responsable);
            if ($id_sede > 0) {
                $arr_sede = $objSede->buscarSedeById($id_sede);
                $id_responsable = $arr_sede->responsable;
                $arr_Usuario = $objUsuario->buscarUsuarioById($id_responsable);
                $arr_sede->id_responsable = $arr_Usuario->apellidos_nombres;

                $opciones = '<button class="btn btn-success" data-toggle="modal" data-target=".modal_editar' . $id_sede . '"><i class="fa fa-edit"></i></button> <a href="" class="btn btn-primary" waves-effect waves-light data-toggle="modal" data-target=".bd-example-modal-enable"><i class="fa fa-briefcase"></i></a>';
                $arr_sede->options = $opciones;
                $arr_Respuesta = array('status' => true, 'mensaje' => 'Registro Exitoso', 'contenido' => $arr_sede);
            } else {
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al registrar producto');
            }
        }
    }
    echo json_encode($arr_Respuesta);
}

if ($tipo == "actualizar") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $id = $_POST['id'];
        $codigoModular = $_POST['codigoModular'];
        $nombre = $_POST['nombre'];
        $departamento = $_POST['departamento'];
        $provincia = $_POST['provincia'];
        $distrito = $_POST['distrito'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $responsable = $_POST['responsable'];
        if ($id == "" || $codigoModular == "" || $nombre == "" || $departamento == "" || $provincia == "" || $distrito == "" || $direccion == "" || $telefono == "" || $correo == "" || $responsable == "") {
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
        } else {
            $arr_sede = $objSede->actualizarSede($id, $codigoModular, $nombre, $departamento, $provincia, $distrito, $direccion, $telefono, $correo, $responsable);
            if ($arr_sede) {
                $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
            } else {
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar sede');
            }
        }
    }
    echo json_encode($arr_Respuesta);
}
