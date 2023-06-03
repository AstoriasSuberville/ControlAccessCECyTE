<?php
session_start();
require_once('./Helpers/Session.php');
require_once('./admon/conexion.php');

if (!Session::exists()) {
    Session::withMessage(['msj' => 'Usted no ha iniciado sesion'], function () {
        header('Location: /login.php');
    });
}


if (!isset($_GET['student_id'])) header('Location: ./list_students.php');

$student_id = $_GET['student_id'];
$sql = "select u.barcode as user_barcode, u.name as user_name, u.last_name_p as user_last_name_p, u.last_name_m as user_last_name_m, 
        t.id as tutor_id, t.name as tutor_name, t.last_name_p as tutor_last_name_p, t.last_name_m as tutor_last_name_m, t.tel_home as tutor_tel_home, t.tel_personal as tutor_tel_personal, e.id as especialty_id, e.name as especialty_name
        from user as u inner join tutor as t on u.tutor_id = t.id inner join especialities as e on u.speciality_id = e.id where u.id = '" . $student_id . "' group by u.id;";
$query = mysqli_query($con, $sql);
if (mysqli_num_rows($query) < 1) header('Location: list_students.php');

$student = mysqli_fetch_array($query);

$especialities = mysqli_query($con, "select id, name from especialities;");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./css/app.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="shortcut icon" type="image/icon" href="./img/icon/logo.ico">
    <title>
        <?php echo $student['user_name'] . " " . $student['user_last_name_p'] . " " . $student['user_last_name_m']; ?> -
        Actualizaciónn de datos.</title>
</head>

<body>
    <?php
    require_once('./components/navbar.php');
    ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./list_students.php">Lista De Estudiantes</a></li>
            <li class="breadcrumb-item"><a href="./student.php">Información Estudiante</a></li>
            <li class="breadcrumb-item active" aria-current="page">Actualización De Datos</li>
        </ol>
    </nav>

    <div class="container mt-3 mb-4">
        <h2 class="text-center text-success font-weight-bold mb-4">Actualización de Datos del Estudiante</h2>
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Estudiante</button>
                    <button class="nav-link" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Tutor</button>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <form action="/api/update-information-student.php" method="post">
                            <h4 class="text-center">Información del Estudiante</h4>
                            <input type="hidden" name="user_id" value="<?php echo stripslashes($student_id); ?>">
                            <div class="form-group">
                                <label>Numero de control (codigo de barras)</label>
                                <input type="text" name="user_barcode" value="<?php echo stripslashes($student['user_barcode']); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nombre Completo</label>
                                <input type="text" name="user_name" value="<?php echo stripslashes($student['user_name']); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Apellido Paterno</label>
                                <input type="text" name="user_last_name_p" value="<?php echo stripslashes($student['user_last_name_p']); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Apellido Materno</label>
                                <input type="text" name="user_last_name_m" value="<?php echo stripslashes($student['user_last_name_m']); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Especialidad</label>
                                <select name="especialty_name" class="form-control">
                                    <?php
                                    while ($espealty = mysqli_fetch_array($especialities)) {
                                    ?>
                                        <option value="<?php echo $espealty['id']; ?>" <?php if ($espealty['id'] == $student['especialty_id']) echo "selected"; ?>>
                                            <?php echo $espealty['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" name="update-information-student" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <form action="/api/update-information-tutor.php" method="post">
                            <h4 class="text-center">Información del Tutor</h4>
                            <input type="hidden" name="tutor_id" value="<?php echo stripslashes($student['tutor_id']); ?>">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="tutor_name" value="<?php echo stripslashes($student['tutor_name']); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Apellido Paterno</label>
                                <input type="text" name="tutor_last_name_p" value="<?php echo stripslashes($student['tutor_last_name_p']); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Apellido Materno</label>
                                <input type="text" name="tutor_last_name_m" value="<?php echo stripslashes($student['tutor_last_name_m']); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Numero de Telefonico de Casa</label>
                                <input type="number" name="tutor_tel_home" value="<?php echo stripslashes($student['tutor_tel_home']); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Numero de Telefono Personal</label>
                                <input type="number" name="tutor_tel_personal" value="<?php echo stripslashes($student['tutor_tel_personal']); ?>" class="form-control">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" name="update-information-student" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require_once('./components/footer.php');
    ?>
    <script src="./js/app.js"></script>
    <script src="./js/jquery-3.6.4.min.js"></script>
    <script src="./js/bootstrap/bootstrap.min.js"></script>
    <script src="./js/fontawesome.js"></script>
    <script src="./js/request_update_informartion_post.js"></script>
</body>

</html>