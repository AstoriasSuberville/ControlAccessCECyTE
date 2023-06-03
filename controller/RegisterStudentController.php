<?php
session_start();
require_once('../admon/conexion.php');
require_once('../Helpers/Session.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') die('Method not support, only POST.');

if (!isset($_POST['txtName'], $_POST['txtFirstLastName'], $_POST['txtSecondLastName'], $_POST['txtMatricula'], $_POST['slCarrier'])) die('Vars undefined.');

$matricula = $_POST['txtMatricula'];
$speciality_id = $_POST['slCarrier'];
$rol_id_defaul = 1;
$name = $_POST['txtName'];
$firstLastName = $_POST['txtFirstLastName'];
$secondLastName = $_POST['txtSecondLastName'];

$query = "select tutor_id from user where barcode = '$matricula';";
$res = mysqli_query($con, $query);

if (mysqli_num_rows($res) > 0) {
    $data = mysqli_fetch_assoc($res);
    if ($data['tutor_id'] == null) {
        Session::withMessage(['student_barcode' => $matricula, 'msj' => 'Estudiante ya estaba registrado, ahora es momento de asignarle un tutor.'], function () {
            header('Location: /registrartutor.php');
        });
    } else {
        Session::withMessage(['error' => 'El estudiante ya esta registrado completamente.'], function () {
            header('Location: /registeralumno.php');
        });
    }
} else {
    $query = "INSERT INTO user(barcode, speciality_id, rol_id, name, last_name_p, last_name_m) 
            values('$matricula', $speciality_id, $rol_id_defaul, '$name', '$firstLastName', '$secondLastName');";

    if (mysqli_query($con, $query)) {
        Session::withMessage(['student_barcode' => $matricula, 'msj' => 'Alumno registrado correctamente, ahora es momento de asignarle un tutor.'], function () {
            header('Location: /registrartutor.php');
        });
    } else {
        Session::withMessage(['error' => 'Ocurrio un error al momento de registrar al usuario, error: ' . mysqli_errno($con)], function () {
            header('Location: /registeralumno.php');
        });
    }
}
