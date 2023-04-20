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
        <form method="post" action="./controller/LoginController.php" class="form-signin text-center">
            <img class="mb-4" src="img/logo.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Inicia sesión</h1>

            <input type="text" id="inputName" name="inputName" class="form-control" placeholder="Nombre de Usuario" required autofocus>
            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Contraseña" required>
            
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Recordar mis datos
                </label>
            </div>
            <button class="btn btn-lg btn-success btn-block" name="btntIngresar" type="submit">Acceder</button>
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