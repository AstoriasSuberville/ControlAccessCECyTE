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
    <title>Tomar Asistencia</title>
</head>

<body>
    <?php
    require_once('components/navbar.php');
    ?>
    <h1>Lectura de código de barras</h1>

    <div id="resultado"></div>
    <div id="video"></div>



    <?php
    require_once('components/footer.php');
    ?>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/fontawesome.js"></script>

    <script defer src="js/quagga.min.js"></script>
    <script defer src="js/scriptTakeAssitance.js"></script>
</body>

</html>