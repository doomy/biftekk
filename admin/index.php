<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        include('templates/login.tpl');
    }
?>
