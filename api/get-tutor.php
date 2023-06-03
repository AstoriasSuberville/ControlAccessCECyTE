<?php

// Añadir una autenticación de usuarios (resta eso)
if ($_SERVER['REQUEST_METHOD'] != 'POST') die(json_encode(array('code' => '405', 'message' => 'Method not supported')));
if (!isset($_POST['tutor_id'])) die(json_encode(array('code' => '504', 'message' => 'Parameters not defined')));

require_once('./../admon/conexion.php');
$tutor_id = $_POST['tutor_id'];

$sql = "select * from tutor where id = $tutor_id;";
$query = mysqli_query($con, $sql);

echo json_encode(array('code' => '200', 'tutor' =>  mysqli_fetch_array($query)));
