<?php 
class vistasModelo{
    /*------- modelo para obtener vistas  */
    protected static function obtener_vistas_modelo($vistas){
        $lista_blanca = ['usuario','crar-usuario','editar-usuario','medicamento'];
        if (in_array($vistas,$lista_blanca)) {
            if (is_file("./view/".$vistas."-view.php")) {
                $contenido = "./view/".$vistas."-view.php";
            }else {
                $contenido = "404";
            }
        }elseif ($vistas=="login" || $vistas=="index") {
            $contenido = "login";
        }else {
            $contenido = "404";
        }
        return $contenido;
    }
    /*------- fin modelo para obtener vistas  */
}

?>