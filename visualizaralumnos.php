<?php
session_start();
require_once('./Helpers/Session.php');
require_once('./admon/conexion.php');

if (!Session::exists()) {
    Session::withMessage(['msj' => 'Usted no ha iniciado sesion'], function () {
        header('Location: /login.php');
    });
}
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
    <title>Visualizar Alumnos</title>
</head>

<body>
    <?php
    require_once('components/navbar.php');
    ?>
    <div>
        <h1 class="text-center">Lista De Alumnos</h1>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Matricula</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>Issac</td>
                <td>
                    <a class="btn btn-lg btn-success" href=""><img src="./resourses/icons/eye.svg" alt=""></a>
                    <a class="btn btn-lg btn-success" href=""><img src="./resourses/icons/trash.svg" alt=""></a>
                    <a class="btn btn-lg btn-success" href=""><img src="./resourses/icons/bar-chart.svg" alt=""></a>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>
                    <a class="btn btn-lg btn-success" href=""><img src="./resourses/icons/eye.svg" alt=""></a>
                    <a class="btn btn-lg btn-success" href=""><img src="./resourses/icons/trash.svg" alt=""></a>
                    <a class="btn btn-lg btn-success" href=""><img src="./resourses/icons/bar-chart.svg" alt=""></a>
                </td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                <td>
                    <a class="btn btn-lg btn-success" href=""><img src="./resourses/icons/eye.svg" alt=""></a>
                    <a class="btn btn-lg btn-success" href=""><img src="./resourses/icons/trash.svg" alt=""></a>
                    <a class="btn btn-lg btn-success" href=""><img src="./resourses/icons/bar-chart.svg" alt=""></a>
                </td>
            </tr>
        </tbody>
    </table>
    <?php
    require_once('components/footer.php');
    ?>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/fontawesome.js"></script>
</body>

</html>