<?php
require_once "../library/conexion.php";

class AdminModel
{

    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }


    public function generar_llave($cantidad)
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/}{[]@#$%&*()';
        $llave = '';
        $max = strlen($permitted_chars) - 1;
        for ($i = 0; $i < $cantidad; $i++) {
            $llave .= $permitted_chars[rand(0, $max)];
        };
        return $llave;
    }


}
