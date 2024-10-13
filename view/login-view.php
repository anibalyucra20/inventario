<?php
require_once "./config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
        }
        .bg-light {
            background-color: #f8f9fa!important;
        }
        .center-content {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
    </style>
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
    </script>
</head>
<body class="bg-light">
    <div class="container center-content">
        <div class="login-box">
            <h2 class="text-center">Inicio de Sesión</h2>
            <form id="frm_iniciar_sesion">
                <div class="form-group">
                    <label for="usuario_inv">Usuario</label>
                    <input type="text" class="form-control" id="usuario_inv" name="usuario_inv" placeholder="Introduce tu Usuario" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Introduce tu contraseña" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                <div class="text-center mt-3">
                    <!--<a href="#">¿Olvidaste tu contraseña?</a>-->
                </div>
            </form>
        </div>
    </div>
</body>
<script src="<?php echo BASE_URL; ?>assets/js/functions_login.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</html>
