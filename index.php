<?php

require_once "./config/config.php";
require_once "./control/vistasControlador.php";

$plantilla = new vistasControlador();
$plantilla->obtener_plantilla_controlador();