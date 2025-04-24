<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error 404 - Página no encontrada</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
      background: linear-gradient(135deg, #1e3c72, #2a5298);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      text-align: center;
    }
    .container {
      max-width: 500px;
      padding: 20px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    .container h1 {
      font-size: 6rem;
      margin: 0;
      color: #ff6b6b;
    }
    .container p {
      font-size: 1.2rem;
      margin: 20px 0;
    }
    .container a {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 20px;
      background: #4caf50;
      color: #fff;
      text-decoration: none;
      font-size: 1rem;
      border-radius: 5px;
      transition: background 0.3s ease;
    }
    .container a:hover {
      background: #81c784;
    }
    @media (max-width: 600px) {
      .container h1 {
        font-size: 4rem;
      }
      .container p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>404</h1>
    <p>¡Ups! La página que buscas no está disponible.</p>
    <p>Es posible que haya sido eliminada o que la URL sea incorrecta.</p>
    <a href="/inventario">Regresar al inicio</a>
  </div>
</body>
</html>