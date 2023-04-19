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
    <title>Registrar Tutor</title>
</head>

<body>
    <?php
        require_once('components/navbar.php');
    ?>
    <div class="container">
        <form class="form-signin text-center">
            <img class="mb-4" src="img/logo.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Registrar Tutor</h1>
            <input type="text" id="inputNameTutor" class="form-control mb-1" placeholder="Nombre Del Tutor" autofocus>
            <input type="text" id="inputApellidoP" class="form-control mb-1" placeholder="Apellido Paterno">
            <input type="text" id="inputApellidoM" class="form-control mb-1" placeholder="Apellido Materno">
            <input type="text" id="inputTelefonoHome" class="form-control mb-1" placeholder="Telefono De Casa">
            <input type="text" id="inputTelefonoPerson" class="form-control mb-1" placeholder="Telefono Personal">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Seleccionar Tutor Existente</label>
                <select class="form-control" id="SelectorTutorExistente">
                    <option>Tutor1</option>
                    <option>Tutor2</option>
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
</body>

</html>