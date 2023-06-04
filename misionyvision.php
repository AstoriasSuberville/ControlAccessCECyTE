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
    <link rel="stylesheet" href="css/footer.css">
    <link rel="shortcut icon" type="image/icon" href="img/icon/logo.ico">
    <title>Misión y Visión</title>
</head>

<body>
    <?php
        require_once('components/navbar.php');
    ?>
    <div class="container">
        <div class="row mb-5 mt-5">
            <div class="col-md-6">
                <h2 class="text-center">Misión</h2>
                <p>Impartir educación científica y tecnológica de calidad y excelencia
                    en el nivel medio superior con un enfoque humano-productivo, que forme
                    bachilleres y técnicos profesionales con sólidos principios y comprometidos
                    con el desarrollo sustentable.</p>
            </div>
            <div class="col-md-6">
                <h2 class="text-center">Visión</h2>
                <p>Ser una institución educativa líder en la educación científica y tecnológica,
                    con alto prestigio de calidad y excelencia, que incida en el mejoramiento social,
                    económico y político del Estado.</p>
            </div>
        </div>
    </div>
    <?php
        require_once('components/footer.php');
    ?>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/fontawesome.js"></script>
</body>

</html>