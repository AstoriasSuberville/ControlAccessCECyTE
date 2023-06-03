<?php
session_start();
require_once('../Helpers/Session.php');

if ($_SERVER['REQUEST_METHOD'] != 'GET') die('Error method not support.'); // Si el metodo no es POST dara error

if (Session::exists()) {
    Session::destroy();
}
header('Location: /login.php');
