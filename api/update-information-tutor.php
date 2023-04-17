<?php

// Añadir una autenticación de usuarios (resta eso) 
if ($_SERVER['REQUEST_METHOD'] != 'POST') die(json_encode(array('code' => '405', 'message' => 'Method not supported')));
if (!isset(
    $_POST['tutor_id'],
    $_POST['tutor_name'],
    $_POST['tutor_last_name_p'],
    $_POST['tutor_last_name_m'],
    $_POST['tutor_tel_home'],
    $_POST['tutor_tel_personal'],
)) die(json_encode(array('code' => '504', 'message' => 'Parameters not defined')));

require_once('./../admon/conexion.php');

$tutor_id = htmlspecialchars($_POST['tutor_id']);
$tutor_name = htmlspecialchars($_POST['tutor_name']);
$tutor_last_name_p = htmlspecialchars($_POST['tutor_last_name_p']);
$tutor_last_name_m = htmlspecialchars($_POST['tutor_last_name_m']);
$tutor_tel_home = htmlspecialchars($_POST['tutor_tel_home']);
$tutor_tel_personal = htmlspecialchars($_POST['tutor_tel_personal']);

$sql = "update tutor set name = \"$tutor_name\", last_name_p = \"$tutor_last_name_p\", last_name_m = \"$tutor_last_name_m\", tel_home = \"$tutor_tel_home\", tel_personal = \"$tutor_tel_personal\" where id = \"$tutor_id\"";
if(mysqli_query($con, $sql)){
    echo json_encode(array('code' => '200', 'message' => 'Ok'));
} else {
    echo json_encode(array('code' => '502', 'message' => $sql));
}