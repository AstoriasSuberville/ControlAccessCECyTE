<?php
date_default_timezone_set('America/Mexico_City');
// Añadir una autenticación de usuarios (resta eso)
if ($_SERVER['REQUEST_METHOD'] != 'POST') die(json_encode(array('code' => '405', 'message' => 'Method not supported')));
if (!isset($_POST['barcode'])) die(json_encode(array('code' => '504', 'message' => 'Parameters not defined')));

require_once('./../admon/conexion.php');

$barcode = $_POST['barcode'];

date_default_timezone_set('America/Mazatlan');
$dateToday = date("Y-m-d h:i:s");

$getUserSql = "select id from user where barcode = '" . $barcode . "';";

$userRequest = mysqli_query($con, $getUserSql);

if (mysqli_num_rows($userRequest) < 1) die(json_encode(array('code' => '404', 'message' => 'Usuario no encontrado')));

$userId = mysqli_fetch_array($userRequest)['id'];

$getRegisterSql = "SELECT user_id FROM asistences WHERE user_id = '" . $userId . "' AND DATE(date_capture) = CURDATE()";

$request = mysqli_query($con, $getRegisterSql);

if (!$request) die(json_encode(array('code' => '500', 'message' => 'Error internal server')));

$results = mysqli_num_rows($request);
if ($results > 1) {
    die(json_encode(array('code' => '204', 'message' => 'Usted ya tiene el registro de entrada y salida. Favor de intentar mañana')));
} else {
    $sql = "insert into asistences(user_id, date_capture) values('" . $userId . "','" . $dateToday . "')";
}

$inserRequest = mysqli_query($con, $sql);

if (!$inserRequest) die(json_encode(array('code' => '504', 'message' => 'Error al registrar la asistencia, intentelo nuevamente')));

if ($results > 0) {
    die(json_encode(array('code' => '200', 'message' => 'El registro de salida ya fue tomado, hasta mañana! :3')));
} else {
    die(json_encode(array('code' => '200', 'message' => 'El registro de entrada ya fue tomado, Buen dia! <3')));
}
