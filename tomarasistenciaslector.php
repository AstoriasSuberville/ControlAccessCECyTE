<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="shortcut icon" type="image/icon" href="img/icon/logo.ico">
    <title>Registrar Acceso</title>
</head>

<body>
    <?php
    require_once('components/navbar.php');
    ?>
    <h1 class="text-center">Lectura de código de barras</h1>

    <h1>Leer código de barras con JS y lector físico</h1>
    <p>Enfoca el input (es decir, dale un clic) y lee un código con el lector. No olvides abrir la consola con F12</p>
    <input type="text" id="codigo" placeholder="Enfoca este input y usa el lector">
    <br>

    <?php
    require_once('components/footer.php');
    ?>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/fontawesome.js"></script>
    <script src="./js/scriptTakeAccess.js"></script>
</body>

</html>