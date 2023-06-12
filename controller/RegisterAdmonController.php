<?php
session_start();
require_once('../admon/conexion.php');
require_once('../Helpers/Session.php');
require_once('../Helpers/Hash.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') die('Method not support, only POST.');
if (!isset(
    $_POST['AdmonName'],
    $_POST['AdmonFirstLastName'],
    $_POST['AdmonSecondLastName'],
    $_POST['AdmonUser'],
    $_POST['AdmonPassw'],
    $_POST['slCarrier']
)) die('Vars undefined.');

$admonname = $_POST['AdmonName'];
$admonfirstlastname = $_POST['AdmonFirstLastName'];
$admonsecondlastname = $_POST['AdmonSecondLastName'];
$admonuser = $_POST['AdmonUser'];
$admonpassw = $_POST['AdmonPassw'];
$slCarrier = $_POST['slCarrier'];
$Hashpassword = Hash::make($admonpassw);

$query = "select u.id from user u join rol r on u.rol_id = r.id where r.id = $slCarrier and lower(r.name) = 'director'";
$res = mysqli_query($con, $query);

if (mysqli_num_rows($res) > 0) {
    Session::withMessage(['error' => 'Ya existe un administrador con el rol de Director.'], function () {
        header('Location: /registraradministrativo.php');
    });
} else {
    $query = "select id from user where user_name = '$admonuser';";
    $res = mysqli_query($con, $query);

    if (mysqli_num_rows($res) > 0) {
        Session::withMessage(['error' => 'Ya existe un administrador registrado con este nombre de usuario.'], function () {
            header('Location: /registraradministrativo.php');
        });
    } else {
        $query = "INSERT INTO user(name, last_name_p, last_name_m, user_name, password, rol_id)
            values('$admonname','$admonfirstlastname', '$admonsecondlastname','$admonuser','$Hashpassword',$slCarrier);";

        if (mysqli_query($con, $query)) {
            Session::withMessage(['msj' => 'Administrativo registrado correctamente.'], function () {
                header('Location: /veradministrativo.php');
            });
        } else {
            Session::withMessage(['error' => 'Ocurrio un error al momento de registrar al administrativo, error: ' . mysqli_errno($con)], function () {
                header('Location: /registraradministrativo.php');
            });
        }
    }
}
