<?php
session_start();
require_once('./Helpers/Session.php');

Session::start(0, function(){
    header('Location: /Home.php');
}, ['msj' => 'Se forzo el inicio de sesion como demo']);