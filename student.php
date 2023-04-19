<?php
require_once('./admon/conexion.php');

if (!isset($_GET['student_id'])) header('Location: list_students.php');

$student_id = $_GET['student_id'];
$sql = "select u.barcode as user_barcode, u.name as user_name, u.last_name_p as user_last_name_p, u.last_name_m as user_last_name_m, 
        t.name as tutor_name, t.last_name_p as tutor_last_name_p, t.last_name_m as tutor_last_name_m, t.tel_home as tutor_tel_home, t.tel_personal as tutor_tel_personal, e.name as especialty_name
        from user as u inner join tutor as t on u.tutor_id = t.id inner join especialities as e on u.speciality_id = e.id where u.id = '" . $student_id . "' group by u.id;";
$query = mysqli_query($con, $sql);
if (mysqli_num_rows($query) < 1) header('Location: list_students.php');

$student = mysqli_fetch_array($query);
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
    <title>
        <?php echo $student['user_name'] . " " . $student['user_last_name_p'] . " " . $student['user_last_name_m']; ?> -
        Información Del Estudiante</title>
</head>

<body>
    <?php
    require_once('components/navbar.php');
    ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./list_students.php">Lista De Estudiantes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Información Estudiante</li>
        </ol>
    </nav>

    <div class="container mt-3 mb-4">
        <h2 class="text-center text-success font-weight-bold mb-4">Información del Estudiante</h2>
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-center">Detalles del Estudiante</h4>
                <div class="form-group">
                    <label>Nombre completo</label>
                    <input type="email" value="<?php echo $student['user_name'] . " " . $student['user_last_name_p'] . " " . $student['user_last_name_m']; ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Especialidad</label>
                    <input type="email" value="<?php echo $student['especialty_name'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Identificador</label>
                    <input type="email" value="<?php echo $student['user_barcode']; ?>" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="text-center">Detalles del Tutor</h4>
                <div class="form-group">
                    <label>Nombre completo</label>
                    <input type="email" value="<?php echo $student['tutor_name'] . " " . $student['tutor_last_name_p'] . " " . $student['tutor_last_name_m']; ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Numero de Casa</label>
                    <input type="email" value="<?php echo $student['tutor_tel_home'] ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Numero Personal</label>
                    <input type="email" value="<?php echo $student['tutor_tel_personal'] ?>" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end mb-3">
                <a href="./update_information.php?student_id=<?php echo $student_id; ?>" class="btn btn-primary">Actualizar información</a>
            </div>
            <div class="col-md-12">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Ver información de asistencias
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="mb-2">
                                    <h6>Filtrar por periodo</h6>
                                    <form>
                                        <div class="row">
                                            <div class="col">
                                                <input type="date" class="form-control" placeholder="First name">
                                            </div>
                                            <div class="col">
                                                <input type="date" class="form-control" placeholder="Last name">
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary">Filtrar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Asistencias</button>
                                        <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Graficas</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Fecha</th>
                                                        <th scope="col">Hora de entrada</th>
                                                        <th scope="col">Hora de salida</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $getAccesssSql = "SELECT DATE(date_capture) AS fecha, TIME(MIN(date_capture)) AS hora_entrada, TIME(MAX(date_capture)) AS hora_salida FROM asistences where user_id = '" . $student_id . "' GROUP BY DATE(date_capture)";
                                                    $resAccess = mysqli_query($con, $getAccesssSql);
                                                    while ($access = mysqli_fetch_array($resAccess)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo date('d/m/Y', strtotime($access['fecha'])) ?></td>
                                                            <td><?php echo $access['hora_entrada']; ?></td>
                                                            <td><?php if ($access['hora_entrada'] != $access['hora_salida']) {
                                                                    echo $access['hora_salida'];
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        grafica
                                        <div id="chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    require_once('components/footer.php');
    ?>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/fontawesome.js"></script>
    <script src="js/apexcharts.js"></script>
    <script src="js/graficapersonal.js"></script>
</body>

</html>