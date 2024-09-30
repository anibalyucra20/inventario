<?php 
class vistasModelo{
    /*------- modelo para obtener vistas  */
    protected static function obtener_vistas_modelo($vistas){
        $lista_blanca = ['inicio','usuarios','nuevo-usuario','editar-usuario','medicamento','editar-medicamento','nuevo-medicamento','categorias','nueva-categoria','editar-categoria','consultorio', 'nueva-consulta', 'consulta','ver-consulta','farmacia'];
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