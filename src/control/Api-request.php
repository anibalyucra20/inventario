<?php
require_once('../model/admin-apiModel.php');
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-usuarioModel.php');
require_once('../model/adminModel.php');
$tipo = $_GET['tipo'];

//instanciar la clase categoria model
$objApi = new ApiModel();
$objSesion = new SessionModel();
$objUsuario = new UsuarioModel();
$objAdmin = new AdminModel();

//variables de sesion
$token = $_POST['token'];
echo $token;
// consultas de API
if ($tipo = "verBienApiByNombre") {
    $token_arr = explode("-", $token);
    echo $token_arr;
    $id_cliente = $token_arr[2];
    $arr_Cliente = $objApi->buscarClienteById($id_cliente);
    if ($arr_Cliente->estado) {
        $data = $_POST['data'];
        $arr_bienes = $objApi->buscarBienByDenominacion($data);
        $arr_Respuesta = array('status' => true, 'msg' => '', 'contenido'=>$arr_bienes);
    }else {
        $arr_Respuesta = array('status' => false, 'msg' => 'Error, cliente no activo.');
    }
    echo json_encode($arr_Respuesta);
}

