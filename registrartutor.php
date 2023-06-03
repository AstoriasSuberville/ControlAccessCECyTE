<?php
session_start();
require_once('./Helpers/Session.php');
require_once('./admon/conexion.php');

if (!Session::exists()) {
    Session::withMessage(['msj' => 'Usted no ha iniciado sesion'], function () {
        header('Location: /login.php');
    });
}
if (!Session::in('student_barcode')) {
    Session::withMessage(['error' => 'Debes registrar a un alumno primeramente. :/'], function () {
        header('Location: /registeralumno.php');
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
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="shortcut icon" type="image/icon" href="img/icon/logo.ico">
    <title>Registrar Tutor</title>
</head>

<body>
    <?php
    require_once('components/navbar.php');
    ?>
    <div class="container">
        <form class="form-signin text-center" method="POST" action="./controller/RegisterTutorController.php">
            <img class="mb-4" src="img/logo.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Registrar Tutor</h1>
            <input type="text" name="txtName" id="inputNameTutor" class="form-control mb-1" placeholder="Nombre Del Tutor" autofocus required>
            <input type="text" name="txtFirstLastName" id="inputApellidoP" class="form-control mb-1" placeholder="Apellido Paterno" required>
            <input type="text" name="txtSecondLastName" id="inputApellidoM" class="form-control mb-1" placeholder="Apellido Materno">
            <input type="text" name="txtTelHome" id="inputTelefonoHome" class="form-control mb-1" placeholder="Telefono De Casa" required>
            <input type="text" name="txtTelPersonal" id="inputTelefonoPerson" class="form-control mb-1" placeholder="Telefono Personal">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Seleccionar Tutor Existente</label>
                <select class="form-control" name="slTutorId" id="SelectorTutorExistente">
                    <option value="0" disabled selected>Carga un tutor existente.</option>
                    <?php
                    $query = "select id, concat(name, ' ', last_name_p, ' ', last_name_m) as name from tutor order by name asc;";
                    $res = mysqli_query($con, $query);
                    while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                    <?php } ?>
                    <option value="-1">Limpiar campos</option>
                </select>
            </div>

            <button class="btn btn-lg btn-success btn-block" type="submit">Registrar</button>
            <p class="mt-5 mb-3 text-muted">&copy; CECyTE EL CORTÉS - 2023</p>
        </form>
    </div>
    <?php
    require_once('components/footer.php');
    ?>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/fontawesome.js"></script>
    <script src="js/select2.min.js"></script>

    <script src="js/scriptRegisterTutor.js"></script>

    <script src="./js/sweetalert2.all.min.js"></script>

    <?php if (Session::in('msj')) { ?>
        <script defer>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Muy bien :)',
                text: '<?php echo Session::get('msj') ?>'
            });
        </script>
    <?php } ?>

    <?php if (Session::in('error')) { ?>
        <script defer>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Opps...',
                text: '<?php echo Session::get('error') ?>'
            });
        </script>
    <?php } ?>
</body>

</html>