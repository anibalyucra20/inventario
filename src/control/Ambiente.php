<?php
session_start();
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-ambienteModel.php');
require_once('../model/admin-institucionModel.php');
require_once('../model/adminModel.php');
$tipo = $_GET['tipo'];

//instanciar la clase categoria model
$objSesion = new SessionModel();
$objAmbiente = new AmbienteModel();
$objAdmin = new AdminModel();
$objInstitucion = new InstitucionModel();

//variables de sesion
$id_sesion = $_POST['sesion'];
$token = $_POST['token'];

if ($tipo == "listar") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        $id_ies = $_POST['ies'];
        //print_r($_POST);
        //repuesta
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $arr_Ambiente = $objAmbiente->buscarAmbienteByInstitucion($id_ies);
        $arr_contenido = [];
        if (!empty($arr_Ambiente)) {
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Ambiente); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Ambiente[$i]->id;
                $arr_contenido[$i]->detalle = $arr_Ambiente[$i]->detalle;
            }
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_contenido;
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "listar_ambientes_ordenados_tabla") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $ies = $_POST['ies'];
        $pagina = $_POST['pagina'];
        $cantidad_mostrar = $_POST['cantidad_mostrar'];
        $busqueda_tabla_codigo = $_POST['busqueda_tabla_codigo'];
        $busqueda_tabla_ambiente = $_POST['busqueda_tabla_ambiente'];
        //repuesta
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $busqueda_filtro = $objAmbiente->buscarAmbientesOrderByApellidosNombres_tabla_filtro($busqueda_tabla_codigo, $busqueda_tabla_ambiente, $ies);
        $arr_Ambiente = $objAmbiente->buscarAmbientesOrderByApellidosNombres_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_codigo, $busqueda_tabla_ambiente, $ies);
        $arr_contenido = [];
        if (!empty($arr_Ambiente)) {
            $arr_Institucion = $objInstitucion->buscarInstitucionOrdenado();
            $arr_Respuesta['instituciones'] = $arr_Institucion;
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Ambiente); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Ambiente[$i]->id;
                $arr_contenido[$i]->institucion = $arr_Ambiente[$i]->id_ies;
                $arr_contenido[$i]->codigo = $arr_Ambiente[$i]->codigo;
                $arr_contenido[$i]->detalle = $arr_Ambiente[$i]->detalle;
                $arr_contenido[$i]->otros_detalle = $arr_Ambiente[$i]->otros_detalle;
                $opciones = '<button type="button" title="Editar" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal_editar' . $arr_Ambiente[$i]->id . '"><i class="fa fa-edit"></i></button>';
                $arr_contenido[$i]->options = $opciones;
            }
            $arr_Respuesta['total'] = count($busqueda_filtro);
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_contenido;
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
            $institucion = $_POST['ies'];
            $codigo = $_POST['codigo'];
            $detalle = $_POST['detalle'];
            $otros_detalle = $_POST['otros_detalle'];
            if ($institucion == "" || $codigo == "" || $detalle == "" || $otros_detalle == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_Usuario = $objAmbiente->buscarAmbienteByCpdigoInstitucion($codigo, $institucion);
                if ($arr_Usuario) {
                    $arr_Respuesta = array('status' => false, 'mensaje' => 'Registro Fallido, Usuario ya se encuentra registrado');
                } else {
                    $id_usuario = $objAmbiente->registrarAmbiente($institucion, $codigo, $detalle, $otros_detalle);
                    if ($id_usuario > 0) {
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

if ($tipo == "actualizar") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        //repuesta
        if ($_POST) {
            $id = $_POST['data'];
            $id_ies = $_POST['id_ies'];
            $codigo = $_POST['codigo'];
            $detalle = $_POST['detalle'];
            $otros_detalle = $_POST['otros_detalle'];

            if ($id == "" || $id_ies == "" || $codigo == "" || $detalle == "" || $otros_detalle == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_Ambiente = $objAmbiente->buscarAmbienteByCpdigoInstitucion($codigo, $id_ies);
                if ($arr_Ambiente) {
                    if ($arr_Ambiente->id == $id) {
                        $consulta = $objAmbiente->actualizarAmbiente($id, $id_ies, $codigo, $detalle, $otros_detalle);
                        if ($consulta) {
                            $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
                        } else {
                            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar registro');
                        }
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'dni ya esta registrado');
                    }
                } else {
                    $consulta = $objAmbiente->actualizarAmbiente($id, $id_ies, $codigo, $detalle, $otros_detalle);
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
        $arr_Instirucion = $objInstitucion->buscarInstitucionOrdenado();
        $arr_Respuesta['instituciones'] = $arr_Instirucion;
        $arr_Respuesta['status'] = true;
        $arr_Respuesta['msg'] = "Datos encontrados";
    }
    echo json_encode($arr_Respuesta);
}
