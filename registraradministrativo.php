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
    <title>Registrar Administrativo</title>
</head>

<body>
    <?php
    require_once('components/navbar.php');
    ?>
    <div class="container">
        <form class="form-signin text-center" method="POST" action="./controller/RegisterAdmonController.php">
            <img class="mb-4" src="img/logo.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Registrar Administrativo</h1>
            <input type="text" name="AdmonName" id="inputNameAdmon" class="form-control mb-1" placeholder="Nombre" required>
            <input type="text" name="AdmonFirstLastName" id="inputApellidoPAdmon" class="form-control mb-1" placeholder="Apellido Paterno" required>
            <input type="text" name="AdmonSecondLastName" id="inputApellidoMAdmon" class="form-control mb-1" placeholder="Apellido Materno">
            <input type="text" name="AdmonUser" id="inputUserAdmon" class="form-control mb-1" placeholder="Usuario" required>
            <input type="password" name="AdmonPassw" id="inputPasswAdmon" class="form-control mb-1" placeholder="Contraseña" required>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Seleccionar Cargo</label>
                <select class="form-control" name="slCarrier" id="SelectorEspecialities">
                    <?php
                    $query = 'select id, name from rol WHERE id <> 1 order by name asc;';
                    $res = mysqli_query($con, $query);
                    while ($data = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                    <?php } ?>
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
    <script src="./js/sweetalert2.all.min.js"></script>

    <?php if (Session::in('error')) { ?>
        <script defer>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo Session::get('error') ?>'
            });
        </script>
    <?php } ?>

    <?php if (Session::in('msj')) { ?>
        <script defer>
            Swal.fire({
                icon: 'success',
                title: 'Se realizo la acción',
                text: '<?php echo Session::get('msj') ?>'
            });
        </script>
    <?php } ?>
</body>

</html>