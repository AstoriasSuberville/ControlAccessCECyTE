<?php
session_start();
require_once('./Helpers/Session.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./css/flatpickr.min.css">
    <link rel="stylesheet" href="./css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="shortcut icon" type="image/icon" href="img/icon/logo.ico">
    <title>Periodo</title>
</head>

<body>
    <?php
    require_once('components/navbar.php');
    ?>
    <div class="container">
        <form class="form-signin text-center" id="configSemester">
            <img class="mb-4" src="img/logo.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Registrar Semestre</h1>
            <div class="text-left form-group">
                <label for="nameSemester">Nombre del periodo</label>
                <input type="text" class="form-control" id="nameSemester" placeholder="Ejemplo: Periodo 2023 - 2024" required>
            </div>

            <div class="text-left form-group">
                <label for="initSemester">Seleccione el periodo de inicio</label>
                <input type="text" class="form-control period" id="initSemester" placeholder="Click aqui" required>
            </div>

            <div class="text-left form-group">
                <label for="finSemester">Seleccione el periodo final</label>
                <input type="text" class="form-control period" id="finSemester" placeholder="Click aqui" required>
            </div>

            <h3 class="h5 mt-3 mb-3 font-weight-normal">Registrar Semestre</h3>
            <div class="text-left form-group">
                <label for="nonWorkingDays">Seleccione las fechas inhabiles.</label>
                <input type="text" name="xd3" class="form-control" id="nonWorkingDays" placeholder="Click aqui" required>
            </div>

            <button class="btn btn-lg btn-success btn-block" id="btnSendConfigSemester" type="submit">Enviar</button>
            <p class="mt-5 mb-3 text-muted">&copy; CECyTE EL CORTÉS - 2023</p>
        </form>
    </div>
    <?php
    require_once('components/footer.php');
    ?>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/fontawesome.js"></script>
    <script src="./js/flatpickr.js"></script>
    <script src="./js/sweetalert2.all.min.js"></script>
    <script src="./js/verperiodo.js"></script>
</body>

</html>