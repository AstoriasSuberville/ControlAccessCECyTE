<?php
    $usuario = $_POST['inputName'];
    $password = $_POST['inputPassword'];

    $consultar="SELECT * FROM user WHERE user_name='$usuario' and"
?>