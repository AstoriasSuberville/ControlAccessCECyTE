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
    <title>Login</title>
</head>

<body>
    <?php
    require_once('components/navbar.php');
    ?>
    <div class="container">
        <div class="text-center">
            <img src="./img/CecyteGuerrero&Logo.png" class="img-fluid" alt="">
            <img src="./img/CecyteEMSAD.png" class="img-fluid" width="400" height="400" alt="">
        </div>

        <div class="text-center">
            <hr />
            <img src="./img/logomin.png" class="img-fluid" width="100" height="100" alt="">
            <hr />
        </div>

        <div class="">
            <a href="https://estrategiaenelaula.sep.gob.mx" target="_blank">
                <img src="./img/EstrategiaEnElAulaSEP.png" class="img-fluid" alt="">
            </a>
        </div>

        <div style="background-color: #e2e2e2; margin-top: 30px;" class="text-center">
            <h2 class="text-center">Nuestra Misión</h2>
            <p>Impartir educación científica y tecnológica de calidad y excelencia
                en el nivel medio superior con un enfoque humano-productivo, que forme
                bachilleres y técnicos profesionales con sólidos principios y comprometidos
                con el desarrollo sustentable.</p>
        </div>

        <div>
            <h2>
                Oferta educativa para estudiar Bachillerato
            </h2>
        </div>

        <div class="mb-5">
            <video class="table-responsive" controls>
                <source src="./videos/CECYTE_08_El_Cortes.mp4" type="video/mp4">
                <img src="./img/Error/mantenimiento.png" width="850" height="600" alt="">
            </video>
        </div>

        <div>

        </div>
    </div>
    <?php
    require_once('components/footer.php');
    ?>
    <script src="./js/sweetalert2.all.min.js"></script>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/fontawesome.js"></script>

    <?php if (Session::in('msj')) { ?>
        <script defer>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo Session::get('msj') ?>'
            });
        </script>
    <?php } ?>
</body>

</html>