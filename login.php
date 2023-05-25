<?php
session_start();
if (isset($_SESSION['nombre'])) {
  header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="css.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./img/icon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <title>Login</title>
</head>

<body>
  <div class="main">
    <div class="content">
      <h1>Registro de <br> <span>Vehiculos <br></span> Parcial Final </h1>
      <p class="par">Lorem ipsum dolor sit amet consectetur adipisicing elit.
        <br>Tempore illum, odit harum
        adipisci iusto suscipit <br>debitis, optio error, hic voluptatibus a officia sapiente.
        <br> Reprehenderit nisi!Lorem Lorem ipsum dolor,<br>
        sit amet consectetur adipisicing elit.
        Nobis
      </p>

      <div class="form">
        <form method="POST" action="loginproceso.php">
          <h3>Iniciar sesión</h3>
          <hr>
          <div class="mb-2">
            <label class="form-label">Usuario</label>
            <input type="text" class="form-control" name="nombre" aria-describedby="emailHelp" required>
          </div>
          <div class="mb-2">
            <label for="exampleInputPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="contrasena" required>
          </div>
          <button type="submit" class="btn2">Iniciar sesión</button>

          <?php
          if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'error') {
            ?>
            <br>
            <h2><strong>Datos Erroneos!</strong> usuario o contraseña incorrecta.</h2>

            <?php
          }
          ?>

        </form>

      </div>
    </div>
  </div>
</body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
  </script>

</html>