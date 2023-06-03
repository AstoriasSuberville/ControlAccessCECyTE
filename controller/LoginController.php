<?php
session_start();
require_once('../Helpers/Hash.php');
require_once('../Helpers/Session.php');
require_once('../admon/conexion.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') die('Error method not support.'); // Si el metodo no es POST dara error
if (!isset($_POST['inputName'], $_POST['inputPassword'])) die('Vars indefined'); // Si las variables no estan definidas no procedera y marcara error

$usuario = $_POST['inputName'];
$password = $_POST['inputPassword'];

$query = "SELECT id, password FROM user WHERE user_name='$usuario'";
$res = mysqli_query($con, $query);

if (!$res) {
    die('Error en la consulta: ' . mysqli_error($con));
}

if (mysqli_num_rows($res) < 1) {
    Session::withMessage(['msj' => 'Sus credenciales no concuerdan'], function () {
        header('Location: /login.php');
    });
}

$row = mysqli_fetch_assoc($res);
$user_id = $row['id'];
$hashedPassword = $row['password'];

if (Hash::verify($password, $hashedPassword)) {
    Session::start($user_id, function () {
        header('Location: /Home.php');
    });
} else {
    Session::withMessage(['msj' => 'Sus credenciales no concuerdan'], function () {
        header('Location: /login.php');
    });
}
