<?php
// Añadir una autenticación de usuarios (resta eso)
if ($_SERVER['REQUEST_METHOD'] != 'POST') die(json_encode(array('code' => '405', 'message' => 'Method not supported')));
if (!isset($_POST['period_id'], $_POST['student_id'])) die(json_encode(array('code' => '504', 'message' => 'Parameters not defined')));

require_once('./../admon/conexion.php');
$period_id = $_POST['period_id'];
$student_id = $_POST['student_id'];

$query = "SELECT id, name, initial_day_semester, final_day_semester FROM config_semester WHERE id = $period_id LIMIT 1;";

$res = mysqli_query($con, $query);

if (mysqli_num_rows($res) < 1) {
    die(json_encode(array('code' => '404', 'message' => 'Periodo no definido')));
}

$data = mysqli_fetch_array($res);
$first_day = $data['initial_day_semester'];
$last_day = $data['final_day_semester'];

// obtenemos los dias que el estuidiante tiene asistencias
$query = "SELECT DATE(date_capture) as day, TIME(MIN(date_capture)) as get_id, TIME(MAX(date_capture)) as get_out FROM asistences WHERE user_id = $student_id AND date_capture BETWEEN '$first_day' AND '$last_day' GROUP BY DATE(date_capture);";

$daysSql = mysqli_query($con, $query);
$listAsistences = [];

while ($date = mysqli_fetch_assoc($daysSql)) $listAsistences[] = $date;

// obtenemos los dias no laborales
$query = "SELECT day FROM non_working_days WHERE day BETWEEN '$first_day' AND '$last_day';";

$daysSql = mysqli_query($con, $query);
$listDaysNonWorking = [];

while ($date = mysqli_fetch_assoc($daysSql)) $listDaysNonWorking[] = $date['day'];

//Concentramos todos los datos obtenidos
$all = [
    'semester' => [
        'first_day' => $first_day,
        'last_day' => $last_day
    ],
    'asistencesStudent' => $listAsistences,
    'daysNonWorking' => $listDaysNonWorking
];
echo json_encode(array('request' => $all));
