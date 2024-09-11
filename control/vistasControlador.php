<?php 
require_once "./model/vistasModelo.php";

class vistasControlador extends vistasModelo{
    /*------- controlador para obtener plantilla  */
    public function obtener_plantilla_controlador(){
        return require_once "./view/plantilla.php";
    }

    /*------- controlador para obtener vistas  */
    public function obtener_vistas_controlador(){
        if ($_GET['views']) {
           $ruta = explode("/",$_GET['views']);
           $respuesta = vistasModelo::obtener_vistas_modelo($ruta[0]);
        }else{
            $respuesta = "login";
        }
        return $respuesta;
    }
}



?>