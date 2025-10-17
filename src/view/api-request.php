<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input type="text" id="ruta_api" value="https://api.sigi.pe/">
    <form action="" id="frmApi">
        <input type="text" value="12a1be6cec17998b27d3724ced4dd7b2-20251003-1" name="token" id="token">
        <input type="text" name="data" id="data">
        <br>
    </form>
    <button id="btn_buscar" onclick="llamar_api();">Buscar</button>
    <br>
    <div id="contenido"></div>
</body>
<script src="<?php echo BASE_URL; ?>src/view/js/api.js"></script>

</html>