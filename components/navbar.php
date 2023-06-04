<nav class="navbar navbar-expand-lg navbar-green bg-light">
    <a class="navbar-brand" href="./Home.php"><img class="img_responsive" src="img/logo.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="./Home.php">Inicio</a>
            </li>
            <?php if (Session::exists()) { ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Visualizar
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="./list_students.php">Visualizar Alumno</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="./list_tutors.php">Visualizar Tutores</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Registrar Acceso
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="./tomarasistenciaslector.php">Lector De Codigo</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="./tomarasistenciascam.php">Camara</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./registeralumno.php">Registrar Alumno</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./registraradministrativo.php">Administrativo</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./verperiodo.php">Periodo</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/controller/LogoutController.php">Cerrar Sesión</a>
                </li>
            <?php } ?>

            <?php if (!Session::exists()) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="./login.php">Iniciar Sesión</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>