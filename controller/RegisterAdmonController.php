<?php
session_start();
require_once('../admon/conexion.php');
require_once('../Helpers/Session.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') die('Method not support, only POST.');
if (!isset($_POST['AdmonName'], $_POST['AdmonFirstLastName'], $_POST['AdmonSecondLastName'], $_POST['AdmonUser'], $_POST['AdmonPassw'])) die('Vars undefined.');

$admonname = $_POST['AdmonName'];
$admonfirstlastname = $_POST['AdmonFirstLastName'];
$admonsecondlastname = $_POST['AdmonSecondLastName'];
$admonuser = $_POST['AdmonUser'];
$admonpassw = $_POST['AdmonPassw'];
echo Hash::make('AdmonPassw');