<?php

// Añadir una autenticación de usuarios (resta eso)
if ($_SERVER['REQUEST_METHOD'] != 'POST') die(json_encode(array('code' => '405', 'message' => 'Method not supported')));
if (!isset($_POST['student_id'])) die(json_encode(array('code' => '504', 'message' => 'Parameters not defined')));

require_once('./../admon/conexion.php');
$student_id = $_POST['student_id'];

// Iniciar la transacción
mysqli_begin_transaction($con);

$dropAsistences = "DELETE FROM asistences WHERE user_id = $student_id;";
$dropUser = "DELETE FROM user WHERE id = $student_id;";

try {
    // Eliminar asistencias
    mysqli_query($con, $dropAsistences);

    // Eliminar usuario
    mysqli_query($con, $dropUser);

    // Confirmar la transacción
    mysqli_commit($con);

    echo json_encode(array('code' => '200', 'msj' => 'Estudiante eliminado correctamente'));
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    mysqli_rollback($con);

    echo json_encode(array('code' => '500', 'msj' => 'Ocurrió un error al intentar eliminar a este estudiante, error: 500. ' . mysqli_errno($con)));
}
