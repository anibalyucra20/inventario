<?php

require_once "./src/model/vistas_model.php";

class vistasControlador extends vistaModelo
{
    public function obtenerPlantillaControlador()
    {
        return require_once "./src/view/plantilla.php";
    }
    public function obtenerVistaControlador()
    {

        if (!isset($_SESSION['sesion_id'])) {
            $respuesta = "login";
        } else {
        if (isset($_GET['views'])) {
            $ruta = explode("/", $_GET['views']);
            $respuesta = vistaModelo::obtener_vista($ruta[0]);
        } else {
            $respuesta = "inicio.php";
        }
        }
        return $respuesta;
    }
}
