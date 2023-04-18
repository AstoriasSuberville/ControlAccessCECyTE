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
    <title>Register Alumno</title>
</head>

<body>
    <?php
        require_once('components/navbar.php');
    ?>
    <div class="container">
        <form class="form-signin text-center">
            <img class="mb-4" src="img/logo.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Registrar Alumno</h1>
            <input type="text" id="inputNameAlumno" class="form-control mb-1" placeholder="Nombre Del Alumno" required autofocus>
            <input type="text" id="inputApellidoP" class="form-control mb-1" placeholder="Apellido Paterno" required>
            <input type="text" id="inputApellidoM" class="form-control mb-1" placeholder="Apellido Materno" required>
            <input type="text" id="inputMatricula" class="form-control mb-1" placeholder="Matricula Del Alumno" required>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Seleccionar Especialidad</label>
                <select class="form-control" id="SelectorEspecialities">
                    <option>Programación</option>
                    <option>Ecoturismo</option>
                </select>
            </div>

            <a class="btn btn-lg btn-success btn-block" href="./registrartutor.php">Siguiente</a>
            <!--<button class="btn btn-lg btn-success btn-block" type="submit">Siguiente</button>-->
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