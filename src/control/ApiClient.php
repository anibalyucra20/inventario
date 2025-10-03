<?php
session_start();
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
$id_sesion = $_POST['sesion'];
$token = $_POST['token'];

if ($tipo == "registrar") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        //repuesta
        if ($_POST) {
            $ruc = $_POST['ruc'];
            $razon_social = $_POST['razon_social'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];

            if ($ruc == "" || $razon_social == "" || $correo == "" || $telefono == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_Cliente = $objApi->buscarClienteByRuc($ruc);
                if ($arr_Cliente) {
                    $arr_Respuesta = array('status' => false, 'mensaje' => 'Registro Fallido, Cliente ya se encuentra registrado');
                } else {
                    $id_cliente = $objApi->registrarCliente($ruc, $razon_social, $correo, $telefono);
                    if ($id_cliente > 0) {
                        // array con los id de los sistemas al que tendra el acceso con su rol registrado
                        // caso de administrador y director
                        $arr_Respuesta = array('status' => true, 'mensaje' => 'Registro Exitoso');
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al registrar producto');
                    }
                }
            }
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "registrarToken") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        //repuesta
        if ($_POST) {
            $cliente = $_POST['cliente'];

            if ($cliente == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_Cliente = $objApi->buscarClienteById($cliente);
                if ($arr_Cliente) {
                    $token_generado = bin2hex(random_bytes(16));
                    //date("Y-m-d H:i:s");
                    $fecha_registro = date("Ymd");
                    $token_final = $token_generado . "-" . $fecha_registro . "-" . $cliente;

                    $id_token = $objApi->registrarToken($cliente, $token_final);
                    if ($id_token > 0) {
                        $arr_Respuesta = array('status' => true, 'mensaje' => 'Token Generado Correctamente', 'token' => $token_generado);
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al generar token');
                    }
                }
            }
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "listar_clientes_ordenados_tabla") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $pagina = $_POST['pagina'];
        $cantidad_mostrar = $_POST['cantidad_mostrar'];
        $busqueda_tabla_ruc = $_POST['busqueda_tabla_ruc'];
        $busqueda_tabla_razon = $_POST['busqueda_tabla_razon'];
        $busqueda_tabla_estado = $_POST['busqueda_tabla_estado'];
        //repuesta
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $busqueda_filtro = $objApi->buscarClientesOrderByApellidosNombres_tabla_filtro($busqueda_tabla_ruc, $busqueda_tabla_razon, $busqueda_tabla_estado);
        $arr_Cliente = $objApi->buscarClientesOrderByApellidosNombres_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_ruc, $busqueda_tabla_razon, $busqueda_tabla_estado);
        $arr_contenido = [];
        if (!empty($arr_Cliente)) {
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Cliente); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Cliente[$i]->id;
                $arr_contenido[$i]->ruc = $arr_Cliente[$i]->ruc;
                $arr_contenido[$i]->razon_social = $arr_Cliente[$i]->razon_social;
                $arr_contenido[$i]->correo = $arr_Cliente[$i]->correo;
                $arr_contenido[$i]->telefono = $arr_Cliente[$i]->telefono;
                $arr_contenido[$i]->estado = $arr_Cliente[$i]->estado;
                $opciones = '<button type="button" title="Editar" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal_editar' . $arr_Cliente[$i]->id . '"><i class="fa fa-edit"></i></button>
                                ';
                $arr_contenido[$i]->options = $opciones;
            }
            $arr_Respuesta['total'] = count($busqueda_filtro);
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_contenido;
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "listar_clientes") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $arr_Cliente = $objApi->buscarClientes();
        if (!empty($arr_Cliente)) {
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Cliente); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Cliente[$i]->id;
                $arr_contenido[$i]->ruc = $arr_Cliente[$i]->ruc;
                $arr_contenido[$i]->razon_social = $arr_Cliente[$i]->razon_social;
                $arr_contenido[$i]->correo = $arr_Cliente[$i]->correo;
                $arr_contenido[$i]->telefono = $arr_Cliente[$i]->telefono;
                $arr_contenido[$i]->estado = $arr_Cliente[$i]->estado;
                $opciones = '<button type="button" title="Editar" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal_editar' . $arr_Cliente[$i]->id . '"><i class="fa fa-edit"></i></button>
                                ';
                $arr_contenido[$i]->options = $opciones;
            }
            $arr_Respuesta['total'] = count($arr_Cliente);
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_contenido;
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "actualizar") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        //repuesta
        if ($_POST) {
            $id = $_POST['data'];
            $ruc = $_POST['ruc'];
            $razon_social = $_POST['razon_social'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $estado = $_POST['estado'];

            if ($id == "" || $ruc == "" || $razon_social == "" || $correo == "" || $telefono == "" || $estado == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_Cliente = $objApi->buscarClienteByRuc($ruc);
                if ($arr_Cliente) {
                    if ($arr_Cliente->id == $id) {
                        $consulta = $objApi->actualizarCliente($id, $ruc, $razon_social, $correo, $telefono, $estado);
                        if ($consulta) {
                            $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
                        } else {
                            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar registro');
                        }
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'ruc ya esta registrado');
                    }
                } else {
                    $consulta = $objApi->actualizarCliente($id, $ruc, $razon_social, $correo, $telefono, $estado);
                    if ($consulta) {
                        $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar registro');
                    }
                }
            }
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "actualizarToken") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        //repuesta
        if ($_POST) {
            $id = $_POST['data'];
            $estado = $_POST['estado'];

            if ($id == "" || $estado == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_Cliente = $objApi->buscarClienteById($id);
                $consulta = $objApi->actualizarToken($id, $estado);
                if ($consulta) {
                    $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
                } else {
                    $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar registro');
                }
            }
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "listar_tokens_ordenados_tabla") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $pagina = $_POST['pagina'];
        $cantidad_mostrar = $_POST['cantidad_mostrar'];
        $busqueda_tabla_cliente = $_POST['busqueda_tabla_cliente'];
        $busqueda_tabla_estado = $_POST['busqueda_tabla_estado'];
        //repuesta
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $busqueda_filtro = $objApi->buscarTokensOrderByfecha_tabla_filtro($busqueda_tabla_cliente, $busqueda_tabla_estado);
        $arr_Token = $objApi->buscarTokensOrderByfecha_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_cliente, $busqueda_tabla_estado);
        $arr_contenido = [];
        if (!empty($arr_Token)) {
            $clientes = $objApi->buscarClientes();
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Token); $i++) {
                $id_cliente = $arr_Token[$i]->id_client_api;
                //buscar cliente
                $arr_Cliente = $objApi->buscarClienteById($id_cliente);
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Token[$i]->id;
                $arr_contenido[$i]->ruc = $arr_Cliente->ruc;
                $arr_contenido[$i]->razon_social = $arr_Cliente->razon_social;
                $arr_contenido[$i]->token = $arr_Token[$i]->token;
                $arr_contenido[$i]->fecha_registro = $arr_Token[$i]->fecha_registro;
                $arr_contenido[$i]->estado = $arr_Token[$i]->estado;
                $opciones = '<button type="button" title="Editar" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal_editar' . $arr_Token[$i]->id . '"><i class="fa fa-edit"></i></button>
                                ';
                $arr_contenido[$i]->options = $opciones;
            }
            $arr_Respuesta['total'] = count($busqueda_filtro);
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['clientes'] = $clientes;
            $arr_Respuesta['contenido'] = $arr_contenido;
        }
    }
    echo json_encode($arr_Respuesta);
}

if ($tipo = "verBienApiByNombre") {
    $token_arr = explode("-", $token);
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

