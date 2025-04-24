<?php
session_start();
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-bienModel.php');
require_once('../model/admin-ingresoModel.php');
require_once('../model/admin-ambienteModel.php');
require_once('../model/adminModel.php');
$tipo = $_GET['tipo'];

//instanciar la clase categoria model
$objSesion = new SessionModel();
$objBien = new BienModel();
$objIngreso = new IngresoModel();
$objAmbiente = new AmbienteModel();
$objAdmin = new AdminModel();

//variables de sesion
$id_sesion = $_POST['sesion'];
$token = $_POST['token'];

if ($tipo == "buscar_bien_movimiento") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $ies = $_POST['ies'];
        $dato_busqueda = $_POST['dato_busqueda'];
        $ambiente = $_POST['ambiente'];
        //repuesta
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $arr_Bienes = $objBien->buscarBienes_filtro($dato_busqueda, $ambiente);
        $arr_contenido = [];
        $arr_Ambientes = $objAmbiente->buscarAmbienteByInstitucion($ies);
        $arr_Respuesta['ambientes'] = $arr_Ambientes;
        if (!empty($arr_Bienes)) {
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Bienes); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Bienes[$i]->id;
                $arr_contenido[$i]->id_ambiente = $arr_Bienes[$i]->id_ambiente;
                $arr_contenido[$i]->cod_patrimonial  = $arr_Bienes[$i]->cod_patrimonial;
                $arr_contenido[$i]->denominacion = $arr_Bienes[$i]->denominacion;
                $opciones = '<button type="button" title="Agregar" class="btn btn-success waves-effect waves-light" onclick="agregar_bien_movimiento(' . $arr_Bienes[$i]->id . ');"><i class="fa fa-plus"></i></button>';
                $arr_contenido[$i]->options = $opciones;
            }
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_contenido;
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "listar_bienes_ordenados_tabla") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $ies = $_POST['ies'];
        $pagina = $_POST['pagina'];
        $cantidad_mostrar = $_POST['cantidad_mostrar'];
        $busqueda_tabla_codigo = $_POST['busqueda_tabla_codigo'];
        $busqueda_tabla_ambiente = $_POST['busqueda_tabla_ambiente'];
        $busqueda_tabla_denominacion = $_POST['busqueda_tabla_denominacion'];
        //repuesta
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $busqueda_filtro = $objBien->buscarBienesOrderByDenominacion_tabla_filtro($busqueda_tabla_codigo, $busqueda_tabla_ambiente, $busqueda_tabla_denominacion, $ies);
        $arr_Bienes = $objBien->buscarBienesOrderByDenominacion_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_codigo, $busqueda_tabla_ambiente, $busqueda_tabla_denominacion, $ies);
        $arr_contenido = [];
        $arr_Ambientes = $objAmbiente->buscarAmbienteByInstitucion($ies);
        $arr_Respuesta['ambientes'] = $arr_Ambientes;
        if (!empty($arr_Bienes)) {
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Bienes); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Bienes[$i]->id;
                $arr_contenido[$i]->id_ambiente = $arr_Bienes[$i]->id_ambiente;
                $arr_contenido[$i]->cod_patrimonial  = $arr_Bienes[$i]->cod_patrimonial;
                $arr_contenido[$i]->denominacion = $arr_Bienes[$i]->denominacion;
                $arr_contenido[$i]->marca = $arr_Bienes[$i]->marca;
                $arr_contenido[$i]->modelo = $arr_Bienes[$i]->modelo;
                $arr_contenido[$i]->tipo = $arr_Bienes[$i]->tipo;
                $arr_contenido[$i]->color = $arr_Bienes[$i]->color;
                $arr_contenido[$i]->serie     = $arr_Bienes[$i]->serie;
                $arr_contenido[$i]->dimensiones = $arr_Bienes[$i]->dimensiones;
                $arr_contenido[$i]->valor = $arr_Bienes[$i]->valor;
                $arr_contenido[$i]->situacion = $arr_Bienes[$i]->situacion;
                $arr_contenido[$i]->estado_conservacion = $arr_Bienes[$i]->estado_conservacion;
                $arr_contenido[$i]->observaciones = $arr_Bienes[$i]->observaciones;
                $opciones = '<button type="button" title="Editar" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal_editar' . $arr_Bienes[$i]->id . '"><i class="fa fa-edit"></i></button>';
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
        // primero registrar ingreso
        $descripcion = $_POST['descripcion'];
        $bienes = json_decode($_POST['bienes']);

        if ($descripcion == "" || count($bienes) < 1) {
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos y/o no existe bienes para registrar');
        } else {
            $arr_usuario = $objSesion->buscarSesionLoginById($id_sesion);
            $id_usuario = $arr_usuario->id_usuario;

            $id_ingreso = $objIngreso->registrarIngreso($descripcion, $id_usuario);
            if ($id_ingreso > 0) {
                foreach ($bienes as $key => $bien) {
                    // aqui registrar bienes
                    $ambiente = $bien->ambiente;
                    $cod_patrimonial = $bien->cod_patrimonial;
                    $denominacion = $bien->denominacion;
                    $marca = $bien->marca;
                    $modelo = $bien->modelo;
                    $tipo = $bien->tipo;
                    $color = $bien->color;
                    $serie = $bien->serie;
                    $dimensiones = $bien->dimensiones;
                    $valor = $bien->valor;
                    $situacion = $bien->situacion;
                    $estado_conservacion = $bien->estado_conservacion;
                    $observaciones = $bien->observaciones;
                    $contar_errores = 0;
                    if ($ambiente == "" || $denominacion == "" || $marca == "" || $modelo == "" || $tipo == "" || $color == "" || $serie == "" || $dimensiones == "" || $valor == "" || $situacion == "" || $estado_conservacion == "" || $observaciones == "") {
                        //repuesta
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
                    } else if ($cod_patrimonial != '') {
                        $arr_bien = $objBien->buscarBienByCodigoPatrimonial($cod_patrimonial);
                        if ($arr_bien) {
                            $arr_Respuesta = array('status' => false, 'mensaje' => 'Registro Fallido, Bien ya se encuentra registrado');
                        } else {
                            $id_bien = $objBien->registrarBien($ambiente, $cod_patrimonial, $denominacion, $marca, $modelo, $tipo, $color, $serie, $dimensiones, $valor, $situacion, $estado_conservacion, $observaciones, $id_usuario, $id_ingreso);
                            if ($id_bien == 0) {
                                $contar_errores++;
                            }
                        }
                    } else {
                        $id_bien = $objBien->registrarBien($ambiente, $cod_patrimonial, $denominacion, $marca, $modelo, $tipo, $color, $serie, $dimensiones, $valor, $situacion, $estado_conservacion, $observaciones, $id_usuario, $id_ingreso);
                        if ($id_bien == 0) {
                            $contar_errores++;
                        }
                    }
                    if ($contar_errores > 0) {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, error al registrar ' . $contar_errores . ' bienes por codigo patrimonial duplicado');
                    } else {
                        $arr_Respuesta = array('status' => true, 'mensaje' => 'Registro exitoso');
                    }
                }
            } else {
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, error al registrar ingreso');
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
            $cod_patrimonial = $_POST['cod_patrimonial'];
            $denominacion = $_POST['denominacion'];
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $tipo = $_POST['tipo'];
            $color = $_POST['color'];
            $serie = $_POST['serie'];
            $dimensiones = $_POST['dimensiones'];
            $valor = $_POST['valor'];
            $situacion = $_POST['situacion'];
            $estado_conservacion = $_POST['estado_conservacion'];
            $observaciones = $_POST['observaciones'];
            if ($denominacion == "" || $marca == "" || $modelo == "" || $tipo == "" || $color == "" || $serie == "" || $dimensiones == "" || $valor == "" || $situacion == "" || $estado_conservacion == "" || $observaciones == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else if ($cod_patrimonial == '') {
                $consulta = $objBien->actualizarBien($id, $cod_patrimonial, $denominacion, $marca, $modelo, $tipo, $color, $serie, $dimensiones, $valor, $situacion, $estado_conservacion, $observaciones);
                if ($consulta) {
                    $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
                } else {
                    $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar registro');
                }
            } else {
                $arr_Bien = $objBien->buscarBienByCodigoPatrimonial($cod_patrimonial);
                if ($arr_Bien) {
                    if ($arr_Bien->id == $id) {
                        $consulta = $objBien->actualizarBien($id, $cod_patrimonial, $denominacion, $marca, $modelo, $tipo, $color, $serie, $dimensiones, $valor, $situacion, $estado_conservacion, $observaciones);
                        if ($consulta) {
                            $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
                        } else {
                            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar registro');
                        }
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'codigo patrimonial ya esta registrado');
                    }
                } else {
                    $consulta = $objBien->actualizarBien($id, $cod_patrimonial, $denominacion, $marca, $modelo, $tipo, $color, $serie, $dimensiones, $valor, $situacion, $estado_conservacion, $observaciones);
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
