<?php
require_once "./librerias/conexion.php";

class LoginModel
{
    private $conexion;
    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }
    
   
}
