<?php
session_start();
require_once('../admon/conexion.php');
require_once('../Helpers/Session.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') die('Method not support, only POST.');
if (!isset($_POST['txtName'], $_POST['txtFirstLastName'], $_POST['txtSecondLastName'], $_POST['txtTelHome'], $_POST['txtTelPersonal'])) die('Vars undefined.');


$name = $_POST['txtName'];
$firstLastName = $_POST['txtFirstLastName'];
$secondLastName = $_POST['txtSecondLastName'];
$telHome = $_POST['txtTelHome'];
$telPersonal = $_POST['txtTelPersonal'];
$tutorId = $_POST['slTutorId'] ?? 0;
$student_id = Session::get('student_barcode');

$query = "SELECT name FROM tutor WHERE id = $tutorId;";
$res = mysqli_query($con, $query);
if (mysqli_num_rows($res) < 1) {
    $query = "INSERT INTO tutor(name, last_name_p, last_name_m, tel_home, tel_personal) values('$name', '$firstLastName', '$secondLastName', '$telHome', '$telPersonal');";
    if (mysqli_query($con, $query)) {
        $tutorId = mysqli_insert_id($con);
    } else {
        $tutorId = null;
    }
}

if ($tutorId != null) {

    $query = "UPDATE user SET tutor_id = $tutorId where barcode = '$student_id'";

    if (mysqli_query($con, $query)) {
        Session::withMessage(['msj' => 'Datos del estudiante completados correctamente.'], function () {
            header('Location: /list_students.php');
        });
    } else {
        Session::withMessage(['error' => 'Ocurrio un error al momento de registrar al usuario, error: ' . mysqli_errno($con)], function () {
            header('Location: /registeralumno.php');
        });
    }
} else {
    Session::withMessage(['student_barcode' => $student_id, 'error' => 'Ocurrio un error al momento de registrar al tutor, favor de intentarlo mas tarde.'], function () {
        header('Location: /registrartutor.php');
    });
}
