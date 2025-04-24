<?php
session_start();
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-institucionModel.php');
require_once('../model/admin-usuarioModel.php');
require_once('../model/adminModel.php');
$tipo = $_GET['tipo'];

//instanciar la clase categoria model
$objSesion = new SessionModel();
$objInstitucion = new InstitucionModel();
$objUsuario = new UsuarioModel();

//variables de sesion
$id_sesion = $_POST['sesion'];
$token = $_POST['token'];
if ($tipo == "listar") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        //repuesta
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $arr_Institucion = $objInstitucion->buscarInstitucionOrdenado();
        $arr_contenido = [];
        if (!empty($arr_Institucion)) {
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Institucion); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Institucion[$i]->id;
                $arr_contenido[$i]->nombre = $arr_Institucion[$i]->nombre;
            }
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_contenido;
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "listar_instituciones") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $pagina = $_POST['pagina'];
        $cantidad_mostrar = $_POST['cantidad_mostrar'];
        $busqueda_tabla_codigo = $_POST['busqueda_tabla_codigo'];
        $busqueda_tabla_ruc = $_POST['busqueda_tabla_ruc'];
        $busqueda_tabla_insti = $_POST['busqueda_tabla_insti'];
        //repuesta
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $busqueda_filtro = $objInstitucion->buscarInstitucionOrderByApellidosNombres_tabla_filtro($busqueda_tabla_codigo, $busqueda_tabla_ruc, $busqueda_tabla_insti);
        $arr_Institucion = $objInstitucion->buscarInstitucionOrderByApellidosNombres_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_codigo, $busqueda_tabla_ruc, $busqueda_tabla_insti);
        
        $arr_contenido = [];
        if (!empty($arr_Institucion)) {
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Institucion); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Institucion[$i]->id;
                $arr_contenido[$i]->beneficiario = $arr_Institucion[$i]->beneficiario;
                $arr_contenido[$i]->cod_modular = $arr_Institucion[$i]->cod_modular;
                $arr_contenido[$i]->ruc = $arr_Institucion[$i]->ruc;
                $arr_contenido[$i]->nombre = $arr_Institucion[$i]->nombre;
                $opciones = '<button type="button" title="Editar" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal_editar' . $arr_Institucion[$i]->id . '"><i class="fa fa-edit"></i></button>';
                $arr_contenido[$i]->options = $opciones;
            }
            $arr_Respuesta['total'] = count($busqueda_filtro);
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_contenido;
        }
        $arr_Usuario = $objUsuario->buscarUsuariosOrdenados();
        $arr_contenido_usuarios = [];
        if (!empty($arr_Usuario)) {
            for ($i = 0; $i < count($arr_Usuario); $i++) {
                // definimos el elemento como objeto
                $arr_contenido_usuarios[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido_usuarios[$i]->id = $arr_Usuario[$i]->id;
                $arr_contenido_usuarios[$i]->nombre = $arr_Usuario[$i]->nombres_apellidos;
            }
            $arr_Respuesta['usuarios'] = $arr_contenido_usuarios;
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "registrar") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        //repuesta
        if ($_POST) {
            $beneficiario = $_POST['beneficiario'];
            $cod_modular = $_POST['cod_modular'];
            $ruc = $_POST['ruc'];
            $nombre = $_POST['nombre'];
            if ($cod_modular == "" || $ruc == "" || $nombre == "" || $beneficiario == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_Institucion = $objInstitucion->buscarInstitucionByCodigo($ruc);
                if ($arr_Institucion) {
                    $arr_Respuesta = array('status' => false, 'mensaje' => 'Registro Fallido, Institución ya se encuentra registrado');
                } else {
                    $id_institucion = $objInstitucion->registrarInstitucion($beneficiario,$cod_modular, $ruc, $nombre);
                    if ($id_institucion > 0) {
                        $arr_Respuesta = array('status' => true, 'mensaje' => 'Registro Exitoso');
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al registrar Institución');
                    }
                }
            }
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
            $beneficiario = $_POST['beneficiario'];
            $cod_modular = $_POST['cod_modular'];
            $ruc = $_POST['ruc'];
            $nombre = $_POST['nombre'];

            if ($id == "" || $cod_modular == "" || $ruc == "" || $nombre == "" || $beneficiario == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_Institucion = $objInstitucion->buscarInstitucionByCodigo($cod_modular);
                if ($arr_Institucion) {
                    if ($arr_Institucion->id == $id) {
                        $consulta = $objInstitucion->actualizarInstitucion($id, $beneficiario, $cod_modular, $ruc, $nombre);
                        if ($consulta) {
                            $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
                        } else {
                            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar registro');
                        }
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'código modular ya esta registrado');
                    }
                } else {
                    $consulta = $objInstitucion->actualizarInstitucion($id,$beneficiario, $cod_modular, $ruc, $nombre);
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
if ($tipo == "datos_registro") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //repuesta
        $arr_Usuario = $objUsuario->buscarUsuariosOrdenados();
        $arr_contenido = [];
        if (!empty($arr_Usuario)) {
            for ($i = 0; $i < count($arr_Usuario); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Usuario[$i]->id;
                $arr_contenido[$i]->nombre = $arr_Usuario[$i]->nombres_apellidos;
            }
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_contenido;
        }
        $arr_Respuesta['msg'] = "Datos encontrados";
    }
    echo json_encode($arr_Respuesta);
}
