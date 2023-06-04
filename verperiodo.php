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
    <form class="form-signin text-center" method="POST" action="">
            <img class="mb-4" src="img/logo.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Registrar Semestre</h1>
            <input type="date" name="InicioCurso" id="InicioCurso" class="form-control mb-1" placeholder="Ingresa Inicio de Curso Semestral" required>
            <input type="date" name="FinCurso" id="FinCurso" class="form-control mb-1" placeholder="Ingresa Fin de Curso Semestral" required>
            <input type="date" name="SuspensionLaboral" id="inputApellidoM" class="form-control mb-1" placeholder="Suspensión de labores docentes">
            <input type="date" name="Vacacion" id="vacacion" class="form-control mb-1" placeholder="Vacaciones" required>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Seleccionar Especialidad</label>
                <select class="form-control" name="slCarrier" id="SelectorEspecialities">
                </select>
            </div>

            <button class="btn btn-lg btn-success btn-block" type="submit">Siguiente</button>
            <p class="mt-5 mb-3 text-muted">&copy; CECyTE EL CORTÉS - 2023</p>
        </form>
    </div>
    <?php
        require_once('components/footer.php');
    ?>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/fontawesome.js"></script>
</body>

</html>