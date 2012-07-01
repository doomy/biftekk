<?php
    require ('../lib/env.php');
    $env = new Env('../');
    session_start();
    if (!isset($_SESSION['login'])) {
        include('templates/login.tpl');
    }
?>
