<?php
session_start();
require_once "./src/config/config.php";
require_once "./src/control/vistas_control.php";


$mostrar = new vistasControlador();
$vista = $mostrar->obtenerVistaControlador();

if (isset($_SESSION['sesion_id']) && isset($_SESSION['sesion_token'])) {

    $curl = curl_init(); //inicia la sesión cURL
    curl_setopt_array($curl, array(
        CURLOPT_URL => BASE_URL_SERVER."src/control/Sesion.php?tipo=validar_sesion&sesion=".$_SESSION['sesion_id']."&token=".$_SESSION['sesion_token'], //url a la que se conecta
        CURLOPT_RETURNTRANSFER => true, //devuelve el resultado como una cadena del tipo curl_exec
        CURLOPT_FOLLOWLOCATION => true, //sigue el encabezado que le envíe el servidor
        CURLOPT_ENCODING => "", // permite decodificar la respuesta y puede ser"identity", "deflate", y "gzip", si está vacío recibe todos los disponibles.
        CURLOPT_MAXREDIRS => 10, // Si usamos CURLOPT_FOLLOWLOCATION le dice el máximo de encabezados a seguir
        CURLOPT_TIMEOUT => 30, // Tiempo máximo para ejecutar
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, // usa la versión declarada
        CURLOPT_CUSTOMREQUEST => "GET", // el tipo de petición, puede ser PUT, POST, GET o Delete dependiendo del servicio
        CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: ".BASE_URL_SERVER,
            "x-rapidapi-key: XXXX"
        ), //configura las cabeceras enviadas al servicio
    )); //curl_setopt_array configura las opciones para una transferencia cURL

    $response = curl_exec($curl); // respuesta generada
    $err = curl_error($curl); // muestra errores en caso de existir

    curl_close($curl); // termina la sesión 

    if ($err) {
        echo "cURL Error #:" . $err; // mostramos el error
    } else {
        /*echo $response; // en caso de funcionar correctamente
        echo $_SESSION['sesion_sigi_id'];
        echo $_SESSION['sesion_sigi_token'];*/
    }
    //$arrSesion = $objSesion->verificar_sesion_si_activa($_SESSION['sesion_sigi_id'], $_SESSION['sesion_sigi_token']);
    if (!$response) {
        //echo $response;
        $vista = "login";
    }
}

if ($vista == "login" || $vista == "404") {
    require_once "./src/view/" . $vista . ".php";
} else {

    include "./src/view/include/header.php";
    include $vista;
    include "./src/view/include/footer.php";
}
