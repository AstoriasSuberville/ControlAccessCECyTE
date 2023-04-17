<?php

// Añadir una autenticación de usuarios (resta eso)
if ($_SERVER['REQUEST_METHOD'] != 'POST') die(json_encode(array('code' => '405', 'message' => 'Method not supported')));
if (!isset($_POST['key_words'])) die(json_encode(array('code' => '504', 'message' => 'Parameters not defined')));

require_once('./../admon/conexion.php');
$key_words = $_POST['key_words'];

$students = [];
$sql = "select id, name, last_name_p, last_name_m from user where CONCAT(name, ' ', last_name_p, ' ', last_name_m) like '%" . $key_words . "%' or name like '%" . $key_words . "%' or last_name_p like '%" . $key_words . "%' or last_name_m like '%" . $key_words . "%' group by id;";
$query = mysqli_query($con, $sql);
while ($getStudents = mysqli_fetch_array($query)) $students[] = $getStudents;

echo json_encode(array('code' => '200', 'students' => $students));
