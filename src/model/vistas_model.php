<?php
class vistaModelo
{
    protected static function obtener_vista($vista)
    {

        $palabras_permitidas_n1 = ['inicio', 'usuarios', 'nuevo-usuario', 'instituciones', 'nueva-institucion', 'ambientes', 'nuevo-ambiente', 'bienes',  'nuevo-bien', 'movimientos', 'nuevo-movimiento', 'imprimir-movimiento', 'reportes', 'api-client', 'new-api-client', 'api-token', 'new-api-token', 'api-count'];

        if (in_array($vista, $palabras_permitidas_n1)) {

            if (is_file("./src/view/" . $vista . ".php")) {
                $contenido = "./src/view/" . $vista . ".php";
            } else {
                $contenido = "404";
            }
        } elseif ($vista == "inicio" || $vista == "index") {
            $contenido = "inicio.php";
        } elseif ($vista == "login") {
            $contenido = "login";
        } elseif ($vista == "api-request") {
            $contenido = "api-request";
        } else {
            $contenido = "404";
        }

        return $contenido;
    }
}
