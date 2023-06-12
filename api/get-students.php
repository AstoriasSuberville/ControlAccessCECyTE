<?php

// Añadir una autenticación de usuarios (resta eso)
if ($_SERVER['REQUEST_METHOD'] != 'POST') die(json_encode(array('code' => '405', 'message' => 'Method not supported')));
if (!isset($_POST['key_words'])) die(json_encode(array('code' => '504', 'message' => 'Parameters not defined')));

require_once('./../admon/conexion.php');
$key_words = $_POST['key_words'];

$students = [];
$sql = "SELECT u.id, u.name, u.last_name_p, u.last_name_m, c.name as carrier
FROM user u 
JOIN rol r ON u.rol_id = r.id 
LEFT JOIN especialities c ON u.speciality_id = c.id 
WHERE lower(r.name) = 'estudiante' 
AND (CONCAT(u.name, ' ', u.last_name_p, ' ', u.last_name_m) LIKE '%Jesus%' 
    OR u.name LIKE '%" . $key_words . "%' 
    OR u.last_name_p LIKE '%" . $key_words . "%' 
    OR u.last_name_m LIKE '%" . $key_words . "%')
GROUP BY u.id;
";
$query = mysqli_query($con, $sql);
while ($getStudents = mysqli_fetch_array($query)) $students[] = $getStudents;

echo json_encode(array('code' => '200', 'students' => $students));
