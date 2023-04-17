<?php

// Añadir una autenticación de usuarios (resta eso)
if ($_SERVER['REQUEST_METHOD'] != 'POST') die(json_encode(array('code' => '405', 'message' => 'Method not supported')));
if (!isset(
    $_POST['user_id'],
    $_POST['user_barcode'],
    $_POST['user_name'],
    $_POST['user_last_name_p'],
    $_POST['user_last_name_m'],
    $_POST['especialty_name'],
)) die(json_encode(array('code' => '504', 'message' => 'Parameters not defined')));

require_once('./../admon/conexion.php');

$student_id = htmlspecialchars($_POST['user_id']);
$user_barcode = htmlspecialchars($_POST['user_barcode']);
$user_name = htmlspecialchars($_POST['user_name']);
$user_last_name_p = htmlspecialchars($_POST['user_last_name_p']);
$user_last_name_m = htmlspecialchars($_POST['user_last_name_m']);
$user_especiality = htmlspecialchars($_POST['especialty_name']);

$sql = "update user set barcode = \"$user_barcode\", name = \"$user_name\", last_name_p = \"$user_last_name_p\", last_name_m = \"$user_last_name_m\", speciality_id = \"$user_especiality\" where id = \"$student_id\"";
if(mysqli_query($con, $sql)){
    echo json_encode(array('code' => '200', 'message' => 'Ok'));
} else {
    echo json_encode(array('code' => '502', 'message' => mysqli_errno($con)));
}
