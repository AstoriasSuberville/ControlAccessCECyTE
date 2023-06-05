<?php

// Añadir una autenticación de usuarios (resta eso)
if ($_SERVER['REQUEST_METHOD'] != 'POST') die(json_encode(array('code' => '405', 'message' => 'Method not supported')));
if (!isset($_POST['name'], $_POST['dateInitSemester'], $_POST['dateFinalSemester'], $_POST['dateNonWorkingDays'])) die(json_encode(array('code' => '504', 'message' => 'Parameters not defined')));

$name = $_POST['name'];
$dateInitSemester = $_POST['dateInitSemester'];
$dateFinalSemester = $_POST['dateFinalSemester'];
$dateNonWorkingDays = $_POST['dateNonWorkingDays'];

require_once('./../admon/conexion.php');

mysqli_begin_transaction($con);

$values = "values";
try {
    $query = "TRUNCATE TABLE non_working_days;";
    mysqli_query($con, $query);

    $query = "TRUNCATE TABLE config_semester;";
    mysqli_query($con, $query);

    $query = "INSERT INTO config_semester(name, initial_day_semester, final_day_semester) values('$name', '$dateInitSemester', '$dateFinalSemester')";
    mysqli_query($con, $query);

    $dates = explode(',', $dateNonWorkingDays);

    for ($i = 0; $i < count($dates); $i++) {
        if (($i + 1) == count($dates)) {
            $values .= "('" . $dates[$i] . "');";
        } else {
            $values .= "('" . $dates[$i] . "'),";
        }
    }

    $query = "INSERT INTO non_working_days(day) $values";
    mysqli_query($con, $query);

    mysqli_commit($con);

    echo json_encode(array('code' => '200', 'msj' => 'Configuraciones cargadas correctamente.'));
} catch (\Throwable $th) {
    mysqli_rollback($con);

    echo json_encode(array('code' => '500', 'msj' => 'Error interno. ' . $th));
}


